<?php
/**
 * options.global
 *
 * This is the settings page for the Theme as a whole.
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */

add_action('admin_menu', 'tentables_options');

function tentables_options() {
	$icon_path = get_bloginfo('template_url').'/images/icon-plugin.png';
	add_menu_page('Options', 'Global Options', 'delete_others_pages', __FILE__, 'tentables_options_settings_page',$icon_path, 195);
	add_action( 'admin_init', 'tentables_options_settings' );
}

function tentables_options_settings() {
	register_setting( 'tentables_options_settings-group', 'tentables_wallpaper' );
	register_setting( 'tentables_options_settings-group', 'tentables_supernav_image' );
	register_setting( 'tentables_options_settings-group', 'tentables_supernav_text' );
	register_setting( 'tentables_options_settings-group', 'tentables_supernav_link_text' );
	register_setting( 'tentables_options_settings-group', 'tentables_supernav_link_url' );
}

function tentables_options_settings_page() { ?>

<div class="wrap theme-options">

<div class="icon32" id="icon-options-general"><br /></div>

<h2>Global Theme Options</h2>

<form method="post" class="theme-options-form" action="options.php">

	<?php settings_fields( 'tentables_options_settings-group'); ?>

	<div class="postbox metabox-holder">
		<h3 class="hndle">Wallpaper Pattern BG</h3>
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_wallpaper">Upload special wallpaper image (be sure it's repeatable)</label></p>
				<p>
					<?php $tentables_wallpaper = get_option('tentables_wallpaper'); ?>
					<input class="custom-media" id="tentables_wallpaper" name="tentables_wallpaper" value="<?php echo $tentables_wallpaper; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
		</div>
	</div>
	<div class="postbox metabox-holder">
		<h3 class="hndle">Our Cheeses Dropdown Nav Content</h3>
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_supernav_image">Upload image - hugs right / bottom edge of box</label></p>
				<p>
					<?php $tentables_supernav_image = get_option('tentables_supernav_image'); ?>
					<input class="custom-media" id="tentables_supernav_image" name="tentables_supernav_image" value="<?php echo $tentables_supernav_image; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
		</div>
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_supernav_text">Enter text - hugs left of box (REQUIRED)</label></p>
				<p>
					<?php $tentables_supernav_text = get_option('tentables_supernav_text'); ?>
					<input id="tentables_supernav_text" name="tentables_supernav_text" value="<?php echo $tentables_supernav_text; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
		</div>
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_supernav_link_text">Enter link text - is centered</label></p>
				<p>
					<?php $tentables_supernav_link_text = get_option('tentables_supernav_link_text'); ?>
					<input id="tentables_supernav_link_text" name="tentables_supernav_link_text" value="<?php echo $tentables_supernav_link_text; ?>" style="width: 90%;" type="text" />
				</p>
			</div>
		</div>
		<div class="inside">
			<div class="option-panel">
				<p><label for="tentables_supernav_link_url">Enter link url</label></p>
				<p>
					<?php $tentables_supernav_link_url = get_option('tentables_supernav_link_url'); ?>
					<input id="tentables_supernav_link_url" name="tentables_supernav_link_url" value="<?php echo $tentables_supernav_link_url; ?>" style="width: 90%;" type="text" />
				</p>
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