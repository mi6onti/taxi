<?php

namespace models;

class User extends \models\Base {

    protected $_table_name = 'user';

    protected function _setFields() {
        $user_type = new \models\UserType();

        $fields = array(
            'id' => array('readonly' => true),
            'email' => array('type' => 'email', 'label' => 'Мейл'),
            'password' => array('type' => 'password', 'label' => 'Парола'),
            'name' => array('type' => 'text', 'label' => 'Име'),
            'user_type_id' => array('label' => $user_type->getFields()['name']['label'], 'ref' => $user_type->find(), 'type' => 'select'),
        );
        $this->_fields = $fields;
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

    public function login($email, $pass) {
        if (!isset($_SESSION['user_id'])) {
            $row = $this->find(0, ' AND email = "' . $email . '" AND password = "' . md5($pass) . '"  ');
            if (isset($row)) {
                $user = current($row);
                $_SESSION['user_id'] = $user['id']['value'];
                return $user;
            }
        }
        return null;
    }
    
    public static function logout(){
        unset($_SESSION['user_id']);
    }

    
    public static function getUser() {
        if (isset($_SESSION['user_id'])) {
            $user = new User();
            return $user->find($_SESSION['user_id']);
        }
        return null;
    }
    
    protected function _insert(){
        if($res = parent::_insert()){
            $_SESSION['user_id'] = $this->database()->insert_id;
        }
    }
}
