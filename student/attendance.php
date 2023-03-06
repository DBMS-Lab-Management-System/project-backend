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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attendance page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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
          <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
        </li>
       
        </ul>
      </div>
  </div>
</nav>
<form method="post">
<select class="form-select" aria-label="Default select example" name="subject" >
  <option selected>select subject to mark attendance</option>
  <?php
  $sql = "SELECT * from subject_data";
  $query = mysqli_query($link,$sql);
  if($query)
  {
    while($row = mysqli_fetch_assoc($query))
    {   $name = $row['name'];
        $n = htmlspecialchars($name);
        echo "<option value=".$n." >$n</option>";
    }
   
  }
  ?>

</select>


<button type="submit" class="btn btn-primary" name="submit">Mark present</button>
</form>
<?php

if(isset($_POST['submit']))
{$subject =  $_POST['subject'];
$id = $_SESSION['id'];
$sql = "SELECT * from users";
$query = mysqli_query($link,$sql);
$reg;
if($query)
{
  while($row = mysqli_fetch_assoc($query))
  {   if($row['id']==$id)
      {
        $reg = $row['reg_no'];
        
      }
  }
 
}
if($subject!='select subject to mark attendance')
{  
    $sql1 = "INSERT INTO student_attendance (date,reg_no,verified,subject) VALUES (CURDATE(),'$reg',0,'$subject')";

$query1 = mysqli_query($link,$sql1);
}



    
}
$sql_datecheck = "SELECT date,reg_no FROM student_attendance";
$query_datecheck = mysqli_query($link,$sql_datecheck);
if($query_datecheck)
{
    while($row = mysqli_fetch_assoc($query))
    {
        echo $row['date'];
        echo $row['reg_no'];
    }
}

?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>