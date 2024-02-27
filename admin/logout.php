<?php
session_start();
ob_start();
if(isset($_SESSION['id']))
{
	include("include/connect.php");
	//log the time of user last login
	$sql = "UPDATE login SET user_last_login = NOW() WHERE user_id =".$_SESSION['id'];
	$result=mysqli_query($dbcon,$sql) or die("Login table connection failed..".mysqli_error($dbcon));
	unset($_SESSION['id']);
	session_destroy();
	header("location:login.php");
}
ob_flush();
?>