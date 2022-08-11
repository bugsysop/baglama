<?php
// Voir : https://css-tricks.com/snippets/wordpress/customize-login-page/
// https://www.wpbeginner.com/plugins/how-to-create-custom-login-page-for-wordpress/
// https://wpmudev.com/blog/customize-login-page/
/*
// Change the Logo
function tmprs_custom_login_logo() {
	echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/assets/img/logo-login.gif) 50% 50% no-repeat !important; }</style>';
}
add_action('login_head', 'tmprs_custom_login_logo');
*/

// Login page logo link
add_filter( 'login_headerurl', 'tmprs_login_logo_link' );
function tmprs_login_logo_link() {
	return get_bloginfo( 'url' );
}

/*
// Change the logo Title attribute
function tmprs_change_login_logo_title() {
	return get_option('blogname');
}
add_filter('login_headertitle', 'tmprs_change_login_logo_title');

*/


