<?php
// Initialize the session
session_start();
  
// Include config file
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Lab management system</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="..\welcome.php">Home</a>
        </li>
        
        </ul>
      </div>
  </div>
</nav>

 <form method="post">
 <label for="eqname">Enter equipment name to be borrowed</label> 
<input type="text" name = "eqname" class="form-control" placeholder="equipment name" aria-label="equipment name" aria-describedby="basic-addon1">
<button type="submit" class="btn btn-primary" name="submit">Submit</button> 
</form>
<?php
if(isset($_POST['submit']))
{
    $eqname = $_POST['eqname'];
$id = $_SESSION['id'];
$reg;
$sql = "SELECT * FROM users";
$query = mysqli_query($link,$sql);
if($query)
{
    while($row = mysqli_fetch_assoc($query))
    {
        if($row['id'] == $id)
        {
            $reg = $row['reg_no'];
        }
    }
}
$sq = "INSERT INTO equipment(eq_name,student_reg_no) VALUES('$eqname',$reg)";
$qu = mysqli_query($link,$sq);

}




?>        
</body>
</html>