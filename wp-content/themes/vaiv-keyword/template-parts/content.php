<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package VAIV_Keyword
 */

$link_share = get_permalink();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="grid md:grid-cols-2 md:gap-x-[100px] xl:gap-x-[115px]">
		<div class="order-2 md:order-1">
			<?php
			$category = get_the_category(get_the_ID());
			$category_slug = $category[0]->slug;

			$page_name = '주간 관측소'; // Default Content Week
			$the_date = get_the_date('Y년 n월 j주');

			if (strpos($category_slug, "month")) {
				$page_name = '월간 관측소';
				$the_date = get_the_date('Y년 n월 호');
			}
			?>
			<div class="text-gray-4c text-15 mt-24 md:mt-0 md:text-13 xl:text-27"> <?php echo $page_name, ' ',  $the_date; ?></div>
			<?php
			if (is_singular()) :
				the_title('<h1 class="text-22 md:text-20 xl:text-43 font-medium mt-2 text-black-2e">', '</h1>');
			else :
				the_title('<h2 class="text-22 md:text-20 xl:text-43 font-medium mt-2 text-black-2e"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
			endif;

			// Get author: name and email
			$post_author_id = (int) $wpdb->get_var($wpdb->prepare("SELECT post_author FROM {$wpdb->posts} WHERE ID = %d ", get_the_ID()));
			$author =  new WP_User($post_author_id);

			$author_info = $author->display_name . ' | ' . $author->user_email;
			?>
			<div class="text-12 xl:text-19 text-gray-4c mt-[12px] md:mt-[45px] xl:mt-2"><?php echo $author_info; ?></div>

			<?php $tags = get_the_tags(get_the_ID()); ?>
			<?php if (is_array($tags) & sizeof($tags) > 0) : ?>
				<div class="mt-20 md:mt-1 xl:mt-6 flex gap-2">
					<?php
					// 	$categories = $wpdb->get_results("
					// SELECT DISTINCT(terms.term_id) as ID, terms.name, terms.slug
					// FROM $wpdb->posts as posts
					// LEFT JOIN $wpdb->term_relationships as relationships ON posts.ID = relationships.object_ID
					// LEFT JOIN $wpdb->term_taxonomy as tax ON relationships.term_taxonomy_id = tax.term_taxonomy_id
					// LEFT JOIN $wpdb->terms as terms ON tax.term_id = terms.term_id
					// WHERE 1=1 AND (
					// 		posts.post_status = 'publish' AND
					// 		posts.post_author = " . $author->ID . " AND
					// 		tax.taxonomy = 'category' )
					// ORDER BY terms.name ASC
					// ");


					foreach ($tags as $index => $tag) {
						$cls_bg_text = 'text-gray-4d bg-gray-e8';
						if ($index == 0) $cls_bg_text = 'text-white bg-blue-0f';
						echo '<span class="text-13 md:text-11 xl:text-27 font-bold xl:font-medium rounded-full py-2 md:py-1 px-4 xl:px-6 ' . $cls_bg_text . '"># ' . $tag->name . '</span>';
					}

					// foreach ($categories as $category) {
					// 	echo '<span class="content-detail-tag"># ' . $category->name . '</span>';
					// }
					?>
				</div>
			<?php endif; ?>

			<div class="text-11 md:text-12 xl:text-19 text-gray-70 mt-[36px] xl:mt-[100px]">
				<?php
				$copy_right = get_field('copy_right', get_the_ID());
				echo $copy_right;
				?>
			</div>
		</div>
		<div class="order-1 md:oder-2 md:flex md:items-end md:justify-end">
			<div class="px-40 md:px-0"><?php vaiv_keyword_post_thumbnail(); ?></div>
		</div>
	</header><!-- .entry-header -->

	<div class="text-content-wrap">
		<h2 class="hidden text-22 xl:text-43 border-b border-b-gray-dd xl:border-b-2 pb-20 xl:pb-24 mb-32 xl:mb-[72px] mt-[76px] xl:mt-100">sfsdf</h2>
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

		<div class="flex mt-[65px] md:mt-100 xl:mt-[180px] items-center justify-between">
			<div class="flex items-center justify-end rounded-full bg-gray-eb px-4 xl:px-7 py-1 xl:py-2">
				<span class="min-w-[60px] xl:min-w-[76px] flex items-center block justify-end bg-view-count xl:bg-view-count-xl bg-left bg-no-repeat font-roboto text-13 xl:text-21 text-gray-4c"><?php echo pvc_get_post_views($post_id); ?></span>
			</div>

			<div class="relative">
				<div class="hidden absolute toast-message right-0 top-[-30px] xl:top-[-50px]">URL 링크가 복사되었습니다.</div>
				<ul class="flex gap-x-[9px] xl:gap-x-20">
					<li><a href="https://story.kakao.com/s/share?url=<?php echo $link_share; ?>" target="_blank"><button class="bg-vaiv-kakao bg-cover w-[30px] h-[30px] xl:w-[63px] xl:h-[63px]">&nbsp;</button></a></li>
					<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link_share; ?>" target="_blank"><button class="bg-vaiv-facebook bg-cover w-[30px] h-[30px] xl:w-[63px] xl:h-[63px]">&nbsp;</button></a></li>
					<li><a href="https://twitter.com/intent/tweet?url=<?php echo $link_share; ?>" target="_blank"><button class="bg-vaiv-twitter bg-cover w-[30px] h-[30px] xl:w-[63px] xl:h-[63px]">&nbsp;</button></a></li>
					<li><a href="http://blog.naver.com/openapi/share?url==<?php echo $link_share; ?>" target="_blank"><button class="bg-vaiv-naver-blog bg-cover w-[30px] h-[30px] xl:w-[63px] xl:h-[63px]">&nbsp;</button></a></li>
					<li><a id="share-by-copy" data-link="<?php echo $link_share; ?>"><button class="bg-vaiv-link bg-cover w-[30px] h-[30px] xl:w-[63px] xl:h-[63px]">&nbsp;</button></a></li>
				</ul>
			</div>
		</div>







		<div class="mt-[64px] md:mt-[48px] xl:mt-[140px]">
			<!-- Tabs -->
			<ul id="tabs" class="flex">
				<li class="content-tab-item active"><a id="default-tab" href="#author-tab">연구원 소개</a></li>
				<li class="content-tab-item"><a href="#comment-form">최신 콘텐츠</a></li>
			</ul>

			<!-- Tab Contents -->
			<div id="tab-contents" class="bg-blue-f5 border-t-2 border-b-2 border-gray-dd p-24 md:px-20 md:py-[25px] xl:px-[63px] xl:pt-[57px]  xl:pb-[72px]">
				<div id="author-tab">
					<div class="text-13 xl:text-25 text-gray-41"><?php echo $author_info; ?></div>
					<div class="text-13 xl:text-25 text-gray-70 mt-2">
						<?php
						$author_description = get_user_meta($author->ID, 'description', true);
						echo $author_description;
						?>
					</div>

					<div class="flex gap-x-2 mt-3 xl:mt-[26px]">
						<?php
						$tags = get_field('user_tags', 'user_' . $post_author_id);

						if (sizeof($tags) > 0) {
							foreach ($tags as $tag) {
								echo '<span class="px-3 py-1 text-12 xl:text-22 xl:font-medium text-gray-4c rounded-full bg-gray-e7"># ' . $tag['user_tag'] . '</span>';
							}
						}
						?>
					</div>
				</div>
				<div id="comment-form" class="hidden p-4">
					<?php
					$args = array(
						'author'        =>  $author->ID,
						'orderby'       =>  'post_date',
						'order'         =>  'DESC',
						'posts_per_page' => -1 // no limit
					);

					$current_user_posts = get_posts($args);

					if (sizeof($current_user_posts) > 0) {
						echo '<ul class="author-post-list">';
						foreach ($current_user_posts as $post_item) {
							echo '<li class="author-post-list-item"><a href="' . get_permalink($post_item->ID) . '">' . $post_item->post_title . '</a></li>';
						}
						echo '</ul';
					} else {
						echo '이 사용자는 더 이상 게시물이 없습니다';
					}
					?>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->