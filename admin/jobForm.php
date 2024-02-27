<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include("include/connect.php");

$jobtitle=$_POST['jtitle'];
//$jobcode=$_POST['jcode'];
$jobdes=$_POST['jdecription'];

//-------------------fetch job id-------------
$sql="SELECT job_id FROM job ORDER BY job_id DESC LIMIT 1";
$result=mysqli_query($dbcon,$sql) or die("Job table connection faild".mysqli_error($dbcon));
$row=mysqli_fetch_assoc($result);

if(isset($_POST['submit']))
{
	$jobid=$row['job_id'];
	$str=explode('-',$jobid);
	$id=$str[1]+1;
	$ary=array($str[0],$id); 
	$str1=implode("-",$ary);

$jobquery="INSERT INTO job(job_id,job_title,job_description) VALUES ('$str1','$jobtitle','$jobdes')";
if(mysqli_query($dbcon,$jobquery)or die("Job Table connection failed".mysqli_error($dbcon)))
{
	header("location:jobinfoTable.php");
}
else
{
	$msg="Form Submition Error";
}
}
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Job form | accesscad Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" type="text/css" href="css/ie6.css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen" /><![endif]-->
    <link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    <!--Jquery UI CSS-->
    <link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!--<script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <!--jQuery Date Picker-->
    <!-- <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>-->
    <!-- jQuery dialog related-->
    <!--<script src="js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>-->
    <!-- jQuery dialog end here-->
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <!--Fancy Button-->
    <!--<script src="js/fancy-button/fancy-button.js" type="text/javascript"></script>-->
    <script src="js/setup.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <!-- Load TinyMCE -->
    <!--<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
        });
    </script>-->
    <!-- /TinyMCE -->
    <script type="text/javascript">
function Submit()
{
	var title = document.form.jtitle.value;
	    
		
		if(title=='')
		{
			document.form.jtitle.focus() ;
			document.getElementById("emailerror").innerHTML = "Enter The Job Title";
   			return false;
		}
		
		/*if(desp == '')
		{
			document.form.jdecription.focus();
			document.getElementById("pwderror").innerHTML = "Enter Job Description";
		}*/
				
		if(title != '')
		{
			alert("form is ready for submittion");
		}
}
		</script>
   
</head>
<body>
    <div class="container_12">
    <?php include("include/header.php"); ?>
        <div class="clear">
        </div>
        <div class="grid_12">
            <div class="box round first fullpage">
                <h2 class="title"> Job Form</h2>
                <div class="block ">
                <?php echo "<span style='color:#ff0000; font-weight:bold; text-align:center;'>{$msg}</span>" ?>
                    <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return Submit();">
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <label>Job Title</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="jtitle" />
                                <br/><span id="emailerror" style="color:#F00; font-size:12px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Job Description</label>
                            </td>
                            <td>
                                <textarea class="ckeditor" name="jdecription"></textarea>
                            </td>
                        </tr>
                        <tr>
                        <td class="col1"><button class="btn btn-large" type="submit" name="submit" id="submit">Save</button></td>
                        </tr>
                    </table>
                    </form>
                </div>
                <?php
				@mysqli_free_result($row);
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
