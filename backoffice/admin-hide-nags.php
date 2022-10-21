<?php 
// Hide WordPress update nag to all but admins
add_action( 'admin_head', 'baglama_hide_update_nag', 1 );
function baglama_hide_update_nag() {
    if ( !current_user_can( 'update_core' ) ) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}