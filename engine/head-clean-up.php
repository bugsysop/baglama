<?php
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_null' );
add_filter('style_loader_src', 'baglama_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'baglama_remove_version_scripts_styles', 9999);
function baglama_remove_version_scripts_styles($src){if(strpos($src,'ver=')){$src=remove_query_arg('ver',$src);}return $src;}
remove_action( 'wp_head', 'wp_resource_hints', 2 );
// @link https://shortpixel.com/blog/cleaning-the-wordpress-head-and-improving-performance/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);
