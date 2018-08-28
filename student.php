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
                      $print = '<br><form action = "student.php" method = "POST">Title: <input type = "text" name = "Title" required><input type = "Submit" value = "Search">'.'<br >'.'</form>';
    			            break;	
    case "Author"   : //echo 'Author';
                      $print = '<br><form action = "student.php" method = "POST">Author: <input type = "text" name = "Author" required><input type = "Submit" value = "Search">'.'<br >'.'</form>';
                      break;
    case "Category" : //echo 'Category';
    				          $display = '<br><form action = "student.php" method = "POST">Category: <select name = "Category" required> <option value = "Select">Select..</option><option value = "Physics">Physics</option><option value = "Chemistry">Chemistry</option><option value = "Electrical">Electrical</option><option value = "Civil">Civil</option><option value = "Computers">Computers</option><option value = "Mechanical">Mechanical</option><option value = "Electronics">Electronics</option><option value = "Communications">Communications</option><option value = "Textile">Textile</option><option value = "Production">Production</option><option value = "Management">Management</option> </select> <input type = "Submit" value = "Search"'.'<br >'.'</form>';
                      break;
  	default : $default='Please select a category';
    }
}

?>

<head>
	<link rel="stylesheet" type="text/css" href="student.css">
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
              <li><a href="editpass.php">Edit Password</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
        </li>
      </ul>
  </nav>
</div>
<div class="details">
	<p><?php
		$query="SELECT Name,Branch,Year,Degree FROM User WHERE User_ID='".$_SESSION['user_name']."'";
		$query_run=mysql_query($query);
		$arr=mysql_fetch_assoc($query_run);
		echo '&nbsp&nbsp&nbsp&nbspName:&nbsp&nbsp '.$arr['Name'].'<br>';
		echo '&nbsp&nbsp&nbsp&nbspBranch: '.$arr['Branch'].'<br>';
		echo '&nbsp&nbsp&nbsp&nbspYear:&nbsp&nbsp&nbsp '.$arr['Year'].'<br>';
		echo '&nbsp&nbsp&nbsp&nbspDegree: '.$arr['Degree'].'<br>';

    function calculate_fine($issue_date,$return_date)
       {

       $issue = strtotime($issue_date);
       $return = strtotime($return_date);

       $days = ($return - $issue)/(60*60*24) - 7;

       if($days <= 0)
         $fine = 0;
       else if($days <= 7)
              $fine = $days*1;
            else if($days <= 14)
                   $fine = 7 + ($days-7)*2;
                 else
                   $fine = 100;
       return $fine; 
       }

    $query = "SELECT `Transaction`.`Issue_Date`,`Transaction`.`Return_Date` FROM `Transaction` WHERE `Transaction`.`User_ID` = '".$_SESSION['user_name']."' ";

    $query_run = mysql_query($query);
    if(mysql_num_rows($query_run) > 0)
      {
      $Fine = 0;  
      while($arr = mysql_fetch_assoc($query_run))   
        {
        $issue_date = $arr['Issue_Date'];
        $return_date = $arr['Return_Date'];
        if(!isset($return_date))
          $return_date = date('Y-m-d');     
    
        $Fine += calculate_fine($issue_date,$return_date);
        }
      echo '&nbsp&nbsp&nbsp&nbspFine: &nbsp&nbsp&nbsp&nbspRs. '.$Fine.'<br><br>';
      }

	echo '<div class="tags">';
		$query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Book_ID FROM Transaction WHERE Return_Date IS NULL AND User_ID='".$_SESSION['user_name']."')";
		$query_run=mysql_query($query);
		echo '&nbsp&nbsp&nbsp&nbspBooks in possession: ';
		if(mysql_num_rows($query_run) == 0)
      echo '<br><br>&nbsp&nbsp&nbsp&nbspNo books issued at present<br><br>';
    else
      {
      echo '<ol type="1">';
      while($arr=mysql_fetch_assoc($query_run))
		    {
			  echo '<li>'.$arr['Book_ID'].' - '.$arr['Title'].'</li>';
		    } 
      echo '</ol>';
      }
		$query="SELECT Book_ID,Title FROM Book WHERE Book_ID IN (SELECT Reserve.Book_ID FROM User_RID,Reserve WHERE User_RID.RID=Reserve.RID AND User_RID.User_ID='".$_SESSION['user_name']."'AND DATEDIFF(CURDATE(),Date)<=2)";
		$query_run=mysql_query($query);
		echo '&nbsp&nbsp&nbsp&nbspBooks Reserved:';
		if(mysql_num_rows($query_run) == 0)
      echo '<br><br>&nbsp&nbsp&nbsp&nbspNo books reserved at present<br><br>';
    else
      {
      echo '<ol type="1">';
      while($arr=mysql_fetch_assoc($query_run))
		   {
			 echo '<li>'.$arr['Book_ID'].' - '.$arr['Title'].'</li>';
		   }
		  echo '</ol>';
      
      }
     echo '</div><br>';
	?>
    <a id = "student" href = "student.php">&nbsp&nbsp&nbspHome</a>
    <a href = "student_transaction.php">&nbsp&nbsp&nbspView transaction history</a>

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
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $Name= '';
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>';
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0);
            $status=$status.$Name;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }       
         if($arr['Remark']=='For reference')
              $status="<b>".'For reference'."</b>";
          if($arr['Remark']=='Withdrawn')
              continue;
         if($status=='Available')
         	$status='<form action="student.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Reserve"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';

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
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $Name='';
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by</b>';
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }       
          if($arr['Remark']=='For reference')
              $status="<b>".'For reference'."</b>";
          if($arr['Remark']=='Withdrawn')
              continue;
         if($status=='Available')
         	$status='<form action="student.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Reserve"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';
        }
      }
    }


if(isset($display))
  {
    echo $display; 
  }

if(isset($_POST['Category']))
	{
		$text = $_POST['Category'];
    if(!empty($text))
      {
      $query = "SELECT * FROM Book WHERE Category LIKE '".$text."'";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Accession No.</th><th>Title</th><th>Author</th><th>ISBN</th><th>Publisher</th><th>Edition</th><th>Cost</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $Name='';
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }       
          if($arr['Remark']=='For reference')
              $status="<b>".'For reference'."</b>";
          if($arr['Remark']=='Withdrawn')
              continue;
         if($status=='Available')
         	$status='<form action="student.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Reserve"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Publisher'].'</td><td>'.$arr['Edition'].'</td><td>'.$arr['Cost'].'</td><td>'.$status.'</td></tr>';
        }
      }
	}
if(isset($_POST['Rating']))
	{
		$text = $_POST['Rating'];
    if(!empty($text))
      {
      $query = "SELECT Book_ID,Title,Author,ISBN,Rating FROM Book WHERE Category = '".$text."' ORDER BY Rating DESC,Book_ID ASC";
      $query_run = mysql_query($query);
      if(mysql_num_rows($query_run) > 0)
        echo '<table border="2" cellpadding="10" ><thead><tr><th>Book ID</th><th>Title</th><th>Author</th><th>ISBN</th><th>Rating</th><th>Status</th></tr></thead><tbody>';
      else
      	echo 'No records found'.'<br >';
      while($arr = mysql_fetch_assoc($query_run))
        {
         $status = 'Available'; 
         $Name='';
         $query = "SELECT `Transaction`.`Book_ID`,`Transaction`.`User_ID` FROM `Transaction` WHERE `Transaction`.`Book_ID` = '".$arr['Book_ID']."' AND `Transaction`.`Return_Date` IS NULL";

         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Issued by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }
         $query = "SELECT `User_RID`.`User_ID`,`Reserve`.`Book_ID` FROM `User_RID` JOIN `Reserve` ON `User_RID`.`RID` = `Reserve`.`RID` WHERE `Reserve`.`Book_ID` = '".$arr['Book_ID']."' AND DATEDIFF(CURDATE(),`Reserve`.`Date`) <= 2";
         
         $query_r = mysql_query($query);
         if(mysql_num_rows($query_r) == 1)
            {
            $status = '<b>Reserved by </b>'; 
            $user_ID = mysql_result($query_r, 0,'User_ID');
            $query = "SELECT `User`.`Name` FROM `User` WHERE `User`.`User_ID` = '$user_ID' ";
			$query_r = mysql_query($query);
            $Name = mysql_result($query_r, 0); 
            $status=$status.$Name;
            }       
         if($status=='Available')
         	$status='<form action="student.php" method="POST"><input type="hidden" name="id" value="' . (int)$arr['Book_ID'] . '" /><input type="submit" value="Reserve"></form>';
         echo '<tr><td>'.$arr['Book_ID'].'</td><td>'.$arr['Title'].'</td><td>'.$arr['Author'].'</td><td>'.$arr['ISBN'].'</td><td>'.$arr['Rating'].'</td><td>'.$status.'</td></tr>';
        }
      }
	}

if(isset($default))
	echo $default;	
if(isset($_POST['id']))
	{
		$query1 = "SELECT `Reserve`.`RID` FROM `Reserve` JOIN `User_RID` ON `User_RID`.`User_ID` = '".$_SESSION['user_name']."' AND `Reserve`.`RID` = `User_RID`.`RID` AND  DATEDIFF(CURDATE(),`Reserve`.`Date`) < 2 AND `Reserve`.`Book_ID` IN 
               (SELECT `Book`.`Book_ID` FROM `Book` WHERE `Book`.`ISBN` IN (SELECT `Book`.`ISBN` FROM `Book` WHERE `Book`.`Book_ID` = '".$_POST['id']."'))" ;

    $query_run1 = mysql_query($query1);

    $query5="SELECT User_ID,ISBN FROM Transaction WHERE User_ID='".$_SESSION['user_name']."' AND ISBN IN (SELECT ISBN FROM Book WHERE Book_ID='".$_POST['id']."') AND Return_Date IS NULL";
    $query_run5=mysql_query($query5);
    if(mysql_num_rows($query_run1) == 0 && mysql_num_rows($query_run5)==0)
      {
      $query2= "INSERT INTO Reserve (`RID`, `Book_ID`, `Time`, `Date`) VALUES (NULL, '".$_POST['id']."', CURTIME(), CURDATE())";
      if($query_run2=mysql_query($query2))
        echo $_POST['id'].' is Reserved. Please collect it by tomorrow during the library hours<br>';
      else
        echo mysql_error();
      $query3="SELECT RID FROM `Reserve` WHERE Book_ID='".$_POST['id']."' AND DATEDIFF(CURDATE(),Date)=0";
      $query_run3=mysql_query($query3);
      if(mysql_num_rows($query_run3)==1)
        $rid=mysql_result($query_run3, 0,'RID');
      $query4="INSERT INTO User_RID (`RID`, `User_ID`) VALUES ('".$rid."', '".$_SESSION['user_name']."')";
      mysql_query($query4);
      }
    else
      echo 'You have already issued or reserved this Book.<br>';
	}
echo '</tbody></table>';

?>
		
</div>

