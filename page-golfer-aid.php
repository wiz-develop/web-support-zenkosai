<?php
/*
 * Template Name: 全厚済ゴルファーエイド保険
 */
$today_ts = strtotime(date("Y-m-d")); // 本日: 2026-03-31

// セッションから開始日取得（2026.03.31 などの形式を考慮）
$raw_startday = isset($_SESSION['member_info']['startdate']) ? $_SESSION['member_info']['startdate'] : "";
if (!$raw_startday) {
    $raw_startday = "2026-04-01"; // デフォルト値
}

// ドットをハイフンに置換して strtotime が読める形式にする
$clean_startday = str_replace('.', '-', $raw_startday);
$start_ts = strtotime($clean_startday);

// 2. 判定：本日が開始日「以上」であれば true
$is_started = ($today_ts >= $start_ts);

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
        <div class="container">
            <div class="page-content-innerwrap">
                <?php
                    $insurance_images = $cfs->get('insurance_images');
                    foreach($insurance_images as $insurance_image) :
                ?>
                    <img src="<?php echo $insurance_image['app_image']; ?>" alt="全厚済ゴルファーエイド保険のご案内" width="100%" height="auto" class="aligncenter size-full" />
                <?php endforeach; ?>
                    <div class="link-list">
                        <div class="link-btn">
                            <a href="<?php echo $cfs->get('app_pdf'); ?>" target="_blank" rel="noopener noreferrer" class="gtm-click-download" data-gtm-click="<?php echo strip_tags(get_the_title()).' 詳しい内容はこちら'; ?>">
                                <button>詳しい内容はこちら</button>
                                <p class="mb-0">※ 必ずご確認ください</p>
                            </a>
                        </div>
                       <?php if ($member_type == 'p_member' || $member_type == 'k_member'): ?>
                            <?php if ($is_started): ?>
                                <div class="link-btn">
                                    <a href="<?php echo $cfs->get('app_link'); ?>" target="_blank" rel="noopener noreferrer" class="gtm-click-link" data-gtm-click="<?php echo strip_tags(get_the_title()).' お申し込みはこちら'; ?>">
                                        <button class="app-btn">お申し込みはこちら</button>
                                    </a>
                                </div>
                            <?php else: ?>
                                <div class="link-btn">
                                    <button class="app-btn disabled" disabled>お申し込みはこちら</button>
                                    <p class="mb-0 mt-2 text-danger">※サービス利用開始日以降にご利用ください。</p>
                                </div>
                            <?php endif; ?>

                        <?php elseif ($member_type == 'ps_member' || $member_type == 'ks_member'): ?>
                            <div class="link-btn">
                                <button class="app-btn disabled" disabled>お申し込みはこちら</button>
                                <p class="mb-0 mt-2 text-danger">※サービス受領者はお申込みいただけません。</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="page-content-div">
                        <section>
                            <?php
                                $app_supplement = CFS()->get('app_supplement');
                                if ($app_supplement) :
                            ?>
                                <?php echo $app_supplement; ?>
                            <?php endif; ?>
                        </section>
                        <section>
                            <p class="mb-0">メンテナンスについて<br>全厚済ゴルファーエイド保険のネット申込みは、メンテナンスの為アクセスいただけない日がございます。<br>メンテナンス日の確認は下記の専用フリーダイヤルまたは専用ダイヤルまでお問合せください。</font></p>
                        </section>
                        <section>
                            <h2 class="mt-4">お電話でのお申込みはこちら</h2>
                                <div class="application-detail">
                                    <p class="mb-3">会員IDをご準備のうえお電話ください。<br><font color="#d53024">※ 既にご加入中の会員様が新たにご家族をお申込みの場合は、インターネットでお申込みはいただけません。保険事業部までご連絡ください。</font><br class="sp-br"></p>
                                    <p>日本共済株式会社 保険事業部</p>
                                    <p class="mb-3">＜専用フリーダイヤル＞<br class="sp-br"><span><font color="#d53024">0120–990–011</font></span><br class="sp-br"><span class="reception-time">（直通）受付：平日10時～17時</span><br class="sp-br"></p>
                                    <p>＜専用ダイヤル＞<br class="sp-br"><span><font color="#d53024">079–457–3131</font></span><span class="reception-time"><br class="sp-br">（直通）受付：平日10時～17時</span></p>
                                </div>
                        </section>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>