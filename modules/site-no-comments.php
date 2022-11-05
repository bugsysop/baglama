<?php
/*
 * Remove comments
 * Todo: make it an option
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
	
	 // Error if setting page is requested > To Be Tested
	 global $pagenow;

		// if ( $pagenow == 'comment.php' || $pagenow == 'edit-comments.php' || $pagenow == 'options-discussion.php' )
		if ( $pagenow == 'comment.php' || $pagenow == 'edit-comments.php' )
			wp_die( __( 'Comments are closed.' ), '', array( 'response' => 403 ) );
	
    remove_menu_page( 'edit-comments.php' );
	remove_submenu_page('options-general.php', 'options-discussion.php'); // Avatars ?
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

// Clean Header
function baglama_remove_comments_header(){
    wp_deregister_script( 'comment-reply' );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
}
add_action('init','baglama_remove_comments_header');
