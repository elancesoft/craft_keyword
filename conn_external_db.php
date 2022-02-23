<?php
$conn = mysqli_connect("112.175.32.149", "brin_data", "daumsoft0531!", "brin_data");



/**
 * Get Brand Ranking Date (home page, brand ranking detail page)
 * @param $conn Connection
 * @return $brand_date The date as string
 */
function elancesoft_get_brand_date($conn)
{
  $brand_date = '';
  $query = "
  select concat(
          YEAR(t1.DATE), '년 ',
          MONTH(t1.DATE), '월 ',
          week(t1.DATE,5) - week(DATE_SUB(t1.DATE, INTERVAL DAYOFMONTH(t1.DATE)-1 DAY),5), '주차'
  ) as WEEK_NM
  FROM (
          select DATE_SUB('20220207', INTERVAL 7 DAY) as DATE
  ) t1";

  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $brand_date = $row['WEEK_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $brand_date;
}

/**
 * Get hot brand name (Home page)
 */
function elancesoft_get_hot_brand_name($conn)
{
  $hot_brand_name = '';
  $query_hot_brand_name = "
  SELECT DISTINCT BRIN_SCORE_TB.BRND_NM
  FROM (
          SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
          FROM BRIN_SCORE_TB
          WHERE DATE = '20220207'
          GROUP BY CATE_NM, BRND_NM
          ORDER BY max_score DESC limit 10
  ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 1 OFFSET 0;";

  if ($result = $conn->query($query_hot_brand_name)) {
    while ($row = $result->fetch_assoc()) {
      $hot_brand_name = $row['BRND_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $hot_brand_name;
}

/**
 * Get hot brand ranking description (Home page)
 */
function elancesoft_get_hot_brand_description($conn)
{
  $hot_brand_desc = '';
  $query_hot_brand_desc = "
  SELECT DISTINCT BRIN_SCORE_TB.DESC
  FROM (
          SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
          FROM BRIN_SCORE_TB
          WHERE DATE = '20220207'
          GROUP BY CATE_NM, BRND_NM
          ORDER BY max_score DESC limit 10
  ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 1 OFFSET 0;";

  if ($result = $conn->query($query_hot_brand_desc)) {
    while ($row = $result->fetch_assoc()) {
      $hot_brand_desc = $row['DESC'];
    }
    // Free result set
    $result->free_result();
  }

  return $hot_brand_desc;
}

/**
 * Get top5 brand categories (Brand Ranking Detail Page)
 */
function elancesoft_get_top5_brand_categories($conn)
{
  $top_5_brand_categories = array();

  $query = "
  SELECT DISTINCT BRIN_SCORE_TB.CATE_NM
  FROM (
          SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
          FROM BRIN_SCORE_TB
          WHERE DATE = '20220207'
          GROUP BY CATE_NM, BRND_NM
          ORDER BY max_score DESC limit 10
  ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 5 OFFSET 0;";

  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $top_5_brand_categories[] = $row['CATE_NM'];
    }
    // Free result set
    $result->free_result();
  }
}
