<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package VAIV_Keyword
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="entry-header">
		<div class="row">
			<div class="col-md-6">
				<?php
				$category = get_the_category(get_the_ID());
				$category_name = $category[0]->name;
				$page_name = '주간 관측소'; // Default Content Week
				if (strpos($category_name, "Month")) $page_name = '월간 관측소';
				?>
				<div class=""> <?php echo $page_name, ' ',  get_the_date('Y년 m월 d주'); ?></div>
				<?php
				if (is_singular()) :
					the_title('<h1 class="entry-title my-3">', '</h1>');
				else :
					the_title('<h2 class="entry-title my-3"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				endif;

				// Get author: name and email
				$post_author_id = (int) $wpdb->get_var($wpdb->prepare("SELECT post_author FROM {$wpdb->posts} WHERE ID = %d ", get_the_ID()));
				$author =  new WP_User($post_author_id);

				$author_info = $author->display_name . ' | <a href="mailto:' . $author->user_email . '">' . $author->user_email . '</a>';
				?>
				<div class="author-info mt-3 mb-3"><?php echo $author_info; ?></div>

				<div class="content-detail-hastag">

					<?php
					$categories = $wpdb->get_results("
					SELECT DISTINCT(terms.term_id) as ID, terms.name, terms.slug
					FROM $wpdb->posts as posts
					LEFT JOIN $wpdb->term_relationships as relationships ON posts.ID = relationships.object_ID
					LEFT JOIN $wpdb->term_taxonomy as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
					LEFT JOIN $wpdb->terms as terms ON tax.term_id = terms.term_id
					WHERE 1=1 AND (
							posts.post_status = 'publish' AND
							posts.post_author = " . $author->ID . " AND
							tax.taxonomy = 'category' )
					ORDER BY terms.name ASC
					");

					//$tags = get_the_tags(get_the_ID());
					//print_r($tags);

					foreach ($categories as $category) {
						// print_r($tag);
						echo '<span class="content-detail-tag"># ' . $category->name . '</span>';
					}

					?>
				</div>

				<div class="content-detail-copyright">
					<?php
					$copy_right = get_field('copy_right', get_the_ID());
					echo $copy_right;
					?>
				</div>
			</div>
			<div class="col-md-6">
				<?php vaiv_keyword_post_thumbnail(); ?>
			</div>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'vaiv-keyword'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'vaiv-keyword'),
				'after'  => '</div>',
			)
		);
		?>

		<div class="entry-content-viewcount-share">
			<div class="row">
				<div class="col-6">
					<?php echo do_shortcode("[post-views]"); ?>
				</div>
				<div class="col-6 text-end">share</div>
			</div>
		</div>

		<div class="entry-content-author-comment mt-5">
			<ul class="nav nav-tabs" id="entryComment" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" id="author-tab" data-bs-toggle="tab" href="#author-info" role="tab" aria-controls="author-info" aria-selected="true">연구원 소개</a>
				</li>
				<li class="nav-item" role="presentation">
					<a class="nav-link" id="comment-form-tab" data-bs-toggle="tab" href="#comment-form" role="tab" aria-controls="comment-form" aria-selected="false">최신 콘텐츠</a>
				</li>
			</ul>
			<div class="tab-content" id="entryCommentContent">
				<div class="tab-pane fade show active" id="author-info" role="tabpanel" aria-labelledby="author-tab">
					<?php echo $author_info; ?>
					<div class="author-bio mt-2">
						<?php
						$author_description = get_user_meta($author->ID, 'description', true);
						echo $author_description;
						?>
					</div>

					<div class="author-category mt-4">
						<?php
						foreach ($categories as $category) {
							echo '<a href="" class="entry-content-author-category"># ' . $category->name . '</a>';
						}
						?>
					</div>
				</div>
				<div class="tab-pane fade" id="comment-form" role="tabpanel" aria-labelledby="comment-form-tab">
					<?php
					$args = array(
						'author'        =>  $author->ID,
						'orderby'       =>  'post_date',
						'order'         =>  'DESC',
						'posts_per_page' => -1 // no limit
					);

					$current_user_posts = get_posts($args);
					
					// print_r($current_user_posts);

					if (sizeof($current_user_posts) > 0) {
						echo '<ul class="">';
						foreach($current_user_posts as $post_item) {
							echo '<li><a href="' . get_permalink($post_item->ID) . '">' . $post_item->post_title . '</a></li>';
						}
						echo '</ul';
					} else {
						echo '이 사용자는 더 이상 게시물이 없습니다';
					}
					
					?>

					sdsfdf
				</div>
			</div>

		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //vaiv_keyword_entry_footer(); 
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->