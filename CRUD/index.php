<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style>
        .wrapper {
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2 {
            margin-top: 0;
        }
        table tr td:last-child a {
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employee Details</h2>
                        <a href="register.php" class="btn btn-success pull-right">Add Employee</a>
                    </div>
                    <?php
                    require_once "config.php";
                    $sql = "select * from employees";
                    if ($r = mysqli_query($conn, $sql)) {
                        if (mysqli_num_rows($r) > 0) {
                            echo "<table class='table table-bordered table-striped'>";
                            echo "<thead>";

                            echo "<tr>";
                            echo "<th>Employee_ID</th>";
                            echo "<th>Employee Name</th>";
                            echo "<th>Employee Salary</th>";
                            echo "<th>Employee Address";
                            echo "<th>Action</th>";
                            echo "</tr>";

                            echo "</thead>";

                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($r)) {
                                echo "<tr>";
                                echo "<td>" . $row['employee_id'] . "</td>";
                                echo "<td>" . $row['employee_name'] . "</td>";
                                echo "<td>" . $row['employee_salary'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";

                                echo "<td>";
                                echo "<a href='update.php?employee_id=" . $row['employee_id'] . "' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href='delete.php?employee_id=" . $row['employee_id'] . "' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                echo "</td>";

                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";

                            mysqli_free_result($r);
                        } else {
                            echo "<p class='lead'><em>No Employee Records were found.</em></p>";
                        }
                    } else {
                        echo "ERROR: Could not able to execute $sql." . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>