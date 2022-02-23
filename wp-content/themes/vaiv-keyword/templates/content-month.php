<?php

/**
 * Template Name: Content List Month
 */

get_header();
?>

<main id="primary" class="site-main">
  <div class="container px-custom">
    <div class="content-list-wrap">
      <div class="row">
        <div class="col-md-6 order-2 order-md-1" data-aos="fade-up">
          <?php
          while (have_posts()) :
            the_post();
            the_title('<h1 class="entry-title mb-5">', '</h1>');
            the_content();
          endwhile; // End of the loop.
          ?>
        </div>
        <div class="col-md-6 order-1 order-md-2" data-aos="fade-right">
          <?php vaiv_keyword_post_thumbnail(); ?>
        </div>
      </div>

      <div class="content-item-wrap" id="content">
        <div class="row g-custom-medium-x">
          <?php
          // Build meta query
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $meta_query_array = array();
          $args = array(
            'category_name' => 'content-month',
            'paged' => $paged,
            'meta_query' => $meta_query_array,
            'orderby'        => array(
              'ID' => 'DESC'
            )
          );
          $query = new WP_Query($args);

          if ($query->have_posts()) {
            $index = 1;
            while ($query->have_posts()) {
              $query->the_post();
              $featured_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

              $the_title = get_the_title();

              if (mb_strlen($the_title) > 22) {
                $the_title = mb_substr($the_title, 0, 22) . '...';
              }
          ?>
              <div class="col-md-3" data-aos="fade-up">
                <div class="content-item">
                  <div class="content-item-thumbnail">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $featured_img_url; ?>" class="img-fluid" alt="<?php echo get_the_title(); ?>" /></a>
                  </div>
                  <div class="d-flex">
                    <div class="content-item-date">
                      <?php echo get_the_date('Y년 m월 d주'); ?>
                      <?php if (($index == 1) && ($paged == 1)) { ?><span class="ms-2 badge bg-primary">New</span><?php } ?>
                    </div>
                  </div>
                  <h3 class="content-item-title">
                    <a href="<?php echo get_permalink(); ?>"><?php echo $the_title; ?></a>
                  </h3>
                </div>
              </div>
            <?php
              $index++;
            }
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

            if ($paged == 1) echo '<a class="prev page-numbers isDisabled"><i class="bi-chevron-left"></i></a>';
            echo paginate_links(array(
              'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big) . '#content')),
              'format' => '?paged=%#%',
              'current' => max(1, get_query_var('paged')),
              'total' => $query->max_num_pages,
              'prev_text'          => __('<i class="bi-chevron-left"></i>'),
              'next_text'          => __('<i class="bi-chevron-right"></i>'),
            ));
            if ($paged == $max_page) echo '<a class="next page-numbers isDisabled"><i class="bi-chevron-right"></i></a>';
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
