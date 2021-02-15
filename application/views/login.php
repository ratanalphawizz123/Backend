<script src="<?php echo base_url();?>Js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/parsley/parsley.css">
<script src="<?php echo base_url();?>assets/plugin/parsley/parsley.js"></script>
<script>
    var BASE_URL= "<?php echo base_url();?>";
</script>
<script src="<?php echo base_url();?>Js/custom_ajax.js"></script>

<body>
    
 <div class="overlay" style="display:none;"><img src="<?php echo base_url();?>assets/images/loading-gif-png-5.gif" /></div>
    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">Login form</h3> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <p>version: 1.1.3</p>
                    <?php
                        
                        $getSession= get_session('UserData');
                        
                        //print_r($getSession);
                       
                        
                        ?>
                    <div class="logo_box">
                        <img src="../assets/images/<?php
                        
                        echo !empty($getSession[0]['Company_Logo']) ? $getSession[0]['Company_Logo'] :'' ;?>">
                    </div>
                    <div id="login-box" class="col-md-12 login_pages">
                          <h2>User Login</h2>
                          <div class="company-data">
                               <div class="err_msg"></div>
                          <form id="companyLogin" class="form" data-parsley-validate="">
                          
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input type="text" name="useremail" id="useremail" class="form-control" required data-parsley-required-message="Username is required">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input type="password" name="password" id="password" class="form-control" required data-parsley-required-message="Password is required">
                                    <input type="hidden" name="userlogin" id="userlogin" class="form-control" value="<?php echo $getSession[0]['Company_ID'];?>">
                                    
                                </div>
                                <div class="form-group remember-me">
                                    <!--<label for="remember-me" class="text-info"><span><input id="remember-me" name="remember-me" type="checkbox"></span> <span>Remember me</span>�</label><br>-->
                                    <!--<input type="submit" name="submit" id="submit" class="btn btn-info btn-md" value="Login">-->
                                    <button id="" class="btn btn-info btn-md" >Login</button>
                                    
                                    <a href="<?php echo base_url();?>home/index/back" class="btn btn-info btn-md back_company">Back to Company</a>
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

