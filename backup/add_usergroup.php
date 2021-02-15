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
                 <label for="email">Company will based in (User_Group_Name)</label>
                 <input type="text" class="form-control" name="userGroupName" value="">
                 <label for="email">Company Address (User_Role_Description)</label>
                 <input type="text" class="form-control" name="userGroupDescription" value=""> 
     
               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" name="addusergroup" value="addusergroup" class="btn btn-default">Add Company</button>
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