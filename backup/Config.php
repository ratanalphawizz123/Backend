<?php
   session_start();

   global $db;
   define('DB_SERVER', 'localhost:3036');
   define('DB_USERNAME', 'Alpha');
   define('DB_PASSWORD', 'Admin@123');
   define('DB_DATABASE', 'Brat1');
   $db = mysqli_connect('localhost','Alpha','Admin@123','Brat1');








?>