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
    <a id="return_book" href="return_book.php">&nbsp&nbsp&nbspReturn Book</a>
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
	<p><b>Return Book</b></p>
	<form action="return_book.php" method="POST">
		Book ID: <input type="text" name="bookid" required><br><br>
		<input type="submit" value="Submit">
	</form>
	<?php

function calculate_fine($issue_date,$return_date)
	{

    $issue = strtotime($issue_date);
    $return = strtotime($return_date);

    $days = ($return - $issue)/(60*60*24) - 7;

    if($days <= 0)
      $fine = 0;
    else if($days <= 7)
           $fine = $days*1;
         else if($days <= 14)
         	    $fine = 7 + ($days-7)*2;
         	  else
         	    $fine = 100;
    return $fine; 
	}


	if(isset($_POST['bookid']) && !empty($_POST['bookid']))
	{
		$bookid=$_POST['bookid'];
	
		$query = "SELECT * FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$bookid."' AND `Transaction`.`Return_Date` IS NULL";
		$query_run=mysql_query($query);
		
        if(mysql_num_rows($query_run) != 1)
           echo 'Invalid Book ID. Book is already in the library';   
		else
		{	
		$query="UPDATE Transaction SET Return_Date=CURDATE() WHERE Book_ID='".$bookid."' AND Return_Date IS NULL";
		$query_run=mysql_query($query);
		if($query_run)
		{
			$query1="SELECT * FROM `Transaction` WHERE Book_ID='".$bookid."' AND Return_Date=CURDATE()";
			$q_run=mysql_query($query1);
			if($q_run)
			{
				$arr=mysql_fetch_assoc($q_run);
				$issue_date=$arr['Issue_Date'];
                $return_date=$arr['Return_Date'];


				$fine = calculate_fine($issue_date,$return_date);
				
				$query2="INSERT INTO Fine VALUES ('$issue_date','$return_date','$fine') ";
				$q2_run=mysql_query($query2);
				if($q2_run)
				  {
				  echo 'Book Returned!<br>';
				  $query3 = "SELECT `User`.`User_ID`,`User`.`Name`,`User`.`Branch`,`User`.`Year`,`User`.`Degree` FROM `User` JOIN `Transaction` ON `Transaction`.`User_ID` = `User`.`User_ID` AND `Transaction`.`Book_ID` = '".$bookid."' AND `Transaction`.`Return_Date` = CURDATE() ORDER BY TID DESC";
				  $query_run3 = mysql_query($query3);
				  $stud = mysql_fetch_assoc($query_run3);

				  $query4="SELECT User_ID,SUM(Fine) FROM (SELECT DISTINCT Transaction.User_ID,Transaction.Book_ID,Transaction.Issue_Date,Transaction.Return_Date,Fine.Fine FROM Transaction,Fine WHERE Transaction.User_ID='".$stud['User_ID']."' AND Transaction.Issue_Date=Fine.Issue_Date AND Transaction.Return_Date=Fine.Return_Date) AS test";
				  $query_run4=mysql_query($query4);
				  $total=mysql_fetch_assoc($query_run4);


				  echo 'User ID: '.$stud['User_ID'].'<br>';
				  echo 'Name: '.$stud['Name'].'<br>';
				  echo 'Branch: '.$stud['Branch'].'<br>';
				  echo 'Year: '.$stud['Year'].'<br>';
				  echo 'Degree: '.$stud['Degree'].'<br>';
				  echo 'Fine on book returned: '.$fine.'<br>';
				  echo 'Total fine : Rs. '.$total['SUM(Fine)'].'<br>';
				}
			}
	    }

		}
	}

	?>
</div>