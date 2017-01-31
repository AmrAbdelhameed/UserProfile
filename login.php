<?php 

 $connection = new mysqli('localhost','root','','database_example') or die ("Database connection failed");

//$sql = "insert into user (username,password) values ('mariam','ahmed13')";

if (isset ($_POST['submit']))
{
    $username = mysqli_real_escape_string($connection,$_POST['username']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    
    $hashFormat = "$2y$10$";
    $salt ="iusesomecrazystrings22";
    $hashF_and_salat = $hashFormat . $salt ;
    $password1 = crypt($password,$hashF_and_salat);
    
    $query = "SELECT * FROM user";

    $result = mysqli_query($connection , $query) or die ('Query FAILED' . mysqli_error());
    
    $x=0;
    
    while($row = mysqli_fetch_array($result))
          {
     if ($username == $row['username'] && $password1 == $row['password'] )
     { 
         $x=1;
         $id = $row['id'];
     }   
        
        }
    if ($x==1)
    {
        echo "Done F45 Mogod";
         session_start();
	$_SESSION['sess_user']=$username;
    $_SESSION['sess_id'] = $id;

	/* Redirect browser */
	header("Location: profile.php");
        
    }else if ($x==0) {
        echo "Please Register ... and Try again";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="css_file.css">
    </head>
<body>

<h2>Login Form</h2>

    <form action="login.php" method="post">
        <div class="container">
            <label for="username"><b>Email</b></label>
            <input type="text" placeholder="Enter Your Email" name="username" required>
        
              <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Your Password" name="password" required>
          
            <input type="checkbox" checked="checked"> Remember me
        </div>
        <div class="container" style="background-color:#ffffff">
    <button type="submit" name="submit" class="cancelbtn">Login</button>
    <span class="psw">If You don't have account , please <a href="http://localhost/Examples/register.php" target="_self">Register</a></span>
  </div>
        </form>

</body>
</html>