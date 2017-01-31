<?php 
session_start();
$connection = mysqli_connect('localhost','root','','database_example');
?>
<?php

if (isset ($_POST['submit']))
{
    $id = $_SESSION['sess_id'];
    

    $query = "SELECT * FROM posts WHERE user_id='$id' ";

    $result = mysqli_query($connection , $query);
    $add = $_POST['add'];
    $add = mysqli_real_escape_string($connection,$add);
    if ($add == null)
    echo "Error";
    else
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
if (isset ($_POST['show']))
{
    $x=1;
    $query = "SELECT * FROM posts";

    $result = mysqli_query($connection , $query);
    
    $id = $_SESSION['sess_id'];
 while($row = mysqli_fetch_array($result))
    {
     
     if ($id == $row['user_id'])
     {
         echo "Number";
         echo $x;
         echo " ) ";
         echo $row['content'];
         echo " ";
         $x++;
     }
        
    }
}
if (isset($_POST['update']))
{
   $add = $_POST['add'];
   $content = $_POST['content'];
    
    $query = "UPDATE posts SET ";
    $query .= "content = '$add' ";
    $query .= "WHERE content = '$content' ";
    
    $result = mysqli_query($connection , $query);
    if (!$result)
    {
        die ('Query FAILED' . mysqli_error($connection));
    }
    else 
        echo "Done Updated ^^";  
}
if (isset($_POST['delete']))
{
    $add = $_POST['add'];
    $content = $_POST['content'];
    
    $query = "DELETE FROM posts ";
    $query .= "WHERE content = '$content' ";
    
    $result = mysqli_query($connection , $query);
    if (!$result)
    {
        die ('Query FAILED' . mysqli_error($connection));
    }
    else 
        echo "Done Deleted ^^";
}
?>
<!doctype html>
<html>
<head>
<title>Welcome</title>
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
<div class="col-sm-6">
        
      <form action="profile.php" method="post">
        <div class="form-group">
            <label for="add"><b>Your Tasks</b></label>
            <input type="text" name="add" class="form-control">
          </div>
          <br>
          <input class="btn btn-primary" type="submit" name="submit" value="Add"> 
          <input class="btn btn-primary" type="submit" name="show" value="Show All"> 
           <br>
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
          <input class="btn btn-primary" type="submit" name="update" value="Update"> 
          <input class="btn btn-primary" type="submit" name="delete" value="Delete">  
          <br>
          <p><a href="http://localhost/Examples/login.php" target="_self">Logout</a></p>
        </form>
        
    </div>
    <table style="width:100%">
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
            
    echo "<th>$s1</th>";
    echo "<th>$s2</th>";
    echo "<th>$s3</th>";
  }
     }
            
 ?> 
</tr>
  
</table>
</body>
</html>
