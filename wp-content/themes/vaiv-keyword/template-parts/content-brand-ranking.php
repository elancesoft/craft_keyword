<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package VAIV_Keyword
 */


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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="brandranking-detail">
			<div class="row">
				<div class="col-md-4 order-2 order-md-1 text-center text-md-start">
					<h2 class="widget-title">브랜드 랭킹</h2>
					<div class="brandranking-detail-date"><?php echo get_the_date("Y년 m월 d주"); ?></div>

					<div class="brandranking-detail-hastag">
						<?php
						$tags = get_the_tags();
						$tag_top2 = $tag_rest = array();

						if (sizeof($tags) > 2) {
							$tag_top2 = array_slice($tags, 0, 2);
							$tag_rest = array_slice($tags, 2);
						} else {
							$tag_top2 = $tags;
						}

						if (sizeof($tag_top2) > 0) :
							echo '<div class="brandranking-detail-hastag-top12">';
							foreach ($tag_top2 as $item) :
								echo '<span># ' . $item->name . '</span>';
							endforeach;
							echo '</div>';
						endif;

						if (sizeof($tag_rest) > 0) :
							echo '<div class="brandranking-detail-hastag-top345">';
							foreach ($tag_rest as $item) :
								echo '<span># ' . $item->name . '</span>';
							endforeach;
							echo '</div>';
						endif;
						?>
					</div>
					<div class="brandranking-detail-copyright"><?php echo get_the_content(); ?></div>
				</div>

				<div class="col-md-7 offset-md-1 order-1 order-md-2">
					<div class="brandranking-detail-image">
						<img src="<?php echo get_template_directory_uri() . '/assets/images/brand-ranking-detail-bg.png' ?>" class="img-fluid" alt="brank ranking">
						<div class="brandranking-detail-top3">
							<ul class="brandranking-detail-top3-list">
								<?php
								foreach ($top_3_brand_posts as $index => $post) :
									$active = ($index == 0) ? 'active' : '';
									echo '<li class="brandranking-detail-top3-item ' . $active . '"><span>' . ($index + 1) . '. ' . $post->post_title . '</span></li>';
								endforeach;
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>

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
						<div class="brandranking-detail-top3-slider">

							<?php
							if (isset($top_3_brand_posts[1])) :
								$top_2 = $top_3_brand_posts[1];
								$keyword = empty(get_field('brand_keyword', $top_2->ID)) ? '-' : get_field('brand_keyword', $top_2->ID);
								$hotsns = get_field('brand_hot_sns', $top_2->ID);
								$score = empty(get_field('brand_score', $top_2->ID)) ? '-' : get_field('brand_score', $top_2->ID);

								echo '
								<div class="brandranking-detail-top3-slider-item d-none d-md-inline-block">
									<h3 class="brandranking-detail-top3-slider-item-order">2<span>nd</span></h3>
									<div class="brandranking-detail-top3-slider-item-title">' . $top_2->post_title . '</div>
									<div class="brandranking-detail-top3-slider-item-logo">
										<img src="' . get_the_post_thumbnail_url($top_2->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-item-social">
										<i class="' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endif;

							if (isset($top_3_brand_posts[0])) :
								$top_1 = $top_3_brand_posts[0];
								$keyword = empty(get_field('brand_keyword', $top_1->ID)) ? '-' : get_field('brand_keyword', $top_1->ID);
								$hotsns = get_field('brand_hot_sns', $top_1->ID);
								$score = empty(get_field('brand_score', $top_1->ID)) ? '-' : get_field('brand_score', $top_1->ID);

								echo '
								<div class="brandranking-detail-top3-slider-item active">
									<h3 class="brandranking-detail-top3-slider-item-order">1<span>st</span></h3>
									<div class="brandranking-detail-top3-slider-item-title">' . $top_1->post_title . '</div>
									<div class="brandranking-detail-top3-slider-item-logo">
										<img src="' . get_the_post_thumbnail_url($top_1->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-item-social">
										<i class="' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endif;

							if (isset($top_3_brand_posts[2])) :
								$top_3 = $top_3_brand_posts[2];
								$keyword = empty(get_field('brand_keyword', $top_3->ID)) ? '-' : get_field('brand_keyword', $top_3->ID);
								$hotsns = get_field('brand_hot_sns', $top_3->ID);
								$score = empty(get_field('brand_score', $top_3->ID)) ? '-' : get_field('brand_score', $top_3->ID);

								echo '
								<div class="brandranking-detail-top3-slider-item d-none d-md-inline-block">
									<h3 class="brandranking-detail-top3-slider-item-order">3<span>rd</span></h3>
									<div class="brandranking-detail-top3-slider-item-title">' . $top_3->post_title . '</div>
									<div class="brandranking-detail-top3-slider-item-logo">
										<img src="' . get_the_post_thumbnail_url($top_3->ID, 'full') . '" alt="Logo" />
									</div>
									<div class="brandranking-detail-top3-slider-item-keyword">' . $keyword . '</div>
									<div class="brandranking-detail-top3-slider-item-social">
										<i class="' . $hotsns . '"></i> <span class="main-color-blue">' . $score . '</span>
									</div>
								</div>';
							endif;

							?>
						</div>
					</div>
				</div>
			</div>

			<div class="brandranking-detail-top10">
				<div class="row g-0">
					<div class="col-md-3 text-center text-md-start">
						<h2 class="brandranking-detail-top10-subtitle"><span class="main-color-blue">TOP 10</span> 랭킹</h2>
					</div>
					<div class="col-5 col-md-5">
						<a href="#" class="brandranking-detail-download">이미지로 저장 <i class="bi-download"></i></a>
					</div>
					<div class="col-4 col-md-4 mb-3 text-end">
						<span class="brandranking-detail-viewcount"><i class="bi-eye"></i> <?php echo pvc_get_post_views($post_id); ?></span>
						<div class="btn-group dropup">
							<button type="button" class="brandranking-detail-share" data-bs-toggle="dropdown"><i class="bi-share"></i></button>
							<ul class="dropdown-menu dropdown-menu-share">
								<li><a class="dropdown-item" href="https://story.kakao.com/s/share?url=<?php echo $link_share; ?>" target="_blank"><i class="bi-kakao"></i></a></li>
								<li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $link_share; ?>" target="_blank"><i class="bi-facebook"></i></a></li>
								<li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url=<?php echo $link_share; ?>" target="_blank"><i class="bi-twitter"></i></a></li>
								<li><a class="dropdown-item" href="http://blog.naver.com/openapi/share?url==<?php echo $link_share; ?>" target="_blank"><i class="bi-naver-blog"></i></a></li>
								<li><a class="dropdown-item" id="share-by-copy" data-link="<?php echo $link_share; ?>"><i class="bi-link-45deg"></i></a></li>
							</ul>
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

				<div class="table-responsive">
					<table class="table table-brandranking-detail">
						<thead>
							<tr>
								<th scope="col">순위</th>
								<th scope="col">&nbsp;</th>
								<th scope="col" class="text-start">브랜드명</th>
								<th scope="col" style="min-width: 180px;">
									관련이슈 키워드
									<button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="분석 기간 직전 8일에<br>없었던 새롭게 등장한 연관어">
										<i class="bi-question"></i>
									</button>
								</th>
								<th scope="col" style="min-width: 130px;">
									HOT 채널
									<button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="언급량 증가를<br>이끈 소셜 채널">
										<i class="bi-question"></i>
									</button>
								</th>
								<th scope="col" style="min-width: 110px;">
									SCORE
									<button type="button" class="btn btn-tooltip-question" data-bs-toggle="tooltip" data-bs-placement="bottom" title="최근 8일 간의 언급량과 직전 8일 대비<br>언급량 변동성을 합산한 점수">
										<i class="bi-question"></i>
									</button>
								</th>
								<th scope="col"><i class="bi-dash"></i></th>
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
									<td class="align-middle"><?php vaiv_keyword_post_thumbnail($post->ID); ?></td>
									<td class="align-middle table-brandranking-detail-title"><?php echo $post->post_title; ?></td>
									<td class="text-center align-middle table-brandranking-detail-keyword"><?php echo $keyword; ?></td>
									<td class="text-center align-middle table-brandranking-detail-hotsns"><i class="<?php echo $hotsns; ?>"></i></td>
									<td class="main-color-blue text-center align-middle table-brandranking-detail-score"><?php echo $score; ?></td>
									<td class="text-center align-middle table-brandranking-detail-arrow">
										<span class="table-brandranking-detail-collapse" data-bs-toggle="collapse" data-bs-target="#brandranking-detail-item-<?php echo $index; ?>" aria-expanded="false">
											<i class="arrow-direction bi-chevron-down"></i>
										</span>
									</td>
								</tr>
								<tr id="brandranking-detail-item-<?php echo $index; ?>" class="brandranking-detail-item-collapse collapse">
									<td colspan="7" class="text-center py-4 table-brandranking-detail-desc"><?php echo $post->post_content; ?></td>
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
				echo '<a class="brand-previous-link-mobile mt-5 d-inline-block d-md-none" href="' . get_permalink($previous_id) . '"><i class="bi-chevron-left"></i> 이전글</a>';
			}

			if ($exist_next) {
				echo '<a class="brand-next-link-mobile mt-5 d-inline-block d-md-none" href="' . get_permalink($next_id) . '">다음글 <i class="bi-chevron-right"></i></a>';
			}
			?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->