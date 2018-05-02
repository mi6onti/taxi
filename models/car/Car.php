<?php

namespace models\car;

class Car extends \models\Base {

    protected $_table_name = 'car';

    protected function _setFields() {
        $car_model = new \models\car\CarModel();
        $car_type = new \models\car\CarType();
        $car_fuel = new \models\car\CarFuel();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'car_model_id' => array('sub_ref_field'=>'car_brand_id', 'ref' => $car_model->find(), 'type'=>'select', 'label'=>$car_model->getFields()['name']['label']),
            'car_type_id' => array('ref'=>$car_type->find(), 'label' => $car_type->getFields()['name']['label'], 'type' => 'select'),
            'car_fuel_id' => array('ref'=>$car_fuel->find(), 'label' => $car_fuel->getFields()['name']['label'], 'type' => 'select'),
            'year' => array('label' => 'Година на производство', 'type' => 'text'),
            'power' => array('label' => 'Мощност', 'type' => 'text'),
            'engine' => array('label'=> 'Обем на двигателя', 'type' => 'text')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
