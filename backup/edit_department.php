<?php include("sidebar.php");

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
                  <label for="email">Department Name</label>
                 <input type="text" class="form-control" name="department_name" value="<?php echo $row['department_name']; ?>">
                                                   
               </div>
              
                <div class="col-md-12">
       
                  <button type="submit" class="btn btn-default" name="updatedepart" value="updatedepart" ="">Update</button>
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