<?php

namespace models\car;

class CarModel extends \models\Base {

    protected $_table_name = 'car_model';

    protected function _setFields() {
        $brand_ref = new \models\car\CarBrand();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'car_brand_id' => array('ref' => $brand_ref->find(), 'type'=>'select', 'label'=>$brand_ref->getFields()['name']['label']),
            'name' => array('label' => 'Модел', 'type' => 'text'),
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
