<?php

require 'core.inc.php';
require 'connect.inc.php';

?>

<html>
    <head>
        <title>Print defaulters</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="late.php">Back to Defaulters</a><br><br>
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

        $query="SELECT Transaction.User_ID,User.Name,Transaction.Book_ID,Book.Title,Book.Author,Book.Publisher FROM User,Transaction,Book WHERE Transaction.User_ID=User.User_ID AND Transaction.Book_ID=Book.Book_ID AND DATEDIFF(CURDATE(),Transaction.Issue_Date)>37 AND Transaction.Return_Date IS NULL";
        $query_run=mysql_query($query);
        if(mysql_num_rows($query_run)==0)
            echo '<br><br>No late students<br><br>';
        else{
            echo '<table border="2" cellpadding="10" style="width:100%; border-collapse: collapse;"><thead><tr><th>User_ID</th><th>Name</th><th>Book_ID</th><th>Title</th><th>Author</th><th>Publisher</th><th>Fine</th></tr></thead><tbody>';
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
                
                echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Name'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$fine.'</td></tr>';                
            }
            echo '</tbody></table><br><br>';
        }
        ?>