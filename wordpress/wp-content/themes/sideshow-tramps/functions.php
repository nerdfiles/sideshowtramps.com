<?php
/**
 * Rather than lumping all theme functions into a single file, this functions file is used for 
 * initializing the theme framework, which activates files in the order that it needs. Users
 * should create a child theme and make changes to its functions.php file (not this one).
 *
 * @package Hybrid
 * @subpackage Functions
 */

/* Load the Hybrid class. */
require_once( TEMPLATEPATH . '/library/classes/hybrid.php' );

/* Initialize the Hybrid framework. */
$hybrid = new Hybrid();
$hybrid->init();

add_action('init', 'initer');
function initer() {
	// hard code this
	remove_action( 'hybrid_head', 'hybrid_meta_content_type' );
	remove_action( 'hybrid_after_header', 'hybrid_page_nav' );
}

function body_class_page_name($echo = false) {
	global $post;
	$parent_title = strtolower(str_replace(" ", "-", get_the_title($post->post_parent)));
	$page_name = strtolower(str_replace(" ", "-", get_the_title()));
	$page_name = str_replace(".", "", $page_name);
	
	if ($parent_title == $page_name) $parent_title=" home-parent";
	else $parent_title = " ".$parent_title."-parent";
	
	$page_name = " ".$page_name;
	
	if ($echo == true) echo $parent_title.$page_name;
	else return $parent_title.$page_name;
}
/*

http://sideshowtramps.com/wordpress/wp-includes/js/l10n.js?ver=20101110 
http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js?ver=1.4 
http://sideshowtramps.com/wordpress/wp-content/plugins/wp-e-commerce/wpsc-core/js/wp-e-commerce.js?ver=3.8.4.391083 
http://sideshowtramps.com/wordpress/wp-content/plugins/wp-e-commerce/wpsc-core/js/jquery.infieldlabel.min.js?ver=3.8.4.391083 
http://sideshowtramps.com/wordpress/wp-content/plugins/wp-e-commerce/wpsc-core/js/ajax.js?ver=3.8.4.391083   
http://sideshowtramps.com/wordpress/index.php?wpsc_user_dynamic_js=true&#038;ver=3.8.4.391083 
http://sideshowtramps.com/wordpress/wp-content/plugins/wp-e-commerce/wpsc-admin/js/jquery.livequery.js?ver=1.0.3 
http://sideshowtramps.com/wordpress/wp-content/plugins/wp-e-commerce/wpsc-core/js/jquery.rating.js?ver=3.8.4.391083 
http://sideshowtramps.com/wordpress/wp-content/plugins/wp-e-commerce/wpsc-core/js/user.js?ver=3.8.4391083 
http://sideshowtramps.com/wordpress/wp-content/themes/sideshow-tramps/layer-behavior/jquery.preloadimages.js?ver=1.4 
http://sideshowtramps.com/wordpress/wp-content/themes/sideshow-tramps/layer-behavior/sb/shadowbox.js?ver=3.1.3 
http://sideshowtramps.com/wordpress/wp-content/themes/sideshow-tramps/layer-behavior/main.js?ver=3.1.3 
http://sideshowtramps.com/wordpress/wp-content/plugins/contact-form-7/jquery.form.js?ver=2.52 
http://sideshowtramps.com/wordpress/wp-content/plugins/contact-form-7/scripts.js?ver=2.4.5 

*/

//add_action('wp_footer', 'remove_js');
function remove_js() {
    wp_deregister_script('jquery');
}
add_action('hybrid_head', 'load_js');
function load_js() {
	/* jQuery */
	wp_deregister_script('jquery');
    //wp_deregister_script('l10n');
    //wp_deregister_script('wp-e-commerce');
    //wp_deregister_script('jquery.infieldlabel.min');
    //wp_deregister_script('wpsc-ajax');
    
	wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', false);
	wp_enqueue_script('jquery');
    
    wp_register_script('jquery-preloadimages', '/wp-content/themes/sideshow-tramps/layer-behavior/jquery.preloadimages.js', false);
    wp_enqueue_script('jquery-preloadimages');
	
	wp_register_script('shadowbox', '/wp-content/themes/sideshow-tramps/layer-behavior/sb/shadowbox.js', false);
	wp_enqueue_script('shadowbox');
	
	wp_register_script('main-st', '/wp-content/themes/sideshow-tramps/layer-behavior/main.js', false);
	wp_enqueue_script('main-st');

}

//remove_action('hybrid_before_content', 'hybrid_breadcrumb');
add_filter('breadcrumb_trail', 'hybrid_remove_breadcrumb');
function hybrid_remove_breadcrumb($breadcrumb){
  return false;
}

//add_action('hybrid_after_header', 'custom_page_nav');
function custom_page_nav() {

	/* Before page nav hook. */
	do_atomic( 'before_page_nav' );

	/* Arguments for wp_page_menu().  Users should filter 'wp_page_menu_args' to change. */
	$args = array(
		//'show_home' => __( 'Home', hybrid_get_textdomain() ),
		'menu_class' => 'page-nav',
		'sort_column' => 'menu_order',
		'depth' => 2,
		'echo' => 0,
		'link_before' => '',
		'link_after' => ''
	);

	/* Strips formatting and spacing to make the code less messy on display. */
	$nav = str_replace( array( "\r", "\n", "\t" ), '', wp_page_menu( $args ) ); //"class=\""
	
	/* Adds the #page-nav ID to the wrapping element. */
	$nav = str_replace( '<div class="', '<div id="page-nav" class="', $nav );

	/* Adds the .menu and .sf-menu classes for use with the drop-down JavaScript. */
	$nav = preg_replace( '/<ul>/', '<ul class="menu sf-menu clear-hack"><li class="page_item page-item-external"><a href="http://thejester.sideshowtramps.com">The Jester</a></li>', $nav, 1 );
	
	echo $nav;
	
	/* After page nav hook. */
	do_atomic( 'after_page_nav' );

}

?>
