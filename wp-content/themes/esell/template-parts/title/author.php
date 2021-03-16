<?php
$author = $post->post_author;
$userpfix = AXIL_THEME_FIX;
$axil_author_twitter = get_user_meta($author, $userpfix . '_twitterurl', true);
$axil_author_facebook = get_user_meta($author, $userpfix . '_facebookurl', true);
$axil_author_linkedin = get_user_meta($author, $userpfix . '_linkedinurl', true);
$axil_author_pinterest = get_user_meta($author, $userpfix . '_pinteresturl', true);
$get_author_id = get_the_author_meta('ID');
$axil_author_website = get_the_author_meta('user_url');
$get_author_gravatar = get_avatar_url($get_author_id, array('size' => 105));

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$comment_args = array(
    'post_author' => $get_author_id // fill in post author ID
);
$author_comments = get_comments($comment_args);
$author_total_comment = count($author_comments);
$user_info = get_userdata($author);


$designation = axil_get_acf_data("team_designation");
$team_social_icons = axil_get_acf_data("axil_team_social_icons");

$author_id = get_the_author_meta('ID');
$author_info = get_userdata(get_the_author_meta( 'ID' ));
$author_role = implode(', ', $author_info->roles);

?>


<!-- Start Author Area  -->
<div class="axil-author-area axil-author-banner bg-color-grey">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="about-author">
                    <div class="media">
                        <div class="thumbnail">
                            <img src="<?php echo esc_url($get_author_gravatar); ?>"
                                 alt="<?php echo get_the_author_meta('display_name', $author) ?>" class="author image">
                        </div>
                        <div class="media-body">
                            <div class="author-info">
                                <h1 class="title"><?php echo get_the_author_meta('display_name', $author); ?></h1>

                                <?php if(get_the_author_meta( 'user_designation' )){ ?>
                                    <span class="b3 subtitle"><?php the_author_meta( 'user_designation' ); ?></span>
                                <?php } ?>

                            </div>
                            <div class="content">
                                <?php if (!empty (get_the_author_meta('description', $author))) { ?> <p class="b1 description"><?php echo get_the_author_meta('description', $author); ?></p> <?php } ?>


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
            </div>
        </div>
    </div>
</div>
<!-- End Author Area  -->