<?php include("Database/Config.php");
      session_start();
    
?>
                                                             
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="Js/custom_ajax.js"></script>

<link rel="stylesheet" href="assets/style.css">

<style type="text/css">

div#login-column{
    width: auto;
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
                    <p>version: 1.1.3</p>
                    <div class="logo_box">
                        <img src="assets/images/<?php echo $_SESSION['UserData']['Company_Logo'];?>">
                    </div>
                    <div id="login-box" class="col-md-12 login_pages">
                          <h2>User Login</h2>
                          <div class="company-data">
                          <form id="login-form" class="form" >
                            <?php   if( isset($_SESSION['error_msg']) )
{
     ?>   <p style="color:red;text-align:center"><?php echo $_SESSION['error_msg'];?></p>

<?php        unset($_SESSION['error_msg']);

}
    ?> 
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <input type="hidden" name="userlogin" id="userlogin" class="form-control" value="1">
                                </div>
                                <div class="form-group remember-me">
                                    <label for="remember-me" class="text-info"><span><input id="remember-me" name="remember-me" type="checkbox"></span> <span>Remember me</span>�</label><br>
                                    <input type="submit" name="submit" id="submit" class="btn btn-info btn-md" value="Login">
                                    <a href="index.php?back=back" class="btn btn-info btn-md back_company">Back to Company</a>
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

