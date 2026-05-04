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
            <img src="<?php echo CFS()->get('header_image'); ?>" class="pc-bnr">
            <img src="<?php echo CFS()->get('header_image_sp'); ?>" class="sp-bnr">
        </div>
        <div class="page-top__icon">
            <?php if(CFS()->get('title_icon') ): ?>
                <div class="icon-image">
                    <img src="<?php echo CFS()->get('title_icon'); ?>">
                </div>
            <?php endif; ?>
                    <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container">
        <div class="page-content-innerwrap">
            <h3>サービス利用件数</h3>
                <div class="use-list">
                    <?php
                        foreach( CFS()->get('use_list') as $use_list ) :
                    ?>
                        <div class="performance">
                            <a href="<?php echo $use_list['file']; ?>" target="_blank">
                                <div class="performance__link">
                                    <?php echo $use_list['title']; ?><br>サービス利用件数（PDF）
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
<?php get_template_part('templates/about-nav');?>
