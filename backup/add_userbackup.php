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
                
                <div class="form-group col-md-6">
                  <label for="email">User Name</label>
                 <input type="text" class="form-control" name="username" value="">
                                   <label for="email">Email</label>
                 <input type="text" class="form-control" name="email" value="">

                    <label for="email">Address 1</label>
                 <input type="text" class="form-control" name="address1" value=""> 
                   <label for="email">Address 2</label>
                 <input type="text" class="form-control" name="address2" value="">  
                   <label for="email">Singapore id no.</label>
                 <input type="text" class="form-control" name="Singapore_id_no" value="">  
                   <label for="email">Father Name</label>
                 <input type="text" class="form-control" name="father_name" value="">  
                   <label for="email">Mother Name</label>
                 <input type="text" class="form-control" name="mother_name" value="">  
                   <label for="email">Sister Name</label>
                 <input type="text" class="form-control" name="sister_name" value="">                
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