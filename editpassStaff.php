<?php

require 'core.inc.php';
require 'connect.inc.php';

?>

<head>
	<link rel="stylesheet" type="text/css" href="staff.css">
</head>
<div class="navbar">
  <nav class="menu">
      <ul class="clearfix">
        <li><?php 
              $query="SELECT Name FROM User WHERE User_ID='".$_SESSION['user_name']."'";
              $query_run=mysql_query($query);
              $arr=mysql_fetch_assoc($query_run);
     
              echo '<b>Welcome to Library, '.$arr['Name'].'</b>'
              ?></li>
        <li id="set"><a href="#">Settings <span class="arrow">&#9660;</span></a>
          <ul class="sub-menu">
              <li><a href="editpassStaff.php">Edit Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
      </ul>
  </nav>
</div>
<div class="details">
	<p><?php
    $query="SELECT Name,Designation FROM User WHERE User_ID='".$_SESSION['user_name']."'";
    $query_run=mysql_query($query);
    $arr=mysql_fetch_assoc($query_run);
    echo '&nbsp&nbsp&nbsp&nbspName:&nbsp'.$arr['Name'].'<br>';
    echo '&nbsp&nbsp&nbsp&nbspDesignation: '.$arr['Designation'].'<br><br>';  
  ?>
    <br>
	  <a href="staff.php">&nbsp&nbsp&nbspHome</a>
    <a href="student_details.php">&nbsp&nbsp&nbspView Student Details</a>
    <a href="book_details.php">&nbsp&nbsp&nbspView Book Details</a>
    <a href="issue_book.php">&nbsp&nbsp&nbspIssue Book</a>
    <a href="return_book.php">&nbsp&nbsp&nbspReturn Book</a>
    <a href="contact_vendor.php">&nbsp&nbsp&nbspContact Vendor</a>
    <a href="add_user.php">&nbsp&nbsp&nbspAdd User</a>
    <a href="add_book.php">&nbsp&nbsp&nbspAdd Books</a>
    <a href="remove_book.php">&nbsp&nbsp&nbspRemove Books</a>
    <a href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
	</p>
</div>


<?php

$username=$_SESSION['user_name'];
if(isset($_POST['cur_pass']) && isset($_POST['new_pass']) && isset($_POST['re_new_pass']))
{
 $cur_pass=$_POST['cur_pass'];
 $new_pass=$_POST['new_pass'];
 $re_new_pass=$_POST['re_new_pass'];
 if($new_pass == $re_new_pass)
 {
	if(!empty($cur_pass) && !empty($new_pass) && !empty($re_new_pass))
	{
		$new_passmd5=md5($new_pass);
		$query="UPDATE Authentication SET Password='$new_passmd5' WHERE User_ID='$username'";
		$query_run=mysql_query($query);
		echo '<br><br>Password updated';
		header('Location: index.php');
	}
 	else
	echo 'Enter all fields';
 }
 else
	echo 'Passwords do not match';
}


?>

<br>
<form action="editpassStaff.php" method="POST">
&nbspCurrent Password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="cur_pass"><br><br>
&nbspNew Password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="new_pass"><br><br>
&nbspRe-enter New Password&nbsp&nbsp<input type="password" name="re_new_pass"><br><br>
&nbsp<input type="submit" Value="Submit"><br><br>
</form>
