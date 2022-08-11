<?php
add_filter( 'jpeg_quality', 'tmprs_jpeg_quality' );
function tmprs_jpeg_quality() { return 100; }
add_filter( 'sanitize_file_name', 'mb_strtolower' );

/* 
 * Disable Media Permalink - 1.0
 * https://wordpress.org/plugins/disable-media-permalink-by-hardweb-it/
 */
add_filter( 'rewrite_rules_array', 'tmprs_cleanup_attachment_permalink' );
function tmprs_cleanup_attachment_permalink( $rules ) {
	foreach ( $rules as $regex => $query ) {
		if ( strpos( $regex, 'attachment' ) || strpos( $query, 'attachment' ) ) {
			unset( $rules[ $regex ] );
		}
	}
	return $rules;
}
add_filter( 'attachment_link', 'tmprs_cleanup_attachment_link' );
function tmprs_cleanup_attachment_link( $link ) {
	return;
}
