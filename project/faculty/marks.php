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
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
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
    <form method="post">
        <p> enter class id </p>
        <input type="text" name="classid" class="form-control" placeholder="class id" aria-label="class id"
            aria-describedby="basic-addon1">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $_SESSION['classid'] = $_POST['classid'];
    }

    ?>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">enrollment id</th>
                <th scope="col">student registration no</th>
                <th scope="col">faculty registration no</th>
                <th scope="col">class id</th>

            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['submit'])) {
                $classid = $_SESSION['classid'];
                $sql1 = "SELECT * FROM enrollment WHERE class_id = $classid";
                $query1 = mysqli_query($link, $sql1);
                if ($query1) {
                    while ($row = mysqli_fetch_assoc($query1)) {
                        $id = $row['enrollment_id'];
                        $studentregno = $row['student_reg_no'];
                        $faculty_reg_no = $row['faculty_reg_no'];


                        echo '<tr>
                <th scope="row">' . $id . '</th>
                <td>' . $studentregno . '</td>
                <td>' . $faculty_reg_no . '</td>
                <td>' . $classid . '</td>
                
              </tr>';
                    }
                }
            }




            ?>


        </tbody>
    </table>
    <form method="post">
        <select class="form-select" aria-label="Default select example" name="mark">
            <option selected>Select which marks to enter</option>
            <option value="1">Evaluation 1 marks</option>
            <option value="2">Evaluation 2 marks</option>
            <option value="3">Evaluation 3 marks</option>
            <option value="4">Evaluation 4 marks</option>
            <option value="5">Insem marks</option>
            <option value="6">endsem marks</option>
        </select>
        <input type="text" name="erid" class="form-control" placeholder="enrollment id" aria-label="enrollment id"
            aria-describedby="basic-addon1">
        <input type="text" name="marks" class="form-control" placeholder="marks" aria-label="marks"
            aria-describedby="basic-addon1">
        <button type="submit" class="btn btn-primary" name="submit2">Submit</button>
    </form>
    <?php
    if (isset($_POST['submit2'])) {
        $cid = $_SESSION['classid'];
        $mark = $_POST['mark'];
        $enid = $_POST['erid'];
        $sreg;
        $freg;
        switch ($mark) {
            case 1:
                $sq = "SELECT * FROM enrollment";
                $q = mysqli_query($link, $sq);
                if ($q) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['enrollment_id'] == $enid) {
                            $sreg = $row['student_reg_no'];
                            $freg = $row['faculty_reg_no'];
                        }
                    }
                }
                $ql = "INSERT INTO marks(enrollment_id,student_reg_no,faculty_reg_no,class_id,evaluation1_marks) VALUES ($enid,$sreg,$freg,$cid,$mark)";
                $qw = mysqli_query($link, $ql);
                break;
            case 6:
                $sq = "SELECT * FROM enrollment";
                $q = mysqli_query($link, $sq);
                if ($q) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['enrollment_id'] == $enid) {
                            $sreg = $row['student_reg_no'];
                            $freg = $row['faculty_reg_no'];
                        }
                    }
                }
                $ql = "INSERT INTO marks(enrollment_id,student_reg_no,faculty_reg_no,class_id,endsem_marks) VALUES ($enid,$sreg,$freg,$cid,$mark)";
                $qw = mysqli_query($link, $ql);
                break;
            case 2:
                $sq = "SELECT * FROM enrollment";
                $q = mysqli_query($link, $sq);
                if ($q) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['enrollment_id'] == $enid) {
                            $sreg = $row['student_reg_no'];
                            $freg = $row['faculty_reg_no'];
                        }
                    }
                }
                $ql = "INSERT INTO marks(enrollment_id,student_reg_no,faculty_reg_no,class_id,evaluation2_marks) VALUES ($enid,$sreg,$freg,$cid,$mark)";
                $qw = mysqli_query($link, $ql);
                break;
            case 3:
                $sq = "SELECT * FROM enrollment";
                $q = mysqli_query($link, $sq);
                if ($q) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['enrollment_id'] == $enid) {
                            $sreg = $row['student_reg_no'];
                            $freg = $row['faculty_reg_no'];
                        }
                    }
                }
                $ql = "INSERT INTO marks(enrollment_id,student_reg_no,faculty_reg_no,class_id,evaluation3_marks) VALUES ($enid,$sreg,$freg,$cid,$mark)";
                $qw = mysqli_query($link, $ql);
                break;
            case 4:
                $sq = "SELECT * FROM enrollment";
                $q = mysqli_query($link, $sq);
                if ($q) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['enrollment_id'] == $enid) {
                            $sreg = $row['student_reg_no'];
                            $freg = $row['faculty_reg_no'];
                        }
                    }
                }
                $ql = "INSERT INTO marks(enrollment_id,student_reg_no,faculty_reg_no,class_id,evaluation4_marks) VALUES ($enid,$sreg,$freg,$cid,$mark)";
                $qw = mysqli_query($link, $ql);
                break;
            case 5:
                $sq = "SELECT * FROM enrollment";
                $q = mysqli_query($link, $sq);
                if ($q) {
                    while ($row = mysqli_fetch_assoc($q)) {
                        if ($row['enrollment_id'] == $enid) {
                            $sreg = $row['student_reg_no'];
                            $freg = $row['faculty_reg_no'];
                        }
                    }
                }
                $ql = "INSERT INTO marks(enrollment_id,student_reg_no,faculty_reg_no,class_id,insem1_marks) VALUES ($enid,$sreg,$freg,$cid,$mark)";
                $qw = mysqli_query($link, $ql);
                break;
        }
    }

    ?>


</body>

</html>