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
    <a id="add_book" href="add_book.php">&nbsp&nbsp&nbspAdd Books</a>
    <a href="remove_book.php">&nbsp&nbsp&nbspRemove Books</a>
    <a href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a><br>
  </p>
</div>
<div class="page">
  <p><b>Add Book:</b></p>
	<form action="add_book.php" method="POST">
		No of copies:&nbsp&nbsp&nbsp<input type="text" name="copies" required><br><br>
    Title:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Title" required><br><br>
  Author:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type= "text" name = "Author" required><br><br>
  Category:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select name = "Category" required>
   <option value = "Select">Select..</option>
   <option value = "Physics">Physics</option>
   <option value = "Chemistry">Chemistry</option>
   <option value = "Electrical">Electrical</option>
   <option value = "Civil">Civil</option>
   <option value = "Computers">Computers</option>
   <option value = "Mechanical">Mechanical</option>
   <option value = "Electronics">Electronics</option>
   <option value = "Communications">Communications</option>
   <option value = "Textile">Textile</option>
   <option value = "Production">Production</option>
   <option value = "Management">Management</option>
  </select><br><br>
  ISBN:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "ISBN" required><br><br>
  Call no:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Call_No" required><br><br>
  Publisher:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Publisher"><br><br>
  Year of <br>Publication:&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Year"><br><br>
  Place:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Place"><br><br>
  Edition:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Edition"><br><br>
  Cost:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Cost"><br><br>
  Vendor:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Vendor" maxlength="40"><br><br>
  Abstract:<br> <textarea name= "Abstract" rows = "8" cols = "60"></textarea><br><br>
  <input type="submit" value="Submit">
  </form>

<?php

if(isset($_POST['copies']) && !empty($_POST['copies']) && isset($_POST['Title']) && isset($_POST['Author']) && isset($_POST['Category']) && isset($_POST['ISBN']) && isset($_POST['Call_No']) && isset($_POST['Publisher']) && isset($_POST['Year']) && isset($_POST['Place']) && isset($_POST['Vendor']) && isset($_POST['Edition']) && isset($_POST['Cost']) && isset($_POST['Abstract']))
  {
  $copies = $_POST['copies'];
  if($copies>0)
      {
      $query = "SELECT MAX(`Book`.`Book_ID`) FROM `Book` ";
      $query_run = mysql_query($query);

      $Book_ID = mysql_result($query_run, 0) + 1;

      $Title = $_POST['Title'];
      $Author = $_POST['Author'];
      $Category = $_POST['Category']; 
      $ISBN = $_POST['ISBN'];
      $Call_No = $_POST['Call_No'];
      $Publisher = $_POST['Publisher'];
      $Year = $_POST['Year'];
      $Place = $_POST['Place'];
      $Vendor=$_POST['Vendor'];
      $Edition = $_POST['Edition'];
      $Rating = 0;
      $Cost = $_POST['Cost'];
      $Abstract = $_POST['Abstract'];
      
    echo 'Books with Book_ID : '.'<br>';
      
      $query = "INSERT INTO `Book`(`Book_ID`, `Title`, `Author`, `Category`, `ISBN`, `Call_No`, `Publisher`, `Year`, `Place`, `Edition`,`Cost`, `Abstract`,`Remark`,`Bought_Year`,`Vendor`) VALUES ('$Book_ID', '$Title', '$Author', '$Category', '$ISBN', '$Call_No', '$Publisher', '$Year', '$Place', '$Edition','$Cost', '$Abstract','For reference','2015','$Vendor') ";

         $query_run = mysql_query($query);

         if($query_run)
           {
           echo $Book_ID++.' (ref)  ';  
           $copies--;
           }

      while($copies > 0)
        {
         $query = "INSERT INTO `Book`(`Book_ID`, `Title`, `Author`, `Category`, `ISBN`, `Call_No`, `Publisher`, `Year`, `Place`, `Edition`,`Cost`, `Abstract`,`Bought_Year`,`Vendor`) VALUES ('$Book_ID', '$Title', '$Author', '$Category', '$ISBN', '$Call_No', '$Publisher', '$Year', '$Place', '$Edition','$Cost', '$Abstract','2015','$Vendor') ";

         $query_run = mysql_query($query);

         if($query_run)
           {
           echo $Book_ID++.' ';  
           $copies--;
           }
        }
      if($copies == 0)
        echo 'added';
      }
    else
        echo 'Enter more than zero copies.';
   
  }


?>

</div>
