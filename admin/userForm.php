<?php
session_start();
ob_start();
if(!isset($_SESSION['id']))
{
	header("location:login.php");
}
include("include/connect.php");

$FirstName=trim($_POST['fname']);
$LastName=trim($_POST['lname']);
$username=trim($_POST['uname']);
$Password=trim($_POST['pwd']);
$CPassword=trim($_POST['cpwd']);

if(isset($_POST['submit']))
{
	$sql_user="SELECT user_name FROM login WHERE user_name='".$username."'";
	$result_user=mysqli_query($dbcon,$sql_user) or die ("Login table connection failed..".mysqli_error($dbcon));
	$row=mysqli_fetch_assoc($result_user);
	echo $row['user_name'];
	if((mysqli_num_rows($result_user))==1)
	{
		$errorMsg="<strong>".$username."</strong>&nbsp; User name is already register please enter another <strong>USER NAME</strong>";
	}
	else
	{
	$sql="INSERT INTO login (user_id,user_name,password,f_name,l_name,user_regdate) VALUES (NULL,'$username','".md5($Password)."','$FirstName','$LastName',NOW())";
	if(mysqli_query($dbcon,$sql) or die("Login Table Connection Failed".mysqli_error($dbcon)))
	{
		header("location:usertInfoTable.php");
	}
	else
	{
		$msg="Form Submition Error";
	}
	}
}
?>
<!DOCTYPE>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>user form | accesscad Admin</title>
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
    <!-- Load TinyMCE -->
    <!--<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>-->
    <!--<script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
        });
    </script>-->
    <!-- /TinyMCE -->
   <script type="text/javascript">
function Submit()
{
	var fname = document.form.fname.value,
		lname = document.form.lname.value,
		fuser = document.form.uname.value,
		fpassword = document.form.pwd.value,
		cpassword = document.form.cpwd.value;
				
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
		
		if(fuser == '')
		{
			document.form.uname.focus() ;
			document.getElementById("emailerror").innerHTML = "enter the user name";
   			return false;
		}
		
		if(fpassword == '')
		{
			document.form.pwd.focus() ;
			document.getElementById("pwderror").innerHTML = "enter the Password";
   			return false;
		}
		else if(!(fpassword.length >= 5 && fpassword.length <= 10))
		{
			document.form.pwd.focus() ;
			document.getElementById("pwderror").innerHTML = "Password should be 5 to 10 character long";
   			return false;
		}
		if(cpassword == '')
		{
			document.form.cpwd.focus() ;
			document.getElementById("cpwderror").innerHTML = "enter the Password";
   			return false;
		}
		if(cpassword != fpassword)
		{
			document.form.cpwd.focus() ;
			document.getElementById("cpwderror").innerHTML = "password are not matching, re-enter again";
   			return false;
		}
		
		if(fname != '' && lname != '' && fuser != '' && fpassword != '' && cpassword != '')
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
                <h2 class="title"> User Registration Form</h2>
                <div class="block ">
                <?php
				if(isset($errorMsg))
				{
					echo "<span style='color:#ff0000; text-align:center;'>{$errorMsg}</span>";
				}
				echo "<span style='color:#ff0000; font-weight:bold; text-align:center;'>{$msg}</span>";
				?>
                    <form name="form" method="post" action="usertInfoTable.php" onSubmit="return Submit();">
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <label>First Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="fname" />
                                <br/><span id="ferror" style="color:#F00; font-size:12px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>Last Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="lname" />
                                <br/><span id="lerror" style="color:#F00; font-size:12px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>User Name</label>
                            </td>
                            <td class="col2">
                                <input type="text" id="grumble" name="uname" />
                                <br/><span id="emailerror" style="color:#F00; font-size:12px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>Password</label>
                            </td>
                            <td class="col2">
                                <input type="password" id="grumble" name="pwd" />&nbsp;<span>Enter password between 5 to 10 character</span>
                                <br/><span id="pwderror" style="color:#F00; font-size:12px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <label>Confirm Password</label>
                            </td>
                            <td class="col2">
                                <input type="password" id="grumble" name="cpwd" />
                                <br/><span id="cpwderror" style="color:#F00; font-size:12px;"></span>
                            </td>
                        </tr>
                        <tr>
                        <td class="col1"><button class="btn btn-large" type="submit" name="submit" id="submit">Save</button></td>
                        </tr>
                    </table>
                    </form>
                </div>
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
