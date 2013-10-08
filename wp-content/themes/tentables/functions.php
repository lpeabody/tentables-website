<?php
/*
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */

/************************************************************************************/
// initialization
/************************************************************************************/
add_action( 'after_setup_theme', 'sandbox_setup' );

if ( ! function_exists( 'sandbox_setup' ) ):

function sandbox_setup() {

	// set a content width if you haven't in the Dashboard
	if ( ! isset( $content_width ) ) $content_width = 580;

	// remove version # from RSS
	add_filter('the_generator', 'sandbox_hide_rss_version');

	// post thumbnails & custom sizes
	add_theme_support('post-thumbnails', array( 'page', 'post', 'samples') );

	// theme support for feed links
	add_theme_support( 'automatic-feed-links' );
	
	// post formats
	add_theme_support( 'post-formats', array('aside','gallery','audio','video','quote','image','chat') );

	// enable the_excerpt for pages
	add_post_type_support('page', 'excerpt');

	// hide version #
	remove_action('wp_head', 'wp_generator');

	// register scripts
	if (!is_admin()) {
		wp_deregister_script('jquery');
		// new scripts
		wp_register_script('jquery', get_bloginfo('template_url').'/scripts/libs/jquery.js', false, false, true);
		wp_register_script('tentables.lodash', get_bloginfo('template_url').'/scripts/libs/lodash.js', array('jquery'), '1.0.1', true);
		wp_register_script('tentables.anchorlinks', get_bloginfo('template_url').'/scripts/libs/anchorlinks.js', array('jquery'), '1.0', true);
		wp_register_script('tentables.common', get_bloginfo('template_url').'/scripts/common.js', array('tentables.anchorlinks'), '1.0', true);
		wp_register_script('tentables.validate', get_bloginfo('template_url').'/scripts/libs/jquery.validate.js', array('jquery'), '1.0', true);
		// global scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('tentables.common');
		wp_enqueue_script('tentables.anchorlinks');
		wp_enqueue_script('tentables.validate');

		wp_register_style( 'screen', get_bloginfo('template_url').'/styles/stylesheets/screen.css', false, '1.0', 'screen' );
		wp_enqueue_style( 'screen' );
	}

	// register scripts for the Dashboard
	if (is_admin()) {
		// new scripts
		wp_register_script('dashboard.custom', get_bloginfo('template_url').'/scripts/dashboard.js', array('jquery'), '1.0', true);
		// global scripts
		wp_enqueue_script('dashboard.custom');
	}

	// register nav menus
	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'utility' => 'Utility Navigation'
	) );
}
endif;

/************************************************************************************/
// include extra functions
/************************************************************************************/
include_once('includes/functions-deactivate.php');
include_once('includes/functions-extend.php');
include_once('includes/functions-utility.php');

/************************************************************************************/
// include post types
/************************************************************************************/
include_once('includes/types/meta.php');
include_once('includes/types/type-pages.php');
include_once('includes/types/type-posts.php');
include_once('includes/types/type-menus.php');
include_once('includes/types/type-specials.php');
include_once('includes/types/type-drinks.php');
include_once('includes/types/type-contact.php');
include_once('includes/types/type-parking-directions.php');
include_once('includes/types/type-team.php');

/************************************************************************************/
// include options pages
/************************************************************************************/
//include_once('includes/options/global.php');
//include_once('includes/options/nav-primary.php');

/************************************************************************************/
// include widgets
/************************************************************************************/
//include_once('includes/widgets/widget-sample.php');

/************************************************************************************/
// include sidebars
/************************************************************************************/
/*function sandbox_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'sandbox' ),
		'id' => 'default',
		'description' => __( 'The default left sidebar for this theme.', 'sandbox' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>'
	) );
	// this displays a sidebar for each custom sidebar assigned to a page or post
	if(function_exists('register_sidebar')){
		foreach(get_custom_sidebars() as $i=>$sb){
			register_sidebar(array(
				'name'=>$sb[meta_value],
				'id' => strtolower(str_replace(" ", "", $sb[meta_value])),
				'before_widget' => '<div class="widget %2$s" id="%1$s"><div class="top"></div><div class="innards">',
				'after_widget' => '</div><div class="bottom"></div></div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));
		}
	}
}
add_action( 'widgets_init', 'sandbox_widgets_init' );
*/

//breadcrumbs!
function get_breadcrumb() {
 
	global $post;
 
	$page_title = get_the_title($post->ID);
 
	if($post->post_parent) {
		$parent_id = $post->post_parent;
 
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
			$parent_id = $page->post_parent;
		}
 
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach($breadcrumbs as $crumb) $trail .= $crumb;
	}
 
	$trail .= '<li><span>'.$page_title.'</span></li>';
	$trail .= '';
 
	return $trail;	
 
}


function remove_menus () {
global $menu;
	$restricted = array( __('Comments'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action('admin_menu', 'remove_menus');