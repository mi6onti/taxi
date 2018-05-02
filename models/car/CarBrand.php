<?php

namespace models\car;

class CarBrand extends \models\Base {

    protected $_table_name = 'car_brand';

    protected function _setFields() {
        $this->_fields = array(
            'id' => array('readonly' => true),
            'name' => array('label' => 'Марка', 'type' => 'text')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
