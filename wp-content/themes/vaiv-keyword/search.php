<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package VAIV_Keyword
 */

get_header();

global $wp_query;
$post_count = $wp_query->found_posts;
?>

<main id="primary" class="site-main">
	<div class="container">
		<div class="search_form">
			<div class="row justify-content-center">
				<div class="col-6">
					<?php get_search_form(); ?>
				</div>
			</div>

		</div>

		<?php if (have_posts()) : ?>
			<header class="page-header">
				<h1 class="widget-title my-5 text-center">
					<?php
					/* translators: %s: search query. */
					printf(esc_html__('"%s" 검색결과', 'vaiv-keyword'), '<span>' . get_search_query() . '</span>');
					echo ' <span class="main-color-blue">' . $post_count . '</span>';
					?>
				</h1>
			</header><!-- .page-header -->

		<?php
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content', 'search');
			endwhile;
			the_posts_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
		?>
	</div>
</main><!-- #main -->

<?php
get_footer();
