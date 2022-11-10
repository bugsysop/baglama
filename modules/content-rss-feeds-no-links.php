<?php
/*
 * Bağlama Settings
 * Option -- Hide all the feeds links in pages head
 *
 */
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
