<?php
/*
 * Template Name: おすすめ保険
 */
get_header(); ?>

<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $member_type; ?> <?php echo $login; ?>">
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
        <div class="container d-block">
            <div class="insurance-list row">
                <section class="page-content-innerwrap col-12 col-md-4 pb-5">
                    <h3 class="insurance-name">団体総合生活補償保険</h3>
                    <div class="insurance-list__content my-3 mx-auto">
                        <a href="/insurance/sonpo/">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/icons/home/insurance_baner_01.png">
                        </a>
                    </div>
                </section>
                <section class="page-content-innerwrap col-12 col-md-4 pb-5">
                    <h3 class="insurance-name">全厚済ケアプラス保険</h3>
                    <div class="insurance-list__content my-3 mx-auto">
                        <a href="/insurance/care-plus/">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/icons/home/insurance_baner_02.png">
                        </a>
                    </div>
                </section>
                <section class="page-content-innerwrap col-12 col-md-4 pb-5">
                    <h3 class="insurance-name">全厚済ゴルファーエイド保険</h3>
                    <div class="insurance-list__content my-3 mx-auto">
                        <a href="/insurance/golfer-aid/">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/icons/home/insurance_baner_03.png">
                        </a>
                    </div>
                </section>
                <section class="page-content-innerwrap col-12 col-md-4 pb-5">
                    <h3 class="insurance-name">全厚済がんサポート保険</h3>
                    <div class="insurance-list__content my-3 mx-auto">
                        <a href="/insurance/cancer">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/icons/home/insurance_baner_05.png">
                        </a>
                    </div>
                </section>
            </div>
            <section class="net-insurance pb-5">
                <h3 class="insurance-name">インターネット保障保険</h3>
                <div class="net-about">
                    <div class="net-about__detail">
                        <p class="mb-0">自動車保険や海外旅行保険など様々なインターネット保障保険がそろっております。</p>
                    </div>
                    <div class="net-about___img">
                        <a href="https://nihonkyosai.co.jp/insurance_list/" target="_blank">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/insurance/insurance_baner_04.png">
                        </a>
                        <?php if($cfs->get('campaign') ): ?>
                            <div class="net-about__img__campaign">
                                <?php echo $cfs->get('campaign'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <section class="net-insurance">
                <h3 class="insurance-name">いぬとねこの保険</h3>
                <div class="net-about">
                    <div class="net-about__detail">
                        <p class="mb-0">新規ご加入いただいた全厚済会員様に会員特典としてオリジナルロゴ入りグッズをプレゼントいたします。</p>
                    </div>
                    <div class="net-about___img">
                        <a href="https://www.nihonpet.co.jp/landingpage/zenkosai/" target="_blank">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/insurance/insurance_baner_06.png">
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?>