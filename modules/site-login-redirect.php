<?php
/*
 * Redirect user after successful login
 * - Subscribers to home page
 * - Admin and other contibutors to Dashboard
 * NOT ACTIVE - Running fine
 */
function baglama_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for subscribers
		if ( in_array( 'subscriber', $user->roles ) ) {
			// redirect them to the default place
			return home_url();
		} else {
			return $redirect_to;
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'baglama_redirect', 10, 3 );
