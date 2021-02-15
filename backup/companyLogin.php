<?php
include("Database/Config.php");
include("errorcode.php");
session_start();
//$con=mysqli_connect("localhost","phpmyadmin","Admin@123","Brat");
$cid= $_SESSION['UserData']['Company_ID'];
$User_Status = $_SESSION['UserData']['User_Status'];
$myusername = mysqli_real_escape_string($db,$_POST['username']);
$mypassword = mysqli_real_escape_string($db,md5($_POST['password'])); 
/*Login for Getting 2 time Attempt Login*/
 $sql = "SELECT No_Of_Passsword_Retries FROM CompanyUser WHERE User_email_address = '".$myusername."' AND REC_status='1' And User_Status='1'";

$result = mysqli_query($db,$sql);
 $rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $rowretrive['No_Of_Passsword_Retries'];
/*Login for Getting 2 time Attempt Login*/
 $sql1 = "SELECT No_of_retries_allowed FROM Company WHERE Company_ID = '".$cid."' AND REC_status=1";
$result1 = mysqli_query($db,$sql1);
$rowretrive1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
  $rowretrive1['No_of_retries_allowed'];


if($rowretrive['No_Of_Passsword_Retries'] >= $rowretrive1['No_of_retries_allowed']){
   //die("here");
    $sql2 = "SELECT User_Status FROM CompanyUser WHERE User_email_address = '".$myusername."' or Current_Password = '".$mypassword."' AND REC_status='1'";
   $result2 = mysqli_query($db,$sql2);
   $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);   

    $sql = "SELECT * FROM CompanyUser WHERE User_email_address = '".$myusername."' AND Current_Password = '".$mypassword."' AND REC_status='1' And User_Status='1' AND Company_ID='".$cid."'";
 
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);   
   $active = $row['active']; 
    $User_ID = $row['User_ID'];     
   $count = mysqli_num_rows($result);      
   if($count == 1) {
      $SignonDate = date("Y-m-d H:i:s");
      //echo $SignonDate;die;
      $_SESSION['User_email'] = $myusername;
      $_SESSION['User_ID'] = $User_ID;
      //$_SESSION['last_login_timestamp'] = time();
      $_SESSION['loggedin_time'] = time(); 
      $date = date('yy-m-d h:i:s'); 
      $sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='0',REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."' Where User_email_address='".$myusername."'";
      if ($db->query($sql) === TRUE) {

        $username = $_SESSION['User_ID'];
        $ip_addr  = $_SERVER['REMOTE_ADDR'];
        $auditQry = "INSERT into auditor 
                     (username,ipaddr,change_type,table_name,changes) VALUES
                     ('$username','$ip_addr','VIEW','CompanyUser','Login')";
            $db->query($auditQry);
         header("location: welcome.php");
      }      
      
   }else {  
      
      $Count = ($rowretrive['No_Of_Passsword_Retries'])+(1);
      $status = $row2['User_Status'];
      if($status == 1){
      $errorMessage = GetSystemCode('301');
   }else{
        $errorMessage = GetSystemCode('303');
   }
      $_SESSION['error_msg'] = $errorMessage['System_message'];
      $date = date('yy-m-d h:i:s');
$sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='".$Count."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."' WHERE User_email_address='".$myusername."'";  
      //echo $sql;die;
      //header("location: index.php");
      if ($db->query($sql) === TRUE) {
         header("location: login.php");
      }

   } 
}else{
   //die("2");
     $date = date('yy-m-d h:i:s');
   $sql = "UPDATE CompanyUser SET User_Status='2',REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."' Where User_email_address='".$myusername."'";   
     if($status == 1){
      $errorMessage = GetSystemCode('301');
   }else{
        $errorMessage = GetSystemCode('303');
   }

   $_SESSION['error_msg'] = $errorMessage['System_message'];
   if ($db->query($sql) === TRUE) {
         header("location: login.php");
   }
}



?>