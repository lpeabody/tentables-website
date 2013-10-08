<?php
/**
 * type.contact
 *
 * This allows us to add metaboxes to Contact post type.
 *
 * @package WordPress
 * @subpackage Asphalt
 * @since Asphalt 1.0
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $co_boxes;
$co_boxes = array (
	/*'Contact Sections' => array (
		array( '_contact_info', 'Information', 'List out contact information','tinymce'),
	)*/
);

/************************************************************************************/
// register contact post type
/************************************************************************************/
 function post_type_contact() {

	$labels = array(
		'name' => 'Contact',
		'singular_name' => 'Contact',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Contact',
		'edit_item' => 'Edit Contact',
		'new_item' => 'New Contact',
		'view_item' => 'View Contact',
		'search_items' => 'Search Contact',
		'not_found' =>  'No Contact found.',
		'not_found_in_trash' => 'No Contact found in trash.',
		'parent_item_colon' => ''
	);

	register_post_type(
		'contact',
		array(
			'labels' => $labels,
			'description' => __('Posts for all Contact.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_contact',
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
add_action('init', 'post_type_contact');

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_contact' ) ) :
function init_metaboxes_contact($args) {
	global $co_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($co_boxes);
		foreach ( $co_boxes as $i => $co_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'wh' ), 'co_post_custom_box', 'contact', 'normal', 'high', $co_box_content[0]);
		}

	}
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'co_post_custom_box' ) ) :
function co_post_custom_box ($obj, $box) {
	global $co_boxes;
	global $post;
	static $co_nonce_flag = false;
	if ( ! $co_nonce_flag ) {
		co_echo_sp_nonce();
		$co_nonce_flag = true;
	}
	foreach ( $co_boxes[$box['title']] as $co_box ) {
		if(is_array($co_box)){
			echo field_html( $co_box );
		}
	}
}
endif;

if ( ! function_exists( 'co_save_postdata' ) ) :
function co_save_postdata($post_id, $post) {
	global $co_boxes;
	if ( ! wp_verify_nonce( $_POST['co_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $co_boxes as $co_box ) {
			foreach ( $co_box as $co_fields ) {
				$co_my_data[$co_fields[0]] =  $_POST[$co_fields[0]];
			}
		}
		foreach ($co_my_data as $key => $value) {
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

if ( ! function_exists( 'co_echo_sp_nonce' ) ) :
function co_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'co_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'co_get_custom_field' ) ) :
if ( !function_exists('co_get_custom_field') ) {
	function co_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

add_action( 'save_post', 'co_save_postdata', 1, 2 );
?>