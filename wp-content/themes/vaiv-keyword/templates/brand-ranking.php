<?php

/**
 * Template Name: Brand Ranking Page
 */

get_header();

// Connect to external db
require_once(ABSPATH . 'conn_external_db.php');

?>
<main id="primary" class="site-main">
  <div class="container px-custom">
    <div class="brandrakinglist-description">
      <div class="row">
        <div class="col-md-6 order-2 order-md-1" data-aos="fade-up">
          <?php
          while (have_posts()) :
            the_post();
            the_title('<h1 class="entry-title mb-5 brandrakinglist-description-title">', '</h1>');
            echo '<div class="brandrakinglist-desc-detail">';
            the_content();
            echo '</div>';
          endwhile; // End of the loop.
          ?>
        </div>

        <div class="col-md-6 order-1 order-md-2 text-center text-md-end" data-aos="fade-right">
          <div class="brandrankinglist-thumbnail"><?php vaiv_keyword_post_thumbnail(); ?></div>
        </div>
      </div>
    </div>

    <div class="brandranking-top10">
      <?php
      $brandrankinglist_title = get_field('brandrankinglist_title');
      $brandrankinglist_sub_title = get_field('brandrankinglist_sub_title');
      ?>
      <div class="brandranking-top10-header" data-aos="fade-up">
        <?php
        if (strlen($brandrankinglist_title) > 0) :
          echo $brandrankinglist_title;
        endif;

        if (strlen($brandrankinglist_sub_title) > 0) :
          echo '<p class="brandrankinglist_sub_title">' . $brandrankinglist_sub_title . '</p>';
        endif;
        ?>
      </div>

      <div class="brandranking-top10-list" id="content">
        <div class="row g-custom-x">
          <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $meta_query_array = array();
          $args = array(
            'category_name' => 'brand-ranking',
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
          ?>
              <div class="col-md-4">
                <div class="brandranking-top10-item aos-init aos-animate" data-aos="fade-up">
                  <a href="<?php echo get_permalink(); ?>">
                    <h3 class="brandranking-top10-item-month"><?php echo get_the_date('n'); ?></h3>
                    <p class="brandranking-top10-item-week"><?php echo get_the_date('Y년 n월 j주'); ?></p>
                    <div class="d-flex brandranking-top10-item-period">
                      <div class="brandranking-top10-item-period-text">10.25 - 10.31</div>
                      <?php if (($index == 1) && ($paged == 1)) { ?><div><span class="badge bg-primary">New</span></div><?php } ?>
                    </div>
                  </a>
                  <div class="brandranking-top10-item-hastag page-<?php echo $paged; ?>">
                    <?php
                    $tags = get_the_tags(get_the_ID());
                    foreach ($tags as $tag_index => $tag) {
                      //echo '<a href="' . get_tag_link($tag->term_id) . '"><span># ' . $tag->name . '</span></a>';
                      echo '<span># ' . $tag->name . '</span>';
                      if ($tag_index == 2) break; // just get MAX 3 tags
                    }
                    ?>
                  </div>
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

        <?php
        $max_page = $query->max_num_pages;
        if ($max_page > 1) :
        ?>

        <div class="row">
          <div class="col-12">
            <div class="pagination-wrap brandrakinglist-pagination">
              <?php
              $big = 999999999; // need an unlikely integer

              if ($paged == 1 && $max_page != 1) echo '<a class="prev page-numbers isDisabled"><i class="bi-chevron-left"></i></a>';

              echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'prev_text'          => __('<i class="bi-chevron-left"></i>'),
                'next_text'          => __('<i class="bi-chevron-right"></i>'),
              ));
              if ($paged == $max_page  && $max_page != 1) echo '<a class="next page-numbers isDisabled"><i class="bi-chevron-right"></i></a>';
              ?>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div><!-- container -->
</main><!-- #main -->
<?php
get_footer();
