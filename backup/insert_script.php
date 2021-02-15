<?php  global $db;
$db = mysqli_connect('localhost','Alpha','Admin@123','BratPhase2');
if(isset($_POST['submit']) && !empty($_POST['submit'])) {

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
$db->query($sqlc);
$company_id = mysqli_insert_id($db);

/*<!-- Insert Script For Company Table End -->*/

/*<!-- Insert Script For Company UserGroup Table Start -->*/

$Company_ID = $company_id;
$User_Group_ID='2';
$User_Group_Name='B-Robotic';
$User_Role_Description='Role that is for action that is system generated';
$REC_create_datetime=$date;
$REC_lastUpdate_datetime=$date;
$REC_lastUpdate_by='2';
$REC_status='0';
$sql_cug="insert into CompanyUserGroup(Company_ID,User_Group_ID,User_Group_Name,User_Role_Description,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status)values('".$Company_ID."','".$User_Group_ID."','".$User_Group_Name."','".$User_Role_Description."','".$REC_create_datetime."','".$REC_lastUpdate_datetime."','".$REC_lastUpdate_by."','".$REC_status."')";
$db->query($sql_cug);
$user_grop_ID = mysqli_insert_id($db);
  
/*<!-- Insert Script For Company UserGroup Table End -->*/

/*<!-- Get  Company_ID and User_Group_ID -->*/
$sql="select * from CompanyUserGroup where ID='".$user_grop_ID."'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$usergrop_ID= $row['User_Group_ID'];
$Company_ID1= $row['Company_ID'];

/*<!-- Get  Company_ID and User_Group_ID -->

<!-- Insert Script For Company User Table Start -->*/

$User_first_name='B-Robotic';
$User_middle_name='Chibly';
$User_last_name='Chibly';
$User_email_address='brobotics@gmail.com';
$User_cont_country_code='91';
$User_contact_area_code='91';
$User_contact_contactNo='111111111';
$User_Status='1';
$No_Of_Passsword_Retries='0';
$Last5_Passwords='1';
$Last_Changed_Pass_DateTime=$date;
$Current_Password='Admin@123';
$Last_SignOn_DateTime=$date;
$First_Login='1';
$REC_create_datetime=$date;
$REC_lastUpdate_datetime=$date;
$REC_lastUpdate_by='1';
$REC_status='1';
$sql_cu="insert into CompanyUser(Company_ID,User_Group_ID,User_first_name,User_middle_name,User_last_name,User_email_address,User_contact_country_code,User_contact_area_code,User_contact_contactNo,User_Status,No_Of_Passsword_Retries,Last5_Passwords,Last_Changed_Password_DateTime,Current_Password,Last_SignOn_DateTime,First_Login,REC_create_datetime,REC_lastUpdate_datetime,REC_lastUpdate_by,REC_status)values('".$Company_ID1."','".$usergrop_ID."','".$User_first_name."','".$User_middle_name."','".$User_last_name."','".$User_email_address."','".$User_cont_country_code."','".$User_contact_area_code."','".$User_contact_contactNo."','".$User_Status."','".$No_Of_Passsword_Retries."','".$Last5_Passwords."','".$Last_Changed_Pass_DateTime."','".md5($Current_Password)."','".$Last_SignOn_DateTime."','".$First_Login."','".$REC_create_datetime."','".$REC_lastUpdate_datetime."','".$REC_lastUpdate_by."','".$REC_status."')";
//$db->query($sql_cu);
if ($db->query($sql_cu) === TRUE) {
//die("Asdasd");
echo 'Data Insert successful';
}
}
/*<!-- Insert Script For Company User Table End -->*/

/*<!-- Delete Script For All Table Start -->*/
else if(isset($_POST['delete']) && !empty($_POST['delete'])) {
	 
$result = mysqli_query($db,"show tables");
  // run the query and assign the result to $result
while($table = mysqli_fetch_array($result)) {
//SET foreign_key_checks = 0;   // go through each row that was returned in $result
   ///echo($table[0] . "<BR>");
  $sql1="SET FOREIGN_KEY_CHECKS = 0";
  $db->query($sql1);
  $sql="TRUNCATE table ".$table[0].""; 
  $db->query($sql);
  $sql1="SET FOREIGN_KEY_CHECKS = 1";
  //$db->query($sql1);


}
if ($db->query($sql1) === TRUE) {
//die("Asdasd");
echo 'Data Deleted successful';
}

}

/*<!-- Delete Script For All Table Table End -->*/

