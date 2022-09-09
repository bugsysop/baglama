<?php
add_filter( 'jpeg_quality', 'baglama_jpeg_quality' );
function baglama_jpeg_quality() { return 100; }
add_filter( 'sanitize_file_name', 'mb_strtolower' );

/* 
 * Disable Media Permalink - 1.0
 * @link https://wordpress.org/plugins/disable-media-permalink-by-hardweb-it/
 */
add_filter( 'rewrite_rules_array', 'baglama_cleanup_attachment_permalink' );
function baglama_cleanup_attachment_permalink( $rules ) {
	foreach ( $rules as $regex => $query ) {
		if ( strpos( $regex, 'attachment' ) || strpos( $query, 'attachment' ) ) {
			unset( $rules[ $regex ] );
		}
	}
	return $rules;
}
add_filter( 'attachment_link', 'baglama_cleanup_attachment_link' );
function baglama_cleanup_attachment_link( $link ) {
	return;
}
