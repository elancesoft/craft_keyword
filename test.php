<?php
// $con = mysqli_connect("localhost","my_user","my_password","my_db");
//$con = mysqli_connect("10.1.41.49","brin_user01","vaivuser01","brin_data");
//$con = mysqli_connect("112.175.32.149:3389","user220216","user220216!","brin_data");

$con = mysqli_connect("112.175.32.149", "brin_data", "daumsoft0531!", "brin_data");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


// Perform query
$query = "
select concat(
  YEAR(t1.DATE), '년 ',
  MONTH(t1.DATE), '월 ',
  week(t1.DATE,5) - week(DATE_SUB(t1.DATE, INTERVAL DAYOFMONTH(t1.DATE)-1 DAY),5), '주차'
) as WEEK_NM
FROM (
  select DATE_SUB('20220207', INTERVAL 7 DAY) as DATE
) t1
";
if ($result = $con->query($query)) {

  while ($row = $result->fetch_assoc()) {
    print_r($row);
  }

  // Free result set
  $result->free_result();
}

$mysqli->close();
