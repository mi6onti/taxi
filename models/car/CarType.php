<?php

namespace models\car;

class CarType extends \models\Base {

    protected $_table_name = 'car_type';

    protected function _setFields() {
        $this->_fields = array(
            'id' => array('readonly' => true),
            'name' => array('label' => 'Тип', 'type' => 'text')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
