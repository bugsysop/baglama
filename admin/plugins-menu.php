<?php
/*
 *
 * Examples
 * remove_menu_page( 'plugin_menu_slug' );
 * add_submenu_page('options-general.php','Page Title', 'Menu Label','manage_options', 'plugin_menu_slug' );
 *
 * References
 * https://developer.wordpress.org/reference/functions/remove_menu_page/
 * https://developer.wordpress.org/reference/functions/remove_submenu_page/
 * https://developer.wordpress.org/reference/functions/add_menu_page/
 * https://developer.wordpress.org/reference/functions/add_submenu_page/
 * https://wordpress.stackexchange.com/questions/306447/move-plugin-settings-to-settings-menu-in-the-admin
 *
 */

add_action( 'admin_init', 'baglama_remove_menu_pages' );
function baglama_remove_menu_pages() {
    remove_menu_page( 'twentig' );
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}

add_action( 'admin_init', 'baglama_add_menu_pages' );
function baglama_add_menu_pages() {
    add_submenu_page('themes.php','Twentig Page', 'Twentig','manage_options', 'twentig' );
}