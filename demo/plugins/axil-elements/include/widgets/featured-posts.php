<?php
/**
 * @package esell
 */
if( !class_exists('esell_featured_posts') ){
    class esell_featured_posts extends WP_Widget{
        /**
         * Register widget with WordPress.
         */
        function __construct(){

            $widget_options = array(
                'description'                   => esc_html__('esell: Featured posts here', 'esell'),
                'customize_selective_refresh'   => true,
            );

            parent:: __construct('esell_featured_posts', esc_html__( 'esell: Featured posts', 'esell'), $widget_options );

        }
        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance){

            if ( ! isset( $args['widget_id'] ) ) {

                $args['widget_id'] = $this->id;

            }

            $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Featured posts','esell' );

            $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

            $show_item = ( ! empty( $instance['show_item'] ) ) ? absint( $instance['show_item'] ) : 3;
            $num_title_word = ( ! empty( $instance['num_title_word'] ) ) ? absint( $instance['num_title_word'] ) : 7;

            $only_video_post = isset( $instance['only_video_post'] ) ? $instance['only_video_post'] : true;


            echo $args['before_widget'];
            if( $title ):
                echo $args['before_title'];
                echo esc_html( $title );
                echo $args['after_title'];
            endif;
            
            $arg = array(
                'post_type'      => 'post',
                'ignore_sticky_posts' => 1,
                'posts_per_page' => $show_item,
            );

            if ($only_video_post) {
                $arg['tax_query'][] = [
                    'taxonomy' => 'post_format',
                    'field' => 'slug',
                    'terms' => array('post-format-video'),
                    'operator' => 'IN'
                ];
            }

            $posts = new \WP_Query($arg);

            ?><div class="video-post-wrapepr"><?php
            while($posts->have_posts()) : $posts->the_post();  ?>

                <div class="content-block image-rounded mt--20">
                    <div class="post-content">
                        <?php if ( has_post_thumbnail()): ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'axil-tab-post-thumb' ); ?></a>
                                <?php
                                if ( has_post_format('video') ) { ?>
                                    <a class="video-popup size-medium icon-color-secondary position-top-center" href="<?php the_permalink(); ?>"><span class="play-icon"></span></a>
                                <?php } ?>
                            </div>
                        <?php endif ?>
                        <h6 class="title mt--10"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $num_title_word,' '); ?></a>
                        </h6>
                    </div>
                </div>

            <?php endwhile; ?>
            </div>
            <?php echo $args['after_widget']; ?>

            <?php wp_reset_postdata();
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
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['show_item'] = (int) $new_instance['show_item'];
            $instance['num_title_word'] = (int) $new_instance['num_title_word'];
            $instance['only_video_post'] = isset( $new_instance['only_video_post'] ) ? (bool) $new_instance['only_video_post'] : false;
            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */

        public function form( $instance ) {
            $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
            $show_item          = isset( $instance['show_item'] ) ? absint( $instance['show_item'] ) : 3;
            $num_title_word     = isset( $instance['num_title_word'] ) ? absint( $instance['num_title_word'] ) : 7;
            $only_video_post          = isset( $instance['only_video_post'] ) ? (bool) $instance['only_video_post'] : true;
            ?>
            <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:','esell' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'show_item' )); ?>"><?php echo esc_html__( 'No. of Item of posts to show:','esell' ); ?></label>
                <input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'show_item' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_item' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($show_item); ?>" size="3" />
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'num_title_word' )); ?>"><?php echo esc_html__( 'Title Word','esell' ); ?></label>
                <input class="tiny-text" id="<?php echo esc_attr(esc_attr($this->get_field_id( 'num_title_word' ))); ?>" name="<?php echo esc_attr($this->get_field_name( 'num_title_word' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($num_title_word); ?>" size="3">
            </p>
            <p>
                <input class="checkbox" type="checkbox"<?php checked( $only_video_post ); ?> id="<?php echo esc_attr($this->get_field_id( 'only_video_post' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'only_video_post' )); ?>" />
                <label for="<?php echo esc_attr($this->get_field_id( 'only_video_post' )); ?>"><?php echo esc_html__( 'Display Only Video Post?','esell' ); ?></label>
            </p>
            <?php
        }
    }
}



// register Contact  Widget widget
function esell_featured_posts(){
    register_widget('esell_featured_posts');
}
add_action('widgets_init','esell_featured_posts');
