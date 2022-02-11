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
?>

<main id="primary" class="site-main">
  <div class="container">
    <div class="hot-brand">
      <?php
      $hot_brand_args = [
        'category_name' => 'brand-ranking',
        'posts_per_page' => 3,
        'orderby'        => array(
          'ID' => 'DESC'
        )
      ];
      $hot_brand_post = get_posts($hot_brand_args);
      ?>
      <div class="row">
        <div class="col-md-4 order-2 order-md-1 text-center text-md-start">
          <?php
          foreach ($hot_brand_post as $index => $post) :
            echo '
              <div data-aos="fade-up">
                <h4 class="hot-brand-date fade show">' . get_the_date("Y년 m월 d주") . '</h4>';
            if (strlen($hot_brand_title) > 0) :
              echo '<h3 class="widget-title hot-brand-title">' . $hot_brand_title . '</h3>';
            endif;
            echo '</div>';

            echo '
              <div class="hot-brand-detail" data-aos="fade-up" id="hot-brand-top1">
                <div><span class="hot-brand-detail-item-order">Top ' . ($index + 1) . '</span><span class="hot-brand-detail-item-title"><a href="' . get_permalink() . '">' . $post->post_title . '</a></span></div>
                <div class="hot-brand-detail-text">
                  <a href="' . get_permalink() . '">' . $post->post_content . '</a>
                </div>
              </div>
              ';
            if ($index == 0) break;
          endforeach;
          ?>
        </div>

        <div class="col-md-7 offset-md-1 order-1 order-md-2">
          <div class="hot-brand-right text-end" data-aos="fade-up">
            <?php
            if (sizeof($hot_brand_image) > 0) :
              echo '<img src="' . $hot_brand_image['url'] . '" />';
            endif;
            ?>
            <ul class="hot-brand-list">
              <?php
              foreach ($hot_brand_post as $index => $post) :
                $active = ($index == 0) ? 'active' : '';
                echo '<li class="host-brand-item ' . $active . '" data-alias="hot-brand-top1"><span>' . ($index + 1) . '. ' . $post->post_title . '</span></li>';
              endforeach;
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="today-pick">
      <button id="today-pick-previous-desktop" class="d-none d-md-inline-block"><i class="bi-chevron-left"></i></button>
      <button id="today-pick-next-desktop" class="d-none d-md-inline-block"><i class="bi-chevron-right"></i></button>
      <div class="row">
        <div class="col-md-4">
          <div class="today-pick-left" data-aos="fade-up">
            <div class="today-pick-left-inner">
              <?php
              if (strlen($today_pick_title) > 0) :
                echo '<h3 class="widget-title mb-3 mb-md-4">' . $today_pick_title . '</h3>';
              endif;

              if (strlen($today_pick_sub_title) > 0) :
                echo '<p class="mb-0">' . $today_pick_sub_title . '</p>';
              endif;
              ?>
              <h4 class="widget-title today-pick-sub-title bg-border d-none d-md-inline-block">누림의 대중화</h4>
            </div>
          </div>
        </div>
        <div class="col-md-8 text-center text-md-end">
          <?php
          // Get 3 most viewing count from brand, week content, month content
          $latest_post_from_each_category = [];
          $categories = [
            [
              'key' => 'content-week'
            ],
            [
              'key' => 'content-month'
            ],
            [
              'key' => 'brand-ranking'
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
          ?>
          <div class="today-pick-slider" data-aos="fade-up">
            <button id="today-pick-previous" class="d-md-none"><i class="bi-chevron-left"></i></button>
            <button id="today-pick-next" class="d-md-none"><i class="bi-chevron-right"></i></button>
            <ul class="today-pick-slider-list">
              <?php
              $i = 0;
              foreach ($latest_post_from_each_category as $index => $today_pick_post) {
                $active = ($i == 1) ? ' active' : '';

                $post_title = $today_pick_post->post_title;
                $post_title = '주간 관측소';

                $post_link = get_permalink($today_pick_post->ID);
                $post_date = get_the_date("Y년 m월 d주", $today_pick_post->ID);
                //$post_thumbnail = get_the_post_thumbnail_url($today_pick_post->ID, 'full');

                if ($index == 0) {
                  $post_thumbnail = 'http://some.craft.support/wp-content/uploads/2022/02/today-pick-1.png';
                } else if ($index == 1) {
                  $post_thumbnail = 'http://some.craft.support/wp-content/uploads/2022/02/today-pick-2.png';
                } else {
                  $post_thumbnail = 'http://some.craft.support/wp-content/uploads/2022/02/today-pick-3.png';
                }

                echo '
                <li class="today-pick-slider-item' . $active . '">
                <p class="today-pick-slider-item-title mb-2"><a href="' . $post_link . '">' . $post_title . '</a></p>
                <a href="' . $post_link . '"><img src="' . $post_thumbnail . '" /></a>
                <p class="today-pick-slider-item-date mt-2">' . $post_date . '</p>
                </li>
                ';

                $i++;
              }
              ?>
            </ul>
          </div>
        </div>
        <div class="col-12 text-center d-md-none">
          <h4 class="widget-title today-pick-sub-title bg-border d-inline-block">누림의 대중화</h4>
        </div>
      </div>
    </div>

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
          'ID' => 'DESC'
        )
      );
      $trend_query = new WP_Query($trend_args);
      ?>
      <div class="trend-list" data-aos="fade-up">
        <div class="row">
          <?php
          if ($trend_query->have_posts()) :
            while ($trend_query->have_posts()) :
              $trend_query->the_post();
              $text_except = get_the_excerpt();

              echo '
              <div class="col-md-4 mb-3 mb-md-0">
                <div class="card">
                  <a href="' . get_permalink() . '"><img src="' . get_the_post_thumbnail_url(get_the_ID(), 'full') . '" class="img-fluid" alt="' . get_the_title() . '" /></a>
                  <div class="card-body">
                    <h5 class="card-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>
                    <p class="card-date">' . get_the_date("Y년 m월 d주") . '</p>
                    <div><a href="' . get_permalink() . '">' . $text_except . '</a></div>
                  </div>
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
      </div>
    </div>

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
            while ($monthly_query->have_posts()) :
              $monthly_query->the_post();
              $text_except = get_the_excerpt();

              // Get Author
              $post_author_id = (int) $wpdb->get_var($wpdb->prepare("SELECT post_author FROM {$wpdb->posts} WHERE ID = %d ", get_the_ID()));
              $author =  new WP_User($post_author_id);
              //$post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
              $post_thumbnail = 'http://some.craft.support/wp-content/uploads/2022/01/content-month-image.png';

              echo '
              <div class="col-md-4" data-aos="fade-right">
                <a href="' . get_permalink() . '"><img src="' . $post_thumbnail . '" class="img-fluid" alt="' . get_the_title() . '" /></a>
              </div>

              <div class="col-md-4 offset-md-2" data-aos="fade-left">
                <p class="monthly-insight-content-date">' . get_the_date('Y년 m월') . ' 호</p>
                <h3 class="monthly-insight-content-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>
                <p class="monthly-insight-content-writer">' . $author->display_name . '</p>
                <div class="monthly-insight-content-desc"><a href="' . get_permalink() . '">' . $text_except . '</a></div>
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