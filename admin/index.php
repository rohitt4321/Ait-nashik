<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
} 
include("include/connect.php");
?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Dashboard | AIT Admin</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.jqplot.min.css" />
<script language="javascript" type="text/javascript" src="js/jqPlot/jquery.jqplot.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.barRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pieRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.highlighter.min.js"></script>
<script language="javascript" type="text/javascript" src="js/jqPlot/plugins/jqplot.pointLabels.min.js"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupDashboardChart('chart1');
        setupLeftMenu();
        setSidebarHeight();
    });
</script>
</head>
<body>
<div class="container_12">
<?php
	include("include/header.php");
?>
<div class="clear"></div>
</div>
<div class="dashbord">
  <div class="home-box">
    <h3>Enquiry</h3>
    <table width="100%" border="1">
      <thead>
        <tr>
          <td>Course</td>
          <td>Name</td>
          <td>Email Id</td>
          <td>Contact</td>
        </tr>
      </thead>
      <tbody>
        <?php
			  $sqlEnq="SELECT * FROM enquiry ORDER BY eq_id DESC LIMIT 5";
			  $resultEnq=mysqli_query($dbcon,$sqlEnq) or die ("Enquiry table connection failed".mysqli_error($dbcon));
			  while($rowEnq=mysqli_fetch_assoc($resultEnq))
			  {
			  ?>
        <tr>
          <td><?php echo $rowEnq['eq_course']?></td>
          <td><?php echo $rowEnq['eq_name'] ?></td>
          <td><?php echo $rowEnq['eq_email'] ?></td>
          <td><?php echo $rowEnq['eq_contact'] ?></td>
        </tr>
        <?php
			  }
			  ?>
      </tbody>
    </table>
    <?php
			@mysqli_free_result($resultEnq);
			?>
  </div>
  <div class="home-box">
    <h3>Jobs</h3>
    <table width="100%" border="1">
      <thead>
        <tr>
          <td>Job Title</td>
          <td>Details</td>
        </tr>
      </thead>
      <tbody>
        <?php
			  $sqlJob="SELECT * FROM job ORDER BY job_id DESC LIMIT 2";
			  $resultJob=mysqli_query($dbcon,$sqlJob) or die ("Enquiry table connection failed".mysqli_error($dbcon));
			  while($rowJob=mysqli_fetch_assoc($resultJob))
			  {
			  ?>
        <tr>
          <td><?php echo $rowJob['job_title']?></td>
          <td><?php echo $rowJob['job_description']?></td>
        </tr>
        <?php
			  }
			  ?>
      </tbody>
        </tbody>
      
    </table>
    <?php
			@mysqli_free_result($resultJob);
			?>
  </div>
  <div class="home-box">
    <h3>Placement</h3>
    <table width="100%" border="1">
      <thead>
        <tr>
          <td>Name</td>
          <td>College Name</td>
          <td>Company Name</td>
          <td>Image</td>
        </tr>
      </thead>
      <tbody>
        <?php
			  $sqlPlace="SELECT * FROM placement ORDER BY p_id DESC LIMIT 5";
			  $resultPlace=mysqli_query($dbcon,$sqlPlace) or die ("Enquiry table connection failed".mysqli_error($dbcon));
			  while($rowPlace=mysqli_fetch_assoc($resultPlace))
			  {
			  ?>
        <tr>
          <td><?php echo $rowPlace['name']?></td>
          <td><?php echo $rowPlace['comp_name']?></td>
          <td><?php echo $rowPlace['clg_name']?></td>
          <td><img src="upload/resized_<?php echo $rowPlace['image'] ?>" width="50" /></td>
        </tr>
        <?php
			  }
			  ?>
      </tbody>
    </table>
    <?php
			@mysqli_free_result($resultPlace);
			?>
  </div>
</div>
<?php 
	include("include/footer.php"); 
	@mysqli_close($dbcon);
	ob_flush();
?>
</body>
</html>
