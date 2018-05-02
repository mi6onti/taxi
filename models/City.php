<?php
namespace models;

class City extends \models\Base {

    protected $_table_name = 'city';

    protected function _setFields() {
        $this->_fields = array(
            'id' => array('readonly' => true),
            'name' => array('label' => 'Град', 'type' => 'text'),
            'identificator' => array('label' => 'Идентификатор', 'type' => 'text')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
