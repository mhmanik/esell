<?php

/**
 * @author  Wooctheme
 * @since   1.0
 * @version 1.0
 * @package wooctheme-theme-helper
 */

// Adds widget: Wooc- Information
class wooctheme_information_Widget extends WP_Widget
{

	function __construct()
	{
		parent::__construct(
			'wooctheme_information_widget',
			esc_html__('Wooc- Information', 'wooctheme-theme-helper'),
			array('description' => esc_html__('Wooc - Information Widget', 'wooctheme-theme-helper'),) // Args
		);
	}
	private $widget_fields = array(
		array(
			'label' => 'Phone',
			'id' 	=> 'phone',
			'type' 	=> 'tel',
		),
		array(
			'label' => 'Email',
			'id' 	=> 'email',
			'type' 	=> 'email',
		),
		array(
			'label' => 'Address',
			'id' => 'address',
			'type' => 'textarea',
		),
	);

	public function widget($args, $instance)
	{
		echo $args['before_widget'];

		if (!empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
		}
?>


		<div class="footer-contact">
			<span class="flaticon-contact"></span>
			<?php if (!empty($instance['phone'])) { ?>
				<p><a href="tel:<?php echo esc_attr($instance['phone']); ?>"><?php echo esc_html($instance['phone']); ?></p>
			<?php }
			if (!empty($instance['email'])) {
			?>
				<p><a href="mailto:<?php echo esc_attr($instance['email']); ?>"><?php echo esc_html($instance['email']); ?></a></p>
			<?php }
			if (!empty($instance['address'])) {
			?>
				<p><?php echo wp_kses_post($instance['address']); ?></p>
				<a href="" class="def-btn outline">Get Directions</a>
			<?php
			}
			?>
		</div>



	<?php

		echo $args['after_widget'];
	}

	public function field_generator($instance)
	{
		$output = '';
		foreach ($this->widget_fields as $widget_field) {
			$default = '';
			if (isset($widget_field['default'])) {
				$default = $widget_field['default'];
			}
			$widget_value = !empty($instance[$widget_field['id']]) ? $instance[$widget_field['id']] : esc_html__($default, 'wooctheme-theme-helper');
			switch ($widget_field['type']) {
				case 'textarea':
					$output .= '<p>';
					$output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'wooctheme-theme-helper') . ':</label> ';
					$output .= '<textarea class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" rows="3" cols="6" value="' . esc_attr($widget_value) . '">' . $widget_value . '</textarea>';
					$output .= '</p>';
					break;
				default:
					$output .= '<p>';
					$output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'wooctheme-theme-helper') . ':</label> ';
					$output .= '<input class="widefat" id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" type="' . $widget_field['type'] . '" value="' . esc_attr($widget_value) . '">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form($instance)
	{
		$title = !empty($instance['title']) ? $instance['title'] : esc_html__('', 'wooctheme-theme-helper');
	?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'wooctheme-theme-helper'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
<?php
		$this->field_generator($instance);
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		foreach ($this->widget_fields as $widget_field) {
			switch ($widget_field['type']) {
				default:
					$instance[$widget_field['id']] = (!empty($new_instance[$widget_field['id']])) ? strip_tags($new_instance[$widget_field['id']]) : '';
			}
		}
		return $instance;
	}
}

function wooctheme_ster_tactinformation_widget()
{
	register_widget('wooctheme_information_Widget');
}
add_action('widgets_init', 'wooctheme_ster_tactinformation_widget');
