<?php

/**
 * Template Name: Brand Ranking Page
 */

get_header();

// Connect to external db
require_once(ABSPATH . 'conn_external_db.php');

?>
<main id="primary" class="container px-6 mx-auto md:px-0 md:max-w-2xl xl:container">
  <div class="grid grid-rows-2 md:grid-rows-none md:grid-cols-12">
    <div class="order-2 md:order-1 md:col-span-5">
      <div class="" data-aos="fade-up">
        <?php
        while (have_posts()) :
          the_post();
          the_title('<h1 class="text-black-2e text-22 mt-[36px] font-normal text-center md:mt-0 md:text-left md:text-31 xl:text-60 xl:font-medium">', '</h1>');
          echo '<div class="text-gray-41 text-15 mt-24 md:text-16 md:mt-20 xl:text-31 xl:mt-[34px]">';
          the_content();
          echo '</div>';
        endwhile; // End of the loop.
        ?>
      </div>
    </div>

    <div class="order-1 md:order-2 md:col-span-6 md:col-end-13 md:flex md:items-end" data-aos="fade-right">
      <div class="brandrankinglist-thumbnail mb-md-50 mb-lg-0"><?php vaiv_keyword_post_thumbnail(); ?></div>
    </div>
  </div>

  <div class="mt-[64px] md:mt-[137px] xl:mt-[178px]">
    <?php
    $brandrankinglist_title = get_field('brandrankinglist_title');
    $brandrankinglist_sub_title = get_field('brandrankinglist_sub_title');
    ?>
    <div class="text-gray-4c text-22 font-light md:font-normal md:text-20 xl:text-60" data-aos="fade-up">
      <?php
      if (strlen($brandrankinglist_title) > 0) :
        echo $brandrankinglist_title;
      endif;

      if (strlen($brandrankinglist_sub_title) > 0) :
        echo '<p class="font-light text-gray-70 text-13 mt-[22px] md:tet-13 xl:mt-[34px] xl:text-27 ">' . $brandrankinglist_sub_title . '</p>';
      endif;
      ?>
    </div>

    <div class="mt-40 xl:mt-[95px]" id="content">
      <div class="grid grid-flow-row-dense md:grid-cols-3 md:gap-x-40 md:gap-y-[35px] xl:gap-y-30 xl:gap-x-[90px]">
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


        $upload_date = elancesoft_get_brandranking_upload_month($conn);
        $the_date = elancesoft_get_brandranking_date($conn);
        $the_analysis_period = elancesoft_get_brandranking_analysis_period($conn);
        $top3_tags = elancesoft_get_brandranking_top3_tags($conn);

        $total_item = sizeof($upload_date);

        $brand_ranking_list = array();

        for ($i = 1; $i <= 12; $i++) {
          $brand_ranking_list[] = array(
            'ID' => $i,
            'name' => 'Brand ' . $i,
            'category' => 'Category Name ' . $i,
            'description' => 'Description for this brand ' . $i,
            'upload_month' => rand(1,12),
            'date' => '2022년 01월 4주',
            'period' => '10.25 - 10.31',
            'keyword' => 'keyword tet ' . $i,
            'sns_logo' => 'twitter',
            'score' => rand(1, 100) / 10,
            'logo' => 'https://some.craft.support/wp-content/uploads/2022/01/brand-6.png',
            'hashtag' => array ('뷰티', '식음', '기타')
          );
        }

        if (sizeof($brand_ranking_list) > 0) {
          $index = 1;
          foreach ($brand_ranking_list as $item) {
            $class_border_top = '';
            $class_text_color_item = 'text-gray-4c';
            if (($paged == 1) && ($index <= 3)) {
              if ($index == 1) {
                $class_border_top = 'border-t border-t-gray-87';
                $class_text_color_item = 'text-blue-0f';
              } else {
                $class_border_top = 'md:border-t md:border-t-gray-87';
              }
            }

        ?>
            <div class="<?php echo $class_border_top;?> border-b border-b-gray-dd py-[12px] md:pt-[26px] md:pb-[12px] xl:py-30" data-aos="fade-up">
              <a href="<?php echo get_permalink(); ?>" class="inline-block">
                <h3 class="font-roboto font-medium text-gray-9a opacity-25 text-40 md:text-40 xl:text-[77px]"><?php echo $item['upload_month']; ?></h3>
                <p class="font-medium text-15 xl:text-27 <?php echo $class_text_color_item; ?>"><?php echo $item['date']; ?></p>
                <div class="flex items-center">
                  <div class="font-roboto text-15 text-gray-4c md:font-light xl:text-31"><?php echo $item['period']; ?></div>
                  <?php if (($index == 1) && ($paged == 1)) { ?>
                    <span class="rounded-full px-1.5 bg-blue-0f ml-1 text-white text-11 xl:text-20">NEW</span>
                  <?php } ?>
                </div>
              </a>
              <div class="flex <?php echo $class_text_color_item; ?> text-13 gap-3 mt-20 md:mt-[43px] xl:mt-[92px] xl:text-20 page-<?php echo $paged; ?>">
                <?php
                foreach ($item['hashtag'] as $tag_index => $tag) {
                  echo '<span># ' . $tag . '</span>';
                }
                ?>
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
</main><!-- #main -->
<?php
get_footer();
