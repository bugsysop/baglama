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

// Settings
$baglama_plugin_version = '0.1.6';
require_once plugin_dir_path( __FILE__ ) . 'engine/setting-helpers.php';
require_once plugin_dir_path( __FILE__ ) . 'engine/settings-page.php';

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
/* if ( is_admin() ) {
include_once plugin_dir_path( __FILE__ ).'modules/site-no-comments.php';
} */

// Options

$baglama_tools_options = get_option('baglama_tools_option_name');
if ($baglama_tools_options !== null && $baglama_tools_options !== false) {
    if (baglama_check_valid_option("baglama_tools_comments_function_cbx1")) {
        // -- Comments
        require_once __DIR__ . '/modules/site-no-comments.php';
    }
    if (baglama_check_valid_option("baglama_tools_feeds_function_cbx2")) {
        // -- RSS Feeds
        require_once __DIR__ . '/modules/content-rss-feeds-no-links.php';
    }
    if (baglama_check_valid_option("baglama_tools_authors_function_cbx3")) {
        // -- Author archives
        require_once __DIR__ . '/modules/content-author-archive.php';
    }
} else {
    // -- Empty options
    $baglama_tools_options = array();
    $baglama_tools_options['baglama_plugin_version'] = $baglama_plugin_version;
    update_option('baglama_tools_option_name', $baglama_tools_options);
}

// WP Extensions page: add the settings and git links 
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'baglama_public_links_settings');
function baglama_public_links_settings($links)
{
    $new = array(
        'baglama-links-settings' => sprintf(
            '<a href="%s">%s</a>',
            esc_url(admin_url('options-general.php?page=baglama-tools')),
            esc_html__('Settings', 'baglama')
        ),
        'baglama-links-git' => sprintf(
            '<a href="%s" target="_blank">%s</a>',
            'https://codeberg.org/_aris/baglama',
            esc_html__('Codeberg', 'baglama')
        ),
    );
    return array_merge($new, $links);
}
