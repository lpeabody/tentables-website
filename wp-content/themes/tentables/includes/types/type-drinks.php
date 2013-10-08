<?php
/**
 * type.drinks
 *
 * This allows us to add metaboxes to Drinks post type.
 *
 * @package WordPress
 * @subpackage Asphalt
 * @since Asphalt 1.0
 */

/************************************************************************************/
// define metaboxes
/************************************************************************************/
global $dr_boxes;
$dr_boxes = array (
	'Drinks Sections' => array (
		array( '_drink_flights', 'Flights', 'List out the flights','tinymce'),
		array( '_drink_cocktails', 'Cocktails', 'List out the cocktails','tinymce'),
		array( '_drink_nonalcoholic', 'Non Alcoholic and/or Mocktails', 'List out the non alcoholic drinks and/or mocktails','tinymce'),
		array( '_drink_beers', 'Beers', 'List out the beers','tinymce'),
		array( '_drink_wineontap', 'Wine by the glass and/or carafes', 'List out the wine by the glass and/or carafes','tinymce'),
		array( '_drink_wine', 'Wine', 'List out the bottled wine selection','tinymce'),
	)
);

/************************************************************************************/
// register drinks post type
/************************************************************************************/
 function post_type_drinks() {

	$labels = array(
		'name' => 'Drinks',
		'singular_name' => 'Drink',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Drink',
		'edit_item' => 'Edit Drink',
		'new_item' => 'New Drink',
		'view_item' => 'View Drink',
		'search_items' => 'Search Drink',
		'not_found' =>  'No Drink found.',
		'not_found_in_trash' => 'No Drink found in trash.',
		'parent_item_colon' => ''
	);

	register_post_type(
		'drink',
		array(
			'labels' => $labels,
			'description' => __('Posts for all Drinks.'),
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'has_archive' => true,
			'rewrite' => true,
			'media_type' => 'post',
			'hierarchical' => true,
			'menu_position' => 5,
			'register_meta_box_cb' => 'init_metaboxes_drinks',
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
add_action('init', 'post_type_drinks');

/************************************************************************************/
// generate metaboxes
/************************************************************************************/
if ( ! function_exists( 'init_metaboxes_drinks' ) ) :
function init_metaboxes_drinks($args) {
	global $dr_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' ) ) {
		ksort($dr_boxes);
		foreach ( $dr_boxes as $i => $dr_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'wh' ), 'dr_post_custom_box', 'drink', 'normal', 'high', $dr_box_content[0]);
		}

	}
}
endif;

/************************************************************************************/
// save metaboxes
/************************************************************************************/
if ( ! function_exists( 'dr_post_custom_box' ) ) :
function dr_post_custom_box ($obj, $box) {
	global $dr_boxes;
	global $post;
	static $dr_nonce_flag = false;
	if ( ! $dr_nonce_flag ) {
		dr_echo_sp_nonce();
		$dr_nonce_flag = true;
	}
	foreach ( $dr_boxes[$box['title']] as $dr_box ) {
		if(is_array($dr_box)){
			echo field_html( $dr_box );
		}
	}
}
endif;

if ( ! function_exists( 'dr_save_postdata' ) ) :
function dr_save_postdata($post_id, $post) {
	global $dr_boxes;
	if ( ! wp_verify_nonce( $_POST['dr_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
		} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
		}
		foreach ( $dr_boxes as $dr_box ) {
			foreach ( $dr_box as $dr_fields ) {
				$dr_my_data[$dr_fields[0]] =  $_POST[$dr_fields[0]];
			}
		}
		foreach ($dr_my_data as $key => $value) {
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

if ( ! function_exists( 'dr_echo_sp_nonce' ) ) :
function dr_echo_sp_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'dr_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}
endif;

if ( ! function_exists( 'dr_get_custom_field' ) ) :
if ( !function_exists('dr_get_custom_field') ) {
	function dr_get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
endif;

add_action( 'save_post', 'dr_save_postdata', 1, 2 );
?>