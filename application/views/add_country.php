<?php 
 $obj= new Config();
 $db= $obj->connect();

//$id = $_REQUEST['id'];

$tablename = !empty($_REQUEST['deltablename']) ? $_REQUEST['deltablename'] :'';
$pagename1 = !empty($_REQUEST['pagename']) ? $_REQUEST['pagename'] :'';
$Parameter = !empty($_REQUEST['Parameter']) ? $_REQUEST['Parameter'] :'';


$Language = "EN"; // Please get the infromation from the Company Language before run this implementation
                  

  /*$sql="SELECT FormConfigurationLanguage.Title,FormConfiguration.Form_Name,FormConfiguration.Logical_Table_Name as pagename,FormConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,FormConfiguration.Shown_Field,LogicalDefinitionTableLanguage.Field_name FROM  FormConfiguration INNER JOIN FormConfigurationLanguage ON FormConfiguration.FormConfiguration_ID = FormConfigurationLanguage.FormConfiguration_ID INNER JOIN LogicalTable on LogicalTable.Logical_Table_Name = FormConfigurationLanguage.Title INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID = LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalTable.Logical_Table_ID
  where FormConfiguration.Form_Name='".$Parameter."' and FormConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language ='".$Language."' and FormConfiguration.REC_status = 1 and FormConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";*/

  $sql="SELECT FormConfigurationLanguage.Title,FormConfiguration.Form_Name,FormConfiguration.Logical_Table_Name as pagename,FormConfiguration.No_Show_Field, LogicalTable.Logical_Table_Name,LogicalTable.Logical_Table_Description,FormConfiguration.Shown_Field FROM FormConfiguration INNER JOIN FormConfigurationLanguage ON FormConfiguration.FormConfiguration_ID = FormConfigurationLanguage.FormConfiguration_ID INNER JOIN LogicalTable on FormConfiguration.Logical_Table_Name= LogicalTable.Logical_Table_Name INNER JOIN LogicalDefinitionTable ON LogicalDefinitionTable.Logical_Table_ID =LogicalTable.Logical_Table_ID INNER JOIN LogicalDefinitionTableLanguage ON LogicalDefinitionTableLanguage.Logical_Table_ID= LogicalDefinitionTable.Logical_Table_ID where FormConfiguration.Form_Name='".$Parameter."' and FormConfigurationLanguage.Language = '".$Language."' and LogicalDefinitionTableLanguage.Language ='".$Language."' and FormConfiguration.REC_status = 1 and FormConfigurationLanguage.REC_status = 1 and LogicalTable.REC_status = 1 and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";


$sql1=mysqli_query($db,$sql);
$row =mysqli_fetch_assoc($sql1);
 
  $pagename= $row['pagename'];
    $tablename= $row['Logical_Table_Name'];
  //$Field_name = $row['Field_name'];


 $filed = explode(",",$row['Shown_Field']);
//print_r($filed);
$array = [];
$sql="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='alphafk6_phase2brat' AND `TABLE_NAME`='".$tablename."'";
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
$Field_Type =[];
foreach($filed as $row1){
$rowfiled = $row['No_Show_Field'];
$TableName= $tablename; // We need to assign which table do this program will generate from here. There is no relationship between list configuration and logical table in terms of content

  $sql2= "Select * From LogicalDefinitionTable LEFT JOIN LogicalDefinitionTableLanguage ON (LogicalDefinitionTable.Logical_Table_ID = LogicalDefinitionTableLanguage.Logical_Table_ID AND LogicalDefinitionTable.Field_no = LogicalDefinitionTableLanguage.Field_no) LEFT JOIN LogicalTable ON LogicalTable.Logical_Table_ID = LogicalDefinitionTable.Logical_Table_ID WHERE LogicalTable.Logical_Table_Name = '".$TableName."' AND LogicalDefinitionTable.Field_no ='".$row1."' and LogicalDefinitionTableLanguage.Language = '".$Language."' and LogicalDefinitionTable.REC_status = 1 and LogicalDefinitionTableLanguage.REC_status = 1";
$sql2=mysqli_query($db,$sql2);
$row2 =mysqli_fetch_assoc($sql2);

$Field_Type[] = $row2['Field_Type'];
$Field_Validation[] = $row2['Field_Validation']; 
$Validation_type[] = $row2['Validation_type']; 
$Validation_parameter[] = $row2['Validation_parameter'];
//$Program_validation[] = $row2['Program_validation']; 

?>
  <?php $term_arr[]=$row2['Field_name'];
 if ($i == $rowfiled) {break;}
 $i++;
}

?>
   <!-- page content -->
    <?php   if( isset($_SESSION['error_msg']) )
{
     ?>   <p style="color:red;text-align:center"><?php 
$msg[] = $_SESSION['error_msg'];
//print_r($_SESSION['error_msg']);
//echo $filed1 = explode(",",$msg);
     ?></p>
     

<?php        unset($_SESSION['error_msg']);

}
    ?> 
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
       $k=1;
 //$datatype = array("key1"=>"varchar","key2"=>"int","key3"=>"max_min");
 //$datatype1 = json_encode($datatype);
 //$datatypeval = array("varchar"=>"#[A-Z]+#", "int"=>"#[0-9]+#", "max_min"=>"/^[0-9]{7,9}$/i");
 //$datatypeval1 = json_encode($datatypeval);
 //$datatypeval2 = array("varchar"=>"Only Allow Capital letters", "int"=>"Only Allow Integer Value", "max_min"=>"max and min val");  
//$datatypeval22 = json_encode($datatypeval2); 
   //$filed=[];
       $Field_Type1 =[];
       foreach($array_new as $key=>$value){
       
 
        ?>
        <div class="col-md-6">
                          <div class="form-group">

                            <label for="email"><?php echo $term_arr[$j]; 
                            //$Field_Type1 = $Field_Type[$j];
                            
                           
                             
                             $Validation_type[$j];
                             //$filed = explode(",",$Validation_parameter[$j]);
                             $filed = $Validation_parameter[$j];
                          

                            ?></label>

       
       

                 
<input type="text" class="form-control"  name="name[<?php echo $key?>]" value="">
<input type="hidden" class="form-control" name="filed[<?php echo $key?>]" value="<?php echo $Field_Type[$j]; ?>">
<input type="hidden" class="form-control" name="FieldValidation[<?php echo $key?>]" value="<?php echo $Field_Validation[$j];?>">
<input type="hidden" class="form-control" name="Validationparameter[<?php echo $key?>]" value="<?php echo $Validation_parameter[$j];?>">
<input type="hidden" class="form-control" name="titlename[<?php echo $key?>]" value="<?php echo $term_arr[$j];?>">
<p style="" class="error_msg"><?php 
     //print_r($msg);
     //array_reverse($msg[0]);
     echo $msg[0][$k];
    
     ?></p>
                          </div>
                      </div>
                <?php $k++;$j++;} ?>
                
              
                <div class="col-md-12">
       
            <button type="submit" name="addcountry" value="addcountry" disabled class="btn btn-default">Add Country</button>
              <input type="hidden" name="tablename"  value="<?php echo $tablename;?>">
              <input type="hidden" name="pagename" value="<?php echo $pagename1;?>">
            <input type="hidden" name="Parameter" value="<?php echo  $Parameter;?>">
            <input type="hidden" name="columnname" value="<?php echo $newfiled?>">
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
