<?php
/**
 * Plugin Name: Sandbox Onboarding
 * Description: Adds onboarding capabilities to various developer sandboxes.
 * Authors: SUSE Developer Community Team
 * Author URI: https://github.com/SUSE-Developer-Community/explore.suse.dev
 * Version: 0.1
 * Text Domain: sandbox_onboarding
 *
 * Copyright: (c) 2020 SUSE
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */
defined('ABSPATH') or exit;

// include all sandbox connectors; for now we only have cap
include plugin_dir_path(__FILE__) . 'includes/cap.php';

/**
 * Language files
 */
function load_locales()
{
  $l10n_domain = 'sandbox_onboarding';
  $locale = apply_filters('plugin_locale', get_locale(), $l10n_domain);
  load_plugin_textdomain($l10n_domain, FALSE, plugin_basename(dirname(__FILE__)) . '/languages/');
}
add_action('init', 'load_locales');

/**
 * Hook this to the activation phase
 */
function sandbox_onboarding_plugin_activate()
{
  add_option('sandbox_onboarding_plugin_do_activation_redirect', true);

  if (! function_exists ('register_post_status'))
  {
    deactivate_plugins(basename(dirname(__FILE__)) . '/' . basename(__FILE__));
    exit;
  }
  update_option('sandbox_onboarding_plugin_activation_message', 0);
}
register_activation_hook(__FILE__, 'sandbox_onboarding_plugin_activate');

/**
 * Links to the Settings menu
 */
function sandbox_onboarding_add_setup_link($links, $file)
{
  static $sandbox_onboarding = null;

  if (is_null ($sandbox_onboarding))
  {
    $sandbox_onboarding = plugin_basename(__FILE__);
  }

  if ($file == $sandbox_onboarding)
  {
    $settings_link = '<a href="users.php?page=sandbox-onboarding-settings">' . _e('sandbox_setup', 'sandbox_onboarding') . '</a>';
    array_unshift ($links, $settings_link);
  }
  return $links;
}
add_filter('plugin_action_links', 'sandbox_onboarding_add_setup_link', 10, 2);
