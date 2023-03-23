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
          <a class="nav-link active" aria-current="page" href="..\welcome.php">Home</a>
        </li>
        
        </ul>
      </div>
  </div>
</nav>

<table class="table">
  <thead>
    <tr>
      <th scope="col">equipment id</th>
      <th scope="col">equipment name</th>
      <th scope="col">student registration number</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    $sql1 = "SELECT * FROM equipment";
    $query1 = mysqli_query($link,$sql1);
    if($query1)
    {
        while($row = mysqli_fetch_assoc($query1))
        {
            $id =$row['eq_id'];
            $name = $row['eq_name'];
            $reg = $row['student_reg_no'];
            echo '<tr>
            <th scope="row">'.$id.'</th>
            <td>'.$name.'</td>
            <td>'.$reg.'</td>
            
            
          </tr>';
        }
    }
    
    ?>
    
  
  </tbody>
</table>
<form method="post">
<input type="text" name = "eqid" class="form-control" placeholder="equipment id" aria-label="equipment id" aria-describedby="basic-addon1">
<button type="submit" class="btn btn-primary" name="submit">click to enter borrow time in the database</button> 
<button type="submit" class="btn btn-primary" name="submit1">click to enter returned time in the database</button> 

</form>
 <?php 
 if(isset($_POST['submit']))
 {
    $eqid = mysqli_real_escape_string($link, $_POST['eqid']);

    $sl2 = "UPDATE  equipment SET borrowed_time = CURRENT_TIMESTAMP WHERE eq_id = $eqid";
    $qry = mysqli_query($link,$sl2);
    if($qry)
    {
        echo "successfully entered";
    }
    else
    {
        die(mysqli_error($link));
    }
 }
 if(isset($_POST['submit1']))
 {
    $eqid = $_POST['eqid'];
    $sql2 = "UPDATE  equipment SET returned_time = CURRENT_TIMESTAMP WHERE eq_id = $eqid";
    $qry1 = mysqli_query($link,$sql2);
 }
 
 ?>         
         
         
          


       
    
</body>
</html>