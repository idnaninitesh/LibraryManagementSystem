<?php

require 'core.inc.php';
require 'connect.inc.php';

$id=$_GET['id'];

?>

<html>
    <head>
        <title>Print Book Details</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="book_details.php?Book_ID=<?php echo $id?>">Back to Book Details</a><br><br>
        <?php
            
        if(isset($id))
        {
        if(!empty($id))
        {
        $query="SELECT * FROM Book WHERE Book_ID='$id'";
        $query_run=mysql_query($query);
        if($query_run)
        {
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
        
        $issued_Book='None';
        $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";
        $query_r = mysql_query($query);
        if($query_r && mysql_num_rows($query_r)==1)
            $issued_Book = mysql_result($query_r, 0,'User_ID');
        if($issued_Book=='None')
            echo '<tr><td><b>Currently Issued by </b> </td><td>None'.'</td></tr>';
        else
            echo '<tr><td><b>Currently Issued by</b> </td><td><a href="student_details.php?Student_ID='.$issued_Book.'">'.$issued_Book.'</a>'.'</td></tr>';
            
        $res_book='None';
        $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
        $query_r1 = mysql_query($query);
        if($query_r1 && mysql_num_rows($query_r1))
            $res_book=mysql_result($query_r1,0,'User_ID');
        if($res_book=='None')
            echo '<tr><td><b>Currently Reserved by </b> </td><td>None'.'</td></tr>';
        else
            echo '<tr><td><b>Currently Reserved by </b>: </td><td><a href="student_details.php?Student_ID='.$res_book.'">'.$res_book.'</a>'.'</td></tr>';
        echo '</tbody></table><br><br>';    
        }
        else
            echo 'Not a valid Accession No.';
    }
}
    

    
        ?>
    </body>
</html>