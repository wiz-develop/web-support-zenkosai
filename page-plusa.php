<?php
/*
 * Template Name: プラスa
 */
get_header(); ?>

<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <?php
                /*-------------------------------------------*/
                /* BreadCrumb
                /*-------------------------------------------*/
                do_action( 'lightning_breadcrumb_before' );
                $old_file_name[] = 'module_panList.php';
                if ( locate_template( $old_file_name, false, false ) ) {
                    locate_template( $old_file_name, true, false );
                } else {
                    get_template_part( 'template-parts/breadcrumb' );
                }
                do_action( 'lightning_breadcrumb_after' );
            ?>
        </div>
        <div class="page-top">
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image'); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                        <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap">
                <div class="page-content-div">
                    <?php
                        $fields = $cfs->get('plus_a_add');
                        foreach ($fields as $field) :
                    ?>
                        <div class="plusa">
                            <a href="<?php echo $field['plus_a_link']; ?>" target="_blank">
                                <div class="plusa__image">
                                    <img src="<?php echo $field['plus_a_slide']; ?>" alt="<?php echo $field['plus_a_title']; ?>">
                                </div>
                                <div class="plusa__detail">
                                    <h2><?php echo $field['plus_a_title']; ?></h2>
                                        <p class="mb-0">
                                            <?php echo $field['plus_a_content']; ?>
                                        </p>
                                </div>
                            </a>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>