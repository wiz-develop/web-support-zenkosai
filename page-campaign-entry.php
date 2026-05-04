<?php
/*
 * Template Name: キャンペーン応募フォーム
 */
get_header();
$page_slug = $post->post_name;
?>
<div id="page-<?php echo $page_slug; ?>" class="page-<?php echo $page_slug; ?> page-form_service page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
    <div class="page-content-wrapper pt-5">
        <div class="container">
            <div class="content">
                <div class="content__body">
                    <div class="service-form-wrap">
                        <div class="service-form-wrap__content">
                            <?php if ( have_posts() ) :
                                    while( have_posts() ) : the_post();
                                        the_content();
                                    endwhile;
                                endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>