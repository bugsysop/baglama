<?php

/*
Plugin Name: Bağlama
Plugin URI: https://codeberg.org/_aris/baglama
Description: Dispositif de publication expérimental basé sur WordPress
Author: aris~
Author URI: https://papatheodorou.net/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Version: 2022.08.11
*/

// Slate Admin Theme

add_action( 'admin_enqueue_scripts', 'slate_files' );
add_action( 'login_enqueue_scripts', 'slate_files' );
function slate_files() {
  wp_enqueue_style( 'slate-admin-theme', plugins_url('assets/css/slate.css', __FILE__), array(), '1.2.4' );
  wp_enqueue_script( 'slate', plugins_url( "assets/js/slate.js", __FILE__ ), array( 'jquery' ), '1.2.4' );
}

add_action( 'after_setup_theme', 'slate_add_editor_styles' );
function slate_add_editor_styles() {
    add_editor_style( plugins_url('css/editor-style.css', __FILE__ ) );
}

add_action( 'admin_head', 'slate_colors' );
//add_action( 'login_head', 'slate_colors' );
function slate_colors() {
	include( 'assets/css/dynamic.php' );
}


// Engine

if ( is_admin() ) {
    include_once plugin_dir_path( __FILE__ ).'admin/slate-functions.php';
    include_once plugin_dir_path( __FILE__ ).'admin/widgets.php';
}

// Modules

include_once plugin_dir_path( __FILE__ ).'includes/wordpress-config.php';
include_once plugin_dir_path( __FILE__ ).'includes/head-clean-up.php';
include_once plugin_dir_path( __FILE__ ).'includes/site-support.php';
include_once plugin_dir_path( __FILE__ ).'includes/admin-bar-no-more.php';
include_once plugin_dir_path( __FILE__ ).'includes/content-rss-feeds.php';
include_once plugin_dir_path( __FILE__ ).'includes/site-security-and-spam.php';
include_once plugin_dir_path( __FILE__ ).'includes/site-login-interface.php';

if ( is_admin() ) {
    include_once( plugin_dir_path( __FILE__ ) . 'includes/dashboard-clean-up.php' );
    include_once plugin_dir_path( __FILE__ ).'includes/admin-interface.php';
    include_once plugin_dir_path( __FILE__ ).'includes/admin-mail-no-more.php';
    include_once plugin_dir_path( __FILE__ ).'includes/content-medias.php';
}
