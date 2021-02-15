<?php
include("Database/Config.php");
include("errorcode.php");
session_start();
 $cid = $_SESSION['UserData']['Company_ID'];
  $sql1 = "SELECT * FROM Company WHERE Company_ID = '$cid'";
$result1 = mysqli_query($db,$sql1);
$rowretrive1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
 
 $sql = "SELECT * FROM CompanyUser WHERE Company_ID = '$cid'";
$result = mysqli_query($db,$sql);
$rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);

if (isset($_REQUEST['submit'])) {
 $newpassword = mysqli_real_escape_string($db,$_POST['newpassword']);
  $confirmpassword = mysqli_real_escape_string($db,$_POST['confirmpassword']);
   $_SESSION['UserData']['Minimum_length_of_password'];
 

if($rowretrive1['Minimum_length_of_password'] > 0){ 
  
  if (strlen($newpassword) <  $rowretrive1['Minimum_length_of_password'] ) {        
         $errorMessage = GetSystemCode('304');
         $_SESSION['error_msg'] = $errorMessage['System_message'].$rowretrive1['Minimum_length_of_password']. 'Characters!';
         $error .= $_SESSION['error_msg'];

        //header("location: forgetpassword.php");

    }
}
 
if($rowretrive1['Compulsory_numeric'] > 0){ 
  if(!preg_match("#[0-9]+#",$newpassword)) {
        $errorMessage = GetSystemCode('305');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
        $error .= $_SESSION['error_msg'];

        //header("location: forgetpassword.php");
    }
}
if($rowretrive1['Compulsory_upper_case'] > 0 ){ 
  if(!preg_match("#[A-Z]+#",$newpassword)) {

        $errorMessage = GetSystemCode('306');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
        //header("location: forgetpassword.php");
        $error .= $_SESSION['error_msg'];
    }
}
if($rowretrive1['Compulsory_special_character'] > 0){ 
  if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newpassword)) {

        $errorMessage = GetSystemCode('307');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
        //header("location: forgetpassword.php");
        $error .= $_SESSION['error_msg'];

    }
}
    
if ($newpassword === $confirmpassword) {  

}
else {
  
  $errorMessage = GetSystemCode('308');
  $_SESSION['error_msg'] = $errorMessage['System_message'];
  $error .= $_SESSION['error_msg'];
  //header("location: forgetpassword.php");
}  

if($error){
  header("location: forgetpassword.php");
$_SESSION['error_msg']= "$error";
} else {
$password = md5($newpassword);

          $Last5Passwords = $rowretrive['Last5Passwords'];

        $check_last = $rowretrive1['Check_Last_5_Passwords'];
        if($check_last > 0){
$Last5Passwords_array = explode(",", $Last5Passwords);

if (in_array($password, $Last5Passwords_array)) {
  echo $result = count($Last5Passwords_array);
 //echo $result = !empty($Last5Passwords) ? count(explode(',', $Last5Passwords)) : 0;
    if($check_last > $result || $Last5Passwords == '0'){
 echo $addlast5password =  $password.','.$Last5Passwords;    
    }else{
        $addlast5password='0';
        $errorMessage = GetSystemCode('309');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
         header("location: forgetpassword.php");   
         }
} else {
    if($Last5Passwords =='0'){
 $addlast5password = $password;
    }else{
 $addlast5password = $Last5Passwords;
}
$addlast5password='0';
date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $sql = "UPDATE CompanyUser SET Current_Password='".$password."',Last5Passwords='".$addlast5password."',First_Login='0',  REC_lastUpdate_datetime='".$date."',Last_Changed_Password_DateTime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."' WHERE Company_ID='".$_SESSION['UserData']['Company_ID']."' and  User_email_address = '".$_SESSION['User_email']."' "; 
 
  if ($db->query($sql) === TRUE) {
  
      header("location: welcome.php");
   
  }
}


        }



   

}
     
}
    
    elseif (isset($_POST['submit1'])) {
  $newpassword = mysqli_real_escape_string($db,$_POST['newpassword']);
  $confirmpassword = mysqli_real_escape_string($db,$_POST['confirmpassword']);
   $_SESSION['UserData']['Minimum_length_of_password'];
 

if($rowretrive1['Minimum_length_of_password'] > 0){ 
  
  if (strlen($newpassword) <=  $rowretrive1['Minimum_length_of_password']) {        
         $errorMessage = GetSystemCode('304');
         $_SESSION['error_msg'] = $errorMessage['System_message'].$rowretrive1['Minimum_length_of_password'].'8 Characters!';
         $error .= $_SESSION['error_msg'];

        //header("location: forgetpassword.php");

    }
}
 
if($rowretrive1['Compulsory_numeric'] > 0){ 
  if(!preg_match("#[0-9]+#",$newpassword)) {
        $errorMessage = GetSystemCode('305');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
        $error .= $_SESSION['error_msg'];

        //header("location: forgetpassword.php");
    }
}
if($rowretrive1['Compulsory_upper_case'] > 0 ){ 
  if(!preg_match("#[A-Z]+#",$newpassword)) {

        $errorMessage = GetSystemCode('306');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
        //header("location: forgetpassword.php");
        $error .= $_SESSION['error_msg'];
    }
}
if($rowretrive1['Compulsory_special_character'] > 0){ 
  if(!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $newpassword)) {

        $errorMessage = GetSystemCode('307');
        $_SESSION['error_msg'] = $errorMessage['System_message'];
        //header("location: forgetpassword.php");
        $error .= $_SESSION['error_msg'];

    }
}
    
if ($newpassword === $confirmpassword) {  

}
else {
  
  $errorMessage = GetSystemCode('308');
  $_SESSION['error_msg'] = $errorMessage['System_message'];
  $error .= $_SESSION['error_msg'];
  //header("location: forgetpassword.php");
}  

if($error){
  header("location: forgetpassword.php");
$_SESSION['error_msg']= "$error";
} else {
$password = md5($newpassword);

        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $Last5Passwords = $rowretrive['Last5Passwords'];
        $check_last = $rowretrive1['Check_Last_5_Passwords'];
        if($check_last > 0){
$Last5Passwords_array = explode(",", $Last5Passwords);
echo $result = count($Last5Passwords_array);

        }

        $sql = "UPDATE CompanyUser SET Current_Password='".$password."',Last5Passwords='".$last5password."',First_Login='0',  REC_lastUpdate_datetime='".$date."',Last_Changed_Password_DateTime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."'  WHERE Company_ID='".$_SESSION['UserData']['Company_ID']."'"; 
    
  if ($db->query($sql) === TRUE) {
  
      header("location: welcome.php");
   
  }
   

}
  


    }



// Login for Getting 2 time Attempt Login
// $sql = "SELECT No_Of_Passsword_Retries FROM CompanyUser WHERE User_email_address = '$myusername' AND REC_status=1";
// $result = mysqli_query($db,$sql);
// $rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);

// if($rowretrive['No_Of_Passsword_Retries'] < 3){
//    //die("here");
//    $sql = "SELECT * FROM CompanyUser WHERE User_email_address = '$myusername' AND Current_Password = '$mypassword' AND REC_status=1";
//    $result = mysqli_query($db,$sql);
//    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);   
//    $active = $row['active'];      
//    $count = mysqli_num_rows($result);      
//    if($count == 1) {
//       //session_register("myusername");
//       $_SESSION['User_email'] = $myusername;
//       $_SESSION['last_login_timestamp'] = time();
//       $sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='0' Where User_email_address='".$myusername."'";
//       if ($db->query($sql) === TRUE) {
//          header("location: welcome.php");
//       }      
      
//    }else {  
      
//       $Count = ($rowretrive['No_Of_Passsword_Retries'])+(1);
//       $errorMessage = GetSystemCode('301');
//       $_SESSION['error_msg'] = $errorMessage['System_message'];
      
//       $sql = "UPDATE CompanyUser SET No_Of_Passsword_Retries='".$Count."' WHERE User_email_address='".$myusername."'";  
//       //echo $sql;die;
//       //header("location: index.php");
//       if ($db->query($sql) === TRUE) {
//          header("location: login.php");
//       }

//    } 
// }else{
//    //die("2");
//    $sql = "UPDATE CompanyUser SET REC_status='0' Where User_email_address='".$myusername."'";   
//    $errorMessage = GetSystemCode('303');
//    $_SESSION['error_msg'] = $errorMessage['System_message'];
//    if ($db->query($sql) === TRUE) {
//          header("location: login.php");
//    }
// }

?>