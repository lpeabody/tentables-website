<?php
/**
 * type.specials
 *
 * This allows us to add metaboxes to Specials post type.
 *
 * @package WordPress
 * @subpackage Asphalt
 * @since Asphalt 1.0
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $sp_boxes;
$sp_boxes = array (
	'Specials Sections' => array (
		array( '_special_newsletter', 'Newsletter Description', 'Enter a newsletter description','tinymce'),
	)
);

/************************************************************************************/
// register specials post type
/************************************************************************************/
 function post_type_specials() {

	$labels = array(
		'name' => 'Specials',
		'singular_name' => 'Special',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Special',
		'edit_item' => 'Edit Special',
		'new_item' => 'New Special',
		'view_item' => 'View Special',
		'search_items' => 'Search Special',
		'not_found' =>  'No Special found.',
		'not_found_in_trash' => 'No Special found in trash.',
		'parent_item_colon' => ''
	);

	register_post_type(
		'special',
		array(
			'labels' => $labels,
			'description' => __('Posts for all Specials.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_specials',
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
add_action('init', 'post_type_specials');

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_specials' ) ) :
function init_metaboxes_specials($args) {
	global $sp_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($sp_boxes);
		foreach ( $sp_boxes as $i => $sp_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'wh' ), 'sp_post_custom_box', 'special', 'normal', 'high', $sp_box_content[0]);
		}

	}
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'sp_post_custom_box' ) ) :
function sp_post_custom_box ($obj, $box) {
	global $sp_boxes;
	global $post;
	static $sp_nonce_flag = false;
	if ( ! $sp_nonce_flag ) {
		sp_echo_sp_nonce();
		$sp_nonce_flag = true;
	}
	foreach ( $sp_boxes[$box['title']] as $sp_box ) {
		if(is_array($sp_box)){
			echo field_html( $sp_box );
		}
	}
}
endif;

if ( ! function_exists( 'sp_save_postdata' ) ) :
function sp_save_postdata($post_id, $post) {
	global $sp_boxes;
	if ( ! wp_verify_nonce( $_POST['sp_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $sp_boxes as $sp_box ) {
			foreach ( $sp_box as $sp_fields ) {
				$sp_my_data[$sp_fields[0]] =  $_POST[$sp_fields[0]];
			}
		}
		foreach ($sp_my_data as $key => $value) {
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

if ( ! function_exists( 'sp_echo_sp_nonce' ) ) :
function sp_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'sp_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'sp_get_custom_field' ) ) :
if ( !function_exists('sp_get_custom_field') ) {
	function sp_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

add_action( 'save_post', 'sp_save_postdata', 1, 2 );
?>