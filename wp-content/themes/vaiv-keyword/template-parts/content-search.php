<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package VAIV_Keyword
 */

?>

<article class="mb-5">
	<div class="row">
		<div class="col-3">
			<?php vaiv_keyword_post_thumbnail(); ?>
		</div>
		<div class="col-9">
			<div class=""><?php echo get_the_date('Y년 m월 d주'); ?></div>
			<a href="<?php echo esc_url(get_permalink()); ?>"><?php the_excerpt(); ?></a>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->