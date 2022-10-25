<?php
/*
 * Remove comments
 *
 * Not active by default
 * Note: Fully functional and tested
 */

// Removes support for post & pages
add_action( 'init', 'baglama_remove_comment_support', 100 );
function baglama_remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}

// Admin menu
add_action( 'admin_menu', 'baglama_remove_comments_admin_menus' );
function baglama_remove_comments_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
	remove_submenu_page('options-general.php', 'options-discussion.php');
}

// Admin bar
add_action( 'wp_before_admin_bar_render', 'baglama_remove_comments_admin_bar' );
function baglama_remove_comments_admin_bar() {
    global $wp_admin_bar;  
    $wp_admin_bar->remove_menu( 'comments' );
}

// Dasboard
add_action('admin_head', 'baglama_remove_comments_dashboard');
function baglama_remove_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
	echo '<style>#dashboard_right_now .comment-count,#dashboard_right_now .comment-mod-count,#latest-comments,#welcome-panel .welcome-comments,.user-comment-shortcuts-wrap { display: none !important; }</style>';
}

// Gutenberg Edit Panel 
add_action('admin_head', 'baglama_remove_comments_gutenberg');
function baglama_remove_comments_gutenberg() {
 echo '<script>
 wp.domReady( () => {
    const { removeEditorPanel } = wp.data.dispatch("core/edit-post");
    removeEditorPanel( "discussion-panel" );
  } );
  </script>';
}
