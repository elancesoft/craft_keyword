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
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&family=Open+Sans:wght@700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'vaiv-keyword'); ?></a>

		<div id="overlay">
			<div class="cv-spinner">
				<span id="search-close"><i class="bi-x-lg"></i></span>
				<?php get_search_form(); ?>
			</div>
		</div>

		<div id="overlay-menu">&nbsp;</div>

		<header id="masthead" class="site-header">
			<div class="container-header">
				<div class="row">
					<div class="col-12 d-none d-md-block">
						<div class="logo-vaiv-header text-end">
							<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/images/logo-vaiv-black.png'; ?>" alt="logo" /></a>
						</div>
					</div>
					<div class="col-6 col-md-2 order-md-2 order-2">
						<div class="logo-wrap">
							<div class="site-branding text-center text-md-start">
								<?php the_custom_logo(); ?>
							</div>
						</div>
					</div>
					<div class="col-3 col-md-7 order-md-2 order-3">
						<div class="menu-search-wrap">
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
							<div class="search-wrap d-block d-sm-none">
								<button class="search-icon-wrap">&nbsp;</button>
							</div>
						</div>
					</div>
					<div class="col-3 col-md-3 order-md-3 order-1">
						<div class="logo-vaiv-header d-block-inline d-md-none">
							<a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo get_template_directory_uri() . '/assets/images/logo-vaiv-black.png'; ?>" alt="logo" /></a>
						</div>
						<div class="search-wrap d-none d-md-block">
							<button class="search-icon-wrap">&nbsp;</button>
						</div>
					</div>
				</div>
			</div>
		</header><!-- #masthead -->