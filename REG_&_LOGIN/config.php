<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "mydb1";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("ERROR: Could Not Connect. ".mysqli_connect_error());
}
?>