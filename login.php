<?php

$connection = new mysqli('localhost', 'root', '', 'data_examples') or die ("Database connection failed");

if (isset ($_POST['submit'])) {
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $hashFormat = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hashF_and_salat = $hashFormat . $salt;
    $password1 = crypt($password, $hashF_and_salat);

    $query = "SELECT * FROM user WHERE username='$username' and password='$password1'";
    //    $query = "SELECT * FROM posts WHERE user_id='$id' ";

    $result = mysqli_query($connection, $query) or die ('Query FAILED' . mysqli_error());

    while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
    }
    if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION['sess_user'] = $username;
        $_SESSION['sess_id'] = $id;

        /* Redirect browser */
        header("Location: profile.php");
//        echo "<script type='text/javascript'>alert('Welcome in NotebookApp');</script>";

    } else if (mysqli_num_rows($result) == 0) {
        echo "Please Register ... and Try again";
//        echo "<script type='text/javascript'>alert('Please Register ... and Try again');</script>";
    }
}
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>OSC SimpleApp</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <link href="http://getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">

    <link rel="icon" href="osc_icon.png">
</head>
<body>

<nav class="navbar navbar-fixed-top navbar-inverse">

    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">OSC</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://localhost/Examples/navbar.php">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Page 1-1</a></li>
                        <li><a href="#">Page 1-2</a></li>
                        <li><a href="#">Page 1-3</a></li>
                    </ul>
                </li>
                <li><a href="http://localhost/Examples/example.php">Page 2</a></li>
                <li><a href="http://localhost/Examples/example2.php">Page 3</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://localhost/Examples/register.php"><span class="glyphicon glyphicon-user"></span> Sign
                        Up</a></li>
                <li><a href="http://localhost/Examples/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <br><br><br><br>

<div class="container">
    <h1 style="text-align: center;">Login</h1>
    <br>
    <form class="form-horizontal" action="login.php" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email :</label>
            <div class="col-sm-10">
                <input type="text" placeholder="Enter Your Email" name="username" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password :</label>
            <div class="col-sm-10">
                <input type="password" placeholder="Enter Your Password" name="password" required class="form-control">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label><input type="checkbox"> Remember me</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" name="submit" class="btn btn-default">Login</button>
                <span>If You don't have account , please <a href="http://localhost/Examples/register.php"
                                                            target="_self">Register</a></span>
            </div>
        </div>
    </form>
</div>

</body>
</html>