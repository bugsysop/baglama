<?php 
// Hide WordPress update nag to all but admins
add_action( 'admin_head', 'baglama_hide_update_nag', 1 );
function baglama_hide_update_nag() {
    if ( !current_user_can( 'update_core' ) ) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
// Hide Wordpress PHP version nag
add_action( 'wp_dashboard_setup', 'baglama_remove_stupid_php_nag' );
function baglama_remove_stupid_php_nag() {
	remove_meta_box( 'dashboard_php_nag', 'dashboard', 'normal' );
}

// Hide invasive plugins nags
// Targets: Code Snippets, Yoast Duplicate Post
add_action('admin_head', 'baglama_hide_plugins_nags');
function baglama_hide_plugins_nags() {
  echo '<style>
    .code-snippets-pro-notice { display: none; } 
    #duplicate-post-notice { display: none !important; }
  </style>';
}
