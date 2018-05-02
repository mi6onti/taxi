<?php
namespace core;

class View {
    public $params = null;
    public $action_url = '';
    public $action = '';
    public $navigation = array();
    public $route_name = '';
    
    public function edit(){
        require 'view/edit.php';
    }
    
    public function add(){
        require 'view/edit.php';
    }
    
    public function show(){
        require 'view/show.php';
    }
    
    public function navigation(){
        require 'view/navigation.php';
    }
    
    public function header(){
        require 'view/header.php';
    }
    
    public function footer(){
        require 'view/footer.php';
    }

    public function main(){
        require 'view/main.php';
    }
    
    public function getHostPath(){
        return HOST_PATH.'/taxi/';
    }

    
}
