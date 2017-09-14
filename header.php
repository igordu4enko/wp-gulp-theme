<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package webshowcase
 */
global $webshowcase;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo get_bloginfo( 'name' ); ?> | Web Developer</title>
    <meta name="description" content="<?php get_bloginfo( 'description' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php if ( ! empty( $webshowcase['blog_favicon'] ) ) {
		echo $webshowcase['blog_favicon']['url'];
	} ?>" type="image/x-icon">

	<?php wp_head(); ?>

</head>

<body <?php body_class( $class ); ?>>

<div class="loader" style="background: <?php if ( ! empty( $webshowcase['blog_preloader_bg'] ) ) {
	echo $webshowcase['blog_preloader_bg'];
} ?>">
    <img class="loader_inner" src="<?php if ( ! empty( $webshowcase['blog_preloader'] ) ) {
		echo $webshowcase['blog_preloader']['url'];
	} ?>" alt="Animation">
</div>

<div class="logo-container">
    <a href="<?php echo get_home_url(); ?>">
        <img src="<?php if ( ! empty( $webshowcase['header_logo'] ) ) {
			echo $webshowcase['header_logo']['url'];
		} ?>" alt="<?php echo get_bloginfo( 'name' ); ?>">
    </a>
</div>

<button class="nav-toggle btn-main">
        <span class="sandwich">
            <span class="sw-topper"></span>
            <span class="sw-bottom"></span>
            <span class="sw-footer"></span>
         </span>
</button>

<a title="Go to Home page" href="<?php echo get_home_url(); ?>" class="home-link tooltips">
    <i class="fa fa-home"></i>
</a>

<nav class="top-menu">

	<?php wp_nav_menu( array(
		'theme_location' => '',
		'menu'           => 'Main Menu',
		'container'      => false,
		'menu_class'     => '',
		'echo'           => true,
	) ); ?>

    <div class="nav-socials">
		<?php $social_links = $webshowcase['blog_social_links'];
		if ( ! empty( $social_links ) ) { ?>
			<?php foreach ( $social_links as $key => $value ) { ?>

                <div class="soc-icon">
                    <a href=" <?php if ( ! empty( $value['social_link'] ) ) {
						echo $value['social_link'];
					} ?>" class="tooltips" target="_blank"
                       title=" <?php if ( ! empty( $value['social_name'] ) ) {
						   echo $value['social_name'];
					   } ?>"><i
                                class="fa <?php if ( ! empty( $value['social_icon'] ) ) {
									echo $value['social_icon'];
								} ?>"></i></a>
                </div>

			<?php } ?>
		<?php } ?>
    </div>

</nav>

