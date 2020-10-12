<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(''); ?><?php if (wp_title('', false)) {
										echo ' :';
									} ?> <?php bloginfo('name'); ?></title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo('description'); ?>">

	<!-- Preload fonts -->
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/swedensansbold-webfont.woff2" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/fonts/swedensans-webfont.woff2" as="font" type="font/woff2" crossorigin="anonymous">

	<?php
	// Prevent FOUC.
	// @https://gist.github.com/johnpolacek/3827270
	?>
	<style type="text/css">
		.no-fouc {
			display: none;
		}
	</style>

	<script>
		document.documentElement.className = 'no-fouc';
	</script>

	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<div class="header-wrapper full-bleed">

		<header class="header clear wrapper">

			<div class="logo">
				<a href="<?php echo home_url(); ?>" class="logo__link">
					<img class="logo__img" src="<?php echo get_template_directory_uri(); ?>/img/sverige-united-logo.svg" alt="Sverige United">
					<span class="logo__text">SVERIGE UNITED</span>
				</a>
			</div>

			<nav class="nav nav-collapse" role=" navigation">
				<?php theme_base_nav(); ?>
			</nav>

			<div class="search-icon search-icon-2">
				<img class="open" alt="Search" src="<?php echo get_template_directory_uri(); ?>/img/search.svg">
			</div>

		</header>

	</div>


	<div class="search-box full-bleed">
		<div class="search-box__content wrapper">

			<svg width="20px" height="19px" xmlns="http://www.w3.org/2000/svg" class="search-i">
				<path d="M8 .5c2.071 0 3.946.84 5.303 2.197A7.477 7.477 0 0115.5 8a7.467 7.467 0 01-1.628 4.666h0l4.603 4.602-.707.707-4.57-4.569A7.474 7.474 0 018 15.5a7.477 7.477 0 01-5.303-2.197A7.477 7.477 0 01.5 8c0-2.071.84-3.946 2.197-5.303A7.477 7.477 0 018 .5zm0 1a6.48 6.48 0 00-4.596 1.904A6.48 6.48 0 001.5 8a6.48 6.48 0 001.904 4.596A6.48 6.48 0 008 14.5a6.48 6.48 0 004.596-1.904A6.48 6.48 0 0014.5 8a6.48 6.48 0 00-1.904-4.596A6.48 6.48 0 008 1.5z" fill="#fff" fill-rule="nonzero" stroke="#fff" />
			</svg>

			<?php get_template_part('template-parts/searchform'); ?>
		</div>
	</div>

	<div class="wrapper main-content">
		<div class="main-content-fade full-bleed"></div>