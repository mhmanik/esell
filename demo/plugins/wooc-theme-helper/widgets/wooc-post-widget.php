<?php

/**
 * @author  Wooctheme
 * @since   1.0
 * @version 1.0
 * @package wooctheme-theme-helper
 */

// Adds widget: Wooc - Recent Posts
use wooctheme\Uiart\Helper;

class wooctheme_recentposts_widget extends WP_Widget
{

	function __construct()
	{
		parent::__construct(
			'wooctheme_recentposts_widget',
			esc_html__('Wooc - Recent Posts', 'wooctheme-theme-helper'),
			array('description' => esc_html__('Wooc Recent Posts widget', 'wooctheme-theme-helper'),) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Number of posts to show',
			'id' => 'number',
			'type' => 'number',
		),
		array(
			'label' => 'Title limit of words to show',
			'id' => 'title_limit',
			'type' => 'number',
		),
		array(
			'label' => 'Content limit of posts to show',
			'id' => 'content_limit',
			'type' => 'number',
		),
		array(
			'label' => 'Display post Image ?',
			'id' 	=> 'show_img',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Display post Content ?',
			'id' 	=> 'show_content',
			'type' 	=> 'checkbox',
		),
		array(
			'label' => 'Display post Date ?',
			'id' => 'show_date',
			'type' => 'checkbox',
		),
		array(
			'label' => 'Display category ?',
			'id' => 'show_cat',
			'type' => 'checkbox',
		),
	);
	public function widget($args, $instance)
	{

		echo wp_kses_post($args['before_widget']);

		if (!isset($args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}

		$title                = (!empty($instance['title'])) ? $instance['title'] : esc_html__('Recent Posts', 'wooctheme-theme-helper');
		$title                = apply_filters('widget_title', $title, $instance, $this->id_base);
		$number               = (!empty($instance['number'])) ? absint($instance['number']) : 5;
		$content_limit        = (!empty($instance['content_limit'])) ? absint($instance['content_limit']) : 10;
		if (!$number) {
			$number = 3;
		}
		$title_limit    = (!empty($instance['title_limit'])) ? absint($instance['title_limit']) : 10;
		$show_img     	= isset($instance['show_img']) ? $instance['show_img'] : false;
		$show_date    	= isset($instance['show_date']) ? $instance['show_date'] : false;
		$show_content 	= isset($instance['show_content']) ? $instance['show_content'] : false;
		$show_cat 		= isset($instance['show_cat']) ? $instance['show_cat'] : false;
		$thumb_size 	= 'thumbnail';


		$result_query = new WP_Query(apply_filters('widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		))); ?>

		<?php if ($title) {
					echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
				} ?>

		<div class="wooctheme-latest-post">
			<?php
			if ($result_query->have_posts()) :
			?>
				
				
				<div class="footer-post-wrap">
					<?php while ($result_query->have_posts()) : $result_query->the_post();
						$post_id 	= get_the_ID();
						$content 	= Helper::get_current_post_content();
						$content 	= "<p>$content</p>";
						$content 	= wp_trim_words($content, $content_limit);
						$title 		= get_the_title();
						$title 		= wp_trim_words($title, $title_limit);
					?>
						<div class="single-footer-post media d-flex">
							<?php if (has_post_thumbnail()) { ?>
								<div class="img-box js-tilt">
									<?php if ($show_img) : ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
											<?php the_post_thumbnail($thumb_size); ?>
										</a>
									<?php endif; ?>
								</div>
							<?php } ?>
							<div class="post-content media-body">								
								<h4 class="title"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post($title); ?></a></h4>
								<?php if ($show_date) : ?>
									<span class="post-date-time"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_time(get_option('date_format')); ?></span>
								<?php endif; ?>
								<?php if ($show_content) : ?>
									<div class="p-content"><?php echo wp_kses_post($content); ?></div>
								<?php endif; ?>
								<?php if ($show_cat) :  ?>
									<div class="post-cat-group">
										<?php
										$post_categories = get_the_category($post_id);
										$category = array();
										foreach ($post_categories as $category) {
											$get_color = get_term_meta($category->term_id, 'wooctheme_category_color', true);
											if ($get_color) { ?>
												<a class="post-cat" style="color: <?php echo esc_attr($get_color); ?>" href="<?php echo get_category_link($category->term_id); ?>">
													<?php echo esc_html($category->name); ?>
												</a>
											<?php } else { ?>
												<a class="post-cat cat-btn-color" href="<?php echo get_category_link($category->term_id); ?>"><?php echo esc_html($category->name); ?></a>
										<?php }
										}
										?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
		</div>
		<?php echo wp_kses_post($args['after_widget']); ?>

	<?php
				wp_reset_postdata();
			endif;
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
					case 'checkbox':
						$output .= '<p>';
						$output .= '<input class="checkbox" type="checkbox" ' . checked($widget_value, true, false) . ' id="' . esc_attr($this->get_field_id($widget_field['id'])) . '" name="' . esc_attr($this->get_field_name($widget_field['id'])) . '" value="1">';
						$output .= '<label for="' . esc_attr($this->get_field_id($widget_field['id'])) . '">' . esc_attr($widget_field['label'], 'wooctheme-theme-helper') . '</label>';
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

	function register_wooctheme_recentposts_widget()
	{
		register_widget('wooctheme_recentposts_widget');
	}
	add_action('widgets_init', 'register_wooctheme_recentposts_widget');
