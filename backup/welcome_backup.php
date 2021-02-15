<?php include("Database/Config.php");
      session_start();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/style.css">


  </head>
  <body>
    <aside class="side-nav" id="show-side-navigation1">
    <i class="fa fa-bars close-aside hidden-sm hidden-md hidden-lg" data-close="show-side-navigation1"></i>      
    <nav id="column_left">  
    <?php
      $con=mysqli_connect("localhost","phpmyadmin","Admin@123","Brat");
      // Check connection
      if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
       
      function get_menu_tree($parent_id){
      global $con;
      
      $menu = "";
      $sqlquery = "SELECT * FROM Menu where Parent_Menu_ID='".$parent_id."'";
      $res = mysqli_query($con,$sqlquery);
      while($row=mysqli_fetch_array($res,MYSQLI_ASSOC)){ 
      //echo $row['Menu_Display'];die;       
         $menu .= "<li><a class='accordion-heading' data-toggle='collapse' data-target='#mainmenu1' href='company.php/?id=".$row['Company_ID']."'>".$row['Menu_Display']."</a>";
         $menu .= "<ul class='nav nav-list collapse' id='mainmenu1'>".get_menu_tree($row['Company_ID'])."</ul>"; //call  recursively
         $menu .= "</li>";
      }
      return $menu;
    } 
    ?>
 
    <ul class="main-navigation">
    
    <?php    
    echo get_menu_tree(0);//start from root menus having parent id 0 ?>
    </ul>
    </nav>
    </aside>

    <section id="contents">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <i class="fa fa-align-right"></i>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
          </div>
          <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My profile <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><i class="fa fa-user-o fw"></i> My account</a></li>
                  <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a></li>
                </ul>
              </li>
              <!-- <li><a href="#"><i class="fa fa-comments"></i><span>23</span></a></li>
              <li><a href="#"><i class="fa fa-bell-o"></i><span>98</span></a></li> -->
              <li><a href="#"><i data-show="show-side-navigation1" class="fa fa-bars show-side-btn"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="welcome">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="content">
                  <h2>Welcome to Brat Company</h2>
                  <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div>              
            </div>
          </div>
        </div>
      </div>
    </section>

<script src='http://code.jquery.com/jquery-latest.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="stylesheet" href="../assets/custom.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
   // alert('sas')
    $('#example').dataTable();
} );
</script>
      </body>
    </html>
