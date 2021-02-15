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
                  

$sql="SELECT ListConfiguration.List_Name,ListConfiguration.Logical_Table_Name as pagename,ListConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,ListConfiguration.Shown_Field FROM  ListConfiguration INNER JOIN ListConfigurationLanguage ON ListConfiguration.ListConfiguration_ID = ListConfigurationLanguage.ListConfiguration_ID INNER JOIN LogicalTable on LogicalTable.Logical_Table_Name = ListConfigurationLanguage.Title INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID = LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalTable.Logical_Table_ID
  where ListConfiguration.List_Name='".$Parameter."' and ListConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language ='".$Language."' and ListConfiguration.REC_status = 1 and ListConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";

$sql=mysqli_query($db,$sql);
$row =mysqli_fetch_assoc($sql);
 $row['no_fields'];
 $tablename = $row['Logical_Table_Name'];
 $pagename= $row['pagename'];


 $filed = explode(",",$row['Shown_Field']);

?>
<h2 class="table_head"><?php echo $row['Logical_Table_Description']; ?></h2>
                    <table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<?php 
$i=1;
foreach($filed as $row1){
$rowfiled = $row['No_Show_Field'];
$TableName= "User Group"; // We need to assign which table do this program will generate from here. There is no relationship between list configuration and logical table in terms of content

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
                              $filed = implode(",",$term_arr);
       //$sql3= "SELECT ".$filed." from ".$tablename." where REC_status='1'";
    $sql3="SELECT CompanyUserGroup.Company_ID, CompanyUserGroup.User_Group_ID, Company.Company_Description, CompanyUserGroup.User_Group_Name, CompanyUserGroup.User_Role_Description From CompanyUserGroup LEFT JOIN Company on Company.Company_ID = CompanyUserGroup.Company_ID";                          
$sql3=mysqli_query($db,$sql3);

                                while($row3 = mysqli_fetch_row($sql3)){ 
                              
                                  ?>
                                <tr> 
                          <?php for($i=2; $i < count($row3);$i++){
                              if($i == 2){ 
                              $companyID = $row3[0];
                              $userGroupID = $row3[1];
                              } // This is get the Company_ID and User_Group_ID from the CompanyUserGroup table 
                            ?>
                                  <td class="text-center"><?php echo $row3[$i]; ?></td>
                                  <?php } ?>
                                  <td class="text-center">
      <a  href="edit_usergroup.php?CompanyID=<?php echo $companyID ?>&userGroupID=<?php echo $userGroupID ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>"><i class="fa fa-edit"></i></a>
        <a href="delete.php?CompanyID=<?php echo $companyID ?>&userGroupID=<?php echo $userGroupID ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>"><i class="fa fa-trash"></i></a>
                                  </td> 
                                </tr>
                            <?php  } ?>
                        </tbody>
                        <a href="add_usergroup.php?deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>" class="add_button">+</a>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     
    </div>
  

 
  <?php include("footer.php");?>