<?php
/**
 * Admin UI
 */
function suse_id_admin_page()
{
  /**
   * JS in the admin UI that will take care do AJAX
   */
  function suse_id_admin_ui_assets()
  {
    $filepath = plugins_url('../assets/js/admin_ui.js', __FILE__);
    wp_enqueue_script('suse_id_admin_ui', $filepath, false);

    $filepath = plugins_url('../assets/css/style.css', __FILE__);
    wp_enqueue_style('suse_id_admin_ui', $filepath, false);
  }
  add_action('admin_enqueue_scripts', 'suse_id_admin_ui_assets');

  /**
   * Admin UI controller
   * It registers a separate settings group for the plugin.
   * Sanitizes and validates the config settings upon changes.
   *
   * Also see ../templates/suse_id_admin_ui.php
   */
  function suse_id_settings() {
    $prefix = 'suse_id';
    $settings_domain = $prefix . '_plugin_settings';
    $current_user = wp_get_current_user();

    // sanitize and validate POST vars
    // TODO: return error message(s) if some validation fails
    if (isset($_POST, $_POST[$settings_domain],
      $_POST[$settings_domain]['login_page'],
      $_POST[$settings_domain]['myaccount_page'],
      $_POST[$settings_domain]['sso_login_url'],
      $_POST[$settings_domain]['account_create_url'],
      $_POST[$settings_domain]['account_update_url'],
      $_POST[$settings_domain]['password_reset_url']))
    {
      // suse_id_login_page
      // 1. must have value 0 or must be a valid page in Wordpress
      $raw = $_POST[$settings_domain]['login_page'];
      $page = get_post($raw);
      if ($raw == 0 || $page)
      {
        update_option($prefix . '_login_page', $raw);
      }

      // suse_id_myaccount_page
      // 1. must have value 0 or must be a valid page in Wordpress
      $raw = $_POST[$settings_domain]['myaccount_page'];
      $page = get_post($raw);
      if ($raw == 0 || $page)
      {
        update_option($prefix . '_myaccount_page', $raw);
      }

      // suse_id_sso_login_url
      // 1. it must be a valid URL
      // 2. length: max 255 bytes
      $raw = esc_url_raw($_POST[$settings_domain]['sso_login_url']);
      $sanitized = filter_var($raw, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if ($sanitized !== FALSE && strlen($sanitized) <= 255)
      {
        update_option($prefix . '_sso_login_url', $sanitized);
      }

      // suse_id_login_label
      // 1. length: max 255 bytes
      $sanitized = sanitize_text_field($_POST[$settings_domain]['login_label']);
      if (strlen($sanitized) <= 255)
      {
        update_option($prefix . '_login_label', $sanitized);
      }

      // suse_id_account_create_url
      // 1. it must be a valid URL
      // 2. length: max 255 bytes
      $raw = esc_url_raw($_POST[$settings_domain]['account_create_url']);
      $sanitized = filter_var($raw, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if ($sanitized !== FALSE && strlen($sanitized) <= 255)
      {
        update_option($prefix . '_account_create_url', $sanitized);
      }

      // suse_id_account_update_url
      // 1. it must be a valid URL
      // 2. length: max 255 bytes
      $raw = esc_url_raw($_POST[$settings_domain]['account_update_url']);
      $sanitized = filter_var($raw, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if ($sanitized !== FALSE && strlen($sanitized) <= 255)
      {
        update_option($prefix . '_account_update_url', $sanitized);
      }

      // suse_id_password_reset_url
      // 1. it must be a valid URL
      // 2. length: max 255 bytes
      $raw = esc_url_raw($_POST[$settings_domain]['password_reset_url']);
      $sanitized = filter_var($raw, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if ($sanitized !== FALSE && strlen($sanitized) <= 255)
      {
        update_option($prefix . '_password_reset_url', $sanitized);
      }
    }

    get_option($prefix . '_login_page') ? $selected = get_option($prefix . '_login_page') : $selected = 0;
    $login_page_args = array(
      'echo' => 0,
      'name' => $settings_domain . '[login_page]',
      'value_field' => 'ID',
      'selected' => $selected,
      'show_option_none' => __('no_page', 'suse_id_helper'),
      'option_none_value' => '0'
    );
    $login_page = wp_dropdown_pages($login_page_args);

    get_option($prefix . '_myaccount_page') ? $selected = get_option($prefix . '_myaccount_page') : $selected = 0;
    $myaccount_page_args = array(
      'echo' => 0,
      'name' => $settings_domain . '[myaccount_page]',
      'value_field' => 'ID',
      'selected' => $selected,
      'show_option_none' => __('no_page', 'suse_id_helper'),
      'option_none_value' => '0'
    );
    $myaccount_page = wp_dropdown_pages($myaccount_page_args);

    $settings = array(
      'login_page' => $login_page,
      'myaccount_page' => $myaccount_page,
      'sso_login_url' => get_option($prefix . '_sso_login_url'),
      'login_label' => get_option($prefix . '_login_label'),
      'account_create_url' => get_option($prefix . '_account_create_url'),
      'account_update_url' => get_option($prefix . '_account_update_url'),
      'password_reset_url' => get_option($prefix . '_password_reset_url'),
      'logout_url' => get_option($prefix . '_logout_url')
    );

    include plugin_dir_path(__FILE__) . '../templates/admin_ui.php';
  }

  add_options_page(
    'SUSE ID Helper',
    'SUSE ID Helper',
    'manage_options',
    'suse_id_settings',
    'suse_id_settings'
  );
}
add_action('admin_menu', 'suse_id_admin_page');

?>