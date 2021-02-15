<?php 
include("sidebar.php");

$id = $_REQUEST['id'];
$tablename = $_REQUEST['deltablename'];
$pagename = $_REQUEST['pagename'];
 $Parameter = $_REQUEST['Parameter'];


?>


    <!-- top navigation -->
 <?php include("header.php");?>
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
                 <input type="text" class="form-control" name="companyName" value="">
               </div>
    
                <div class="form-group col-md-6">
                 <label for="email">User Group Id</label>
                 <input type="text" class="form-control" name="userGroup" value="">
               </div>  
                <div class="form-group col-md-6">
                 <label for="email">User first name</label>
                 <input type="text" class="form-control" name="firstname" value=""> 
               </div>
               <div class="form-group col-md-6">
                <label for="email">User middle name</label>
                 <input type="text" class="form-control" name="middlename" value="">
               </div>
               <div class="form-group col-md-6">
                <label for="email">User last name)</label>
                 <input type="text" class="form-control" name="lastname" value="">
               </div>
                 <div class="form-group col-md-6">
                 <label for="email">Email Address</label>
                 <input type="text" class="form-control" name="email" value=""> 
               </div>
               <div class="form-group col-md-6">
                 <label for="email">User contact country code</label>
                 <input type="text" class="form-control" name="countryCode" value="">
               </div>
               <div class="form-group col-md-6">
                <label for="email">User contact area code</label>
                 <input type="text" class="form-control" name="areaCode" value="">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">User contact No</label>
                 <input type="text" class="form-control" name="contactNo" value="">
                </div>

                <div class="col-md-12">
       
                  <button type="submit" name="adduser" value="adduser" class="btn btn-default">Add User</button>
                  <input type="hidden" name="tablename" value="<?php echo $tablename;?>">
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