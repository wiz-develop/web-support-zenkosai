<?php
/*
 * Template Name: 社会貢献活動アーカイブ
 */
if ($_POST['prime_app_flg']) {
    if (!$_POST['member_id'] || !$_POST['password']) {
        wp_redirect(home_url('/'));
        exit;
    }
    $member_info = make_session_member_info($_POST, $_POST['password']);
    set_session_member_info($member_info, $posts_unread);
}

$page_data = get_page_by_path('social-contributions');
$page_id = $page_data->ID;
$overseas_edu_page_link = CFS()->get('overseas_edu_page_link', $page_id);
$mottainai_pro_page_link = CFS()->get('mottainai_pro_page_link', $page_id);
$volunteer_act_page_link= CFS()->get('volunteer_act_page_link', $page_id);
$support_pro_page_link= CFS()->get('support_pro_page_link', $page_id);
$csr_ev_page_link = CFS()->get('csr_ev_page_link', $page_id);
$csr_sdgs_page_link = CFS()->get('csr_sdgs_page_link', $page_id);

get_header();
?>

<div id="new-csr">
    <div class="csr-index csr whole-page-wrapper page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <?php $the_t = get_term_by('id', $_GET['cat_id'], 'csr_cat'); ?>
    <?php if(empty($_GET['cat_id'])) :?>
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
                    <div class="container">
                        <h1 class="mb-0">
                            社会貢献活動
                        </h1>
                    </div>
                </div>
            </div>
        </div>
            <?php 
                $csr_slide = $cfs->get('csr_slide_add', $page_id);
                if ($csr_slide):
            ?>
            <div class="page-content-innerwrap csr-cats container-fluid social-contribution-list pick-up_content">
                <div class="page-content-div pb-0">
                    <div class="container">
                        <h2 class="csr-tit activities">活動 Pick up！</h2>
                        <?php
                            // スライドを優先度順にソート
                            $startdate = $_SESSION['member_info']['startdate'];
                            if ($csr_slide) :
                                $csr_slide_ary = sortByKey('csr_slide_priority', SORT_ASC, $csr_slide);
                                $data_js =  json_encode( $csr_slide_ary );
                        ?>
                        <div class="top_slide_wrapper container pt-3 px-0">
                            <div class="top_slide_innerwrapper">
                                <div class="csr-pickup-list">
                                    <?php foreach( $csr_slide_ary as $ts ) : ?>
                                        <?php
                                            $is_hidden_slide = !empty($ts['csr_slide_login']) ? $ts['csr_slide_login'] : false;

                                            if ( $is_hidden_slide && !is_user_loggedin() ) {
                                                continue; 
                                            }
                                            $class = '';
                                            $setting = 'href="'.$ts['csr_slide_link'].'" class="slide-img gtm-click-link" data-gtm-click="'.strip_tags($ts['csr_slide_link']).'"';
                                            if($ts['csr_slide_offtime']){
                                                $setting = 'data-formid="submit_offTime" class="gtm-click-link" data-gtm-click=全厚済Off Time（社会貢献活動スライドバナー）""';
                                                $class = 'js_form_btn';
                                            }
                                            if($ts['csr_slide_mall']){
                                                if ($startdate <= date("Y/m/d")) {
                                                    $setting = 'data-formid="submit_mall" class="gtm-click-link" data-gtm-click="全厚済モール（社会貢献活動スライドバナー）"';
                                                    $class = 'js_form_btn';
                                                } else {
                                                    $setting = 'class="limit_startdate"';
                                                    $class = 'js_form_btn';
                                                    $limit_startdate = '<p class="limit_startdate__text">サービス利用開始日以降にご利用いただけます</p>';
                                                }
                                            }
                                            $title = str_replace('<br />', '', $ts['csr_slide_title']);
                                        ?>
                                        <div class="top-slide <?php echo $class; ?>">
                                            <a <?php echo $setting; ?>>
                                                <img class="mx-auto" src="<?php echo $ts['csr_slide_img']; ?>" alt="<?php echo $ts['csr_slide_title']; ?>">
                                                <?php if($ts['csr_slide_mall']){ echo $limit_startdate; } ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="page-content-innerwrap social-contribution_menu container-fluid social-contribution-list mt-5">
                <div class="page-content-div py-0">
                    <div class="container">
                        <div class="csr-tit page-link_list w-100 acor-menu opened">
                            <h2 class="w-100">社会貢献活動メニュー</h2>
                        </div>
                        <div class="acor-menu-child opened acor-menu-child__no-bottom" style="display: block;">
                            <div class="content-body row">
                                <?php if($login):?>
                                <a href="#csr-report" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">参加報告書</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <?php endif; ?>
                                <a href="#csr-news" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">お知らせ</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <?php
                                    $fields = CFS()->get('csr_list', $page_id);
                                    foreach ($fields as $field) :
                                ?>
                                <a href="#<?php echo $field['csr_page_link']; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block"><?php echo $field['csr_item_tit']; ?></span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <?php
                                    endforeach;
                                ?>
                                <a href="#<?php echo $mottainai_pro_page_link; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">もったいない<br class="sp-br">プロジェクト</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <a href="#<?php echo $volunteer_act_page_link; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">ボランティア<br class="sp-br">活動</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <a href="#<?php echo $support_pro_page_link; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">サポート<br class="sp-br">プロジェクト</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <a href="#<?php echo $csr_ev_page_link; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">社会貢献<br class="sp-br">イベント</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <a href="#<?php echo $csr_sdgs_page_link; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block">SDGs</span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php if($login):?>
            <?php $report_acor = CFS()->get('report_acor', $page_id); ?>
            <div id="csr-report" class="page-content-innerwrap report-content container-fluid social-contribution-list">
                <div class="page-content-div py-0">
                    <div class="container">
                        <div class="csr-tit report w-100 acor-menu<?php if ($report_acor == 1) { echo ' opened'; } ?>">
                            <h2 class="w-100">参加報告書はこちら</h2>
                        </div>
                        <div class="acor-menu-child<?php if ($report_acor == 1) { echo ' opened'; } ?>">
                            <div class="content-about">
                                <p><?php echo $cfs->get('report-about' , $page_id); ?></p>
                            </div>
                            <div class="content-body">
                                <div class="content-body__item">
                                    <h3 class="acor-subtit report">全厚済クリーンキャンペーン参加報告</h3>
                                    <div class="content-body__item__list report row">
                                        <div class="content-body__item__list__about col-lg-6 col-12">
                                            <p><?php echo $cfs->get('clean_about' , $page_id); ?></p>
                                        </div>
                                        <div class="content-body__item__list__link col-lg-6 col-12">
                                            <a href="<?php echo $cfs->get('clean_pdf' , $page_id); ?>" download="<?php echo $cfs->get('clean_file_name' , $page_id); ?>" class="gtm-click-download" data-gtm-click="クリーンキャンペーン参加報告書ダウンロード">
                                                <p class="mb-0 d-flex align-items-center justify-content-between w-100"><span class="d-block">参加報告書</span><i class="fa-solid fa-file-pdf pl-2"></i></p>
                                            </a>
                                            <a href="<?php echo get_home_url() ; ?>/social-contributions/clean-report/" target="_blank" class="gtm-click-link" data-gtm-click="クリーンキャンペーン参加報告書フォーム">
                                                <p class="mb-0 d-flex align-items-center justify-content-between w-100"><span class="d-block">参加報告<br class="sp-br">フォーム</span><i class="fa-solid fa-chevron-right pl-2"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-body__item">
                                    <h3 class="acor-subtit report">被災地支援</h3>
                                    <div class="content-body__item__list report row">
                                        <div class="content-body__item__list__about col-lg-6 col-12">
                                            <p><?php echo $cfs->get('damage_about' , $page_id); ?></p>
                                        </div>
                                        <div class="content-body__item__list__link col-lg-6 col-12">
                                            <a href="<?php echo $cfs->get('damage_pdf' , $page_id); ?>" download="<?php echo $cfs->get('damage_file_name' , $page_id); ?>" target="_blank" class="gtm-click-download" data-gtm-click="被災報告書ダウンロード">
                                                <p class="mb-0 d-flex align-items-center justify-content-between w-100"><span class="d-block">被災報告書</span><i class="fa-solid fa-file-pdf pl-2"></i></p>
                                            </a>
                                            <a href="<?php echo get_home_url() ; ?>/form/?cate=hisai" class="gtm-click-link" data-gtm-click="クリーンキャンペーン参加報告書フォーム">
                                                <p class="mb-0 d-flex align-items-center justify-content-between w-100"><span class="d-block">報告書<br class="sp-br">お取り寄せ</span><i class="fa-solid fa-chevron-right pl-2"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-body__item">
                                    <h3 class="acor-subtit report">ボランティア活動報告</h3>
                                    <div class="content-body__item__list report row">
                                        <div class="content-body__item__list__about col-lg-6 col-12">
                                            <p><?php echo $cfs->get('volunteer_about' , $page_id); ?></p>
                                        </div>
                                        <div class="content-body__item__list__link col-lg-6 col-12">
                                            <a href="<?php echo $cfs->get('volunteer_pdf' , $page_id); ?>" download="<?php echo $cfs->get('volunteer_file_name' , $page_id); ?>" class="gtm-click-download" data-gtm-click="ボランティア活動報告書ダウンロード">
                                                <p class="mb-0 d-flex align-items-center justify-content-between w-100"><span class="d-block">活動報告書</span><i class="fa-solid fa-file-pdf pl-2"></i></p>
                                            </a>
                                            <a href="<?php echo get_home_url() ; ?>/form/?cate=volunteer" class="gtm-click-link" data-gtm-click="クリーンキャンペーン参加報告書フォーム">
                                                <p class="mb-0 d-flex align-items-center justify-content-between w-100"><span class="d-block">報告書<br class="sp-br">お取り寄せ</span><i class="fa-solid fa-chevron-right pl-2"></i></p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="page-content-wrapper columns index-page">
            <?php
                $arg = array(
                    'posts_per_page' => 2,
                    'post_type'      => 'social-contribution',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'csr_cat',
                            'field'    => 'slug',
                            'terms'    => 'csr-topics',
                        ),
                    )
                );
                $posts = get_posts($arg);

                $has_visible_post = false;

                foreach ($posts as $post) {
                    setup_postdata($post);
                    $csr_info_nologin = CFS()->get('csr_info_nologin', $post->ID);
                    if ($login || !$csr_info_nologin) {
                        $has_visible_post = true;
                        break;  // 1件でも見つかったらループ抜け
                    }
                }
                wp_reset_postdata();

                if ($has_visible_post): 
            ?>
            <div id="csr-news" class="page-content-innerwrap csr-topics-content container-fluid">
                <div class="page-content-div">
                    <div class="container">
                        <div class="csr-topics-content__header d-flex align-items-center justify-content-between">
                            <h3>お知らせ</h3>
                            <a href="<?php echo home_url('/social-contributions/csr-topics/'); ?>" class="rounded-pill">一覧へ<i class="fas fa-arrow-right pl-2"></i></a>
                        </div>
                        <div class="csr-topics-content__list">
                            <?php 
                                foreach ($posts as $post): setup_postdata($post);
                                    get_template_part('templates/csr-topics_loop');
                                endforeach;
                                wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div id="csr-news" class="page-content-innerwrap csr-topics-content container-fluid">
                <div class="page-content-div">
                    <div class="container">
                        <div class="csr-topics-content__header d-flex align-items-center justify-content-between">
                            <h3>お知らせ</h3>
                        </div>
                        <div class="csr-topics-content__list">
                            <p>現在、お知らせはありません。</p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
            <div class="page-content-innerwrap activities-content container-fluid social-contribution-list">
                <div class="page-content-div py-0">
                    <div class="container">
                        <h2 class="csr-tit activities-list">
                            <img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/images/social-contributiion/social-contribution_icon.png">
                            <span>活動一覧</span>
                        </h2>
                        <div class="acor-menu-child d-block">
                            <div class="content-body row">
                                <?php
                                    $fields = CFS()->get('csr_list', $page_id);
                                    foreach ($fields as $field) :
                                ?>
                                <div id="<?php echo $field['csr_page_link']; ?>" class="content-body__item col-12 col-lg-6 col-md-6">
                                    <div class="content-body__item__about d-flex flex-column justify-content-between h-100">
                                        <div class="content-body__item__list__about__detail">
                                            <h3 class="acor-subtit"><?php echo $field['csr_item_tit']; ?></h3>
                                            <?php if($field['csr_item_about']):?>
                                            <p><?php echo $field['csr_item_about']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo $field['csr_bnr_link']; ?>" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="社会貢献活動トップページ <?php echo $field['csr_item_tit']; ?>バナー">
                                            <img src="<?php echo $field['csr_bnr']; ?>" alt="<?php echo $field['csr_item_tit']; ?>">
                                        </a>
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
            <?php $mottainai_pro_acor = CFS()->get('mottainai_pro_acor', $page_id); ?>
            <div id="<?php echo $mottainai_pro_page_link; ?>" class="page-content-innerwrap activities-content mottainai_pro-content container-fluid social-contribution-list acor-content">
                <div class="page-content-div py-0">
                    <div class="container">
                        <div class="csr-tit page-link_list mottainai_pro__tit w-100 acor-menu<?php if ($mottainai_pro_acor == 1) { echo ' opened'; } ?>">
                            <h2 class="w-100">もったいないプロジェクト</h2>
                        </div>
                        <div class="acor-menu-child<?php if ($mottainai_pro_acor == 1) { echo ' opened '; } ?> acor-menu-child__no-bottom">
                            <div class="content-body row">
                                <?php
                                    $fields = CFS()->get('mottainai_pro_list', $page_id);
                                    foreach ($fields as $field) :
                                ?>
                                <div class="content-body__item col-12 col-lg-6 col-md-6">
                                    <div class="content-body__item__about d-flex flex-column justify-content-between h-100"> 
                                        <div class="content-body__item__list__about__detail">
                                            <h3 class="acor-subtit"><?php echo $field['mottainai_pro_tit']; ?></h3>
                                            <?php if($field['mottainai_pro_about']):?>
                                            <p><?php echo $field['mottainai_pro_about']; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo $field['mottainai_pro_bnr_link']; ?>" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="社会貢献活動トップページ <?php echo $field['mottainai_pro_tit']; ?>バナー">
                                            <img src="<?php echo $field['mottainai_pro_bnr']; ?>" alt="<?php echo $field['mottainai_pro_tit']; ?>">
                                        </a>
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
            <?php
                $volunteer_act_about = CFS()->get('volunteer_act_about', $page_id);
                $volunteer_act_bnr = CFS()->get('volunteer_act_bnr', $page_id);
                $volunteer_act_bnr_link = CFS()->get('volunteer_act_bnr_link', $page_id);
                $volunteer_act_page_link = CFS()->get('volunteer_act_page_link', $page_id);
                $volunteer_act_tit = CFS()->get('volunteer_act_tit', $page_id);
                
                $support_pro_about = CFS()->get('support_pro_about', $page_id);
                $support_pro_bnr = CFS()->get('support_pro_bnr', $page_id);
                $support_pro_bnr_link = CFS()->get('support_pro_bnr_link', $page_id);
                $support_pro_page_link = CFS()->get('support_pro_page_link', $page_id);
                $support_pro_tit = CFS()->get('support_pro_tit', $page_id);

                $csr_ev_about = CFS()->get('csr_ev_about', $page_id);
                $csr_ev_bnr = CFS()->get('csr_ev_bnr', $page_id);
                $csr_ev_bnr_link = CFS()->get('csr_ev_bnr_link', $page_id);
                $csr_sdgs_about = CFS()->get('csr_sdgs_about', $page_id);
                $csr_sdgs_bnr = CFS()->get('csr_sdgs_bnr', $page_id);
            ?>
            <div class="page-content-innerwrap activities-content container-fluid social-contribution-list mt-4 mb-5">
                <div class="page-content-div py-0">
                    <div class="container">
                        <div class="acor-menu-child d-block">
                            <div class="content-body row">
                                <div id="<?php echo $volunteer_act_page_link; ?>" class="content-body__item col-12 col-lg-6 col-md-6">
                                    <div class="content-body__item__about d-flex flex-column justify-content-between h-100">
                                        <div class="content-body__item__list__about__detail">
                                            <h3 class="acor-subtit"><?php echo $volunteer_act_tit; ?></h3>
                                            <?php if($volunteer_act_about):?>
                                            <p><?php echo $volunteer_act_about; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo $volunteer_act_bnr_link; ?>" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="社会貢献活動トップページ ボランティア活動バナー">
                                            <img src="<?php echo $volunteer_act_bnr; ?>" alt="<?php echo $volunteer_act_tit; ?>">
                                        </a>
                                    </div>
                                </div>
                                <div id="<?php echo $support_pro_page_link; ?>" class="content-body__item col-12 col-lg-6 col-md-6">
                                    <div class="content-body__item__about d-flex flex-column justify-content-between h-100">
                                        <div class="content-body__item__list__about__detail">
                                            <h3 class="acor-subtit" style="color: #b7456d; border-left: solid 4px #ea85a4;"><?php echo $support_pro_tit; ?></h3>
                                            <?php if($support_pro_about):?>
                                            <p><?php echo $support_pro_about; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo $support_pro_bnr_link; ?>" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="社会貢献活動トップページ サポートプロジェクトバナー">
                                            <img src="<?php echo $support_pro_bnr; ?>" alt="<?php echo $support_pro_tit; ?>">
                                        </a>
                                    </div>
                                </div>
                                <div id="<?php echo $csr_ev_page_link; ?>" class="content-body__item col-12 col-lg-6 col-md-6">
                                    <div class="content-body__item__about d-flex flex-column justify-content-between h-100">
                                        <div class="content-body__item__list__about__detail">
                                            <h3 class="acor-subtit">社会貢献イベント</h3>
                                            <?php if($csr_ev_about):?>
                                            <p><?php echo $csr_ev_about; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <a href="<?php echo $csr_ev_bnr_link; ?>" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="社会貢献活動トップページ 社会貢献イベントバナー">
                                            <img src="<?php echo $csr_ev_bnr; ?>" alt="社会貢献イベント">
                                        </a>
                                    </div>
                                </div>
                                <div id="<?php echo $csr_sdgs_page_link; ?>" class="content-body__item sdgs-content col-12 col-lg-6 col-md-6">
                                    <div class="content-body__item__about d-flex flex-column justify-content-between h-100">
                                        <div class="content-body__item__list__about__detail">
                                            <h3 class="acor-subtit">SDGs</h3>
                                            <?php if($csr_sdgs_about):?>
                                            <p><?php echo $csr_sdgs_about; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="popup" id="js-popup">
                                            <div class="popup-inner">
                                                <div class="open-content">
                                                    <div class="open-content__title">
                                                        <?php echo $cfs->get('certificate_title', $page_id); ?>
                                                    </div>
                                                    <div class="open-content__img">
                                                        <img src="<?php echo $cfs->get('certificate_img', $page_id); ?>">
                                                    </div>
                                                    <div class="open-content__detail">
                                                        <?php echo $cfs->get('certificate_detail', $page_id); ?>
                                                    </div>
                                                </div>
                                                <div class="close-btn" id="js-close-btn">
                                                    戻る
                                                </div>
                                            </div>
                                            <div class="black-background" id="js-black-bg"></div>
                                        </div>
                                        <button id="js-show-popup" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="社会貢献活動トップページ SDGsバナー">
                                            <img src="<?php echo $csr_sdgs_bnr; ?>" alt="SDGs">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        else :
            // 子カテゴリ用のインデックスページ 
            get_template_part('templates/social-contribution-child-terms');
        endif;
    ?>
    </div>
</div>

<script>
jQuery(function($){
    $('.news-wrapper').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: true,
        prevArrow: '<img src="/cms/wp-content/themes/zenkosai/assets/images/social-contributiion/slick-btn.png" class="slide-arrow prev-arrow">',
        nextArrow: '<img src="/cms/wp-content/themes/zenkosai/assets/images/social-contributiion/slick-btn.png" class="slide-arrow next-arrow">',
        dots: true,
        dotsClass: 'slick-dots d-flex flex-row justify-content-center my-0',
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                centerMode:true,
	            centerPadding:"10%",
            }
        },
        {
            breakpoint: 640,
            settings: {
                slidesToShow: 1,
                centerMode:true,
	            centerPadding:"10%",
            }
        }]
    });
    // ポップアップ
    $(document).on('click','.cancel-btn',function(){
        $(this).parents('.pop-up-child').toggleClass('opened');
    });

    // SDGs認定書 ポップアップ
    function popupImage() {
    var popup = document.getElementById('js-popup');
    if(!popup) return;

    var blackBg = document.getElementById('js-black-bg');
    var closeBtn = document.getElementById('js-close-btn');
    var showBtn = document.getElementById('js-show-popup');

    closePopUp(blackBg);
    closePopUp(closeBtn);
    closePopUp(showBtn);
    function closePopUp(elem) {
        if(!elem) return;
        elem.addEventListener('click', function() {
        popup.classList.toggle('is-show');
        });
    }
    }
    popupImage();
});

jQuery(function($){
    $('.csr-pickup-list').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: false,
        centerPadding: '25%',
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false,
        dots: true,
        dotsClass: 'top-slide-dots d-flex px-0',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    centerPadding: '10%',
                    centerMode: false,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                }
            }
        ]
    });
    setTimeout(function() {
        $(".slide").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: ".slide-navigation",
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 400,
        });
        $(".slide-navigation").slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 4000,
            speed: 400,
            asNavFor: ".slide",
            focusOnSelect: true,
            vertical: true,
            verticalSwiping: true,
        });
    }, 100);
});

jQuery(function ($) {
  const OFFSET_SM = -230;

  // スマホだけ実行
  if (window.innerWidth <= 576) {
    const hash = window.location.hash;

    if (hash && $(hash).length) {
      setTimeout(function () {
        const pos = $(hash).offset().top + OFFSET_SM;
        $('html, body').scrollTop(pos);
      }, 200); // ← 必ず遅らせて再ジャンプ後に上書き
    }
  }

  if (window.location.pathname === "/social-contribution/") {
    $('a[href^="/social-contribution/#"]').on('click', function (e) {
      const newHref = $(this).attr('href').replace('/social-contribution/', '');
      const target = $(newHref === "#" || newHref === "" ? 'html' : newHref);

      if (target.length) {
        // ハンバーガーメニューを閉じる
        if ($('.menu-hamburger').hasClass('open')) {
          $('.menu-hamburger').removeClass('open');
          console.log('ハンバーガーメニュー閉じた');
        }

        // ヘッダーの高さ補正
        const headerHeight = $('.siteHeader').outerHeight() || 0;
        const offset = target.offset().top - headerHeight;

        // スクロール
        $('html, body').animate({ scrollTop: offset }, 400, 'swing');

        // デフォルト動作キャンセル
        e.preventDefault();
      }
    });
  }
});
</script>
<?php get_footer(); ?>