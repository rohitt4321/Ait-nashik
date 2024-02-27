<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include("include/connect.php");

if(isset($_GET['jobid']))
{
	$sql="DELETE FROM job WHERE job_id ='".$_GET['jobid']."'";
	if(mysqli_query($dbcon,$sql) or die("Job Table connection Failed".mysqli_error($dbcon)))
	{
		$msg="Record Deleted Successfully";
	}
	else
	{
		$msg="Record Not Deleted Successfully";
	}
}
$sql="SELECT * FROM job ORDER BY job_id DESC";
$result=mysqli_query($dbcon,$sql) or die("Job Table connection Failed".mysqli_error($dbcon));
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Job Table | AIT Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
   <!-- <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />-->
    <!-- BEGIN: load jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   <!-- <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <!--<script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>-->
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    
    <!-- table css & js-->
    <!--<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type='text/javascript' src="js/slimtable.min.js"></script>
	<link rel='stylesheet' href="css/slimtable.css">-->
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
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
              <h2>Job Deatils Table</h2> 
              <div class="btn-top"><a href="jobForm.php"><button class="btn-icon btn-grey btn-home"><span></span>ADD ENTERY</button></a></div>
              </div>
                <div class="block">
                <?php
				echo "<span style='font-weight:bold; text-align:center;color:#ff0000;'>{$msg}</span>";
				?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
        					<th>Job Id</th>                
							<th>Title</th>
							<th>Description</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					<tbody>
                    <?php
					while($row=mysqli_fetch_assoc($result))
					{
						//print_r($row);
					?>
						<tr class="odd gradeX">
                         <td><?php echo $row['job_id'] ?></td>
						 <td><?php echo $row['job_title'] ?></td>
						 <td><?php echo $row['job_description'] ?></td>
						<td class="center"><a href="jobFormUpdate.php?jobid=<?php echo $row['job_id'] ?>"><button class="btn btn-blue">Edit</button></a></td>
						<td class="center"><a href="jobInfoTable.php?jobid=<?php echo $row['job_id'] ?>"><button class="btn btn-red">Delete</button></a></td>
						</tr>
                        <?php
					}
						?>
					</tbody>
				</table> 
                </div>
                <?php
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
