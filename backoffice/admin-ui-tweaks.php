<?php

// Welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// WordPress logo
add_action( 'wp_before_admin_bar_render', 'baglama_remove_wp_logo_admin', 0 );
function baglama_remove_wp_logo_admin() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}

// Admin footer
// add_filter('admin_footer_text', 'baglama_admin_footer_text');
// function baglama_admin_footer_text() { echo 'The kids are united: Wordpress & Bağlama Rule'; }
add_filter('admin_footer_text', 'baglama_admin_footer_text');
function baglama_admin_footer_text($text) {
	$text = 'The kids are united: Wordpress & Bağlama Rule';
  return $text;
}




