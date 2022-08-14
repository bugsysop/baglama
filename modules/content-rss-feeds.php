<?php
add_filter( 'the_excerpt_rss', 'baglama_thumbnails_in_rss' );
add_filter( 'the_content_feed', 'baglama_thumbnails_in_rss' );
function baglama_thumbnails_in_rss( $content ) {
	global $post;
	if ( has_post_thumbnail( $post->ID ) ) {
		$content = '<figure>' . get_the_post_thumbnail( $post->ID, 'medium' ) . '</figure>' . $content;
	}
	return $content;
}

add_filter('posts_where', 'baglama_publish_later_on_feed');
function baglama_publish_later_on_feed($where) {
    global $wpdb;
    if ( is_feed() ) {
        // timestamp in WP-format
        $now = gmdate('Y-m-d H:i:s');
        // value for wait; + device
        $wait = '10'; // integer
        // http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_timestampdiff
        $device = 'MINUTE'; //MINUTE, HOUR, DAY, WEEK, MONTH, YEAR	
        // add SQL-sytax to default $where
        $where .= " AND TIMESTAMPDIFF($device, $wpdb->posts.post_date_gmt, '$now') > $wait ";
    }
    return $where;
}


