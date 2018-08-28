<?php

require 'core.inc.php';
require 'connect.inc.php';

?>

<html>
    <head>
        <title>Print Book Details</title>
    </head>
    <body>
        <a href="yearly_books.php">Back to Books' report</a><br><br>
        <script>
            window.print();
        </script>
        <?php
            
        echo '<b>Book Report for Year 2015 :</b><br><br>';
        echo '<table border="2" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>ISBN</th><th>Edition</th><th>Copies</th><th>Publisher</th><th>Place of Publication</th><th>Year of Publication</th><th>Cost</th><th>Vendor</th></tr></thead><tbody>';
        $query="SELECT DISTINCT Title,Author,Edition,ISBN,Publisher,Place,Year,Cost,Vendor FROM Book WHERE Bought_Year='2015'";
        $query_run=mysql_query($query);
        if(mysql_num_rows($query_run)>0)
        {
            while($arr=mysql_fetch_assoc($query_run))
            {
                $query1="SELECT COUNT(ISBN) FROM Book WHERE Title='".mysql_real_escape_string($arr['Title'])."'";
                $query_run1=mysql_query($query1);
                $copies=mysql_result($query_run1,0,'COUNT(ISBN)');
                echo mysql_error();
                echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Edition'].'</td><td>'.$copies.'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Place'].'</td><td>'.$arr['Year'].'</td><td>'.$arr['Cost'].'</td><td>'.$arr['Vendor'].'</td></tr>';
            }
        echo '</tbody></table>';
        }
        else
            echo 'No books bought this year.';
    
        ?>
    </body>
</html>
