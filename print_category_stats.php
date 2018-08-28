<?php

require 'core.inc.php';
require 'connect.inc.php';

$month=$_GET['month'];
$category=$_GET['category'];

switch($month)
{
    case "January": $date='2015-01-%';
                    break;
    case "February": $date='2015-02-%';
                    break;
    case "March": $date='2015-03-%';
                    break;
    case "April": $date='2015-04-%';
                    break;
    case "May": $date='2015-05-%';
                    break;
    case "June": $date='2015-06-%';
                    break;
    case "July": $date='2015-07-%';
                    break;
    case "August": $date='2015-08-%';
                    break;
    case "September": $date='2015-09-%';
                    break;
    case "October": $date='2015-10-%';
                    break;
    case "November": $date='2015-11-%';
                    break;
    case "December": $date='2015-12-%';
                    break;
}

?>

<html>
    <head>
        <title>Print statistics</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="statistics.php?month=<?php echo $month?>">Back to statistics</a><br><br>
        <?php
            $query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$category."') AND Issue_Date LIKE '".$date."' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
            $query_run3=mysql_query($query3);
            if(mysql_num_rows($query_run3)==0)
                echo 'No books of this category were issued';
            else
            {
                echo '<b>Most issued '.$category.' books in '.$month.': </b><br>';
                echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
                                        while($arr=mysql_fetch_assoc($query_run3))
                                        {
                                        echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
                                        }
                echo '</tbody></table><br><br>';


                $query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$category."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '".$date."')";
                $query_run4=mysql_query($query4);
                echo '<b>Not issued '.$category.' books in '.$month.': </b><br>';
                echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
                while($arr=mysql_fetch_assoc($query_run4))
                {
                    echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
                }
                echo '</tbody></table><br><br>';
            }

        ?>