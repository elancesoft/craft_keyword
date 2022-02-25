<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package VAIV_Keyword
 */

// Connect to external db
require_once(ABSPATH . 'conn_external_db.php');





$top_3_brands = [
	'category_name' => 'brand-ranking',
	'posts_per_page' => 3,
	'orderby'        => array(
		'ID' => 'DESC'
	)
];
$top_3_brand_posts = get_posts($top_3_brands);
$post_id = get_the_ID();

$link_share = get_permalink($post_id);

// Get brand ranking options from ACF
$brandranking_options = get_field('brand_ranking_options', 'options');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container px-custom">
		<div class="brandranking-detail">
			<div class="row">
				<div class="col-xl-4 order-2 order-xl-1 text-center text-xl-start">
					<h2 class="widget-title brandranking-detail-title">브랜드 랭킹</h2>
					<div class="brandranking-detail-date">
						<?php
						$brandrankingdetail_date = elancesoft_get_brandrankingdetail_date($conn);
						echo $brandrankingdetail_date;
						?>
					</div>

					<div class="brandranking-detail-hastag">
						<?php
						$tags = elancesoft_get_brandrankingdetail_top5_tags($conn);

						$tag_top2 = $tag_rest = array();

						if (sizeof($tags) > 2) {
							$tag_top2 = array_slice($tags, 0, 2);
							$tag_rest = array_slice($tags, 2);
						} else {
							$tag_top2 = $tags;
						}

						if (sizeof($tag_top2) > 0) :
							$tag_top2_html = '';
							foreach ($tag_top2 as $item) :
								$tag_top2_html .= '<span># ' . $item . '</span>';
							endforeach;

							echo '<div class="brandranking-detail-hastag-top12">' . $tag_top2_html . '</div>';
						endif;

						if (sizeof($tag_rest) > 0) :
							$tag_rest_html = '';
							foreach ($tag_rest as $index => $item) :
								$tag_rest_html .= '<span># ' . $item . '</span>';
							endforeach;

							echo '<div class="brandranking-detail-hastag-top345">' . $tag_rest_html . '</div>';
						endif;
						?>
					</div>
					<div class="brandranking-detail-copyright"><?php echo get_the_content(); ?></div>
				</div>

				<div class="col-xl-7 offset-xl-1 order-1 order-xl-2">
					<div class="brandranking-detail-image mb-md-50 mb-xl-0">
						<img src="<?php echo get_template_directory_uri() . '/assets/images/brand-ranking-detail-bg.png' ?>" class="img-fluid" alt="brank ranking">
					</div>
				</div>
			</div>

			<!-- TOP 3 SLIDER -->
			<div class="brandranking-detail-top3-slider-wrap">
				<?php
				$cat = get_the_category();
				$current_cat_id = $cat[0]->cat_ID; // current category ID 

				$args = array(
					'category' => $current_cat_id,
					'posts_per_page'   => -1,
					'orderby'        => array(
						'ID' => 'DESC'
					)
				);

				// get all the post in the same category
				$posts = get_posts($args);

				// get IDs of posts retrieved from get_posts
				$ids = array();
				foreach ($posts as $thepost) {
					$ids[] = $thepost->ID;
				}

				// Current position of the postid in the list postid
				$current_position = array_search($post_id, $ids);

				// Default
				$exist_next = $exist_previous = true;
				$next_id = $previous_id = null;
				$next_id_position = $previous_id_position = null;


				// Check for next link & id
				if ($current_position == 0) {
					$exist_next = false;
				} else {
					$next_id_position = $current_position - 1;
					$next_id = $ids[$next_id_position];
				}

				// Check for previous link & id
				if ($current_position == (sizeof($ids) - 1)) {
					$exist_previous = false;
				} else {
					$previous_id_position = $current_position + 1;
					$previous_id = $ids[$previous_id_position];
				}

				if ($exist_previous) {
					echo '<a class="brand-previous-link d-none d-md-inline-block" href="' . get_permalink($previous_id) . '"><i class="bi-chevron-left"></i></a>';
				}

				if ($exist_next) {
					echo '<a class="brand-next-link d-none d-md-inline-block" href="' . get_permalink($next_id) . '"><i class="bi-chevron-right"></i></a>';
				}
				?>


				<div class="row justify-content-center">
					<div class="col col-md-10">
						<!-- Show top 3 in laptop & desktop -->
						<div class="brandranking-detail-top3-slider d-none d-xl-flex">
							<?php
							// Top 2
							$top_no2_name = elancesoft_get_brandrankingdetail_rank_no2_name($conn);
							$top_no2_logo = elancesoft_get_brandrankingdetail_rank_no2_logo($conn);
							$top_no2_keyword = elancesoft_get_brandrankingdetail_rank_no2_keyword($conn);

							// echo $top_no2_logo;

							if (isset($top_3_brand_posts[1])) :
								$top_2 = $top_3_brand_posts[1];
								$keyword = empty(get_field('brand_keyword', $top_2->ID)) ? '-' : get_field('brand_keyword', $top_2->ID);
								$hotsns = get_field('brand_hot_sns', $top_2->ID);
								$score = empty(get_field('brand_score', $top_2->ID)) ? '-' : get_field('brand_score', $top_2->ID);

								echo '
								<div class="brandranking-detail-top3-slider-item">
									<h3 class="brandranking-detail-top3-slider-item-order">2<span>nd</span></h3>
									<div class="brandranking-detail-top3-slider-item-title">' . $top_no2_name . '</div>
									<div class="brandranking-detail-top3-slider-item-logo">
										<img src="' . get_the_post_thumbnail_url($top_2->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-item-social">
										<i class="hotsns-' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endif;

							// Top 1
							$top_no1_name = elancesoft_get_brandrankingdetail_rank_no1_name($conn);
							$top_no1_logo = elancesoft_get_brandrankingdetail_rank_no1_logo($conn);
							$top_no1_keyword = elancesoft_get_brandrankingdetail_rank_no1_keyword($conn);

							// print_r($top_no1_logo);

							// echo $top_no1_name;
							if (isset($top_3_brand_posts[0])) :
								$top_1 = $top_3_brand_posts[0];
								$keyword = empty(get_field('brand_keyword', $top_1->ID)) ? '-' : get_field('brand_keyword', $top_1->ID);
								$hotsns = get_field('brand_hot_sns', $top_1->ID);
								$score = empty(get_field('brand_score', $top_1->ID)) ? '-' : get_field('brand_score', $top_1->ID);

								echo '
								<div class="brandranking-detail-top3-slider-item active">
									<h3 class="brandranking-detail-top3-slider-item-order">1<span>st</span></h3>
									<div class="brandranking-detail-top3-slider-item-title">' . $top_no1_name . '</div>
									<div class="brandranking-detail-top3-slider-item-logo">
										<img src="' . get_the_post_thumbnail_url($top_1->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-item-social">
										<i class="hotsns-' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endif;

							// Top 3
							$top_no3_name = elancesoft_get_brandrankingdetail_rank_no3_name($conn);
							$top_no3_logo = elancesoft_get_brandrankingdetail_rank_no3_logo($conn);
							$top_no3_keyword = elancesoft_get_brandrankingdetail_rank_no3_keyword($conn);

							// print_r($top_no3_name);
							if (isset($top_3_brand_posts[2])) :
								$top_3 = $top_3_brand_posts[2];
								$keyword = empty(get_field('brand_keyword', $top_3->ID)) ? '-' : get_field('brand_keyword', $top_3->ID);
								$hotsns = get_field('brand_hot_sns', $top_3->ID);
								$score = empty(get_field('brand_score', $top_3->ID)) ? '-' : get_field('brand_score', $top_3->ID);

								echo '
								<div class="brandranking-detail-top3-slider-item">
									<h3 class="brandranking-detail-top3-slider-item-order">3<span>rd</span></h3>
									<div class="brandranking-detail-top3-slider-item-title">' . $top_no3_name . '</div>
									<div class="brandranking-detail-top3-slider-item-logo">
										<img src="' . get_the_post_thumbnail_url($top_3->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-item-social">
										<i class="hotsns-' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endif;
							?>
						</div>

						<!-- Show top 3 in mobile & tablet -->
						<div class="brandranking-detail-top3-slider-mobile owl-carousel owl-theme d-block d-xl-none">
							<?php
							foreach ($top_3_brand_posts as $index => $top3_post) :
								$keyword = empty(get_field('brand_keyword', $top3_post->ID)) ? '-' : get_field('brand_keyword', $top3_post->ID);
								$hotsns = get_field('brand_hot_sns', $top3_post->ID);
								$score = empty(get_field('brand_score', $top3_post->ID)) ? '-' : get_field('brand_score', $top3_post->ID);

								echo '
								<div class="brandranking-detail-top3-slider-mobile-item number-' . ($index + 1) . '">
									<h3 class="brandranking-detail-top3-slider-mobile-item-order">' . ($index + 1) . '<span>rd</span></h3>
									<div class="brandranking-detail-top3-slider-mobile-item-title">' . $top3_post->post_title . '</div>
									<div class="brandranking-detail-top3-slider-mobile-item-logo">
										<img src="' . get_the_post_thumbnail_url($top3_post->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-mobile-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-mobile-tem-social">
										<i class="hotsns-' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endforeach;
							?>
						</div>
					</div>
				</div>
			</div>

			<!-- LIST TOP 10 ITEMS -->
			<div class="brandranking-detail-top10">
				<div class="row g-0">
					<?php
					$download_image = $brandranking_options['brandranking_download_image'];
					?>
					<div class="col-xl-6 text-center text-xl-start">
						<div class="d-block d-xl-flex align-items-xl-center">
							<h2 class="brandranking-detail-top10-subtitle"><span class="main-color-blue">TOP 10</span> 랭킹</h2>
							<a href="<?php echo $download_image; ?>" class="brandranking-detail-download d-none d-xl-inline-block" download>이미지로 저장 <i class="bi-download"></i></a>
						</div>
					</div>
					<div class="col-6 d-xl-none text-start">
						<a href="<?php echo $download_image; ?>" class="brandranking-detail-download mobile-version d-inline-block d-xl-none" download>이미지로 저장 <i class="bi-download"></i></a>
					</div>
					<div class="col-6 col-xl-6 text-end">
						<div class="viewcount-share-section">
							<div class="toast-message">URL 링크가 복사되었습니다.</div>
							<span class="brandranking-detail-viewcount"><?php echo pvc_get_post_views($post_id); ?></span>
							<div class="btn-group dropup">
								<button type="button" class="brandranking-detail-share" data-bs-toggle="dropdown">&nbsp;</button>
								<ul class="dropdown-menu content-share-dropdown" data-aos="fade-up" data-aos-anchor-placement="center-center">
									<li><a class="content-share-item" href="https://story.kakao.com/s/share?url=<?php echo $link_share; ?>" target="_blank"><i class="vaiv-kakao"></i></a></li>
									<li><a class="content-share-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link_share; ?>" target="_blank"><i class="vaiv-facebook"></i></a></li>
									<li><a class="content-share-item" href="https://twitter.com/intent/tweet?url=<?php echo $link_share; ?>" target="_blank"><i class="vaiv-twitter"></i></a></li>
									<li><a class="content-share-item" href="http://blog.naver.com/openapi/share?url==<?php echo $link_share; ?>" target="_blank"><i class="vaiv-naver-blog"></i></a></li>
									<li><a class="content-share-item share-by-copy" data-link="<?php echo $link_share; ?>"><i class="vaiv-link"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<?php
				$top10_brand_args = [
					'category_name' => 'brand-ranking',
					'posts_per_page' => 10,
					'orderby'        => array(
						'ID' => 'DESC'
					)
				];
				$top10_brand_posts = get_posts($top10_brand_args);
				?>
				<div class="table-brandranking-detail-wrap">
					<table class="table table-brandranking-detail">
						<thead>
							<tr>
								<th class="align-middle">순위</th>
								<th class="align-middle d-none d-xl-table-cell">&nbsp;</th>
								<th class="align-middle text-start">브랜드명</th>
								<th class="align-middle">
									관련이슈 키워드
									<br>
									<button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="분석 기간 직전 8일에<br>없었던 새롭게 등장한 연관어">
										<i class="bi-question"></i>
									</button>
								</th>
								<th class="align-middle">
									HOT 채널
									<br>
									<button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="언급량 증가를<br>이끈 소셜 채널">
										<i class="bi-question"></i>
									</button>
								</th>
								<th class="align-middle text-tooltip-question-score">
									SCORE
									<br>
									<button type="button" class="btn btn-tooltip-question btn-tooltip-question-score" data-bs-toggle="tooltip" data-bs-placement="bottom" title="최근 8일 간의 언급량과 직전 8일 대비 언급량 변동성을 합산한 점수">
										<i class="bi-question"></i>
									</button>
								</th>
								<th class="align-middle"><i class="bi-dash"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($top10_brand_posts as $index => $post) :
								$keyword = empty(get_field('brand_keyword', $post->ID)) ? '-' : get_field('brand_keyword', $post->ID);
								$hotsns = get_field('brand_hot_sns', $post->ID);
								$score = empty(get_field('brand_score', $post->ID)) ? '-' : get_field('brand_score', $post->ID);
							?>
								<tr>
									<td class="text-center align-middle table-brandranking-detail-no"><?php echo $index + 1; ?></td>
									<td class="align-middle d-none d-xl-table-cell"><?php vaiv_keyword_post_thumbnail($post->ID); ?></td>
									<td class="align-middle table-brandranking-detail-title text-center text-xl-start">
										<div class="d-block d-xl-none"><?php vaiv_keyword_post_thumbnail($post->ID); ?></div>
										<?php echo $post->post_title; ?>
									</td>
									<td class="text-center align-middle table-brandranking-detail-keyword"><?php echo $keyword; ?></td>
									<td class="text-center align-middle table-brandranking-detail-hotsns"><i class="hotsns-<?php echo $hotsns; ?>"></i></td>
									<td class="main-color-blue text-center align-middle table-brandranking-detail-score"><?php echo $score; ?></td>
									<td class="text-center align-middle table-brandranking-detail-arrow">
										<button class="table-brandranking-detail-collapse" data-trindex="<?php echo $index; ?>"><i class="arrow-direction bi-chevron-down"></i></button>
									</td>
								</tr>
								<tr id="tr-brandranking-detail-item-<?php echo $index; ?>" class="tr-brandranking-detail-item-details">
									<td colspan="7" class="">
										<div class="brandranking-detail-item-details"><?php echo $post->post_content; ?></div>
									</td>
								</tr>

							<?php
							endforeach;
							?>
						</tbody>
					</table>
				</div>
			</div>

			<?php
			if ($exist_previous) {
				echo '<a class="brand-previous-link-mobile mt-5 d-inline-block d-xl-none" href="' . get_permalink($previous_id) . '"><i class="bi-chevron-left"></i> 이전글</a>';
			}

			if ($exist_next) {
				echo '<a class="brand-next-link-mobile mt-5 d-inline-block d-xl-none" href="' . get_permalink($next_id) . '">다음글 <i class="bi-chevron-right"></i></a>';
			}
			?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->