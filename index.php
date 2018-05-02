<?php
define('HOST_PATH', 'http://localhost:3030');

use controllers\Base as Ctrl;
use libs\AltoRouter as Router;
require 'libs/AltoRouter.php';
require 'core/View.php';
require 'controllers/Base.php';
require 'models/Base.php';
require 'models/car/Car.php';
require 'models/car/CarBrand.php';
require 'models/car/CarModel.php';
require 'models/car/CarFuel.php';
require 'models/car/CarType.php';
require 'models/car/CarRegister.php';
require 'models/City.php';
require 'models/direction/Area.php';
require 'models/direction/Street.php';
require 'models/direction/Address.php';
require 'models/Company.php';
require 'models/Company2City.php';
require 'models/UserType.php';
require 'models/User.php';
require 'models/TaxiDriver.php';
session_start();
require 'models/Request.php';

$router = Router::getInstance();
$router->setBasePath('/taxi/');
$router->map('GET|POST', '[:action]?', function(){
    Ctrl::getInstance();
}, 'index');
$router->map('GET|POST', Router::getDefaultParams('car_brand'), function(){
    Ctrl::getInstance()->carBrandAction();
}, 'car_brand');
$router->map('GET|POST', Router::getDefaultParams('car_model'), function(){
    Ctrl::getInstance()->carModelAction();
}, 'car_model');
$router->map('GET|POST', Router::getDefaultParams('car_fuel'), function(){
    Ctrl::getInstance()->carFuelAction();
}, 'car_fuel');
$router->map('GET|POST', Router::getDefaultParams('car_type'), function(){
    Ctrl::getInstance()->carTypeAction();
}, 'car_type');
$router->map('GET|POST', Router::getDefaultParams('car'), function(){
    Ctrl::getInstance()->carAction();
}, 'car');
$router->map('GET|POST', Router::getDefaultParams('car_register'), function(){
    Ctrl::getInstance()->carRegisterAction();
}, 'car_register');
$router->map('GET|POST', Router::getDefaultParams('company'), function(){
    Ctrl::getInstance()->companyAction();
}, 'company');
$router->map('GET|POST', Router::getDefaultParams('city'), function(){
    Ctrl::getInstance()->cityAction();
}, 'city');
$router->map('GET|POST', Router::getDefaultParams('user_type'), function(){
    Ctrl::getInstance()->userTypeAction();
}, 'user_type');
$router->map('GET|POST', Router::getDefaultParams('user'), function(){
    Ctrl::getInstance()->userAction();
}, 'user');
$router->map('GET|POST', Router::getDefaultParams('company_city'), function(){
    Ctrl::getInstance()->company2CityAction();
}, 'company_city');
$router->map('GET|POST', Router::getDefaultParams('taxi_driver'), function(){
    Ctrl::getInstance()->taxiDriverAction();
}, 'taxi_driver');
$router->map('GET|POST', Router::getDefaultParams('area'), function(){
    Ctrl::getInstance()->areaAction();
}, 'area');
$router->map('GET|POST', Router::getDefaultParams('street'), function(){
    Ctrl::getInstance()->streetAction();
}, 'street');
$router->map('GET|POST', Router::getDefaultParams('address'), function(){
    Ctrl::getInstance()->addressAction();
}, 'address');
$router->map('GET|POST', Router::getDefaultParams('request'), function(){
    Ctrl::getInstance()->requestAction();
}, 'request');

$match = $router->match();
if(isset($match['target'])){
    call_user_func_array( $match['target'], $match['params'] ); 
}
else {
    echo 'Page not found';
}

?>
