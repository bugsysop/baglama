<?php
add_filter('send_password_change_email', '__return_false');
remove_action('after_password_reset', 'wp_password_change_notification');

