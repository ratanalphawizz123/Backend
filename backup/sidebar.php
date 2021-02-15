<?php
include("Database/Config.php");
include("errorcode.php");
include("functions.php");

if(isset($_SESSION["User_email"])) {
  if(isLoginSessionExpired()) {

echo '<script>alert("Session Terminated");'; 
echo 'window.location.href = "logout.php?session_expired=1";';
echo '</script>';
    //header("Location:logout.php?session_expired=1");
  }
}

;

?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/style.css">

<style type="text/css">

</style>
  
</head>
<body class="nav-md">

<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        
        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="profile_pic">
            <img src="assets/images/<?php echo $_SESSION['UserData']['Company_Logo'];?>">
          </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2><?php echo $_SESSION['UserData']['Company_contact_person'];?></h2>
          </div>
        </div>
        <!-- /menu profile quick info -->

        <br />
        <div class="clearfix"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <div class="mainmenu" id="test">
             <?php //get_menu_tree(0);
 
//Recursive php function
/*function get_menu_tree($parent_id){*/
global $db;
 $email= $_SESSION['User_email'];
$sql1 = menu_gern(0,$email);

 $result1 = $db->query($sql1);
echo '<ul class="main-navigation">';
while($row1 = mysqli_fetch_assoc($result1)){

  echo'<li class=""><a href="#">' .$row1['Menu_Display'];

 echo '</a>';
 
  $sql2 =menu_gern($row1['Menu_ID'],$email);
$result2 = $db->query($sql2);
echo '<ul  class="main-navigation secondclass menu-open">';
while($row2 = mysqli_fetch_assoc($result2)){


   $sqlm2="select LogicalTable.Logical_table_php_name from Menu INNER JOIN ListConfiguration ON Menu.Parameter = ListConfiguration.List_Name INNER JOIN LogicalTable ON ListConfiguration.Logical_Table_Name=LogicalTable.Logical_Table_Name where ListConfiguration.List_Name='".$row2['Parameter']."'";
$resultm2= $db->query($sqlm2);
$rowm2 = mysqli_fetch_assoc($resultm2);

 echo'<li class=""><a href="'.$rowm2['Logical_table_php_name'].'?Parameter='.$row2['Parameter'].'">' .$row2['Menu_Display'];


 $sql3 = menu_gern($row2['Menu_ID'],$email);
$result3= $db->query($sql3);
  echo '<ul class="main-navigation tt">'; 
while($row3 = mysqli_fetch_assoc($result3)){ 

echo $sqlm="select LogicalTable.Logical_table_php_name from Menu INNER JOIN ListConfiguration ON Menu.Parameter = ListConfiguration.List_Name INNER JOIN LogicalTable ON ListConfiguration.Logical_Table_Name=LogicalTable.Logical_Table_Name where ListConfiguration.List_Name='".$row3['Parameter']."'";
$resultm= $db->query($sqlm);
$rowm = mysqli_fetch_assoc($resultm);

 echo'<li class=""><a href="'.$rowm['Logical_table_php_name'].'?Parameter='.$row3['Parameter'].'">' .$row3['Menu_Display'];

 echo '</a></li>';
 }
 echo '</ul>';
 

 echo '</li>';
 
}
echo '</ul>';
 echo '</li>';
 //$row3['Menu_Display'];


}
echo '</ul>';

/*$result1 = $db->query($sql1);
echo $row1['Menu_ID'];

}

 //$sql1 = "select * from Menu where Parent_Menu_ID ='".$parent_id."' and Company_ID = '".$_SESSION['UserData']['Company_ID']."'";
/*$result1 = $db->query($sql1);
 echo '
<ul class="main-navigation">';
while($row1 = mysqli_fetch_object($result1)):
$i = 0;
if ($row1->Parent_Menu_ID == 0){ 
 echo '
<li class=""><a href="company.php">' . $row1->Menu_Display;

 echo '</a></li>
 ';
}else{
  echo '
<li class=""><a href="company.php">' . $row1->Menu_Display;
 echo $row1->Menu_ID;
 get_menu_tree($row1->Menu_ID);

 echo '</a></li>
 '; 
}
$i++;
 if ($i > 0) echo '</ul>
 
';
endwhile;



}*/
?> 
 
               
              </div>
            </div>
          </div>
        <!-- /sidebar menu -->
      </div>
    </div>