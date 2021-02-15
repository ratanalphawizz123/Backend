 <?php include("sidebar.php"); ?>  
    <!-- top navigation -->
<?php include("header.php"); ?>
    <!-- /top navigation -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="welcome">
        <div class="container-fluid">
          <div class="row">
           <div class="col-md-12">
              <div class="content Employees">
                <h2><?php echo $Configrow['Title'];?></h2>                
                <div class="material-datatables table-responsive">

                  <?php 
                  $Parameter = $_REQUEST['Parameter'];
                  $Language = "EN"; // Please get the infromation from the Company Language before run this implementation
                  

/*$sql="SELECT ListConfigurationLanguage.Title,ListConfiguration.List_Name,ListConfiguration.Logical_Table_Name as pagename,ListConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,ListConfiguration.Shown_Field FROM  ListConfiguration INNER JOIN ListConfigurationLanguage ON ListConfiguration.ListConfiguration_ID = ListConfigurationLanguage.ListConfiguration_ID INNER JOIN LogicalTable on LogicalTable.Logical_Table_Name = ListConfigurationLanguage.Title INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID = LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalTable.Logical_Table_ID
  where ListConfiguration.List_Name='".$Parameter."' and ListConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language ='".$Language."' and ListConfiguration.REC_status = 1 and ListConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";*/


   $sql="SELECT ListConfigurationLanguage.Title,ListConfiguration.List_Name,LogicalTable.Logical_table_php_name as pagename,ListConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,ListConfiguration.Shown_Field FROM ListConfiguration INNER JOIN ListConfigurationLanguage ON ListConfiguration.ListConfiguration_ID = ListConfigurationLanguage.ListConfiguration_ID INNER JOIN LogicalTable on ListConfiguration.Logical_Table_Name= LogicalTable.Logical_Table_Name INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID =LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalDefinitionTable.Logical_Table_ID where ListConfiguration.List_Name='".$Parameter."' and ListConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language ='".$Language."' and ListConfiguration.REC_status = 1 and ListConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1"; 





$sql=mysqli_query($db,$sql);
$row =mysqli_fetch_assoc($sql);
 $row['no_fields'];
$tablename = $row['Logical_Table_Name'];
$pagename= $row['pagename'];


 $filed = explode(",",$row['Shown_Field']);

?>
<h2 class="table_head"><?php echo $row['Title']; ?></h2>
                    <table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<?php 
$i=1;
foreach($filed as $row1){
$rowfiled = $row['No_Show_Field'];
$TableName= $tablename; // We need to assign which table do this program will generate from here. There is no relationship between list configuration and logical table in terms of content

  $sql2= "Select * From LogicalDefinitionTable LEFT JOIN LogicalDefinitionTableLanguage ON (LogicalDefinitionTable.Logical_Table_ID = LogicalDefinitionTableLanguage.Logical_Table_ID AND LogicalDefinitionTable.Field_no = LogicalDefinitionTableLanguage.Field_no) LEFT JOIN LogicalTable ON LogicalTable.Logical_Table_ID = LogicalDefinitionTable.Logical_Table_ID WHERE LogicalTable.Logical_Table_Name = '".$TableName."' AND LogicalDefinitionTable.Field_no ='".$row1."' and LogicalDefinitionTableLanguage.Language = '".$Language."' and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";
$sql2=mysqli_query($db,$sql2);
$row2 =mysqli_fetch_assoc($sql2);?>

 <th><?php echo $row2['Field_name'];?></th> 
  <?php $term_arr[]=$row2['Field_name'];
   
 if ($i == $rowfiled) {break;}
 $i++;
}?>

                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              //$filed = implode(",",$term_arr);
                              $filed = explode(",",$row['Shown_Field']);
       $array = [];
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='BratPhase2' AND `TABLE_NAME`='".$TableName."'";
$sql_ex=mysqli_query($db,$sql);
while($row1 = mysqli_fetch_array($sql_ex)){

    $array[]= $TableName.'.'.$row1['COLUMN_NAME']; 
}  
array_unshift($array,"");
unset($array[0]);
$array_new = [];
$idname = $array[1];
foreach($filed as $key)
{

    if(array_key_exists($key, $array))
    {
        $array_new[$key] = $array[$key];
       //unset($array_new[0]); 
    }
}
                $newfiled = implode(",",$array_new);

       $sql3="SELECT $newfiled From $TableName where $TableName.REC_status='1'";                          
$sql3=mysqli_query($db,$sql3);

   while($row3 = mysqli_fetch_row($sql3)){ 
                              
                                  ?>
                                <tr> 

                          <?php 
foreach($row3 as $column) {
 $id = $row3[0];

  ?>
       <td class="text-center"><?php echo $column; ?></td>
    <?php }
  ?>
                                  <td class="text-center">
      <a  href="edit_companyuser.php?ID=<?php echo $id; ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>&idname=<?php echo $idname;?>"><i class="fa fa-edit"></i></a>
        <a href="delete.php?ID=<?php echo $id; ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>&idname=<?php echo $idname;?>"><i class="fa fa-trash"></i></a>
                                  </td> 
                                </tr>
                            <?php  } ?>
                        </tbody>
                        <a href="add_companyuser.php?deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>" class="add_button">+</a>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     
    </div>
  

 
  <?php include("footer.php");?>