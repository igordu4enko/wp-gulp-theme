<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage webshowcase
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="page-404">
    <div class="inner-404">
        <h1>Error 404</h1>
        <h2>Page not found</h2>
        <a class="btn-main" href="<?php echo get_home_url(); ?>">Go back</a>
    </div>
</div>

<?php get_footer(); ?>
