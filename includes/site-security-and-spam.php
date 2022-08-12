<?php
add_filter('xmlrpc_enabled', '__return_false'); // Warning -> WP desktop Apps will not work
add_filter('wp_is_application_passwords_available', '__return_false');  // Warning -> WP Mobiles Apps will not work
add_action('pre_ping','tmprs_no_self_ping');
function tmprs_no_self_ping(&$links){$home=get_option('home');foreach($links as $l=>$link)if(0===strpos($link,$home))unset($links[$l]);}

// Login page
add_filter( 'login_errors', 'tmprs_no_login_errors' );
function tmprs_no_login_errors(){ return __( 'Houston, nous avons un problème...', 'baglama' ); }

// To remove link, use a dirty hack in css
add_action( "login_init", "tmprs_disable_lost_password" );
function tmprs_disable_lost_password() {
    if (isset( $_GET['action'] )){
        if ( in_array( $_GET['action'], array('lostpassword', 'retrievepassword') ) ) {
            wp_redirect( wp_login_url(), 301 );
            exit;
        }
    }
}

// Disable WP Registration Page - 1.0.2
add_filter( 'register', 'tmprs_remove_registration_link' );
function tmprs_remove_registration_link( $registration_url ) {
	return __( 'Manual registration is disabled', 'baglama' );
}

add_action( 'init', 'tmprs_redirect_registration_page' );
function tmprs_redirect_registration_page() {
	if ( isset( $_GET['action'] ) && $_GET['action'] == 'register' ) {
		ob_start();
		wp_redirect( wp_login_url() );
		ob_clean();
	}
}

// No way to list user accounts from outside
if (!is_admin()) {
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die('No Way!');
	add_filter('redirect_canonical', 'tmprs_check_enum', 10, 2);
}
function tmprs_check_enum($redirect, $request) {
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}
