<?php

namespace controllers;

class Base {

    /**
     * @var \models\Base
     */
    private $_model = null;
    private $_view = null;
    private $_user = null;

    public function __construct() {
        $router = \libs\AltoRouter::getInstance();
        $match = $router->match();
        $params = $match['params'];
        $route_name = $match['name'];
        if ($params['action'] == 'logout') {
            \models\User::logout();
        } else {
            if (!isset($_SESSION['user_id']) && isset($_POST['email']) && isset($_POST['password'])) {
                $user = new \models\User();
                $user->login($_POST['email'], $_POST['password']);
                if($route_name !== 'index'){
                    header("Location: ".$router->generate('index', array('action'=>'show')));
                }
            } 
            $this->_user = \models\User::getUser();
        }
        $this->_view = new \core\View();
        $this->_view->route_name = $route_name;
        if (isset($this->_user['id'])) {
            $this->_view->user_id = $this->_user['id']['value'];
            $this->_view->user_type = $this->_user['user_type_id']['value'];
            $this->_view->username = $this->_user['name']['value'];
            $this->_view->email = $this->_user['email']['value'];
            $this->_view->user_type_label = $this->_user['user_type_id']['ref'][$this->_view->user_type]['name']['value'];
        }
        $this->_view->header();
        $this->_setNavigation();
        $this->_setPermissions();
        $this->_view->navigation();
        $this->_view->main();
    }

    private function _setNavigation() {
        $navigation = array(
            'index' => 'Начална страница',
            'car_brand' => 'Марки автомобили',
            'car_model' => 'Модели автомобили',
            'car_type' => 'Типове автомобили',
            'car' => 'Автомобили',
            'user' => 'Потребители',
            'car_register' => 'Регистрирани автомобили',
            'city' => 'Град',
            'company' => 'Фирми',
            'company_city' => 'Фирми по градове',
            'taxi_driver' => 'Таксиметрови коли',
            'area' => 'Райони',
            'street' => 'Улици/Квартали',
            'address' => 'Адреси',
            'request' => 'Заявки'
        );
        $this->_view->navigation = $navigation;
    }
    
    private function _setPermissions(){
        $permissions = array(
            \models\UserType::USER_TYPE_CORDINATOR => array('index', 'city', 'area', 'street', 'address', 'request'),
            \models\UserType::USER_TYPE_CLIENT => array('index', 'request'),
            \models\UserType::USER_TYPE_TAXI => array('index', 'request','car_brand', 'car_model', 'car', 'car_register', 'taxi_driver'),
        );
        $this->_view->permissions = $permissions;
    }

    public function carAction() {
        $this->_model = new \models\car\Car();
        $this->_processPost();
        $this->_loadView();
    }

    public function carBrandAction() {
        $this->_model = new \models\car\CarBrand();
        $this->_processPost();
        $this->_loadView();
    }

    public function carModelAction() {
        $this->_model = new \models\car\CarModel();
        $this->_processPost();
        $this->_loadView();
    }

    public function carFuelAction() {
        $this->_model = new \models\car\CarFuel();
        $this->_processPost();
        $this->_loadView();
    }

    public function carTypeAction() {
        $this->_model = new \models\car\CarType();
        $this->_processPost();
        $this->_loadView();
    }

    public function carRegisterAction() {
        $this->_model = new \models\car\CarRegister();
        $this->_processPost();
        $this->_loadView();
    }

    public function companyAction() {
        $this->_model = new \models\Company();
        $this->_processPost();
        $this->_loadView();
    }

    public function cityAction() {
        $this->_model = new \models\City();
        $this->_processPost();
        $this->_loadView();
    }

    public function userTypeAction() {
        $this->_model = new \models\UserType();
        $this->_processPost();
        $this->_loadView();
    }

    public function userAction() {
        $this->_model = new \models\User();
        $this->_processPost();
        $this->_loadView();
    }

    public function company2CityAction() {
        $this->_model = new \models\Company2City();
        $this->_processPost();
        $this->_loadView();
    }

    public function taxiDriverAction() {
        $this->_model = new \models\TaxiDriver();
        $this->_processPost();
        $this->_loadView();
    }

    public function areaAction() {
        $this->_model = new \models\direction\Area();
        $this->_processPost();
        $this->_loadView();
    }

    public function streetAction() {
        $this->_model = new \models\direction\Street();
        $this->_processPost();
        $this->_loadView();
    }

    public function addressAction() {
        $this->_model = new \models\direction\Address();
        $this->_processPost();
        $this->_loadView();
    }

    public function requestAction() {
        $this->_model = new \models\Request();
        $this->_processPost();
        $this->_loadView();
    }

    private function _loadView() {
        $router = \libs\AltoRouter::getInstance();
        $match = $router->match();
        $params = $match['params'];
        $type = $params['action'];
        $show_url = \libs\AltoRouter::getInstance()->generate($this->_view->route_name, array('action' => 'show'));
        switch ($type) {
            case 'show':
                $this->_view->params = $this->_model->find();
                $this->_view->action = 'show';
                $this->_view->show();
                break;
            case 'edit':
                $this->_view->params = $this->_model->find($params['id']);
                $this->_view->action = 'edit';
                $this->_view->action_url = $show_url;
                $this->_view->edit();
                break;
            case 'add':
                $this->_view->params = $this->_model->getFields();
                $this->_view->action = 'add';
                $this->_view->action_url = $show_url;
                $this->_view->add();
                break;
            default:
                echo 'Not loadded view;';
        }
        $this->_view->footer();
    }

    private function _processPost() {
        if (isset($_POST['save'])) {
            $this->_model->setFieldsValue($_POST);
            $this->_model->save();
        }
    }

    /**
     * @return \controllers\Base
     */
    public static function getInstance() {
        return new Base();
    }

}
