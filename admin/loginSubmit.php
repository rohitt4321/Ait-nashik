<?php
ob_start();
include('include/connect.php');

$user=$_POST['uname'];
$password=md5($_POST['pwd']);

$user=stripslashes($user);
$password=stripslashes($password);

$username=mysqli_real_escape_string($dbcon,$user);
$userpassword=mysqli_real_escape_string($dbcon,$password);
$sql="SELECT * FROM login WHERE user_name='$username' AND password='$userpassword'";
$result=mysqli_query($dbcon,$sql) or die("login table connection failed".mysqli_error($dbcon));
if(mysqli_num_rows($result) == 1)
{
$row=mysqli_fetch_assoc($result);

	session_start();
	$_SESSION['id']=$row['user_id'];
	$_SESSION['firstname']=$row['f_name'];
	$_SESSION['lastname']=$row['l_name'];
	$_SESSION['lastlogin']=$row['user_last_login'];
	header("location:index.php");

}
else
{
	header("location:login.php?logerr=1");
}
ob_flush();
?>
