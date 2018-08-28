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
    <br>
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
    <a id="statistics" href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
	</p>
</div>
<div class="page">
	<p><b><a name = "top"></a>Statistics:</b></p>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    Monthly statistics of :
    	<select name="month">
    		<option value = "Select">Select..</option>
 			<option value = "January">January</option>
 			<option value = "February">February</option>
 			<option value = "March">March</option>
 			<option value = "April">April</option>
 			<option value = "May">May</option>
 			<option value = "June">June</option>
 			<option value = "July">July</option>
 			<option value = "August">August</option>
 			<option value = "September">September</option>
 			<option value = "October">October</option>
 			<option value = "November">November</option>
 			<option value = "December">December</option>
    	</select>
    <input type="submit" value="Submit" />
	</form>
<?php

if(isset($_GET['month']))
 {
 $month = $_GET['month'];
 if($month != 'Select')
   {  
    echo '<a href = "#total">Transaction history</a><br>';
    echo '<a href = "#most">Most Issued Books</a><br>';
    echo '<a href = "#least">Least Issued Books</a><br>';
    echo '<a href = "#category-wise">Category Wise Statistics</a><br>';
    echo '<a href = "print_stats.php?month='.$month.'">Print Statistics</a><br>';

    echo '<br><b>Transactions in '.$month.':</b><br>';
    switch($month)
    {
    case "January"    : $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-01-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '   <tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-01-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-01-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category1"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';
    					}

    					break;	
    case "February"   : $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-02-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-02-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-02-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category2"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';
    					}
    					break;
    case "March" :  	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-03-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}

							echo '</tbody></table><br><br>';
							echo '<a href = "#top">Back to top</a><br><br>';

							$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-03-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
							$query_run1=mysql_query($query1);
							echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
							echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}

							echo '</tbody></table><br><br>';
							echo '<a href = "#top">Back to top</a><br><br>';

							$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-03-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
							$query_run2=mysql_query($query2);
							echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
							echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
							
							echo '</tbody></table><br><br>';
							echo '<a href = "#top">Back to top</a><br><br>';

							echo 'Statistics by Category: <br>';
							$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category3"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "April"   :    $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-04-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-04-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-04-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category4"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "May"	: 		$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-05-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-05-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-05-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category5"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "June"	: 		$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-06-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-06-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-06-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category6"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "July"	: 		$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-07-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-07-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-07-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category7"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "August"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-08-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-08-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-08-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category8"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "September"	:   $query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-09-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-09-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-09-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category9"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    						break;
    case "October"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-10-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-10-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-10-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category10"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "November"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-11-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-11-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-11-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category11"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    case "December"	: 	$query="SELECT Transaction.*,Book.Title,Book.Author,Book.Publisher FROM Transaction,Book WHERE Transaction.Book_ID=Book.Book_ID AND Issue_Date LIKE '2015-12-%'";
    					$query_run=mysql_query($query);
    					if(mysql_num_rows($query_run)==0)
    						echo 'No transactions<br>';
    					else
    					{
    						echo '<a name = "total"></a><table border="1" cellpadding="10" ><thead><tr><th>User ID</th><th>Accession No.</th><th>Title</th><th>Author</th><th>Publisher</th><th>Issue Date</th><th>Return Date</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run))
							{
							echo '<tr><td><a href="student_details.php?Student_ID='.$arr['User_ID'].'">'.$arr['User_ID'].'</a></td><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Issue_Date'].'</td><td>'.$arr['Return_Date'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query1="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-12-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC LIMIT 5";
								$query_run1=mysql_query($query1);
								echo '<b><a name = "most"></a>Most issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run1))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								$query2="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book) AND Issue_Date LIKE '2015-12-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) ASC LIMIT 5";
								$query_run2=mysql_query($query2);
								echo '<b><a name = "least"></a>Least issued books in '.$month.':</b><br>';
								echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run2))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
								echo '</tbody></table><br><br>';
								echo '<a href = "#top">Back to top</a><br><br>';

								echo 'Statistics by Category: <br>';
								$print='<a name = "category-wise"></a><form action = "statistics.php" method = "POST">Category: <select name = "Category12"> <option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"><br></form>';

    					}
    					break;
    }
 }
 else
   echo 'Please select a valid category';
}

	?>


<?php

if(isset($print))
	{
		echo $print;
		echo '<a href = "#top">Back to top</a><br><br>';
	}

if(isset($_POST['Category1']))
{
    $text=$_POST['Category1'];
    echo '<a href="print_category_stats.php?month=January&category='.$text.'">Print category stats</a><br><br>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-01-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in January: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';


	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-01-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in January: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
    
}
}

if(isset($_POST['Category2']))
{
    
$text=$_POST['Category2'];
    echo '<a href="print_category_stats.php?month=February&category='.$text.'">Print category stats</a><br><br>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-02-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in February: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-02-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in February: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category3']))
{
$text=$_POST['Category3'];
echo '<a href="print_category_stats.php?month=March&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-03-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in March: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-03-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in March: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category4']))
{
$text=$_POST['Category4'];
echo '<a href="print_category_stats.php?month=April&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-04-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in April: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-04-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in April: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category5']))
{
$text=$_POST['Category5'];
echo '</a><a href="print_category_stats.php?month=May&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-05-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in May: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-05-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in May: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category6']))
{
$text=$_POST['Category6'];
echo '<a href="print_category_stats.php?month=June&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-06-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in June: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-06-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in June: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category7']))
{
$text=$_POST['Category7'];
echo '<a href="print_category_stats.php?month=July&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-07-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in July: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';
	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-07-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in July: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category8']))
{
$text=$_POST['Category8'];
echo '<a href="print_category_stats.php?month=August&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-08-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in August: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-08-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in August: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category9']))
{
$text=$_POST['Category9'];
echo '<a href="print_category_stats.php?month=September&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-09-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in September: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-09-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in September: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category10']))
{
$text=$_POST['Category10'];
echo '<a href="print_category_stats.php?month=October&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-10-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in October: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-10-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in October: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category11']))
{
$text=$_POST['Category11'];
echo '<a href="print_category_stats.php?month=November&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-11-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in November: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-11-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in November: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

if(isset($_POST['Category12']))
{
$text=$_POST['Category12'];
echo '<a href="print_category_stats.php?month=December&category='.$text.'">Print category stats</a>';
$query3="SELECT Book.Title,Book.Author,Book.Publisher,COUNT(Transaction.ISBN) FROM Transaction,Book WHERE Transaction.ISBN IN (SELECT DISTINCT ISBN FROM Book WHERE Category='".$text."') AND Issue_Date LIKE '2015-12-%' AND Transaction.Book_ID=Book.Book_ID GROUP BY Transaction.ISBN ORDER BY COUNT(Transaction.ISBN) DESC";
$query_run3=mysql_query($query3);
if(mysql_num_rows($query_run3)==0)
	echo 'No books of this category were issued';
else
{
	echo '<b>Most issued '.$text.' books in December: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th><th>No. of times issued</th></tr></thead><tbody>';
							while($arr=mysql_fetch_assoc($query_run3))
							{
							echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['COUNT(Transaction.ISBN)'].'</td></tr>';
							}
	echo '</tbody></table><br><br>';

	$query4="SELECT DISTINCT Title,Author,Publisher FROM `Book` WHERE Category='".$text."' AND ISBN NOT IN (SELECT ISBN FROM Transaction WHERE Issue_Date LIKE '2015-12-%')";
	$query_run4=mysql_query($query4);
	echo '<b>Not issued '.$text.' books in December: </b><br>';
	echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
	while($arr=mysql_fetch_assoc($query_run4))
	{
		echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
	}
	echo '</tbody></table><br><br>';
}
}

?>


</div>
