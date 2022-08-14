<?php

/*
Plugin Name: Bağlama
Plugin URI: https://codeberg.org/_aris/baglama
Description: Dispositif de publication expérimental basé sur WordPress
Author: aris~
Author URI: https://papatheodorou.net/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Version: 2022.08.13
*/

// Slate Admin Theme - 1.2.4

add_action( 'admin_enqueue_scripts', 'baglama_slate_files' );
//add_action( 'login_enqueue_scripts', 'baglama_slate_files' );
function baglama_slate_files() {
  wp_enqueue_style( 'slate-admin-theme', plugins_url('assets/css/slate.css', __FILE__), array(), '1.2.4' );
  wp_enqueue_script( 'slate', plugins_url( "assets/js/slate.js", __FILE__ ), array( 'jquery' ), '1.2.4' );
}

add_action( 'after_setup_theme', 'baglama_slate_add_editor_styles' );
function baglama_slate_add_editor_styles() {
    add_editor_style( plugins_url('css/editor-style.css', __FILE__ ) );
}

add_action( 'admin_head', 'baglama_slate_colors' );
//add_action( 'login_head', 'baglama_slate_colors' );
function baglama_slate_colors() {
	include( 'assets/css/dynamic.php' );
}

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
    include_once plugin_dir_path( __FILE__ ).'backoffice/plugins-menu.php';
    include_once( plugin_dir_path( __FILE__ ).'backoffice/dashboard-clean-up.php' );
    include_once plugin_dir_path( __FILE__ ).'backoffice/admin-interface.php';
    //include_once plugin_dir_path( __FILE__ ).'backoffice/widgets.php';
}

// Modules

include_once plugin_dir_path( __FILE__ ).'modules/admin-bar-no-more.php';
include_once plugin_dir_path( __FILE__ ).'modules/content-rss-feeds.php';
include_once plugin_dir_path( __FILE__ ).'modules/content-archives-pages.php';
include_once plugin_dir_path( __FILE__ ).'modules/site-login-interface.php';


