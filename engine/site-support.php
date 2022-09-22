<?php
// Post formats
add_action('after_setup_theme', 'baglama_remove_post_formats', 15);
function baglama_remove_post_formats() { remove_theme_support('post-formats'); }

// Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
// Remove WP Emoji DNS prefetch from page head
add_filter( 'emoji_svg_url', '__return_false' );
