<?php

namespace models\direction;

class Street extends \models\Base {

    protected $_table_name = 'street';

    protected function _setFields() {
        $area = new \models\direction\Area();
        $this->_fields = array(
            'id' => array('readonly' => true),
            'area_id' => array('ref'=>$area->find(), 'label' => $area->getFields()['name']['label'], 'type' => 'select', 'concatenate_value_fields' => array('city_id', 'name')),
            'name' => array('label' => 'Улива/Квартал', 'type' => 'text'),
        );
        return $this;
    }

    public function getTableName() {
        return $this->_table_name;
    }

}
