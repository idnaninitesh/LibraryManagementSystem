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
    <a id="issue_book" href="issue_book.php">&nbsp&nbsp&nbspIssue Book</a>
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
<div class="page">
	<p><b>Issue Book</b></p>
	<form action="issue_book.php" method="POST">
		Student ID: &nbsp<input type="text" name="userid" required><br><br>
		Book ID:&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" name="bookid" required><br><br>
		<input type="submit" value="Submit">
	</form>
	<?php

	if(isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['bookid']) && !empty($_POST['bookid']))
	{
		$userid=$_POST['userid'];
		$bookid=$_POST['bookid'];
		$query="SELECT ISBN FROM Book WHERE Book_ID='".$bookid."'";
		$query_run=mysql_query($query);
		$isbn=mysql_result($query_run, 0);
		$query="SELECT User_ID,ISBN FROM Transaction WHERE User_ID='".$userid."' AND ISBN='".$isbn."' AND Return_Date IS NULL";
		$query_run=mysql_query($query);
		if(mysql_num_rows($query_run)==1)
			echo $userid.' already has this book.';
		else
		{
			$query="INSERT INTO Transaction (`TID`, `User_ID`, `Book_ID`, `ISBN`, `Issue_Date`, `Return_Date`) VALUES (NULL, '".$userid."', '".$bookid."', '".$isbn."', CURDATE(), NULL)";
			$query_run=mysql_query($query);
			if($query_run)
			{
				$query1="SELECT `Book`.`Book_ID`,`Book`.`Title`,`Transaction`.`User_ID`,`Transaction`.`Issue_Date` FROM `Book`,`Transaction` WHERE `Transaction`.`Book_ID` = `Book`.`Book_ID` AND `Transaction`.`Book_ID`='".$bookid."' AND `Transaction`.`Return_Date` IS NULL AND `Transaction`.`User_ID` = '".$userid."'";
				$q_run=mysql_query($query1);
				if($q_run)
				{
					echo 'Book is issued!<br>';
					$arr=mysql_fetch_assoc($q_run);
					echo 'Book ID: '.$arr['Book_ID'].'<br>';
					echo 'Book Title: '.$arr['Title'].'<br>';
					
					$query2 = "SELECT `User`.`User_ID`,`User`.`Name`,`User`.`Branch`,`User`.`Year`,`User`.`Degree` FROM `User` WHERE `User`.`User_ID` = '".$arr['User_ID']."' ";
					$query_run2 = mysql_query($query2);
					$stud = mysql_fetch_assoc($query_run2);

					$query3="SELECT User_ID,SUM(Fine) FROM (SELECT DISTINCT Transaction.User_ID,Transaction.Book_ID,Transaction.Issue_Date,Transaction.Return_Date,Fine.Fine FROM Transaction,Fine WHERE Transaction.User_ID='".$arr['User_ID']."' AND Transaction.Issue_Date=Fine.Issue_Date AND Transaction.Return_Date=Fine.Return_Date) AS test";
 					$query_run3=mysql_query($query3);
					$total=mysql_fetch_assoc($query_run3);


					echo 'User ID: '.$stud['User_ID'].'<br>';
					echo 'Name: '.$stud['Name'].'<br>';
					echo 'Branch: '.$stud['Branch'].'<br>';
					echo 'Year: '.$stud['Year'].'<br>';
					echo 'Degree: '.$stud['Degree'].'<br>';
					echo 'Fine: Rs. '.$total['SUM(Fine)'].'<br>';
					echo 'Issue Date : '.$arr['Issue_Date'].'<br>';
					$query4 = "UPDATE `reserve` SET `reserve`.`Date` = DATE_SUB(`reserve`.`Date`,INTERVAL 3 DAY) WHERE `reserve`.`Book_ID` = '".$arr['Book_ID']."' ";
					$query_run4 = mysql_query($query4);
					if($query_run4)
					  echo 'Thank You!<br>';
				}
			}
		}
	}

	?>
</div>
