<?php
/*
 * NOT ACTIVE
 */

add_action('after_setup_theme', 'baglama_admin_bar_super_user_only');
function baglama_admin_bar_super_user_only() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}