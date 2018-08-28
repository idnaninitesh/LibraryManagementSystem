<?php

require 'core.inc.php';
require 'connect.inc.php';

if(isset($_POST['filter']))
{
    $filter = $_POST['filter'];

   switch($filter)
    {
    case "Title"    : //echo 'Title';
                      $print = '<br><form action = "remove_book.php" method = "POST">Title: <input type = "text" name = "Title" required><input type = "Submit" value = "Search">'.'<br >'.'</form>';
                break;  
    case "Author"   : //echo 'Author';
                      $print = '<br><form action = "remove_book.php" method = "POST">Author: <input type = "text" name = "Author" required><input type = "Submit" value = "Search">'.'<br >'.'</form>';
                      break;
    case "Category" : //echo 'Category';
                      $print = '<br><form action = "remove_book.php" method = "POST">Category: <select name = "Category"> <option value = "Select">Select..</option><option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"'.'<br >'.'</form>';
                      break;
   case "ISBN"      : $print = '<br><form action = "remove_book.php" method = "POST">ISBN: <input type = "text" name = "ISBN" required>'.'<br >'.'<br >'.'<br >'.'<input type = "Submit" value = "Submit"'.'<br >'.'</form>';
               break;
    default : $print = 'Please select a category';
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
    <a href="staff.php">&nbsp&nbsp&nbspHome</a>
    <a href="student_details.php">&nbsp&nbsp&nbspView Student Details</a>
    <a href="book_details.php">&nbsp&nbsp&nbspView Book Details</a>
    <a href="issue_book.php">&nbsp&nbsp&nbspIssue Book</a>
    <a href="return_book.php">&nbsp&nbsp&nbspReturn Book</a>
    <a href="contact_vendor.php">&nbsp&nbsp&nbspContact Vendor</a>
    <a href="add_user.php">&nbsp&nbsp&nbspAdd User</a>
    <a href="add_book.php">&nbsp&nbsp&nbspAdd Books</a>
    <a id="remove_book" href="remove_book.php">&nbsp&nbsp&nbspRemove Books</a>
    <a href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
  </p>
</div>
<div class="page">
  <p><b>Remove Book by:</b></p>
	<form action="remove_book.php" method="POST">
    <select name="filter">
      <option value = "Select">Select..</option>
      <option value = "Title">Title</option>
      <option value = "Author">Author</option>
      <option value = "Category">Category</option>
      <option value = "ISBN">ISBN</option>
      </select>
    <input type="submit" value="Submit">
  </form>

<?php

  if(isset($print))
  {
    echo $print;
  }

  if(isset($_POST['ISBN']))
  {
    $isbn=$_POST['ISBN'];
    $query="SELECT Book_ID,Title,Author,ISBN,Category FROM Book WHERE ISBN LIKE '%".$isbn."%'";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)==0)
      echo 'No books with this ISBN available in the library<br>';
    else
    {
      echo '<table border="2" cellpadding="10" ><thead><tr><th>Book ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Category</th><th>Status</th></tr></thead><tbody>';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }       
         if($status=='Available')
          $status='<form action="remove_book.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Remove"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Category'].'</td><td>'.$status.'</td></tr>';
        }
      }
  }

  if(isset($_POST['Title']))
    {
      $title=$_POST['Title'];
    $query="SELECT Book_ID,Title,Author,ISBN,Category FROM Book WHERE Title LIKE '%".$title."%'";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)==0)
      echo 'No books with this Title available in the library<br>';
    else
    {
      echo '<table border="2" cellpadding="10" ><thead><tr><th>Book ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Category</th><th>Status</th></tr></thead><tbody>';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }       
         if($status=='Available')
          $status='<form action="remove_book.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Remove"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Category'].'</td><td>'.$status.'</td></tr>';
        }
      }
    }

if(isset($_POST['Author']))
    {
    $author=$_POST['Author'];
    $query="SELECT Book_ID,Title,Author,ISBN,Category FROM Book WHERE Author LIKE '%".$author."%'";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)==0)
      echo 'No books by this Author are available in the library<br>';
    else
    {
      echo '<table border="2" cellpadding="10" ><thead><tr><th>Book ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Category</th><th>Status</th></tr></thead><tbody>';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }       
         if($status=='Available')
          $status='<form action="remove_book.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Remove"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Category'].'</td><td>'.$status.'</td></tr>';
        }
      }
    }

if(isset($_POST['Category']))
  {
  $cat=$_POST['Category'];
   if($cat == 'Select')
    {
    echo 'Select a valid category'; 
    }
   else
    {
    $query="SELECT Book_ID,Title,Author,ISBN,Category FROM Book WHERE Category LIKE '%".$cat."%'";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)==0)
      echo 'No books of this Category are available in the library<br>';
    else
     {
      echo '<table border="2" cellpadding="10" ><thead><tr><th>Book ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Category</th><th>Status</th></tr></thead><tbody>';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $status=$status.$user_ID;
            }       
         if($status=='Available')
          $status='<form action="remove_book.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Remove"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Category'].'</td><td>'.$status.'</td></tr>';
        }
      }
    }
  }


if(isset($_POST['id']))
  {
    $query="UPDATE Book SET Remark='Withdrawn' WHERE Book_ID='".$_POST['id']."'";
    $query_run=mysql_query($query);
    if($query_run)
      echo 'Book withdrawn.';
    else
      echo mysql_error();
  }
echo '</tbody></table>';
  
?>

</div>
