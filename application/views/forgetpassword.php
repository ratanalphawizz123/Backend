
<script src="<?php echo base_url();?>Js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<!--<link rel="stylesheet" href="<?php echo base_url();?>assets/style.css">-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/parsley/parsley.css">
<script src="<?php echo base_url();?>assets/plugin/parsley/parsley.js"></script>
<script>
    var BASE_URL= "<?php echo base_url();?>";
</script>
 
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
.overlay_msg img {
    margin: 17% auto;
    display: block;
    width: 60px;
}
.overlay_msg {
    position: absolute;
    background: rgba(0,0,0,.5);
    top: 0px;
    right: 0px;
    left: 0px;
    height: 100%;
    width: 100%;
}
</style>

<body>
    <!--<div class="overlay" style="display:none;"><img src="<?php echo base_url();?>assets/images/loading-gif-png-5.gif" /></div>-->
    

    <div id="login">
        <!-- <h3 class="text-center text-white pt-5">Login form</h3> -->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">                    
                    <div id="login-box" class="col-md-12">                          
                          <form id="changePassword" class="form"  data-parsley-validate="">
                               <div class="err_msg"></div>
                                <h3 class="text-center text-info">ChangePassword</h3>
                                
                                <div class="form-group">
                                    <label for="username" class="text-info">New Password:</label><br>
                                    <input type="password" name="newpassword" id="newpassword" class="form-control" required data-parsley-required-message="New Password is required">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Confirm Password:</label><br>
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" >
                                </div>
                                <div class="form-group remember-me"> 
                                    <?php
                                     $result=Get_First_login_Flag();
                                     $First_login_flag=!empty($result[0]['First_login_flag']) ? $result[0]['First_login_flag']:'';
                                       if($First_login_flag==1){
                                          ?>
                                          <input type="submit" name="submit" class="btn btn-info btn-md" value="Update">
                                          <input type="hidden" name="defaultpass" class="btn btn-info btn-md" value="Update">
                                          <?php }else{?>
                                           <input type="submit" name="submit" class="btn btn-info btn-md" value="Update">
                                           <input type="hidden" name="changepass" class="btn btn-info btn-md" value="Update">
                                          <?php } ?>
                                          <?php  $authorization = get_session('authorization');?>
                                    
                                </div>                            
                            </form>                        
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
         $(function () {
        $('#changePassword').bind('submit', function () {
        var token="<?php echo $authorization;?>";
         var form = new FormData($('#changePassword')[0]);
          $.ajax({
            type: 'post',
            url: BASE_URL+'Home/ForgetPasswordAction',
            headers: { 'X-Requested-With': token},
            contentType: false,
            processData:false,
            data: form,
             beforeSend:function(){
             //$('body').css('z-index', 99999999999);
             var img_url=BASE_URL+'assets/images/loading-gif-png-5.gif';
             $('body').append('<div class="overlay_msg"><img src='+img_url+' /></div>');
             //$('.overlay').show();
            },
            success: function(response){
					//console.log(response);
					var data = JSON.parse(response);
					$('.overlay_msg').hide();
					if(data.status === true){
					    $('.err_msg').html('<p class="alert alert-success">'+data.message+'<p>');
				//	window.location.href = BASE_URL+"Dashboard/welcome";   
					}else{
					   $('.overlay_msg').hide();
					   $('.err_msg').html('<p class="alert alert-danger">'+data.message+'<p>');
					}
				}
			
          });
          return false;
        });
        
      });
</script>
