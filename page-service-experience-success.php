<?php
/*
 * Template Name: サービス利用体験　完了
 */
get_header(); ?>

<div id="page-experience-form" class="page-experience-form page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <img src="<?php echo $cfs->get('header_image'); ?>">
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
    <div class="page-content-wrapper service-experience">
        <div class="container">
            <div class="page-content-innerwrap">
                <div class="service-experience-form mt-5">
                    <div class="col-lg">
                        <div class="stephead">
                            <img class="step3 pc" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step3.png">
                            <img class="step3 sp" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step3_sp.png">
                        </div>
                        <div class="txtbox mt-4 mb-4">
                            <?php the_content();?>
                        </div>
                    </div>
                    <div class="mx-auto text-center">
                        <a href="/service-experience/">
                            <button class="btn index-btn bg_darkg px-5">サービス利用体験談一覧へ</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>