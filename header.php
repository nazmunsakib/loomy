<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$header_layout = get_theme_mod( 'loomy_header_layout', 'header-3' );

// Handle legacy values or invalid layout names.
if ( ! in_array( $header_layout, array( 'header-1', 'header-2', 'header-3' ), true ) ) {
	$header_layout = 'header-3';
}

$header_sticky = get_theme_mod( 'loomy_header_sticky', true );
$header_class  = $header_sticky ? 'sticky top-0 z-50' : 'relative';
?>

<header id="masthead" class="site-header py-4 bg-white border-b border-gray-100 <?php echo esc_attr( $header_class ); ?>" role="banner">
	<div class="container relative">
		<?php get_template_part( 'template-parts/header/' . $header_layout ); ?>
	</div>
</header>

<div id="content" class="site-content">
