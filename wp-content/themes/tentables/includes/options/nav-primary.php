<?php
/**
 * options.navPrimary
 *
 * This is the settings page for the Theme as a whole.
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */

add_action('admin_menu', 'tentables_options_navprimary');

function tentables_options_navprimary() {
	$icon_path = get_bloginfo('template_url').'/images/icon-plugin.png';
	add_menu_page('Primary Nav Options', 'Primary Navigation', 'delete_others_pages', __FILE__, 'tentables_options_navprimary_settings_page',$icon_path, 145);
	add_action( 'admin_init', 'tentables_options_navprimary_settings' );
}

function tentables_options_navprimary_settings() {
	register_setting( 'tentables_options_navprimary_settings-group', 'tentables_navprimary_first_item' );
	register_setting( 'tentables_options_navprimary_settings-group', 'tentables_navprimary_second_item' );
	register_setting( 'tentables_options_navprimary_settings-group', 'tentables_navprimary_third_item' );
	register_setting( 'tentables_options_navprimary_settings-group', 'tentables_navprimary_fourth_item' );
}

function tentables_options_navprimary_settings_page() { ?>

<div class="wrap theme-options">

<div class="icon32" id="icon-options-general"><br /></div>

<h2>Primary Navigation Items</h2>

<form method="post" class="theme-options-form" action="options.php">
	
	<?php settings_fields( 'tentables_options_navprimary_settings-group'); ?>

	<div class="postbox metabox-holder">
		<h3 class="hndle">Primary Left</h3>
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_navprimary_first_item">Choose First Item</label></p>
				<p>

					<select id="tentables_navprimary_first_item" name="tentables_navprimary_first_item">
						<option>-- Select a Page --</option>
						<?php 
							$tentables_navprimary_first_item = get_option('tentables_navprimary_first_item'); 
							$pages = get_pages(); 
							foreach ( $pages as $page ) {
						?>
						<option<?php if ($page->ID == $tentables_navprimary_first_item) { echo ' selected="selected"'; } ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
						<?php 
							}
						?>
					</select>
				</p>
			</div>
			<div class="option-panel">
				<p><label for="tentables_navprimary_second_item">Choose Second Item</label></p>
				<p>

					<select id="tentables_navprimary_second_item" name="tentables_navprimary_second_item">
						<option>-- Select a Page --</option>
						<?php 
							$tentables_navprimary_second_item = get_option('tentables_navprimary_second_item');
							$pages = get_pages(); 
							foreach ( $pages as $page ) {
						?>
						<option<?php if ($page->ID == $tentables_navprimary_second_item) { echo ' selected="selected"'; } ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
						<?php 
							}
						?>
					</select>
				</p>
			</div>
		</div>
	</div>
	<div class="postbox metabox-holder">
		<h3 class="hndle">Primary Right</h3>
		
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_navprimary_third_item">Third Item</label></p>
				<p style="font-size: .8em;">Since 'Cheese Recipes' is highly customized, its URL is hard coded. Unfortunately only a Wordpress developer would be able to change its appearance.

				<?php /*
				<p>

					<select id="tentables_navprimary_third_item" name="tentables_navprimary_third_item">
						<option>-- Select a Page --</option>
						<?php 
							$tentables_navprimary_third_item = get_option('tentables_navprimary_third_item'); 
							$pages = get_pages(); 
							foreach ( $pages as $page ) {
						?>
						<option<?php if ($page->ID == $tentables_navprimary_third_item) { echo ' selected="selected"'; } ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
						<?php 
							}
						?>
					</select>
				</p>
			 	*/?>
			</div>
			<div class="option-panel">
				<p><label for="tentables_navprimary_fourth_item">Fourth Item</label></p>
				<p style="font-size: .8em;">Since 'Cheese Recipes' is highly customized, its URL is hard coded. Unfortunately only a Wordpress developer would be able to change its appearance.
				<?php /*<p>

					<select id="tentables_navprimary_fourth_item" name="tentables_navprimary_fourth_item">
						<option>-- Select a Page --</option>
						<?php 
							$tentables_navprimary_fourth_item = get_option('tentables_navprimary_fourth_item');
							$pages = get_pages(); 
							foreach ( $pages as $page ) {
						?>
						<option<?php if ($page->ID == $tentables_navprimary_fourth_item) { echo ' selected="selected"'; } ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
						<?php 
							}
						?>
					</select>
				</p>*/ ?>
			</div>
		</div>
	</div>

	<input type="hidden" value="1" />
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
</form>

</div>

<?php } ?>