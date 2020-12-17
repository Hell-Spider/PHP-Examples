<?php
if (isset($_POST["employee_id"]) && !empty($_POST["employee_id"])) {
    require_once "config.php";

    $sql = "delete from employees where employee_id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)); {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_POST["employee_id"]);

        if (mysqli_stmt_execute($stmt)) {
            header("location: index.php");
            exit();
        } else {
            echo "OOPS! Something Went Wrong!";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    if(empty(trim($_GET["employee_id"])))
    {
        echo "Error deleting the employee record";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Record</title>
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
                        <h2>Delete Employee</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="alert alert-danger fade in">
                            <input type="hidden" name="employee_id" value="<?php echo trim($_GET["employee_id"]);?>">
                            <p>Are You sure you want to delete this record</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>