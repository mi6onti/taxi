<?php

namespace models\car;

class CarRegister extends \models\Base {

    protected $_table_name = 'car_register';

    protected function _setFields() {
        $car = new \models\car\Car();
        $city = new \models\City();
        
        $register_fields = array(
            'id' => array('readonly' => true),
            'car_id' => array('label'=> 'Автомобил', 'ref'=>$car->find(), 'type'=>'select', 'concatenate_value_fields' => array('car_model_id', 'year')),
            'city_id' => array('ref'=>$city->find(), 'type'=>'select', 'label'=>$city->getFields()['name']['label']),
            'name' => array('type' => 'text', 'label'=> 'Регистрационен номер')
        );
       $this->_fields = $register_fields;
       return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
