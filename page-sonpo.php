<?php
/*
 * Template Name: 団体総合生活補償保険
 */
get_header(); ?>
<style>
.breadcrumb li:nth-child(2) {
    display: none;
}
</style>
<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
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
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container d-block">
            <div class="page-content-innerwrap">
                <?php
                    $insurance_images = $cfs->get('insurance_images');
                    foreach($insurance_images as $insurance_image) :
                ?>
                    <img src="<?php echo $insurance_image['app_image']; ?>" alt="全厚済ケアプラス保険のご案内" width="100%" height="auto" class="aligncenter size-full" />
                <?php endforeach; ?>
                    <?php
                        $app_supplement = CFS()->get('app_supplement');
                        if ($app_supplement) :
                    ?>
                    <div class="page-content-div">
                        <?php echo $app_supplement; ?>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>