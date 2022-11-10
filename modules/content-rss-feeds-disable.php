<?php
/*
 * Bağlama Settings
 * Option -- Disable support for all feeds
 *
 */

// All feeds requests redirect to home
 add_action('do_feed', 'baglama_rss_feeds_disable', 1);
 add_action('do_feed_rdf', 'baglama_rss_feeds_disable', 1);
 add_action('do_feed_rss', 'baglama_rss_feeds_disable', 1);
 add_action('do_feed_rss2', 'baglama_rss_feeds_disable', 1);
 add_action('do_feed_atom', 'baglama_rss_feeds_disable', 1);
 add_action('do_feed_rss2_comments', 'baglama_rss_feeds_disable', 1);
 add_action('do_feed_atom_comments', 'baglama_rss_feeds_disable', 1);
 function baglama_rss_feeds_disable() {
     wp_redirect( home_url(), 301 ); exit;
 }
