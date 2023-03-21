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
<form method="post">
 <label for="classid">Enter class id</label> 
<input type="text" name = "classid" class="form-control" placeholder="class id" aria-label="class id" aria-describedby="basic-addon1">
<label for="pcno">Enter pc no</label> 
<input type="text" name = "pcno" class="form-control" placeholder="pc no" aria-label="pc no" aria-describedby="basic-addon1">
 <button type="submit" class="btn btn-primary" name="submit">Submit</button> 
</form>
<?php
if(isset($_POST['submit']))
{
  $classid = $_POST['classid'];
  $pcno = $_POST['pcno'];
  $id = $_SESSION['id'];
  $sql = "SELECT * from users";
  $query = mysqli_query($link,$sql);
  $reg;
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
  $sq = "INSERT INTO pc(class_id,student_reg_no,pc_no,pc_timestamp) VALUES($classid,$reg,'$pcno',CURRENT_TIMESTAMP)";
  $query1 = mysqli_query($link,$sq);
  
}



?>
 
          
          
         
          


       
    
</body>
</html>