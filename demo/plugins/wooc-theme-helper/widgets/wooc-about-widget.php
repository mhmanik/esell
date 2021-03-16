<?php
// widget: Wooc-About
class WoocAbout_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'woocthemeabout_widget',
			esc_html__( 'Wooc - About Me', 'wooctheme-theme-helper' ),
			array( 'description' => esc_html__( 'Wooc - About Me Widget', 'wooctheme-theme-helper' ), ) // Args
		);
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'customize_controls_print_footer_scripts', array( $this, 'media_fields' ) );
	}
	private $widget_fields = array(
		array(
			'label' => 'Picture',
			'id' 	=> 'logo',
			'type' 	=> 'media',
		),
		array(
			'label' => 'Name',
			'id' 	=> 'name',
			'type' 	=> 'text',
		),
		array(
			'label' => 'Description',
			'id' 	=> 'description',
			'type' 	=> 'textarea',
		),
		array(
			'label' => 'Facebook',
			'id' 	=> 'facebook',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Twitter',
			'id' 	=> 'twitter',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Linkedin',
			'id' 	=> 'linkedin',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Pinterest',
			'id' 	=> 'pinterest',
			'type' 	=> 'url',
		),		
		array(
			'label' => 'Instagram',
			'id' 	=> 'instagram',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Vimeo',
			'id' 	=> 'vimeo',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Flickr',
			'id' 	=> 'flickr',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Youtube',
			'id' 	=> 'youtube',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Dribbble',
			'id' 	=> 'dribbble',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Behance',
			'id' 	=> 'behance',
			'type' 	=> 'url',
		),
		array(
			'label' => 'Skype',
			'id' => 'skype',
			'type' => 'url',
		),
		array(
			'label' => 'Tumblr',
			'id' 	=> 'tumblr',
			'type' 	=> 'url',
		),
	);
	public function widget( $args, $instance ) {
		?>	


		<?php
		echo $args['before_widget'];
			if ( $instance['title']  ) {
				$html = apply_filters( 'widget_title', $instance['title'] );
				$html = $args['before_title'] . $html .$args['after_title'];
			}
			else {
				$html = '';
			}
			echo wp_kses_post( $html );

			if ( !empty( $instance['logo'] ) ) {
				$html = '
				<div class="wooc-img">
					<a href="'. esc_url( home_url( '/' ) ) . '">'. wp_get_attachment_image( $instance['logo'], 'full' ) .'</a>
				</div>';
			}
			else {
				$html = '';
			}
			echo wp_kses_post( $html );
		?>
		<div class="text-center">
			<?php if( !empty( $instance['name'] ) ){ ?>
		        <h3 class="wooc-title">
					<?php echo esc_html( $instance['name'] ); ?>
				</h3>
			<?php } ?>
	        <p class="wooc-text">
				<?php if( !empty( $instance['description'] ) ) echo wp_kses_post( $instance['description'] ); ?>
			</p>
			<ul class="wooc-links">	 
				<?php
				if( !empty( $instance['facebook'] ) ){
					?><li><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fab fa-facebook"></i></a></li><?php
				}
				if( !empty( $instance['twitter'] ) ){
					?><li><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li><?php
				}				
				if( !empty( $instance['linkedin'] ) ){
					?><li><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fab fa-linkedin"></i></a></li><?php
				}
				if( !empty( $instance['pinterest'] ) ){
					?><li><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fab fa-pinterest"></i></a></li><?php
				}			
				if( !empty( $instance['instagram'] ) ){
					?><li><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li><?php
				}
				if( !empty( $instance['vimeo'] ) ){
					?><li><a href="<?php echo esc_url( $instance['vimeo'] ); ?>" target="_blank"><i class="fab fa-vimeo"></i></a></li><?php
				}
				if( !empty( $instance['flickr'] ) ){
					?><li><a href="<?php echo esc_url( $instance['flickr'] ); ?>" target="_blank"><i class="fab fa-flickr"></i></a></li><?php
				}
				if( !empty( $instance['youtube'] ) ){
					?><li><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li><?php
				}
				if( !empty( $instance['dribbble'] ) ){
					?><li><a href="<?php echo esc_url( $instance['dribbble'] ); ?>" target="_blank"><i class="fab fa-dribble"></i></a></li><?php
				}
				if( !empty( $instance['behance'] ) ){
					?><li><a href="<?php echo esc_url( $instance['behance'] ); ?>" target="_blank"><i class="fab fa-behance"></i></a></li><?php
				}
				if( !empty( $instance['skype'] ) ){
					?><li><a href="<?php echo esc_url( $instance['skype'] ); ?>" target="_blank"><i class="fab fa-skype"></i></a></li><?php
				}
				if( !empty( $instance['tumblr'] ) ){
					?><li><a href="<?php echo esc_url( $instance['tumblr'] ); ?>" target="_blank"><i class="fab fa-tumblr"></i></a></li><?php
				}
				?>
			</ul>
		</div>
	<?php
	echo $args['after_widget'];
	}
	
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$(document).on('click','.custommedia',function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$('input#'+id).val(attachment.id);
								$('span#preview'+id).css('background-image', 'url('+attachment.url+')');
								$('input#'+id).trigger('change');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$(document).on('click', '.remove-media', function() {
						var parent = $(this).parents('p');
						parent.find('input[type="media"]').val('').trigger('change');
						parent.find('span').css('background-image', 'url()');
					});
				}
			});
		</script><?php
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
				case 'media':
					$media_url = '';
					if ($widget_value) {
						$media_url = wp_get_attachment_url($widget_value);
					}
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'wooctheme-theme-helper' ).':</label> ';
					$output .= '<input style="display:none;" class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.$widget_value.'">';
					$output .= '<span id="preview'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" style="margin-right:10px;border:2px solid #eee;display:block;width: 100px;height:100px;background-image:url('.$media_url.');background-size:contain;background-repeat:no-repeat;"></span>';
					$output .= '<button id="'.$this->get_field_id( $widget_field['id'] ).'" class="button select-media custommedia">Add Media</button>';
					$output .= '<input style="width: 19%;" class="button remove-media" id="buttonremove" name="buttonremove" type="button" value="Clear" />';
					$output .= '</p>';
					break;
				case 'textarea':
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'wooctheme-theme-helper' ).':</label> ';
					$output .= '<textarea class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" rows="6" cols="6" value="'.esc_attr( $widget_value ).'">'.$widget_value.'</textarea>';
					$output .= '</p>';
					break;
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
function register_woocthemeabout_widget() {
	register_widget( 'WoocAbout_Widget' );
}
add_action( 'widgets_init', 'register_woocthemeabout_widget' );