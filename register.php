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
     if ($username == $row['username'])
     { 
         $x=1;
     }   
        
        }
    if ($x==1)
        echo "That email already exists ! Please try again with another.";
    else {
        
    $sql = "insert into user (username,password) values ('$username','$password1')";
    $query = mysqli_query($connection,$sql);
    if (!$query)
    {
        die ('Query FAILED' . mysqli_error());
    }
    else 
        echo "Account Successfully Created";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registeration Page</title>
    <link rel="stylesheet" type="text/css" href="css_file.css">
    </head>
<body>

<h2>Registeration Form</h2>

    <form action="register.php" method="post">
        <div class="container">
            <label for="username"><b>Email</b></label>
            <input type="text" placeholder="Enter Your Email" name="username" required>
        
              <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Your Password" name="password" required>
          
          <button type="submit" name="submit"> Register </button>
            
            <h2>OR</h2>
            
            <h2 class="psw">If You don't have account , please <a href="http://localhost/Examples/login.php" target="_self">Login</a></h2>
        </div>
        </form>

</body>
</html>