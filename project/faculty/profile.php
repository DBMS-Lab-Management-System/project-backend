<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Faculty profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Lab management system</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
    <div>
        <p>Enter the following details to register yourself as faculty</p>
    </div>
    <form method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="emailHelp" name="name">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone number</label>
            <input type="text" class="form-control" id="phone" aria-describedby="emailHelp" name="phone">
        </div>


        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <?php
    if (isset($_POST["submit"])) {
        $id = $_SESSION["id"];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $err = '';
        $reg;
        $isexists = 0;
        $sql = "SELECT * FROM users";
        $query = mysqli_query($link, $sql);
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['id'] == $id) {
                    $reg = $row['reg_no'];

                }
            }

        }
        
        // checking whether the student with the same registration no exists
        $sql2 = "SELECT * FROM faculty";
        $query2 = mysqli_query($link, $sql);
        if($query2)
        {
            while($row = mysqli_fetch_assoc($query))
            {
                if($row['student_reg_no'] == $reg)
                {
                    $isexists = 1;
                    break;
                }
            }
        }
        
        if($isexists==0)
        {
           $sql1 = "INSERT INTO faculty VALUES ('$reg','$name','$phone','$email')";
           $query1 = mysqli_query($link, $sql1);
        }
        else
        {
            echo "you have already entered your data";
        }

    }





    ?>








</body>

</html>