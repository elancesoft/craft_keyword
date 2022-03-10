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
	<div class="grid grid-rows-2 md:grid-rows-none md:grid-cols-12">
		<div class="order-2 text-center md:text-left md:order-1 md:col-span-4">
			<h2 class="text-22 md:text-31 xl:text-60 mt-50 md:mt-0 text-black-2e">브랜드 랭킹</h2>
			<div class="text-15 md:text-18 xl:text-43 text-black-2e mt-2 xl:mt-30">
				<?php
				$brandrankingdetail_date = elancesoft_get_brandrankingdetail_date($conn);
				echo $brandrankingdetail_date;
				?>
			</div>

			<!-- HashTags -->
			<div class="">
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
						$tag_top2_html .= '<span class="rounded-full text-13 md:text-11 xl:text-27 text-white bg-blue-0f py-1 xl:py-2 px-3 xl:px-6 font-bold md:font-normal xl:font-medium"># ' . $item . '</span>';
					endforeach;

					echo '<div class="flex justify-center md:justify-start gap-x-2 xl:gap-x-4 mt-6">' . $tag_top2_html . '</div>';
				endif;

				if (sizeof($tag_rest) > 0) :
					$tag_rest_html = '';
					foreach ($tag_rest as $index => $item) :
						$tag_rest_html .= '<span class="rounded-full text-13 md:text-11 xl:text-27 text-gray-4d bg-gray-e8 py-1 xl:py-2 px-3 xl:px-6 font-bold md:font-normal xl:font-medium"># ' . $item . '</span>';
					endforeach;

					echo '<div class="flex justify-center md:justify-start gap-x-2 xl:gap-x-4 mt-3 md:mt-2 xl:mt-4">' . $tag_rest_html . '</div>';
				endif;
				?>
			</div>
			<div class="text-11 md:text-12 xl:text-19 mt-4 md:mt-40 xl:mt-70 text-gray-70"><?php echo get_the_content(); ?></div>
		</div>

		<div class="order-1 md:order-2 md:col-span-6 md:col-end-13 md:flex md:items-end">
			<img src="<?php echo get_template_directory_uri() . '/assets/images/brand-ranking-detail-bg.png' ?>" class="img-fluid" alt="brank ranking">
		</div>
	</div>

	<!-- TOP 3 SLIDER -->
	<div class="brandranking-detail-top3-slider-wrap hidden">
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

						$the_order = '';
						if ($index + 1 == 1) {
							$the_order = '1<span>st</span>';
						} else if ($index + 1 == 2) {
							$the_order = '2<span>nd</span>';
						} else {
							$the_order = '3<span>rd</span>';
						}

						echo '
								<div class="brandranking-detail-top3-slider-mobile-item number-' . ($index + 1) . '">
									<h3 class="brandranking-detail-top3-slider-mobile-item-order">' . $the_order . '</h3>
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
	<div class="mt-[64px] md:mt-[80px]">
		<div class="md:gap-x-[10px] xl:gap-x-[23px] md:flex md:items-center">
			<div class="text-center md:text-left">
				<h2 class="text-22 md:text-25 xl:text-[47px] text-gray-41"><span class="text-blue">TOP 10</span> <span class="text-20 md:text-22 xl:text-43">랭킹</span></h2>
			</div>

			<div class="flex mt-20 md:mt-0 grow items-center justify-between">
				<!-- download button	 -->
				<div class="flex items-center">
					<?php
					$download_image = $brandranking_options['brandranking_download_image'];
					echo '<a href="' . $download_image . '" class="rounded-full bg-blue px-4 py-1 text-13 md:text-11 xl:text-20 text-white" download>이미지로 저장 <i class="bi-download"></i></a>';
					?>
				</div>

				<div class="flex gap-x-3 xl:gap-x-5 items-center">
					<!-- View Count	 -->
					<div class="rounded-full flex justify-center bg-gray-eb text-13 md:text-11 xl:text-21 py-1 px-3 text-gray-4c"><span class="text-right bg-eye-mobile xl:bg-eye bg-no-repeat bg-left min-w-[60px] xl:min-w-[90px]"><?php echo pvc_get_post_views($post_id); ?></span></div>

					<!-- Share Items -->
					<div class="relative">
						<div class="hidden absolute toast-message right-0 top-[-30px] xl:top-[-50px]">URL 링크가 복사되었습니다.</div>
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
		<table class="table-fixed w-full">
			<thead>
				<tr class="bg-blue-ed">
					<th class="text-11 md:text-14 xl:text-27 text-gray-4c font-normal text-center md:text-left md:pl-4 md:py-4">순위</th>
					<th class="text-11 md:text-14 xl:text-27 text-gray-4c font-normal">브랜드명</th>
					<th class="text-11 md:text-14 xl:text-27 text-gray-4c font-normal py-2 md:whitespace-nowrap">
						<div class="md:flex md:flex-row md:gap-x-2 items-center justify-center">
							<div>관련이슈<br class="md:hidden"> 키워드</div>
							<div class="flex justify-center">
								<button type="button" class="flex items-center justify-center rounded-full bg-blue-0f w-[18px] h-[18px] xl:w-[30px] xl:h-[30px] text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="분석 기간 직전 8일에<br>없었던 새롭게 등장한 연관어">
									<i class="flex text-14 xl:text-27 bi-question"></i>
								</button>
							</div>
						</div>
					</th>
					<th class="text-11 md:text-14 xl:text-27 text-gray-4c font-normal md:whitespace-nowrap">
						<div class="md:flex md:gap-x-2 md:items-center md:justify-center">
							<div>HOT<br class="md:hidden"> 채널</div>
							<div class="flex justify-center">
								<button type="button" class="inline-flex items-center justify-center rounded-full bg-blue-0f w-[18px] h-[18px] xl:w-[30px] xl:h-[30px] text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="언급량 증가를<br>이끈 소셜 채널">
									<i class="flex text-14 xl:text-27 bi-question"></i>
								</button>
							</div>
						</div>
					</th>
					<th class="text-11 md:text-14 xl:text-27 text-gray-4c font-normal md:whitespace-nowrap">
						<div class="md:flex md:gap-x-2 md:items-center md:justify-center">
							<div>SCORE</div>
							<div class="flex mt-2 justify-center">
								<button type="button" class="inline-flex items-center justify-center rounded-full bg-blue-0f w-[18px] h-[18px] xl:w-[30px] xl:h-[30px] text-white" data-bs-toggle="tooltip" data-bs-placement="bottom" title="최근 8일 간의 언급량과 직전 8일 대비 언급량 변동성을 합산한 점수">
									<i class="flex text-14 xl:text-27 bi-question"></i>
								</button>
							</div>
						</div>
					</th>
					<th class="text-11 md:text-14 xl:text-27 text-gray-4c align-middle w-[50px] xl:w-[100px]"><i class="bi-dash"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($top10_brand_posts as $index => $post) :
					$keyword = empty(get_field('brand_keyword', $post->ID)) ? '-' : get_field('brand_keyword', $post->ID);
					$hotsns = get_field('brand_hot_sns', $post->ID);
					$score = empty(get_field('brand_score', $post->ID)) ? '-' : get_field('brand_score', $post->ID);

					$logo = 'https://some.craft.support/wp-content/uploads/2022/01/brand-10.png';
				?>
					<tr>
						<td class="">
							<div class="text-center md:flex md:items-center md:ml-4">
								<span class="text-13 md:text-16 xl:text-30 text-gray-41 md:text-gray-70 font-roboto"><?php echo $index + 1; ?></span>
								<div class="hidden md:block"><img src="<?php echo $logo; ?>" class="w-[80px] h-auto" /></div>
							</div>
						</td>
						<td class="align-middle">
							<div class="md:hidden"><img src="<?php echo $logo; ?>" class="w-[80px] h-auto" /></div>
							<?php echo $post->post_title; ?>
						</td>
						<td class="align-middle"><?php echo $keyword; ?></td>
						<td class="align-middle"><i class="hotsns-<?php echo $hotsns; ?>"></i></td>
						<td class="align-middle"><?php echo $score; ?></td>
						<td class="align-middle">
							<button class="table-brandranking-detail-collapse" data-trindex="<?php echo $index; ?>"><i class="arrow-direction bi-chevron-down"></i></button>
						</td>
					</tr>
					<tr id="tr-brandranking-detail-item-<?php echo $index; ?>" class="tr-brandranking-detail-item-details">
						<td colspan="6">
							<div class="brandranking-detail-item-details"><?php echo $post->post_content; ?></div>
						</td>
					</tr>

				<?php
				endforeach;
				?>
			</tbody>
		</table>
	</div>

	<?php
	if ($exist_previous) {
		echo '<a class="brand-previous-link-mobile mt-5 d-inline-block d-xl-none" href="' . get_permalink($previous_id) . '"><i class="bi-chevron-left"></i> 이전글</a>';
	}

	if ($exist_next) {
		echo '<a class="brand-next-link-mobile mt-5 d-inline-block d-xl-none" href="' . get_permalink($next_id) . '">다음글 <i class="bi-chevron-right"></i></a>';
	}
	?>
</article><!-- #post-<?php the_ID(); ?> -->