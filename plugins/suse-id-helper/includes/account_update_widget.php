<?php

/**
 * account_update_btn_widget
 */
class AccountUpdateBtn_Widget extends WP_Widget {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct(
			'account_update_btn_widget',
			esc_html__('Account Update Button', 'suse_id_helper'), 
			array( 
        'description' => esc_html__('Account Update Button Widget Description', 'suse_id_helper') 
      )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

    echo '<div class="action-link simple">';
    echo do_shortcode('[account_update_url label="Update Account"]');
    echo '</div>';

		echo $args['after_widget'];
	}
 
  public function form( $instance ) {
    // outputs the options form of admin settings; not applicable here
  }

  public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved; not applicable here
  }
}
?>