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

<!-- <main id="primary" class="w-full md:max-w-2xl md:mx-auto xl:max-w-none "> -->
<main id="primary" class="container px-6 mx-auto md:px-0 md:max-w-2xl xl:container">
  <!-- HOT BRAND SECTION -->
  <div class="text-center md:text-left">
    <?php
    // Get hot brand data
    $hot_brand_date = elancesoft_get_brand_date($conn);
    $hot_brand_name = elancesoft_get_hot_brand_name($conn);
    $hot_brand_desc = elancesoft_get_hot_brand_description($conn);
    ?>
    <div class="grid grid-rows-1 md:grid-rows-none md:grid-cols-9">
      <div class="order-2 md:order-1 mt-60 md:mt-0 md:col-start-1 md:col-end-4 ">
        <div data-aos="fade-up">
          <h4 class="text-13 md:text-15 xl:text-27 text-gray-4c"><?php echo $hot_brand_date; ?></h4>
          <h3 class="text-22 font-bold mt-2 md:text-31 md:font-normal xl:text-60 xl:font-medium text-black-2e ">화제의 브랜드</h3>
        </div>
        <div class="mt-4 md:mt-100" data-aos="fade-up">
          <div class="flex items-center justify-center md:justify-start">
            <div class="flex items-center bg-blue-0f text-white text-12 px-3 py-1 mr-3 rounded-full md:font-roboto md:mr-2 md:text-15 xl:font-opensan xl:text-27 xl:px-30 xl:mr-4">TOP 1</div>
            <div class="text-15 text-gray-41 md:text-17 md:font-roboto xl:text-31 xl:font-medium"><?php echo $hot_brand_name; ?></div>
          </div>
          <?php if (strlen($hot_brand_desc) > 0) : ?>
            <div class="text-19 text-gray-70 mt-6"><?php echo $hot_brand_desc; ?></div>
          <?php endif; ?>
        </div>
      </div>

      <div class="order-1 md:order-2 md:col-span-5 md:col-end-10 ">
        <div class="flex items-end h-full" data-aos="fade-up">
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
  <div class="relative mt-[64px] md:mt-140 xl:mt-200">
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

    <button id="today-pick-previous-desktop" class="hidden md:inline-block md:absolute md:left-0 md:text-22 md:top-1/2 md:ml-[-30px] md:translate-y-[-50%] 2xl:text-40 2xl:left-[-100px]"><i class="bi-chevron-left"></i></button>
    <button id="today-pick-next-desktop" class="hidden md:inline-block md:absolute md:right-0 md:text-22 md:top-1/2 md:mr-[-30px] md:translate-y-[-50%] 2xl:text-40 2xl:right-[-100px]"><i class="bi-chevron-right"></i></button>

    <div class="md:grid md:grid-cols-10">
      <div class="md:flex md:items-center md:col-span-3 md:col-start-1" data-aos="fade-up">
        <div class="text-center leading-8 mt-60 md:leading-none md:mt-0 md:text-left">
          <?php
          if (strlen($today_pick_title) > 0) :
            echo '<h3 class="text-22 font-bold text-black-2e md:font-roboto md:text-31 md:font-normal xl:font-noto xl:font-medium xl:text-60 ">' . $today_pick_title . '</h3>';
          endif;

          if (strlen($today_pick_sub_title) > 0) :
            echo '<p class="text-13 text-gray-4c md:font-roboto md:mt-3 xl:font-medium xl:text-27 xl:mt-40">' . $today_pick_sub_title . '</p>';
          endif;

          foreach ($latest_post_from_each_category as $index => $today_pick_post) :
            if ($index == 0) {
              $the_default_post_title_for_both_mobile_and_desktop = $today_pick_post->post_title;

              echo '<h4 id="today-pick-post-title" class="hidden font-roboto text-20 font-normal text-gray-41 mt-30 md:inline-block xl:font-light xl:text-60">' . $the_default_post_title_for_both_mobile_and_desktop . '</h4>';
              break;
            }
          endforeach;
          ?>
        </div>
      </div>

      <div class="md:col-span-6 md:col-end-11">
        <div class="relative justify-center md:justify-end" data-aos="fade-up">
          <button id="today-pick-previous" class="absolute left-[-20px] text-20 top-1/2 translate-y-[-50%]  md:hidden"><i class="bi-chevron-left"></i></button>
          <button id="today-pick-next" class="absolute right-[-20px] text-20 top-1/2 translate-y-[-50%] md:hidden"><i class="bi-chevron-right"></i></button>

          <ul class="today-pick-slider-list">
            <?php
            // Show data of the Brand Ranking
            echo '
              <li class="today-pick-slider-item" data-title="' . $hot_brand_name . '">
                <div class="today-pick-slider-item-overlay">&nbsp;</div>
                <p class="today-pick-slider-item-title mb-2 text-blue-0f font-medium">브랜드 랭킹</p>
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
      <div class="col-12 text-center md:hidden">
        <h4 id="today-pick-post-title-mobile" class=""><?php echo $the_default_post_title_for_both_mobile_and_desktop; ?></h4>
      </div>
    </div>
  </div>

  <!-- TREND SECTION -->
  <div class="border-t border-gray-87 mt-64">
    <div class="text-center md:text-left" data-aos="fade-up">
      <?php
      if (strlen($trend_title) > 0) :
        echo '<h3 class="font-bold text-22 text-black-2e mt-24 md:mt-30 md:text-31 md:font-normal xl:mt-50 xl:text-60 xl:font-medium">' . $trend_title . '</h3>';
      endif;

      if (strlen($trend_sub_title) > 0) :
        echo '<p class="text-13 text-gray-4c mt-2 xl:text-27">' . $trend_sub_title . '</p>';
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
    <div class="border-t border-gray-dd mt-24 pt-24 md:pt-30 md:mt-30 xl:mt-[35px] xl:pt-[43px]">
      <div class="grid grid-cols-3 trend-list-owl owl-carousel owl-theme" data-aos="fade-up">
        <?php
        if ($trend_query->have_posts()) :
          while ($trend_query->have_posts()) :
            $trend_query->the_post();
            $text_except = get_the_excerpt();

            $post_thumbnail = get_field('image_for_list', get_the_ID());

            echo '
              <div class="bg-blue-f5 h-full">
                <a href="' . get_permalink() . '" class=""><img src="' . $post_thumbnail . '" class="img-fluid" alt="' . get_the_title() . '" /></a>
                <div class="px-4">
                  <h5 class=""><a href="' . get_permalink() . '" class="inline-block text-15 font-normal text-gray-41 mt-[16px] md:font-roboto md:text-14 xl:text-31 xl:font-medium">' . get_the_title() . '</a></h5>
                  <p class="text-12 text-gray-70 font-medium md:font-normal md:font-roboto md:mt-1 xl:text-20 xl:mt-2">' . get_the_date("Y년 n월 j주") . '</p>
                  <div class="text-12 tetx-gray-70 mt-[17px] mb-40 md:font-roboto md:mt-20 md:mb-[33px] xl:text-19 xl:mt-50 xl:mb-[83px]"><a href="' . get_permalink() . '">' . $text_except . '</a></div>
                </div>
              </div>
              ';
          endwhile;
        endif;
        ?>
      </div>
    </div>
    <?php
    if ((strlen($trend_view_more_url) > 0) && (strlen($trend_view_more_text) > 0)) :
      echo '
          <div class="flex justify-end">
            <a href="' . $trend_view_more_url . '" class="text-15 text-gray-4c mt-24 md:font-roboto md:text-14 md:mt-40 xl:text-27 xl:mt-50">' . $trend_view_more_text . ' <i class="bi-chevron-right"></i></a>
          </div>
          ';
    endif; ?>
  </div>

  <!-- MONTHLy INSIGHT SECTION -->
  <div class="border-t border-gray-87 mt-64 text-center md:text-left">
    <div data-aos="fade-up">
      <?php
      if (strlen($monthly_title) > 0) :
        echo '<h3 class="text-22 font-bold text-black-2e mt-24 md:text-31 md:mt-30 xl:mt-50 xl:text-60 xl:font-medium">' . $monthly_title . '</h3>';
      endif;

      if (strlen($monthly_sub_title) > 0) :
        echo '<p class="text-13 font-normal mt-2 text-gray-4c xl:text-27">' . $monthly_sub_title . '</p>';
      endif;
      ?>
    </div>

    <div class="border-t border-gray-dd mt-24 md:mt-30 xl:mt-50">
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
      <div class="mt-24 md:grid md:grid-cols-7 md:mt-30">
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
                <div class="md:col-span-2" data-aos="fade-right">
                  <div class="w-[215px] mx-auto md:w-full"><a href="' . $monthly_query_post_link . '"><img src="' . $post_thumbnail . '" class="img-fluid" alt="' . get_the_title() . '" /></a></div>
                </div>

                <div class="md:col-span-3 md:col-end-7" data-aos="fade-left">
                  <p class="text-13 text-gray-4c mt-4 md:text-18 md:font-roboto md:mt-0 xl:text-27 xl:font-noto">' . get_the_date('Y년 n월') . ' 호</p>
                  <h3 class="font-normal text-24 text-gray-41 mt-4 md:font-roboto md:text-27 md:mt-30 xl:font-noto xl:text-43 xl:font-medium xl:mt-42"><a href="' . $monthly_query_post_link . '">' . get_the_title() . '</a></h3>
                  <p class="text-12 mt-2 text-gray-4c md:font-roboto md:text-15 xl:font-noto xl:text-20">' . $writer . '</p>
                  
                  <div class="text-13 text-gray-4c mt-20 md:font-roboto md:text-14 md:mt-[133px] xl:text-[19px] xl:mt-[90px]"><a href="' . $monthly_query_post_link . '">' . $text_except . '</a></div>
                </div>
              ';
          endwhile;
        endif;
        ?>
      </div>
      <?php
      if ((strlen($monthly_view_more_url) > 0) && (strlen($monthly_view_more_text) > 0)) :
        echo '
          <div class="flex mt-24 text-15 text-gray-4c justify-end md:font-roboto md:text-14 xl:font-noto xl:text-20">
            <a href="' . $monthly_view_more_url . '">' . $monthly_view_more_text . ' <i class="bi-chevron-right"></i></a>
          </div>
          ';
      endif;
      ?>
    </div>
  </div>
</main><!-- #main -->

<?php
get_footer();
