<?php
namespace models;

class Request extends \models\Base {

    protected $_table_name = 'request';

    protected function _setFields() {
        $address = new \models\direction\Address();
        $addresses = $address->find();
        $user = new \models\User();
        $current_user = \models\User::getUser();
        $and = '';
        if($current_user['user_type_id']['value'] == \models\UserType::USER_TYPE_CLIENT){
            $and = ' AND id = '.$current_user['id']['value'];
        }
        $this->_fields = array(
            'id' => array('readonly' => true),
            'from_address_id' => array('ref' => $addresses, 'type'=>'select', 'label'=>'От адрес', 'concatenate_value_fields' => array('street_id' => 'concatenated_value', 'number', 'entrance')),
            'to_address_id' => array('ref' => $addresses, 'type'=>'select', 'label'=>'До адрес', 'concatenate_value_fields' => array('street_id' => 'concatenated_value', 'number', 'entrance')),
            //'from_user_id' => array('readonly' => true, 'ref' => $user->find(0, ' AND user_type_id = '.UserType::USER_TYPE_CORDINATOR.' '), 'type'=>'select', 'label'=>'Диспечер'),
            'to_user_id' => array('readonly'=>true, 'ref' => $user->find(0, ' AND user_type_id = '.UserType::USER_TYPE_TAXI.' '), 'type'=>'select', 'label'=>'Таксиметров шофьор'),
            'client_id' => array('ref' => $user->find(0, ' AND user_type_id = '.UserType::USER_TYPE_CLIENT.' '.$and. ' '), 'type'=>'select', 'label' => 'Клиент'),
            'date_created' => array('readonly' => true, 'label' => 'Дата на заявката')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }
    
    public function find($user_id = 0, $sql = ''){
        $user = \models\User::getUser();
        if($user_id === 0 && $user['user_type_id']['value'] == \models\UserType::USER_TYPE_CLIENT){
            return parent::find(0, ' AND client_id = '.$user['id']['value']);
        }
        else{
            return parent::find($user_id, $sql);
        }
        
    }

}
