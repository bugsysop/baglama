<?php
/*
 * Origin: Slash Admin
 * Plugin URI: http://wordpress.org/plugins/slash-admin/
 */

// Remove title prefix from archives pages
add_filter( 'get_the_archive_title', 'tmprs_remove_category', 10, 2 );
function tmprs_remove_category( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	}
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	if ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	if ( is_tag() ) {
		$title = single_tag_title( '', false );
	}

	return $title;
}
