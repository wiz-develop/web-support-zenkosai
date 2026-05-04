<?php
/*
 * Template Name: カムバック保険
 */
if ( session_status() === PHP_SESSION_NONE ) {
    @session_start();
}

$today = date("Y/m/d");
$m_info = isset($_SESSION['member_info']) ? $_SESSION['member_info'] : [];

// A: サービス利用開始日判定
$startday = isset($m_info['startdate']) ? $m_info['startdate'] : "";
if (!$startday) {
    $startday = "2022/07/01"; 
}
$is_started = (strtotime($today) >= strtotime($startday));
$display_date_ja = date("Y年n月j日", strtotime($startday));

// B: サービス受領者判定 (PS会員 または KS会員)
$member_type = isset($m_info['member_type']) ? $m_info['member_type'] : '';
$is_service_recipient = ($member_type === 'ps_member' || $member_type === 'ks_member');

// C: 法人・個人事業主判定 (代表者名が設定されているかで判定)
$position_name = isset($m_info['position_name']) ? trim($m_info['position_name']) : '';
$is_corporate = ($position_name !== '');

// D: メールアドレス未登録判定
$mail_judge = isset($m_info['mail_judge']) ? $m_info['mail_judge'] : true; 
$mail = isset($m_info['mail']) ? trim($m_info['mail']) : '';
$is_no_mail = (!$mail_judge || $mail_judge === 'false' || $mail === '');

// ボタン制御の判定とメッセージ生成
$disabled_reasons = [];

if ($is_corporate || $is_service_recipient) {
    // 【優先】B・Cに該当する場合は、A・Dの理由は表示しない
    if ($is_corporate) {
        $disabled_reasons[] = '法人登録・個人事業主登録の会員様はお申込みいただけません。';
    }
    if ($is_service_recipient) {
        $disabled_reasons[] = 'サービス受領者は保険の契約者としてお申込みはいただけませんが、<br>契約者からお申込みいただくと、被保険者となることができます。';
    }
} else {
    // P・K会員の場合（A または D のチェック）
    if (!$is_started) {
        $disabled_reasons[] = "サービス利用開始日以降からお申込みいただけます。<br>（サービス利用開始日は{$display_date_ja}です。）";
    }
    if ($is_no_mail) {
        $disabled_reasons[] = 'お申込みにはメールアドレス登録が必要です。<br>マイページよりメールアドレスをご登録ください。<br><a href="https://test-mypage.zenko-sai.or.jp/contractor-info" target="_blank">メールアドレスを登録する<i class="fa-solid fa-arrow-up-right-from-square pl-2"></i></a>';
    }
}

// 理由が1つでもあればグレーアウトさせる
$is_disabled = !empty($disabled_reasons);
$disabled_class = $is_disabled ? ' is-disabled' : '';
$tabindex = $is_disabled ? '-1' : '0';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hl_nonce']) ) {
    
    // Nonceチェック：お申込みボタン経由の時だけチェックされるのでエラーになりません
    if ( empty($_POST['hl_nonce']) || ! function_exists('wp_verify_nonce') || ! wp_verify_nonce( $_POST['hl_nonce'], 'hl_redirect' ) ) {
        wp_die('Invalid request (nonce).');
    }

    // --- encryptedMemberId の取得 ---
    if ( empty($_SESSION['member_info']) || empty($_SESSION['member_info']['member_id']) ) {
        wp_safe_redirect( home_url('/') );
        exit;
    }
    $raw_member_id = $_SESSION['member_info']['member_id'];
    $member_id = substr( $raw_member_id, -8 );

    if ( ! function_exists('_encrypt') ) {
        wp_die('Server error: encryption function missing.');
    }
    $password = 'ZenkosaiOpenSSLEncrypt';
    $encryptedMemberId = _encrypt( $member_id, $password );

    // --- ペイロード作成 ---
    $payload_arr = array(
        'encryptedMemberId' => $encryptedMemberId,
        'encyptedMemberId'  => $encryptedMemberId,
    );
    $payload = wp_json_encode( $payload_arr );

    // --- HL API へ JSON POST ---
    if ( ! defined('HL_INTEGRATION_API_URL') ) {
        define('HL_INTEGRATION_API_URL', 'https://hayateuat-bff-sandbox-jp.insuremo.jp/api/hayateuat/hayate-ext-bff/bff/integration/NWEB162');
    }
    if ( ! defined('HL_APPLICATION_REDIRECT_BASE') ) {
        define('HL_APPLICATION_REDIRECT_BASE', 'https://hayateuat-bff-sandbox-jp.insuremo.jp/application/#/auth/login?member_id=');
    }

    $ch = curl_init( HL_INTEGRATION_API_URL );
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen( $payload )
    ) );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 10 );
    curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );

    $response = curl_exec( $ch );
    curl_close( $ch );

    // --- HL 申込画面へリダイレクト ---
    $redirect_url = HL_APPLICATION_REDIRECT_BASE . rawurlencode( $encryptedMemberId );
    wp_redirect( $redirect_url );
    exit;
}

get_header();
?>

<div id="page-<?php echo CFS()->get('css'); ?>" class="page-<?php echo CFS()->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo home_url();?>"><span itemprop="name"><i class="fa fa-home"></i> HOME</span></a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <span itemprop="name"><?php the_title(); ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top">
            <div class="page-top__title">
                <div class="page-top__title__icon">
                    <h1 class="mb-0"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper columns cb-lp-scope cb-full-width-wrapper">
        <section class="cb-section cb-hero">
            <div class="container">
                <h2 class="cb-hero__title">
                   <img src="<?php echo CFS()->get('logo_img'); ?>" alt="カムバック">
                </h2>
                
                <p class="cb-hero__sub">突然の病気や不慮の事故に<br>一時金という<span class="highlight-text">備え</span>を</p>
                
                <div class="cb-hero__price-wrap">
                    <div class="cb-hero__price-box">
                        <p class="cb-hero__price-text">保険料 月々</p>
                        <p class="cb-hero__price-num">
                            <span class="num">
                                <?php 
                                $premium = CFS()->get('insurance_premium'); 
                                echo $premium ? $premium : '590';
                                ?>
                            </span>
                            <span class="unit">円から</span>
                            <span class="asterisk">※1</span>
                        </p>
                        <p class="cb-hero__price-note">
                            ※1 <?php echo CFS()->get('insurance_note') ? CFS()->get('insurance_note') : '男性・女性ともに18〜39歳の場合'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <div class="cb-sticky-nav-wrapper">
            <section id="js-sticky-nav" class="cb-sticky-nav">
                <div class="container">
                    <div class="row">
                        <?php 
                        $page_links = CFS()->get('page_link');
                        if(!empty($page_links)):
                            foreach($page_links as $link):
                        ?>
                            <div class="col-3 mb-2 mb-md-0 px-1">
                                <a href="#<?php echo $link['page_link_id']; ?>" class="cb-nav-btn" style="border-color: <?php echo $link['page_link_color']; ?>; color: <?php echo $link['page_link_color']; ?>;">
                                    <span class="text"><?php echo $link['page_link_name']; ?></span>
                                    <i class="fa-solid fa-angle-right fa-rotate-90"></i>
                                </a>
                            </div>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                </div>
            </section>
        </div>
        <?php
            $cb_notices = CFS()->get('cb_notices');
            $cb_notices_modal_btn = CFS()->get('cb_notices_modal_btn');
            $cb_notices_modal_title = CFS()->get('cb_notices_modal_title');
            if ($cb_notices) :
        ?>
        <div class="modal_trigger provider-modal-btn position-relative text-left text-md-center d-flex justify-content-start bg-white">
            <p class="mb-0 pl-3 pl-md-3 py-2" style="color: #0056b3;"><?php echo $cb_notices_modal_btn; ?></p>
            <svg class="position-absolute b-0" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415" fill="#0056b3">
                <g transform="translate(8176.361 -1665.095)">
                    <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"></rect>
                    <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"></path>
                </g>
            </svg>
        </div>
        <div class="modal_box" style="display: block;">
            <div class="modal_bg"></div>
            <div class="modal_inner">
                <div class="modal_close close-bth">
                    <span>×</span>
                </div>
                <div class="modal_block">
                    <div class="provider-modal-content">
                        <?php if ($cb_notices_modal_title) : ?>
                            <div class="article-title my-3 px-2 py-1">
                                <p class="mb-0 font-weight-bold"><?php echo $cb_notices_modal_title; ?></p>
                            </div>
                        <?php endif; ?>
                        <div>
                            <?php echo $cb_notices; ?>
                        </div>
                    </div>
                </div>
                <div class="modal_close">
                    <div class="rounded-pill">
                        閉じる<span class="pl-3">×</span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <section class="cb-section cb-director-acc">
            <div class="container">
                <div class="cb-acc js-cb-accordion">
                    <button class="cb-director-trigger js-cb-accordion-trigger">
                        <span class="title"><?php echo CFS()->get('director_tit'); ?></span>
                        <span class="btn-view">見る</span>
                    </button>
                    <div class="cb-acc__content js-cb-accordion-content">
                        <div class="cb-acc__inner text-center">
                            <div class="cb-about__desc text-left">
                                <?php echo CFS()->get('director_about'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="cb-section cb-features mt-5">
            <div class="container">
                <h3 class="cb-section-title">カムバックの特徴</h3>
                <div class="cb-features__circles">
                    <?php
                    $features_list = CFS()->get('features_list');
                    if ( !empty($features_list) ) :
                        foreach ( $features_list as $feature ) :
                    ?>
                        <div class="circle" style="background-color: <?php echo $feature['features_bg_color']; ?>; border-color: <?php echo $feature['features_border_color']; ?>;">
                            <div class="desc">
                                <div class="desc__icon">
                                    <img src="<?php echo $feature['features_icon']; ?>">
                                </div>
                                <?php echo $feature['features_about']; ?>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>

                <div class="cb-features__examples">
                    <h4 class="cb-features__ex-title">例えばこんな保障</h4>
                    <div class="ex-grid">
                        <?php 
                        $ex_list = CFS()->get('features_insurance_ex_list');
                        if(!empty($ex_list)):
                            foreach($ex_list as $ex):
                        ?>
                            <div class="ex-item">
                                <div class="ex-icon">
                                    <?php if($ex['features_insurance_img']): ?>
                                        <img src="<?php echo $ex['features_insurance_img']; ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <p><?php echo $ex['features_insurance_tit']; ?></p>
                            </div>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="cb-section cb-risk">
            <div class="container">
                <h3 class="cb-section-title">突然の入院、その時あなたは大丈夫ですか？</h3>
            </div>
        </section> -->

        <section id="<?php echo CFS()->get('warranty_details_page_link'); ?>" class="cb-section cb-warranty">
            <div class="container">
                <h3 class="cb-section-title"><?php echo $page_links[0]['page_link_name']; ?></h3>
                <?php if(CFS()->get('warranty_details_about')): ?>
                    <p class="cb-warranty__lead"><?php echo CFS()->get('warranty_details_about'); ?></p>
                <?php endif; ?>

                <div class="cb-warranty__list">
                    <?php 
                    $warranty_list = CFS()->get('warranty_details_list');
                    if(!empty($warranty_list)):
                        foreach($warranty_list as $warranty):
                            // デザイン連動用の色取得（CFS設定画面から）
                            $theme_color = $warranty['warranty_conditions_tit_color'];
                            $bg_color = $warranty['warranty_conditions_bg'];
                    ?>
                        <div class="cb-acc js-cb-accordion">
                            <button class="cb-acc__trigger js-cb-accordion-trigger" style="border-color: <?php echo $theme_color; ?>;">
                                <div class="title-wrap">
                                    <?php if($warranty['warranty_details_tit_icon']): ?>
                                        <div class="acc-icon-wrap">
                                            <img src="<?php echo $warranty['warranty_details_tit_icon']; ?>" alt="" class="acc-icon">
                                        </div>
                                    <?php endif; ?>
                                    <span style="color: <?php echo $theme_color; ?>;"><?php echo $warranty['warranty_details_tit']; ?></span>
                                </div>
                                <span class="acc-arrow" style="border-color: <?php echo $theme_color; ?>;"></span>
                            </button>
                            
                            <div class="cb-acc__content js-cb-accordion-content">
                                <div class="cb-acc__inner">
                                    <div class="warranty-desc theme-dot-list" style="--dot-color: <?php echo $theme_color; ?>;">
                                        <?php echo $warranty['warranty_details_txt']; ?>
                                    </div>
                                    
                                    <?php 
                                    $conditions = $warranty['warranty_details_conditions_list'];
                                    if(!empty($conditions)):
                                    ?>
                                        <div class="cb-conditions-box" style="background-color: <?php echo $bg_color; ?>;">
                                            <h4 class="cb-conditions-box__title" style="color: <?php echo $theme_color; ?>;">
                                                【<?php echo $warranty['warranty_conditions_sub_tit']; ?>】
                                            </h4>
                                            
                                            <div class="cb-sub-acc-wrap">
                                                <?php foreach($conditions as $cond): ?>
                                                    <div class="cb-sub-acc js-cb-accordion">
                                                        <button class="cb-sub-acc__trigger js-cb-accordion-trigger">
                                                            <span style="color: #333;"><?php echo $cond['conditions_tit']; ?></span>
                                                            <span class="acc-arrow"></span>
                                                        </button>
                                                        <div class="cb-sub-acc__content js-cb-accordion-content">
                                                            <div class="cb-sub-acc__inner">
                                                                <?php echo $cond['conditions_about']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif; 
                    ?>
                </div>
            </div>
        </section>

        <section id="<?php echo CFS()->get('your_insurance_pre_page_link'); ?>" class="cb-section cb-premium">
            <div class="container">
                <h3 class="cb-section-title"><?php echo $page_links[1]['page_link_name']; ?></h3>
                <?php if(CFS()->get('your_insurance_pre_about')): ?>
                    <p class="cb-warranty__lead"><?php echo CFS()->get('your_insurance_pre_about'); ?></p>
                <?php endif; ?>
                <?php if(CFS()->get('your_insurance_pre_catch')): ?>
                    <p class="cb-premium__catch"><?php echo CFS()->get('your_insurance_pre_catch'); ?></p>
                <?php endif; ?>

                <div class="cb-table-scroll-wrap">
                    <span class="scroll-hint">横にスクロールしてご覧ください →</span>
                    <div class="cb-table-scroll">
                        <table class="cb-table">
                            <thead>
                                <tr>
                                    <th>年齢帯</th>
                                    <?php 
                                    $price_age_cols = CFS()->get('price_age_cols');
                                    if(!empty($price_age_cols)):
                                        foreach($price_age_cols as $age_col): 
                                    ?>
                                        <th><?php echo $age_col['age_label']; ?></th>
                                    <?php 
                                        endforeach;
                                    endif; 
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $price_rows = CFS()->get('price_rows');
                                if(!empty($price_rows)):
                                    foreach($price_rows as $row): 
                                ?>
                                    <tr>
                                        <td><?php echo $row['gender_label']; ?></td>
                                        <?php 
                                        $prices_list = $row['prices_list'];
                                        if(!empty($prices_list)):
                                            foreach($prices_list as $price_cell):
                                        ?>
                                            <td style="color: <?php echo $price_cell['price_txt_color']; ?>;">
                                                <?php echo $price_cell['price']; ?>円
                                            </td>
                                        <?php 
                                            endforeach;
                                        endif;
                                        ?>
                                    </tr>
                                <?php 
                                    endforeach;
                                endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if(CFS()->get('your_insurance_pre_img')): ?>
                    <div class="cb-premium__img mt-5">
                        <?php echo CFS()->get('your_insurance_pre_img'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="<?php echo CFS()->get('benefits_page_link'); ?>" class="cb-section cb-benefits">
            <div class="container">
                <h3 class="cb-section-title">
                    <?php 
                    // $page_links = CFS()->get('page_link');
                    // if (isset($page_links[2])) {
                    //     echo $page_links[2]['page_link_name']; 
                    // }
                    ?>
                    保険金・給付金
                </h3>
                
                <div class="cb-table-scroll-wrap">
                    <span class="scroll-hint">横にスクロールしてご覧ください →</span>
                    <div class="cb-table-scroll">
                        <table class="cb-table cb-table--benefits-v2">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="empty-cell"></th>
                                    <th rowspan="2">災害死亡<br>保険金</th>
                                    <th rowspan="2">災害入院<br>一時金</th>
                                    <th rowspan="2">災害手術<br>一時金</th>
                                    <th colspan="2" class="nested-header">12疾病一時金</th>
                                    <th rowspan="2">二大疾病<br>死亡保険金</th>
                                </tr>
                                <tr>
                                    <th class="sub-header">3大疾病</th>
                                    <th class="sub-header">9疾病</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $benefit_rows = CFS()->get('benefit_rows');
                                if(!empty($benefit_rows)):
                                    foreach($benefit_rows as $row_index => $row): 
                                ?>
                                    <tr>
                                        <th><?php echo $row['benefit_row_title']; ?></th>
                                        <?php 
                                        $cells = $row['benefit_cells'];
                                        if(!empty($cells)):
                                            foreach($cells as $cell_index => $cell):
                                                // 3行目（通算支払限度）かつ「合計で3回」のセル（通常2番目の入力）に特殊クラスを付与
                                                $is_total_merged = ($row_index === 2 && $cell['benefit_col_span'] == "3");
                                                $cell_class = $is_total_merged ? 'cell-total-merge' : '';
                                        ?>
                                            <td colspan="<?php echo $cell['benefit_col_span']; ?>" class="<?php echo $cell_class; ?>">
                                                <?php echo $cell['benefit_cell_value']; ?>
                                            </td>
                                        <?php 
                                            endforeach;
                                        endif;
                                        ?>
                                    </tr>
                                <?php 
                                    endforeach;
                                endif; 
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php if(CFS()->get('benefits_note')): ?>
                    <div class="cb-benefits__note">
                        <?php echo CFS()->get('benefits_note'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section class="cb-section cb-contract">
            <div class="container">
                <h3 class="cb-section-title">契約期間</h3>
                <div class="cb-simple-table-wrap">
                    <table class="cb-simple-table">
                        <tbody>
                            <?php 
                            $contract_list = CFS()->get('contract_period_list');
                            if(!empty($contract_list)):
                                $count = 1;
                                foreach($contract_list as $contract):
                            ?>
                                <tr>
                                    <th><?php echo $count++; ?>. <?php echo $contract['contract_period_tit']; ?></th>
                                    <td><?php echo $contract['contract_period_about']; ?></td>
                                </tr>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="cb-section cb-notice">
            <div class="container">
                <h3 class="cb-section-title">告知内容</h3>
                <div class="cb-notice__box">
                    <?php if(CFS()->get('announcement_about')): ?>
                        <p class="cb-warranty__lead mb-3"><?php echo CFS()->get('announcement_about'); ?></p>
                    <?php endif; ?>

                    <?php 
                    $announcement_list = CFS()->get('announcement_list');
                    if(!empty($announcement_list)):
                        foreach($announcement_list as $announcement):
                    ?>
                        <div class="cb-notice__item">
                            <h4 class="cb-notice__item-title"><?php echo $announcement['announcement_item']; ?></h4>
                            <?php 
                            $about_list = $announcement['announcement_about_list'];
                            if(!empty($about_list)):
                                foreach($about_list as $detail):
                            ?>
                                <?php if (!empty($detail['announcement_about_tit'])): ?>
                                    <h5>■ <?php echo $detail['announcement_about_tit']; ?></h5>
                                <?php endif; ?>
                                <div><?php echo $detail['announcement_detail']; ?></div>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <section class="cb-section cb-apply">
            <div class="container">
                <h3 class="cb-section-title">お申込みに必要なもの</h3>
                <div class="cb-apply__content">
                    <div class="cb-apply__card">
                        <div class="cb-apply__rich-content">
                            <?php echo CFS()->get('preparation_about'); ?>
                        </div>
                    </div>

                    <h3 class="cb-section-title mt-5 pt-4"><?php echo CFS()->get('features_note_tit'); ?></h3>
                    <?php if(CFS()->get('features_note')): ?>
                        <div class="cb-features__note">
                            <?php echo CFS()->get('features_note'); ?>
                        </div>
                    <?php endif; ?>

                    <div id="apply-section" class="cb-apply__docs">
                        <?php 
                        $prep_dx_list = CFS()->get('preparation_dx_list');
                        if(!empty($prep_dx_list)):
                            foreach($prep_dx_list as $prep):
                                if($prep['preparation_dx_deta']):
                        ?>
                            <a href="<?php echo $prep['preparation_dx_deta']; ?>" target="_blank" class="cb-btn-doc">
                                <span class="name"><?php echo $prep['preparation_dx_tit']; ?></span>
                                <i class="fa-solid fa-file-pdf"></i>
                            </a>
                        <?php 
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <div class="cb-movie-section">
                        <?php 
                        $movie_list = CFS()->get('movie_list');
                        if(!empty($movie_list)):
                            foreach($movie_list as $index => $movie): 
                                $btn_name = $movie['movie_btn_name'];
                                $thumbnail = $movie['movie_th'];
                                $video_url = $movie['movie_video'];
                        ?>
                            <div class="home-page-top-movie mb-2">
                                <div class="modal_trigger--video">
                                    <button class="cb-btn-doc link-btn w-100 m-0 gtm-click-link" data-type="pop-up" data-gtm-click="<?php echo $btn_name; ?>">
                                        <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                            <span><?php echo $btn_name; ?></span>
                                            <i class="pl-2 fa-regular fa-window-restore"></i>
                                        </p>
                                    </button>
                                </div>

                                <div class="modal_box--video">
                                    <div class="modal_bg"></div>
                                    <div class="modal_inner">
                                        <div class="modal_block">
                                            <div class="movie-item">
                                                <video muted controls playsinline 
                                                    poster="<?php echo $thumbnail; ?>" 
                                                    controlsList="nodownload" 
                                                    oncontextmenu="return false;" 
                                                    data-gtm-event="<?php echo $movie['movie_event_name']; ?>"> <source data-src="<?php echo $video_url; ?>#t=0.1" type="video/mp4">
                                                </video>
                                                <button class="link-btn modal_close">
                                                    <p class="mb-0">閉じる<i class="pl-2 fa-solid fa-xmark"></i></p>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endforeach;
                        endif; 
                        ?>
                    </div>
                    <div class="cb-apply__action text-center mt-4">
                        <a id="hl_image_link" <?php echo hl_nonce_data_attr(); ?> role="button" tabindex="<?php echo $tabindex; ?>" class="cb-btn cb-btn--apply-large gtm-click-link<?php echo $disabled_class; ?>" data-gtm-click="カムバック保険お申込み">
                        お申込みへ
                        </a>
                        <?php if ($is_disabled) : ?>
                            <p class="cb-apply__limit-text mt-3">
                                <?php echo implode('<br><br>', $disabled_reasons); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <?php if(CFS()->get('procedure_tit')): ?>
        <section class="cb-section">
            <div class="container">
                <h3 class="cb-section-title"><?php echo CFS()->get('procedure_tit'); ?></h3>
                <div class="cb-notice__box">
                    <?php echo CFS()->get('procedure'); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        
        <section class="cb-section cb-faq">
            <div class="container">
                <h3 class="cb-section-title">よくある質問</h3>
                <div class="cb-faq__list">
                    <?php 
                    $faq_list = CFS()->get('faq_list');
                    if(!empty($faq_list)):
                        foreach($faq_list as $faq):
                    ?>
                        <div class="cb-acc js-cb-accordion">
                            <button class="cb-acc__trigger js-cb-accordion-trigger">
                                <div class="faq-q">
                                    <span class="q-icon">Q</span>
                                    <span class="q-text"><?php echo $faq['question']; ?></span>
                                </div>
                                <span class="acc-arrow"></span>
                            </button>
                            <div class="cb-acc__content js-cb-accordion-content">
                                <div class="cb-acc__inner faq-a">
                                    <span class="a-icon">A</span>
                                    <div class="a-text"><?php echo $faq['answer']; ?></div>
                                </div>
                            </div>
                        </div>
                    <?php 
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </section>

        <section id="<?php echo CFS()->get('contact_page_link'); ?>" class="cb-section cb-contact">
            <div class="container">
                <h3 class="cb-section-title">お問合せ</h3>
                <?php if(CFS()->get('contact_about')): ?>
                    <p class="text-center text-white mb-4"><?php echo CFS()->get('contact_about'); ?></p>
                <?php endif; ?>
                
                <div class="cb-contact-list mx-auto">
                    <div class="cb-contact__card">
                        <div class="icon"><i class="fa-solid fa-phone-volume"></i></div>
                        <p class="label">お電話でのご相談</p>
                        <p class="tel"><?php echo CFS()->get('contact_tel'); ?></p>
                        <p class="hours"><?php echo CFS()->get('available_hours'); ?></p>
                        <a href="tel:<?php echo CFS()->get('contact_tel'); ?>" class="cb-btn-tel">電話で相談する</a>
                    </div>
                    <div class="cb-contact__card">
                        <div class="icon"><i class="fa-regular fa-envelope"></i></div>
                        <p class="label">メールでのお問合わせ</p>
                        <p class="tel mail"><?php echo CFS()->get('contact_mail'); ?></p>
                        <p class="hours text-left"><?php echo CFS()->get('contact_mail_note'); ?></p>
                        <a href="mailto:<?php echo CFS()->get('contact_mail'); ?>" class="cb-btn-tel" target="_blank">メールでお問合わせ</a>
                    </div>
                </div>
                <div class="document_number">
                    <p class="text-right text-white mb-0 mt-4"><?php echo CFS()->get('document_number'); ?></p>
                </div>
            </div>
        </section>
    </div>
    <div class="cb-floating-wrap js-floating-btn">
        <a href="#contact" role="button" tabindex="0" class="cb-floating-btn gtm-click-link" data-gtm-click="カムバック保険 お問合せ固定ボタン">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/comeback/apply_floating_btn.png?20260401" alt="お問合せ">
        </a>
    </div>
</div>
<?php get_footer(); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // --- 1. 申込ボタンのクリック処理（通常のボタン + 下部固定ボタン） ---
    (function() {
        // 対象となるボタンのIDを配列で指定
        var applyButtonIds = ['hl_image_link', 'hl_floating_link'];
        
        applyButtonIds.forEach(function(id) {
            var link = document.getElementById(id);
            if (!link) return;

            // クリック時のフォーム送信
            link.addEventListener('click', function(e) {
                e.preventDefault();
                var form = document.getElementById('submit_hl');
                if (form) {
                    form.submit();
                } else {
                    console.warn('submit_hl form not found.');
                }
            }, false);

            // キーボード操作（Enter/Space）対応
            link.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') { 
                    e.preventDefault(); 
                    this.click(); 
                }
            }, false);
        });
    })();


    // --- 2. 下部固定ボタンの表示・非表示制御（1スクロール後に表示） ---
    (function() {
        var floatingWrap = document.querySelector('.js-floating-btn');
        if (!floatingWrap) return;

        window.addEventListener('scroll', function() {
            // スクロール量が300px（約1スクロール）を超えたら表示クラスを付与
            if (window.scrollY > 200) {
                floatingWrap.classList.add('is-visible');
            } else {
                floatingWrap.classList.remove('is-visible');
            }
        });
    })();


    // --- 3. アコーディオン制御（ネスト対応） ---
    (function() {
        var triggers = document.querySelectorAll('.js-cb-accordion-trigger');
        triggers.forEach(function(trigger) {
            trigger.addEventListener('click', function() {
                var content = this.nextElementSibling;
                this.classList.toggle('is-active');
                
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                    
                    // ネスト（子要素）のアコーディオンがある場合、親の高さも再計算
                    var parentContent = this.closest('.js-cb-accordion-content');
                    if (parentContent && parentContent !== content) {
                        parentContent.style.maxHeight = (parentContent.scrollHeight + content.scrollHeight) + "px";
                    }
                }
            });
        });
    })();


    // --- 4. 追従ナビゲーション固定用制御 ---
    (function() {
        var stickyNav = document.getElementById('js-sticky-nav');
        if (!stickyNav) return;

        var wrapper = stickyNav.parentElement;
        var headerHeightPC = 60; 
        var headerHeightSP = 50; 
        var navOffset = stickyNav.getBoundingClientRect().top + window.scrollY;

        window.addEventListener('scroll', function() {
            var isSp = window.innerWidth <= 768; 
            var currentHeaderHeight = isSp ? headerHeightSP : headerHeightPC;
            
            if (window.scrollY > (navOffset - currentHeaderHeight)) {
                wrapper.style.height = stickyNav.offsetHeight + 'px';
                stickyNav.classList.add('is-fixed');
            } else {
                wrapper.style.height = 'auto';
                stickyNav.classList.remove('is-fixed');
            }
        });

        window.addEventListener('resize', function() {
           if(!stickyNav.classList.contains('is-fixed')) {
               navOffset = stickyNav.getBoundingClientRect().top + window.scrollY;
           }
        });
    })();

});
jQuery(function($){
    // --- 1. モーダル表示制御（遅延読み込み対応） ---
    $(document).on('click', '.modal_trigger--video', function(){
        // クリックされたボタンの直後にあるモーダルを取得
        const $modal = $(this).next('.modal_box--video');
        const $video = $modal.find('video');
        const $source = $video.find('source');

        // srcが空（未設定）なら data-src を反映してロード
        if (!$source.attr('src')) {
            const videoSrc = $source.data('src');
            $source.attr('src', videoSrc);
            $video[0].load();
        }

        $modal.fadeIn();
        $('body').addClass('overflow-hidden');
    });

    // --- 2. モーダル閉鎖制御（動画停止対応） ---
    $(document).on('click', '.modal_box--video .modal_close, .modal_box--video .modal_bg', function(){
        const $modal = $(this).closest('.modal_box--video');
        $modal.fadeOut();
        $('body').removeClass('overflow-hidden');
        
        // 閉じたモーダル内の動画だけを一時停止
        $modal.find('video').each(function(){
            this.pause();
        });
    });

    // --- 3. GTMイベント計測（優先ロジックの統合） ---
    // data-gtm-event 属性を持つ全ての video 要素を対象にする
    const videos = document.querySelectorAll("video[data-gtm-event]");

    videos.forEach(video => {
        let hasTracked = false; // 各動画、1セッションにつき1回のみ計測

        video.addEventListener("play", function () {
            if (!hasTracked) {
                // data-gtm-event からCFSで設定したイベント名を取得
                const gtmEventName = video.getAttribute("data-gtm-event");

                if (gtmEventName) {
                    window.dataLayer = window.dataLayer || [];
                    window.dataLayer.push({
                        'event': gtmEventName // CFSの値が直接GTMのイベント名（トリガー）になる
                    });
                    
                    hasTracked = true;
                    // console.log("GTM Event Sent: " + gtmEventName); // 動作確認用
                }
            }
        });
    });
});
jQuery(function ($) {
  // ズラしたいピクセル数（マイナス値ではなく、ずらす量として定義）
  const OFFSET_PC = 250; // PCの時のズレ幅
  const OFFSET_SM = 200; // スマホの時のズレ幅
  
  function getOffset() {
    return window.innerWidth <= 576 ? OFFSET_SM : OFFSET_PC;
  }

  const hash = window.location.hash;
  if (hash && $(hash).length) {
    setTimeout(function () {
      const pos = $(hash).offset().top - getOffset();
      $('html, body').scrollTop(pos);
    }, 200); 
  }

  $('a[href^="#"]').not('[href="#"]').on('click', function (e) {
    e.preventDefault(); 
    const target = $(this.hash);
    if (target.length) {
      const pos = target.offset().top - getOffset();
      $('html, body').stop().animate({ scrollTop: pos }, 200, 'swing');
    }
  });
});
</script>
