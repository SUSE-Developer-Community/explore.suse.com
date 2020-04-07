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

    if (! is_user_logged_in() && ! empty($instance['target_page']) ) {  
      echo '<div class="action-link">',
        '<a href="' . get_post($instance['target_page'])->post_name . ' " class="themebutton btn-round">' . $instance['action'] . '</a>',
        '</div>';
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'experon' );
		$content = ! empty( $instance['content'] ) ? $instance['content'] : esc_html__( 'New content', 'experon' );
		$target = ! empty( $instance['target_page'] ) ? $instance['target_page'] : esc_html__( 'New target', 'experon' );
		$action = ! empty( $instance['action'] ) ? $instance['action'] : esc_html__( 'New action', 'experon' );
		?>
		<p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">

      <label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_attr_e( 'Content:', 'experon' ); ?></label> 
      <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>"><?php echo esc_attr( $content ); ?></textarea>

      <?php
        $page_args = array(
          'echo' => 0,
          'class' => 'widefat',
          'name' => esc_attr( $this->get_field_name( 'target_page' )),
          'value_field' => 'ID',
          'selected' => $target
        );
        $pages = wp_dropdown_pages($page_args);
      ?>
      <label for="<?php echo esc_attr( $this->get_field_id( 'target_page' ) ); ?>"><?php esc_attr_e( 'Target page:', 'experon' ); ?></label> 
      <?php echo $pages; ?>

      <label for="<?php echo esc_attr( $this->get_field_id( 'action' ) ); ?>"><?php esc_attr_e( 'Button label:', 'experon' ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'action' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'action' ) ); ?>" type="text" value="<?php echo esc_attr( $action ); ?>">
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

    $page = get_post($new_instance['target_page']);
    if ($page)
    {
      $instance['target_page'] = $new_instance['target_page'];
    }

		$instance['action'] = ( ! empty( $new_instance['action'] ) ) ? sanitize_text_field( $new_instance['action'] ) : '';

		return $instance;
	}

}