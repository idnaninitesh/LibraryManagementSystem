<?php

if(isset($_POST['username']) && isset($_POST['password']))
{
$username=$_POST['username'];
$password=$_POST['password'];
$password_md5=md5($password);
if(!empty($username) && !empty($password))
{
    $query="SELECT User_ID FROM Authentication WHERE User_ID='$username' AND Password='$password_md5'";
    if($query_run=mysql_query($query))
    {
        $query_rows=mysql_num_rows($query_run);
        if($query_rows==0)
            $display = 'Incorrect username or password';
        else if($query_rows==1)
            {
                $user_name=mysql_result($query_run,0,'User_ID');
                $_SESSION['user_name']=$user_name;
                header('Location: index.php');
            }
    }
}
else
    $display = 'Fill all the fields';


}


?>              

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 <title>
  VJTI Library
 </title>
 <link rel = "stylesheet" type = "text/css" href = "name.css">
</head>

<body>
    <div id="title">
      <h1>VJTI LIBRARY</h1> 
    </div>
    <!-- Begin Page Content -->
    <div id="container">
        <form action = "<?php echo $current_file?>" method = "POST">
            <label for="username">User ID:</label>
            <input type="text" id="username" name="username" placeholder = "eg:-131080014" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="lower">
                <input type="submit" value="Login">
                <?php if(isset($display)) echo $display; ?> 
       </div><!--/ lower-->
        </form> 
    </div><!--/ container-->
    <!-- End Page Content -->
</body>
</html>
