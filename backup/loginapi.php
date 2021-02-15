<?php 
header("Content-Type: application/json;charset=utf-8");
include("Database/Config.php");
if (isset($_POST['username']) && isset($_POST['password'])) {
	$sql = "SELECT No_Of_Passsword_Retries FROM CompanyUser WHERE User_email_address = '".$_POST['username']."' AND REC_status=1";
	$result = mysqli_query($db,$sql);
	$rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$response = array();
	if($rowretrive['No_Of_Passsword_Retries'] < 3){ 		
	   $sql = "SELECT * FROM CompanyUser WHERE User_email_address = '".$_POST['username']."' AND Current_Password = '".$_POST['password']."' AND REC_status=1";
	   $result = mysqli_query($db,$sql);
	   $Data = mysqli_fetch_assoc($result);
	   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);   
	   $active = $row['active'];      
	   $count = mysqli_num_rows($result);      
   		if($count == 1) {
   			//echo "<pre>";print_r($Data);die("Asd");			
			$sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='0' Where User_email_address='".$_POST['username']."'";
			if ($db->query($sql) === TRUE) {
				$response['result'] = $Data ;
				$response['status'] = TRUE;
				$response['message'] = "Success.";
			}
			 
   		}else { 
			$Count = ($rowretrive['No_Of_Passsword_Retries'])+(1);
			$sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='".$Count."' WHERE User_email_address='".$_POST['username']."'";  
			if ($db->query($sql) === TRUE) {
			 	$response['result'] = "" ;
				$response['status'] = False;
				$response['message'] = "Your Login Name or Password is invalid.";
			}

   		} 
	}else{
	   	$sql = "UPDATE CompanyUser SET REC_status='0' Where User_email_address='".$_POST['username']."'";   
	   	if ($db->query($sql) === TRUE) {
	         $response['result'] = "" ;
			$response['status'] = False;
			$response['message'] = "Your Account is Deactivate Please contact to system admin.";
	   	}
	}
	$json_response = json_encode($response);
	echo $json_response;
}
?>