<?php include("Database/Config.php");
      session_start();
include("functions.php");
if(isset($_SESSION["User_email"])) {
  if(isLoginSessionExpired()) {

echo '<script>alert("Session Terminated");'; 
echo 'window.location.href = "logout.php?session_expired=1";';
echo '</script>';
    //header("Location:logout.php?session_expired=1");
  }
}
/*if(isset($_SESSION["user_id"])) {
    if(!isLoginSessionExpired()) {
        header("Location:welcome.php");
    } else {
        echo '<script>alert("Session Terminated");'; 
echo 'window.location.href = "logout.php?session_expired=1";';
echo '</script>';
    }
}*/
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

 
<style type="text/css">

div#login-column {
    margin-top: 7%;
    text-align: center;
}
div#login-column{
    width: auto;
}
div#login-box {
    box-shadow: 0px 3px 10px #ccc;
    padding: 10px 20px;
    background: #fff;
}  
div#login {
    background: #f3f3f3;
    height: 100vh;
}
.text-white {
    color: #000!important;
    margin-bottom: 20px;
}

.form-group.remember-me {
    text-align: center;
}
.nav-tabs .nav-item {
    margin-bottom: -1px;
    width: 50%;
    text-align: center;
}
.nav-tabs .nav-link {
    font-weight: bold;
}
li.nav-item a.nav-link.active {
    border: none;
    border-bottom: 2px solid #17a2b8;
    color: #17a2b8;
}
.tab-content {
    padding-top: 20px;
}
.nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
    border-color: none !important; 
}
.form-group {
    margin-bottom: 1rem;
    text-align: left;
}

.form-control {
    border-radius: 25px;
}
.logo_box {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    display: block;
    margin: 0px auto 30px;
    background: #fff;
    line-height: 120px;
}
.logo_box img {
    width: 100%;
    margin-top: 20px;
    border-radius: 50%;
}
</style>

<body>
    

    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">Login form</h3> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">                    
                    <div id="login-box" class="col-md-12">                          
                          <form id="login-form" class="form" action="process.php" method="post">
                                <h3 class="text-center text-info">ChangePassword</h3>

                                                              <?php   if( isset($_SESSION['error_msg']) )
{
     ?>   <p style="color:red;text-align:center"><?php echo $_SESSION['error_msg'];?></p>

<?php        unset($_SESSION['error_msg']);

}
    ?>  
                                
                                <div class="form-group">
                                    <label for="username" class="text-info">New Password:</label><br>
                                    <input type="password" name="newpassword" id="newpassword" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Confirm Password:</label><br>
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" required>
                                </div>
                                <div class="form-group remember-me"> 

                               <?php 
                                $_SESSION['UserData']['Company_ID'];
        $sql = "SELECT First_login_flag FROM Company WHERE Company_ID = '".$_SESSION['UserData']['Company_ID']."'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      if($row['First_login_flag']==1){
      ?>
       <input type="submit" name="defaultpass" class="btn btn-info btn-md" value="Update">
      <?php }else{?>
<input type="submit" name="changepass" class="btn btn-info btn-md" value="Update">
      <?php } ?>
                                   
                                    
                                </div>                            
                            </form>                        
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

