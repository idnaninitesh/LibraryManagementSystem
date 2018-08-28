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
    <a id="late" href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
  </p>
</div>
<div class="page">
    <?php
        echo '<a href="late_report.php">Print Report</a><br><br>';
        
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

        $query="SELECT Transaction.User_ID,User.Name,Transaction.Book_ID,Book.Title,Book.Author,Book.Publisher FROM User,Transaction,Book WHERE Transaction.User_ID=User.User_ID AND Transaction.Book_ID=Book.Book_ID AND DATEDIFF(CURDATE(),Transaction.Issue_Date)>37 AND Transaction.Return_Date IS NULL";
        $query_run=mysql_query($query);
        if(mysql_num_rows($query_run)==0)
            echo 'No late students<br><br>';
        else{
            echo '<table border="2" cellpadding="10" ><thead><tr><th>User_ID</th><th>Name</th><th>Book_ID</th><th>Title</th><th>Author</th><th>Publisher</th><th>Fine</th></tr></thead><tbody>';
            while($arr=mysql_fetch_assoc($query_run))
            {
                
                
            $query1="SELECT * FROM `Transaction` WHERE Book_ID='".$arr['Book_ID']."' AND Return_Date IS NULL";
			$q_run=mysql_query($query1);
			if($q_run)
			{
				$brr=mysql_fetch_assoc($q_run);
				$issue_date=$brr['Issue_Date'];
				$fine = calculate_fine($issue_date,date("Y-m-d"));
            }
                
                echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td>'.$arr['Name'].'</td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$fine.'</td></tr>';                
            }
            echo '</tbody></table><br><br>';
        }
    ?>
</div >