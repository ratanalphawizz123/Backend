<?php
   session_start();
   global $db;
$host = "localhost"; /* Host name */
$user = "alphafk6_phase2b"; /* User */
$password = "test123@pn"; /* Password */
$dbname = "alphafk6_phase2brat"; /* Database name */

 $db = mysqli_connect($host,$user,$password,$dbname);
// Check connection
if (!$db) {
 die("Connection failed: " . mysqli_connect_error());
}
return $db;
?>