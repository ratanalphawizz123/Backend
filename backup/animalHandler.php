<?php
require_once 'ajax.php';

if(isset( $_POST['invoiceno'] )) {
     $myAnimal = new animal();
     $result = $myAnimal->getName();
     echo $result;
}

?> 