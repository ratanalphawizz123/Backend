<?php 
require './application/Sessions.php';
 //require "./application/Config.php";

  function base_url(){
        $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $base_url .= "://". @$_SERVER['HTTP_HOST'].'/Brat/';
        return  $base_url;
  }
  function Database() {
	 	  //require "application/Config.php";
          $obj= new Config();
          return $obj->connect();
    }
 
   function GetSystemCode($System_code=''){
            $obj= new Config();
            $db= $obj->connect();
          	$sql = "SELECT * FROM SystemCode where System_code=?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $System_code);
            $stmt->execute();
            $result = $stmt->get_result();
            $result1 =mysqli_fetch_all($result, MYSQLI_ASSOC);
            return !empty($result1[0]['System_message']) ? $result1[0]['System_message']:'';
		
   }
     function Get_First_login_Flag(){
            $cid = get_session('company_ID');
            $obj= new Config();
            $db= $obj->connect();
          	$sql = "SELECT First_login_flag FROM Company WHERE Company_ID =?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $cid);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result1 =mysqli_fetch_all($result, MYSQLI_ASSOC);
   }
 
   function set_session($session_name,$data){
            $obj1= new Sessions();
            return $obj1->set_session_data($session_name,$data);
   }
    
   function get_session($session_name){
            $obj1= new Sessions();
            return $obj1->session_data($session_name);
   }
   function destroy_session($session_name='useremail'){
            $obj1= new Sessions();
            return $obj1->remove_session($session_name);
   }
     function get_cookies(){
       if(isset($_COOKIE["type"]))
        {
           return $val=$_COOKIE["type"]; 
        }
   }
    function destroy_cookies($key=''){
    unset($_COOKIE[$key]);
    setcookie($key,'', time()- (86400 * 30), '/');
   }
   
   function redirect($reDirectUrl=''){
       if(!empty($reDirectUrl)){
        header("Location: $reDirectUrl");
       }
   }
    
    
  function menu_gern($parent_id,$emailid){
            $obj= new Config();
            $db= $obj->connect();
            $sql = "SELECT MenuAccess.Company_ID, MenuAccess.User_Group_ID,Menu.Parameter, MenuAccess.Menu_ID,Menu.Menu_ID,Menu.Parent_Menu_ID, MenuLanguage.Menu_Display FROM MenuAccess INNER JOIN Menu ON (Menu.Company_ID = MenuAccess.Company_ID AND Menu.Menu_ID = MenuAccess.Menu_ID) INNER JOIN CompanyUser ON (CompanyUser.Company_ID = MenuAccess.Company_ID AND CompanyUser.User_Group_ID = MenuAccess.User_Group_ID) INNER JOIN MenuLanguage ON (MenuLanguage.Menu_ID = MenuAccess.Menu_ID and MenuLanguage.Company_ID = MenuAccess.Company_ID) INNER JOIN Company ON (CompanyUser.Company_ID = Company.Company_ID) Where CompanyUser.User_email_address = '".$emailid."' and MenuLanguage.Language = Company.Company_Language and MenuAccess.REC_status = 1 and Menu.Parent_Menu_ID='".$parent_id."'";
            $result1 = $db->query($sql);
            return $result1;
   }
   
     function menu_gern_child($Parameter){
            $obj= new Config();
            $db= $obj->connect();
            $sqlm2="select LogicalTable.Logical_table_php_name from Menu INNER JOIN ListConfiguration ON Menu.Parameter = ListConfiguration.List_Name INNER JOIN LogicalTable ON ListConfiguration.Logical_Table_Name=LogicalTable.Logical_Table_Name where ListConfiguration.List_Name='$Parameter'";
            $resultm2= $db->query($sqlm2);
           // $rowm2 = mysqli_fetch_assoc($resultm2);
            return $resultm2;
   }
     /*************** Get Table Data *******************/	
		 function getdatafromtable($table, $condition = array(), $data = "*", $limit = "", $offset= "", $orderby = "", $ordertype = "ASC",$prepare=''){
           
            $obj= new Config();
            $db= $obj->connect();
			$query = "select $data from $table";
			
			 //for where
			  $wcount = 0;
			  $where = '';
			 if(!empty($condition)){
			   // echo "hi";die;
			    foreach($condition as $wcol => $wheval) {
			      $wcol = addslashes($wcol);
			      $wval = addslashes($wheval);
			      $where .= "`$wcol` = '$wval' AND ";

                   }
				$query .=" where $where 1=1";
			}
			if($limit != ''){
				$query .="limit $limit, $offset";
			}
			if($orderby != ''){
				$query .="order by $orderby $ordertype";
			}
           $result= mysqli_query($db,$query);
			if ($result->num_rows> 0) {
			    return mysqli_fetch_all ($result, MYSQLI_ASSOC);
			} else {				
				return false;
			}
	}
   function isLoginSessionExpired(){
               
             $getSession= get_session('UserData');
             $Company_ID=!empty($getSession[0]['Company_ID']) ? $getSession[0]['Company_ID'] :'';
             $where= array("Company_ID"=>$Company_ID);
             $result= getdatafromtable('Company',$where,"Automatic_NoActivity_logout_time");
             $login_session_duration = !empty($result[0]['Automatic_NoActivity_logout_time']) ? $result[0]['Automatic_NoActivity_logout_time'] :'0';
             $current_time = time();
             $loggedin_time= get_session('loggedin_time');
              $useremail= get_session('useremail');
            	
        	if(isset($loggedin_time) and isset($useremail)){  
        	  
         		if(((time() - $loggedin_time) > $login_session_duration)){ 
         			return true; 
        		} 
        	}
	    return false;
  }
 
   
    
?>