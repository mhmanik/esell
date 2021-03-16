<?php

// Adds widget: Wooc-Social Icons Widget

class wooctheme_socialiconswidg_widget extends WP_Widget {
	
	function __construct() {
		parent::__construct(
			'wooctheme_socialiconswidg_widget',
			esc_html__( 'Wooc Social Icons Widget', 'wooctheme-theme-helper' ),
			array( 'description' => esc_html__( 'Social Icons Widget', 'wooctheme-theme-helper' ), ) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Facebook',
			'id' => 'facebook',
			'type' => 'url',
		),
		array(
			'label' => 'Twitter',
			'id' => 'twitter',
			'type' => 'url',
		),
		array(
			'label' => 'Linkedin',
			'id' => 'linkedin',
			'type' => 'url',
		),
		array(
			'label' => 'Pinterest',
			'id' => 'pinterest',
			'type' => 'url',
		),		
		array(
			'label' => 'Instagram',
			'id' => 'instagram',
			'type' => 'url',
		),
		array(
			'label' => 'Vimeo',
			'id' => 'vimeo',
			'type' => 'url',
		),
		array(
			'label' => 'Flickr',
			'id' => 'flickr',
			'type' => 'url',
		),
		array(
			'label' => 'Youtube',
			'id' => 'youtube',
			'type' => 'url',
		),
		array(
			'label' => 'Dribbble',
			'id' => 'dribbble',
			'type' => 'url',
		),
		array(
			'label' => 'Behance',
			'id' => 'behance',
			'type' => 'url',
		),
		array(
			'label' => 'Skype',
			'id' => 'skype',
			'type' => 'url',
		),
		array(
			'label' => 'Tumblr',
			'id' => 'tumblr',
			'type' => 'url',
		),
	);
	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		} ?>
		<ul class="sidebar-social-links">	 
				<?php
				if( !empty( $instance['facebook'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php
				}
				if( !empty( $instance['twitter'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php
				}				
				if( !empty( $instance['linkedin'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php
				}
				if( !empty( $instance['pinterest'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li><?php
				}				
				if( !empty( $instance['instagram'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li><?php
				}
				if( !empty( $instance['vimeo'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['vimeo'] ); ?>" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li><?php
				}
				if( !empty( $instance['flickr'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['flickr'] ); ?>" target="_blank"><i class="fa fa-flickr" aria-hidden="true"></i></a></li><?php
				}
				if( !empty( $instance['youtube'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li><?php
				}
				if( !empty( $instance['dribbble'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['dribbble'] ); ?>" target="_blank"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li><?php
				}
				if( !empty( $instance['behance'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['behance'] ); ?>" target="_blank"><i class="fa fa-behance"></i></a></li><?php
				}
				if( !empty( $instance['skype'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['skype'] ); ?>" target="_blank"><i class="fa fa-skype" aria-hidden="true"></i></a></li><?php
				}
				if( !empty( $instance['tumblr'] ) ){
					?><li class="single-item"><a href="<?php echo esc_url( $instance['tumblr'] ); ?>" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li><?php
				}
				?>
		</ul>
	<?php
		echo $args['after_widget'];
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'wooctheme-theme-helper' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'wooctheme-theme-helper' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'wooctheme-theme-helper' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'wooctheme-theme-helper' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}
function register_tactsocialiconswidg_widget() {
	register_widget( 'wooctheme_socialiconswidg_widget' );
}
add_action( 'widgets_init', 'register_tactsocialiconswidg_widget' );