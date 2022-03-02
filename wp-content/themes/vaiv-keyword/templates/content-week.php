<?php

/**
 * Template Name: Content List Week
 */

get_header();

?>

<main id="primary" class="site-main">
  <div class="container px-custom">
    <div class="content-list-wrap">
      <div class="row">
        <div class="col-xl-6 order-2 order-xl-1" data-aos="fade-up">
          <div class="content-list-inner">
            <?php
            while (have_posts()) :
              the_post();
              the_title('<h1 class="entry-title content-title">', '</h1>');
              the_content();
            endwhile; // End of the loop.
            ?>
          </div>
        </div>
        <div class="col-xl-6 order-1 order-xl-2 mb-50 mb-xl-0" data-aos="fade-right">
          <?php vaiv_keyword_post_thumbnail(); ?>
        </div>
      </div>

      <div class="content-item-wrap" id="content_week">
        <div class="row g-custom-x">
          <?php
          // Build meta query
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $meta_query_array = array();
          $args = array(
            'category_name' => 'content-week',
            'paged' => $paged,
            'meta_query' => $meta_query_array,
            'orderby'        => array(
              'date' => 'DESC'
            )
          );
          $query = new WP_Query($args);

          if ($query->have_posts()) {
            $index = 1;
            $opacity_index = 1;
            while ($query->have_posts()) {
              $query->the_post();
              // $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
              $featured_img_url = get_field('image_for_list', get_the_ID());

              $the_title = wp_strip_all_tags(get_the_title());

              if (mb_strlen($the_title) > 28) {
                $the_title = mb_substr($the_title, 0, 28) . '...';
              }

              if ($opacity_index == 7) {
                $opacity_cls = "visually-hidden-mobile";
                $opacity_index = 0;
              }

          ?>
              <div class="col-lg-6 col-xl-4" data-aos="fade-up">
                <div class="content-item <?php echo $opacity_cls; ?>">
                  <div class="content-item-thumbnail">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $featured_img_url; ?>" class="img-fluid" alt="<?php echo wp_strip_all_tags(get_the_title()); ?>" /></a>
                  </div>
                  <div class="d-flex">
                    <div class="content-item-date content-week-item-date">
                      <?php echo get_the_date('Y년 n월 j주'); ?>
                      <?php if (($index == 1) && ($paged == 1)) { ?><span class="ms-2 badge bg-primary">New</span><?php } ?>
                    </div>
                  </div>
                  <h3 class="content-item-title content-week-item-title">
                    <a href="<?php echo get_permalink(); ?>"><?php echo $the_title; ?></a>
                  </h3>
                </div>
              </div>
            <?php
              $opacity_index++;
              $index++;
            }

            // Show view more button
            echo '
            <div class="d-flex d-xl-none justify-content-center mb-30">
              <button id="view-more-content" class="border-white rounded rounded-pill bg-black-100 py-6 px-16 text-13 text-black-300">더보기 +</button>
            </div>
            ';
          } else {
            ?>
            <div class="col-12">
              <p>내용이 오고 있습니다... 나중에 시도해 주세요!</p>
            </div>
          <?php
          }
          ?>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="pagination-wrap">
            <?php
            $max_page = $query->max_num_pages;
            $big = 999999999; // need an unlikely integer

            if (($paged == 1) && ($max_page > 1)) echo '<a class="prev page-numbers isDisabled"><i class="bi-chevron-left"></i></a>';

            echo paginate_links(array(
              'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
              'format' => '?paged=%#%',
              'current' => max(1, get_query_var('paged')),
              'total' => $max_page,
              'prev_text'          => __('<i class="bi-chevron-left"></i>'),
              'next_text'          => __('<i class="bi-chevron-right"></i>'),
            ));
            if (($paged == $max_page) && ($max_page > 1)) echo '<a class="next page-numbers isDisabled"><i class="bi-chevron-right"></i></a>';
            ?>
            <a href="https://some.co.kr/magazine/home" target="_blank" class="page-archive">썸매거진 아카이브 <i class="bi-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();
