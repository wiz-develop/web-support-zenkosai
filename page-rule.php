<?php
/*
 * Template Name:規約テンプレート
 */

get_header(); ?>

<div id="page-base" class="page-wrapper page-base p-constitution <?php echo $display_type; ?> <?php echo $login; ?>">
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
    
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap">
                <div class="row">
                    <div class="flame-body col-12">
                    <?php
                        $fields = CFS()->get('rule_list');
                        foreach ($fields as $field):
                    ?>
                        <div class="page-content-div mb-5">
                            <h2>
                                <?php echo $field['rule_name']; ?>
                            </h2>
                            <div class="page-content-div__about px-4 px-lg-5">
                                <?php echo $field['rule_about']; ?>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>