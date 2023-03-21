<?php
// Initialize the session
session_start();
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
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
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
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <p>
          <?php 
          $sql = "select * from users";
          $query = mysqli_query($link,$sql);
          if($query)
          {
            
            $id =  $_SESSION["id"];
            while($row = mysqli_fetch_assoc($query))
            {
              if($row['id'] == $id)
              {
                if($row['role'] == 'admin')
                {
                  echo '<a href="./admin/admin.php">ADMIN PAGE </a>';
                }
                if($row['role'] == 'faculty')
                {
                  echo '<a href="./faculty/faculty.php">FACULTY PAGE </a>';
                }
                if($row['role'] == 'student')
                {
                  echo '<a href="student/student.php">STUDENT PAGE </a>';
                }
                
              }
              
            }
          }
          
          
         
         
          


         ?>
    </p>
    </p>
</body>
</html>