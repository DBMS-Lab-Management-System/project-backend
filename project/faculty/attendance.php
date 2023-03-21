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

 <form method="post">
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
    <p>Enter class id to retrieve all students of the class</p>
 <input type="text" name = "classid" class="form-control" placeholder="class id" aria-label="class id" aria-describedby="basic-addon1">
 <button type="submit" class="btn btn-primary" name="submit">Submit</button> 
 </table>

<table class="table">
  <thead>
    <tr>
      <th scope="col">student registration no</th>
      <th scope="col">mark present </th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    $classid;
     if(isset($_POST['submit']))
     {
        $classid = $_POST['classid'];
    
     
    $sql1 = "SELECT student_reg_no FROM enrollment WHERE class_id = $classid";
   
    $_SESSION['classid'] = $classid;
    $query1 = mysqli_query($link,$sql1);
    if($query1)
    {
        while($row = mysqli_fetch_assoc($query1))
        {
            $reg = $row['student_reg_no'];
           
            echo '<tr>
            <th scope="row">'.$reg.'</th>
            <td><div class="form-check">
            <input class="form-check-input" type="checkbox" value='.$reg.' name="attendance[]" id="flexCheckDefault" >
            
          </div></td>
            
          </tr>';
        }
    }
}
    $freg;
    $idd = $_SESSION["id"];
   
    $sql4 = "SELECT * FROM users";
    $query4 = mysqli_query($link, $sql4);
    if ($query4) {
        while ($row = mysqli_fetch_assoc($query4)) {
            if ($row['id'] == $idd) {
                $freg = $row['reg_no'];
  
            }
        }
  
    }

   if(isset($_POST['submit1']))
   {
      $att = $_POST['attendance'];
     $classid = $_SESSION['classid'];
      
      if(!empty($att))
      {
          $n = count($att);
          for($i=0;$i<$n;$i++)
          {    $sq1 = "SELECT class_id,student_reg_no,DATE(a_date) FROM attendance where class_id=$classid and student_reg_no = $att[$i] and DATE(a_date) = DATE(CURRENT_TIMESTAMP)";
                $qu = mysqli_query($link,$sq1);
                if(mysqli_num_rows($qu)>0)
                {
                    die ("attendance already taken");
                }
                else
                {
                    $sq = "INSERT INTO attendance(faculty_reg_no,class_id,student_reg_no,status,a_date) VALUES ('$freg','$classid','$att[$i]','present',CURRENT_TIMESTAMP)";
                    ;
                    $q = mysqli_query($link,$sq);
                }
              
          }
      }
   }

    ?>
    
  
  </tbody>
</table>
<button type="submit" class="btn btn-primary" name="submit1">Submit</button> 
</form>
 <?php
 
 
 ?>         
          
          


       
    
</body>
</html>