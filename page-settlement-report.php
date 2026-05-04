<?php
/*
 * Template Name: 決算報告書
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
                <h3>決算報告書</h3>
                    <div class="page-content-div">
                        <h4>一般財団法人全国福利厚生共済会貸借対照表（B/S）</h4>
                            <?php
                                $fields = $cfs->get('report_list');
                                foreach ($fields as $field) :
                            ?>
                                <div class="report-list">
                                    <button class="btn btn-primary acor-about-menu">
                                        <p class="mb-0"><?php echo $field['year']; ?></p>
                                    </button>
                                    <div class="report-list__detail acor-menu-child">
                                        <?php
                                            $fields = $field['table'];
                                            foreach ((array)$fields as $field):
                                        ?>
                                            <div class="" id="">
                                                <h5><?php echo $field['table_name']; ?></h5>
                                                    <div class="">
                                                        <?php echo $field['financial_results']; ?>
                                                        <p class="mb-0">
                                                        （単位：千円 単位未満四捨五入）
                                                        </p>
                                                    </div>
                                            </div>
                                        <?php
                                            endforeach;
                                        ?>
                                    </div>
                                </div>
                            <?php
                                endforeach;
                            ?>
                    </div>
            </div>
        </div>
    </div>
    <?php get_template_part('templates/about-nav');?>
    <?php get_footer(); ?>
</div>
<script>
jQuery(function($){
    $(document).on('click','.acor-about-menu',function(){
        $(this).toggleClass("opened");
        $(this).next('.acor-menu-child').toggleClass('opened');

    });
});
</script>
<style>
    .report-list__detail{
        display: none;
        height: 0;
        transition: height .5s ease-out;
    }
    .report-list__detail.opened{
        display: flex;
        height: auto;
        transition: height .5s ease-out;
    }
</style>