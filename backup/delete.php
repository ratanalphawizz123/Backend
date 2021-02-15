<?php 

include("Database/Config.php");
// Check connection



$id = $_REQUEST['ID'];
$tablename = $_REQUEST['deltablename'];
$pagename = $_REQUEST['pagename'];
$Parameter = $_REQUEST['Parameter'];
$idname = $_REQUEST['idname'];

   $sql = "UPDATE $tablename SET REC_status='0' WHERE $idname ='".$id."'";
if ($db->query($sql) === TRUE) {
  header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
} else {
 
}

?>