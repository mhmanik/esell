<?php
/**
* The template part for displaying the review
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package esell
*/

$esell_options = Helper::axil_get_options();

?>
<div class="axil-post-review">
    <div class="axil-post-review__inner">
        <div class="axil-post-review__top">

            <div class="axil-post-review__product media">
                <?php
                $image = get_field('axil_post_review_image');

                if( !empty($image) ): ?>
                    <div class="media-left media-middle">
                        <div class="axil-post-review__product-image"><img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_html($image['alt']); ?>"></div>
                    </div>
                <?php endif; ?>

                <div class="media-body media-middle">
                    <?php if(!empty(axil_get_acf_data('axil_post_review_name'))){ ?>
                        <h3 class="axil-post-review-name"><?php echo axil_get_acf_data('axil_post_review_name') ?></h3>
                    <?php } ?>
                    <?php if(!empty(axil_get_acf_data('axil_post_review_description'))){ ?>
                        <span class="axil-post-review-description"> <?php echo axil_get_acf_data('axil_post_review_description') ?> </span>
                    <?php } ?>
                </div>
            </div>

            <?php if(!empty(axil_get_acf_data('axil_post_review_score'))){ ?>
                <!--axil-post-review__product media-->
                <div class="axil-post-review__overall-score">
                    <div class="axil-post-review__count_wrap">
                        <span class="post-score-value"><?php echo axil_get_acf_data('axil_post_review_score') ?></span>
                    </div>
                </div>
                <!--axil-post-review__overall-score-->
            <?php } ?>
        </div>
        <?php if(!empty(axil_get_acf_data('axil_post_review_summary'))){ ?>
            <!--axil-post-review__top-->
            <div class="axil-post-review__summary">
                <p><?php echo axil_get_acf_data('axil_post_review_summary') ?></p>
            </div>
            <!--axil-post-review__summary-->
        <?php } ?>

        <?php if(axil_get_acf_data('axil_post_review_pors_and_cons')){ ?>
            <div class="axil-post-review__pros-and-cons">
                <div class="row row--space-between">
                    <?php
                    $pors = axil_get_acf_data('axil_post_review_pors');
                    if($pors){ ?>
                        <div class="col-xs-12 col-sm-6">
                            <div class="axil-post-review__pros">
                                <h5 class="axil-post-review__list-title"><?php echo (!empty($esell_options['axil_post_review_pors_label'])) ? $esell_options['axil_post_review_pors_label'] : "Pors"; ?></h5>
                                <ul>
                                    <?php foreach($pors as $por){ ?>
                                        <li><i class="fal fa-check-circle"></i><span><?php echo esc_html($por['axil_post_review_add_pors']); ?></span></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    $cons = axil_get_acf_data('axil_post_review_cons');
                    if($cons){ ?>
                        <div class="col-xs-12 col-sm-6">
                            <div class="axil-post-review__cons">
                                <h5 class="axil-post-review__list-title"><?php echo (!empty($esell_options['axil_post_review_cons_label'])) ? $esell_options['axil_post_review_cons_label'] : "Cons"; ?></h5>
                                <ul>
                                    <?php foreach($cons as $con){ ?>
                                        <li><i class="fal fa-times-circle"></i><span><?php echo esc_html($con['axil_post_review_add_cons']); ?></span></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!--axil-post-review__pros-and-cons-->
        <?php } ?>
    </div>
    <!--axil-post-review__inner-->
</div>