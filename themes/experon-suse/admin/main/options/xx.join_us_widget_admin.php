<?php

/**
 * SUSE Join us widget with the Sign Up button
 */
class JoinUs_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'join_us_widget',
			esc_html__( 'SUSE Join Us', 'experon' ), // Name
			array( 'description' => esc_html__( 'Join Us Widget', 'experon' ), ) // Args
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
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'],
        apply_filters( 'widget_title', $instance['title'] ),
        $args['after_title'];
      echo '<div class="join_us">' . $instance['content'] . '</div>';
    }

    $link = '';
    $label = '';
    if (is_user_logged_in() && ! empty($instance['target_page_in']) ) {  
      $link = $instance['target_page_in'];
      $label = $instance['action_in'];
    } elseif (! empty($instance['target_page_out']) ) {  
      $link = get_post($instance['target_page_out'])->post_name;
      $label = $instance['action_out'];
		}

    echo '<div class="action-link">';
    echo '<a href="' . $link . ' " class="themebutton btn-round">' . $label . '</a>';
    echo '</div>';

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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Join us', 'experon' );
		$content = ! empty( $instance['content'] ) ? $instance['content'] : esc_html__( 'Join us welcoming text', 'experon' );
		$targetin = ! empty( $instance['target_page_in'] ) ? $instance['target_page_in'] : esc_html__( 'https://', 'experon' );
		$targetout = ! empty( $instance['target_page_out'] ) ? $instance['target_page_out'] : esc_html__( 'Target for logged out sessions', 'experon' );
		$actionin = ! empty( $instance['action_in'] ) ? $instance['action_in'] : esc_html__( 'Write Us', 'experon' );
		$actionout = ! empty( $instance['action_out'] ) ? $instance['action_out'] : esc_html__( 'Sign Up', 'experon' );
		?>
		<p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_attr_e( 'Content:', 'experon' ); ?></label> 
      <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"><?php echo esc_attr( $content ); ?></textarea>

      <label for="<?php echo esc_attr( $this->get_field_id( 'target_page_in' ) ); ?>"><?php esc_attr_e( 'Target page for logged in users:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target_page_in' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target_page_in' ) ); ?>" type="text" value="<?php echo esc_attr( $targetin ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'action_in' ) ); ?>"><?php esc_attr_e( 'Button label for logged in users:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'action_in' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'action_in' ) ); ?>" type="text" value="<?php echo esc_attr( $actionin ); ?>">

      <?php
        $page_args = array(
          'echo' => 0,
          'class' => 'widefat',
          'name' => esc_attr( $this->get_field_name( 'target_page_out' )),
          'value_field' => 'ID',
          'selected' => $targetout
        );
        $pages = wp_dropdown_pages($page_args);
      ?>
      <label for="<?php echo esc_attr( $this->get_field_id( 'target_page_out' ) ); ?>"><?php esc_attr_e( 'Target page for unauthenticated users:', 'experon' ); ?></label> 
      <?php echo $pages; ?>

      <label for="<?php echo esc_attr( $this->get_field_id( 'action_out' ) ); ?>"><?php esc_attr_e( 'Button label for unauthenticated users:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'action_out' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'action_out' ) ); ?>" type="text" value="<?php echo esc_attr( $actionout ); ?>">
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
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['content'] = ( ! empty( $new_instance['content'] ) ) ? sanitize_text_field( $new_instance['content'] ) : '';
		$instance['target_page_in'] = ( ! empty( $new_instance['target_page_in'] ) ) ? sanitize_text_field( $new_instance['target_page_in'] ) : '';

    $page = get_post($new_instance['target_page_out']);
    if ($page)
    {
      $instance['target_page_out'] = $new_instance['target_page_out'];
    }

		$instance['action_in'] = ( ! empty( $new_instance['action_in'] ) ) ? sanitize_text_field( $new_instance['action_in'] ) : '';
		$instance['action_out'] = ( ! empty( $new_instance['action_out'] ) ) ? sanitize_text_field( $new_instance['action_out'] ) : '';

		return $instance;
	}

}