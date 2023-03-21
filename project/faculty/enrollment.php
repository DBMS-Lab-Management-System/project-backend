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
    <title>ENROLL STUDENTS</title>
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

<form method="post">
    <p>Registered students</p>
 <table class="table">
  <thead>
    <tr>
      <th scope="col">student registration number</th>
      <th scope="col">name</th>
      <th scope="col">phone</th>
      <th scope="col">email</th>
      <th scope = "">ENROLL</th>
     
    </tr>
  </thead>
  <tbody>
    <?php
    $sql = "SELECT * FROM students";
    $query = mysqli_query($link,$sql);
    if($query)
    {
        while($row = mysqli_fetch_assoc($query))
        {
            $reg =$row['student_reg_no'];
            $name = $row['name'];
            $phone = $row['phone'];
            $email = $row['email'];
            echo '<tr>
            <th scope="row">'.$reg.'</th>
            <td>'.$name.'</td>
            <td>'.$phone.'</td>
            <td>'.$email.'</td>
            <td><div class="form-check">
            <input class="form-check-input" type="checkbox" value='.$reg.' name="enroll[]" id="flexCheckDefault" >
            
          </div></td>
          
          </tr>';
        }
    }
    
    ?>
    
  
  </tbody>

</table>
<p>classes</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">class id</th>
      <th scope="col">name</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    $sql1 = "SELECT * FROM classes";
    $query1 = mysqli_query($link,$sql1);
    if($query1)
    {
        while($row = mysqli_fetch_assoc($query1))
        {
            $id =$row['class_id'];
            $name = $row['name'];
           
            echo '<tr>
            <th scope="row">'.$id.'</th>
            <td>'.$name.'</td>
            
          </tr>';
        }
    }
    
    ?>
    
  
  </tbody>
</table>
<p> enter class id to enroll all the studentd </p>
<input type="text" name = "classid" class="form-control" placeholder="class id" aria-label="class id" aria-describedby="basic-addon1">         
<button type="submit" class="btn btn-primary" name="submit">Submit</button>        
</form>        
 <?php
 if(isset($_POST['submit']))
 {  $classid = $_POST['classid'];
    $enroll = $_POST['enroll'];
    
    $reg;
    $idd = $_SESSION["id"];
   
    $sql4 = "SELECT * FROM users";
    $query4 = mysqli_query($link, $sql4);
    if ($query4) {
        while ($row = mysqli_fetch_assoc($query4)) {
            if ($row['id'] == $idd) {
                $reg = $row['reg_no'];

            }
        }

    }
  
    if(!empty($enroll))
    {
       $n = count($enroll);
       for($i=0;$i<$n;$i++)
       {     $sql5 = "SELECT *  FROM enrollment where student_reg_no=$enroll[$i] and faculty_reg_no = $reg and class_id = $classid ";
        $query5 = mysqli_query($link,$sql5);
        if(mysqli_num_rows($query5)>0)
        {   die("already exists");
            
        }
        else
        {
            $sql2 = "INSERT INTO enrollment(student_reg_no,faculty_reg_no,class_id) VALUES ('$enroll[$i]','$reg','$classid')";
            $query2 = mysqli_query($link,$sql2);
        }
        
       }
    }
 } 

 
 ?>        
          


       
    
</body>
</html>