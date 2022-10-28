<?php
/*
 * Customize admin menu
 */

// Global
add_filter( 'custom_menu_order', 'baglama_reorder_admin_menu' );
add_filter( 'menu_order', 'baglama_reorder_admin_menu' );
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

add_action( 'admin_menu', 'baglama_add_submenus' );
function baglama_add_submenus() {
    // WP pages: About, Credits, Freedom, Privacy, etc
    add_submenu_page( 'index.php', '', 'About',	'read', 'about.php');
}

add_action( 'admin_menu', 'baglama_move_to_submenu' );
function baglama_move_to_submenu() {
    // Reusable Blocks: create submenu under Apparence
    add_submenu_page('themes.php',__('Reusable Blocks'), __('Reusable Blocks'),'manage_options', 'edit.php?post_type=wp_block' );
}

// Themes and plugins files Edit
add_action( 'admin_menu', 'baglama_remove_menu_pages', 999 );
function baglama_remove_menu_pages() {
    // For WordPress 6.0.*
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
    // For WordPress 6.1-RC3
    remove_submenu_page( 'tools.php', 'theme-editor.php' );
    remove_submenu_page( 'tools.php', 'plugin-editor.php' );
    // For All
    remove_menu_page( 'edit.php?post_type=wp_block' );
}

// Plugins humility
add_action( 'admin_menu', 'baglama_twentig_humility', 999 );
function baglama_twentig_humility() {
    if ( is_plugin_active( 'twentig/twentig.php' ) ) {
    remove_menu_page( 'twentig' );
    add_submenu_page('themes.php','Twentig Page', 'Twentig','manage_options', 'twentig' );
    }
}
