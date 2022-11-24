<?php 
/*
 * Disable the auto-generated WP Sitemaps
 *
 * Note: this is not active
 * Todo: make it an option
 */

add_filter('wp_sitemaps_enabled', '__return_false');
