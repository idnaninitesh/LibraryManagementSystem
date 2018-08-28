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
    <a id="contact_vendor" href="contact_vendor.php">&nbsp&nbsp&nbspContact Vendor</a>
    <a href="add_user.php">&nbsp&nbsp&nbspAdd User</a>
    <a href="add_book.php">&nbsp&nbsp&nbspAdd Books</a>
    <a href="remove_book.php">&nbsp&nbsp&nbspRemove Books</a>
    <a href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
	</p>
</div>
<div class="page">
	<?php
        echo '<a href="contact_vendor_report.php">Print Report</a><br><br>';
		$query="SELECT Vendor.*, Vendor_Contact.Contact_no FROM Vendor,Vendor_Contact WHERE Vendor.Vendor_ID=Vendor_Contact.Vendor_ID";
		$query_run=mysql_query($query);
		if($query_run)
			{
				echo '<b>Vendors:</b><br><br>';
				if(mysql_num_rows($query_run)==0)
					echo 'No Vendors available';
				else
				{
					echo '<table border="1" cellpadding="10" ><thead><tr><th>Vendor ID</th><th>Name</th><th>Email ID</th><th>Contact No.</th></tr></thead><tbody>';
					while($arr=mysql_fetch_assoc($query_run))
					{
						echo '<tr><td>'.$arr['Vendor_ID'].'</td><td>'.$arr['Name'].'</td><td><a href="mailto:'.$arr['Email_id'].'?Subject=Order%20new%20books" target="_top">'.$arr['Email_id'].'</a></td><td>'.$arr['Contact_no'].'</td></tr>';
					}
					echo '</tbody></table><br><br>';
				}
			}
	?>
</div>
