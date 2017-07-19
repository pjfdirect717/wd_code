<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon-->
    <?php
        $favicon = noo_get_image_option('noo_custom_favicon', '');
        if ($favicon != ''): ?>
        <link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>" />
    <?php
    endif; ?>
    <!-- link rel="stylesheet" id="animate-style-css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/animate.css" type="text/css" media="all" -->
    <?php wp_head(); ?>

    <!--[if lt IE 9]>
    <script src="<?php echo NOO_FRAMEWORK_URI . '/vendor/respond.min.js'; ?>"></script>
    <![endif]-->

    <link rel="stylesheet" id="innojobs-style-css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/innojobs31.css?v62" type="text/css" media="all">

    <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/manifest.json">
    <link rel="mask-icon" href="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/safari-pinned-tab.svg" color="#671f5c">
    <link rel="shortcut icon" href="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="PBI Jobs">
    <meta name="application-name" content="PBI Jobs">
    <meta name="msapplication-config" content="/wp-content/themes/noo-jobmonster-child/assets/images/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
</head>

<?php 
	$headerBGOverride = '';
	
	if( isset($_GET['action']) && ( $_GET['action'] === 'register' ) )
	{
		$headerBGOverride = 'pbiq-register';
	}
	else if( isset($_GET['action']) && ( $_GET['action'] === 'login' ) )
	{
		$headerBGOverride = 'pbiq-login';
	}
?>

<body <?php body_class(); ?>>
	<div class="<?php noo_site_class( 'site' ); ?> <?php echo $headerBGOverride;?>" <?php noo_site_schema(); ?> >
	<?php
	$rev_slider_pos = home_slider_position(); ?>
	<?php
		if($rev_slider_pos == 'above') {
			noo_get_layout( 'slider-revolution');
		}
	?>
	<header class="noo-header <?php noo_header_class(); ?>" id="noo-header" <?php noo_header_schema(); ?>>
		<?php
		if(noo_get_option('noo_header_top_bar', 0)){
			noo_get_layout('topbar');
		}
		?>
		<?php noo_get_layout('navbar'); ?>
	</header>

	<?php
		if($rev_slider_pos == 'below') {
			noo_get_layout( 'slider-revolution');
		}
	?>

	<?php noo_get_layout('heading'); ?>
