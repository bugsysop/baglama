<?php
// User password change notification
add_filter('send_password_change_email', '__return_false');
remove_action('after_password_reset', 'wp_password_change_notification');
// Auto-update notifications for plugins.
add_filter('auto_plugin_update_send_email', '__return_false');
// Auto-update notifications for themes.
add_filter('auto_theme_update_send_email', '__return_false');

