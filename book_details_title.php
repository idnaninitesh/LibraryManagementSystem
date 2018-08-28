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
<div class="page">
    
<?php

$title=$_GET['full_title'];
        echo '<a href="book_details_title_report.php?title='.$title.'">Print Details</a><br><br>';
        $query = "SELECT * FROM Book WHERE Title='$title'";
        $query_run = mysql_query($query);
        $arr=mysql_fetch_assoc($query_run);
        echo '<table border="1" cellpadding="10" ><tbody>';
        echo '<tr><td><b>Title</b> </td><td>'.$arr['Title'].'</td></tr>';
        echo '<tr><td><b>Author</b> </td><td>'.$arr['Author'].'</td></tr>';
        echo '<tr><td><b>Category</b> </td><td>'.$arr['Category'].'</td></tr>';
        echo '<tr><td><b>ISBN </b> </td><td>'.$arr['ISBN'].'</td></tr>';
        echo '<tr><td><b>Publisher </b> </td><td>'.$arr['Publisher'].'</td></tr>';
        echo '<tr><td><b>Call No. </b> </td><td>'.$arr['Call_No'].'</td></tr>';
        echo '<tr><td><b>Year of Publication</b> </td><td>'.$arr['Year'].'</td></tr>';
        echo '<tr><td><b>Place of Publication </b> </td><td>'.$arr['Place'].'</td></tr>';
        echo '<tr><td><b>Edition </b>'.'</td><td>'.$arr['Edition'].'</td></tr>';
        echo '<tr><td><b>Cost </b>'.'</td> <td>'.$arr['Cost'].'</td></tr>';
        echo '<tr><td><b>Abstract</b> </td><td>'.$arr['Abstract'].'</td></tr>';
        echo '<tr><td><b>Vendor </b> </td><td>'.$arr['Vendor'].'</td></tr>';
        echo '<tr><td><b>Year of buying </b> </td><td>'.$arr['Bought_Year'].'</td></tr>';
        echo '</tbody></table><br><br>';

        echo '<b>Status of each book : </b> <br><br>';
        
        $query = "SELECT COUNT(*) FROM Book WHERE Title='$title'";
        $query_run = mysql_query($query);
        $copies=mysql_result($query_run,0,'COUNT(*)');
        echo 'Total copies : '.$copies.'<br><br>';
      

        $query="SELECT Book_ID,Remark FROM Book WHERE Title='$title' ";
        $query_run=mysql_query($query);
        echo '<table border="1" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Status</th></tr></thead><tbody>';
      while($arr=mysql_fetch_assoc($query_run))
      {
          $status = 'Available'; 
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $issued_Book = mysql_result($query_r, 0,'User_ID');
            $status = '<b>Issued</b> by <a href="student_details.php?Student_ID='.$issued_Book.'">'.$issued_Book.'</a>';
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $Reserved_Book = mysql_result($query_r,0,'User_ID');
            $status = '<b>Reserved</b> by <a href="student_details.php?Student_ID='.$Reserved_Book.'">'.$Reserved_Book.'</a>';
            }       
          if($arr['Remark']=='For reference')
              $status="<b>".'For reference'."</b>";
          if($arr['Remark']=='Withdrawn')
              continue;
          
          
          echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$status.'</td></tr>';
      }
      
        echo '</tbody></table><br><br>';

?>
</div >
