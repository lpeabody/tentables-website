<?php
/**
 * meta
 *
 * This meta file contains a variety of different inputs for custom post type GUI.
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */

/************************************************************************************/
// select a field type for output
/************************************************************************************/
function field_html ( $args ) {
	switch ( $args[3] ) {
		case 'text':
			return meta_text( $args );
		case 'textarea':
			return meta_textarea( $args );
		case 'tinymce':
			return meta_tinymce( $args );
		case 'media':
			return meta_media( $args );
		case 'file':
			return meta_file( $args );
		case 'checkbox':
			return meta_checkbox( $args );
		case 'select_gallery':
			return meta_select_gallery( $args );
		case 'cheese_checkboxes':
			return meta_select_cheeses( $args );
		default:
			return meta_text( $args );
	}
}

/************************************************************************************/
// checkboxes
/************************************************************************************/
function meta_checkbox ( $args ) {
	global $post;
	$description = $args[2];
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	
	if ($args[2] == 'on') {
		$options .= '<input class="checkbox_option" checked="checked" type="checkbox" name="%1$s" value="on" />';
	} else {
		$options .= '<input class="checkbox_option" type="checkbox" name="%1$s" value="off" /><input class="checkbox_option" type="hidden" name="%1$s" value="off" />';
	}

	$label_format =
		'<div class="input-bubble" style="display: block !important; width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<p><em>'.$description.'</em> '.$options.'</p>'.
		'</div>';

	return vsprintf( $label_format, $args );
}

/************************************************************************************/
// raw textarea
/************************************************************************************/
function meta_textarea ( $args ) {
	global $post;
	$description = $args[2];
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format = $duplicate.
		'<div class="input-bubble" style="width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<p><textarea style="width: 80%%;" name="%1$s">%3$s</textarea></p>'.
		'<p><em>'.$description.'</em></p>'.
		'</div>';
	return vsprintf( $label_format, $args );
}

/************************************************************************************/
// text field
/************************************************************************************/
function meta_text ( $args ) {
	global $post;
	$description = $args[2];
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format = $duplicate.
		'<div class="input-bubble" style="width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<p><input style="width: 80%%;" type="text" name="%1$s" value="%3$s" /></p>'.
		'<p><em>'.$description.'</em></p>'.
		'</div>';
	return vsprintf( $label_format, $args );
}

/************************************************************************************/
// images/files
/************************************************************************************/
function meta_file( $args ) {
	global $post;
	$description = $args[2];
	// adjust data
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format =
		'<div class="input-bubble" style="width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<p><input class="custom-media" style="width: 80%%;" type="text" name="%1$s" value="%3$s" /></p>'.
		'<p><em>'.$description.'</em></p>'.
		'</div>';
	return vsprintf( $label_format, $args );
}

/************************************************************************************/
// text field
/************************************************************************************/
function meta_media ( $args ) {
	global $post;
	$description = $args[2];
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format = $duplicate.
		'<div class="input-bubble" style="width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<p><div class="custom-media"></div></p>'.
		'<p><em>'.$description.'</em></p>'.
		'</div>';
	return vsprintf( $label_format, $args );
}

/************************************************************************************/
// tinymce
/************************************************************************************/
function meta_tinymce ( $args ) {
	global $post;
	$description = $args[2];
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );
	$label_format = $duplicate.
		'<div class="input-bubble" style="width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<div class="customEditor"><textarea style="width: 80%%;" name="%1$s">%3$s</textarea></div>'.
		'<p><em>'.$description.'</em></p>'.
		'</div>';
	return vsprintf( $label_format, $args );
}

/************************************************************************************/
// select - gallery
/************************************************************************************/
function meta_select_gallery( $args ) {
	
	global $post;
	$description = $args[2];
	$args[2] = get_post_meta($post->ID, $args[0], true);
	$args[1] = __($args[1], 'sp' );

	global $wpdb;

	$gallery = get_posts(array('post_type'=>'galleries','posts_per_page'=>-1,'orderby'=>'name'));
	foreach ($gallery as $gallery_item) {
		$title = $gallery_item->post_title;
		$id = $gallery_item->ID;
		if ( $id == $args[2] ) {
			$options .= '<option selected="selected" value="'.$id.'">'.$title.'</option>';
		} else {
			$options .= '<option value="'.$id.'">'.$title.'</option>';
		}
	}

	$label_format = '<div id="option%1$s" class="input-bubble" style="width: 95%%; margin: 10px auto 10px auto; background-color: #F9F9F9; border: 1px solid #DFDFDF; -moz-border-radius: 5px; -webkit-border-radius: 5px; padding: 10px;">'.
		'<p><label for="%1$s"><strong>%2$s</strong></label></p>'.
		'<p><select id="select%1$s" name="%1$s">
		<option selected="selected" value="">-- Choose --</option>'.$options.'</select>'.
		'<p><em>'.$description.'</em></p>'.
		'</div>';
	return vsprintf( $label_format, $args );
}

?>