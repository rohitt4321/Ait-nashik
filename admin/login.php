<?php
if(isset($_GET['logerr']))
{
	$msg="Username And password invalid";
}
?>
<!DOCTYPE>
<html>
<head>

	<!-- Basics -->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Login</title>

	<!-- CSS -->
	
	<link rel="stylesheet" href="logincss/reset.css">
	<link rel="stylesheet" href="logincss/animate.css">
	<link rel="stylesheet" href="logincss/styles.css">
	
</head>

	<!-- Main HTML -->
	
<body>
	
	<!-- Begin Page Content -->
	
	<div id="container">
		<?php
		if(isset($msg))
		{
		?>
        <span style="font-weight:bold; color:#FF0000; text-align:center;"><?php echo $msg; ?></span>
        <?php
		}
		?>
		<form method="post" action="loginSubmit.php">
		
		<label for="name">Username:</label>
		
		<input type="name" name="uname" id="uname" placeholder="Enter Username">
		
		<label for="username">Password:</label>
		
		<!--<p><a href="#">Forgot your password?</a>-->
		
		<input type="password" name="pwd" id="pwd" placeholder="Enter Password">
		
		<div id="lower">
		
		<input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>
		
		<input type="submit" value="Login">
		
		</div>
		
		</form>
		
	</div>
	
	
	<!-- End Page Content -->
	
</body>

</html>
	
	
	
	
	
		
	