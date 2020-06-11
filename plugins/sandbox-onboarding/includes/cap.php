<?php
/**
 * 
 * Adds onboarding capabilities to SUSE Cloud Application Platform.
 *
 */

/**
 * Admin UI for CAP sandbox onboarding
 */
function cap_admin_page()
{
  /**
   * JS in the admin UI that will take care do AJAX
   */
  function cap_admin_ui_assets()
  {
    $filepath = plugins_url('../assets/js/cap_admin_ui.js', __FILE__);
    wp_enqueue_script('cap_admin_ui', $filepath, false);

    $filepath = plugins_url('../assets/css/sandbox_onboarding.css', __FILE__);
    wp_enqueue_style('cap_admin_ui', $filepath, false);
  }
  add_action('admin_enqueue_scripts', 'cap_admin_ui_assets');

  /**
   * Admin UI controller
   * It registers a separate settings group for the plugin.
   * Sanitizes and validates the config settings upon changes. 
   * 
   * Also see ../templates/cap_admin_ui.php
   */
  function cap_sandbox_settings() {
    $settings_domain = 'sandbox_onboarding_plugin_settings';
    $current_user = wp_get_current_user();

    // sanitize and validate POST vars
    // TODO: return error message(s) if some validation fails
    if (isset($_POST, $_POST[$settings_domain],
      $_POST[$settings_domain]['cap_sandbox_cap_onboarding_url'],
      $_POST[$settings_domain]['cap_sandbox_tandc_page'],
      $_POST[$settings_domain]['cap_sandbox_success_page'],
      $_POST[$settings_domain]['cap_sandbox_fail_page'],
      $_POST[$settings_domain]['cap_sandbox_exists_page'],
      $_POST[$settings_domain]['cap_sandbox_button_text'],
      $_POST[$settings_domain]['cap_sandbox_loggedout_text']))
    {
      // cap_onboarding_url
      // 1. it must be a valid URL
      // 2. length: max 255 bytes
      $raw = esc_url_raw($_POST[$settings_domain]['cap_sandbox_cap_onboarding_url']);
      $sanitized = filter_var($raw, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if ($sanitized !== FALSE && strlen($sanitized) <= 255)
      {
        update_option('cap_sandbox_cap_onboarding_url', $sanitized);
      }

      // cap_sandbox_tandc_page
      // 1. must be a valid page in Wordpress
      $raw = $_POST[$settings_domain]['cap_sandbox_tandc_page'];
      $page = get_post($raw);
      if ($page)
      {
        update_option('cap_sandbox_tandc_page', $raw);
      }

      // cap_sandbox_success_page
      // 1. must be a valid page in Wordpress
      $raw = $_POST[$settings_domain]['cap_sandbox_success_page'];
      $page = get_post($raw);
      if ($page)
      {
        update_option('cap_sandbox_success_page', $raw);
      }

      // cap_sandbox_fail_page
      // 1. must be a valid page in Wordpress
      $raw = $_POST[$settings_domain]['cap_sandbox_fail_page'];
      $page = get_post($raw);
      if ($page)
      {
        update_option('cap_sandbox_fail_page', $raw);
      }

      // cap_sandbox_exists_page
      // 1. must be a valid page in Wordpress
      $raw = $_POST[$settings_domain]['cap_sandbox_exists_page'];
      $page = get_post($raw);
      if ($page)
      {
        update_option('cap_sandbox_exists_page', $raw);
      }

      // cap_sandbox_button_text
      // 1. length: max 20 bytes
      $raw = $_POST[$settings_domain]['cap_sandbox_button_text'];
      $sanitized = $raw;
      if (strlen($sanitized) <= 25)
      {
        update_option('cap_sandbox_button_text', $sanitized);
      }

      // cap_sandbox_loggedout_text
      // 1. length: max 20 bytes
      $raw = $_POST[$settings_domain]['cap_sandbox_loggedout_text'];
      $sanitized = $raw;
      if (strlen($sanitized) <= 25)
      {
        update_option('cap_sandbox_loggedout_text', $sanitized);
      }
    }

    $tandc_page_args = array(
      'echo' => 0,
      'name' => 'sandbox_onboarding_plugin_settings[cap_sandbox_tandc_page]',
      'value_field' => 'ID',
      'selected' => get_option('cap_sandbox_tandc_page')
    );
    $tandc_page = wp_dropdown_pages($tandc_page_args);

    $success_page_args = array(
      'echo' => 0,
      'name' => 'sandbox_onboarding_plugin_settings[cap_sandbox_success_page]',
      'value_field' => 'ID',
      'selected' => get_option('cap_sandbox_success_page')
    );
    $success_page = wp_dropdown_pages($success_page_args);

    $fail_page_args = array(
      'echo' => 0,
      'name' => 'sandbox_onboarding_plugin_settings[cap_sandbox_fail_page]',
      'value_field' => 'ID',
      'selected' => get_option('cap_sandbox_fail_page')
    );
    $fail_page = wp_dropdown_pages($fail_page_args);

    $exists_page_args = array(
      'echo' => 0,
      'name' => 'sandbox_onboarding_plugin_settings[cap_sandbox_exists_page]',
      'value_field' => 'ID',
      'selected' => get_option('cap_sandbox_exists_page')
    );
    $exists_page = wp_dropdown_pages($exists_page_args);

    $settings = array(
      'cap_sandbox_cap_onboarding_url' => get_option('cap_sandbox_cap_onboarding_url'),
      'cap_sandbox_tandc_page' => $tandc_page,
      'cap_sandbox_success_page' => $success_page,
      'cap_sandbox_fail_page' => $fail_page,
      'cap_sandbox_exists_page' => $exists_page,
      'cap_sandbox_button_text' => get_option('cap_sandbox_button_text'),
      'cap_sandbox_loggedout_text' => get_option('cap_sandbox_loggedout_text')
    );

    include plugin_dir_path(__FILE__) . '../templates/cap_admin_ui.php';
  }

  add_options_page(
    'CAP Sandbox',
    'CAP Sandbox',
    'manage_options',
    'cap_sandbox_settings',
    'cap_sandbox_settings'
  );
}
add_action('admin_menu', 'cap_admin_page');

/**
 * Load assets (JS and CSS) that are used in the user UI
 */
function cap_user_ui_assets()
{
  $filepath = plugins_url('../assets/js/cap_user_ui.js', __FILE__);
  wp_enqueue_script('cap_user_ui', $filepath, false);

  $filepath = plugins_url('../assets/css/sandbox_onboarding.css', __FILE__);
  wp_enqueue_style('cap_user_ui', $filepath, false);
}
add_action('wp_enqueue_scripts', 'cap_user_ui_assets');

/**
 * The short code that adds a button to request sandbox account or tells the 
 * user to login before requesting the account.
 * 
 * This code also enforces the acceptance of the terms and conditions.
 *
 */
function form_shortcode($atts) {
  $content = '';

  $current_user = wp_get_current_user();

  $email = ($current_user->ID == 0) ? '' : $current_user->user_email;

  $cap_onboarding_url = get_option("cap_sandbox_cap_onboarding_url");
  $success_url = urlencode(get_post(get_option("cap_sandbox_success_page"))->guid);
  $fail_url = urlencode(get_post(get_option("cap_sandbox_fail_page"))->guid);
  $exists_url = urlencode(get_post(get_option("cap_sandbox_exists_page"))->guid);
  $btn_txt = get_option("cap_sandbox_button_text");
  $form_url = $cap_onboarding_url . "?success=" . $success_url . "&fail=" . $fail_url . "&exists=" . $exists_url;
  
  if ($current_user->ID != 0) {
    // logged in to Wordpress
    $filepath = plugins_url('../assets/js/cap_user_ui.js', __FILE__);
    wp_enqueue_script('cap_user_ui', $filepath, false);
  
    // TODO: refactor this to a template and pull that in here
    $tandc_page_guid = get_post(get_option("cap_sandbox_tandc_page"))->guid;
    $content = '<form class="sandbox" method="post" type="x-www-form-urlencoded" action="' . $form_url . '">';
    $content .= '<p class="username">';
    $content .= '<label for="username">' . __('cap_sandbox_username', 'sandbox_onboarding');
    $content .= '<span class="required">*</span></label>';
    $content .= '<input id="username" type="text" value="' . $current_user->user_login . '" name="userName" required="required" />';
    $content .= '</p>';
    $content .= '<p class="password">';
    $content .= '<label for="password">' . __('cap_sandbox_user_password', 'sandbox_onboarding');
    $content .= '<span class="required">*</span></label>';
    $content .= '<input id="password" type="password" value="" autocomplete="current-password" name="password" required="required" />';
    $content .= '</p>';    
    $content .= '<input type="hidden" value="' . $email . '" name="email" />';
    $content .= '<input type="hidden" value="' . $current_user->first_name . '" name="firstName" />';
    $content .= '<input type="hidden" value="' . $current_user->last_name . '" name="lastName" />';

    $content .= '<p class="consent submit">';
    $content .= '<input id="user_consent" name="user_consent" type="checkbox" />';
    $content .= '<label for="user_consent">';
    $content .= sprintf(__('cap_sandbox_user_consent_%s', 'sandbox_onboarding'), $tandc_page_guid);
    $content .= '</label>';
    $content .= '</p>';    
    $content .= '<p class="submit">';
    $content .= '<input id="request_account" disabled="true" type="submit" class="button-primary" value="' . $btn_txt . '" />';
    $content .= '</p>';
    $content .= '</form>';
  } else {
    // logged out from Wordpress
    $content = '<div class="create_acct">';
    $content .= do_shortcode( '[account_create_url label="Create a SUSE Account"]');
    $content .= '</div>';
    $content .= '<a href="/wp-login.php">';
    $content .= '<button class="sandbox">' . get_option("cap_sandbox_loggedout_text") . '</button>';
    $content .= '</a>';
  }

  return $content;
}
add_shortcode('onboarding_cap', 'form_shortcode');

?>