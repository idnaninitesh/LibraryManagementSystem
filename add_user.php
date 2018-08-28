<?php

require 'core.inc.php';
require 'connect.inc.php';


if(isset($_POST['Category']))
  {
   $Category = $_POST['Category']; 
   if($Category == 0)
      {
       $print = '<br>
                 <form action = "add_user.php" method = "POST">
                 User ID:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "User_ID" required><br><br>
                 Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Name" reuired><br><br>
                 Address:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Address" required><br><br>
                 DOB:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "DOB" required> (YYYY-MM-DD) <br><br>
                 Qualification:&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Qualification" required><br><br>
                 Designation:&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Designation" required><br><br>
                 <input type = "Submit" value = "Add">
                 </form>'; 
      } 
   else if($Category == 1)
          {
           $print = '<br>
                     <form action = "add_user.php" method = "POST">
                     User ID:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "User_ID" required><br><br>
                     Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Name" required><br><br>
                     Address:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Address" required><br><br>
                     DOB:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "DOB" required> (YYYY-MM-DD) <br><br>
                     Branch:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Branch required"><br><br>
                     Year:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Year" required><br><br>
                     Degree:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Degree" required><br><br>
                     <input type = "Submit" value = "Add">
                     </form>'; 
          }
    else if($Category==3)
    {
        $print = '<br>
                     <form action = "add_user.php" method = "POST">
                     Vendor ID:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Vendor_ID" required><br><br>
                     Name:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "Name" required><br><br>
                     Email id:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "email" required><br><br>
                     Contact No.1:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "contact1" required> (Compulsory)<br><br>
                     Contact No.2:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "contact2"><br><br>
                     Contact No.3:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type = "text" name = "contact3"><br><br>
                     <input type = "Submit" value = "Add">
                     </form>'; 
    }
        else if($Category == 2)
               $print = 'Please select a type';
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
    <a id="add_user" href="add_user.php">&nbsp&nbsp&nbspAdd User</a>
    <a href="add_book.php">&nbsp&nbsp&nbspAdd Books</a>
    <a href="remove_book.php">&nbsp&nbsp&nbspRemove Books</a>
    <a href="late.php">&nbsp&nbsp&nbspDefaulters</a>
    <a href="statistics.php">&nbsp&nbsp&nbspBook Statistics</a>
    <a href="yearly_books.php">&nbsp&nbsp&nbspYearly Book Reports</a>
    
  </p>
</div>

<div class="page">
  <p><b>Add User:</b></p>
   
  <form action = "add_user.php" method = "POST"> 
   Type of user:&nbsp&nbsp&nbsp&nbsp
   <select name = "Category">
    <option value = "2">Select..</option>
    <option value = "1">Student</option>
    <option value = "0">Staff</option>
    <option value = "3">Vendor</option>
   </select>
   <input type = "Submit" value = "Submit">
   <br >
  </form>

<?php

if(isset($print))
  {
   echo $print;
  }

if(isset($_POST['User_ID']) && !empty($_POST['User_ID']) && isset($_POST['Name']) && !empty($_POST['Name']) && isset($_POST['Address']) && !empty($_POST['Address']) && isset($_POST['DOB']) && !empty($_POST['DOB']) && isset($_POST['Qualification']) && !empty($_POST['Qualification']) && isset($_POST['Designation']) && !empty($_POST['Designation'])) 
  {
   $User_ID = $_POST['User_ID'];
   $Name = $_POST['Name'];
   $Address = $_POST['Address'];
   $DOB = $_POST['DOB'];
   $Category = 0;
   $Qualification = $_POST['Qualification'];
   $Designation = $_POST['Designation'];

   $query = "INSERT INTO `User` VALUES ('".$User_ID."','".$Name."','".$Address."','".$DOB."','".$Category."','".$Designation."',NULL,NULL,NULL) ";

   $query_run=mysql_query($query);
   
   $query = "INSERT INTO `Qualification` VALUES ('".$User_ID."','".$Qualification."') ";

   $query_run=mysql_query($query);

   $date1 = date("Y-m-d");
   $date2 = $DOB;

   $diff = abs(strtotime($date2) - strtotime($date1));

   $Age = floor($diff / (365*60*60*24));


   $query = "INSERT INTO `Age` VALUES ('".$DOB."','".$Age."') ";

   $query_run=mysql_query($query);

   $Password = md5('test');

   $query = "INSERT INTO `Authentication` VALUES ('".$User_ID."','".$Password."') ";

   $query_run=mysql_query($query);

   if($query_run)
     {

      echo 'User Details : <br><br>';
      echo $User_ID.'<br>'.$Name.'<br>'.$Address.'<br>'.$DOB.'<br>'.$Designation.'<br>'.$Qualification.'<br>';
      echo 'The user has been added <br>';
     } 
  } 
else if(isset($_POST['User_ID']) && !empty($_POST['User_ID']) && isset($_POST['Name']) && !empty($_POST['Name']) && isset($_POST['Address']) && !empty($_POST['Address']) && isset($_POST['DOB']) && !empty($_POST['DOB']) && isset($_POST['Branch']) && !empty($_POST['Branch']) && isset($_POST['Year']) && !empty($_POST['Year']) && isset($_POST['Degree']) && !empty($_POST['Degree'])) 
       {
        $User_ID = $_POST['User_ID'];
        $Name = $_POST['Name'];
        $Address = $_POST['Address'];
        $DOB = $_POST['DOB'];
        $Category = 1;
        $Branch = $_POST['Branch'];
        $Year = $_POST['Year'];
        $Degree = $_POST['Degree'];

        $query = "INSERT INTO `User` VALUES ('".$User_ID."','".$Name."','".$Address."','".$DOB."','".$Category."',NULL,'".$Branch."','".$Year."','".$Degree."') ";

        $query_run=mysql_query($query);
       
        $date1 = date("Y-m-d");
        $date2 = $DOB;

        $diff = abs(strtotime($date2) - strtotime($date1));

        $Age = floor($diff / (365*60*60*24));


        $query = "INSERT INTO `Age` VALUES ('".$DOB."','".$Age."') ";

        $query_run=mysql_query($query);

        $Password = md5('test');

        $query = "INSERT INTO `Authentication` VALUES ('".$User_ID."','".$Password."')";

        $query_run=mysql_query($query);

        if($query_run)
          {
          echo 'User Details : <br><br>';
          echo $User_ID.'<br>'.$Name.'<br>'.$Address.'<br>'.$DOB.'<br>'.$Branch.'<br>'.$Year.'<br>'.$Degree.'<br>';
          echo 'The user has been added <br>';
          }
       }
else if(isset($_POST['Vendor_ID']) && !empty($_POST['Vendor_ID']) && isset($_POST['Name']) && !empty($_POST['Name']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['contact1']) && !empty($_POST['contact1']) && isset($_POST['contact2']) && isset($_POST['contact3']))
{
    $vendor_id=$_POST['Vendor_ID'];
    $name=$_POST['Name'];
    $email=$_POST['email'];
    $contact1=$_POST['contact1'];
    if(!empty($_POST['contact2']))
        $contact2=$_POST['contact2'];
    if(!empty($_POST['contact3']))
        $contact3=$_POST['contact3'];
    
    $query="INSERT INTO Vendor VALUES ('".$vendor_id."','".$name."','".$email."')";
    $query_run=mysql_query($query);
    
    $query="INSERT INTO Vendor_Contact VALUES ('".$vendor_id."','".$contact1."')";
    $query_run=mysql_query($query);
    
    if(isset($contact2))
    {
        $query="INSERT INTO Vendor_Contact VALUES ('".$vendor_id."','".$contact2."')";
        $query_run=mysql_query($query);
    }
    
    if(isset($contact3))
    {
        $query="INSERT INTO Vendor_Contact VALUES ('".$vendor_id."','".$contact3."')";
        $query_run=mysql_query($query);
    }
    
    if($query_run)
          {
          echo 'Vendor Details : <br><br>';
          echo $vendor_id.'<br>'.$name.'<br>'.$email.'<br>'.$contact1.'<br>';
          if(isset($contact2))  echo $contact2.'<br>';
          if(isset($contact3))  echo $contact3.'<br>';
          echo 'The vendor has been added <br>';
          }
    
}
?>


</div>
