<?php
// config.php
$host = "localhost";
$user = "root";
$password = "";
$db = "employee_management";

$conn = mysqli_connect($host, $user, $password, $db);
if ($conn === false) {
    die("Connection error");
}

// JWT secret key
$jwt_secret = "b93F8dfg56n435k5AS67DF2slQoK4";