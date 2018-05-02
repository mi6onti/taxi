<?php

namespace models;

class UserType extends \models\Base {

    const USER_TYPE_ADMIN = 1,
          USER_TYPE_CORDINATOR = 3,
          USER_TYPE_TAXI = 2,
          USER_TYPE_CLIENT = 4;

    protected $_table_name = 'user_type';

    protected function _setFields() {
        $this->_fields = array(
            'id' => array('readonly' => true),
            'name' => array('label' => 'Тип потребител', 'type' => 'text')
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
