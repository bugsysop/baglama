<?php
add_action( 'admin_init', 'baglama_remove_dashboard_meta' ); 
function baglama_remove_dashboard_meta() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	//remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
	//remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
	//remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}

// Display PHP and MySQL versions
add_action( 'rightnow_end', 'baglama_display_php_mysql_versions' );
function baglama_display_php_mysql_versions() {
	echo
		sprintf(
			__( 'Running PHP %1$s and MySQL %2$s', 'baglama' ),
			phpversion(),
			$GLOBALS['wpdb']->db_version()
		);
}

// Display support to Free and Open Source software
add_action( 'rightnow_end', 'baglama_display_open_source' );
function baglama_display_open_source() {
	echo __( '<br>and lot of others <strong>free and open source</strong> software', 'baglama' );

}
