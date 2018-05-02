<?php
namespace models\direction;

class Address extends \models\Base {

    protected $_table_name = 'address';

    protected function _setFields() {
        $street = new \models\direction\Street();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'street_id' => array('ref' => $street->find(), 'type'=>'select', 'label'=>$street->getFields()['name']['label'], 'concatenate_value_fields' => array('area_id' => 'concatenated_value', 'name')),
            'number' => array('label' => 'Номбер/Блок', 'type' => 'text'),
            'entrance' => array('label' => 'Вход', 'type' => 'text'),
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
