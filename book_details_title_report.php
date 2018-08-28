<?php

require 'core.inc.php';
require 'connect.inc.php';

$title=$_GET['title'];

?>

<html>
    <head>
        <title>Print Book Details</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="book_details_title.php?full_title=<?php echo $title?>">Back to Book Details</a><br><br>
        <?php
        
            $query = "SELECT * FROM Book WHERE Title='$title'";
        $query_run = mysql_query($query);
        $arr=mysql_fetch_assoc($query_run);
        echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><tbody>';
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
    </body>
</html>