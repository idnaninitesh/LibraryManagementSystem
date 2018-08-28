<?php

require 'core.inc.php';
require 'connect.inc.php';

if(isset($_SESSION['user_name']) && !empty($_SESSION['user_name']))
{
	$userid=$_SESSION['user_name'];
	$query="SELECT Category FROM User WHERE User_ID='$userid'";
	$run=mysql_query($query);
	$category=mysql_result($run,0,'Category');
	//echo $category;
	if($category== 1)
		header('Location: student.php');
	else
		header('Location: staff.php');
	
}
else
	include 'login.inc.php';




?>

