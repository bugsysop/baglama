<?php
/*
 * Note - Split this file ?
 *
 */
remove_action('welcome_panel', 'wp_welcome_panel');
add_action( 'wp_before_admin_bar_render', 'tmprs_remove_wp_logo_admin', 0 );
function tmprs_remove_wp_logo_admin() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}
add_filter('screen_options_show_screen', 'tmprs_remove_screen_options');
function tmprs_remove_screen_options() { if(!current_user_can('manage_options')) { return false;} return true; }
//add_filter('admin_footer_text', 'tmprs_change_footer_admin');
//function tmprs_change_footer_admin () { echo 'Welcome to the Frontline!'; }

