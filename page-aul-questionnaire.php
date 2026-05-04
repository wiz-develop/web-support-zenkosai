<?php
/*
 * Template Name: アンケート（あうる）
 */
get_header();

$m_id   = $_SESSION['member_info']['member_id'];
$m_name = $_SESSION['member_info']['member_name'];
$mail = $_SESSION['member_info']['mail'];
if ( ! session_id() ) {
    session_start();
}
$_SESSION['form_start_time'] = time();
?>

<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header mb-5">
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
                        <h1 class="mb-0">会報誌aul【あうる】に関するアンケート</h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="row">
                <div class="flame-body">
                    <div class="page-content-innerwrap">
                        <div id="mail-contact" class="page-content-div container web-form mt-5">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="service-experience-form web-form mt-5">
                                        <div class="contact-flow">
                                            <?php if ( is_page('aul-questionnaire') ): ?>
                                                <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1.png">
                                                <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1_sp.png">
                                            <?php elseif (is_page('aul-questionnaire/confirmation')): ?>
                                                <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step2.png">
                                                <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step2_sp.png">
                                            <?php elseif (is_page('aul-questionnaire/thanks')): ?>
                                                <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step3.png">
                                                <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step3_sp.png">
                                            <?php endif; ?>
                                        </div>
                                        <?php the_content(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

<script>
jQuery(function($){
    // 会員IDを入力する
    <?php if ($m_id) : ?>
    var m_id = <?php echo (int)$m_id; ?>;
    $('.js-member_id').val(m_id);
    $('.js-member_id').prop('readonly', true).addClass('border-0').addClass('bg-white');
    <?php endif; ?>

    // 会員氏名を入力する
    <?php if ($m_name) : ?>
    var m_name = <?php echo "'".$m_name."'"; ?>;
    $('.js-member_name').val(m_name);
    $('.js-member_name').prop('readonly', true).addClass('border-0').addClass('bg-white');
    $('.js-member_name').on('mousedown', function(){
        setTimeout(function(){
            $('.js-member_name').focus();
        }, 1);
        return false;
    });
    <?php endif; ?>

    // メールアドレスを入力する
    var mail = <?php echo "'".$mail."'"; ?>;
    if (!$('.js-mail').val()) {
         $('.js-mail').val(mail);
    }

    if ($('.mw_wp_form_input').length) {
        // 入力画面
        if (!$('input:checkbox[value="その他"]').is(':checked')) {
            $('.open').css('display', 'none');
            $('.open textarea[name="good_plan_comment"]').prop('disabled', true);
        }
    } else if ($('.mw_wp_form_confirm').length) {
        // 確認画面
        if ($.inArray('その他', $('input:hidden[name="good_plan[data]"]').val().split(',')) == -1) {
            $('.open').css('display', 'none');
            $('.open textarea[name="good_plan_comment"]').prop('disabled', true);
        }
    }
    $("#browse_owl span:nth-child(6)").click(function(){
        if($('input:checkbox[value="その他"]').is(':checked')) {
            $('.open').slideDown('fast');
            $('.open textarea[name="good_plan_comment"]').prop('disabled', false);
        } else {
            $('.open').slideUp('fast');
            $('.open textarea[name="good_plan_comment"]').prop('disabled', true);
        }
    });
});
</script>