<?php
/**
 * 
 * Adds onboarding capabilities to SUSE Cloud Application Platform.
 *
 */

/**
 * Admin UI for CAP sandbox onboarding
 */
function cap_admin_page() {
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
      $_POST[$settings_domain]['cap_sandbox_onboarding_api_endpoint'],
      $_POST[$settings_domain]['cap_sandbox_onboarding_api_username'],
      $_POST[$settings_domain]['cap_sandbox_onboarding_api_password'],
      $_POST[$settings_domain]['cap_sandbox_tandc_page'],
      $_POST[$settings_domain]['cap_sandbox_success_page'],
      $_POST[$settings_domain]['cap_sandbox_fail_page'],
      $_POST[$settings_domain]['cap_sandbox_exists_page'],
      $_POST[$settings_domain]['cap_sandbox_button_text'],
      $_POST[$settings_domain]['cap_sandbox_loggedout_text']))
    {
      // cap_sandbox_onboarding_api_endpoint
      // 1. it must be a valid URL
      // 2. length: max 255 bytes
      $raw = esc_url_raw($_POST[$settings_domain]['cap_sandbox_onboarding_api_endpoint']);
      $sanitized = filter_var($raw, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
      if ($sanitized !== FALSE && strlen($sanitized) <= 255)
      {
        update_option('cap_sandbox_onboarding_api_endpoint', $sanitized);
      }

      // cap_sandbox_onboarding_api_username
      // 1. length: max 20 bytes
      $raw = $_POST[$settings_domain]['cap_sandbox_onboarding_api_username'];
      $sanitized = $raw;
      if (strlen($sanitized) <= 20)
      {
        update_option('cap_sandbox_onboarding_api_username', $sanitized);
      }

      // cap_sandbox_onboarding_api_password
      // 1. length: max 100 bytes
      $raw = $_POST[$settings_domain]['cap_sandbox_onboarding_api_password'];
      $sanitized = $raw;
      if (strlen($sanitized) <= 100)
      {
        update_option('cap_sandbox_onboarding_api_password', $sanitized);
      }

      // cap_sandbox_show_passive_accounts
      // 1. values: 0 or 1
      $raw = $_POST[$settings_domain]['cap_sandbox_show_passive_accounts'];
      isset($raw) ? $value = 1 : $value = 0;
      update_option('cap_sandbox_show_passive_accounts', $value);

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
      'cap_sandbox_onboarding_api_endpoint' => get_option('cap_sandbox_onboarding_api_endpoint'),
      'cap_sandbox_onboarding_api_username' => get_option('cap_sandbox_onboarding_api_username'),
      'cap_sandbox_onboarding_api_password' => get_option('cap_sandbox_onboarding_api_password'),
      'cap_sandbox_show_passive_accounts' => get_option('cap_sandbox_show_passive_accounts'),
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
function cap_user_ui_assets() {
  $filepath = plugins_url('../assets/js/cap_user_ui.js', __FILE__);
  wp_enqueue_script('cap_user_ui', $filepath, false);
	wp_localize_script('cap_user_ui', 'ajax_object', 
    array(
      'ajax_url' => admin_url('admin-ajax.php')
  ));

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

  $cap_onboarding_url = get_option("cap_sandbox_onboarding_api_endpoint");

  $success_url = urlencode(get_post(get_option("cap_sandbox_success_page"))->guid);
  $fail_url = urlencode(get_post(get_option("cap_sandbox_fail_page"))->guid);
  $exists_url = urlencode(get_post(get_option("cap_sandbox_exists_page"))->guid);
  $btn_txt = get_option("cap_sandbox_button_text");
  $form_url = $cap_onboarding_url . "?success=" . $success_url . "&fail=" . $fail_url . "&exists=" . $exists_url;

  ob_start();

  if ($current_user->ID != 0) {
    // logged in to Wordpress
    $filepath = plugins_url('../assets/js/cap_user_ui.js', __FILE__);
    wp_enqueue_script('cap_user_ui', $filepath, false);
      
    $tandc_page_guid = get_post(get_option("cap_sandbox_tandc_page"))->guid;
    require_once plugin_dir_path(__FILE__) . '../templates/cap_user_ui_logged_in.php';
  } else {
    // logged out from Wordpress
    require_once plugin_dir_path(__FILE__) . '../templates/cap_user_ui_logged_out.php';
  }

  $content = ob_get_clean();
  return $content;
}
add_shortcode('onboarding_cap', 'form_shortcode');

/**
 * Forms an authentication header that is to be used with all calls for the
 * CAP Sandbox Onboarding API
 */
function get_auth_header() {
  $settings = array(
    'username' => get_option("cap_sandbox_onboarding_api_username"), 
    'password' => get_option("cap_sandbox_onboarding_api_password")
  );
  // todo: check if settings are present...
  $hash = password_hash($settings['password'], PASSWORD_BCRYPT);

  $auth = "Basic " . base64_encode($settings['username'] . ':' . $settings['password']);

  return $auth;
}

/**
 * AJAX handler for creating a new CAP Sandbox account
 *
 * Implements the CAP Sandbox Onboarding API -> 
 *   POST /user/:email/:userName
 */
function create_sandbox_account($atts) {
	global $wpdb;

  $current_user = wp_get_current_user();
  $email = ($current_user->ID == 0) ? '' : $current_user->user_email;
  $account = $password = '';

  $result = array(
    'code' => 1,
    'capmessage' => '',
    'response' => __('cap_sandbox_account_request_failed', 'sandbox_onboarding')
  );

  if ($email != '') {
    if (isset($_POST['account']) && isset($_POST['password'])) {
      $account = $_POST['account'];
      $password = $_POST['password'];

      $auth = get_auth_header();
      $url = get_option("cap_sandbox_onboarding_api_endpoint") . 'user/' . base64_encode($email);
      $url .= '/' . $account;

      $body = array(
        'firstName' => $current_user->first_name,
        'lastName' => $current_user->last_name,
        'password' => $password
      );

      $args = array(
        'method' => 'POST',
        'sslverify' => false,
        'headers' => array(
          'Content-Type' => 'application/json',
          'Authorization' => $auth
        ),
        'body' => json_encode($body)
      );

      $from_sandbox = wp_remote_request($url, $args);

      $result = array(
        'code' => $from_sandbox['response']['code'],
        'capmessage' => $from_sandbox['response']['message'],
      );

      if ($result['code'] == 204) {
        $result['response'] = __('cap_sandbox_account_request_ok', 'sandbox_onboarding');
      }
    }
  }

  echo json_encode($result);

	wp_die();
}
add_action( 'wp_ajax_create_sandbox_account', 'create_sandbox_account' );


/**
 * AJAX handler for listing CAP sandbox accounts
 * associated with the current user's email
 *
 * Implements the CAP Sandbox Onboarding API -> 
 *   GET /user/:email
 */
function get_sandbox_accounts($atts) {
	global $wpdb;

  $current_user = wp_get_current_user();
  $email = ($current_user->ID == 0) ? '' : $current_user->user_email;

  $result = array(
    'code' => 1,
    'rows' => array(),
    'response' => __('cap_sandbox_get_accounts_failed', 'sandbox_onboarding')
  );

  if ($email != '') {
    $auth = get_auth_header();
    $url = get_option("cap_sandbox_onboarding_api_endpoint") . 'user/' . base64_encode($email);
    $args = array(
      'method' => 'GET',
      'sslverify' => false,
      'headers' => array(
        'Content-Type' => 'application/json',
        'Authorization' => $auth
    ));

    $from_sandbox = wp_remote_request($url, $args);
    $json = json_decode($from_sandbox['body']);

    // parse each line so that the UI does not have to deal with them
    foreach ($json as &$account) {
      // skip inactive accounts of the plugin was configured so
      if ($account->active == false && get_option("cap_sandbox_show_passive_accounts") == false) {
        continue;
      }
      
      $format = 'Y-m-d H:i:s';
      $lastLogonTime = __('cap_sandbox_account_not_used', 'sandbox_onboarding');
      if ($account->lastLogonTime) {
        $lastLogonTime = date($format, substr($account->lastLogonTime, 0, 10));
      }

      $passwordLastModified = date($format, strtotime($account->passwordLastModified));

      $item = array(
        'active' => $account->active,
        'userName' => $account->userName,
        'lastLogonTime' => $lastLogonTime,
        'passwordLastModified' => $passwordLastModified
      );

      $result['rows'][] = $item;
      $result['code'] = 0;
    }
  }

  echo json_encode($result);

	wp_die();
}
add_action( 'wp_ajax_get_sandbox_accounts', 'get_sandbox_accounts' );

/**
 * AJAX handler for 
 *
 * Implements the CAP Sandbox Onboarding API -> 
 *   PUT /user/:email/:userName/password
 */
function change_sandbox_password($atts) {
	global $wpdb;

  $current_user = wp_get_current_user();
  $email = ($current_user->ID == 0) ? '' : $current_user->user_email;
  $account = $password = '';

  $result = array(
    'code' => 1,
    'capmessage' => '',
    'response' => __('cap_sandbox_password_change_failed', 'sandbox_onboarding')
  );

  if ($email != '') {
    if (isset($_POST['account']) && isset($_POST['password'])) {
      $account = $_POST['account'];
      $password = $_POST['password'];

      $auth = get_auth_header();
      $url = get_option("cap_sandbox_onboarding_api_endpoint") . 'user/' . base64_encode($email);
      $url .= '/' . $account . '/password';

      $body = '{"password":"'. $password .'"}';

      $args = array(
        'method' => 'PUT',
        'sslverify' => false,
        'headers' => array(
          'Content-Type' => 'application/json',
          'Authorization' => $auth
        ),
        'body' => $body
      );

      $from_sandbox = wp_remote_request($url, $args);

      $result = array(
        'code' => $from_sandbox['response']['code'],
        'capmessage' => $from_sandbox['response']['message'],
      );

      if ($result['code'] == 204) {
        $result['response'] = __('cap_sandbox_password_change_ok', 'sandbox_onboarding');
      }
    }
  }

  echo json_encode($result);

	wp_die();
}
add_action( 'wp_ajax_change_sandbox_password', 'change_sandbox_password' );

?>