<?php

/**
 * SUSE Marketo widget
 */
class Marketo_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
    //load JS
    $marketoFormJS = 'https://more.suse.com/js/forms2/js/forms2.min.js';
    wp_enqueue_script('marketoFormJS', $marketoFormJS, array(), true, true);
    $suseMarketo = get_template_directory_uri() . '/lib/scripts/marketo.js';
    wp_register_script('suseMarketo', $suseMarketo, array('marketoFormJS'), true, true);
    $style = get_template_directory_uri() . '/styles/marketo.css';
    wp_enqueue_style('marketo', $style, true, true);

		parent::__construct(
			'marketo_widget',
			esc_html__( 'SUSE Marketo', 'experon' ), // Name
			array( 'description' => esc_html__( 'This widget helps integration with Marketo', 'experon' ), ) // Args
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

    $current_user = wp_get_current_user();

		echo $args['before_widget'];
		if ( ! empty( $instance['campaignId'] ) && 
      ! empty( $instance['munchkinId'] ) &&
      ! empty( $instance['formId'] ) && 
      ! empty( $instance['rootUrl'] ) )  {

      // pass on config to JS
      $config = array(
        'campaignId' => $instance['campaignId'],
        'munchkinId' => $instance['munchkinId'],
        'formId' => $instance['formId'],
        'rootUrl' => $instance['rootUrl'],
        'formSubmitUrl' => $instance['formSubmitUrl'],
        'landingPageUrl' => $instance['landingPageUrl'],
        'firstName' => '',
        'lastName' => '',
        'email' => '',
        'job' => '',
        'country' => ''
      );

      // prefill user data if there is an active session
      if ($current_user->ID != 0) {
        $config['firstName'] = $current_user->first_name;
        $config['lastName'] = $current_user->last_name;
        $config['email'] = $current_user->user_email;
      }
      wp_localize_script('suseMarketo', 'config', $config);
      wp_enqueue_script('suseMarketo');
      
      echo '<div id="form_content">';
      echo '<form class="marketo" id="mktoForm_' . $instance['formId'] . '"></form>';
      echo '</div>';
    }
		echo $args['after_widget'];
  }

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$campaignId = ! empty( $instance['campaignId'] ) ? $instance['campaignId'] : esc_html__( 'Campaign Id', 'experon' );
		$munchkinId = ! empty( $instance['munchkinId'] ) ? $instance['munchkinId'] : esc_html__( 'munchkin Id', 'experon' );
		$formId = ! empty( $instance['formId'] ) ? $instance['formId'] : esc_html__( 'form Id', 'experon' );
		$rootUrl = ! empty( $instance['rootUrl'] ) ? $instance['rootUrl'] : esc_html__( 'root Url', 'experon' );
		$formSubmitUrl = ! empty( $instance['formSubmitUrl'] ) ? $instance['formSubmitUrl'] : esc_html__( 'Form Submit Url', 'experon' );
		$landingPageUrl = ! empty( $instance['landingPageUrl'] ) ? $instance['landingPageUrl'] : esc_html__( 'Landing Page Url', 'experon' );
		?>
		<p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'campaignId' ) ); ?>"><?php esc_attr_e( 'Campaign Id:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'campaignId' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'campaignId' ) ); ?>" type="text" value="<?php echo esc_attr( $campaignId ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'munchkinId' ) ); ?>"><?php esc_attr_e( 'munchkin Id:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'munchkinId' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'munchkinId' ) ); ?>" type="text" value="<?php echo esc_attr( $munchkinId ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'formId' ) ); ?>"><?php esc_attr_e( 'form Id:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'formId' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'formId' ) ); ?>" type="text" value="<?php echo esc_attr( $formId ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'rootUrl' ) ); ?>"><?php esc_attr_e( 'root Url:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rootUrl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'rootUrl' ) ); ?>" type="text" value="<?php echo esc_attr( $rootUrl ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'formSubmitUrl' ) ); ?>"><?php esc_attr_e( 'Form Submit Url:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'rootUrl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'formSubmitUrl' ) ); ?>" type="text" value="<?php echo esc_attr( $formSubmitUrl ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'landingPageUrl' ) ); ?>"><?php esc_attr_e( 'Landing Page Url:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'landingPageUrl' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'landingPageUrl' ) ); ?>" type="text" value="<?php echo esc_attr( $landingPageUrl ); ?>">

		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['campaignId'] = ( ! empty( $new_instance['campaignId'] ) ) ? sanitize_text_field( $new_instance['campaignId'] ) : '';
		$instance['munchkinId'] = ( ! empty( $new_instance['munchkinId'] ) ) ? sanitize_text_field( $new_instance['munchkinId'] ) : '';
		$instance['formId'] = ( ! empty( $new_instance['formId'] ) ) ? sanitize_text_field( $new_instance['formId'] ) : '';
		$instance['rootUrl'] = ( ! empty( $new_instance['rootUrl'] ) ) ? sanitize_text_field( $new_instance['rootUrl'] ) : '';
		$instance['formSubmitUrl'] = ( ! empty( $new_instance['formSubmitUrl'] ) ) ? sanitize_text_field( $new_instance['formSubmitUrl'] ) : '';
		$instance['landingPageUrl'] = ( ! empty( $new_instance['landingPageUrl'] ) ) ? sanitize_text_field( $new_instance['landingPageUrl'] ) : '';

		return $instance;
	}
}