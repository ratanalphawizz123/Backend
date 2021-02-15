<?php 
include("sidebar.php");


$sql="SELECT * from CompanyUser where Company_ID='".$_SESSION['UserData']['Company_ID']."' and User_email_address='".$_SESSION['User_email']."'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);


?>




    <!-- top navigation -->
<?php  include("header.php");?>
    <!-- /top navigation -->

    <!-- page content -->
   <div class="right_col" role="main">
      <div class="welcome">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="content edit-company">
                <div class="material-datatables edit_field">
                <form action="./process.php" method="post">
                 <?php   if( isset($_SESSION['error_msg']) )
{
     ?>   <p style="color:red;text-align:center"><?php echo $_SESSION['error_msg'];?></p>

<?php        unset($_SESSION['error_msg']);

}
    ?>  
                <div class="form-group col-md-6">
                  <label for="email">User Name</label>
                 <input type="text" class="form-control" name="username" value="<?php echo $row['User_first_name']; ?>">
                                   <label for="email">Middle Name</label>
                 <input type="text" class="form-control" name="middlename" value="<?php echo $row['User_middle_name']; ?>">

                    <label for="email">Last Name</label>
                 <input type="text" class="form-control" name="lastname" value="<?php echo $row['User_last_name']; ?>"> 
                   <label for="email">Conatct No</label>
                 <input type="text" class="form-control" name="contno" value="<?php echo $row['User_contact_contactNo']; ?>">  
                         
               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" class="btn btn-default" name="userupdate" value="update" ="">Update</button>
               
                </div>
              </form>
              
            </div>
          </div>              
        </div>
      </div>
    </div>
  </div>
  </div>
    <!-- /page content -->

 
  <?php include("footer.php");?>