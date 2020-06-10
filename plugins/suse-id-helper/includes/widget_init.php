<?php

/**
 * Adds a widget area to the myaccount page (if it exists)
 */
function myaccount_actions_widget_area( $content ) {
  global $pagenow;

	if ( is_singular( array( 'post', 'page' ) ) && is_active_sidebar( 'myaccount-actions-sidebar' ) && is_main_query() ) {
		dynamic_sidebar('myaccount-actions-sidebar');
	}
	return $content;
}
add_filter('the_content', 'myaccount_actions_widget_area');

/**
 * Register the widget area
 */
function register_myaccount_actions_widget_area() {
  register_sidebar( array(
    'id'          => 'myaccount-actions-sidebar',
    'name'        => 'MyAccount Action Widget Sidebar',
    'description' => __('MyAccount Actions', 'suse_id_helper'),
  ));
}
add_action('init', 'register_myaccount_actions_widget_area');

/**
 * Account Update Button - custom widget
 */
require_once( plugin_dir_path(__FILE__) . 'account_update_widget.php' );
function account_update_widget_init() {
	register_widget('AccountUpdateBtn_Widget');
}
add_action( 'widgets_init', 'account_update_widget_init' );

?>