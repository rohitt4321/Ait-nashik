<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include("include/connect.php");

if(isset($_GET['enquiryid']))
{
	$sql="DELETE FROM enquiry WHERE eq_id=".$_GET['enquiryid'];
	if(mysqli_query($dbcon,$sql) or die("Enquiry Table connection Failed".mysqli_error($dbcon)))
	{
		$msg="Record Deleted Successfully";
	}
	else
	{
		$msg="Record Not Deleted Successfully";
	}
}
$sql="SELECT * FROM enquiry";
$result=mysqli_query($dbcon,$sql) or die("Enquiry Table connection Failed".mysqli_error($dbcon));
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Enquiry Table | AIT Admin</title>
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
    <!--<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>-->
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
              <h2>Enquiry Deatils Table</h2> 
              <div class="btn-top"><a href="placementform.php"><button class="btn-icon btn-grey btn-home"><span></span>ADD ENTERY</button></a></div>
              </div>
                <div class="block">
                <?php
				echo "<span style='font-weight:bold; text-align:center;color:#ff0000;'>{$msg}</span>";
				?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
        					<th>Enquiry Id</th>
                            <th>Enquiry Date</th>                
							<th>Name</th>
							<th>Email Id</th>
                            <th>Contact No</th>
                            <th>Course</th>
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
                        <td><?php echo $row['eq_id'] ?></td>
                        <td><?php echo date('d-m-Y h:i:s A',strtotime($row['date'])) ?></td>
						<td><?php echo $row['eq_name'] ?></td>
						<td><?php echo $row['eq_email'] ?></td>
                        <td><?php echo $row['eq_contact'] ?></td>
                        <td><?php echo $row['eq_course'] ?></td>
						<td class="center"><a href="#"><button class="btn btn-blue">Edit</button></a></td>
					<td class="center"><a href="enquiryInfoTable.php?enquiryid=<?php echo $row['eq_id'] ?>"><button class="btn btn-red">Delete</button></a></td>
						</tr>
                        <?php
					}
						?>
					</tbody>
				</table> 
                </div>
                <?php
				@mysqli_free_result($result);
				?>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <?php 
	include("include/footer.php"); 
	@mysqli_close($dbcon);
	ob_flush();
	?>
</body>
</html>
