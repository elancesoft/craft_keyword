<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VAIV_Keyword
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&family=Open+Sans:wght@400;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>
<?php
// Connect to external db
// require_once(ABSPATH . 'conn_external_db.php');
?>

<body <?php body_class('w-full font-noto font-normal text-12 text-gray-70'); ?>>
	<?php wp_body_open(); ?>
	<a id="top_button" class="hidden"><span>TOP</span></a>

	<div id="page" class="overflow-hidden">
		<div id="overlay" class="hidden">
			<div class="overlay-sub">
				<div class="container px-custom">
					<div class="row">
						<div class="col">
							<div class="search-form-wrap"><?php get_search_form(); ?></div>

							<?php
							// Get 3 most viewing count from brand, week content, month content
							$latest_post_from_each_category = [];
							$categories = [
								[
									'key' => 'content-week'
								],
								[
									'key' => 'content-month'
								]
							];

							// Cicle trough categories to get each cat's latest post ID
							foreach ($categories as $cat) {
								$today_pick_args = [
									'category_name' => $cat['key'],
									'posts_per_page' => 1,
									'orderby'        => array(
										'post_views' => 'DESC'
									)
								];
								$the_post = PVC_GET_MOST_VIEWED_POSTS($today_pick_args);
								$latest_post_from_each_category = array_merge($latest_post_from_each_category, $the_post);
							};
							?>

							<!-- SEARCH SUGGESTION LIST -->
							<div class="search-suggestion-wrap">
								<h3>?????? ?????? ?????????</h3>
								<div class="search-suggestion-list owl-carousel owl-theme">
									<!-- This is the brand ranking item -->
									<div class="search-suggestion-list-item">
										<div class="search-suggestion-list-thumb"><img src="http://some.craft.support/wp-content/uploads/2022/02/today-pick-2.png" /></div>
										<div class="row g-0">
											<div class="col-xl-6">
												<div class="search-suggestion-list-title">????????? ??????</div>
											</div>
											<div class="col-xl-6">
												<div class="search-suggestion-list-date text-xl-end">2022??? 10??? 1???</div>
											</div>
										</div>
									</div>

									<!-- Show suggestion for content week and month -->
									<?php
									foreach ($latest_post_from_each_category as $post_item) :
										$the_img_src = get_field('image_for_main', $post_item->ID);

										$cat_slug = get_the_category($post_item->ID)[0]->slug;
										$cat_title = get_the_category($post_item->ID)[0]->name;

										$the_date = get_the_date("Y??? n??? j???", $post_item);

										if ($cat_slug == 'content-month') {
											$the_date = get_the_date("Y??? n??? ???", $post_item);
										}

										$the_link = get_permalink($post_item->ID);

										echo '
										<a href="' . $the_link . '">
											<div class="search-suggestion-list-item">
												<div class="search-suggestion-list-thumb"><img src="' . $the_img_src . '" /></div>
												<div class="row g-0">
													<div class="col-xl-6">
														<div class="search-suggestion-list-title">' . $cat_title . '</div>
													</div>
													<div class="col-xl-6">
														<div class="search-suggestion-list-date text-xl-end">' . $the_date . '</div>
													</div>
												</div>
											</div>
										</a>';
									endforeach;
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="overlay-menu">&nbsp;</div>

		<header id="masthead" class="site-header">
			<div class="container mx-auto pt-[32px] pb-60 md:max-w-[845px] md:pt-[47px] md:pb-[85px] xl:max-w-[1280px] xl:pt-[74px] xl:pb-[118px] 2xl:max-w-[1800px]">
				<div class="grid grid-cols-12">

					<!-- Logo Section	 -->
					<div class="col-span-2">
						<div class="">
							<?php the_custom_logo(); ?>
						</div>
					</div>

					<!-- Menu Section -->
					<div class="col-span-9">
						<nav id="site-navigation" class="main-navigation">
							<button class="menu-toggle md:hidden" aria-controls="primary-menu" aria-expanded="false"><i class="bi-list"></i></button>
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								)
							);
							?>
						</nav><!-- #site-navigation -->
					</div>

					<!-- Search Icon Section -->
					<div class="flex items-center">
						<button class="bg-search-icon bg-cover bg-no-repeat md:w-[18px] md:h-[16.7px] 2xl:w-[58px] 2xl:h-[54px]">&nbsp;</button>
					</div>
				</div>

				<div class="row hidden">
					<div class="col-6 col-sm-3 col-xl-2">
						<div class="logo-wrap">
							<div class="site-branding text-center text-xl-end">
								<?php the_custom_logo(); ?>
							</div>
						</div>
					</div>
					<div class="col-6 col-sm-9 col-xl-10 order-xl-2 order-3">
						<div class="menu-search-wrap d-flex">
							<div class="menu-wrap flex-grow-1">
								<nav id="site-navigation" class="main-navigation">
									<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="bi-list"></i></button>
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'menu-1',
											'menu_id'        => 'primary-menu',
										)
									);
									?>
								</nav><!-- #site-navigation -->
							</div>
							<div class="search-wrap">
								<button class="search-icon">&nbsp;</button>
								<button class="search-icon-close d-none">&nbsp;</button>
							</div>
						</div>
					</div>
					<div class="col-3 col-xl-3 order-xl-3 order-1 d-none">
						<div class="search-wrap d-none d-xl-block">
							<button class="search-icon">&nbsp;</button>
							<button class="search-icon-close d-none">&nbsp;</button>
						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->