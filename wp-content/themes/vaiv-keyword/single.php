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

				// Get previous post title
				$prev_post = get_previous_post();
				$prev_title = '';
				if ($prev_post) {
					$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));

					if (strlen($prev_title) >= 18)  //<-- here is your custom checking
					{
						$prev_title = (mb_substr($prev_title, 0, 18)) . "...";
					}
				}

				// Get next post title
				$next_post = get_next_post();
				$next_title = '';
				if ($next_post) {
					$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
					if (strlen($next_title) >= 18) //<-- here is your custom checking
					{
						$next_title = (mb_substr($next_title, 0, 18)) . "...";
					}
				}


				the_post_navigation(
					array(
						'prev_text' => '<span class="nav-subtitle"><i class="bi-chevron-left"></i> 이전글</span> <span class="nav-title">' . $prev_title . '</span>',
						'next_text' => '<span class="nav-subtitle d-block d-md-none">다음글 <i class="bi-chevron-right"></i></span> <span class="nav-title">' . $next_title . '</span> <span class="nav-subtitle d-none d-md-inline-block">다음글 <i class="bi-chevron-right"></i></span>',
					)
				);
			}
		endwhile; // End of the loop.
		?>
	</div>

</main><!-- #main -->

<?php
get_footer();
