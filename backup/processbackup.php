<?php include("Database/Config.php");
   include("errorcode.php");
   session_start();
   
   if(isset($_POST['update']) && !empty($_POST['update'])) {
   $id = $_POST['id'];
   $pagename = $_POST['pagename'];
   $tablename = $_POST['tablename'];
    $user_name = $_POST['username'];
   $email = $_POST['email'];
   $address1 = $_POST['address1'];
   $address2 = $_POST['address2'];
   $Singapore_id_no = $_POST['Singapore_id_no'];
   $father_name = $_POST['father_name'];
   $mother_name = $_POST['mother_name'];
   $sister_name = $_POST['sister_name'];
   $Parameter = $_REQUEST['Parameter'];
     date_default_timezone_set('Asia/Kolkata');
    $date = date('yy-m-d h:i:s');
    $sql = "UPDATE $tablename SET user_name='".$user_name."',email='".$email ."',address1='".$address1."',address2='".$address2."',Singapore_id_no='".$Singapore_id_no."',father_name='".$father_name."',mother_name='".$mother_name."',sister_name='".$sister_name."',REC_lastUpdate_datetime='".$date."' WHERE Id='".$id."'";
   //echo $sql;
   
   if ($db->query($sql) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   
   else if(isset($_POST['addcompany']) && !empty($_POST['addcompany'])){
   $id = $_POST['id'];
   $pagename = $_POST['pagename'];
   $tablename = $_POST['tablename'];
    date_default_timezone_set('Asia/Kolkata');
$date = date('yy-m-d h:i:s');
/*  <!-- Insert Script For Company Table Start -->*/
$Company_Description= 'B-Robotic';
$Country_Code ='12';
$Comp_billing_Address1='Singapore';
$Comp_billing_Address2='Singapore';
$Comp_billing_Address_city='Singapore';
$Comp_Billing_Address_State= 'Malaysia';
$Comp_Billing_Address_Country='Singapore';
$Comp_Billing_postalCode='456123';
$Comp_contact_person='Breat Ben';
$Comp_contact_email='brobotics@gmail.com';
$Comp_contact_country_code='65';
$Comp_contact_area_code='452';
$Comp_contact_contactNo='7894567898';
$Comp_Registration_number='123456';
$Comp_Bank_payment_Link_Info='link1';
$Comp_Logo='bencompany.png';
$Comp_Language='EN';
$Relationship_Manager_ID='12';
$First_login_flag='1';
$Force_change_pass_days='0';
$No_of_retries_allowed='7';
$Check_Last_5_Pass ='0';
$Minimum_length_of_pass ='5';
$Compulsory_upper_case='0';
$Compulsory_numeric='1';
$Compulsory_special_character='1';
$Automatic_SignOnActivity_Lockout='0';
$Automatic_NoActivity_logout_time='1000';
$REC_create_datetime= $date;
$REC_lastUpdate_datetime= $date;
$REC_lastUpdate_by='12';
$REC_status='1';
$sqlc="insert into Company(Company_Description,
Country_Code,Company_Billing_Address_Line1,Company_Billing_Address_Line2,Company_Billing_Address_City,Company_Billing_Address_State,Company_Billing_Address_Country,Company_Billing_PostalCode,Company_contact_person,Company_contact_email,Company_contact_country_code,Company_contact_area_code,Company_contact_contactNo,Company_Registration_number,Company_Bank_payment_Link_Info,Company_Logo,Company_Language,Relationship_Manager_ID,First_login_flag,Force_change_password_days,No_of_retries_allowed,Check_Last_5_Passwords,Minimum_length_of_password,Compulsory_upper_case,Compulsory_numeric,Compulsory_special_character,Automatic_SignOnActivity_Lockout,Automatic_NoActivity_logout_time,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status) values('".$Company_Description."','".$Country_Code."','".$Comp_billing_Address1."','".$Comp_billing_Address2."','".$Comp_billing_Address_city."','".$Comp_Billing_Address_State."','".$Comp_Billing_Address_Country."','".$Comp_Billing_postalCode."','".$Comp_contact_person."','".$Comp_contact_email."','".$Comp_contact_country_code."','".$Comp_contact_area_code."','".$Comp_contact_contactNo."','".$Comp_Registration_number."','".$Comp_Bank_payment_Link_Info."','".$Comp_Logo."','".$Comp_Language."','".$Relationship_Manager_ID."','".$First_login_flag."','".$Force_change_pass_days."','".$No_of_retries_allowed."','".$Check_Last_5_Pass."','".$Minimum_length_of_pass."','".$Compulsory_upper_case."','".$Compulsory_numeric."','".$Compulsory_special_character."','".$Automatic_SignOnActivity_Lockout."','".$Automatic_NoActivity_logout_time."','".$REC_create_datetime."','".$REC_lastUpdate_datetime."','".$REC_lastUpdate_by."','".$REC_status."')";
//$db->query($sqlc);
//$company_id = mysqli_insert_id($db);
   
   if ($db->query($sqlc) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   else if(isset($_POST['updatedepart']) && !empty($_POST['updatedepart'])){
   
    $id = $_POST['id'];
   $pagename = $_POST['pagename'];
   $tablename = $_POST['tablename'];
    $user_name = $_POST['username'];
   $department_name = $_POST['department_name'];
   $Parameter = $_REQUEST['Parameter'];
   
     date_default_timezone_set('Asia/Kolkata');
    $date = date('yy-m-d h:i:s');
    $sql = "UPDATE $tablename SET department_name='".$department_name."',REC_lastUpdate_datetime='".$date."' WHERE Id='".$id."'";
   //echo $sql;
   
   if ($db->query($sql) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   
   
   else if(isset($_POST['adddepart']) && !empty($_POST['adddepart'])){
   $id = $_POST['id'];
   $pagename = $_POST['pagename'];
   $tablename = $_POST['tablename'];
    $department_name = $_POST['department_name'];
   $Parameter = $_REQUEST['Parameter'];
   $user = $_POST['user'];
   
     date_default_timezone_set('Asia/Kolkata');
    $date = date('yy-m-d h:i:s'); 
   
       $sql="insert into $tablename(user_id,department_name,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status) values('".$user."','".$department_name."','".$date."','".$date."','".$_SESSION['UserData']['Company_ID']."','1')";
   
   if ($db->query($sql) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   
   
   else if(isset($_POST['updatesalary']) && !empty($_POST['updatesalary'])){
   
    $id = $_POST['id'];
   $pagename = $_POST['pagename'];
   $tablename = $_POST['tablename'];
   //$user_name = $_POST['username'];
   $amount = $_POST['amount'];
   $Parameter = $_REQUEST['Parameter'];
   
     date_default_timezone_set('Asia/Kolkata');
    $date = date('yy-m-d h:i:s');
     $sql = "UPDATE $tablename SET amount='".$amount."',REC_lastUpdate_datetime='".$date."' WHERE Id='".$id."'";
   //echo $sql;
   
   if ($db->query($sql) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   
   
   
   else if(isset($_POST['addsalary']) && !empty($_POST['addsalary'])){
   $id = $_POST['id'];
   $pagename = $_POST['pagename'];
   $tablename = $_POST['tablename'];
    $amount = $_POST['amount'];
   $Parameter = $_REQUEST['Parameter'];
   $user = $_POST['user'];
   
     date_default_timezone_set('Asia/Kolkata');
    $date = date('yy-m-d h:i:s'); 
   
       $sql="insert into $tablename(user_id,amount,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status) values('".$user."','".$amount."','".$date."','".$date."','".$_SESSION['UserData']['Company_ID']."','1')";
   
   if ($db->query($sql) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   
   else if(isset($_POST['submit']) && !empty($_POST['submit']))
   
   {
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
   
   else if(isset($_POST['default']) && !empty($_POST['default'])){
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
   
    else if(isset($_POST['defaultpass']) && !empty($_POST['defaultpass'])){
       
   $cid = $_SESSION['UserData']['Company_ID'];
   $sql1 = "SELECT * FROM Company WHERE Company_ID = '$cid'";
   $result1 = mysqli_query($db,$sql1);
   $rowretrive1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
    
    $sql = "SELECT * FROM CompanyUser WHERE Company_ID = '$cid'";
   $result = mysqli_query($db,$sql);
   $rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
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
if($check_last >= 0){
$Last5Passwords_array = explode(",", $Last5Passwords);
if (in_array($password, $Last5Passwords_array)) {
$result = count($Last5Passwords_array);
//echo $result = !empty($Last5Passwords) ? count(explode(',', $Last5Passwords)) : 0;
if($check_last > $result || $Last5Passwords == '0'){
$addlast5password =  $password.','.$Last5Passwords;    
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
 $sql = "UPDATE CompanyUser SET Current_Password='".$password."',Last5_Passwords='".$addlast5password."',First_Login='0',  REC_lastUpdate_datetime='".$date."',Last_Changed_Password_DateTime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."' WHERE Company_ID='".$_SESSION['UserData']['Company_ID']."' and  User_email_address = '".$_SESSION['User_email']."' "; 
if ($db->query($sql) === TRUE) {
header("location: welcome.php");
}
}
}
}
}
else if(isset($_POST['changepass']) && !empty($_POST['changepass'])){

$cid = $_SESSION['UserData']['Company_ID'];
$sql1 = "SELECT * FROM Company WHERE Company_ID = '$cid'";
$result1 = mysqli_query($db,$sql1);
$rowretrive1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
$sql = "SELECT * FROM CompanyUser WHERE Company_ID = '$cid'";
$result = mysqli_query($db,$sql);
$rowretrive = mysqli_fetch_array($result,MYSQLI_ASSOC);
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
$sql = "UPDATE CompanyUser SET Current_Password='".$password."',Last5_Passwords='".$last5password."',First_Login='0',  REC_lastUpdate_datetime='".$date."',Last_Changed_Password_DateTime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."'  WHERE Company_ID='".$_SESSION['UserData']['Company_ID']."'"; 
if ($db->query($sql) === TRUE) {
header("location: welcome.php");
}
}
} 




 else if(isset($_POST['userupdate']) && !empty($_POST['userupdate'])){
   

   $username = $_POST['username'];
   $middlename = $_POST['middlename'];
   $lastname = $_POST['lastname'];
   $contno = $_REQUEST['contno'];
   
     date_default_timezone_set('Asia/Kolkata');
    $date = date('yy-m-d h:i:s');
     $sql = "UPDATE CompanyUser SET User_first_name='".$username."',User_middle_name='".$middlename."',User_last_name='".$lastname."',User_contact_contactNo='".$contno."' where Company_ID='".$_SESSION['UserData']['Company_ID']."' and User_email_address='".$_SESSION['User_email']."'";
   
   if ($db->query($sql) === TRUE) {
    //die("Asdasd");
       $errorMessage = GetSystemCode('309');
     $_SESSION['error_msg'] = $errorMessage['System_message'];
     header("Location: http://15.206.103.57/Brat/my_account.php");
   } else {
    //die("else");
   }
   }
?>