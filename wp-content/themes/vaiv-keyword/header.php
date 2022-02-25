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

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a id="top_button"><span>TOP</span></a>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'vaiv-keyword'); ?></a>

		<div id="overlay">
			<div class="overlay-sub">
				<div class="container px-custom">
					<div class="row">
						<div class="col">
							<div class="search-form-wrap"><?php get_search_form(); ?></div>
							<div class="search-suggestion-wrap">
								<h3>지금 뜨는 콘텐츠</h3>
								<div class="search-suggestion-list owl-carousel owl-theme">
									<a href="https://some.craft.support/brand-1/">
										<div class="search-suggestion-list-item">
											<div class="search-suggestion-list-thumb"><img src="https://some.craft.support/wp-content/uploads/2022/01/trend-3.png" /></div>
											<div class="row g-0">
												<div class="col-lg-6">
													<div class="search-suggestion-list-title">브랜드 랭킹</div>
												</div>
												<div class="col-lg-6">
													<div class="search-suggestion-list-date text-lg-end">2022년 10월 1주</div>
												</div>
											</div>
										</div>
									</a>

									<a href="https://some.craft.support/content-week-item-test/">
										<div class="search-suggestion-list-item">
											<div class="search-suggestion-list-thumb"><img src="https://some.craft.support/wp-content/uploads/2022/01/trend-2.png" /></div>
											<div class="row g-0">
												<div class="col-lg-6">
													<div class="search-suggestion-list-title">주간관측소</div>
												</div>
												<div class="col-lg-6">
													<div class="search-suggestion-list-date text-lg-end">2022년 10월 1주</div>
												</div>
											</div>
										</div>
									</a>

									<a href="https://some.craft.support/content-month-item-test/">
										<div class="search-suggestion-list-item">
											<div class="search-suggestion-list-thumb"><img src="https://some.craft.support/wp-content/uploads/2022/01/post-1.png" /></div>
											<div class="row g-0">
												<div class="col-lg-6">
													<div class="search-suggestion-list-title">월간관측소</div>
												</div>
												<div class="col-lg-6">
													<div class="search-suggestion-list-date text-lg-end">2022년 10월 1주</div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="overlay-menu">&nbsp;</div>

		<header id="masthead" class="site-header">
			<div class="container-header">
				<div class="row">
					<div class="col-6 col-md-2">
						<div class="logo-wrap">
							<div class="site-branding text-center text-md-end">
								<?php the_custom_logo(); ?>
							</div>
						</div>
					</div>
					<div class="col-6 col-md-10 order-md-2 order-3">
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
					<div class="col-3 col-md-3 order-md-3 order-1 d-none">
						<div class="search-wrap d-none d-md-block">
							<button class="search-icon">&nbsp;</button>
							<button class="search-icon-close d-none">&nbsp;</button>
						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->