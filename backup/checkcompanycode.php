<?php
include("Database/Config.php");
include("errorcode.php");
session_start();



 if (isset($_REQUEST['submit'])) {
        $companycode = mysqli_real_escape_string($db,$_REQUEST['companycode']);
/*Login for Getting 2 time Attempt Login*/
$sql = "SELECT * FROM Company WHERE Company_ID = '$companycode' AND REC_status=1";
$result = mysqli_query($db,$sql);
$rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result); 
	if($count == 1) {
      $_SESSION['UserData'] = $rowretrive;
      $_SESSION['error_msg'] = "";
      header("location: login.php");
   }else{ 
	$errorMessage = GetSystemCode('302');
	$_SESSION['error_msg'] = $errorMessage['System_message'];
	header("location: index.php");
   }

    }
    elseif (isset($_POST['default'])) {
    	$companycode = mysqli_real_escape_string($db,$_POST['companycode']);
$sql = "SELECT * FROM Company WHERE Company_ID = '$companycode' AND REC_status=1";
$result = mysqli_query($db,$sql);
$rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result); 
	if($count == 1) {
       
       setcookie("type", $companycode, time()+3600);
      $_SESSION['UserData'] = $rowretrive;
      $_SESSION['error_msg'] = "";
      header("location: login.php");
    }else{ 
  $errorMessage = GetSystemCode('302');
  $_SESSION['error_msg'] = $errorMessage['System_message'];
  header("location: index.php");
   }

}
 


?>