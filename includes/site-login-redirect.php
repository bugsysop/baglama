<?php
// After login redinect non-admin users to home
add_filter( 'login_redirect', 'tmprs_login_redirect', 10, 3 );
function tmprs_login_redirect( $redirect_to, $request, $user ) {
	$tmprs_roles = isset( $user->roles );
	if ( is_array( $tmprs_roles ) && in_array( 'administrator', $tmprs_roles ) ) {
		return admin_url();
	} else {
		return site_url();
	}
}
