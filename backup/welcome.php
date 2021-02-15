<?php 

 

 $sql1 = "SELECT Company_Language,Automatic_SignOnActivity_Lockout,Force_change_password_days FROM Company WHERE Company_ID = '".$_SESSION['UserData']['Company_ID']."' ";
        $result1 = mysqli_query($db,$sql1);
        $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
        $_SESSION['la'] = $row1['Company_Language'];
        date_default_timezone_set('Asia/Kolkata');
        $date = date('yy-m-d h:i:s');
        $days = $row1['Force_change_password_days'];
        $NewDate = date('yy-m-d h:i:s', strtotime("-".$days." days"));
        $lastdate = $row['Last_Changed_Password_DateTime'];

         $logoutdays = $row1['Automatic_SignOnActivity_Lockout'];
         $NewDate1 = date('yy-m-d h:i:s', strtotime("-".$logoutdays." days"));
         $Last_SignOn_DateTime = $row['Last_SignOn_DateTime'];
        
       if($days > 0 ){ 
     if($lastdate < $NewDate){
         header("location: forgetpassword.php");
      }
    }

if($logoutdays > 0 ){ 
 if($Last_SignOn_DateTime < $NewDate1){
      $date = date('yy-m-d h:i:s');
      $sql = "UPDATE CompanyUser SET User_Status='2',REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."' Where User_email_address='".$_SESSION['User_email']."'";   
    $errorMessage = GetSystemCode('303');
  
   $_SESSION['error_msg'] = $errorMessage['System_message'];
   if ($db->query($sql) === TRUE) {
         header("location: login.php");
   }

      }
      else{

   $sql1 = "UPDATE CompanyUser SET REC_lastUpdate_datetime='".$date."',REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."',Last_SignOn_DateTime='".$date."' Where User_email_address='".$_SESSION['User_email']."'";   
    $result1 = mysqli_query($db,$sql1);   
    }
    }
/*switch($_SESSION['la']){
  case "eng":
    require('lang/eng.php');    
  break;
  case "fre":
    require('lang/ch.php');    
  break;
    
  }*/

?>


    <?php include("sidebar.php"); ?>


    <!-- top navigation -->
    <?php include("header.php"); 
  
$sql="SELECT First_Login,Last_SignOn_DateTime,Last_Changed_Password_DateTime from CompanyUser where Company_ID='".$_SESSION['UserData']['Company_ID']."'and User_email_address='".$_SESSION['User_email']."'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
 if($row['First_Login']==1){
        header("location: forgetpassword.php");
      }?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="welcome">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="content">
                  <h2>Welcome to Brat Company</h2>
                  <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>  


            
            </div>
          </div>
        </div>
      </div>

     <!--  <section>
        <ul class="treeview-menu sidebar-menu">
              <li>
                    <a href="#"><span>main menu 1</span></a>
                    <ul class="treeview-menu">
                          <li><a href="#">sab menu 1</a></li>
                          <li>
                            <a href="#">sab menu 2</a>
                                <ul class="treeview-menu">
                                  <li><a href="#">Level Two</a></li>
                                  <li>
                                    <a href="#">Level Two</a>
                                        <ul class="treeview-menu">
                                          <li><a href="#">Level Three</a></li>
                                          <li><a href="#">Level Three</a></li>
                                        </ul>
                                  </li>
                                </ul>
                          </li>
                          <li><a href="#">sab menu 3</a></li>
                    </ul>
              </li>
        </ul>
      </section> -->
    </div>
    <!-- /page content -->

 
 <?php include("footer.php");?>