<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */
?>

	<?php wp_footer(); ?>
	<!--allows converting php wp variables into js-->
	<span class="theme-path" data-id="<?php bloginfo('template_directory'); ?>" style="display:none;"></span>
	<!--scripts!-->
	<script type='text/javascript'>

		var themePath = $('.theme-path').data('id');

		//shims and fallbacks
		Modernizr.load([{
		  test: Modernizr.input.placeholder,
		  nope: themePath+'/scripts/shims/jquery.placeholder.js'
		},{
		  test: Modernizr.generatedcontent,
		  nope: themePath+'/scripts/shims/jquery.ie7.js'
		},{
		  test: Modernizr.mq('only all'),
		  nope: themePath+'/scripts/shims/respond.min.js'
		},{
		  test: Modernizr.textshadow,
		  nope: [ themePath+'/scripts/shims/jquery.textshadow.js', themePath+'/scripts/shims/jquery.ie8.js' ]
		}]);

	</script>
</body>
</html>