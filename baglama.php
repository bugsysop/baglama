<?php

/*
Plugin Name: Bağlama
Plugin URI: https://codeberg.org/_aris/baglama
Description: Dispositif de publication expérimental basé sur WordPress
Author: aris~
Text Domain: baglama
Author URI: https://papatheodorou.net/
Gitea Plugin URI: https://codeberg.org/_aris/baglama
Primary Branch: main
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Version: 0.1.6
Requires at least: 6.0
Tested up to: 6.1
Requires PHP: 7.2
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Text domain
load_plugin_textdomain( 'baglama', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

// Engine

include_once plugin_dir_path( __FILE__ ).'engine/wordpress-config.php';
include_once plugin_dir_path( __FILE__ ).'engine/site-support.php';
if ( is_admin() ) {
    include_once plugin_dir_path( __FILE__ ).'engine/admin-mail-no-more.php';
    include_once plugin_dir_path( __FILE__ ).'engine/content-medias.php';
}
include_once plugin_dir_path( __FILE__ ).'engine/head-clean-up.php';
include_once plugin_dir_path( __FILE__ ).'engine/site-security-and-spam.php';

// Backoffice

if ( is_admin() ) {
    include_once plugin_dir_path( __FILE__ ).'backoffice/slate-functions.php';
    include_once plugin_dir_path( __FILE__ ).'backoffice/admin-menu.php';
    include_once plugin_dir_path( __FILE__ ).'backoffice/admin-hide-nags.php';
    include_once( plugin_dir_path( __FILE__ ).'backoffice/dashboard-widgets-tweaks.php' );
    include_once plugin_dir_path( __FILE__ ).'backoffice/admin-ui-tweaks.php';
    include_once plugin_dir_path( __FILE__ ).'backoffice/user-profile-tweaks.php';
    //include_once plugin_dir_path( __FILE__ ).'backoffice/widgets.php';
}

// Based on Slate Admin Theme - 1.2.4
add_action( 'admin_enqueue_scripts', 'baglama_admin_assets' );
function baglama_admin_assets() {
    wp_enqueue_style( 'baglama-admin-theme', plugins_url('assets/css/admin.css', __FILE__), array(), '1.2.4' );
    wp_enqueue_script( 'baglama', plugins_url( "assets/js/admin.js", __FILE__ ), array( 'jquery' ), '1.2.4' );
}
add_action( 'after_setup_theme', 'baglama_add_editor_styles' );
function baglama_add_editor_styles() {
    add_editor_style( plugins_url('css/editor-style.css', __FILE__ ) );
}

// Modules

include_once plugin_dir_path( __FILE__ ).'modules/admin-bar-no-more.php';
include_once plugin_dir_path( __FILE__ ).'modules/content-image-credit.php';
include_once plugin_dir_path( __FILE__ ).'modules/content-rss-feeds.php';
include_once plugin_dir_path( __FILE__ ).'modules/content-archives-pages.php';
include_once plugin_dir_path( __FILE__ ).'modules/site-login-interface.php';
