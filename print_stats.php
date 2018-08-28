<?php

require 'core.inc.php';
require 'connect.inc.php';

$month=$_GET['month'];


?>

<html>
    <head>
        <title>Print statistics</title>
    </head>
    <body>
        <script>
            window.print();
        </script>
        <a href="statistics.php?month=<?php echo $month?>">Back to statistics</a>
        <?php
    echo '<br><b>Transactions in '.$month.':</b><br>';
   switch($month)
    {
    case "January"    : $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-01-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-01-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-01-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								
    					}

    					break;	
    case "February"   : $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-02-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-02-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-02-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								
    					}
    					break;
    case "March" :  	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-03-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}

							echo '</tbody></table><br><br>';
							 

							$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-03-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
							$query_run1=mysql_query($query1);
							echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
							echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}

							echo '</tbody></table><br><br>';
							 

							$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-03-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
							$query_run2=mysql_query($query2);
							echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
							echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
							
							echo '</tbody></table><br><br>';
							 

							}
    					break;
    case "April"   :    $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-04-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-04-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-04-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								
    					}
    					break;
    case "May"	: 		$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-05-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; "><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-05-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-05-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 
								
    					}
    					break;
    case "June"	: 		$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-06-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-06-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-06-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 								

    					}
    					break;
    case "July"	: 		$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-07-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-07-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-07-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 								
    					}
    					break;
    case "August"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-08-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-08-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-08-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 								
    					}
    					break;
    case "September"	:   $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-09-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-09-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-09-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 								
    					}
    						break;
    case "October"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-10-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-10-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-10-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 
    					}
    					break;
    case "November"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-11-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-11-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-11-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
																
    					}
    					break;
    case "December"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-12-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td>'.$arr['User_ID'].'</td><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-12-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-12-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; text-align: center; " ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								 								
    					}
    					break;
    }

        ?>
    </body>
</html>