<?php


require 'libs/config.php';

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$student_email = $_POST['student_email'];


$sql = "INSERT INTO students (first_name,last_name,email) value ('$first_name','$last_name','$student_email')";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

if ($result == true) {

  echo 1;
} else {
  echo "Something Wrong";
}
