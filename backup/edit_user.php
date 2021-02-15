<?php 
include("sidebar.php");


$userId = $_REQUEST['UserID'];
$tablename = $_REQUEST['deltablename'];
$pagename = $_REQUEST['pagename'];
   $Parameter = $_REQUEST['Parameter'];
$sql="select * from CompanyUser where User_ID='".$userId."' ";
$sql=mysqli_query($db,$sql);
$row =mysqli_fetch_assoc($sql);


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

		<!-- Due to time constraints, we just direct inject values. User need to key in raw values into the raw table field, this is just a temporary solution to make sure add change delete is working -->
                <div class="form-group col-md-6">


                 <label for="email">Company Name (Company_ID)</label>
                 <input type="text" class="form-control" name="companyName" value="<?php echo $row['Company_ID']; ?>">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">User Group (User_Group_ID)</label>
                 <input type="text" class="form-control" name="userGroup" value="<?php echo $row['User_Group_ID']; ?>">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">User first name</label>
                 <input type="text" class="form-control" name="firstname" value="<?php echo $row['User_first_name']; ?>"> 
                </div>
                <div class="form-group col-md-6">
                  <label for="email">User middle name</label>
                 <input type="text" class="form-control" name="middlename" value="<?php echo $row['User_middle_name']; ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="email">User last name</label>
                 <input type="text" class="form-control" name="lastname" value="<?php echo $row['User_last_name']; ?>">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">Email Address (User_email_address)</label>
                 <input type="text" class="form-control" name="email" value="<?php echo $row['User_email_address']; ?>"> 
               </div>
               <div class="form-group col-md-6">
                 <label for="email">User contact country code</label>
                 <input type="text" class="form-control" name="countryCode" value="<?php echo $row['User_contact_country_code']; ?>">
               </div>
               <div class="form-group col-md-6">
                <label for="email">User contact area code</label>
                 <input type="text" class="form-control" name="areaCode" value="<?php echo $row['User_contact_area_code']; ?>">
                </div>
                <div class="form-group col-md-6"> 
                  <label for="email">User contact No)</label>
                 <input type="text" class="form-control" name="contactNo" value="<?php echo $row['User_contact_contactNo']; ?>">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">User Status (User_Status)</label>
                 <input type="text" class="form-control" name="userstatus" value="<?php echo $row['User_Status']; ?>">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">Number of Password Retries (No_Of_Passsword_Retries)</label>
                 <input type="text" class="form-control" name="passwordretries" value="<?php echo $row['No_Of_Passsword_Retries']; ?>">


               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" class="btn btn-default" name="updateCompany" value="updateCompany" ="">Update</button>
                  <input type="hidden" name="tablename" value="<?php echo $tablename;?>">
                  <input type="hidden" name="userId" value="<?php echo $userId;?>">
                  <input type="hidden" name="pagename" value="<?php echo $pagename;?>">
                  <input type="hidden" name="Parameter" value="<?php echo $Parameter;?>">
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