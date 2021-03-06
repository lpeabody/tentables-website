<?php
/**
 * type.page
 *
 * This allows us to add metaboxes to Pages.
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */
 /************************************************************************************/
// define meta boxes
/************************************************************************************/
$pa_boxes = array (
	/*'Details' => array (
		array( '_icon_bw', 'Image Icon BW (Optional)', 'This is the b/w icon appearing on the dropdown nav. REQUIRED FOR QUALITY & CRAFTSMANSHIP PAGES','file'),
		array( '_icon_color', 'Image Icon Color (Optional)', 'This is the color icon appearing on the dropdown nav. REQUIRED FOR QUALITY & CRAFTSMANSHIP PAGES','file'),		
		array( '_alt_title', 'Alternate Title (Optional)', 'Enter an alternate title (h1) if you\'d like to change the default title'),
		array( '_big_sub_title', 'Big Subtitle (Optional)', 'Enter an this big subtitle (h2) if you\'d like to have a subtitle directly under the big h1')
	),
	'Optional Lower Content Pieces' => array (		
		array( '_img_right_edge', 'Image Right Edge (Optional)', 'Upload an image that hugs the edge of the content','file'),		
		array( '_img_right_edge_alt', 'Image Right Edge (Required if upload image above)', 'If you upload an right edge image, you must enter alternative text for it'),		
		array( '_subheader', 'Subheader (Optional)', 'Enter a subheader if you\'d like'),
	),
	'A Customized Header Image' => array (
		array( '_header_image', 'HeaderImage', 'Upload Header Image (optional - ideal size is at least 1088px wide and at least 510px wide).','file')
	)*/
);

add_action( 'add_meta_boxes', 'pa_add_custom_box' );
add_action( 'save_post', 'pa_save_postdata', 1, 2 );

/************************************************************************************/
// generate meta boxes
/************************************************************************************/
function pa_add_custom_box() {
	global $pa_boxes;
	global $post;
	if ( function_exists( 'add_meta_box' )) {
		ksort($pa_boxes);
		foreach ( $pa_boxes as $i => $pa_box_content ) {
			add_meta_box( strtolower(str_replace(' ', '',$i)), __( $i, 'pa' ), 'pa_post_custom_box', 'page', 'normal', 'high', $pa_box_content[0]);
		}
		/************************************************************************************/
		// display meta boxes conditionally by template
		/************************************************************************************/
		// we have to extract just the template name, since this returns a path to the template
		$current_template = get_post_meta( $_GET['post'], '_wp_page_template', true );
		$current_template = pathinfo($current_template);
		$current_template = $current_template['filename'];
		// remove metaboxes if we're on a certain template
		if ($current_template == 'sample') {
			// note that the metaboxes are ID'd lowercase without spaces
			remove_meta_box('sampleinfo','page','normal');
		}
	}
}

/************************************************************************************/
// save meta boxes
/************************************************************************************/
function pa_post_custom_box ( $obj, $box ) {
	global $pa_boxes;
	static $pa_nonce_flag = false;
	if ( ! $pa_nonce_flag ) {
		echo_pa_nonce();
		$pa_nonce_flag = true;
	}
	foreach ( $pa_boxes[$box['title']] as $pa_box ) {
		if(is_array($pa_box)){
			echo field_html( $pa_box );
		}
	}
}

function pa_save_postdata($post_id, $post) {
	global $pa_boxes;
	if ( ! wp_verify_nonce( $_POST['pa_nonce_name'], plugin_basename(__FILE__) ) ) {
		return $post->ID;
	}
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID ))
			return $post->ID;
	} else {
		if ( ! current_user_can( 'edit_post', $post->ID ))
			return $post->ID;
	}
	foreach ( $pa_boxes as $pa_box ) {
		foreach ( $pa_box as $pa_fields ) {
			$pa_my_data[$pa_fields[0]] =  $_POST[$pa_fields[0]];
		}
	}
	foreach ($pa_my_data as $key => $value) {
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

function echo_pa_nonce () {
	echo sprintf(
		'<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
		'pa_nonce_name',
		wp_create_nonce( plugin_basename(__FILE__) )
	);
}

if ( !function_exists('get_custom_field') ) {
	function get_custom_field($field) {
		global $post;
		$custom_field = get_post_meta($post->ID, $field, true);
		echo $custom_field;
	}
}
?>