<?php
/*
 * Not active by default
 * Remove only the feeds links in page head, but they are still accessible
 * To activate, add this call to main plugin file:
 *     include_once plugin_dir_path( __FILE__ ).'modules/content-rss-feeds-no-links.php';
 * It's also a good idea to remove or (better) comment this line:
 *     // include_once plugin_dir_path( __FILE__ ).'modules/content-rss-feeds.php';
 */
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
