<?php
include("Database/Config.php");
function isLoginSessionExpired() {
include("Database/Config.php");
 $sql1 = "SELECT Automatic_NoActivity_logout_time FROM Company WHERE Company_ID = '".$_SESSION['UserData']['Company_ID']."'";
      $result1 = mysqli_query($db,$sql1);
      $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);


 $login_session_duration = $row1['Automatic_NoActivity_logout_time']; 
	$current_time = time(); 
	
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["User_email"])){  
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			return true; 
		} 
	}
	return false;
}


function menu_gern($parent_id,$emailid){


  $sql1 = "SELECT MenuAccess.Company_ID, MenuAccess.User_Group_ID,Menu.Parameter, MenuAccess.Menu_ID,Menu.Menu_ID,Menu.Parent_Menu_ID, MenuLanguage.Menu_Display FROM MenuAccess INNER JOIN Menu ON (Menu.Company_ID = MenuAccess.Company_ID AND Menu.Menu_ID = MenuAccess.Menu_ID) INNER JOIN CompanyUser ON (CompanyUser.Company_ID = MenuAccess.Company_ID AND CompanyUser.User_Group_ID = MenuAccess.User_Group_ID) INNER JOIN MenuLanguage ON (MenuLanguage.Menu_ID = MenuAccess.Menu_ID and MenuLanguage.Company_ID = MenuAccess.Company_ID) INNER JOIN Company ON (CompanyUser.Company_ID = Company.Company_ID) Where CompanyUser.User_email_address = '".$emailid."' and MenuLanguage.Language = Company.Company_Language and MenuAccess.REC_status = 1 and Menu.Parent_Menu_ID='".$parent_id."'";
return $sql1;

}
?>