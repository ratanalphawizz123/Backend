<?php include("Database/Config.php");
      session_start();

/*if(isset($_REQUEST['back'])){


  setcookie("type", '', time()-3600);
       
}

elseif(isset($_COOKIE["type"]))
{
   $val=  $_COOKIE["type"];
    
header("location:checkcompanycode.php?companycode=".$val."&submit=submit");
}
*/

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="assets/style.css">
<script src="Js/custom_ajax.js"></script>

<style type="text/css">
 


label.text-info {
    font-size: 20px;
    font-weight: 500;
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



</style>

<body>
    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">Login form</h3> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                            <h2>Company Code</h2>
                            <div class="company-data">
                          <form class="form" role="form" id="companyloginsubmit">                                
                                <?php   if( isset($_SESSION['error_msg']) )
{
     ?>   <p style="color:red;text-align:center"><?php echo $_SESSION['error_msg'];?></p>
 
<?php  unset($_SESSION['error_msg']);

}
    ?> 
                                <div class="form-group">
                                    <!-- <label for="username" class="text-info">Company Code</label><br> -->
                                    <input type="text" name="companycode" id="companycode" class="form-control" placeholder="Please Enter your Company Code" required>
                                </div>                                
                                <div class="form-group remember-me">                                    
                                    
                                    <button id="" class="btn btn-info btn-md" >Submit</button>
                                    
                                </div> 
                                <div class="form-group save_btn">                                    
                                    <input type="submit" name="default" class="btn btn-info btn-md" value="Save as Default Company">
                                    
                                </div>                            
                            </form>  
                            </div>                      
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
