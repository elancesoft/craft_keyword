<?php

/**
 * Template Name: Home Page
 */

get_header();

$hot_brand_setting = get_field('hot_brand_settings');
$hot_brand_title = $hot_brand_setting['hot_brand_title'];
$hot_brand_image = $hot_brand_setting['hot_brand_image'];

$today_pick_setting = get_field('today_pick_settings');
$today_pick_title = $today_pick_setting['today_pick_title'];
$today_pick_sub_title = $today_pick_setting['today_pick_sub_title'];

$trend_setting = get_field('trend_setting');
$trend_title = $trend_setting['trend_title'];
$trend_sub_title = $trend_setting['trend_sub_title'];
$trend_view_more_text = $trend_setting['trend_view_more_text'];
$trend_view_more_url = $trend_setting['trend_view_more_url'];

$monthly_setting = get_field('monthly_insight_setting');
$monthly_title = $monthly_setting['monthly_title'];
$monthly_sub_title = $monthly_setting['monthly_sub_title'];
$monthly_view_more_text = $monthly_setting['monthly_view_more_text'];
$monthly_view_more_url = $monthly_setting['monthly_view_more_url'];

// Connect to external db
require_once(ABSPATH . 'conn_external_db.php');

?>

<main id="primary" class="site-main text-6xl">
  <div class="container px-custom">

    <!-- HOT BRAND SECTION -->
    <div class="hot-brand">
      <?php
      // Get hot brand data
      $hot_brand_date = elancesoft_get_brand_date($conn);
      $hot_brand_name = elancesoft_get_hot_brand_name($conn);
      $hot_brand_desc = elancesoft_get_hot_brand_description($conn);
      ?>
      <div class="row">
        <div class="col-xl-4 order-2 order-xl-1 text-center text-xl-start">
          <div data-aos="fade-up">
            <h4 class="hot-brand-date mt-60 mt-xl-0 mb-0 fade show"><?php echo $hot_brand_date; ?></h4>
            <h3 class="widget-title hot-brand-title">화제의 브랜드</h3>
          </div>
          <div class="hot-brand-detail" data-aos="fade-up" id="hot-brand-top1">
            <div><span class="hot-brand-detail-item-order">TOP 1 </span><span class="hot-brand-detail-item-title"><?php echo $hot_brand_name; ?></span></div>
            <div class="hot-brand-detail-text"><?php echo $hot_brand_desc; ?></div>
          </div>
        </div>

        <div class="col-xl-7 offset-xl-1 order-1 order-xl-2">
          <div class="hot-brand-right text-center text-xl-end" data-aos="fade-up">
            <?php
            if (sizeof($hot_brand_image) > 0) :
              echo '<img src="' . $hot_brand_image['url'] . '" />';
            endif;
            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- TODAY PICK SECTION -->
    <div class="today-pick">
      <?php
      // Get 3 most viewing count from brand, week content, month content
      $latest_post_from_each_category = [];
      $categories = [
        [
          'key' => 'content-week'
        ],
        [
          'key' => 'content-month'
        ]
      ];

      // Cicle trough categories to get each cat's latest post ID
      foreach ($categories as $cat) {
        $today_pick_args = [
          'category_name' => $cat['key'],
          'posts_per_page' => 1,
          'orderby'        => array(
            'post_views' => 'DESC'
          )
        ];
        $the_post = PVC_GET_MOST_VIEWED_POSTS($today_pick_args);
        $latest_post_from_each_category = array_merge($latest_post_from_each_category, $the_post);
      };

      $the_default_post_title_for_both_mobile_and_desktop = '';
      ?>

      <button id="today-pick-previous-desktop" class="d-none d-xl-inline-block"><i class="bi-chevron-left"></i></button>
      <button id="today-pick-next-desktop" class="d-none d-xl-inline-block"><i class="bi-chevron-right"></i></button>

      <div class="row">
        <div class="col-xl-4">
          <div class="today-pick-left" data-aos="fade-up">
            <div class="today-pick-left-inner text-center text-xl-start mb-30 mb-xl-0">
              <?php
              if (strlen($today_pick_title) > 0) :
                echo '<h3 class="widget-title mb-3 mb-xl-4">' . $today_pick_title . '</h3>';
              endif;

              if (strlen($today_pick_sub_title) > 0) :
                echo '<p class="mb-0">' . $today_pick_sub_title . '</p>';
              endif;

              foreach ($latest_post_from_each_category as $index => $today_pick_post) :
                if ($index == 0) {
                  $the_default_post_title_for_both_mobile_and_desktop = $today_pick_post->post_title;

                  echo '<h4 id="today-pick-post-title" class="widget-title today-pick-sub-title bg-border d-none d-xl-inline-block">' . $the_default_post_title_for_both_mobile_and_desktop . '</h4>';
                  break;
                }
              endforeach;
              ?>
            </div>
          </div>
        </div>

        <div class="col-xl-8 text-center text-xl-end">
          <div class="today-pick-slider" data-aos="fade-up">
            <button id="today-pick-previous" class="d-xl-none"><i class="bi-chevron-left"></i></button>
            <button id="today-pick-next" class="d-xl-none"><i class="bi-chevron-right"></i></button>
            <ul class="today-pick-slider-list">
              <?php
              // Show data of the Brand Ranking
              echo '
                <li class="today-pick-slider-item" data-title="' . $hot_brand_name . '">
                <div class="today-pick-slider-item-overlay">&nbsp;</div>
                <p class="today-pick-slider-item-title mb-2 text-blue font-semibold">브랜드 랭킹</p>
                <img src="http://some.craft.support/wp-content/uploads/2022/02/today-pick-2.png" />
                <p class="today-pick-slider-item-date mt-2">' . $hot_brand_date . '</p>
                </li>
              ';

              foreach ($latest_post_from_each_category as $index => $today_pick_post) {
                $active = ($index == 0) ? ' active' : '';

                $post_title = $today_pick_post->post_title;
                $cat_title = get_the_category($today_pick_post->ID)[0]->name;
                $cat_slug = get_the_category($today_pick_post->ID)[0]->slug;

                $post_date = get_the_date("Y년 n월 j주", $today_pick_post->ID);

                if ($cat_slug == 'content-month') {
                  $post_date = get_the_date("Y년 n월 호", $today_pick_post->ID);
                }

                $post_link = get_permalink($today_pick_post->ID);
                

                $post_thumbnail = get_field('image_for_main', $today_pick_post->ID);

                echo '
                  <li class="today-pick-slider-item' . $active . '" data-title="' . $post_title . '">
                  <div class="today-pick-slider-item-overlay">&nbsp;</div>
                  <p class="today-pick-slider-item-title mb-2"><a href="' . $post_link . '">' . $cat_title . '</a></p>
                  <a href="' . $post_link . '"><img src="' . $post_thumbnail . '" /></a>
                  <p class="today-pick-slider-item-date mt-2">' . $post_date . '</p>
                  </li>
                ';
              }
              ?>
            </ul>
          </div>
        </div>
        <div class="col-12 text-center d-xl-none">
          <h4  id="today-pick-post-title-mobile" class="widget-title today-pick-sub-title bg-border d-inline-block"><?php echo $the_default_post_title_for_both_mobile_and_desktop; ?></h4>
        </div>
      </div>
    </div>

    <!-- TREND SECTION -->
    <div class="trend">
      <div data-aos="fade-up">
        <?php
        if (strlen($trend_title) > 0) :
          echo '<h3 class="widget-title mb-3 text-center text-md-start">' . $trend_title . '</h3>';
        endif;

        if (strlen($trend_sub_title) > 0) :
          echo '<p class="my-0 text-center text-md-start">' . $trend_sub_title . '</p>';
        endif;
        ?>
      </div>

      <?php
      // Get 3 latest weekly content
      $trend_args = array(
        'category_name' => 'content-week',
        'posts_per_page' => 3,
        'orderby'        => array(
          'date' => 'DESC'
        )
      );
      $trend_query = new WP_Query($trend_args);
      ?>
      <div class="trend-list-owl owl-carousel owl-theme" data-aos="fade-up">
        <?php
        if ($trend_query->have_posts()) :
          while ($trend_query->have_posts()) :
            $trend_query->the_post();
            $text_except = get_the_excerpt();

            $post_thumbnail = get_field('image_for_list', get_the_ID());

            echo '
              <div class="trend-list-owl-item 111">
                <a href="' . get_permalink() . '"><img src="' . $post_thumbnail . '" class="img-fluid" alt="' . get_the_title() . '" /></a>
                <div class="trend-list-owl-item-body">
                  <h5 class="trend-list-owl-item-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>
                  <p class="trend-list-owl-item-date">' . get_the_date("Y년 n월 j주") . '</p>
                  <div class="trend-list-owl-item-content"><a href="' . get_permalink() . '">' . $text_except . '</a></div>
                </div>
              </div>
              ';
          endwhile;
        endif;
        ?>
      </div>
      <?php
      if ((strlen($trend_view_more_url) > 0) && (strlen($trend_view_more_text) > 0)) :
        echo '
          <div class="trend-link-more">
            <a href="' . $trend_view_more_url . '">' . $trend_view_more_text . ' <i class="bi-chevron-right"></i></a>
          </div>
          ';
      endif; ?>

      <!-- MONTHLy INSIGHT SECTION -->
      <div class="monthly-insight">
        <div data-aos="fade-up">
          <?php
          if (strlen($monthly_title) > 0) :
            echo '<h3 class="widget-title">' . $monthly_title . '</h3>';
          endif;

          if (strlen($monthly_sub_title) > 0) :
            echo '<p class="monthly-insight-sub-title">' . $monthly_sub_title . '</p>';
          endif;
          ?>
        </div>

        <div class="monthly-insight-content">
          <?php
          // Get 3 latest monthly content
          $monthly_args = array(
            'category_name' => 'content-month',
            'posts_per_page' => 1,
            'orderby'        => array(
              'ID' => 'DESC'
            )
          );
          $monthly_query = new WP_Query($monthly_args);
          ?>
          <div class="row">
            <?php
            if ($monthly_query->have_posts()) :
              $monthly_query_post_link = '';

              while ($monthly_query->have_posts()) :
                $monthly_query->the_post();
                $text_except = get_the_excerpt();

                $monthly_query_post_link = get_permalink();

                // Get Author
                $post_author_id = (int) $wpdb->get_var($wpdb->prepare("SELECT post_author FROM {$wpdb->posts} WHERE ID = %d ", get_the_ID()));
                $author =  new WP_User($post_author_id);
                $writer = $author->display_name;
                // $writer = '박현영 소장';

                // $post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                //$post_thumbnail = 'http://some.craft.support/wp-content/uploads/2022/01/content-month-image.png';
                $post_thumbnail = get_field('image_for_list', get_the_ID());

                echo '
              <div class="col-xl-4" data-aos="fade-right">
                <div class="monthly-insight-content-thumb"><a href="' . $monthly_query_post_link . '"><img src="' . $post_thumbnail . '" class="img-fluid" alt="' . get_the_title() . '" /></a></div>
              </div>

              <div class="col-xl-4 offset-xl-2" data-aos="fade-left">
                <p class="monthly-insight-content-date">' . get_the_date('Y년 n월') . ' 호</p>
                <h3 class="monthly-insight-content-title"><a href="' . $monthly_query_post_link . '">' . get_the_title() . '</a></h3>
                <p class="monthly-insight-content-writer">' . $writer . '</p>
                <div class="monthly-insight-content-desc"><a href="' . $monthly_query_post_link . '">' . $text_except . '</a></div>
              </div>
              ';
              endwhile;
            endif;
            ?>
          </div>
          <?php
          if ((strlen($monthly_view_more_url) > 0) && (strlen($monthly_view_more_text) > 0)) :
            echo '
          <div class="monthly-insight-link-more">
            <a href="' . $monthly_view_more_url . '">' . $monthly_view_more_text . ' <i class="bi-chevron-right"></i></a>
          </div>
          ';
          endif;
          ?>
        </div>
      </div>
    </div>
</main><!-- #main -->

<?php
get_footer();