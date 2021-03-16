<?php 
/**
 * Comment Form
 *
 * @package esell
 */

function esell_pingback($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'pingback';
    } else {
        $tag       = 'li';
        $add_below = 'div-pingback';
    }
    ?>

	<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    	
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body blog-comment pingback-body-class">
	        <div class="comment-replay-all">
		        <div class="single-comment">
			        <div class="parent-comment comment-border">
					    <?php endif; ?>

						<div class="comment-text pingback-text copy">
							
							<div class="comment-box-inner">
							    <div class="comment-meta commentmetadata">
							    	<?php if ( $comment->comment_approved == '0' ) : ?>
								         <em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'esell' ); ?></em>
								          <br />
								    <?php endif; ?>

									<b>
										<cite class="author-name"><?php comment_author_link(); ?></cite>
									</b>

	                                <div class="comment--date--time">
	                                    <?php printf( esc_html__('%1$s at %2$s', 'esell'), get_comment_date(),  get_comment_time()); ?>
	                                </div>
							       
							    </div>
								
							    <?php comment_text(); ?>
															
							</div>
							<div class="reply-edit">
						         <?php edit_comment_link();?>
                                <div class="reply">
                                    <?php
                                    $post_id = get_the_ID();
                                    $comment_id =get_comment_ID();
                                    //get the setting configured in the admin panel under settings discussions "Enable threaded (nested) comments  levels deep"
                                    $max_depth = get_option('thread_comments_depth');
                                    //add max_depth to the array and give it the value from above and set the depth to 1
                                    $default = array(
                                        'add_below'  => 'comment',
                                        'respond_id' => 'respondtest',
                                        'reply_text' => esc_html__('Reply', 'esell'),
                                        'login_text' => esc_html__('Log in to Reply', 'esell'),
                                        'depth'      => 1,
                                        'before'     => '',
                                        'after'      => '',
                                        'max_depth'  => $max_depth
                                    );
                                    comment_reply_link($default,$comment_id,$post_id);
                                    ?>
                                </div>
							</div>
					    </div>
						
					    <?php if ( 'div' != $args['style'] ) : ?>
					</div>

				</div>
			</div>
		</div>
    <?php endif; ?>
    <?php
}

function esell_comment($comment, $args, $depth) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>


	<<?php echo esc_html( $tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body blog-comment">
	        <div class="comment-replay-all">
		        <div class="single-comment">
			        <div class="parent-comment comment-border">
					    <?php endif; ?>

					    <div class="comment-author comment-img single-comment">
                            
                            <?php if ( $args['avatar_size'] != 0 )?><div class="comment-author-image comment-img"><?php echo get_avatar( $comment, 50, '', '', $avt_args = array( 'class' => 'comment-avatar img-fluid' ) ); ?></div>
                            
					        <div class="axil-comment-content comment-inner">
                                <div class="axil-comment-content-top">
                                    <h6 class="commenter"><?php comment_author_link(); ?></h6>
                                    <div class="time-spent comment-meta">
                                        <div class="axil-comment-date comment-meta">
                                            <?php printf( esc_html__('%1$s at %2$s', 'esell'), get_comment_date(),  get_comment_time()); ?>
                                        </div>
                                        <div class="reply-edit">
                                            <?php edit_comment_link();?>
                                            <div class="reply comment-reply-link hover-flip-item-wrapper">
                                                <?php
                                                $post_id = get_the_ID();
                                                $comment_id =get_comment_ID();
                                                //get the setting configured in the admin panel under settings discussions "Enable threaded (nested) comments  levels deep"
                                                $max_depth = get_option('thread_comments_depth');
                                                //add max_depth to the array and give it the value from above and set the depth to 1

                                                $allowed_tags = wp_kses_allowed_html( 'post' );

                                                $default = array(
                                                    'add_below'  => 'comment',
                                                    'respond_id' => 'respond',
                                                    'reply_text' => wp_kses(' <span class="hover-flip-item">
                                                                                    <span data-text="Reply">Reply</span>
                                                                                </span>', $allowed_tags),
                                                    'login_text' => esc_html__('Log in to Reply', 'esell'),
                                                    'depth'      => 1,
                                                    'before'     => '',
                                                    'after'      => '',
                                                    'max_depth'  => $max_depth
                                                );
                                                comment_reply_link($default,$comment_id,$post_id);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ( $comment->comment_approved == '0' ) : ?>
                                    <h6 class="m-b-20"><em class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'esell' ); ?></em></h6>
                                <?php endif; ?>
                                <div class="comment-text">
                                    <?php comment_text(); ?>
                                </div>
                            </div>                          
                            
					    </div>						
					    <?php if ( 'div' != $args['style'] ) : ?>
					</div>
				</div>
			</div>
		</div>
    <?php endif; ?>
    <?php
}