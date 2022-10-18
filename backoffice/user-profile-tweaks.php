<?php
/*
 * Simplify user profile admin
 */
add_action( 'admin_head', function(){
    ob_start(); ?>
    <style>
        #your-profile > h2,
        .user-rich-editing-wrap,
        .user-syntax-highlighting-wrap,
        .user-comment-shortcuts-wrap,
        .user-admin-bar-front-wrap {
            display: none;
        }
    </style>
    <?php ob_end_flush();
});

/*
 * Remove the color picker from the user profile admin
 * Note: compatibility only with WP 6.0 ans later
 * https://wordpress.org/support/topic/remove-color-picker-from-profile-edit-screen-in-wp-6-0/
 */
add_action( 'admin_head-profile.php', 'baglama_remove_admin_color_scheme_picker' );
function baglama_remove_admin_color_scheme_picker() {
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
}
