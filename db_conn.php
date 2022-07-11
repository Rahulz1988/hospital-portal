<?php
$host = "localhost:3306";
$user = "fnrbjgsh_user";
$password = "EFn8?rJa]d@u";
$database = "fnrbjgsh_hospital_db";
$con=mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>