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

//print_r($_POST);

$capture_field_vals ="";
$filed = $_POST["filed"];
$datatype = $_POST['datatype'];
$datatype1 = json_decode($datatype);
$datatypeval = $_POST['datatypeval'];
$datatypeval1 = json_decode($datatypeval);
$datatypevalmsg = $_POST['datatypevalmsg'];
$datatypevalmsg1 = json_decode($datatypevalmsg);

$columnname = $_POST['columnname'];
$id = $_POST['id'];
$pagename = $_POST['pagename'];
$tablename = $_POST['tablename'];
$Parameter = $_POST['Parameter'];

date_default_timezone_set('Asia/Kolkata');
$date = date('yy-m-d h:i:s');
$REC_create_datetime= $date;
$REC_lastUpdate_datetime= $date;
$REC_lastUpdate_by='System';
$REC_status='1';
//print_r($filed);


$filed1 = explode(",",$filed);
//print_r($filed1);
$filed = $_POST['filed'];
$i=1;
$columnname = explode(",",$columnname);
array_unshift($columnname,"");
unset($columnname[0]);

  foreach($_POST["name"] as $key => $text_field){
    $capture_field_vals .= $text_field ."','";
    //echo $key;
    //echo $filed[$i].'<br>';
    //echo $text_field;
    $tt=array();
    $filedex = explode(",",$filed[$i]);
    //$columnname = explode(",",$columnname[$i]);
    //print_r($columnname);
     
   
       foreach ($filedex as $key1 => $value) {

       if(!empty($value)){
         
         $key='key'.$value;  
          $val1 = $datatype1->$key;
       //echo "<prev>"; print_r($datatypeval1);
      
           $ss =''.$val1;
            $tt = $datatypeval1->$ss;
            $pp = $datatypevalmsg1->$ss; 
        if(!empty($tt)){ 
         
      if(!preg_match($tt,$text_field)) {
        $errorMessage = $pp.$columnname[$i];
        $_SESSION['error_msg']= $errorMessage;
        header("location:add_company.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter."");
    }
  }
     
    }
}

    
  $i++;}

/*  <!-- Insert Script For Company Table Start -->*/

    $sqlc="insert into $tablename($columnname,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status)values
 ('".$capture_field_vals."".$REC_create_datetime."','".$REC_lastUpdate_datetime."','".$REC_lastUpdate_by."','".$REC_status."')";
//$db->query($sqlc);
//$company_id = mysqli_insert_id($db);
  
   if ($db->query($sqlc) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }



else if(isset($_POST['addcountry']) && !empty($_POST['addcountry'])){

//print_r($_POST);

$capture_field_vals ="";
$filed = $_POST["filed"];
$FieldValidation = $_POST["FieldValidation"];
$Validationparameter = $_POST["Validationparameter"];
$titlename = $_POST["titlename"];

$columnname1 = $_POST['columnname'];
$id = $_POST['id'];
$pagename = $_POST['pagename'];
$tablename = $_POST['tablename'];
$Parameter = $_POST['Parameter'];

date_default_timezone_set('Asia/Kolkata');
$date = date('yy-m-d h:i:s');
$REC_create_datetime= $date;
$REC_lastUpdate_datetime= $date;
$REC_lastUpdate_by='System';
$REC_status='1';
//print_r($filed);

$i=1;
$columnname = explode(",",$columnname1);
array_unshift($columnname,"");
unset($columnname[0]);

$errorMessage= array();
  foreach($_POST["name"] as $key => $text_field){
    $capture_field_vals .= $text_field ."','";
 
      $filedval = $filed[$i];
      $Validationparameter1 = explode(",",$Validationparameter[$i]); 
//print_r($Validationparameter1);

   if($FieldValidation[$i] > 0){
   if($filedval == 'br_varchar'){

      if (!preg_match("/^[a-zA-Z-' ]*$/",$text_field)) {
         $error = GetSystemCode('310');
         $geterror = $error['System_message'];
        
         $errorMessage[$i] .= $geterror.'&nbsp;'.$titlename[$i];
         
        //header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter."");
        
        }
        else{
             
      if (strlen($text_field) <  $Validationparameter1[0] ) { 
        
         $error = GetSystemCode('312');
         $geterror = $error['System_message'];
         $errorMessage[$i] .= $geterror.'&nbsp;'.$Validationparameter1[0].'&nbsp;'.$titlename[$i];

        //header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter."");
         }  
       if(strlen($text_field) > $Validationparameter1[1]){

       $error = GetSystemCode('313');
         $geterror = $error['System_message'];
         $errorMessage[$i] .= $geterror.'&nbsp;'.$Validationparameter1[1].'&nbsp;'.$titlename[$i]; 
        //header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter.""); 
       }   
        }
     }else if($filedval == 'br_int')
     {
      if (!preg_match("#[0-9]+#",$text_field)) {
        $error = GetSystemCode('311');
         $geterror = $error['System_message'];
         $errorMessage[$i] .= $geterror.'&nbsp;'.$titlename[$i]; 
        //header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter."");
        }else
        {
         if ($text_field <  $Validationparameter1[0] ) { 
         
        $error = GetSystemCode('314');
         $geterror = $error['System_message'];
         $errorMessage[$i] .= $geterror.'&nbsp;'.$Validationparameter1[0].'&nbsp;'.$titlename[$i]; 
       // header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter."");
         }  
       if($text_field > $Validationparameter1[1]){
       $error = GetSystemCode('315');
         $geterror = $error['System_message'];
         $errorMessage[$i] .= $geterror.'&nbsp;'.$Validationparameter1[1].'&nbsp;'.$titlename[$i]; 
      
        //header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter.""); 
       } 
        }
     }
     else if($filedval == 'br_boolean'){
      if($text_field == '0'){
       $error = GetSystemCode('316');
         $geterror = $error['System_message'];
         $errorMessage[$i] .= $geterror.'&nbsp;'.$Validationparameter1[2].'&nbsp;'.$titlename[$i]; 
      
        //header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter.""); 
       }
     }

  } 
  $i++;
}
if($errorMessage){

  $_SESSION['error_msg']= $errorMessage;
  header("location:add_country.php?deltablename=".$tablename."&pagename=".$pagename."&Parameter=".$Parameter."");
        
} else {
/*  <!-- Insert Script For Company Table Start -->*/

     $sqlc="insert into $tablename($columnname1,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status)values
 ('".$capture_field_vals."".$REC_create_datetime."','".$REC_lastUpdate_datetime."','".$REC_lastUpdate_by."','".$REC_status."')";
   if ($db->query($sqlc) === TRUE) {
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
 }
   }




else if(isset($_POST['editcompany']) && !empty($_POST['editcompany'])){

$columnname = $_POST['columnname'];
$pagename = $_POST['pagename'];
$tablename = $_POST['tablename'];
$Parameter = $_POST['Parameter'];
$idname = $_POST['idname'];
$id = $_POST['ID'];

date_default_timezone_set('Asia/Kolkata');
$date = date('yy-m-d h:i:s');
$REC_create_datetime= $date;
$REC_lastUpdate_datetime= $date;
$REC_lastUpdate_by='System';
$REC_status='1';
/*  <!-- Insert Script For Company Table Start -->*/

$columnname1 = explode(",",$columnname);


$capture_field_vals ="";
   $i=0; 
   $updateval=[];
  //$sql="update $tablename set " 
  foreach($_POST["name"] as $key => $text_field){
    //echo $columnname1[$i] = '".$text_field."';
    //$capture_field_vals .= $text_field;
    $updateval[] =$columnname1[$i].'='."'$text_field'";
  $i++;}
   $updateval1 = implode(",",$updateval);
  $sqlc="update $tablename set $updateval1,REC_create_datetime='".$REC_create_datetime."',REC_lastUpdate_datetime='".$REC_lastUpdate_datetime."',REC_lastUpdate_by='".$REC_lastUpdate_by."',REC_status='".$REC_status."' where $idname='".$id."'"; 
    
//$db->query($sqlc);
//$company_id = mysqli_insert_id($db);
  
   if ($db->query($sqlc) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
else if(isset($_POST['addcompanyuser']) && !empty($_POST['addcompanyuser'])){


$capture_field_vals ="";
  foreach($_POST["name"] as $key => $text_field){
    $capture_field_vals .= $text_field ."','";
  }


$columnname = $_POST['columnname'];
$id = $_POST['id'];
$pagename = $_POST['pagename'];
$tablename = $_POST['tablename'];
$Parameter = $_POST['Parameter'];

date_default_timezone_set('Asia/Kolkata');
$date = date('yy-m-d h:i:s');
$REC_create_datetime= $date;
$REC_lastUpdate_datetime= $date;
$REC_lastUpdate_by='System';
$REC_status='1';
/*  <!-- Insert Script For Company Table Start -->*/

     $sqlc="insert into $tablename($columnname,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status)values
 ('".$capture_field_vals."".$REC_create_datetime."','".$REC_lastUpdate_datetime."','".$REC_lastUpdate_by."','".$REC_status."')";
//$db->query($sqlc);
//$company_id = mysqli_insert_id($db);
  
   if ($db->query($sqlc) === TRUE) {
    //die("Asdasd");
     header("Location: http://15.206.103.57/Brat/".$pagename."?Parameter=".$Parameter."");
   } else {
    //die("else");
   }
   }
   
else if(isset($_POST['editcompanyuser']) && !empty($_POST['editcompanyuser'])){


  


$columnname = $_POST['columnname'];
$pagename = $_POST['pagename'];
$tablename = $_POST['tablename'];
$Parameter = $_POST['Parameter'];
$idname = $_POST['idname'];
$id = $_POST['ID'];

date_default_timezone_set('Asia/Kolkata');
$date = date('yy-m-d h:i:s');
$REC_create_datetime= $date;
$REC_lastUpdate_datetime= $date;
$REC_lastUpdate_by='System';
$REC_status='1';
/*  <!-- Insert Script For Company Table Start -->*/

$columnname1 = explode(",",$columnname);


$capture_field_vals ="";
   $i=0; 
   $updateval=[];
  //$sql="update $tablename set " 
  foreach($_POST["name"] as $key => $text_field){
    //echo $columnname1[$i] = '".$text_field."';
    //$capture_field_vals .= $text_field;
    $updateval[] =$columnname1[$i].'='."'$text_field'";
  $i++;}
   $updateval1 = implode(",",$updateval);
  $sqlc="update $tablename set $updateval1,REC_create_datetime='".$REC_create_datetime."',REC_lastUpdate_datetime='".$REC_lastUpdate_datetime."',REC_lastUpdate_by='".$REC_lastUpdate_by."',REC_status='".$REC_status."' where $idname='".$id."'"; 
    
//$db->query($sqlc);
//$company_id = mysqli_insert_id($db);
  
   if ($db->query($sqlc) === TRUE) {
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