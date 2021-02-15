<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="<?php echo base_url();?>Js/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css">
    <script src="<?php echo base_url();?>Js/custom_ajax.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>
<body class="nav-md">

<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        
        <!-- menu profile quick info -->
        <div class="profile clearfix">
          <div class="profile_pic">
             <?php $getSession = get_session('UserData'); ?>
            <img src="../assets/images/<?php echo !empty($getSession[0]['Company_Logo']) ? $getSession[0]['Company_Logo'] : ''; ?>">
          </div>
          <div class="profile_info">
            <span>Welcome,</span>
            <h2><?php echo $getSession[0]['Company_contact_person']; ?></h2>
          </div>
        </div>
        <!-- /menu profile quick info -->

        <br />
        <div class="clearfix"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <div class="mainmenu" id="test">
             <?php
$useremail = get_session('useremail');
$result1 = menu_gern(0, $useremail);
echo '<ul class="main-navigation">';
while ($row1 = mysqli_fetch_assoc($result1))
{
    echo '<li class=""><a href="#">' . $row1['Menu_Display'];
    echo '</a>';
    $sql2 = menu_gern($row1['Menu_ID'], $useremail);
    echo '<ul  class="main-navigation secondclass menu-open">';
    while ($row2 = mysqli_fetch_assoc($sql2))
    {
        $resultm2 = menu_gern_child($row2['Parameter']);
        $rowm2 = mysqli_fetch_assoc($resultm2);
        $Logical_table_php_name=$rowm2['Logical_table_php_name'];
        $Parameter=$row2['Parameter'];
        echo '<li class=""><a onclick="getmenulist(\''.$Logical_table_php_name.'\', \''.$Parameter.'\');" href="#">' . $row2['Menu_Display'];
        $result3 = menu_gern($row2['Menu_ID'], $useremail);
        echo '<ul class="main-navigation tt">';
        while ($row3 = mysqli_fetch_assoc($result3))
        {
            $resultm = menu_gern_child($row3['Parameter']);
            $rowm = mysqli_fetch_assoc($resultm);
            echo '<li class=""><a href="' . $rowm['Logical_table_php_name'] . '?Parameter=' . $row3['Parameter'] . '">' . $row3['Menu_Display'];
            echo '</a></li>';
        }
        echo '</ul>';
        echo '</li>';
    }
    echo '</ul>';
    echo '</li>';
    //$row3['Menu_Display'];
    
}
  echo '<li class=""><a onclick="createtable();" href="#">'; echo 'Logical Table Maintenance'; '</a>';
  echo '<li class=""><a onclick="createlistconftable();" href="#">'; echo 'List Configuration Table Maintenance'; '</a>';
    echo '<li class=""><a onclick="createformconfigtable();" href="#">'; echo 'Form Configuration Table Maintenance'; '</a>';
echo '</ul>';
?> 
 
               
              </div>
            </div>
          </div>
        <!-- /sidebar menu -->
      </div>
    </div>
