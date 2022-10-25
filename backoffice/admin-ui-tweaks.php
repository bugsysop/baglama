<?php

// Welcome panel
remove_action('welcome_panel', 'wp_welcome_panel');

// WordPress logo
add_action( 'wp_before_admin_bar_render', 'baglama_remove_wp_logo_admin', 0 );
function baglama_remove_wp_logo_admin() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'wp-logo' );
}

// Howdy? No more in admin bar
add_action( 'admin_bar_menu', 'baglama_remove_howdy', 11 );
function baglama_remove_howdy ( $wp_admin_bar ) {
	$current_user = wp_get_current_user();
	$avatar = get_avatar( $current_user->ID, 28 );
	$wp_admin_bar->add_node( [
		'id' => 'my-account',
		'title' => $current_user->display_name . $avatar
	] );
}

/*
 * Add a ID column for posts and pages
 * Note: to add the column for a custom post type
 * add_filter( 'manage_posts_columns', 'baglama_my_cpt_name', 5 );
 * add_action( 'manage_posts_custom_column', 'baglama_my_cpt_name', 5, 2 );
 */
if ( ! function_exists( 'baglama_add_id_column' ) ) :
	function baglama_add_id_column( $columns ) {
		$columns['post_id_clmn'] = __( 'ID', 'baglama-add-id-column' );
		return $columns;
	}
	add_filter( 'manage_posts_columns', 'baglama_add_id_column', 5 ); // for posts
	add_filter( 'manage_pages_columns', 'baglama_add_id_column', 5 ); // for pages
endif;

// Print with an action hook
if ( ! function_exists( 'baglama_column_content' ) ) :
	function baglama_column_content( $column, $id ) {
		if ( $column === 'post_id_clmn' ) {
			esc_html_e( $id );
		}
	}
	add_action( 'manage_posts_custom_column', 'baglama_column_content', 5, 2 ); // for posts
	add_action( 'manage_pages_custom_column', 'baglama_column_content', 5, 2 ); // for pages
endif;


// Admin footer
// add_filter('admin_footer_text', 'baglama_admin_footer_text');
// function baglama_admin_footer_text() { echo 'The kids are united: Wordpress & Bağlama Rule'; }
add_filter('admin_footer_text', 'baglama_admin_footer_text');
function baglama_admin_footer_text($text) {
	$text = 'The kids are united: Wordpress & Bağlama Rule&nbsp;';
  return $text;
}




