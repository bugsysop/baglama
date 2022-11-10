<?php
/*
 * Bağlama Settings
 * Option -- Disable author archives page
 *
 * Source: Disable author archives Plugin - 1.3.1
 * https://wordpress.org/plugins/disable-author-archives
 *
 */
add_action( 'template_redirect',function(){if(isset($_GET['author'])||is_author()){global $wp_query;$wp_query->set_404();status_header(404);nocache_headers();}},1);
add_filter( 'user_row_actions',function($actions){if(isset($actions['view']))unset($actions['view']);return $actions;},PHP_INT_MAX,2);
add_filter( 'author_link', function() { return '#'; }, PHP_INT_MAX );
add_filter( 'the_author_posts_link', '__return_empty_string', PHP_INT_MAX );
