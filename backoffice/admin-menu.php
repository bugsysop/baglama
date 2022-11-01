<?php
/*
 * Customize admin menu
 */

// Global
// Have to change this!
add_filter( 'custom_menu_order', 'baglama_make_admin_menu' );
add_filter( 'menu_order', 'baglama_make_admin_menu' );
function baglama_reorder_admin_menu( $__return_true ) {
    return array(
        'index.php',                    // Dashboard
        'separator1',                   // --Space--
        'edit.php',                     // Posts
        'edit.php?post_type=page',      // Pages
        'upload.php',                   // Media
        'edit-comments.php',            // Comments
        'separator2',                   // --Space--
        'themes.php',                   // Appearance
        'plugins.php',                  // Plugins
        'tools.php',                    // Tools
        'users.php',                    // Users     
        'options-general.php',          // Settings
        'separator-last',               // --Space-- Last separator
   );
}

// Remove
add_action( 'admin_menu', 'baglama_remove_menu_pages', 999 );
function baglama_remove_menu_pages() {
    // For WordPress 6.0.* & Classic Themes
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
    // For WordPress 6.1-RC3 & Classic Themes
    remove_submenu_page( 'tools.php', 'theme-editor.php' );
    remove_submenu_page( 'tools.php', 'plugin-editor.php' );
    // For FSE Themes: added by Gutenberg?
    remove_menu_page( 'edit.php?post_type=wp_block' );
}

// Submenu
add_action( 'admin_menu', 'baglama_make_submenu' );
function baglama_make_submenu() {
	// Dashboard
	add_submenu_page( 'index.php',__('About'),__('About'),	'read', 'about.php','', '3');
    // Apparence
    add_submenu_page('themes.php',__('Reusable Blocks'),__('Reusable Blocks'),'manage_options', 'edit.php?post_type=wp_block', '', '9' );
	// Only if it’s a Block Theme
	if (current_theme_supports('block-templates')) {
		add_submenu_page('themes.php',__('Navigation Menus'),__('Navigation Menus'),'manage_options', 'edit.php?post_type=wp_navigation', '', '9' );
    	add_submenu_page('themes.php',__('Templates'),__('Templates'),'manage_options', 'site-editor.php?postType=wp_template', '', '10' );
    	add_submenu_page('themes.php',__('Template Parts'),__('Template Parts'),'manage_options', 'site-editor.php?postType=wp_template_part', '', '11' );
	}
}

// Plugins humility
add_action( 'admin_menu', 'baglama_plugins_humility', 999 );
function baglama_plugins_humility() {
    if ( is_plugin_active( 'twentig/twentig.php' ) ) {
    remove_menu_page( 'twentig' );
    add_submenu_page('themes.php','Twentig Page', 'Twentig','manage_options', 'twentig' );
    }
}
