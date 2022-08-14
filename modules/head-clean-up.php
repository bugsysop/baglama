<?php
add_filter('the_generator', 'baglama_remove_version');
function baglama_remove_version() {return '';}
add_filter('style_loader_src', 'baglama_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'baglama_remove_version_scripts_styles', 9999);
function baglama_remove_version_scripts_styles($src){if(strpos($src,'ver=')){$src=remove_query_arg('ver',$src);}return $src;}
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

