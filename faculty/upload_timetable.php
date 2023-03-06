<?php 
require_once "config.php";
if(isset($_POST['submit']))
{
  $class = $_POST['class'];
  $day = $_POST['day'];
  $from_time = $_POST['from_time'];
  $to_time = $_POST['to_time'];
  $subject = $_POST['subject'];
  $sql = "INSERT INTO timetables(class,day,from_time,to_time,subject) VALUES('$class','$day','$from_time','$to_time','$subject')";
  $query = mysqli_query($link,$sql);

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
<p> enter time in hh:mm:ss format</p>
<form method="post">
  <div class="mb-3">
    <label for="class_name" class="form-label" name="class">class name</label>
    <input type="text" class="form-control" id="class_name" aria-describedby="emailHelp" name="class">
   
  </div>
  <div class="mb-3">
    <label for="day" class="form-label" name="day">Day</label>
    <input type="text" class="form-control" id="day" aria-describedby="emailHelp" name="day">
  </div>
  <div class="mb-3">
    <label for="from_time" class="form-label" name="from_time">FROM TIME</label>
    <input type="text" class="form-control" id="from_time" aria-describedby="emailHelp" name="from_time">
  </div>
  <div class="mb-3">
    <label for="to_time" class="form-label" name="to_time">TO TIME</label>
    <input type="text" class="form-control" id="to_time" aria-describedby="emailHelp" name="to_time">
  </div>
  <div class="mb-3">
    <label for="subject" class="form-label" name="subject">Subject</label>
    <input type="text" class="form-control" id="subject" aria-describedby="emailHelp" name="subject">
  </div>
 
  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>
</body>
</html>