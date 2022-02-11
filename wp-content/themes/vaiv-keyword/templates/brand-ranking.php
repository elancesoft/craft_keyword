<?php

/**
 * Template Name: Brand Ranking Page
 */

get_header();
?>

<?php
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
?>
<main id="primary" class="site-main">
  <div class="container">
    <div class="brandrakinglist-description">
      <div class="row">
        <div class="col-md-6 order-2 order-md-1" data-aos="fade-right">
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

        <div class="col-md-6 order-1 order-md-2 text-center text-md-end">
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
        if (strlen($brandrankinglist_title) > 0 ) :
          echo $brandrankinglist_title;
        endif;

        if (strlen($brandrankinglist_sub_title) > 0 ) :
          echo '<p class="brandrankinglist_sub_title">' . $brandrankinglist_sub_title .'</p>';
        endif;
        ?>
      </div>

      <div class="brandranking-top10-list">
        <div class="row">
          <?php
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
            while ($query->have_posts()) {
              $query->the_post();
          ?>
              <div class="col-md-4">
                <div class="brandranking-top10-item aos-init aos-animate" data-aos="fade-up">
                  <h3 class="brandranking-top10-item-month"><?php echo get_the_date('m'); ?></h3>
                  <p class="brandranking-top10-item-week"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_date('Y년 m월 d주'); ?></a></p>
                  <p class="brandranking-top10-item-period">10.25 - 10.31</p>
                  <div class="brandranking-top10-item-hastag">
                    <?php
                    $tags = get_the_tags(get_the_ID());
                    foreach ($tags as $tag) {
                      echo '<a href="' . get_tag_link($tag->term_id) . '"><span># ' . $tag->name . '</span></a>';
                    }
                    ?>
                  </div>
                </div>
              </div>
            <?php
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

        <div class="row">
          <div class="col-12">
            <div class="pagination-wrap brandrakinglist-pagination">
              <?php
              $big = 999999999; // need an unlikely integer

              echo paginate_links(array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $query->max_num_pages,
                'prev_text'          => __('<i class="bi-chevron-left"></i>'),
                'next_text'          => __('<i class="bi-chevron-right"></i>'),
              ));
              ?>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div><!-- container -->
</main><!-- #main -->
<?php
get_footer();
