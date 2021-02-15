<?php include("sidebar.php");?>
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
								$sql= "SELECT List_Configuration.Title,List_Configuration.Logical_table_name as pagename,List_Configuration.shown_field,logical_table.Logical_table_name FROM  List_Configuration
									INNER JOIN logical_table ON List_Configuration.list_name = logical_table.Logical_table_name INNER JOIN logical_definition_table on logical_definition_table.Table_name = logical_table.Logical_table_name where logical_table.Logical_table_name='".$Parameter."'";
								$sql=mysqli_query($db,$sql);
								$row =mysqli_fetch_assoc($sql);
								$row['no_fields'];
								$tablename = $row['Logical_table_name'];
								$pagename= $row['pagename'];
								$filed = explode(",",$row['shown_field']);
							?>
							<center><?php echo $row['Title']; ?></center>
							<table class="table table-striped table-bordered"  id="example" width="100%" cellspacing="0">
								<thead>
									<tr>
										<?php 
											$i=1;
											foreach($filed as $row1){
												$rowfiled = $row['no_show_field'];
												$sql2= "SELECT * from logical_definition_table where Field_no = '".$row1."' and  Table_name='".$tablename."'";
												$sql2=mysqli_query($db,$sql2);
												$row2 =mysqli_fetch_assoc($sql2);
										?>

										<th><?php echo $row2['Field_name'];?></th> 
										<?php 
												$term_arr[]=$row2['Field_name'];
												if ($i == $rowfiled) {break;}
												$i++;
											}
										?>

										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$filed = implode(",",$term_arr);
										$sql3 = "SELECT Company.Company_Description, MenuLanguage.Menu_Display 
											From Company 
											Inner JOIN Menu 
											On Company.Company_ID = Menu.Company_ID 
											Inner Join MenuLanguage 
											on (Menu.Company_ID = MenuLanguage.Company_ID and Menu.Menu_ID = MenuLanguage.Menu_ID) 
											where Company.Company_ID = 1 
											and Company.REC_status=1 
											and Menu.REC_status = 1 
											and MenuLanguage.REC_status = 1";
										//$sql3= "SELECT ".$filed." from ".$tablename." where REC_status='1'";
										$sql3=mysqli_query($db,$sql3);

										while($row3 = mysqli_fetch_row($sql3)){ 
                              
									?>
									<tr> 
										<?php 
											for($i=0; $i < count($row3);$i++){
												if($i == 0){ $empID = $row3[0];} 
										?>
										<td class="text-center"><?php echo $row3[$i]; ?></td>
										<?php 
											} 
										?>
										<td class="text-center">
											<a href="edit_samplemenu.php?id=<?php echo $empID ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>"><i class="fa fa-edit"></i></a>
											<a href="delete.php?id=<?php echo $empID ?>&deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>"><i class="fa fa-trash"></i></a>
										</td> 
									</tr>
									<?php  
										} 
									?>
								</tbody>
								<a href="add_samplemenu.php?deltablename=<?php echo $tablename; ?>&pagename=<?php echo $pagename; ?>&Parameter=<?php echo $Parameter ;?>" class="add_button">+</a>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- /page content -->

<?php include("footer.php");?>