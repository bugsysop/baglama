<?php
add_filter('xmlrpc_enabled', '__return_false'); // Warning -> WP desktop Apps will not work
add_filter('wp_is_application_passwords_available', '__return_false');  // Warning -> WP Mobiles Apps will not work
add_filter( 'login_errors', 'tmprs_no_wordpress_errors' );
function tmprs_no_wordpress_errors(){ return 'Houston, nous avons un problème...'; }
add_filter ( 'allow_password_reset', 'tmprs_disable_password_reset' );
function tmprs_disable_password_reset() { return false; }
add_action('pre_ping','tmprs_no_self_ping');
function tmprs_no_self_ping(&$links){$home=get_option('home');foreach($links as $l=>$link)if(0===strpos($link,$home))unset($links[$l]);}
// No way to list user oucounts from outside
if (!is_admin()) {
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die('No Way!');
	add_filter('redirect_canonical', 'tmprs_check_enum', 10, 2);
}
function tmprs_check_enum($redirect, $request) {
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}

