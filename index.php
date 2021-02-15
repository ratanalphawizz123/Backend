<?php

require 'core/Controller.php';
require 'application/helper/errorcode.php';
require 'application/helper/encryption_helper.php';
require  'application/libraries/PasswordHash.php';
require 'application/helper/Wordpress.php';
require "application/Config.php";
 
//require 'core/Config.php';
 class App{

  public $controller='Home';
  public $method='index';
  public $parameter='';


  public function __construct(){
   $url=$this->parseUrl();
   //check for controller method exists
   if(file_exists('application/controller/'.$url[0].'.php')){
    $this->controller=$url[0];
     unset($url[0]);
  }
  // require this controller 
   require 'application/controller/'.$this->controller.'.php';
   $obj=new $this->controller;

    if(method_exists($obj,$url[1])){ 
     $this->method=$url[1];
     unset($url[1]);
    }
    call_user_func_array([$obj,$this->method],[$url]);
    

  }

 
  public function parseUrl(){
    if(isset($_GET['parameter'])){
    return explode("/",rtrim($_GET['parameter'],'/'));
    // echo "<pre>";print_r($r);
     
   }

  }

 }

 $obj=new App();


?>
