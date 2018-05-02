<?php

namespace models;

abstract class Base {

    protected $_fields = array();
    protected $_table_name = '';
    private static $_database = null;

    public function __construct() {
        $this->_setFields();
    }

    /**
     *
     * @return \mysqli
     */
    protected function database() {
        if (!self::$_database) {
            $conn = new \mysqli('localhost', 'root', '', 'taxi');
            $conn->set_charset("utf8");
            self::$_database = $conn;
        }
        return self::$_database;
    }
    

    public function getFields() {
        return $this->_mapConcatenatedValueToAllFields(
            $this->_mapSubRef($this->_fields)
        );
    }

    public abstract function getTableName();

    protected abstract function _setFields();

    public function save() {
        if (isset($this->_fields['id']['value'])) {
            return $this->_update($this->_fields['id']['value']);
        } else {
            return $this->_insert();
        }
    }

    protected function _insert() {
        $sql = 'INSERT INTO ' . $this->getTableName() . ' ';
        $sql.= '(' . \implode(',', array_keys($this->getParams())) . ')';
        $sql.= ' VALUES ("' . \implode('","', $this->getParams()) . '")';
        return $this->database()->prepare($sql)->execute();
    }

    private function _update($id) {
        $c = 0;
        $params = $this->getParams();
        $sql = 'UPDATE ' . $this->getTableName() . ' SET ';
        foreach ($params as $key => $value) {
            $sql.=$key . ' = "' . $value . '"';
            $c++;
            if ($c < count($params)) {
                $sql.=', ';
            }
        }
        $sql.=' WHERE id = ' . $id;
        return $this->database()->prepare($sql)->execute();
    }

    public function find($id = 0, $where_clause = '') {
        $where = ' WHERE 1 ';
        if ($id > 0) {
            $where.= ' AND id = ' . (int) $id;
        }
        if($where_clause){
            $where.=$where_clause;
        }
        $sql = ' SELECT ' . $this->getTableName() . '.* FROM ' . $this->getTableName() . ' ' . $where . ' ORDER BY id';
        $result = mysqli_query($this->database(), $sql);
        $rows = array();
        while ($row = mysqli_fetch_object($result)) {
            $rows[$row->id] = $row;
        }
        $get_rows_fields = array();

        foreach ($rows as $number => $row) {
            $get_rows_fields[$number] = $this->_mapValueToField($row);
        }
        if ($id > 0) {
            $current_arr = current($get_rows_fields);

            return $this->_mapConcatenatedValueToAllFields(
                            $this->_mapSubRef($current_arr)
            );
        } else {
            foreach ($get_rows_fields as $id => $fields) {
                foreach ($fields as $field => $details) {
                    if (isset($details['ref'])) {
                        $get_rows_fields[$id][$field]['ref'] = (isset($details['ref'][$details['value']])) ? $details['ref'][$details['value']] : null;
                        if (isset($details['sub_ref_field'])) {
                            $get_rows_fields[$id][$field]['sub_ref'] = $get_rows_fields[$id][$field]['ref'][$details['sub_ref_field']]['ref'];
                        }
                        if (isset($details['concatenate_value_fields'])) {
                            $get_rows_fields[$id][$field]['concatenated_value'] = $this->_mapConcatenatedValue($details, $details['value']);
                        }
                    }
                }
            }
            return $get_rows_fields;
        }
    }

    private function _mapConcatenatedValueToAllFields($all_fields) {
        foreach ($all_fields as $field => $details) {
            if (isset($details['concatenate_value_fields'])) {
                foreach ($all_fields[$field]['ref'] as $ref_id => $details_ref) {
                    $all_fields[$field]['concatenated_value'][$ref_id] = $this->_mapConcatenatedValue($details, $ref_id);
                }
            }
        }
        return $all_fields;
    }

    private function _mapConcatenatedValue($details, $ref_id) {
        $concatenated_value = array();
        foreach ($details['concatenate_value_fields'] as $help_value => $co_field) {
            $get_value = $co_field;
            if(is_string($help_value)){
                $co_field = $help_value;
            }
            if (isset($details['ref'][$ref_id][$co_field]['sub_ref'])) {
                $concatenated_value[] = $details['ref'][$ref_id][$co_field]['sub_ref']['name']['value'] . ' ' . $details['ref'][$ref_id][$co_field]['ref']['name']['value'];
            } 
            elseif ($co_field == $help_value && isset($details['ref'][$ref_id][$co_field][$get_value])) {
                $concatenated_value[] = $details['ref'][$ref_id][$co_field][$get_value];
            } 
            elseif (isset($details['ref'][$ref_id][$co_field]['ref'])) {
                $concatenated_value[] = $details['ref'][$ref_id][$co_field]['ref']['name']['value'];
            } 
            else {
                $concatenated_value[] = $details['ref'][$ref_id][$co_field]['value'];
            }
        }
        return join(' - ', $concatenated_value);
    }

    private function _mapSubRef($current_arr) {
        foreach ($current_arr as $field => $details) {
            if (isset($details['sub_ref_field'])) {
                foreach ($details['ref'] as $ref_id => $ref_fields) {
                    if (isset($ref_fields[$details['sub_ref_field']])) {
                        $current_arr[$field]['sub_ref'][$ref_id] = $ref_fields[$details['sub_ref_field']]['ref'];
                    }
                }
            }
        }
        return $current_arr;
    }

    private function _mapValueToField($row) {
        $fields = $this->_fields;
        foreach ($row as $key => $field_value) {
            if (isset($fields[$key])) {
                $fields[$key]['value'] = $field_value;
            }
        }
        return $fields;
    }

    private function getParams() {
        $params = array();
        foreach ($this->_fields as $field => $details) {
            if (isset($details['type']) && isset($details['value'])) {
                if($details['type'] === 'password'){
                    $params[$field] = md5($details['value']);
                }
                else{
                    $params[$field] = $details['value'];
                }
            }
        }
        return $params;
    }

    private function _getWritableFields() {
        $fields = array();
        foreach ($this->getFields() as $field => $details) {
            if (isset($details['type'])) {
                $fields[$field] = $field;
            }
        }
        return $fields;
    }

    public function setFieldsValue($values) {
        if (isset($values['id'])) {
            $this->_fields['id']['value'] = (int) $values['id'];
        }
        foreach ($this->_getWritableFields() as $field) {
            if (isset($values[$field])) {
                $this->_fields[$field]['value'] = $values[$field];
            }
        }
        return $this;
    }

}
