<?php
/**
 * type.menus
 *
 * This allows us to add metaboxes to What's Happening post type.
 *
 * @package WordPress
 * @subpackage Asphalt
 * @since Asphalt 1.0
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $me_boxes;
$me_boxes = array (
	'Menu Sections' => array (
		array( '_menu_barbites', 'Bar Bites', 'List out the bar bites','tinymce'),
		array( '_menu_barboards', 'Bar Boards', 'List out the bar boards','tinymce'),
		array( '_menu_appetizer', 'Appetizer', 'List out the bar appetizer','tinymce'),
		array( '_menu_main', 'Main', 'List out the main dishes','tinymce'),
		array( '_menu_tastingmenus', 'Tasting Menus', 'List out the tasting menus','tinymce'),
		array( '_menu_desert', 'Dessert', 'List out the bar dessert','tinymce'),
		array( '_menu_additionalofferings', 'Additional Offerings', 'List out the additional offerings','tinymce'),
		array( '_menu_coffee', 'Coffee', 'List out the coffee','tinymce'),
		array( '_menu_tea', 'Tea', 'List out the tea','tinymce'),
	)
);

/************************************************************************************/
// register menus post type
/************************************************************************************/
 function post_type_menus() {

	$labels = array(
		'name' => 'Menus',
		'singular_name' => 'Menus',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Menus',
		'edit_item' => 'Edit Menus',
		'new_item' => 'New Menus',
		'view_item' => 'View Menus',
		'search_items' => 'Search Menus',
		'not_found' =>  'No Menus found.',
		'not_found_in_trash' => 'No Menus found in trash.',
		'parent_item_colon' => ''
	);

	register_post_type(
		'menu',
		array(
			'labels' => $labels,
			'description' => __('Posts for all Menuss.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_menus',
			'supports' => array (
				'title',
				'page-attributes',
				'editor',
				'thumbnail',
				'revisions'
			)
		)
	);

}
add_action('init', 'post_type_menus');

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_menus' ) ) :
function init_metaboxes_menus($args) {
	global $me_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($me_boxes);
		foreach ( $me_boxes as $i => $me_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'wh' ), 'me_post_custom_box', 'menu', 'normal', 'high', $me_box_content[0]);
		}

	}
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'me_post_custom_box' ) ) :
function me_post_custom_box ($obj, $box) {
	global $me_boxes;
	global $post;
	static $me_nonce_flag = false;
	if ( ! $me_nonce_flag ) {
		me_echo_sp_nonce();
		$me_nonce_flag = true;
	}
	foreach ( $me_boxes[$box['title']] as $me_box ) {
		if(is_array($me_box)){
			echo field_html( $me_box );
		}
	}
}
endif;

if ( ! function_exists( 'me_save_postdata' ) ) :
function me_save_postdata($post_id, $post) {
	global $me_boxes;
	if ( ! wp_verify_nonce( $_POST['me_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $me_boxes as $me_box ) {
			foreach ( $me_box as $me_fields ) {
				$me_my_data[$me_fields[0]] =  $_POST[$me_fields[0]];
			}
		}
		foreach ($me_my_data as $key => $value) {
			if ( 'revision' == $post->post_type  ) {
				return;
			}
			$value = implode(',', (array)$value);
			if ( get_post_meta($post->ID, $key, FALSE) ) {
				update_post_meta($post->ID, $key, $value);
			} else {
				add_post_meta($post->ID, $key, $value);
		}
		if (!$value) {
			delete_post_meta($post->ID, $key);
		}
	}
}
endif;

if ( ! function_exists( 'me_echo_sp_nonce' ) ) :
function me_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'me_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'me_get_custom_field' ) ) :
if ( !function_exists('me_get_custom_field') ) {
	function me_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

add_action( 'save_post', 'me_save_postdata', 1, 2 );
?>