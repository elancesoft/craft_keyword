<?php
// $servername = "10.1.41.49";
// $username = "brin_user01";
// $password = "vaivuser01";

// // Create connection
// $conn = new mysqli($servername, $username, $password);

// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";


// $con = mysqli_connect("localhost","my_user","my_password","my_db");
$con = mysqli_connect("10.1.41.49","brin_user01","vaivuser01","brin_data");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>