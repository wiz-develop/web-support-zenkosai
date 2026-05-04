<?php
/*
 * Template Name: アンケート
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
            <div class="row">
                <div class="flame-body">
                    <div class="page-content-innerwrap">
                        <?php if ( is_page('questionnaire') ): ?>
                            <div class="page-content-div questionnaire-note">
                                <h2>勧誘を受けた皆様へ</h2>
                                <p class="mb-0">
                                    <?php echo $cfs->get('solicitation_info'); ?>
                                </p>
                            </div>
                            <div id="tel-contact" class="page-content-div tel-contact">
                                <h2><?php echo $cfs->get('list_title'); ?></h2>
                                <div class="contact-ryno-div position-relative text-center mt-5 mb-3 mx-auto p-1">
                                    <div class="address py-1 px-2 p-2 mx-3">
                                        <p class="mb-0">
                                            一般財団法人全国福利厚生共済会<br>
                                            〒675-0067　兵庫県加古川市加古川町河原333-1
                                        </p>
                                    </div>
                                    <div class="contact-info mx-auto">
                                        <div class="tel-free">
                                            <p class="tel-free-title mb-0">全厚済サポートデスク</p>
                                            <a href="tel:050-8881-8878">
                                                <div class="d-flex mx-3">
                                                    <div class="tel-imgbox">
                                                        <i class="fas fa-phone-alt"></i>
                                                    </div>
                                                    <p class="mb-0 pl-3">050-8881-8878<br class="d-sm-none">（平日10時～17時）</p>
                                                </div>
                                            </a>
                                            <p class="mb-0 pt-1 d-sm-none bg-transparent" style="line-height: 1.2"><small>※ダイヤルをタップすると<br>お電話がかかります</small></p>
                                        </div>
                                        <div class="tel-free">
                                            <p class="tel-free-title mb-0">FAX</p>
                                            <div class="d-flex mx-3">
                                                <div class="tel-imgbox">
                                                    <i class="fas fa-fax"></i>
                                                </div>
                                                <p class="mb-0 pl-3">079-457-0600</p>
                                            </div>
                                        </div>
                                        <div class="tel-free">
                                            <p class="tel-free-title mb-0">メール</p>
                                            <div class="d-flex mx-3">
                                                <div class="tel-imgbox">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                                <p class="mb-0 pl-3">kyosai@kknw.jp</p>
                                            </div>
                                        </div>
                                        <div class="tel-free">
                                            <p class="tel-free-title mb-0">ホームページ</p>
                                            <div class="d-flex mx-3">
                                                <div class="tel-imgbox">
                                                    <i class="far fa-window-maximize"></i>
                                                </div>
                                                <p class="mb-0 pl-3">
                                                    <a href="https://www.zenko-sai.or.jp/">
                                                        https://www.zenko-sai.or.jp/
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div id="mail-contact" class="page-content-div container web-form mt-5">
                            <?php if ( is_page('questionnaire') ): ?>
                                <h2>アンケート</h2>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-lg">
                                    <div class="service-experience-form web-form mt-5">
                                        <?php if ( is_page('questionnaire') ): ?>
                                            <div class="contact-flow">
                                                <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1.png">
                                                <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1_sp.png">
                                            </div>
                                        <?php endif; ?>
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
    // 既にQ1が選択されていた場合紐づく質問を表示
    if ($('input[name=radio-join]:checked').val() == '入会した') {
        $('.watch.who-entered').removeClass('d-none');
    }
    if ($('input[name=radio-join]:checked').val() == '入会しなかった' || $('input[name=radio-join]:checked').val() == '検討している') {
        $('.watch.who-n-entered').removeClass('d-none');
    }
    // Q1の回答が変わった時
    $('input[name=radio-join]').change(function() {
        $('.watch').addClass('d-none');
        if ($(this).val() == '入会した') {
            $('.watch.who-entered').removeClass('d-none');
            $('.watch.who-n-entered').find('input:radio[name=radio-join-off][value=未選択]').trigger("click");
        }
        if ($(this).val() == '入会しなかった' || $(this).val() == '検討している') {
            $('.watch.who-n-entered').removeClass('d-none');
            $('.watch.who-entered').find('input:radio[name=radio-join-on][value=未選択]').trigger("click");
        }
    });
    // その他が選択された時teatareaを必須項目に設定（TODO:submitしたら必須じゃなくなる）
    $('input').change(function() {
        if ($(this).val() == 'その他') {
            $(this).parents('.wpcf7-form-control-wrap').siblings('.answer-area.other-free').find('textarea')
            .attr('aria-required', true)
            .addClass('wpcf7-validates-as-required');
        }else{
            $(this).parents('.wpcf7-form-control-wrap').siblings('.answer-area.other-free').find('textarea')
            .attr('aria-required', false)
            .removeClass('wpcf7-validates-as-required');
            // .val('');
        }
    });
    // submit時Q1に紐づく質問でその他を選択していなかった場合textareaの値をクリア
    $("input[value='確認する']").click(function(){
		if($('input[name=radio-join]:checked').val() == '入会した'){
            $('textarea[name=textarea-join-off-free]').val('');
            if($('input[name=radio-join-on]:checked').val() !== 'その他'){
                $('textarea[name=textarea-join-on-free]').val('');
            }
        }
        if ($('input[name=radio-join]:checked').val() == '入会しなかった' || $('input[name=radio-join]:checked').val() == '検討している') {
            $('textarea[name=textarea-join-on-free]').val('');
            if($('input[name=radio-join-off]:checked').val() !== 'その他'){
                    $('textarea[name=textarea-join-off-free]').val('');
                }
            }
     });
});
</script>
<?php if($post->post_name == 'confirmation'): ?>
<script>
jQuery(function($){
    text = $('.first-question .container:first .answer .answer-area').text();
    if (text.indexOf('入会した') !== -1) {
        $('.first-question .container:nth-child(3)').addClass('d-none');
    }
    if (text.indexOf('入会しなかった') !== -1 || text.indexOf('検討している') !== -1) {
        $('.first-question .container:nth-child(2)').addClass('d-none');
    }
    thirdtext = 0;
    $('.inputbox.free-third').each(function (){
        text = $(this).find('.inputarea').text();
        text = text.replace(/\s+/g, "");
        if(text == 0){
            $(this).addClass('d-none');
        }else{
            thirdtext = text;
        }
    });
    if(thirdtext == 0){
        $('.inputbox.third-question').addClass('d-none');
    }
});
</script>
<?php endif; ?>
