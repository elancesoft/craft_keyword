<?php

/**
 * Template Name: Content List Month
 */

get_header();

?>
<main id="primary" class="container px-6 mx-auto md:px-0 md:max-w-2xl xl:container">
  <div class="grid grid-rows-2 md:grid-rows-none md:grid-cols-12">
    <div class="order-2 md:order-1 md:col-span-5" data-aos="fade-up">
      <div class="content-list-inner">
        <?php
        while (have_posts()) :
          the_post();
          the_title('<h1 class="text-22 font-normal text-black-2e mt-40 md:mt-0 md:text-31 xl:text-60 xl:font-medium">', '</h1>');
          the_content();
        endwhile; // End of the loop.
        ?>
      </div>
    </div>
    <div class="order-1 px-7 md:px-0 md:order-2 md:col-span-6 md:col-end-13" data-aos="fade-right">
      <?php vaiv_keyword_post_thumbnail(); ?>
    </div>
  </div>

  <div class="grid grid-flow-row-dense px-[70px] md:px-0 gap-y-10 mt-[48px] md:grid-cols-3 md:mt-[137px] md:gap-y-40 md:gap-x-[62px] xl:mt-[173px] xl:grid-cols-4 xl:gap-y-[70px] xl:gap-x-[62px]" id="content_list">
    <?php
    // Build meta query
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $meta_query_array = array();
    $args = array(
      'category_name' => 'content-month',
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
        $featured_img_url = get_field('image_for_list', get_the_ID());
        $the_title = wp_strip_all_tags(get_the_title());

        if (mb_strlen($the_title) > 28) {
          $the_title = mb_substr($the_title, 0, 28) . '...';
        }

        if ($opacity_index == 2) {
          $opacity_cls = "hidden md:block";
          $opacity_index = 0;
        }

        // Text blue for the first item and just in the first page
        $color_direction = 'text-gray-4c';
        if (($paged == 1) && ($index == 1)) {
          $color_direction = 'text-blue-0f';
        }

    ?>
        <div class="content-item <?php echo $opacity_cls; ?>" data-aos="fade-up">
          <div class="">
            <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $featured_img_url; ?>" class="img-fluid" alt="<?php echo wp_strip_all_tags(get_the_title()); ?>" /></a>
          </div>
          <div class="flex mt-[16px] gap-x-2 xl:mt-[27px] xl:gap-x-[44px]">
            <div class="text-13 text-gray-70 xl:text-22"><?php echo get_the_date('Y년 n월 j주'); ?></div>
            <?php if (($index == 1) && ($paged == 1)) { ?><span class="flex items-center rounded-full text-white text-11 bg-blue-0f px-2 xl:text-20">NEW</span><?php } ?>
          </div>
          <h3 class="<?php echo $color_direction; ?> mt-2 text-15 md:text-13 xl:text-27">
            <a href="<?php echo get_permalink(); ?>"><?php echo $the_title; ?></a>
          </h3>
        </div>
      <?php
        $opacity_index++;
        $index++;
      }
    } else {
      ?>
      <div class="col-span-3 text-center text-[#e1366a] text-20 pb-70 xl:pb-70 xl:text-30" role="alert">
        내용이 오고 있습니다... 나중에 시도해 주세요!
      </div>
    <?php
    }
    ?>
  </div>

  <?php
  // Show view more button
  echo '
  <div class="flex mt-30 justify-center md:hidden">
    <button id="view-more-content" class="rounded-full bg-gray-dd text-13 text-gray-4c px-3 py-1">더보기 +</button>
  </div>
  ';
  ?>

  <div class="flex relative justify-center items-center">
    <?php
    $max_page = $query->max_num_pages;
    ?>
    <?php if ($max_page > 1) : ?>
    <div class="flex gap-x-3 mt-[48px] pagination-wrap font-roboto text-15 xl:text-20 xl:gap-x-40">
      <?php
      
      $big = 999999999; // need an unlikely integer

      if (($paged == 1) && ($max_page > 1)) echo '<a class="prev page-numbers disabled"><i class="bi-chevron-left"></i></a>';

      echo paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $max_page,
        'prev_text'          => __('<i class="bi-chevron-left"></i>'),
        'next_text'          => __('<i class="bi-chevron-right"></i>'),
      ));
      if (($paged == $max_page) && ($max_page > 1)) echo '<a class="next page-numbers disabled"><i class="bi-chevron-right"></i></a>';
      ?>
    </div>
    <?php endif; ?>

    <?php
    $cls_seemore_position_top = 'bottom-0';
    if ($max_page <= 1) {
      $cls_seemore_position_top = 'top-[50px]';
    }
    ?>
    <div class="absolute right-0 <?php echo $cls_seemore_position_top; ?> hidden md:inline-block">
        <a href="https://some.co.kr/magazine/home" target="_blank" class="rounded-full bg-gray-e8 text-gray-4d  hover:bg-black-37 hover:text-white md:px-4 md:py-2 xl:text-27 xl:font-medium xl:px-30 xl:py-3">썸매거진 아카이브 <i class="bi-chevron-right"></i></a>
      </div>
  </div>
</main><!-- #main -->

<?php
get_footer();
