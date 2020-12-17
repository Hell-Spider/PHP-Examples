<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <title>XML Validator</title>
    <style type="text/css">
        .wrapper {
            width: 850px;
            margin: 0 auto;
        }
    </style>
</head>

<body class="wrapper">
    <div class="page-header" style="text-align: center;">
        <h2>XML Validator</h2>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="validate.php" method="POST" enctype="multipart/form-data">
                    <div style="padding-left: 40%;">
                        <h3>XML File</h3>
                        <input type="file" name="xmlfile"><br>
                    </div>
                    <br>
                    <input style="margin-left: 40%;" class="btn btn-primary" type="submit" name="submit" value="Validate">
                </form>
            </div>
        </div>
    </div>


</body>

</html>