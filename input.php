<?php 

if (isset ($_POST['submit']))
{
    $username = $_POST['radioinput'];
    
    echo $username;
}

?>

<!DOCTYPE html>
<html lang="en">
<body>

<form action="input.php" method="post">
    
<h1>Radio Input</h1>
    
<h3><input type="radio" name="radioinput" value="Love Radio Buttons" />Love Radio Buttons</h3>
<h3><input type="radio" name="radioinput" value="Hate Radio Buttons" />Hate Radio Buttons</h3>
    
    <button type="submit" name="submit">Choose</button>
    
  </form>

</body>
</html>