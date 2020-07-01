<?php
/**
 * Plugin Name: SUSE ID Helper
 * Description: Helps admins to configure SUSE ID management related settings. 
 * Authors: SUSE Developer Community Team
 * Author URI: https://github.com/SUSE-Developer-Community/explore.suse.dev
 * Version: 0.1
 * Text Domain: suse_id
 *
 * Copyright: (c) 2020 SUSE
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */
defined('ABSPATH') or exit;

// include files
include plugin_dir_path(__FILE__) . 'includes/admin.php';
include plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

/**
 * Language files
 */
function suse_id_load_locales()
{
  $l10n_domain = 'suse_id_helper';
  $locale = apply_filters('plugin_locale', get_locale(), $l10n_domain);
  $a = load_plugin_textdomain($l10n_domain, FALSE, plugin_basename(dirname(__FILE__)) . '/languages/');
}
add_action('init', 'suse_id_load_locales');

/**
 * Hook this to the activation phase
 */
function suse_id_plugin_activate()
{
  add_option('suse_id_plugin_do_activation_redirect', true);

  if (! function_exists ('register_post_status'))
  {
    deactivate_plugins(basename(dirname(__FILE__)) . '/' . basename(__FILE__));
    exit;
  }
  update_option('suse_id_plugin_activation_message', 0);
}
register_activation_hook(__FILE__, 'suse_id_plugin_activate');

/**
 * Links to the Settings menu
 */
function suse_id_add_setup_link($links, $file)
{
  static $suse_id_helper = null;

  if (is_null($suse_id_helper))
  {
    $suse_id_helper = plugin_basename(__FILE__);
  }

  if ($file == $suse_id_helper)
  {
    $settings_link = '<a href="options-general.php?page=suse_id_settings">' . __('suse_id_setup', 'suse_id_helper') . '</a>';
    array_unshift ($links, $settings_link);
  }
  return $links;
}
add_filter('plugin_action_links', 'suse_id_add_setup_link', 10, 2);

/**
 * Add custom login link if that option has been saved to this plugin
 */
function custom_login() {
  global $pagenow;
  $login = get_option('suse_id_sso_login_url');

  if( $login != '' && 'wp-login.php' == $pagenow && ! is_user_logged_in() ) {
    wp_redirect($login);
    exit();
  }
}
add_action('init', 'custom_login');