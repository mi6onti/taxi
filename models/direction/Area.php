<?php

namespace models\direction;

class Area extends \models\Base {

    protected $_table_name = 'area';

    protected function _setFields() {
        $city = new \models\City();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'city_id' => array('ref'=>$city->find(), 'label' => $city->getFields()['name']['label'], 'type' => 'select'),
            'name' => array('label' => 'Район', 'type' => 'text'),
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
