<?php

require 'core.inc.php';
require 'connect.inc.php';

if(isset($_GET['filter']))
{
    $filter = $_GET['filter'];

   switch($filter)
    {
    case "Title"    : 
                      $print = '<br><form action = "book_details.php" method = "GET">Title: <input type = "text" name = "Title" required>&nbsp;&nbsp;&nbsp;<input type = "Submit" value = "Get details">'.'<br >'.'</form>';
    			      break;	
    case "Book_ID"   : 
                      $print = '<br><form action = "book_details.php" method = "GET">Accession No.: <input type = "text" name = "Book_ID" required>&nbsp;&nbsp;&nbsp;<input type = "Submit" value = "Get Details">'.'<br >'.'</form>';
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
    <a href="staff.php">&nbsp&nbsp&nbspHome</a>
    <a href="student_details.php">&nbsp&nbsp&nbspView Student Details</a>
    <a id="book_details" href="book_details.php">&nbsp&nbsp&nbspView Book Details</a>
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
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
    Details by:
    	<select name="filter">
 	 		<option value = "Select">Select..</option>
 			<option value = "Book_ID">Accession No.</option>
 			<option value = "Title">Title</option>
    	</select>
    <input type="submit" value="Submit" />
	</form>
    
<?php

if(isset($print))
  {
    echo $print;
  }

if(isset($_GET['Title']))
    {
    $text = $_GET['Title'];
    if(!empty($text))
      {   
      $query = "SELECT * FROM Book WHERE Title LIKE '%".$text."%' ";
      $query_run = mysql_query($query);
        if(mysql_num_rows($query_run)<=0)
        {
            echo 'No such book exists.';
        }
        else
        {
            echo '<table border="1" cellpadding="10" ><thead><tr><th>Title</th><th>Author</th><th>Publisher</th></tr></thead><tbody>';
            $query = "SELECT DISTINCT Title,Author,Publisher FROM Book WHERE Title LIKE '%".$text."%' ";
            $query_run = mysql_query($query);
            while($arr=mysql_fetch_assoc($query_run))
            {
                echo '<tr><td><a href="book_details_title.php?full_title='.$arr['Title'].'">'.$arr['Title'].'</a></td><td>'.$arr['Author'].'</td><td>'.$arr['Publisher'].'</td></tr>';
            }
      }
      }
        echo '</tbody></table><br><br>';
}

if(isset($_GET['Book_ID']))
{
    echo '<a href="book_details_report.php?id='.$_GET['Book_ID'].'">Print Details</a><br><br>';
    
    $id=$_GET['Book_ID'];
    if(!empty($id))
    {
        $query="SELECT * FROM Book WHERE Book_ID='$id'";
        $query_run=mysql_query($query);
        if($query_run)
        {
        $arr=mysql_fetch_assoc($query_run);
        
        echo '<table border="1" cellpadding="10" ><tbody>';
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
    

if(isset($default))
    echo $default;

?>
</div >
