<?php 
session_start();
$connection = mysqli_connect('localhost','root','','data_examples');
?>
<?php

if (isset ($_POST['submit']))
{
    $id = $_SESSION['sess_id'];
    

    $query = "SELECT * FROM posts WHERE user_id='$id' ";

    $result = mysqli_query($connection , $query);
    
    $add = mysqli_real_escape_string($connection,$_POST['add']);
    
    if ($add != null)
    {
        $x=0;
 while($row = mysqli_fetch_array($result))
          {
     if ($add == $row['content'])
     { 
         $x=1;
     }   
        }
    if ($x==1)
        echo "That Task already exists! Please try again with another.";
    else {
    $query = "INSERT INTO posts(content , user_id) ";
    $query .= "VALUES ('$add' , '$id')";
    $result = mysqli_query($connection , $query);
    }
    }
}
//if (isset ($_POST['show']))
//{
//    $x=1;
//    $query = "SELECT * FROM posts";
//
//    $result = mysqli_query($connection , $query);
//    
//    $id = $_SESSION['sess_id'];
// while($row = mysqli_fetch_array($result))
//    {
//     
//     if ($id == $row['user_id'])
//     {
//         echo "Number";
//         echo $x;
//         echo " ) ";
//         echo $row['content'];
//         echo " ";
//         $x++;
//     }
//        
//    }
//}
if (isset($_POST['update']))
{
   $add = mysqli_real_escape_string($connection,$_POST['add']);
   
    if ($add != null)
    {
    $content = $_POST['content'];
    
    $query = "UPDATE posts SET ";
    $query .= "content = '$add' ";
    $query .= "WHERE content = '$content' ";
    
    $result = mysqli_query($connection , $query);
    if (!$result)
    {
        die ('Query FAILED' . mysqli_error($connection));
    }
    }
}
if (isset($_POST['delete']))
{
    $content = $_POST['content'];
    
    $query = "DELETE FROM posts ";
    $query .= "WHERE content = '$content' ";
    
    $result = mysqli_query($connection , $query);
    if (!$result)
    {
        die ('Query FAILED' . mysqli_error($connection));
    }
}
?>
<!doctype html>
<html>
<head>
<title>Welcome</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <link href="http://getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet">
    
    <link rel="icon" href="osc_icon.png">
    <style>
table, th, td {
    border: 1px solid black;
    padding: 5px;
}
table {
    border-spacing: 15px;
}
</style>
</head>
<body>
    
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://localhost/Examples/login.php"><span class="glyphicon glyphicon-log-in"></span>Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
    
<div class="col-sm-6">
        
      <form action="profile.php" method="post">
        <div class="form-group">
            <br>
            <label for="add"><b>Your Tasks</b></label>
            <input type="text" name="add" class="form-control">
          </div>
          <br>
          <input class="btn btn-primary" type="submit" name="submit" value="Add"> 
          <input class="btn btn-primary" type="submit" name="update" value="Update"> 
          <input class="btn btn-primary" type="submit" name="delete" value="Delete"> 
           <br><br>
          <div class="form-group">
                <select name="content">
                <?php 
                    
    $query = "SELECT * FROM posts";
    $id = $_SESSION['sess_id'];
    $result = mysqli_query($connection , $query);
                    
    while ($row = mysqli_fetch_assoc($result))
     {
        if ($id == $row['user_id'])
        {
            $s = $row['content'];
         echo "<option value='$s'>$s</option>";}
     }
                    ?> 
                </select>
            </div>
          
        </form>
        
    </div>
<!--
    <br><br>
    <table border="2">
        <tr>
      <th>id</th>
      <th>Content</th>
      <th>User_id</th>
    </tr>
        <tr>
        <?php 
                    
    $query = "SELECT * FROM posts";
    $id = $_SESSION['sess_id'];
    $result = mysqli_query($connection , $query);
                    
    while ($row = mysqli_fetch_assoc($result))
     {
        if ($id == $row['user_id'])
        {
            $s1 = $row['id'];
            $s2 = $row['content'];
            $s3 = $row['user_id'];
            print "<tr> <td>";
        echo $s1; 
        print "</td> <td>";
        echo $s2; 
        print "</td> <td>";
        echo $s3; 
  }
     }
            
 ?> 
</tr>
  
</table>
-->
    
</body>
</html>
