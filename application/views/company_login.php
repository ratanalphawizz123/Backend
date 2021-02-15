<script src="<?php echo base_url();?>Js/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap.min.css">
<script src="<?php echo base_url();?>Js/bootstrap.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/style.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugin/parsley/parsley.css">
<script src="<?php echo base_url();?>assets/plugin/parsley/parsley.js"></script>
<script> var BASE_URL= "<?php echo base_url();?>"; </script>
<script src="<?php echo base_url();?>Js/custom_ajax.js"></script>
<body> 
   <div class="overlay" style="display:none;"><img src="<?php echo base_url();?>assets/images/loading-gif-png-5.gif" /></div>
   <div id="login">
      <!-- <h3 class="text-center text-white pt-5">Login form</h3> -->
      <div class="container">
         <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
               <div id="login-box" class="col-md-12">
                  <h2>Company Code</h2>
                  <div class="company-data">
                     <div class="err_msg"></div>
                     <form class="form" role="form" id="companyloginsubmit" data-parsley-validate="">
                        <?php   if( isset($_SESSION['error_msg']) ){?>   
                        <p style="color:red;text-align:center"><?php echo $_SESSION['error_msg'];?></p>
                        <?php  unset($_SESSION['error_msg']);
                           }
                           ?> 
                        <div class="form-group">
                           <!-- <label for="username" class="text-info">Company Code</label><br> -->
                           <input type="text" name="companycode" id="companycode" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Please Enter your Company Code" required data-parsley-required-message="Company Code is required">
                        </div>
                        <div class="form-group remember-me">                                    
                           <button id="" class="btn btn-info btn-md" >Submit</button>
                        </div>
                     </form>
                     <div class="form-group save_btn">                                    
                        <input type="submit" name="default" id="default" onclick="saveAsdefalut()" class="btn btn-info btn-md" value="Save as Default Company">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
</body>