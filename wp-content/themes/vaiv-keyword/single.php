<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package VAIV_Keyword
 */

get_header();
?>

<main id="primary" class="site-main-content">
	<div class="container">
		<?php
		while (have_posts()) :
			the_post();

			$category = get_the_category();
			if ($category[0]->slug == 'brand-ranking') {
				get_template_part('template-parts/content', 'brand-ranking');
			} else {
				get_template_part('template-parts/content', get_post_type());

				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle"><i class="bi-chevron-left"></i> 이전글</span> <span class="nav-title">%title</span>',
						'next_text' => '<span class="nav-title">%title</span> <span class="nav-subtitle">다음글 <i class="bi-chevron-right"></i></span>',
					)
				);
			}
		endwhile; // End of the loop.
		?>
	</div>

</main><!-- #main -->

<?php
get_footer();
