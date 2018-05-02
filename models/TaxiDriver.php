<?php

namespace models;

class TaxiDriver extends \models\Base {

    protected $_table_name = 'taxi_driver';

    protected function _setFields() {
        $company2city = new \models\Company2City();
        $user = new \models\User();
        $car_register = new \models\car\CarRegister();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'company2city_id' => array('label'=> 'Компания', 'ref'=>$company2city->find(), 'type'=>'select', 'concatenate_value_fields' => array('company_id','city_id')),
            'user_id' => array('ref'=>$user->find(0,' AND user_type_id = '.\models\UserType::USER_TYPE_TAXI.' '), 'label' => 'Шофьор', 'type' => 'select'),
            'car_register_id' => array('ref'=>$car_register->find(), 'label' => 'Автомобил', 'type' => 'select', 'concatenate_value_fields' => array('car_id' => 'concatenated_value','city_id', 'name')),
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
