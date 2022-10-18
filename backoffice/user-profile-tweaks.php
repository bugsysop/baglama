<?php
/*
 * Remove useless option from user profile
 * Note: hidden with CSS
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