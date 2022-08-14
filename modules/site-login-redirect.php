<?php
/*
 * NOT ACTIVE - NOT TESTED
 *
 */

// After login redinect non-admin users to home
add_filter( 'login_redirect', 'baglama_login_redirect', 10, 3 );
function baglama_login_redirect( $redirect_to, $request, $user ) {
	$baglama_roles = isset( $user->roles );
	if ( is_array( $baglama_roles ) && in_array( 'administrator', $baglama_roles ) ) {
		return admin_url();
	} else {
		return site_url();
	}
}
