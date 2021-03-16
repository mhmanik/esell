<?php
/**
* The template part for displaying an Author biography
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package esell
*/
$author_id = get_the_author_meta('ID');
$author_info = get_userdata(get_the_author_meta( 'ID' ));
$author_role = implode(', ', $author_info->roles);
?>
<!-- Start Author  -->
<div class="about-author">
    <div class="media">
        <div class="thumbnail">
            <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                <?php
                $axil_author_bio_avatar_size = apply_filters( 'axil_author_bio_avatar_size', 105 );
                echo get_avatar( get_the_author_meta( 'user_email' ), $axil_author_bio_avatar_size );
                ?>
            </a>
        </div>
        <div class="media-body">
            <div class="author-info">
                <h5 class="title">
                    <a class="hover-flip-item-wrapper" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ))); ?>">
                        <span class="hover-flip-item">
                            <span data-text="<?php echo get_the_author(); ?>"><?php echo get_the_author(); ?></span>
                        </span>
                    </a>
                </h5>
                <?php if(class_exists('ACF')){
                    $designation = get_field('user_designation', 'user_'. $author_id);
                    ?>
                    <span class="b3 subtitle"><?php echo esc_html($designation); ?></span>
                <?php } ?>
            </div>
            <div class="content">
                <?php
                if(get_the_author_meta( 'user_description' )){ ?>
                <p class="b1 description"><?php the_author_meta( 'user_description' ); ?></p>
                <?php }  ?>

                <?php if(class_exists('ACF')){ ?>
                    <?php if( have_rows('axil_add_social_icons', 'user_'. $author_id) ): ?>
                        <ul class="social-share-transparent size-md">
                            <?php
                            while( have_rows('axil_add_social_icons', 'user_'. $author_id) ): the_row();
                                $social_icon = get_sub_field('axil_enter_social_icon_markup');
                                $social_link = get_sub_field('axil_enter_social_icon_link');  ?>
                                <li><a href="<?php echo esc_url($social_link); ?>"><?php echo awescapeing($social_icon); ?></a></li> <?php
                            endwhile;
                            ?>
                        </ul>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>