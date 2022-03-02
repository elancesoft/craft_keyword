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
 * Get Upload Month
 * Using Page(s): Brand Ranking
 */
function elancesoft_get_brandranking_upload_month($conn)
{
  $query = "
  select MONTH(DATE_SUB(t1.DATE, INTERVAL 7 DAY)) AS MONTH
FROM (
        select DATE_ADD(DATE, INTERVAL 7 DAY) as DATE
           from (
                   select distinct DATE
                from BRIN_SCORE_TB
                order by DATE desc
                limit 10
    ) t2
) t1";

  $data = array();
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
      //$data = $row['MONTH'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking List Date
 * Using Page(s): Brand Ranking
 */
function elancesoft_get_brandranking_date($conn)
{
  $query = "
  select concat(
    YEAR(t1.DATE), '년 ',
    MONTH(t1.DATE), '월 ',
    week(t1.DATE,5) - week(DATE_SUB(t1.DATE, INTERVAL DAYOFMONTH(t1.DATE)-1 DAY),5), '주차'
) as WEEK_NM
FROM (
    select DATE_ADD(DATE, INTERVAL 7 DAY) as DATE
       from (
               select distinct DATE
            from BRIN_SCORE_TB
            order by DATE desc
            limit 10
) t2
) t1";

  

  $data = array();
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
      // $data = $row['WEEK_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Analysis Period
 * Using Page(s): Brand Ranking
 */
function elancesoft_get_brandranking_analysis_period($conn)
{
  $query = "
  select concat(DATE_FORMAT(DATE_SUB(t1.DATE, INTERVAL 7 DAY), '%m.%d'), '~', DATE_FORMAT(DATE_SUB(t1.DATE, INTERVAL 1 DAY), '%m.%d')) as WEEK_NM
FROM (
        select DATE_SUB(DATE, INTERVAL 7 DAY) as DATE
           from (
                   select distinct DATE
                from BRIN_SCORE_TB
                order by DATE desc
                limit 10
    ) t2
) t1";

  $data = array();
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row;
      // $data = $row['DATE'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}


/**
 * Get Brand Ranking Top 3 TAGS (Brand category)
 * Using Page(s): Brand Ranking
 */
function elancesoft_get_brandranking_top3_tags($conn)
{
  $query = "
  SELECT DISTINCT BRIN_SCORE_TB.CATE_NM
  FROM (
    SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
    FROM BRIN_SCORE_TB
    WHERE DATE = '20220207'
    GROUP BY CATE_NM, BRND_NM
    ORDER BY max_score DESC limit 10
  ) t1 
  INNER JOIN 
    BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 3 OFFSET 0;";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row['CATE_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}


/**
 * Get Brand Ranking Detail Date
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_date($conn)
{
  $query = "
  select concat(
    YEAR(t1.DATE), '년 ',
    MONTH(t1.DATE), '월 ',
    week(t1.DATE,5) - week(DATE_SUB(t1.DATE, INTERVAL DAYOFMONTH(t1.DATE)-1 DAY),5), '주차'
  ) as WEEK_NM
  FROM (
      select DATE_SUB('20220207', INTERVAL 7 DAY) as DATE
  ) t1";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['WEEK_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}


/**
 * Get Brand Ranking Detail Top5 TAGS (Brand Category)
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_top5_tags($conn)
{
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

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data[] = $row['CATE_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}


/**
 * Get Brand Ranking Detail Rank No 1 NAME
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no1_name($conn)
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
      $data = $row['BRND_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 2 NAME
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no2_name($conn)
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
  LIMIT 1 OFFSET 1;";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['BRND_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 3 NAME
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no3_name($conn)
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
  LIMIT 1 OFFSET 2;";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['BRND_NM'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 1 Logo
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no1_logo($conn)
{
  $query = "
  SELECT BRND_CD
  FROM BRIN_BRAND_IMG_TB
  WHERE BRND_NM = (
      SELECT BRIN_SCORE_TB.BRND_NM
      FROM (
        SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
        FROM BRIN_SCORE_TB
        WHERE DATE = '20220207'
        GROUP BY CATE_NM, BRND_NM
        ORDER BY max_score DESC limit 10
      ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
      LIMIT 1 OFFSET 0)";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['BRND_CD'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 2 Logo
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no2_logo($conn)
{
  $query = "
  SELECT BRND_CD
  FROM BRIN_BRAND_IMG_TB
  WHERE BRND_NM = (
    SELECT BRIN_SCORE_TB.BRND_NM
    FROM (
      SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
      FROM BRIN_SCORE_TB
      WHERE DATE = '20220207'
      GROUP BY CATE_NM, BRND_NM
      ORDER BY max_score DESC limit 10
    ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
    LIMIT 1 OFFSET 1)";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['BRND_CD'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 3 Logo
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no3_logo($conn)
{
  $query = "
  SELECT BRND_CD
  FROM BRIN_BRAND_IMG_TB
  WHERE BRND_NM = (
    SELECT BRIN_SCORE_TB.BRND_NM
    FROM (
            SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
            FROM BRIN_SCORE_TB
            WHERE DATE = '20220207'
            GROUP BY CATE_NM, BRND_NM
            ORDER BY max_score DESC limit 10
    ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
    LIMIT 1 OFFSET 2)";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['BRND_CD'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 1 Keyword
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no1_keyword($conn)
{
  $query = "
  SELECT BRIN_SCORE_TB.ISSUE_KEYWORD
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
      $data = $row['ISSUE_KEYWORD'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 2 Keyword
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no2_keyword($conn)
{
  $query = "
  SELECT BRIN_SCORE_TB.ISSUE_KEYWORD
  FROM (
    SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
    FROM BRIN_SCORE_TB
    WHERE DATE = '20220207'
    GROUP BY CATE_NM, BRND_NM
    ORDER BY max_score DESC limit 10
  ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 1 OFFSET 1;";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['ISSUE_KEYWORD'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}

/**
 * Get Brand Ranking Detail Rank No 3 Keyword
 * Using Page(s): Brand Ranking Detail
 */
function elancesoft_get_brandrankingdetail_rank_no3_keyword($conn)
{
  $query = "
  SELECT BRIN_SCORE_TB.ISSUE_KEYWORD
  FROM (
    SELECT DATE, CATE_NM, BRND_NM, CHNL_NM, MAX(SCORE) as max_score
    FROM BRIN_SCORE_TB
    WHERE DATE = '20220207'
    GROUP BY CATE_NM, BRND_NM
    ORDER BY max_score DESC limit 10
  ) t1 INNER JOIN BRIN_SCORE_TB ON t1.DATE = BRIN_SCORE_TB.DATE AND t1.CATE_NM = BRIN_SCORE_TB.CATE_NM AND t1.BRND_NM = BRIN_SCORE_TB.BRND_NM AND t1.max_score = BRIN_SCORE_TB.SCORE
  LIMIT 1 OFFSET 2;";

  $data = null;
  if ($result = $conn->query($query)) {
    while ($row = $result->fetch_assoc()) {
      $data = $row['ISSUE_KEYWORD'];
    }
    // Free result set
    $result->free_result();
  }

  return $data;
}