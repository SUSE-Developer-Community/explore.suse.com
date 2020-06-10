<?php

$i18n_domain = 'suse_id_helper';

/**
 *
 * If the user is logged out then the code provides link to the SSO URL
 * that is configurable in the admin settings of the plugin.
 *
 * If the user is logged in then the code provides link to the myaccount page
 * that is configurable in the admin settings of the plugin.
 *
 */
function sso_login_shortcode($atts) {
  $url = '';
  $label = '';
  $content = '';

  $current_user = wp_get_current_user();

  if ($current_user->ID != 0) {
    // logged in
    // show the my account page
    $url = (get_option("suse_id_myaccount_page") !== null) ? get_page_link(get_option("suse_id_myaccount_page")) : '/login';
    $label = $current_user->display_name;
  } else {
    // logged out
    $url = (get_option("suse_id_sso_login_url") !== null) ? get_option("suse_id_sso_login_url") : '/login';
    $label = (is_array($atts) && array_key_exists('label', $atts)) ? $atts['label'] : __('sso_login_login_label', $i18n_domain);
  }

  $content = '<a href="' . $url . ' ">' . $label . '</a>';

  return $content;
}

/**
 *
 * Provides the link for the account update page that is configurable in the
 * admin settings of the plugin.
 *
 * Only provides content if the user is logged in.
 *
 */
function account_update_url($atts) {
  $url = '';
  $label = '';
  $content = '';

  $current_user = wp_get_current_user();

  if ($current_user->ID != 0) {
    // logged in
    $url = (get_option("suse_id_account_update_url") !== null) ? get_option("suse_id_account_update_url") : '/my-account';
    $label = (is_array($atts) && array_key_exists('label', $atts)) ? $atts['label'] : $current_user->user_nicename;

    $content = '<a href="' . $url . ' ">' . $label . '</a>';
  }

  return $content;
}

/**
 *
 * Provides the link for the account creation page that is configurable in the
 * admin settings of the plugin.
 *
 * Only provides content if the user is logged out.
 *
 */
function account_create_url($atts) {
  $url = '';
  $label = '';
  $content = '';

  $current_user = wp_get_current_user();

  if ($current_user->ID == 0) {
    // logged out
    $url = (get_option("suse_id_account_create_url") !== null) ? get_option("suse_id_account_create_url") : '';
    $label = (is_array($atts) && array_key_exists('label', $atts)) ? $atts['label'] : __('account_create_url_label', $i18n_domain);

    $content = '<a href="' . $url . ' ">' . $label . '</a>';
  }

  return $content;
}

/**
 *
 * Provides the link for the password reset page that is configurable in the
 * admin settings of the plugin.
 *
 */
function password_reset_url($atts) {
  $url = '';
  $label = '';
  $content = '';

  $current_user = wp_get_current_user();

  $url = (get_option("suse_id_password_reset_url") !== null) ? get_option("suse_id_password_reset_url") : '';
  $label = (is_array($atts) && array_key_exists('label', $atts)) ? $atts['label'] : __('password_reset_url_label', $i18n_domain);

  $content = '<a href="' . $url . ' ">' . $label . '</a>';

  return $content;
}

/**
 *
 * Provides the link for logout that is configurable in the admin settings of
 * the plugin.
 *
 * Only provides content if the user is logged in.
 *
 */
function logout_url($atts) {
  $label = '';
  $content = '';

  $current_user = wp_get_current_user();

  if ($current_user->ID != 0) {
    // logged in
    $label = (is_array($atts) && array_key_exists('label', $atts)) ? $atts['label'] : __('logout_url_label', $i18n_domain);
    $content = '<a href="' . esc_url(wp_logout_url()) . '">' . $label . '</a>';
  }

  return $content;
}

/**
 * Register all shortcodes defined above during init
 */
function register_shortcodes() {
  add_shortcode('sso_login_shortcode', 'sso_login_shortcode');
  add_shortcode('account_create_url', 'account_create_url');
  add_shortcode('account_update_url', 'account_update_url');
  add_shortcode('password_reset_url', 'password_reset_url');
  add_shortcode('logout_url', 'logout_url');
}
add_action( 'init', 'register_shortcodes');
?>