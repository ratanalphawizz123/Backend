<?php

class Controller{
    public function __contruct(){
        
    	}
	
	public function view($view='',$data=''){
		   require "application/views/".$view.".php";
	}

   public function Database() {
	 	  require "application/Config.php";
          $obj= new Config();
          return $obj->connect();
    }
    public function model($m){
		require 'application/model/'.$m.'.php';
		 return new $m();
	}
   
     
}


?>