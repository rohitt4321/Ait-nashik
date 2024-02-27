<?php
/*$hostname="localhost";
$username="root";
$password="";
$database="ait";*/

$hostname="localhost";
$username="aitnawp2_sumant";
$password="@v=StVU2U$[f";
$database="aitnawp2_ait";

$dbcon=mysqli_connect($hostname,$username,$password) or die("user not connected successfully".mysqli_error($dbcon));
$selectdb=mysqli_select_db($dbcon,$database) or die("database is not connected successfully".mysqli_error($dbcon)); 
?>