<?php 
// Include config file
require_once "config.php";
$reg_no="";
$reg_no_err="";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // validating
    $input_reg_no = trim($_POST);
    if(empty($input_reg_no)){
        $reg_no_err = "Please enter a registration no.";
    }
    else if(!filter_var($input_reg_no, FILTER_VALIDATE_INT))
    {
        $reg_no_err = "Please enter valid registration number";
    }
    else
    {
        $reg_no = $input_reg_no;
    }

    if(!empty($reg_no))
    {
        $sql = "INSERT INTO users (reg_no) VALUES (?)";
        
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Registration no:</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($reg_no_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $reg_no; ?>">
                            <span class="invalid-feedback"><?php echo $reg_no_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>