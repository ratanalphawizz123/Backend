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
                <div class="material-datatables">

                  <?php 
                  $Parameter = $_REQUEST['Parameter'];
                  $Language = "EN"; // Please get the infromation from the Company Language before run this implementation
                  

$sql="SELECT ListConfiguration.List_Name,ListConfiguration.Logical_Table_Name as pagename,ListConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,ListConfiguration.Shown_Field FROM  ListConfiguration INNER JOIN ListConfigurationLanguage ON ListConfiguration.ListConfiguration_ID = ListConfigurationLanguage.ListConfiguration_ID INNER JOIN LogicalTable on LogicalTable.Logical_Table_Name = ListConfigurationLanguage.Title INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID = LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalTable.Logical_Table_ID
  where ListConfiguration.List_Name='".$Parameter."' and ListConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language = 'EN' and ListConfiguration.REC_status = 1 and ListConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";

$sql=mysqli_query($db,$sql);
$row =mysqli_fetch_assoc($sql);
 $row['no_fields'];
 $tablename = $row['Logical_Table_Name'];
 $pagename= $row['pagename'];


 $filed = explode(",",$row['Shown_Field']);

?>
<center><?php echo $row['Logical_Table_Description']; ?></center>
                    <table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
                        <thead>
                            <tr>
<?php 
$i=1;
foreach($filed as $row1){

$rowfiled = $row['No_Show_Field'];
$TableName = "Company" // This is hard coded inside the php file as Logical Table name is independent to the List configuration table in terms of content

$sql2= "SELECT * from LogicalDefinitionTable INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTable.Logical_Table_ID=LogicalDefinitionTableLanguage.Logical_Table_ID where LogicalDefinitionTableLanguage.Field_no = '".$row1."'";

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
    $sql3="SELECT Company.Company_Description, Country.Country_Name, Concat(COALESCE(Company.Company_Billing_Address_Line1,''), ' ', COALESCE(Company.Company_Billing_Address_Line2,''), ' ', COALESCE(Company.Company_Billing_Address_City,''), ' ', COALESCE(State.State_Name,''), ' ', COALESCE(Countryaddress.Country_Name,''), ' ', COALESCE(Company.Company_Billing_PostalCode,'')) as address, Company.Company_contact_person, Company.Company_contact_email, Concat(COALESCE(Company.Company_contact_country_code,''), ' ', COALESCE(Company.Company_contact_area_code,''), ' ', COALESCE(Company.Company_contact_contactNo,'')) as contact_no, Company.Company_Registration_number, Company_Bank_payment_Link_Info, Company.Company_Logo, Language.Language, Concat(COALESCE(CompanyUser.User_first_name,''), ' ', COALESCE(CompanyUser.User_middle_name,''), ' ', COALESCE(CompanyUser.User_last_name,'')) as relationship_manager, Company.First_login_flag, Company.Force_change_password_days, Company.No_of_retries_allowed, Company.Check_Last_5_Passwords, Company.Minimum_length_of_password, Company.Compulsory_upper_case, Company.Compulsory_numeric, Company.Compulsory_special_character, Company.Automatic_SignOnActivity_Lockout, Company.Automatic_NoActivity_logout_time From Company Left JOIN Language on Company.Company_Language = Language.Language_Code Left JOIN Country ON Company.Country_Code = Country.Country_Code LEFT JOIN CompanyUser On Company.Relationship_Manager_ID = CompanyUser.User_ID LEFT Join Country as Countryaddress on Company.Company_Billing_Address_Country = Countryaddress.Country_Code LEFT JOIN State On Company_Billing_Address_State = State.State_Code";                          
$sql3=mysqli_query($db,$sql3);

                                while($row3 = mysqli_fetch_row($sql3)){ 
                              
                                  ?>
                                <tr> 
                          <?php for($i=0; $i < count($row3);$i++){
                              if($i == 0){ $empID = $row3[0];} 
                            ?>
                                  <td class="text-center"><?php echo $row3[$i]; ?></td>
                                  <?php } ?>
                                  <td class="text-center">
      <a  href="edituser.php?id=<?php echo $empID ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>"><i class="fa fa-edit"></i></a>
        <a href="delete.php?id=<?php echo $empID ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>"><i class="fa fa-trash"></i></a>
                                  </td> 
                                </tr>
                            <?php  } ?>
                        </tbody>
                        <a href="add_user.php?deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>" class="add_button">+</a>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>

     
    </div>
  

 
  <?php include("footer.php");?>