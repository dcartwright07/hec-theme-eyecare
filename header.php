<!doctype html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
<head>
    <!-- important for compatibility charset -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- important for responsiveness remove to make your site non responsive. -->
    <meta name="viewport" content="width=device-width, maximum-scale=1.0"  />

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php
		/**
		 * Loads Main Theme Files
		 * In Head section
		 */
		wp_head();
	?>
</head>

<?php
	//Catch Boxed Values
	$catch_boxed_values = wc_boxed_layout_class();

	$boxed_class		= $catch_boxed_values['boxed_class'];
?>

<body <?php body_class(); ?>>

	<h2>This is to test this code.</h2>

	<?php
		/*
		 * Hooks Page Preloader.
		 * Can be used to hook more items after <body tag
		 */
		do_action('wc_after_body_start');
	?>

	<!-- Main Container -->
    <div class="main-container<?php echo esc_attr($boxed_class); ?>">

        <?php
			//Getting Template Part For Top Bar
			get_template_part("template-parts/header/top-bar");
		?>

        <?php
			//Getting Template Part For Header
			get_template_part("template-parts/header/header");
		?>

        <?php
			//Getting Template For Title Section
			get_template_part("template-parts/header/title-section");