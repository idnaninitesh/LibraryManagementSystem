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
    <a id="yearly_books" href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
  </p>
</div>

<div class="page">    
    <?php

        echo '<b>Book Report for Year 2015 :</b><br><br>';
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>ISBN</th><th>Edition</th><th>Copies</th><th>Publisher</th><th>Place of Publication</th><th>Year of Publication</th><th>Cost</th><th>Vendor</th></tr></thead><tbody>';
        $query="SELECT DISTINCT Title,Author,Edition,ISBN,Publisher,Place,Year,Cost,Vendor FROM Book WHERE Bought_Year='2015'";
        $query_run=mysql_query($query);
        if(mysql_num_rows($query_run)>0)
        {
            echo '<a href="yearly_books_report.php">Print Report</a><br><br>';
            while($arr=mysql_fetch_assoc($query_run))
            {
                $query1="SELECT COUNT(ISBN) FROM Book WHERE Title='".mysql_real_escape_string($arr['Title'])."'";
                $query_run1=mysql_query($query1);
                $copies=mysql_result($query_run1,0,'COUNT(ISBN)');
                echo mysql_error();
                echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Edition'].'</td><td>'.$copies.'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Place'].'</td><td>'.$arr['Year'].'</td><td>'.$arr['Cost'].'</td><td>'.$arr['Vendor'].'</td></tr>';
            }
        }
        else
            echo 'No books bought this year.';
    ?>
</div>
