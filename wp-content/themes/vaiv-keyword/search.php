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
global $query_string;

$search_term = get_search_query();
$total_result = 0;

// Search in Content Week
$args_week = array(
	'post_type' => 'courses',
	'order' => 'ASC',
	'orderby' => 'title',
	'posts_per_page' => -1,
	'nopaging' => true,
	's' => $search_term
);

$meta_query_array = array();
$args_week = array(
	'category_name' => 'content-week',
	'meta_query' => $meta_query_array,
	'orderby'        => array(
		'ID' => 'DESC'
	),
	'nopaging' => true,
	's' => $search_term
);

$content_week_posts = get_posts($args_week);


$total_result_week = sizeof($content_week_posts);


$total_result = $total_result_week;



// $post_count = $wp_query->found_posts;
?>

<main id="primary" class="site-main">
	<div class="container">
		<?php if (have_posts()) : ?>
			<div class="search_form">
				<div class="row justify-content-center">
					<div class="col">
						<div class="search-form-wrap" id="search_form_container"><?php get_search_form(); ?></div>
					</div>
				</div>
			</div>

			<header class="page-header">
				<h1 class="search-result-query">
					<?php
					/* translators: %s: search query. */
					printf(esc_html__('"%s" 검색결과', 'vaiv-keyword'), '<span>' . get_search_query() . '</span>');
					echo ' <span class="main-color-blue">' . $total_result . '</span>';
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="search-result-list">
				<div class="section-category">
					<h3 class="section-category-title">브랜드 랭킹 <span>2</span></h3>
					<div class="search-result-list-item" data-aos="fade-up-left">
						<div class="row">
							<div class="col-5 col-md-3">
								<a class="post-thumbnail" href="https://some.craft.support/test3/" aria-hidden="true" tabindex="-1">
									<img width="856" height="608" src="https://some.craft.support/wp-content/uploads/2022/01/trend-3.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="일상을 정비하 는 느린 책 읽기" srcset="https://some.craft.support/wp-content/uploads/2022/01/trend-3.png 856w, https://some.craft.support/wp-content/uploads/2022/01/trend-3-300x213.png 300w, https://some.craft.support/wp-content/uploads/2022/01/trend-3-768x545.png 768w" sizes="(max-width: 856px) 100vw, 856px"> </a>
							</div>
							<div class="col-7 col-md-9">
								<div class="search-result-list-item-date">2022년 01월 26주</div>
								<div class="search-result-list-item-excerpt">
									<a href="https://some.craft.support/test3/">설명 설명 설명 패션. 그 이후 리디북스는 꾸준히 상승한 반면, 교보문고는 꾸준히 하락하였다,
										코로나 시국인 2020년 상반기에는 3.76배 이상으로 격차를 벌렸다.</a>
								</div>
								<div class="search-result-list-item-hastags">
									<span># 해시태그</span>
									<span># 해시태그</span>
									<span class="active"># 패션</span>
								</div>
							</div>
						</div>
					</div>
					<div class="search-result-list-item" data-aos="fade-up-left">
						<div class="row">
							<div class="col-5 col-md-3">
								<a class="post-thumbnail" href="https://some.craft.support/content-week-item-test/" aria-hidden="true" tabindex="-1">
									<img width="786" height="562" src="https://some.craft.support/wp-content/uploads/2022/01/post-1.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="썸네일 제목은 최대 두 줄이며 두 줄을 넘어갈 TEST WEEK" loading="lazy" srcset="https://some.craft.support/wp-content/uploads/2022/01/post-1.png 786w, https://some.craft.support/wp-content/uploads/2022/01/post-1-300x215.png 300w, https://some.craft.support/wp-content/uploads/2022/01/post-1-768x549.png 768w" sizes="(max-width: 786px) 100vw, 786px"> </a>
							</div>
							<div class="col-7 col-md-9">
								<div class="search-result-list-item-date">2022년 01월 26주</div>
								<div class="search-result-list-item-excerpt">
									<a href="https://some.craft.support/content-week-item-test/">설명 설명 설명 패션. 그 이후 리디북스는 꾸준히 상승한 반면, 교보문고는 꾸준히 하락하였다,
										코로나 시국인 2020년 상반기에는 3.76배 이상으로 격차를 벌렸다.</a>
								</div>
								<div class="search-result-list-item-hastags">
									<span># 해시태그</span>
									<span># 해시태그</span>
									<span class="active"># 패션</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Content Week -->
				<div class="section-category">
					<h3 class="section-category-title">주간관측소 <span><?php echo $total_result_week; ?></span></h3>

					<?php
					foreach ($content_week_posts as $item) :
						$featured_img_url = get_the_post_thumbnail_url($item->ID, 'full');
						$the_link = get_permalink($item);

						$tags = get_the_tags($item->ID);
						$tags_html = '';
						$tag_size = sizeof($tags);
						foreach ($tags as $tag_index => $tag) {
							$tag_active = ($tag_index == $tag_size-1) ? ' class="active"' : '';
							$tags_html .= '<span' . $tag_active . '># ' . $tag->name . '</span>';
						}

						echo '
						<div class="search-result-list-item" data-aos="fade-up-left">
							<div class="row">
								<div class="col-5 col-md-3">
									<a class="post-thumbnail" href="' . $the_link . '" aria-hidden="true" tabindex="-1">
										<img width="856" height="608" src="' . $featured_img_url . '" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="' . esc_attr($item->post_title) . '" /> </a>
								</div>
								<div class="col-7 col-md-9">
									<div class="search-result-list-item-date">' . get_the_date('Y년 m월 d주', $item) . ' </div>
									<div class="search-result-list-item-excerpt">
										<a href="' . $the_link . '">설명 설명 설명 패션. 그 이후 리디북스는 꾸준히 상승한 반면, 교보문고는 꾸준히 하락하였다,
											코로나 시국인 2020년 상반기에는 3.76배 이상으로 격차를 벌렸다.</a>
									</div>
									<div class="search-result-list-item-hastags">' . $tags_html . '</div>
								</div>
							</div>
						</div>
						';

					endforeach;
					?>


				</div>

				<div class="section-category">
					<h3 class="section-category-title">브랜드 랭킹 <span>2</span></h3>
					<div class="search-result-list-item" data-aos="fade-up-left">
						<div class="row">
							<div class="col-5 col-md-3">
								<a class="post-thumbnail" href="https://some.craft.support/test3/" aria-hidden="true" tabindex="-1">
									<img width="856" height="608" src="https://some.craft.support/wp-content/uploads/2022/01/trend-3.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="일상을 정비하 는 느린 책 읽기" srcset="https://some.craft.support/wp-content/uploads/2022/01/trend-3.png 856w, https://some.craft.support/wp-content/uploads/2022/01/trend-3-300x213.png 300w, https://some.craft.support/wp-content/uploads/2022/01/trend-3-768x545.png 768w" sizes="(max-width: 856px) 100vw, 856px"> </a>
							</div>
							<div class="col-7 col-md-9">
								<div class="search-result-list-item-date">2022년 01월 26주</div>
								<div class="search-result-list-item-excerpt">
									<a href="https://some.craft.support/test3/">설명 설명 설명 패션. 그 이후 리디북스는 꾸준히 상승한 반면, 교보문고는 꾸준히 하락하였다,
										코로나 시국인 2020년 상반기에는 3.76배 이상으로 격차를 벌렸다.</a>
								</div>
								<div class="search-result-list-item-hastags">
									<span># 해시태그</span>
									<span># 해시태그</span>
									<span class="active"># 패션</span>
								</div>
							</div>
						</div>
					</div>
					<div class="search-result-list-item" data-aos="fade-up-left">
						<div class="row">
							<div class="col-5 col-md-3">
								<a class="post-thumbnail" href="https://some.craft.support/content-week-item-test/" aria-hidden="true" tabindex="-1">
									<img width="786" height="562" src="https://some.craft.support/wp-content/uploads/2022/01/post-1.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="썸네일 제목은 최대 두 줄이며 두 줄을 넘어갈 TEST WEEK" loading="lazy" srcset="https://some.craft.support/wp-content/uploads/2022/01/post-1.png 786w, https://some.craft.support/wp-content/uploads/2022/01/post-1-300x215.png 300w, https://some.craft.support/wp-content/uploads/2022/01/post-1-768x549.png 768w" sizes="(max-width: 786px) 100vw, 786px"> </a>
							</div>
							<div class="col-7 col-md-9">
								<div class="search-result-list-item-date">2022년 01월 26주</div>
								<div class="search-result-list-item-excerpt">
									<a href="https://some.craft.support/content-week-item-test/">설명 설명 설명 패션. 그 이후 리디북스는 꾸준히 상승한 반면, 교보문고는 꾸준히 하락하였다,
										코로나 시국인 2020년 상반기에는 3.76배 이상으로 격차를 벌렸다.</a>
								</div>
								<div class="search-result-list-item-hastags">
									<span># 해시태그</span>
									<span># 해시태그</span>
									<span class="active"># 패션</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
		// while (have_posts()) :
		// 	the_post();
		// 	get_template_part('template-parts/content', 'search');
		// endwhile;
		// the_posts_navigation();
		else :
			get_template_part('template-parts/content', 'none');
		endif;
			?>
			</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
