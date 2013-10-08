<?php
/**
 * type.parkingdirections
 *
 * This allows us to add metaboxes to Parking and Directions post type.
 *
 * @package WordPress
 * @subpackage Asphalt
 * @since Asphalt 1.0
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $pd_boxes;
$pd_boxes = array (
	/*'Parking and Directions Sections' => array (
		array( '_parkingdirections_info', 'Information', 'List out the information','tinymce'),
	)*/
);

/************************************************************************************/
// register parkingdirections post type
/************************************************************************************/
 function post_type_parkingdirections() {

	$labels = array(
		'name' => 'Parking and Directions',
		'singular_name' => 'Parking and Direction',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Parking and Direction ',
		'edit_item' => 'Edit Parking and Direction ',
		'new_item' => 'New Parking and Direction ',
		'view_item' => 'View Parking and Direction ',
		'search_items' => 'Search Parking and Direction',
		'not_found' =>  'No Parking and Direction found.',
		'not_found_in_trash' => 'No Parking and Direction found in trash.',
		'parent_item_colon' => ''
	);

	register_post_type(
		'parkingdirections',
		array(
			'labels' => $labels,
			'description' => __('Posts for all Parking and Directions.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_parkingdirections',
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
add_action('init', 'post_type_parkingdirections');

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_parkingdirections' ) ) :
function init_metaboxes_parkingdirections($args) {
	global $pd_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($pd_boxes);
		foreach ( $pd_boxes as $i => $pd_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'wh' ), 'pd_post_custom_box', 'parkingdirections', 'normal', 'high', $pd_box_content[0]);
		}

	}
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'pd_post_custom_box' ) ) :
function pd_post_custom_box ($obj, $box) {
	global $pd_boxes;
	global $post;
	static $pd_nonce_flag = false;
	if ( ! $pd_nonce_flag ) {
		pd_echo_sp_nonce();
		$pd_nonce_flag = true;
	}
	foreach ( $pd_boxes[$box['title']] as $pd_box ) {
		if(is_array($pd_box)){
			echo field_html( $pd_box );
		}
	}
}
endif;

if ( ! function_exists( 'pd_save_postdata' ) ) :
function pd_save_postdata($post_id, $post) {
	global $pd_boxes;
	if ( ! wp_verify_nonce( $_POST['pd_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $pd_boxes as $pd_box ) {
			foreach ( $pd_box as $pd_fields ) {
				$pd_my_data[$pd_fields[0]] =  $_POST[$pd_fields[0]];
			}
		}
		foreach ($pd_my_data as $key => $value) {
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

if ( ! function_exists( 'pd_echo_sp_nonce' ) ) :
function pd_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'pd_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'pd_get_custom_field' ) ) :
if ( !function_exists('pd_get_custom_field') ) {
	function pd_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

add_action( 'save_post', 'pd_save_postdata', 1, 2 );
?>