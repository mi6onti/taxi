<?php

namespace models\car;

class CarFuel extends \models\Base {

    protected $_table_name = 'car_fuel';

    protected function _setFields() {
        $this->_fields = array(
            'id' => array('readonly' => true),
            'name' => array('label' => 'Тип двигател', 'type' => 'text')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
