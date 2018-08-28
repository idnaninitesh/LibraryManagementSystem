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
    <a id="student_details" href="student_details.php">&nbsp&nbsp&nbspView Student Details</a>
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
<div class="page">
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

echo '<b>Student Details:</b><br>';
echo '<br><form action = "student_details.php" METHOD = "GET" >Student ID : <input type = "text" name = "Student_ID" required><input type = "Submit" value = "Submit"></form>';

if(isset($_GET['Student_ID']))
  {	    
  $Student_ID = $_GET['Student_ID'];
  if(!empty($Student_ID))
    {
    $query="SELECT Name,Branch,Year,Degree FROM User WHERE User_ID='$Student_ID' ";
		
    $query_run=mysql_query($query);
    $arr=mysql_fetch_assoc($query_run);

    if(mysql_num_rows($query_run) == 0)
      echo 'No records found'.'<br >';
    else
      {
      echo '<a href="student_details_report.php?id='.$Student_ID.'">Print report</a><br><br>';
      echo '<table border="2" cellpadding="10" ><thead><tr><th>Name</th><th>Branch</th><th>Degree</th><th>Year</th><th>Fine</th></tr></thead><tbody><tr><td>'.$arr['Name'].'</td><td>'.$arr['Branch'].'</td><td>'.$arr['Degree'].'</td><td>'.$arr['Year'].'</td>';

       $query = "SELECT `Transaction`.`Issue_Date`,`Transaction`.`Return_Date` FROM `Transaction` WHERE `Transaction`.`User_ID` = '".$Student_ID."' ";

    $query_run = mysql_query($query);
    $Fine = 0;
    if(mysql_num_rows($query_run) > 0)
      {  
      while($arr = mysql_fetch_assoc($query_run))   
        {
        $issue_date = $arr['Issue_Date'];
        $return_date = $arr['Return_Date'];
        if(!isset($return_date))
          $return_date = date('Y-m-d');     
    
        $Fine += calculate_fine($issue_date,$return_date);
        }
      }
   echo '<td>'.$Fine.'</td></tr></tbody></table><br><br>';

      $query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Book_ID FROM Transaction WHERE Return_Date IS NULL AND User_ID='$Student_ID')";

      $query_run=mysql_query($query);
      echo 'Books in possession: '.'<br>';

      while($arr=mysql_fetch_assoc($query_run))
   	    {
	    echo '<a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a> - '.$arr['Title'].'<br>';
	    }
	
      $query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Reserve.Book_ID FROM User_RID,Reserve WHERE User_RID.RID=Reserve.RID AND User_RID.User_ID='$Student_ID'AND DATEDIFF(CURDATE(),Date)<=2)";

      $query_run=mysql_query($query);
      echo '<br>';
      echo 'Books reserved: '.'<br><br>';
      while($arr=mysql_fetch_assoc($query_run))
        {
	    echo '<a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a> - '.$arr['Title'].'<form action="student_details.php" method="POST"><input type="hidden" name="sid" value="' . (int)$Student_ID . '" /><input type="hidden" name="bid" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Issue"></form><br><br>';
	    }
      }      
      
      $query = "SELECT `Book`.`Book_ID`,`Book`.`Title`,`Transaction`.`Issue_Date`,`Transaction`.`Return_Date` FROM `Book`,`Transaction` WHERE `Transaction`.`User_ID` = '".$Student_ID."' AND Book.Book_ID=Transaction.Book_ID AND `Book`.`Book_ID` IN (SELECT `Transaction`.`Book_ID` FROM `Transaction` WHERE `Transaction`.`User_ID` = '".$Student_ID."' ) ";

  $query_run = mysql_query($query);
  if(mysql_num_rows($query_run) == 0)
    echo 'No history found'.'<br >';
  else
    {
      echo '<b>Student History:</b><br><br>';
      echo '<table border="2" cellpadding="10" ><thead><tr><th>Book ID</th><th>Title</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></tr></thead><tbody>';   
    while($arr = mysql_fetch_assoc($query_run))   
    {  
      
    $query = "SELECT DISTINCT `Fine`.`Fine` FROM `Fine` JOIN `Transaction` ON `Transaction`.`User_ID` = '".$Student_ID."' AND `Fine`.`Issue_Date` = '".$arr['Issue_Date']."' AND `Fine`.`Return_Date` = '".$arr['Return_Date']."' AND `Transaction`.`Book_ID` = '".$arr['Book_ID']."' ";

    $query_r = mysql_query($query);
    
    if(mysql_num_rows($query_r) == 1)
      $Fine = mysql_result($query_r, 0);
    else
      $Fine = calculate_fine($arr['Issue_Date'],date('Y-m-d'));
    echo '<tr><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td><td>'.$Fine.'</td></tr>';
    }      
  } 

    }
  }

  if(isset($_POST['bid']) && isset($_POST['sid']))
  {
    $bookid=$_POST['bid'];
    $userid=$_POST['sid'];
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

          $query3="SELECT User_ID,SUM(Fine) FROM (SELECT DISTINCT Transaction.User_ID,Transaction.Book_ID,Transaction.Issue_Date,Transaction.Return_Date,Fine.Fine FROM Transaction,Fine WHERE Transaction.User_ID='".$userid."' AND Transaction.Issue_Date=Fine.Issue_Date AND Transaction.Return_Date=Fine.Return_Date) AS test";
          $query_run3=mysql_query($query3);
          $total=mysql_fetch_assoc($query_run3);


          echo 'User ID: '.$stud['User_ID'].'<br>';
          echo 'Name: '.$stud['Name'].'<br>';
          echo 'Branch: '.$stud['Branch'].'<br>';
          echo 'Year: '.$stud['Year'].'<br>';
          echo 'Degree: '.$stud['Degree'].'<br>';
          echo 'Fine: Rs. '.$total['SUM(Fine)'].'<br>';
          echo 'Issue Date : '.$arr['Issue_Date'].'<br>';
          $query4 = "UPDATE `Reserve` SET `Reserve`.`Date` = DATE_SUB(`Reserve`.`Date`,INTERVAL 3 DAY) WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' ";
          $query_run4 = mysql_query($query4);
          if($query_run4)
            echo 'Thank You!<br>';
        }
      }
    }
  }
?>
</div >