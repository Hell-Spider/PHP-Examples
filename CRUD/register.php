<?php
require_once "config.php";

$ename = $esalary = $eaddress = "";
$ename_err = $esalary_err = $eaddress_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Employee Name
    $input_ename = trim($_POST["ename"]);
    if (empty($input_ename)) {
        $ename_err = "Please enter Employee Name";
    } elseif (!filter_var($input_ename, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $ename_err = "Please enter a valid Employee Name";
    } else {
        $ename = $input_ename; 
    }

    // Validate Employee Salary
    $input_esalary = trim($_POST["esalary"]);
    if (empty($input_esalary)) {
        $esalary_err = "Please enter Employee Salary";
    } elseif (!ctype_digit($input_esalary)) {
        $esalary_err = "Please enter a Positive Salary Amount";
    } else {
        $esalary = $input_esalary;
    }

    // Validate Employee Address
    $input_eaddress = trim($_POST["eaddress"]);
    if (empty($input_eaddress)) {
        $eaddress_err = "Please enter an Address";
    } else {
        $eaddress = $input_eaddress;
    }

    if (empty($ename_err) && empty($eaddress_err) && empty($esalary_err)) {
        $sql = "insert into employees (employee_name,employee_salary,address) values (?,?,?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_ename, $param_esalary, $param_eaddress);

            $param_ename = $ename;
            $param_esalary = $esalary;
            $param_eaddress = $eaddress;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_close($stmt);
    }
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="page-header">
                        <h2>Employee Registration</h2>
                    </div>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="form-group <?php echo (!empty($ename_err)) ? 'has-error' : ''; ?>">
                            <label>Employee Name</label>
                            <input type="text" name="ename" class="form-control" value="<?php echo $ename;?>">
                            <span class="help-block"><?php echo $ename_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($esalary_err)) ? 'has-error' : ''; ?>">
                            <label>Employee Salary</label>
                            <input type="text" name="esalary" class="form-control" value="<?php echo $esalary;?>">
                            <span class="help-block"><?php echo $esalary_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($eaddress_err)) ? 'has-error' : ''; ?>">
                            <label>Employee Address</label>
                            <input type="text" name="eaddress" class="form-control" value="<?php echo $eaddress;?>">
                            <span class="help-block"><?php echo $eaddress_err;?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Register">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>