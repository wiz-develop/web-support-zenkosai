<?php
/*
 * Template Name: はじめてガイド
 */
get_header(); ?>

<div id="page-non-member_faq" class="page-non-member_faq page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <div class="page-content-div mb-5">
                    <?php the_content();?>
                </div>
                <div class="page-content-div">
                <?php
                    $fields = CFS()->get('faq_list');
                    foreach ($fields as $field) :
                ?>
                    <div class="faq-content mb-5">
                        <div class="faq-content__tit">
                            <h2 class="mb-2"><?php echo $field['faq_tit']; ?></h2>  
                        </div>
                        <?php
                            $fields = $field['faq_item'];
                            foreach ((array)$fields as $field):
                        ?>
                            <div class="faq-content bg-white px-0">
                                <div class="faq-content__question acor-menu">
                                    <?php echo $field['faq_question']; ?>
                                </div>
                                <div class="faq-content__answer acor-menu-child w-100 p-3">
                                    <div class="d-flex bg-white px-2 py-3 faq-content__answer__txt">
                                        <div><?php echo $field['faq_answer']; ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                <?php
                    endforeach;
                ?>
                </div>
            </div>
            <div class="page-content-div">
                <div class="page-link_btn">
                    <a href="/contact/">
                        <div class="text-center">
                            <button class="btn border shadow-sm px-4 mt-3 mb-4 rounded-pill" style="background-color: #bbab72; color: white;">お問合せフォームはこちら</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>