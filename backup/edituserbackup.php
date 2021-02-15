<?php 
include("sidebar.php");


$id = $_REQUEST['id'];
$tablename = $_REQUEST['deltablename'];
$pagename = $_REQUEST['pagename'];
   $Parameter = $_REQUEST['Parameter'];
$sql="select * from ".$tablename." where Id='".$id."'";
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
                
                <div class="form-group col-md-6">
                  <label for="email">User Name</label>
                 <input type="text" class="form-control" name="username" value="<?php echo $row['user_name']; ?>">
                                   <label for="email">Email</label>
                 <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">

                    <label for="email">Address 1</label>
                 <input type="text" class="form-control" name="address1" value="<?php echo $row['address1']; ?>"> 
                   <label for="email">Address 2</label>
                 <input type="text" class="form-control" name="address2" value="<?php echo $row['address2']; ?>">  
                   <label for="email">Singapore id no.</label>
                 <input type="text" class="form-control" name="Singapore_id_no" value="<?php echo $row['Singapore_id_no']; ?>">  
                   <label for="email">Father Name</label>
                 <input type="text" class="form-control" name="father_name" value="<?php echo $row['father_name']; ?>">  
                   <label for="email">Mother Name</label>
                 <input type="text" class="form-control" name="mother_name" value="<?php echo $row['mother_name']; ?>">  
                   <label for="email">Sister Name</label>
                 <input type="text" class="form-control" name="sister_name" value="<?php echo $row['sister_name']; ?>">                
               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" class="btn btn-default" name="update" value="update" ="">Update</button>
                  <input type="hidden" name="tablename" value="<?php echo $tablename;?>">
                  <input type="hidden" name="id" value="<?php echo $id;?>">
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