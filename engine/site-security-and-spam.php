<?php
add_filter('xmlrpc_enabled', '__return_false'); // Warning -> WP desktop Apps will not work
add_filter('wp_is_application_passwords_available', '__return_false');  // Warning -> WP Mobiles Apps will not work

// No self ping
add_action('pre_ping','baglama_no_self_ping');
function baglama_no_self_ping(&$links){$home=get_option('home');foreach($links as $l=>$link)if(0===strpos($link,$home))unset($links[$l]);}

// No error message on login page
add_filter( 'login_errors', 'baglama_no_login_errors' );
function baglama_no_login_errors(){ return __( 'Houston, nous avons un problème…', 'baglama' ); }

// No Pasword recovery
// To remove the link, we have to use a dirty hack in css
add_action( "login_init", "baglama_disable_lost_password" );
function baglama_disable_lost_password() {
    if (isset( $_GET['action'] )){
        if ( in_array( $_GET['action'], array('lostpassword', 'retrievepassword') ) ) {
            wp_redirect( wp_login_url(), 301 );
            exit;
        }
    }
}

// Disable WP Registration Page - 1.0.2
add_filter( 'register', 'baglama_remove_registration_link' );
function baglama_remove_registration_link( $registration_url ) {
	return __( 'Ce site n’accepte pas l’enregistrement de comptes utilisateur', 'baglama' );
}
add_action( 'init', 'baglama_redirect_registration_page' );
function baglama_redirect_registration_page() {
	if ( isset( $_GET['action'] ) && $_GET['action'] == 'register' ) {
		ob_start();
		wp_redirect( wp_login_url() );
		ob_clean();
	}
}

// No way to list user accounts from outside
if (!is_admin()) {
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die('No Way!');
	add_filter('redirect_canonical', 'baglama_check_enum', 10, 2);
}
function baglama_check_enum($redirect, $request) {
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}
