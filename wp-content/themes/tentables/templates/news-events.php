<?php
/**
 * The template for displaying the 'News Events' layout.
 *
 * Template Name: News Events
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */

get_header(); ?>

<div class="chalkboard middle">
	<div class="chalkboard-content">
		<div class="page-width">
			<h2>Ten Tables Updates</h2>
		</div>
	</div>
</div>
<div class="content page-width">
	<?php $my_query = new WP_Query( array( 'post_type' => 'post')); ?>
	<?php if ( have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<article>
			<hgroup>
				<h1><?php the_title(); ?></h1>
				<h4><?php the_date(); ?></h4>
			</hgroup>
			<?php the_content(); ?>
		</article>
		<hr />	

	<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
	<?php endif; ?>
</div>	
<?php // include(get_template_directory() . '/includes/content/under.php'); ?>

<?php get_footer(); ?>