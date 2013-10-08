<?php
/**
 * type.teams
 *
 * This allows us to add metaboxes to Team post type.
 *
 * @package WordPress
 * @subpackage Asphalt
 * @since Asphalt 1.0
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $te_boxes;
$te_boxes = array (
	/*'Teams Sections' => array (
		array( '_team_members', 'Members', 'List out the members','tinymce'),
	)*/
);

/************************************************************************************/
// register teams post type
/************************************************************************************/
 function post_type_teams() {

	$labels = array(
		'name' => 'Teams',
		'singular_name' => 'Team',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Team Member',
		'edit_item' => 'Edit Team Member',
		'new_item' => 'New Team Member',
		'view_item' => 'View Team Member',
		'search_items' => 'Search Team Members',
		'not_found' =>  'No Team Members found.',
		'not_found_in_trash' => 'No Team Members found in trash.',
		'parent_item_colon' => ''
	);

	register_post_type(
		'team',
		array(
			'labels' => $labels,
			'description' => __('Posts for all Teams.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_teams',
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
add_action('init', 'post_type_teams');

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_teams' ) ) :
function init_metaboxes_teams($args) {
	global $te_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($te_boxes);
		foreach ( $te_boxes as $i => $te_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'wh' ), 'te_post_custom_box', 'team', 'normal', 'high', $te_box_content[0]);
		}

	}
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'te_post_custom_box' ) ) :
function te_post_custom_box ($obj, $box) {
	global $te_boxes;
	global $post;
	static $te_nonce_flag = false;
	if ( ! $te_nonce_flag ) {
		te_echo_sp_nonce();
		$te_nonce_flag = true;
	}
	foreach ( $te_boxes[$box['title']] as $te_box ) {
		if(is_array($te_box)){
			echo field_html( $te_box );
		}
	}
}
endif;

if ( ! function_exists( 'te_save_postdata' ) ) :
function te_save_postdata($post_id, $post) {
	global $te_boxes;
	if ( ! wp_verify_nonce( $_POST['te_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $te_boxes as $te_box ) {
			foreach ( $te_box as $te_fields ) {
				$te_my_data[$te_fields[0]] =  $_POST[$te_fields[0]];
			}
		}
		foreach ($te_my_data as $key => $value) {
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

if ( ! function_exists( 'te_echo_sp_nonce' ) ) :
function te_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'te_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'te_get_custom_field' ) ) :
if ( !function_exists('te_get_custom_field') ) {
	function te_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

add_action( 'save_post', 'te_save_postdata', 1, 2 );
?>