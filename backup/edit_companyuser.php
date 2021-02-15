<?php 
include("sidebar.php");


$id = $_REQUEST['ID'];
$tablename = $_REQUEST['deltablename'];
$pagename1 = $_REQUEST['pagename'];
$Parameter = $_REQUEST['Parameter'];
$idname = $_REQUEST['idname'];
$Language = "EN"; // Please get the infromation from the Company Language before run this implementation
                  

  

  $sql="SELECT FormConfigurationLanguage.Title,FormConfiguration.Form_Name,FormConfiguration.Logical_Table_Name as pagename,FormConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,FormConfiguration.Shown_Field FROM FormConfiguration INNER JOIN FormConfigurationLanguage ON FormConfiguration.FormConfiguration_ID = FormConfigurationLanguage.FormConfiguration_ID INNER JOIN LogicalTable on FormConfiguration.Logical_Table_Name= LogicalTable.Logical_Table_Name INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID =LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalDefinitionTable.Logical_Table_ID where FormConfiguration.Form_Name='".$Parameter."' and FormConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language ='".$Language."' and FormConfiguration.REC_status = 1 and FormConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";


$sql1=mysqli_query($db,$sql);
$row =mysqli_fetch_assoc($sql1);
 
  $pagename= $row['pagename'];
    $tablename= $row['Logical_Table_Name'];
  //$Field_name = $row['Field_name'];


 $filed = explode(",",$row['Shown_Field']);
//print_r($filed);
$array = [];
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='BratPhase2' AND `TABLE_NAME`='".$tablename."'";
$sql_ex=mysqli_query($db,$sql);
while($row1 = mysqli_fetch_array($sql_ex)){

    $array[]= $row1['COLUMN_NAME']; 
}
array_unshift($array,"");
unset($array[0]);

$array_new = [];
foreach($filed as $key)
{
    if(array_key_exists($key, $array))
    {
        $array_new[$key] = $array[$key];
    }
}
//print_r($array_new);
$newfiled = implode(",",$array_new);
$i=1;
$term_arr=[];
foreach($filed as $row1){
$rowfiled = $row['No_Show_Field'];
$TableName= $tablename; // We need to assign which table do this program will generate from here. There is no relationship between list configuration and logical table in terms of content

  $sql2= "Select * From LogicalDefinitionTable LEFT JOIN LogicalDefinitionTableLanguage ON (LogicalDefinitionTable.Logical_Table_ID = LogicalDefinitionTableLanguage.Logical_Table_ID AND LogicalDefinitionTable.Field_no = LogicalDefinitionTableLanguage.Field_no) LEFT JOIN LogicalTable ON LogicalTable.Logical_Table_ID = LogicalDefinitionTable.Logical_Table_ID WHERE LogicalTable.Logical_Table_Name = '".$TableName."' AND LogicalDefinitionTable.Field_no ='".$row1."' and LogicalDefinitionTableLanguage.Language = '".$Language."' and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";
$sql2=mysqli_query($db,$sql2);
$row2 =mysqli_fetch_assoc($sql2);?>

 
  <?php $term_arr[]=$row2['Field_name'];
 if ($i == $rowfiled) {break;}
 $i++;
}

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
                
       <?php
       $j=0;
      $sqlc="select $newfiled from $tablename where $idname='".$id."'";  
      $sql_ex=mysqli_query($db,$sqlc); 
      $rowc =mysqli_fetch_assoc($sql_ex); 
         
       foreach($array_new as $key=>$value){
       
 
        ?>
                          <div class="form-group col-md-6">
                            <label for="email"><?php echo $term_arr[$j];?></label>
<input type="text" class="form-control" name="name[<?php echo $key?>]" value="<?php echo $rowc[$value] ;?>">
                          </div>
                <?php  $j++;} ?>
                
              
                <div class="col-md-12">
       
        <button type="submit" name="editcompanyuser" value="editcompanyuser" class="btn btn-default">Update Company User</button>
        <input type="hidden" name="tablename" value="<?php echo $tablename;?>">
        <input type="hidden" name="pagename" value="<?php echo $pagename1;?>">
        <input type="hidden" name="Parameter" value="<?php echo  $Parameter;?>">
        <input type="hidden" name="columnname" value="<?php echo $newfiled?>">
        <input type="hidden" name="ID" value="<?php echo $id?>">
        <input type="hidden" name="idname" value="<?php echo $idname?>">
        
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