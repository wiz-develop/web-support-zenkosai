<?php
/*
 * Template Name: サービス利用申請フォーム 注意書きページ
 */
get_header();
console_log($_SESSION['member_info']);

$page_slug = $post->post_name;
?>
<div id="page-page-child-celebration-form" class="page-page-child-celebration-form page-form_service page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
    <div class="page-content-wrapper py-5 mb-5">
        <div class="container">
            <div class="content">
                <div class="content__body">
                    <div class="service-form-wrap">
                        <div class="service-form-wrap__content">
                            <?php the_content() ?>
                        </div>
                        <div class="service-form-wrap__content s_check-content px-4">
                            <ul class="s_check-list list-unstyled mt-0">
                            <?php
                                $fields = CFS()->get('service_check_list');
                                foreach ($fields as $field) :
                                    $id = uniqid('checkbox_');
                            ?>
                                <li class="attention-check mb-0 d-flex align-items-center">
                                    <div class="question d-flex align-items-baseline col-8 col-md-8 col-lg-8">
                                        <p class="mb-0"><?php echo $field['s_question']; ?></p>
                                    </div>
                                    <div class="check-tem d-flex align-items-baseline col-4 col-md-4 col-lg-4">
                                        <input type="checkbox" id="<?php echo $id; ?>" name="type[]" value="<?php echo $field['id']; ?>" class="service-check-ok position-relative">
                                        <label for="<?php echo $id; ?>" class="s_check-label mb-0 pl-2"><?php echo $field['s_check-item']; ?></label>
                                    </div>
                                </li>
                            <?php
                                endforeach;
                            ?>
                            </ul>
                        </div>
                        <div class="service-form-wrap__content s_check-content px-4">
                            <div class="s_check-note">
                                <?php echo $cfs->get('s_check-note'); ?>
                            </div>
                            <div class="link-list text-center mt-5">
                                <a href="<?php echo $cfs->get('s_form-link'); ?>" class="service-form-link py-2 px-4 rounded-pill"><span class="pr-2">利用申請する</span><i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
