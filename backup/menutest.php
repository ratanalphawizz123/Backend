<?php include("Database/Config.php");
?>
<?php 
category_tree(0);
 
//Recursive php function
function category_tree($catid){
global $db;
 
$sql = "select * from Menu where Parent_Menu_ID ='".$catid."' and Company_ID=1";
$result = $db->query($sql);
 echo '
<ul>';
while($row = mysqli_fetch_object($result)):
$i = 0;
if ($i == 0) 
 echo '
<li>' . $row->MenuDescription;
 category_tree($row->Menu_ID);
 echo '</li>
 
';
$i++;
 if ($i > 0) echo '</ul>
 
';
endwhile;
}
//close the connection
mysqli_close($conn);
?>