<?php
$base_url = base_url();
?>

 <?php
$authorization='0';
if (!empty(get_session('authorization')))
{
 $authorization = get_session('authorization');
}
?>


<script>

window.onload = function(){
    var base_url="<?php echo $base_url; ?>";
    if (document.cookie.indexOf("_instance=true") === -1) {
    document.cookie = "_instance=true";
    // Set the onunload function
    window.onunload = function(){
        document.cookie ="_instance=true;expires=Thu, 01-Jan-1970 00:00:01 GMT";
    };
    // Load the application
     <?php
if (empty(get_session('useremail')))
{
?> 

       window.location.href=base_url+'Dashboard/Logout';
       <?php
}
?>
    }
    else {
   var base_url="<?php echo $base_url; ?>";
   window.location.href=base_url+'Dashboard/Logout';
    
    // Notify the user
    }
    };
    //Base Url
    var BASE_URL= "<?php echo base_url(); ?>";
     //auth token
     var AUTH_TOKEN= "<?php echo $authorization; ?>";
</script>

<?php
if (isLoginSessionExpired() == true)
{

echo '<script>alert("Session Terminated");'; 
echo "window.location.href=BASE_URL+'Dashboard/Logout';";
echo '</script>';

}
?>


 <div class="top_nav">
      <div class="nav_menu">
        <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <i class="fa fa-align-right"></i>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
            <!-- <div style="margin-left:100%">
              <div id="google_translate_element"></div>
            </div> -->
          </div>
          <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav">
              <li class="dropdown">
                  <!--<a href="<?php echo $base_url;?>/Dashboard/Logout"  role="button" aria-haspopup="true" aria-expanded="false">Log out</a>-->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="my_account.php"><i class="fa fa-user-o fw"></i> My account</a></li>
                   <li><a href="<?php echo base_url(); ?>home/forgetpassword"><i class="fa fa-user-o fw"></i> Change Password/a></li>
                  <li><a href="<?php echo base_url(); ?>Dashboard/Logout"><i class="fa fa-sign-out"></i>Log out</a></li>
                </ul>
              </li>
              <!-- <li><a href="#"><i class="fa fa-comments"></i><span>23</span></a></li>
              <li><a href="#"><i class="fa fa-bell-o"></i><span>98</span></a></li> -->
              <!-- <li><a href="#"><i data-show="show-side-navigation1" class="fa fa-bars show-side-btn"></i></a></li> -->
            </ul>
          </div>
        </div>
      </nav>
      </div>
    </div>
