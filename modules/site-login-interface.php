<?php
// @link https://css-tricks.com/snippets/wordpress/customize-login-page/
// @link https://www.wpbeginner.com/plugins/how-to-create-custom-login-page-for-wordpress/
// @link https://wpmudev.com/blog/customize-login-page/

// Custom style for login page only
add_action('login_head', 'baglama_custom_style');
function baglama_custom_style() {
	echo '<!-- BAGLAMA -->';
	echo '<style type="text/css">';
	echo 'h1 a { background: url("' . esc_url( plugins_url('../assets/img/baglama-login-logo.png', __FILE__ ) ) . '") no-repeat !important; }';
	echo '.login #nav {display: none;}';
	echo '.login #backtoblog { text-align: center; }';
	echo '</style>';
}

// Login page logo link
add_filter( 'login_headerurl', 'baglama_login_logo_link' );
function baglama_login_logo_link() {
	return get_bloginfo( 'url' );
}

// Change the logo Title attribute
function baglama_change_login_logo_title() {
	return get_option('blogname');
}
add_filter('login_headertitle', 'baglama_change_login_logo_title');

// Remove login page language switcher
add_filter( 'login_display_language_dropdown', '__return_false' );
