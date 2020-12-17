<?php
require_once "config.php";

$ename = $esalary = $eaddress = "";
$ename_err = $esalary_err = $eaddress_err = "";

if (isset($_POST["employee_id"]) && !empty($_POST["employee_id"])) {

    $employee_id = $_POST["employee_id"];

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
        $sql = "update employees set employee_name=?, employee_salary=?, address=? where employee_id=?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssi", $param_ename, $param_esalary, $param_eaddress,$param_id);

            $param_ename = $ename;
            $param_esalary = $esalary;
            $param_eaddress = $eaddress;
            $param_id = $employee_id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
else
{
    if(isset($_GET["employee_id"]) && !empty(trim($_GET["employee_id"])))
    {
        $employee_id = trim($_GET["employee_id"]);
        $sql = "select * from employees where employee_id=?";

        if($stmt = mysqli_prepare($conn,$sql))
        {
            mysqli_stmt_bind_param($stmt,"i",$param_id);
            $param_id = $employee_id;

            if(mysqli_stmt_execute($stmt))
            {
                $r = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($r)==1)
                {
                    $row = mysqli_fetch_array($r,MYSQLI_ASSOC);

                    $ename = $row["employee_name"];
                    $esalary = $row["employee_salary"];
                    $eaddress = $row["address"];
                }
                else{
                    echo "Error Executing the Statement";
                    exit();
                }
            }
            else{
                echo "Oops! Something Went Wrong.";
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else{
        echo "Cannot Find the Employee";
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($ename_err)) ? 'has-error' : ''; ?>">
                            <label>Employee Name</label>
                            <input type="text" name="ename" class="form-control" value="<?php echo $ename; ?>">
                            <span class="help-block"><?php echo $ename_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($esalary_err)) ? 'has-error' : ''; ?>">
                            <label>Employee Salary</label>
                            <input type="text" name="esalary" class="form-control" value="<?php echo $esalary; ?>">
                            <span class="help-block"><?php echo $esalary_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($eaddress_err)) ? 'has-error' : ''; ?>">
                            <label>Employee Address</label>
                            <textarea name="eaddress" class="form-control"><?php echo $eaddress; ?></textarea>
                            <span class="help-block"><?php echo $eaddress_err;?></span>
                        </div>
                        <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>