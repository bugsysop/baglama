<?php
add_filter( 'jpeg_quality', 'baglama_jpeg_quality' );
function baglama_jpeg_quality() { return 100; }

add_filter( 'sanitize_file_name', 'baglama_sanitize_file_name', 10, 1 );
function baglama_sanitize_file_name( $filename ) {

	$sanitized_filename = remove_accents( $filename ); // Convert to ASCII

	// Standard replacements
	$invalid = array(
		' '   => '-',
		'%20' => '-',
		'_'   => '-',
	);
	$sanitized_filename = str_replace( array_keys( $invalid ), array_values( $invalid ), $sanitized_filename );
	$sanitized_filename = preg_replace('/[^A-Za-z0-9-\. ]/', '', $sanitized_filename); 	// Remove all non-alphanumeric except '.'
	$sanitized_filename = preg_replace('/\.(?=.*\.)/', '', $sanitized_filename); 		// Remove all but last '.'
	$sanitized_filename = preg_replace('/-+/', '-', $sanitized_filename); 				// Replace any more than one '-' in a row
	$sanitized_filename = str_replace('-.', '.', $sanitized_filename); 					// Remove last '-' if at the end
	$sanitized_filename = strtolower( $sanitized_filename ); 							// Lowercase

	return $sanitized_filename;
}

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
