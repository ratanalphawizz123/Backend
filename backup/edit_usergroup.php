<?php 
include("sidebar.php");


$companyid = $_REQUEST['CompanyID'];
$usergroupid = $_REQUEST['userGroupID'];
$tablename = $_REQUEST['deltablename'];
$pagename = $_REQUEST['pagename'];
   $Parameter = $_REQUEST['Parameter'];
$sql="SELECT CompanyUserGroup.*, Company.Company_Description FROM CompanyUserGroup LEFT JOIN Company ON CompanyUserGroup.Company_ID = Company.Company_ID where CompanyUserGroup.Company_ID=".$companyid." and CompanyUserGroup.User_Group_ID=".$usergroupid." ";
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


                 <label for="email">Company Name : <?php echo $row['Company_Description']; ?></label>
                 <label for="email">Company will based in (User_Group_Name)</label>
                 <input type="text" class="form-control" name="userGroupName" value="<?php echo $row['User_Group_Name']; ?>">
               </div>
               <div class="form-group col-md-6">
                 <label for="email">Company Address (User_Role_Description)</label>
                 <input type="text" class="form-control" name="userGroupDescription" value="<?php echo $row['User_Role_Description']; ?>"> 
     

               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" class="btn btn-default" name="updateCompany" value="updateCompany" ="">Update</button>
                  <input type="hidden" name="tablename" value="<?php echo $tablename;?>">
                  <input type="hidden" name="companyid" value="<?php echo $companyid;?>">
                  <input type="hidden" name="usergroupid" value="<?php echo $usergroupid;?>">
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