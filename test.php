<?php
// $con = mysqli_connect("localhost","my_user","my_password","my_db");
//$con = mysqli_connect("10.1.41.49","brin_user01","vaivuser01","brin_data");
$con = mysqli_connect("10.1.41.49","user220216","user220216!","brin_data");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>