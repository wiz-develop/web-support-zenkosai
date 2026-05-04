<?php
/*
 * Template Name: お問合せ
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
            <div class="row">
                <?php if ( is_page('contact') ): ?>
                    <div class="flame-side for-sp-nav col-lg-3 col-12 px-lg-0 mb-4 mb-lg-0">
                        <div class="page-content-innerwrap">
                            <div class="link-btn">
                                <a href="#mail-contact">
                                    <button class="showall-btn">
                                        <p class="mb-0">メールでのお問合せ</p>
                                    </button>
                                </a>
                            </div>
                            <div class="link-btn">
                                <a href="#tel-contact">
                                    <button class="showall-btn">
                                        <p class="mb-0">電話でのお問合せ</p>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="flame-body col-12 col-lg-9">
                    <div class="page-content-innerwrap">
                        <div class="page-content-div questionnaire-note">
                            <p class="mb-0">
                            現在、当会への紹介の説明を受けられた方へのアンケートのご協力をお願いいたしております。<br>
                            ご入会された、ご入会されなかったに関わりなく、お話を聞かれた際にお気づきの点がございましたらお聞かせいただけますようお願いいたします。
                            </p>
                            <div class="questionnaire-link">
                                <a href="/questionnaire/">
                                    <button>
                                        <p class="mb-0">アンケートはこちら</p>
                                    </button>
                                </a>
                            </div>
                            <div class="raino">
                                <img src="/cms/wp-content/themes/zenkosai/assets/images/raino/raino.png" alt="ライノくん">
                            </div>
                        </div>
                        <div id="mail-contact" class="page-content-div container web-form mt-5">
                            <?php if ( is_page('contact') ): ?>
                                <h2>メールでのお問合せ</h2>
                            <?php endif; ?>
                                <div class="row">
                                    <div class="col-lg">
                                        <div class="service-experience-form web-form mt-5">
                                            <?php if ( is_page('contact') ): ?>
                                                <div class="contact-flow">
                                                    <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1.png">
                                                    <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1_sp.png">
                                                </div>
                                                <p class="mb-0">ご質問などございましたらお気軽にお申し付けください。</p>
                                                <p class="mb-0">※ ご返信には3営業日ほどお時間をいただくことがございます。<br>お急ぎの場合はお手数ですが、お電話くださいますようお願い申し上げます。</p>
                                            <?php endif; ?>
                                            <?php if ( is_page('suggestion') ): ?>
                                                <div class="contact-flow">
                                                    <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1.png">
                                                    <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/contact/step1_sp.png">
                                                </div>
                                                <p class="mb-0">会へのご意見・ご提案などご記入のうえ、送信してください。<br>なお、返信は行っておりませんのであらかじめご了承ください。</p>
                                            <?php endif; ?>
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if ( is_page('contact') ): ?>
                                <div id="tel-contact" class="page-content-div tel-contact">
                                    <h2>電話でのお問合せ</h2>
                                    <div class="contact-ryno-div position-relative text-center mt-5 mb-3 mx-auto p-1">
                                        <div class="tel-mobile rounded05 py-1 px-2 mb-1 mx-3">
                                            <p class="mb-0">全厚済サポートデスク</p>
                                            <a href="tel:050-8881-8878">
                                                <div class="d-flex mx-3">
                                                    <div class="tel-imgbox">
                                                        <img class="p-1" src="/cms/wp-content/themes/zenkosai/assets/images/icons/home/home_contact_tel_mobile.png">
                                                    </div>
                                                    <!-- TODO:電話番号リンク -->
                                                    <p class="bold mb-0 pl-3">050-8881-8878</p>
                                                </div>
                                            </a>
                                            <p class="mb-0">（平日10時～17時）</p>
                                            <p class="mb-0 pt-1 d-sm-none" style="line-height: 1.2"><small>※ダイヤルをタップすると<br>お電話がかかります</small></p>
                                        </div>
                                    </div>
                                </div>
                                <div id="tel-contact" class="page-content-div tel-contact">
                                    <h2>お問合せいただく際のお願い</h2>
                                    <div class="page-content-div mb-3">
                                        <?php echo $cfs->get('contact_caution'); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php get_footer(); ?>
<?php if($_SESSION['member_info']): ?>
<?php
    $m_id   = $_SESSION['member_info']['member_id'];
    $m_name = $_SESSION['member_info']['member_name'];
    console_log($m_id);
?>
<script>
jQuery(function($){
    // 会員IDを入力する
    console.log('sxad');
    var m_id = <?php echo (int)$m_id; ?>;
    $('input#member_id').val(m_id);

    // 会員氏名を入力する
    var m_name = <?php echo "'".$m_name."'"; ?>;
    $('input#name').val(m_name);

});
</script>
<?php endif;?>