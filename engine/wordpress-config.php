<?php
<?php
// Removing capital P dangit
remove_filter( 'the_title', 'capital_P_dangit', 11 );
remove_filter( 'the_content', 'capital_P_dangit', 11 );
remove_filter( 'comment_text', 'capital_P_dangit', 31 );

// Bye bye JQuery from frontend
add_action('wp_enqueue_scripts', 'baglama_deregister_jquery');
function baglama_deregister_jquery() { if ( !is_admin() ) {wp_deregister_script('jquery');} } 

// Defined in wp-config.php - Here in case
// if (!defined('WP_POST_REVISIONS')) define('WP_POST_REVISIONS', false);
