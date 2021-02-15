<?php

header("Content-Type: application/json;charset=utf-8");
include("Database/Config.php");
if (isset($_POST['companycode'])) {
	session_start();
	$companycode = mysqli_real_escape_string($db,$_POST['companycode']);
	$sql = "SELECT * FROM Company WHERE Company_ID = '$companycode' AND REC_status=1";
	$result = mysqli_query($db,$sql);
	$response = array();
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);	
		$response['result'] = $row;
		$response['status'] = TRUE;
		$response['message'] = "success.";		 
	}else{
		$response['result'] = "";
		$response['status'] = TRUE;
		$response['message'] = "Company not found.";
	}
	$json_response = json_encode($response);
	echo $json_response;
}



?>