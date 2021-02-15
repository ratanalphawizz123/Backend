<?php
	include("Database/Config.php");
    session_start();
     $username = $_SESSION['User_ID'];
        $ip_addr  = $_SERVER['REMOTE_ADDR'];
                     $auditQry = "INSERT into auditor 
                     (username,ipaddr,change_type,table_name,changes) VALUES
                     ('$username','$ip_addr','VIEW','CompanyUser','Logout')";
                      $db->query($auditQry);
    session_destroy();
    unset($_SESSION['error_msg']);

    if(isset($_REQUEST["session_expired"])) {
    $username = $_SESSION['User_ID'];
        $ip_addr  = $_SERVER['REMOTE_ADDR'];
                     $auditQry = "INSERT into auditor 
                     (username,ipaddr,change_type,table_name,changes) VALUES
                     ('$username','$ip_addr','VIEW','CompanyUser','Auto Logout')";
                      $db->query($auditQry); 	
	header('location:login.php');
}

    header('location:index.php');
?>

