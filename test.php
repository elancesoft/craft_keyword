<?php
$conn = mysqli_connect("112.175.32.149", "brin_data", "daumsoft0531!", "brin_data");

// check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

/**
 * Get Brand Ranking Detail Rank No 1 NAME
 * Using Page(s): Brand Ranking Detail
 */
function get_brandrankingdetail_rank_no1_name($conn)
{
  $query = "
  SELECT BRIN_SCORE_TB.BRND_NM
  FROM (
    SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
    FROM BRIN_SCORE_TB
    WHERE DATE = '20220207'
    GROUP BY CATE_NM, BRND_NM
    ORDER BY max_score DESC limit 10
  ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 1 OFFSET 0;";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
      // $data = $row['BRND_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

// Call function
$result = get_brandrankingdetail_rank_no1_name($conn);
print_r($result);
