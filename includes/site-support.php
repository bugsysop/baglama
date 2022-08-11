<?php
add_action('after_setup_theme', 'tmprs_remove_post_format', 15);
function tmprs_remove_post_format() { remove_theme_support('post-formats'); }
// Bye bye JQuery
add_action('wp_enqueue_scripts', 'tmprs_deregister_jquery');
function tmprs_deregister_jquery() { if ( !is_admin() ) {wp_deregister_script('jquery');} } 
// Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

