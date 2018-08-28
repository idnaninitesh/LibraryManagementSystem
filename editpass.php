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
    echo '<a href = "student_transaction.php">&nbsp&nbsp&nbspView transaction history</a>';

	?></p>
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
<form action="editpass.php" method="POST">
&nbspCurrent Password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="cur_pass" required><br><br>
&nbspNew Password&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="password" name="new_pass" required><br><br>
&nbspRe-enter New Password&nbsp&nbsp<input type="password" name="re_new_pass" required><br><br>
&nbsp<input type="submit" Value="Submit"><br><br>
</form>