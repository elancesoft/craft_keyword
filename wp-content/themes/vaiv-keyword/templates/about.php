<?php

/**
 * Template Name: About Page
 */

get_header();
?>

<main id="primary" class="site-main-aboutus">
  <div class="container">
    <div id="aboutus-banner" class="aboutus-banner main-banner-section">
      <div class="aboutus-banner-text text-center">
        <?php
        $banner_text = get_field('banner_text', get_the_ID());
        $banner_title_line1 = get_field('banner_title_line1', get_the_ID());
        $banner_title_line2 = get_field('banner_title_line2', get_the_ID());
        ?>

        <h1 class="entry-title">
          <span class="main-color-black"><?php echo $banner_title_line1; ?></span><br>
          <?php echo $banner_title_line2; ?>
        </h1>
        <div class="aboutus-banner-desc"><?php echo $banner_text; ?></div>
      </div>

      <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
      </div>
    </div>

    <div class="aboutus-description" data-aos="fade-up">
      <?php
      while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
    </div>

    <?php
    // SHOW ACTIVITIES
    if (have_rows('activity')) :
      echo '<div class="aboutus-activity">';
      echo '<div class="row">';
      while (have_rows('activity')) : the_row();
        // Load sub field value.
        $the_title = get_sub_field('about_title');
        $the_icon = get_sub_field('about_icon');
        $the_desc = get_sub_field('about_description');

        echo '
          <div class="col-md-4">
            <div class="aboutus-activity-item aos-init aos-animate" data-aos="fade-right">
              <div class="aboutus-activity-image"><img src="' . $the_icon['url'] . '" /></div>
              <h3 class="aboutus-activity-title">' . $the_title . '</h3>
              <div class="aboutus-activity-desc">' . $the_desc . '</div>
            </div>
          </div>
          ';
      endwhile;
      echo '</div>';
      echo '</div>';
    endif;
    ?>

    <?php
    // SHOW INTRODUCTION
    if (have_rows('introductions')) :
      echo '<div class="aboutus-introduction text-center text-md-start">';
      echo '<h2 class="widget-title main-color-blue" data-aos="fade-up">활동 소개</h2>';
      while (have_rows('introductions')) : the_row();
        // Load sub field value.
        $introduction_title = get_sub_field('introduction_title');
        $introduction_description = get_sub_field('introduction_description');
        $introduction_link = get_sub_field('introduction_link');

        $introduction_link_html = '';
        if (strlen($introduction_link) > 0) {
          $introduction_link_html = '<p class="aboutus-introduction-link-more text-end text-md-start mt-3"><a href="' . $introduction_link . '" target="_blank">더 알아보기 <i class="bi-chevron-right"></i></a></p>';
        }

        $table_attribute = '';
        if (have_rows('atributes')) :
          $table_attribute = '<div class="table-responsive mt-4">';
          $table_attribute .= '<table class="table table-borderless">';
          while (have_rows('atributes')) : the_row();
            $attribute_title = get_sub_field('attribute_title');
            $attribute_description = get_sub_field('attribute_description');
            $attribute_link = get_sub_field('attribute_link');

            $table_attribute .= '
            <tr>
              <td><a href="' . $attribute_link . '"><span class="main-color-blue">' . $attribute_title . '</span></a></td>
              <td><a href="' . $attribute_link . '">' . $attribute_description . '</a></td>
              <td><a href="' . $attribute_link . '"><i class="bi-chevron-right"></i></a></td>
            </tr>';
          endwhile;
          $table_attribute .= '</table>';
          $table_attribute .= '</div>';
        endif;

        echo '
        <div class="row mt-5" data-aos="fade-up">
          <div class="col-md-3">
            <h3 class="module-sub-title main-color-black bg-border d-inline-block pb-1 mb-3">' . $introduction_title . '</h3>
          </div>
          <div class="col-md-9">' . $introduction_description . $table_attribute . $introduction_link_html . '</div>
        </div>
        ';
      endwhile;
      echo '</div>';
    endif;
    ?>
  </div><!-- container -->
</main><!-- #main -->

<?php
get_footer();
