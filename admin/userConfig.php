<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include("include/connect.php");



if(isset($_POST['submit']))
{
	$FirstName=trim($_POST['fname']);
	$LastName=trim($_POST['lname']);
	$UserId=$_POST['uid'];
	
	$sql="UPDATE login SET f_name='$FirstName',l_name='$LastName' WHERE user_id=".$UserId;
	$result=mysqli_query($dbcon,$sql) or die("Login Table Connection Failed".mysqli_error($dbcon));
}

$sql_user="SELECT user_id,f_name,l_name FROM login WHERE user_id=".$_SESSION['id'];
$result_user=mysqli_query($dbcon,$sql_user) or die("Login table connection failed..".mysqli_error($dbcon));
$row=mysqli_fetch_assoc($result_user);
?>
<!DOCTYPE html>
<html>
<head>
<?php
if(isset($result))
{
?>
<meta http-equiv="refresh" content="0">
<?php
}
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>User Config | AIT Admin</title>
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<link href="css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
<link href="css/themes/base/jquery.ui.all.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
<script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
<script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
<script src="js/setup.js" type="text/javascript"></script>
<script type="text/javascript">
function Submit()
{
	var fname = document.form.fname.value;
	var	lname = document.form.lname.value;
	var fnameRegex=/^[a-zA-z]+$/; 
	if(fname =='')
	{
		 document.form.fname.focus() ;
		 document.getElementById("ferror").innerHTML = "enter the first name";
		 return false;
	}
	else if(!fnameRegex.test(fname))
	{
		document.form.fname.focus() ;
		document.getElementById("ferror").innerHTML = "enter valid first name";
		return false;
	}
	
	var lnameRegex=/^[a-zA-z]+$/;
	if(lname == '')
	{
		 document.form.lname.focus() ;
		 document.getElementById("lerror").innerHTML = "enter the last name";
		 return false;
	}
	else if(!lnameRegex.test(lname))
	{
		 document.form.lname.focus() ;
		 document.getElementById("lerror").innerHTML = "enter valid last name";
		 return false;
	}
}
</script>
</head>
<body>
<div class="container_12">
<?php include("include/header.php"); ?>
<div class="clear"> </div>
<div class="grid_12">
	<div class="box round first fullpage">
    <h2 class="title">User Personal Information</h2>
    <div class="block ">
     <form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onSubmit="return Submit();">
     <input type="hidden" name="uid" value="<?php echo $row['user_id'] ?>" />
     <table class="form">
     <tr>
     <td class="col1"><label>First Name</label></td>
     <td class="col2"><input type="text" id="grumble" name="fname" value="<?php echo $row['f_name'] ?>" />
     <span id="ferror" style="color:#F00; font-size:12px;"></span></td>
     </tr>
     <tr>
     <td class="col1"><label>Last Name</label></td>
     <td class="col2">
     <input type="text" id="grumble" name="lname" value="<?php echo $row['l_name'] ?>" />
     <span id="lerror" style="color:#F00; font-size:12px;"></span></td>
     </tr>
     <tr>
     <td class="col1"><button class="btn btn-large" type="submit" name="submit" id="submit">Update</button></td>
      </tr>
      </table>
      </form>
</div>
<?php
	@mysqli_free_result($result_user);
	@mysqli_close($dbcon);
?>
</div>
</div>
<div class="clear"></div>
</div>
<?php 
	include("include/footer.php"); 
	ob_flush();
?>
</body>
</html>
