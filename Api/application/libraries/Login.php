<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login {

        public function isLoggedIn(){
            $CI =& get_instance();
            if(!empty($CI->session->userdata('admin'))){
                return true;
            }
            else {
                return false;
            }
        }
}