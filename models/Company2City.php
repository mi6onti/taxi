<?php

namespace models;

class Company2City extends \models\Base {

    protected $_table_name = 'company2city';

    protected function _setFields() {
        $company = new \models\Company();
        $city = new \models\City();
        $user = new \models\User();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'user_id' => array('ref'=>$user->find(), 'label' => 'Собственик', 'type' => 'select'),
            'city_id' => array('ref'=>$city->find(), 'label' => $city->getFields()['name']['label'], 'type' => 'select'),
            'company_id' => array('ref'=>$company->find(), 'label' => $company->getFields()['name']['label'], 'type' => 'select')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
