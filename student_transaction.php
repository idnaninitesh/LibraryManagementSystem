<?php

require 'core.inc.php';
require 'connect.inc.php';

?>

<head>
  <link rel="stylesheet" type="text/css" href="student.css">
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
              <li><a href="editpass.php">Edit Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
      </ul>
  </nav>
</div>
<div class="details">
  <p><?php
    $query="SELECT Name,Branch,Year,Degree FROM User WHERE User_ID='".$_SESSION['user_name']."'";
    $query_run=mysql_query($query);
    $arr=mysql_fetch_assoc($query_run);
    echo '&nbsp&nbsp&nbsp&nbspName:&nbsp&nbsp '.$arr['Name'].'<br>';
    echo '&nbsp&nbsp&nbsp&nbspBranch: '.$arr['Branch'].'<br>';
    echo '&nbsp&nbsp&nbsp&nbspYear:&nbsp&nbsp&nbsp '.$arr['Year'].'<br>';
    echo '&nbsp&nbsp&nbsp&nbspDegree: '.$arr['Degree'].'<br>';

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

    $query = "SELECT `Transaction`.`Issue_Date`,`Transaction`.`Return_Date` FROM `Transaction` WHERE `Transaction`.`User_ID` = '".$_SESSION['user_name']."' ";

    $query_run = mysql_query($query);
    if(mysql_num_rows($query_run) > 0)
      {
      $Fine = 0;  
      while($arr = mysql_fetch_assoc($query_run))   
        {
        $issue_date = $arr['Issue_Date'];
        $return_date = $arr['Return_Date'];
        if(!isset($return_date))
          $return_date = date('Y-m-d');     
    
        $Fine += calculate_fine($issue_date,$return_date);
        }
      echo '&nbsp&nbsp&nbsp&nbspFine: &nbsp&nbsp&nbsp&nbspRs. '.$Fine.'<br><br>';
      }

    echo '<div class="tags">';
    $query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Book_ID FROM Transaction WHERE Return_Date IS NULL AND User_ID='".$_SESSION['user_name']."')";
    $query_run=mysql_query($query);
    echo '&nbsp&nbsp&nbsp&nbspBooks in possession: ';
    if(mysql_num_rows($query_run) == 0)
      echo '<br><br>&nbsp&nbsp&nbsp&nbspNo books issued at present<br><br>';
    else
      {
      echo '<ol type="1">';
      while($arr=mysql_fetch_assoc($query_run))
        {
        echo '<li>'.$arr['Book_ID'].' - '.$arr['Title'].'</li>';
        } 
      echo '</ol>';
      }
    $query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Reserve.Book_ID FROM User_RID,Reserve WHERE User_RID.RID=Reserve.RID AND User_RID.User_ID='".$_SESSION['user_name']."'AND DATEDIFF(CURDATE(),Date)<=2)";
    $query_run=mysql_query($query);
    echo '&nbsp&nbsp&nbsp&nbspBooks Reserved:';
    if(mysql_num_rows($query_run) == 0)
      echo '<br><br>&nbsp&nbsp&nbsp&nbspNo books reserved at present<br><br>';
    else
      {
      echo '<ol type="1">';
      while($arr=mysql_fetch_assoc($query_run))
       {
       echo '<li>'.$arr['Book_ID'].' - '.$arr['Title'].'</li>';
       }
      echo '</ol>';      
      }
    echo '</div><br>';
    echo '<a href = "student.php">&nbsp&nbsp&nbspHome</a>';
    echo '<a id = "student_transaction" href = "student_transaction.php">&nbsp&nbsp&nbspView transaction history</a>';
    
  ?></p>
</div>
<div class="page">

<?php


$query = "SELECT `Book`.`Book_ID`,`Book`.`Title`,`Transaction`.`Issue_Date`,`Transaction`.`Return_Date` FROM `Book`,`Transaction` WHERE `Transaction`.`User_ID` = '".$_SESSION['user_name']."' AND Book.Book_ID=Transaction.Book_ID AND `Book`.`Book_ID` IN (SELECT `Transaction`.`Book_ID` FROM `Transaction` WHERE `Transaction`.`User_ID` = '".$_SESSION['user_name']."' ) ";

$query_run = mysql_query($query);
if(mysql_num_rows($query_run) == 0)
  echo 'No history found'.'<br >';
else
  {
  echo '<b>Transaction History</b><br><br>';
  echo '<table border="2"  ><thead><tr><th>Book ID</th><th>Title</th><th>Issue Date</th><th>Expected Return Date</th><th>Return Date</th><th>Fine</th></tr></thead><tbody>';		
  while($arr = mysql_fetch_assoc($query_run))  	
    {
    $issue=strtotime($arr['Issue_Date']);
    $exp_return = $issue+(7*24*3600);
    
    $query = "SELECT DISTINCT `Fine`.`Fine` FROM `Fine` JOIN `Transaction` ON `Transaction`.`User_ID` = '".$_SESSION['user_name']."' AND `Fine`.`Issue_Date` = '".$arr['Issue_Date']."' AND `Fine`.`Return_Date` = '".$arr['Return_Date']."' AND `Transaction`.`Book_ID` = '".$arr['Book_ID']."' ";

    $query_r = mysql_query($query);
    if(mysql_num_rows($query_r) == 1)
      $Fine = mysql_result($query_r, 0);
    else
      $Fine = calculate_fine($arr['Issue_Date'],date('Y-m-d'));
    
    echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.date('Y-m-d',$exp_return).'</td><td>'.$arr['Return_Date'].'</td><td>'.$Fine.'</td></tr>';
    }
  }	


?>
</div>