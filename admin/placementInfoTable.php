<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
require_once("include/pagination.php");
include("include/connect.php");

if(isset($_GET['pid']))
{
	$sql="DELETE FROM placement WHERE p_id =".$_GET['pid'];
	$delResult=mysqli_query($dbcon,$sql) or die("Placement Table connection Failed".mysqli_error($dbcon));
	if($delResult)
	{
		$msg="Record Deleted Successfully";
	}
	else
	{
		$msg="Record Not Deleted Successfully";
	}
}
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$page = ($page == 0 ? 1 : $page);
$perpage = 10;//limit in each page
$startpoint = ($page * $perpage) - $perpage;
$sql="SELECT * FROM placement ORDER BY p_id DESC LIMIT $startpoint,$perpage";
$result=mysqli_query($dbcon,$sql) or die("Placement Table connection Failed".mysqli_error($dbcon));
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Placement Table | AIT Admin</title>
    
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <!--<script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
</head>
<body>
    <div class="container_12">
    <?php include("include/header.php"); ?>
        <div class="clear">
        </div>
        <div class="grid_12">
            <div class="box round first grid">
             <div class="title">
              <h2>Placement Deatils Table</h2> 
              <div class="btn-top"><a href="placementForm.php"><button class="btn-icon btn-grey btn-home"><span></span>ADD ENTERY</button></a></div>
              </div>
                <div class="block">
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
        					<th>Placement Id</th>                
							<th>Name</th>
                            <th>College Name</th>
							<th>Company Name</th>
                            <th>Profile Pic</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                    <?php
					while($row=mysqli_fetch_assoc($result))
					{
					?>
						<tr class="odd gradeX">
                        <td><?php echo $row['p_id'] ?></td>
						<td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['clg_name'] ?></td>
						<td><?php echo $row['comp_name'] ?></td>
                        <td><img src="upload/resized_<?php echo $row['image'] ?>" width="50" /></td>
						<td class="center"><a href="placementFormUpdate.php?pid=<?php echo $row['p_id'] ?>"><button class="btn btn-blue">Edit</button></a></td>
					<td class="center"><a href="placementInfoTable.php?pid=<?php echo $row['p_id'] ?>"><button class="btn btn-red">Delete</button></a></td>
						</tr>
                        <?php
					}
						?>
					</tbody>
				</table> 
                </div>
                <?php
				echo Pages("placement",$perpage,"placementInfoTable.php?",$dbcon);
				@mysqli_free_result($result);
				@mysqli_close($dbcon);
				?>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php 
	include("include/footer.php"); 
	ob_flush();
	?>
</body>
</html>
