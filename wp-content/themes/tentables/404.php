<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */
get_header(); ?>

<div class="first fullscreen-bg">
	<img src="<?php bloginfo('template_directory'); ?>/images/bg.jpg" alt="">
</div>
<div class="welcome initial overflow">
	<h2 class="error">Sorry this page does not exist! Please go back to <a href="/">our homepage</a>, thanks!</h2>
</div>

<?php get_footer(); ?>