<?php

// Welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// WordPress logo
add_action( 'wp_before_admin_bar_render', 'baglama_remove_wp_logo_admin', 0 );
function baglama_remove_wp_logo_admin() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}

// Howdy? No more in admin bar
add_action( 'admin_bar_menu', 'baglama_remove_howdy', 11 );
function baglama_remove_howdy ( $wp_admin_bar ) {
	$current_user = wp_get_current_user();
	$avatar = get_avatar( $current_user->ID, 28 );
	$wp_admin_bar->add_node( [
		'id' => 'my-account',
		'title' => $current_user->display_name . $avatar
	] );
}

// Admin footer
// add_filter('admin_footer_text', 'baglama_admin_footer_text');
// function baglama_admin_footer_text() { echo 'The kids are united: Wordpress & Bağlama Rule'; }
add_filter('admin_footer_text', 'baglama_admin_footer_text');
function baglama_admin_footer_text($text) {
	$text = 'The kids are united: Wordpress & Bağlama Rule&nbsp;';
  return $text;
}




