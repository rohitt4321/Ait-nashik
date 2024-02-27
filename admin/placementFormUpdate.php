<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include "include/connect.php";
include_once "include/ak_php_img_lib_1.0.php";

if(isset($_GET['pid']))
{
	$sql="SELECT * FROM placement WHERE p_id=".$_GET['pid'];
	$result=mysqli_query($dbcon,$sql) or die("Placement Table connection failed".mysqli_error($dbcon));
	$row=mysqli_fetch_assoc($result);
}
$name=$_POST['pname'];
$clgname=$_POST['clgname'];
$cname=$_POST['cname'];
$fname=$_POST['pic'];
$id=$_POST['id'];

$validextensions = array("jpeg", "jpg", "png","gif");
$ext = explode('.', basename($fname));
$file_extension = end($ext);
$fname =  uniqid().".". $ext[count($ext) - 1];
echo $fname."<br>";
if (($_FILES["pic"]["size"][$i]<(2*1024*1024)) && in_array($file_extension, $validextensions))
{
	if(!file_exists('upload/'.($fname)))
	{
		if (move_uploaded_file($_FILES['pic']['tmp_name'][$i],'upload/'.$fname[$i]))
			{
				//$msgup="Image uploaded successfully..!<br>";
			}
			else
			{
				$msgup="Image Not uploaded successfully..!<br>";
			}
	}
	else
	{
		$msgup="Please select another image,this image already exists..!<br>";
	}
}
else
 {
	$msgup="Image size should be less than 2mb..!<br>";
 }
 
			$target_file = "upload/".$fname."";
			$resized_file = "upload/resized_".$fname."";
			$wmax = 200;
			$hmax = 200;
			ak_img_resize($target_file, $resized_file, $wmax, $hmax, $file_extension);

if(isset($_POST['submit']))
{
	if($row['image'] == NULL)
	{
	
		$sql="UPDATE placement SET name='$name',comp_name='$cname',clg_name='$clgname',image='$fname' WHERE p_id=".$id;
			if(mysqli_query($dbcon,$sql) or die("Placement Table connection Failed".mysqli_error($dbcon)))
			{
				header("location:placementInfoTable.php");
			}
			else
			{
				$msg="Record not update successfully";
			}
	}
	else
	{
		$fname1=$row['image'];
		$sql="UPDATE placement SET name='$name',comp_name='$cname',clg_name='$clgname',image='$fname' WHERE p_id=".$id;
			if(mysqli_query($dbcon,$sql) or die("Placement Table connection Failed".mysqli_error($dbcon)))
			{
				header("location:PlacementInfoTable.php");
			}
			else
			{
				$msg="Record not update successfully";
			}
		
	}
}



?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>placement form | accesscad Admin</title>
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
    
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/setup.js" type="text/javascript"></script>
</head>
<body>
    <div class="container_12">
    <?php include("include/header.php"); ?>
        <div class="clear">
        </div>
        <div class="grid_12">
            <div class="box round first fullpage">
                <h2 class="title"> Placement Form</h2>
                <div class="block ">
                <?php
				echo "<span style='color:#ff0000; font-weight:bold; text-align:center;'>{$msg}</span>"
				?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="hidden" name="id" value="<?php echo $row['p_id'] ?>" />
                    <div id="addinput">
                    <div class="remove">
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <label>Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="pname" value="<?php echo $row['name'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>College Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="clgname" value="<?php echo $row['clg_name'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>Company Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="cname" value="<?php echo $row['comp_name'] ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <img src="upload/<?php echo $row['image']?>" width="100" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Upload photo</label>
                            </td>
                            <td>
                                <input type="file" name="pic" id="grumble" />
                            </td>
                        </tr>
                        </table>
                        </div>
                    </div>
                    <table class="form">
                    <tr>
                        <td class="col2"><button class="btn btn-large" type="submit" name="submit" id="submit">Save</button></td>
                        </tr>
                    </table>
                    </form>
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
