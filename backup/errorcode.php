<?php 

function GetSystemCode($Code){
	include("Database/Config.php");
	$query = "SELECT * FROM SystemCode where System_code='".$Code."'";
	$row = mysqli_query($db,$query); 	
	$result  = mysqli_fetch_array($row,MYSQLI_ASSOC);	
	return $result;
}