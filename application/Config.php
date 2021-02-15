<?php

class Config {
    public $host = "localhost"; /* Host name */
    public $user = "root"; /* User */
    public $pass = "";  /* password */ 
    public $db = "bratlocal"; /* Database name */
    var $myconn;

    function connect() {

        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
         if (!$con) {
             die('Could not connect to database!');
         } else {
             $this->myconn = $con;
            //echo 'Connection established!';
         }

        return $con;
    }

    function close() {
        mysqli_close($myconn);
        echo 'Connection closed!';
    }
} 

?>
