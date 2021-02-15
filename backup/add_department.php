<?php include("sidebar.php");

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
                
                <div class="form-group col-md-6">
                  <label for="email">Department name</label>
                 <input type="text" class="form-control" name="department_name" value="">

                  <label for="email">Select USer</label>
                 <select class="form-control" name="user" >
                  <option value="">Select User</option>
                  <?php
                  $sql="select * from user where REC_lastUpdate_by='".$_SESSION['UserData']['Company_ID']."'";
                  $sql_ex=mysqli_query($db,$sql);
                  while($row = mysqli_fetch_assoc($sql_ex)){  
                  ?>
                  <option value="<?php echo $row['Id']; ?>"><?php echo $row['user_name']; ?></option>
                <?php } ?>
                 </select>            
               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" name="updatesalary" value="updatesalary" class="btn btn-default">Add Department</button>
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