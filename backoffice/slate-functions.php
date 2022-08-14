<?php
/*
 * Slate Admin Theme Functions
 * Plugin URI: http://sevenbold.com/wordpress/
 * Repository: https://github.com/ryansommers/slate
 * Description: A clean, simplified WordPress Admin theme
 * Author: Ryan Sommers 
 * Author URI: http://sevenbold.com/
 * Version: 1.2.4
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


// User Color Sheme
function slate_get_user_admin_color(){
	$user_id = get_current_user_id();
	$user_info = get_userdata($user_id);
	if ( !( $user_info instanceof WP_User ) ) {
		return;
	}
	$user_admin_color = $user_info->admin_color;
	return $user_admin_color;
}

// Remove the hyphen before the post state
if ( is_admin() ) {
	add_filter( 'display_post_states', 'slate_post_state', 11 );
}
function slate_post_state( $post_states ) {
	if ( ! empty( $post_states && ! is_customize_preview() && 'Menus' !== get_admin_page_title() ) ) {
		$state_count = count($post_states);
		$i = 0;
		foreach ( $post_states as $state ) {
			++$i;
			( $i == $state_count ) ? $sep = '' : $sep = '';
			echo "<span class='post-state'>$state$sep</span>";
		}
	}
}
