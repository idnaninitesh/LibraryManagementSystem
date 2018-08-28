<?php

require 'core.inc.php';
require 'connect.inc.php';

$id=$_GET['id'];

?>

<html>
    <head>
        <title>Print statistics</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="student_details.php?Student_ID=<?php echo $id?>">Back to Student Details</a><br><br>
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

if(isset($id))
  {	    
  if(!empty($id))
    {
    $query="SELECT Name,Branch,Year,Degree FROM User WHERE User_ID='$id' ";
		
    $query_run=mysql_query($query);
    $arr=mysql_fetch_assoc($query_run);

    if(mysql_num_rows($query_run) == 0)
      echo 'No records found'.'<br >';
    else
      {
      echo '<table border="2" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center;"><thead><tr><th>Name</th><th>Branch</th><th>Degree</th><th>Year</th><th>Fine</th></tr></thead><tbody><tr><td>'.$arr['Name'].'</td><td>'.$arr['Branch'].'</td><td>'.$arr['Degree'].'</td><td>'.$arr['Year'].'</td>';

      $query="SELECT User_ID,SUM(Fine) FROM (SELECT DISTINCT Transaction.User_ID,Transaction.Book_ID,Transaction.Issue_Date,Transaction.Return_Date,Fine.Fine FROM Transaction,Fine WHERE Transaction.User_ID='".$id."' AND Transaction.Issue_Date=Fine.Issue_Date AND Transaction.Return_Date=Fine.Return_Date) AS test";

      $query_run=mysql_query($query);
      $arr=mysql_fetch_assoc($query_run);
      echo '<td>'.$arr['SUM(Fine)'].'</td><tr></tbody></table><br><br>';

      $query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Book_ID FROM Transaction WHERE Return_Date IS NULL AND User_ID='$id')";

      $query_run=mysql_query($query);
      echo 'Books in possession: '.'<br>';

      while($arr=mysql_fetch_assoc($query_run))
   	    {
	    echo $arr['Book_ID'].' - '.$arr['Title'].'<br>';
	    }
	
      $query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Reserve.Book_ID FROM User_RID,Reserve WHERE User_RID.RID=Reserve.RID AND User_RID.User_ID='$id'AND DATEDIFF(CURDATE(),Date)<=2)";

      $query_run=mysql_query($query);
      echo '<br>';
      echo 'Books reserved: '.'<br><br>';
      while($arr=mysql_fetch_assoc($query_run))
        {
	    echo $arr['Book_ID'].' - '.$arr['Title'].'<form action="student_details.php" method="POST"><input type="hidden" name="sid" value="' . (int)$id . '" /><input type="hidden" name="bid" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Issue"></form><br><br>';
	    }
      }      
      $query = "SELECT `Book`.`Book_ID`,`Book`.`Title`,`Transaction`.`Issue_Date`,`Transaction`.`Return_Date` FROM `Book`,`Transaction` WHERE `Transaction`.`User_ID` = '".$id."' AND Book.Book_ID=Transaction.Book_ID AND `Book`.`Book_ID` IN (SELECT `Transaction`.`Book_ID` FROM `Transaction` WHERE `Transaction`.`User_ID` = '".$id."' ) ";

  $query_run = mysql_query($query);
  if(mysql_num_rows($query_run) == 0)
    echo 'No history found'.'<br >';
  else
    {
      echo '<br><br><b>Student History:</b><br><br>';
      echo '<table cellpadding = "10" border="2" style="width:100%; border-collapse: collapse;"><thead><tr><th>Book ID</th><th>Title</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></tr></thead><tbody>';   
    while($arr = mysql_fetch_assoc($query_run))   
    {  
      
    $query = "SELECT DISTINCT `Fine`.`Fine` FROM `Fine` JOIN `Transaction` ON `Transaction`.`User_ID` = '".$id."' AND `Fine`.`Issue_Date` = '".$arr['Issue_Date']."' AND `Fine`.`Return_Date` = '".$arr['Return_Date']."' AND `Transaction`.`Book_ID` = '".$arr['Book_ID']."' ";

    $query_r = mysql_query($query);
    
    if(mysql_num_rows($query_r) == 1)
      $Fine = mysql_result($query_r, 0);
    else
      $Fine = calculate_fine($arr['Issue_Date'],date('Y-m-d'));
    echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td><td>'.$Fine.'</td></tr>';
    }      
  } 

    }
  }
        ?>
    </body>
</html>