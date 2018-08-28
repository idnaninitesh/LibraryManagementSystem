<?php

require 'core.inc.php';
require 'connect.inc.php';


//echo 'You are logged in, 	'.$_SESSION['user_name'].' <a href="logout.php">     Log out     </a>'.'<br />';
//echo '<a href="editpass.php">     Edit Password     </a><br>';

if(isset($_POST['filter']))
{
    $filter = $_POST['filter'];

   switch($filter)
    {
    case "Title"    : //echo 'Title';
                      $print = '<br><form action = "staff.php" method = "POST">Title: <input type = "text" name = "Title" required><input type = "Submit" value = "Search">'.'<br >'.'</form>';
    			      break;	
    case "Author"   : //echo 'Author';
                      $print = '<br><form action = "staff.php" method = "POST">Author: <input type = "text" name = "Author" required><input type = "Submit" value = "Search">'.'<br >'.'</form>';
                      break;
    case "Category" : //echo 'Category';
    				          $print = '<br><form action = "staff.php" method = "POST">Category: <select name = "Category"> <option value = "Select">Select..</option><option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"'.'<br >'.'</form>';
                      break;
   case "ISBN"      : $print = '<br><form action = "staff.php" method = "POST">ISBN: <input type = "text" name = "ISBN" required>'.'<br >'.'<br >'.'<br >'.'<input type = "Submit" value = "Submit"'.'<br >'.'</form>';
    				   break;
   case "Publisher" : $print = '<br><form action = "staff.php" method = "POST">Publisher: <input type = "text" name = "Publisher" required>'.'<br >'.'<br >'.'<br >'.'<input type = "Submit" value = "Submit"'.'<br >'.'</form>';
    				   break;
  	default : $default = 'Please select a category';
    }
}

  
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
    <a id = "staff" href = "staff.php">&nbsp&nbsp&nbspHome</a>
    <a href="student_details.php">&nbsp&nbsp&nbspView Student Details</a>
    <a href="book_details.php">&nbsp&nbsp&nbspView Book Details</a>
    <a href="issue_book.php">&nbsp&nbsp&nbspIssue Book</a>
    <a href="return_book.php">&nbsp&nbsp&nbspReturn Book</a>
    <a href="contact_vendor.php">&nbsp&nbsp&nbspContact Vendor</a>
    <a href="add_user.php">&nbsp&nbsp&nbspAdd User</a>
    <a href="add_book.php">&nbsp&nbsp&nbspAdd Books</a>
    <a href="remove_book.php">&nbsp&nbsp&nbspRemove Books</a>
    <a href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
  </p>
</div>
<div class="page">
	<br>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Search by:
    	<select name="filter">
 	 		<option value = "Select">Select..</option>
 			<option value = "Title">Title</option>
 			<option value = "Author">Author</option>
 			<option value = "Category">Category</option>
 	 		<option value = "ISBN">ISBN</option>
     		<option value = "Publisher">Publisher</option>
    	</select>
    <input type="submit" value="Submit" />
	</form>

<?php

if(isset($print))
  {
    echo $print;
  }

  if(isset($_POST['Title']))
    {
    $text = $_POST['Title'];
    if(!empty($text))
      {
      $query = "SELECT * FROM Book WHERE Title LIKE '%".$text."%' ";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Call No.</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >'.mysql_error();
      while($arr = mysql_fetch_assoc($query_run))
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
         echo '<tr><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Call_No'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';
        }
      }
    }

if(isset($_POST['Author']))
    {
    $text = $_POST['Author'];
    if(!empty($text))
      {
      $query = "SELECT * FROM Book WHERE Author LIKE '%".$text."%' ";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Call No.</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
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
         echo '<tr><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Call_No'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';
        }
      }
    }

if(isset($_POST['Category']))
	{
	$text = $_POST['Category'];
    if($text == 'Select')
      echo 'Select a valid category';
    else if(!empty($text))
      {
      $query = "SELECT * FROM Book WHERE Category='".$text."'";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Call No.</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
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
         echo '<tr><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Call_No'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';
        }
      }
	}

if(isset($_POST['ISBN']))
  {
  $text = $_POST['ISBN'];
    if(!empty($text))
      {
      $query = "SELECT * FROM Book WHERE ISBN LIKE '%".$text."%' ";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Call No.</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
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
         echo '<tr><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Call_No'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';
        }
      }
  }


if(isset($_POST['Publisher']))
  {
  $Publisher = $_POST['Publisher'];
  if(!empty($Publisher))
     {
      $query = "SELECT `Book`.* FROM `Book` WHERE `Book`.`Publisher` LIKE '%".$Publisher."%' ";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Call No.</th><th>Edition</th><th>Cost</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
        {
          if($arr['Remark']=='Withdrawn')
              continue;
         echo '<tr><td><a href="book_details.php?Book_ID='.$arr['Book_ID'].'">'.$arr['Book_ID'].'</a></td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Call_No'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td></tr>';
        }
     }
  }

  if(isset($default))
  	echo $default;

?>