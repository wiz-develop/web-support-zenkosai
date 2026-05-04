<?php
require_once(get_stylesheet_directory().'/api/get_membertree_result.php');
$membertree = get_membertree_date();
$member_type = $_SESSION['member_info']['member_type'];

// メール登録不備判定
$deficient_popup = '';
if(!$_SESSION['member_info']['mail_judge']){
    $deficient_popup = 'deficient_popup';
}

// 9月21日の朝6時～9時にかけてマイページのリニューアルに伴うメンテナンス表示
$today_date = new DateTime('now');
$maintenance = '';
$disabled = '';
$tabindex = '';
$maintenance_text = '';

$maintenance_start = new DateTime('2025-05-18 6:00:00');
$maintenance_end = new DateTime('2026-05-05 14:00:00');
if (intval($_SESSION['member_info']['member_id']) >= intval("000000001000")) {
    if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
        $maintenance = 'now-maintenance';
        $disabled = 'disabled';
        // $tabindex = 'tabindex="-1"';
        $maintenance_text = '<span class="business-maintenance">メンテナンス中</span>';
    }
}
?>
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
</div>
<div class="page-content-wrapper">
    <div class="container">
        <div class="page-content-innerwrap">
            <div class="page-content-div business-schedule mb-4">
                <h3 class="d-flex align-items-center mb-3"><i class="fa-solid fa-bars pr-1"></i><span>ビジネスメニュー</span></h3>
                <div class="container content mb-5">
                    <?php get_template_part('templates/business-nav');?>
                </div>
            </div>
            <div id="member-info" class="page-content-div business-schedule mb-4">
                <h3 class="d-flex align-items-center mb-3"><i class="fa-solid fa-address-card pr-1"></class></i><span>会員情報</span></h3>
                <div class="container content mb-5">
                    <div class="side-item row mx-0">
                        <div class="side-item__content col-12 col-lg-6 col-md-6 p-0 mb-0 d-flex">
                            <div class="lank-img mb-0 mr-4">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/rank_<?php echo $_SESSION['member_info']['nextlv']; ?>.png" alt="ランク">
                            </div>
                            <div class="side-item__content__qualification">
                                <div class="lank-name">
                                    <p class="mb-0">
                                    <?php
                                        $level_map = [
                                            'diamondclubmember' => 'ダイヤモンドクラブメンバー',
                                            'emeraldclubmember' => 'エメラルドクラブメンバー',
                                            'goldmember' => 'ゴールドメンバー',
                                            'member' => 'プライム倶楽部会員',
                                            'plutinummember' => 'プラチナメンバー',
                                            'primediamondclubmember' => 'プライムダイヤモンドクラブメンバー',
                                        ];

                                        $next_level = $_SESSION['member_info']['nextlv'] ?? '';
                                        echo isset($level_map[$next_level]) ? $level_map[$next_level] : $next_level;
                                    ?>
                                    </p>
                                </div>
                                <div class="qualification-header">
                                    <p class="mb-0">取得資格</p>
                                </div>
                                <div class="qualification-body">
                                    <div class="qualification-item d-flex align-items-center mb-1">
                                        <?php if( $_SESSION['member_info']['pb_flag']): ?>
                                            <p class="mb-0">PB資格：取得済み</p>
                                            <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                                            <a class="<?php echo $cls; ?> cursor-pointer gtm-click-download" data-name="pb_exam" data-type="get-info" data-gtm-click="PB資格">
                                                <div class="qualification-btn d-flex justify-content-between align-items-center rounded-pill py-1 px-3 ml-3">
                                                    <span>認定書</span>
                                                    <i class="fa-solid fa-download pl-1"></i>
                                                </div>
                                            </a>
                                        <?php else:?>
                                            <p class="mb-0">PB資格：未取得</p>
                                        <?php endif;?>
                                    </div>
                                    <?php if( $_SESSION['member_info']['ex_flag']): ?>
                                        <div class="qualification-item d-flex align-items-center">
                                            <p class="mb-0">EP資格：取得済み</p>
                                            <a href="<?php echo CFS()->get('business_ep_file_new'); ?>" class="cursor-pointer gtm-click-download"  rel="noreferrer" data-gtm-click="EP資格">
                                                <div class="qualification-btn d-flex justify-content-between align-items-center rounded-pill py-1 px-3 ml-3">
                                                    <span>EP規定​</span>
                                                    <i class="fa-solid fa-download pl-1"></i>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="side-item__content compliance col-12 col-lg-6 col-md-6 p-0">
                            <div class="compliance__header">
                                <p class="mb-0">コンプライアンス研修</p>
                            </div>
                            <?php
                                function format_compliance_date($raw_date) {
                                    if (empty($raw_date)) return null;
                                    return preg_replace('/^(\d{4})-(\d{2})-(\d{2})\..*$/', '$1/$2/$3', $raw_date);
                                }
                            ?>
                            <div class="compliance__body">
                                <p class="mb-0">
                                    <span>【最新受講日】</span>
                                    <?php 
                                        $attend_date = format_compliance_date($_SESSION['member_info']['compl_attend_date'] ?? '');
                                        echo $attend_date ? $attend_date : '-';
                                    ?>
                                </p>
                                <p class="mb-0">
                                    <span>【次回受講期限】</span>
                                    <?php 
                                        $attend_limit = format_compliance_date($_SESSION['member_info']['compl_attend_limit'] ?? '');
                                        echo $attend_limit ? '<font color="red">' . $attend_limit . '</font>' : '-';
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="business-schedule" class="page-content-div business-schedule">
                <h3 class="d-flex align-items-center mb-3"><i class="fa-solid fa-calendar-days pr-1"></i><span>スケジュール</span></h3>
                <div id="event" class="content event">
                    <div class="event-content">
                        <input type="radio" name="tab_name" id="list" checked>
                        <label class="tab_class list-tab" for="list">一覧表示</label>
                        <div id="events" class="content_class">
                        <?php
                            $today_date = date( "Y-m-d" );
                            $three_month = date('Y-m-1', strtotime('+3 month'));
                            $week = array( "日", "月", "火", "水", "木", "金", "土" );
                            // ループを変更したら/cms/wp-content/themes/zenkosai/api/event-readmore.phpも変更する
                            $posts_per_page = 3;
                            $args = array(
                                'post_status' => 'publish',
                                'posts_per_page' => $posts_per_page,
                                'post_type' => 'b_calender',
                                'no_found_rows'  => true,
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'meta_key' => 'b_calender_date',
                                'meta_query'     => array(array(
                                    'key'     => 'b_calender_date',
                                    'value'   => array($today_date, date('Y-m-d', strtotime($three_month.' -1 day'))),
                                    'compare' => 'BETWEEN',
                                    'type'    => 'DATE',
                                )),
                            );

                            $query = new WP_Query($args);
                            if ($query->have_posts()):
                                $count = 0;
                                $week = array( "日", "月", "火", "水", "木", "金", "土" );

                                while ($query->have_posts()):
                                    $query->the_post();

                                    $postid = get_the_ID();
                                    $terms = get_the_terms($postid, 'b_calendar_cat');
                                    $event_date = CFS()->get('b_calender_date', $postid);
                        ?>
                            <article class="modal_trigger">
                                <div class="article-content d-md-flex mb-2">
                                    <div class="article-detail d-flex">
                                        <div class="date mr-3">
                                            <div class="article-detail__postday">
                                                <p class="mb-0">
                                                    <time datetime="<?php echo $event_date; ?>"><?php echo date('Y.m.d', strtotime($event_date)); ?></time>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                            if ($terms) :
                                                foreach ($terms as $term) :
                                                    $term_color = '';
                                                    if (class_exists('Vk_term_color')) {
                                                        $term_color = Vk_term_color::get_term_color($term->term_id);
                                                        $term_color = ($term_color) ? ' style="background-color:' . $term_color . ';"' : '';
                                                    }
                                        ?>
                                            <div class="category-list mr-md-3 mr-0">
                                                <div class="article-detail__category <?php echo $term->slug; ?> rounded-pill" <?php echo $term_color; ?>>
                                                    <span class="text-white font-smaller">
                                                        <?php echo $term->name; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        <?php
                                                endforeach;
                                            endif;
                                        ?>
                                        </div>
                                    <div class="article-title">
                                        <p class="mb-0"><?php the_title(); ?></p>
                                    </div>
                                </div>
                            </article>
                            <!-- モーダル --------------------------->
                            <div class="modal_box">
                                <div class="modal_bg"></div>
                                <div class="modal_inner">
                                    <div class="modal_block">
                                        <div class="event-content">
                                            <div class="event-content__detail">
                                                <div class="event-content__detail__header">
                                                    <div class="article-date font-weight-bold">
                                                        <p class="mb-0">
                                                            <?php $event_date_week =  date('Y/m/d', strtotime($event_date)) . "(" . $week[date('w', strtotime($event_date))] . ")"; ?>
                                                            <time datetime="<?php echo $event_date; ?>">
                                                                <?php echo $event_date_week; ?>
                                                            </time>
                                                        </p>
                                                    </div>
                                                    <div class="article-title mt-3 px-2 py-1 font-weight-bold d-md-flex justify-content-md-between">
                                                        <?php if ($terms) : ?>
                                                            <div class="category-list order-md-2 mb-2 mb-md-0">
                                                            <?php foreach ($terms as $term) : ?>
                                                                <div class="article-detail__category <?php echo $term->slug; ?> rounded-pill" <?php echo $term_color; ?>>
                                                                    <span class="text-white font-smaller">
                                                                        <?php echo $term->name; ?>
                                                                    </span>
                                                                </div>
                                                            <?php endforeach; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <p class="mb-0 order-md-1"><?php the_title(); ?></p>
                                                    </div>
                                                </div>
                                                <div class="event-content__detail__body">
                                                    <?php the_content(); ?>
                                                </div>
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
                            <!-- モーダル --------------------------->
                        <?php
                            $count++;
                            endwhile;
                            wp_reset_postdata();

                            $publish_posts = $query->found_posts;
                            if ($publish_posts > $posts_per_page) :
                        ?>
                            <div class="more_disp some-article mt-4 mb-2">
                                <button class="py-1 pl-3 pr-5 rounded-pill">もっと見る</button>
                            </div>
                            <div class="none_disp no-article font-smaller d-none">
                                <button class="py-1 pl-3 pr-5 border border-dark rounded-pill">閉じる</button>
                            </div>
                        <?php
                                endif;
                            else :
                                wp_reset_postdata();
                                echo "<p>最新の記事はありません</p>";
                        endif;
                        ?>
                    </div>
                    <input type="radio" name="tab_name" id="calendar" >
                    <label class="tab_class calendar-tab" for="calendar">カレンダー表示</label>
                    <div class="content_class calendar_content">
                        <div class="calendar_event">
                            <div class="calendar">
                                <div class="calendar-show px-0 px-3"></div>
                            </div>
                            <div class="info-list">
                                <div class="article-date mb-3" id="calender-date">
                                    <?php
                                        $this_year = date("Y");
                                        $month = date("n");
                                        $today = date("j");
                                        $week = ['日', '月', '火', '水', '木', '金', '土'];
                                        $day_of_week = date('w');
                                        echo $month.'<span>月</span>'.$today.'<span>日</span><span>（'.$week[$day_of_week].'）</span>'
                                    ?>
                                </div>
                                <div id="detail-box"><!-- 記事データを表示 --></div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="member" class="page-content-div business-schedule mb-4">
                <h3 class="d-flex align-items-center mb-3"><i class="fa-solid fa-user pr-1"></i><span>現在の会員口数</span></h3>
                <div class="container content mb-5">
                    <div class="side-item">
                        <div class="d-flex flex-nowrap align-items-center">
                            <div class="side-item__membership">
                                <?php echo CFS()->get('business_member_number_new'); ?><span class="unit">口</span>
                            </div>
                            <?php
                                $business_member_number_update_new = date('Y年m月d日', strtotime(CFS()->get('business_member_number_update_new')));
                            ?>
                            <div class="side-item__date">
                                （<?php echo $business_member_number_update_new; ?><span>現在</span>）
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                $pb_exam_text_new = CFS()->get('pb_exam_text_new');
                if (!($_SESSION['member_info']['pb_flag'])):
            ?>
            <?php $pb_acor = CFS()->get('pb_acor'); ?>
            <div id="pb-exam-take" class="page-content-div pb-exam">
                <h3 class="<?php if ($pb_acor == 1) { echo 'acor-menu opened'; } ?>">PB試験関連</h3>
                <div class="container content-wrap <?php if ($pb_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="row">
                        <?php if ($pb_exam_text_new) : ?>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="target-link gtm-click-download" href="<?php echo $pb_exam_text_new; ?>" data-gtm-click="試験問題集">
                                <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>試験問題集</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                        </button>
                                </div>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php
                            $pb_exam_tejun_new = CFS()->get('pb_exam_tejun_new');
                            if ($pb_exam_tejun_new) :
                        ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a class="target-link gtm-click-download" href="<?php echo $pb_exam_tejun_new; ?>" data-gtm-click="受験の手順">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>受験の手順</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        <?php endif;?>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <div class="page-content__detail">
                                <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='modal_trigger';}?>
                                <div class="<?php echo $cls; ?> h-100">
                                    <button class="link-btn <?php //echo $maintenance; ?>" data-name="pb_exam" data-type="pop-up" <?php //echo $disabled; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>PB試験を<br class="d-none d-sm-block">受験する</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php //echo $maintenance_text; ?>
                                    </button>
                                </div>
                                <div class="modal_box">
                                    <div class="modal_bg"></div>
                                    <div class="modal_inner">
                                        <div class="modal_block">
                                            <div class="pb_detail_title px-2 py-1 mb-3">
                                                <p class="mb-0">PB試験を受験する</p>
                                            </div>
                                            <?php echo CFS()->get('business_exam_apply_new'); ?>
                                            <div class="btn-box row justify-content-around">
                                                <div class="modal-content__detail col-6 cursor-pointer">
                                                    <button class="link-btn modal_close">
                                                        <p class="mb-0">閉じる</p><span class="close-icon mt-0"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-content__detail col-6 cursor-pointer">
                                                    <button class="get-info link-btn loading-parent <?php //echo $maintenance; ?>" data-name="pb_exam" <?php //echo $disabled; ?>>
                                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>受験する</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                                        <?php //echo $maintenance_text; ?>
                                                    </button>
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
            <?php endif; ?>
            <?php $membertree_acor = CFS()->get('membertree_acor'); ?>
            <div id="original-chart" class="page-content-div">
                <h3 class="<?php if ($membertree_acor == 1) { echo 'acor-menu opened'; } ?>">組織図</h3>
                <div class="container content-wrap <?php if ($membertree_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="row">
                        <!-- <div class="chart-content"> -->
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a class="mypage_form" data-formid="submitMypage" data-formabout="membertreepre">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>組織図</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        <!-- </div> -->
                        <?php if(CFS()->get('business_tree_file_new')):?>    
                        <!-- <div class="chart-content align-self-start"> -->
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a href="<?php echo CFS()->get('business_tree_file_new'); ?>" target="_blank" class="gtm-click-download" data-gtm-click="組織図の確認方法（資料）">
                                    <div class="page-content__detail">
                                        <div class="target-link h-100">
                                            <button class="link-btn">
                                                <p class="mb-0 d-flex align-items-center justify-content-between"><span>組織図の確認方法</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                            </button>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <!-- </div> -->
                        <?php endif; ?>
                        <div class="membertree-sp">
                            <?php
                                $current_text_new = $membertree['current_text'];
                                $arrival_text_new = $membertree['arrival_text'];
                                $previous_text = $membertree['previous_text'];
                                if ($current_text_new || $arrival_text_new) :
                            ?>
                                <p class="mb-0 etctr">当月：<?php echo $current_text_new; ?> <?php echo $arrival_text_new; ?></p>
                            <?php endif; ?>
                            <?php if ($previous_text) : ?>
                                <p class="mt-0 mb-0 etctr">前月：<?php echo $previous_text; ?></p>
                            <?php endif; ?>      
                        </div>
                    </div>
                    <div class="membertree-pc mt-2">
                        <?php if ($current_text_new || $arrival_text_new) : ?>
                            <p class="mb-0 etctr pl-0">当月：<?php echo $current_text_new; ?> <?php echo $arrival_text_new; ?></p>
                        <?php endif; ?>
                        <?php if ($previous_text) : ?>
                            <p class="mb-0 etctr pl-0">前月：<?php echo $previous_text; ?></p>
                        <?php endif; ?>      
                    </div>
                </div>
            </div><!-- 組織図 -->
            <!-- プライムビジネス試験（PB試験）関連 -->
            <?php $commission_acor = CFS()->get('commission_acor'); ?>
            <div id="commission" class="page-content-div">
                <h3 class="<?php if ($commission_acor == 1) { echo 'acor-menu opened'; } ?>">コミッション関連</h3>
                <div class="container content-wrap <?php if ($commission_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="row">
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="mypage_form" data-formid="submitMypage" data-formabout="comission_meisai" <?php // echo $disabled.' '.$tabindex; ?>>
                                <div class="page-content__detail">
                                    <button class="link-btn <?php // echo $maintenance; ?>" <?php // echo $tabindex; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>コミッション<br>明細書</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php // echo $maintenance_text; ?>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="target-link gtm-click-download" href="<?php echo CFS()->get('business_comission_file_new'); ?>" target="_blank" data-gtm-click="コミッションのお支払いに関して">
                                <div class="page-content__detail">
                                    <button class="link-btn">
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>コミッションの<br>お支払いに関して</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="mypage_form <?php // echo $maintenance; ?>" data-formid="submitMypage" data-formabout="comission_tyousyo" <?php // echo $disabled.' '.$tabindex; ?>>
                                <div class="page-content__detail">
                                    <button class="link-btn" <?php // echo $tabindex; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>年間支払額報告書</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php // echo $maintenance_text; ?>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="target-link gtm-click-download" href="<?php echo CFS()->get('business_comission_confirm_new'); ?>" target="_blank" data-gtm-click="コミッション明細確認方法">
                                <div class="page-content__detail">
                                    <button class="link-btn">
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>コミッション明細確認方法</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- コミッション関連 -->
            <?php
                // セミナー申請表示条件指定
                $seminar_apply = false;
                $seminar_search = false;

                // P会員であること
                // GM以上のタイトルの方or紐づくサービス受領者にGM以上のタイトルの方
                // PB資格があるかた
                // メールアドレスが設定されている方
                if($member_type == 'p_member' && $_SESSION['member_info']['nextlv_num'] > 1 && $_SESSION['member_info']['pb_flag'] == 1 && $_SESSION['member_info']['mail_judge']){
                    $seminar_apply = true;
                }
                // 管理者アカウントであること
                if($_SESSION['member_info']['member_id'] == '000000000000') {
                    $seminar_apply = true;
                }
                // セミナー検索表示条件指定
                // P会員であること
                if($member_type == 'p_member' ){
                    $seminar_search = true;
                }
            ?>
            <?php
                if ( CFS()->get('business_campain_loop_new')) :
                    $tab_info_title = CFS()->get('tab_info_title');
                    $tab_info_acor = CFS()->get('tab_info_acor');
            ?>
            <div id="business-movie" class="page-content-div">
                <h3 class="<?php if ($tab_info_acor == 1) { echo 'acor-menu opened'; } ?>">
                    <?php
                        if ($tab_info_title) {
                            echo $tab_info_title;
                        } else {
                            echo 'お知らせ';
                        }
                    ?>
                </h3>
                <div class="container content px-0 <?php if ($tab_info_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="campaign_bnr row d-flex flex-row text-center">
                        <?php foreach ( CFS()->get('business_campain_loop_new') as $b ):?>
                            <?php if ($b['business_campain_lecture_new']) : ?>
                                <?php if($seminar_search): ?>
                                    <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'seminar_form';}?>
                                    <button class="<?php echo $cls; ?> p-0 gtm-click-link" data-formid="submitMypage" data-formabout="seminar_lecturer" data-gtm-click="PBS講師紹介動画">
                                        <img src="<?php echo $b['business_campain_file_new']; ?>" alt="PBS講師紹介動画">
                                    </button>
                                <?php endif; ?>
                            <?php else : ?>
                                <?php
                                    $member_id = $_SESSION['member_info']['member_id'];
                                    $member_id = substr($member_id, -8, 8);
                                    $link = $b['business_campain_link_new'];
                                    $blank = 'target="_blank"';
                                    if($b['business_campain_meisi_new']){
                                        $link = 'https://bizcard-print.com/Login/AutoLogin?ID='.$member_id;
                                        $blank = '';
                                    }
                                ?>
                                <a href="<?php echo $link;?>" <?php echo $blank;?> class="gtm-click-download" data-gtm-click="<?php echo $link;?>">
                                    <img src="<?php echo $b['business_campain_file_new']; ?>">
                                </a>
                            <?php endif; ?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php $seminar_acor = CFS()->get('seminar_acor'); ?>
            <div id="seminar" class="page-content-div">
                <h3 class="<?php if ($seminar_acor == 1) { echo 'acor-menu opened'; } ?>">セミナー関連</h3>
                <div class="container content-wrap <?php if ($seminar_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="row">
                        <?php if($seminar_search): ?>
                        <?php
                        //     $maintenance = '';
                        //     $disabled = '';
                        //     $maintenance_text = '';
                        //     $today_date = new DateTime('now');
                        //    $maintenance_start = new DateTime('2023-10-17 8:00:00');
                        //     $maintenance_end = new DateTime('2023-10-17 9:00:00');

                        //     if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
                        //         $maintenance = 'now-maintenance bg-white text-body';
                        //         $disabled = 'disabled style="pointer-events: none;""';
                        //         $maintenance_text = '<span class="business-maintenance">10月17日 AM8:00～9:00まで<br>メンテナンス中</span>';
                        //     }
                        ?>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <div class="page-content__detail">
                                <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'seminar_form';}?>
                                <button class="<?php echo $cls; ?> link-btn loading-parent <?php //echo $maintenance; ?> gtm-click-link" data-formid="submitMypage" data-formabout="seminar" <?php //echo $disabled; ?>  data-gtm-click="セミナー予約･チケット確認">
                                    <p class="mb-0 d-flex align-items-center justify-content-between <?php //if($maintenance_text) echo 'text-body'; ?>"><span>セミナー予約･チケット確認</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                    <?php //echo $maintenance_text; ?>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php
                            $business_seminar_pdfs_new = CFS()->get('business_seminar_pdfs_new');
                            if($business_seminar_pdfs_new) :
                                foreach ($business_seminar_pdfs_new as $business_seminar_pdf_new) :
                        ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a class="target-link gtm-click-download" href="<?php echo $business_seminar_pdf_new['business_seminar_pdf_data_new']; ?>" target="_blank" data-gtm-click="<?php echo $business_seminar_pdf_new['business_exam_apply_new']; ?>">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span><?php echo $business_seminar_pdf_new['business_exam_apply_new']; ?></span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    </div>
                </div>
            </div><!-- セミナー関連 -->
            <?php $intro_acor = CFS()->get('intro_acor'); ?>
            <div id="introduce" class="page-content-div">
                <h3 class="<?php if ($intro_acor == 1) { echo 'acor-menu opened'; } ?>">新規会員紹介</h3>
                <div class="container content-wrap <?php if ($intro_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="row">
                    <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'mypage_form';}?>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="<?php echo $cls; ?>  <?php // echo $maintenance; ?>" data-formid="submitMypage" data-formabout="intromember" data-type="submitMypage" <?php // echo $disabled.' '.$tabindex; ?>>
                                <div class="page-content__detail">
                                    <button class="link-btn" <?php // echo $tabindex; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>新規会員紹介</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php // echo $maintenance_text; ?>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="mypage_form <?php // echo $maintenance; ?>" data-formid="submitMypage" data-formabout="managemember" <?php // echo $disabled.' '.$tabindex; ?>>
                                <div class="page-content__detail">
                                    <button class="link-btn" <?php // echo $tabindex; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>紹介メールの登録状況の確認・削除</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php // echo $maintenance_text; ?>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="<?php echo $cls; ?>  <?php // echo $maintenance; ?>" data-formid="submitMypage" data-formabout="registermember" <?php // echo $disabled.' '.$tabindex; ?>>
                                <div class="page-content__detail">
                                    <button class="link-btn" <?php echo $tabindex; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>サービス受領者の登録</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php // echo $maintenance_text; ?>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a class="mypage_form  <?php // echo $maintenance; ?>" data-formid="submitMypage" data-formabout="fubi" <?php // echo $disabled.' '.$tabindex; ?>>
                                <div class="page-content__detail">
                                    <button class="link-btn" <?php // echo $tabindex; ?>>
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>新規申込者の不備一覧</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                        <?php // echo $maintenance_text; ?>
                                    </button>
                                </div>
                            </a>
                        </div>
                        <div class="page-content col-6 col-md-4 col-lg-3">
                            <a href="/document-list/#panflet">
                                <div class="page-content__detail">
                                    <button class="link-btn">
                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span>WEB関連マニュアル</span><i class="pl-2 fa-solid fa-angle-right"></i></p>
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- 新規会員紹介 -->
            <?php $support_acor = CFS()->get('support_acor'); ?>
            <div id="support" class="page-content-div">
                <h3 class="<?php if ($support_acor == 1) { echo 'acor-menu opened'; } ?>">ビジネスサポート<br>(販促品・名刺等)</h3>
                <?php $startdate = $_SESSION['member_info']['startdate']; ?>
                <div class="container content-wrap px-0 <?php if ($support_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <div class="business-item">
                        <h4>販促品注文</h4>
                        <div class="business-support row">
                            <div class="page-content banner-file col-6 col-md-4 col-lg-3 mb-0">
                                <div class="page-content__detail img-item border-0">
                                    <p class="js_form_btn mb-0">
                                        <a <?php if ($startdate <= date("Y/m/d")) { echo 'data-formid="submit_shop"'; } ?> class="d-block btn_opacity<?php if ($startdate > date("Y/m/d")) { echo ' now-editing'; } ?>">
                                            <img src="<?php echo CFS()->get('business_hansoku_file_new'); ?>" alt="販促品注文サイト">
                                        </a>
                                        <?php if ($startdate > date("Y/m/d")) { echo '<span class="d-block" style="color: #0a3052; font-size: .9rem; line-height: 1.5; padding-top: .5rem;">サービス利用開始日以降にご利用いただけます。</span>'; } ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                                $business_support_documents = CFS()->get('business_support_documents');
                                if ($business_support_documents) :
                                    foreach ($business_support_documents as $bs_doc) :
                                        $bs_doc_title = $bs_doc['business_support_doctitle'];
                                        $bs_doc_data = $bs_doc['business_support_document_new'];
                            ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <div class="page-content__detail">
                                    <a href="<?php echo $bs_doc_data; ?>" target="_blank" class="gtm-click-download" data-gtm-click="販促品資料 <?php echo strip_tags($bs_doc_title); ?>">
                                        <div class="target-link h-100">
                                            <button class="link-btn">
                                                <p class="mb-0 d-flex align-items-center justify-content-between"><span><?php echo strip_tags($bs_doc_title, '<br>'); ?></span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                    <div class="business-item pt-3">
                        <h4>モバイルレンタル</h4>
                        <div class="business-support row">
                            <?php
                                $fields = CFS()->get('business_mobile_loop');
                                foreach ($fields as $field) :
                            ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <div class="page-content__detail img-item border-0 shadow-none rounded">
                                    <a href="<?php echo $field['mobile_bnr_link']; ?>" class="d-block btn_opacity gtm-click-link" data-gtm-click="">
                                        <button class="link-btn">
                                            <img src="<?php echo $field['mobile_bnr_img']; ?>" alt="<?php echo $field['mobile_bnr_name']; ?>">
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="business-item">
                        <h4>全厚済会員名刺工房</h4>
                        <div class="business-support row">
                            <div class="page-content banner-file col-6 col-md-4 col-lg-3">
                                <?php
                                    // $maintenance = '';
                                    // $disabled = '';
                                    // $maintenance_text = '';
                                    // $today_date = new DateTime('now');
                                    // $maintenance_start = new DateTime('2023-04-26 10:00:00');
                                    // $maintenance_end = new DateTime('2023-04-28 17:00:00');

                                    // if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
                                    //     $maintenance = 'now-maintenance bg-white text-body';
                                    //     $disabled = 'disabled style="pointer-events: none;""';
                                    //     //$maintenance_text = '<span class="business-maintenance">4月28日 13:00〜17:00まで<br>メンテナンス中</span>';
                                    // }
                                ?>
                                <?php
                                    $member_id = $_SESSION['member_info']['member_id'];
                                    $member_id = substr($member_id, -8, 8);
                                ?>
                                <a class="<?php //echo $maintenance; ?>" <?php //echo $disabled; ?> href="https://bizcard-print.com/Login/AutoLogin?ID=<?php echo $member_id; ?>" target="_blank">
                                    <div class="page-content__detail img-item border-0">
                                        <img class="w-100" src="<?php echo CFS()->get('business_namecard_file_new'); ?>" alt="全厚済会員名刺工房">
                                    </div>
                                </a>
                                <?php //echo $maintenance_text; ?>
                            </div>
                            <?php
                                $business_namecard_specification_file_new = CFS()->get('business_namecard_specification_file_new');
                                if ($business_namecard_specification_file_new) :
                            ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a href="<?php echo $business_namecard_specification_file_new; ?>" target="_blank" rel="noopener noreferrer" class="gtm-click-download" data-gtm-click="会員名刺 仕様書">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>会員名刺　仕様書</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div>
                                </a>
                            </div>
                            <?php endif; ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a href="<?php echo CFS()->get('business_namecard_guide_file_normal_new'); ?>" target="_blank" class="gtm-click-download" data-gtm-click="ロゴガイドライン(全厚済)">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>ロゴガイドライン<br>(全厚済)</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div>
                                </a>
                            </div>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a href="<?php echo CFS()->get('business_namecard_guide_file_prime_new'); ?>" target="_blank" class="gtm-click-download" data-gtm-click="ロゴガイドライン(プライム倶楽部)">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>ロゴガイドライン<br>(プライム倶楽部)</span><i class="pl-2 fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- ビジネスサポート関連 -->
            <?php $business_acor = CFS()->get('business_acor'); ?>
            <div id="compliance" class="page-content-div">
                <h3 class="<?php if ($business_acor == 1) { echo 'acor-menu opened'; } ?>">コンプライアンス関連資料</h3>
                <div class="container content-wrap px-0 <?php if ($business_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <?php
                        $compliances = CFS()->get('business_compliance_loop_new');
                        if ($compliances) :
                            foreach ($compliances as $compliance) :
                                $compliance_subtitle = $compliance['business_compliance_subtitle'];
                                $compliance_loop = $compliance['business_compliance_file_loop'];
                    ?>
                    <div class="business-item">
                        <h4 class="acor-menu"><?php echo $compliance_subtitle; ?></h4>
                        <div class="business-item__content border-0 mb-4 acor-menu-child">
                            <div class="business-materials row">
                                <?php
                                    foreach($compliance_loop as $c_file) :
                                        $compliance_title = $c_file['business_compliance_title_new'];
                                        $compliance_file = $c_file['business_compliance_file_new'];
                                        $compliance_etc = $c_file['business_compliance_etc_new'];
                                ?>
                                <div class="business-item__content__detail compliance-detail__btn col-6 col-md-4 col-lg-3">
                                    <div class="business-item__content__detail__btn">
                                        <a class="target-link gtm-click-download" href="<?php echo $compliance_file ;?>" target="_blank" data-gtm-click="<?php echo $compliance_subtitle.' '.$compliance_title; ?>">
                                            <button class="link-btn">
                                                <p class="mb-0 d-flex align-items-center justify-content-between"><span><?php echo $compliance_title; ?></span><i class="fa-solid fa-file-pdf"></i></p>
                                            </button>
                                        </a>
                                    </div>
                                    <?php if ($compliance_etc) : ?>
                                        <p class="mt-2 mb-3 mb-0 etctr"><?php echo $compliance_etc; ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div><!-- コンプライアンス関連資料 -->

            <?php $new_explanation_acor = CFS()->get('new_explanation_acor'); ?>
            <div id="new-explanation" class="page-content-div">
                <h3 class="<?php if ($new_explanation_acor == 1) { echo 'acor-menu opened'; } ?>">新規説明資料関連</h3>
                <div class="container content-wrap px-0 <?php if ($new_explanation_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                    <?php
                        $new_explanation_lists = CFS()->get('new_explanation_list');
                        if ($new_explanation_lists) :
                            foreach ($new_explanation_lists as $new_explanation_list) :
                                $new_explanation_subtitle = $new_explanation_list['new_explanation_subtitle'];
                                $new_explanation_loop = $new_explanation_list['new_explanation_file_loop'];
                    ?>
                    <div class="business-item">
                        <h4 class="acor-menu"><?php echo $new_explanation_subtitle; ?></h4>
                        <div class="business-item__content border-0 mb-4 acor-menu-child">
                            <div class="business-materials row">
                                <?php
                                    foreach($new_explanation_loop as $n_file) :
                                        $new_explanation_title = $n_file['new_explanation_title'];
                                        $new_explanation_file = $n_file['new_explanation_file'];
                                        $new_explanation_etc = $n_file['new_explanation_etc'];
                                ?>
                                <div class="business-item__content__detail col-6 col-md-4 col-lg-3">
                                    <div class="business-item__content__detail__btn">
                                        <a class="target-link gtm-click-download" href="<?php echo $new_explanation_file ;?>" target="_blank" data-gtm-click="<?php echo $new_explanation_subtitle.' '.$new_explanation_title; ?>">
                                            <button class="link-btn">
                                                <p class="mb-0 d-flex align-items-center justify-content-between"><span><?php echo $new_explanation_title; ?></span><i class="fa-solid fa-file-pdf"></i></p>
                                            </button>
                                        </a>
                                    </div>
                                    <?php if ($new_explanation_etc) : ?>
                                        <p class="mt-2 mb-3 mb-0 etctr"><?php echo $new_explanation_etc; ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div><!-- 新規説明資料関連 -->

            <?php
                $ws_acor = CFS()->get('ws_acor');
                if($_SESSION['member_info']['nextlv_num'] >= 2 || $_SESSION['member_info']['sub_title'] >= 2 || $_SESSION['member_info']['member_id'] == '000000000000'):
            ?>
                <div id="ws" class="page-content-div">
                    <h3 class="<?php if ($ws_acor == 1) { echo 'acor-menu opened'; } ?>">WS（ウィナーズ）関連資料</h3>
                    <div class="container content-wrap px-0 <?php if ($ws_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                        <div class="business-item">
                            <h4>WS資料</h4>
                            <div class="business-support row">
                                <div class="business-item__content <?php echo $maintenance; ?> col-6 col-md-4 col-lg-3">
                                    <div class="business-item__content__detail">
                                        <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                                        <button class="<?php echo $cls; ?> link-btn loading-parent <?php echo $maintenance; ?>" data-name="ws_file" data-type="get-info" <?php echo $disabled; ?>>
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>WS資料</span><i class="fa-solid fa-angle-right"></i></p>
                                            <?php echo $maintenance_text; ?>
                                        </button>
                                    </div>
                                </div>
                                <!-- <div class="business-item__content col-6 col-md-4 col-lg-3">
                                    <div class="business-item__content__detail">
                                        <?php //if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                                        <button class="<?php //echo $cls; ?> link-btn loading-parent <?php //echo $maintenance; ?>" data-name="ws_file" data-type="get-info" <?php //echo $disabled; ?>>
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>WS資料</span><i class="fa-solid fa-angle-right"></i></p>
                                            <?php //echo $maintenance_text; ?>
                                        </button>
                                    </div>
                                </div> -->
                                <?php
                                    $today = date("Y-m-d H:i");
                                    $firstDayStart = date("Y-m-1 0:00");
                                    $firstDayEnd = date("Y-m-1 4:00");

                                    $result = false;
                                    if ( strtotime($firstDayStart) < strtotime($today) && strtotime($today) < strtotime($firstDayEnd) ) {
                                        $this_page_id = get_the_ID();
                                        $result = 1;
                                    }
                                    while ($result == true) {
                                        $result = update_post_meta($this_page_id, 'business_ws_file_text_new', '');
                                    }
                                    $business_ws_file_text_new = CFS()->get('business_ws_file_text_new');
                                ?>
                                <div class="business-item__content col-6 col-md-4 col-lg-3">
                                    <a class="target-link gtm-click-download" href="<?php echo CFS()->get('business_ws_tejun_new');?>" target="_blank" data-gtm-click="ウィナーズ（WS）関連資料 ご利用手順">
                                        <div class="business-item__content__detail">
                                            <button class="link-btn">
                                                <p class="mb-0 d-flex align-items-center justify-content-between"><span>ご利用手順</span><i class="fa-solid fa-file-pdf"></i></p>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php if($business_ws_file_text_new): ?>
                                <p class="mt-1 mb-0 d-sm-block etctr"><?php echo $business_ws_file_text_new; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="business-item">
                            <?php if(CFS()->get('business_ws_promote_loop_new')): ?>
                                <?php foreach(CFS()->get('business_ws_promote_loop_new') as $b): ?>
                                    <h4><?php echo $b['business_ws_promote_title_new'];?></h4>
                                    <div class="business-support row">
                                        <?php
                                            $business_ws_promote_file_loop_new = $b['business_ws_promote_file_loop_new'];
                                            $count = count($business_ws_promote_file_loop_new) - 1;
                                            foreach( $business_ws_promote_file_loop_new as $index => $bs):
                                            if (($index == 6 && wp_is_mobile()) || ($index == 4 && !wp_is_mobile())) {
                                                echo '<div class="d-flex flex-column-reverse w-100">';
                                                echo '<div class="acor-menu js-btn-text-change text-center font-smaller d-inline-block border-bottom border-dark py-1 pl-3 pr-5 my-3 mx-auto">すべて表示</div>';
                                                echo '<div class="acor-menu-child"><div class="d-flex flex-wrap">';
                                            }
                                        ?>
                                            <div class="business-item__content col-6 col-md-4 col-lg-3">
                                                <a class="target-link gtm-click-download" href="<?php echo $bs['business_ws_promote_file_new'];?>" target="_blank" data-gtm-click="<?php echo $b['business_ws_promote_title_new'].' '.$bs['business_ws_promote__title_new'];?>">
                                                    <div class="business-item__content__detail">
                                                        <button class="link-btn">
                                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span><?php echo $bs['business_ws_promote__title_new'];?></span><i class="fa-solid fa-file-pdf"></i></p>
                                                        </button>
                                                    </div>
                                                </a>
                                                <?php if($bs['business_ws_promote_file_caption_new']): ?>
                                                    <p class="mt-3 mb-0"><?php echo $bs['business_ws_promote_file_caption_new'];?></p>
                                                <?php endif; ?>
                                            </div>
                                        <?php
                                            if (($index >= 6 && wp_is_mobile()) || ($index >= 4 && !wp_is_mobile())) {
                                                if ($index == $count) {
                                                    echo '</div></div></div>';
                                                }
                                            }
                                            endforeach;
                                        ?>
                                    </div>
                                <?php endforeach;?>
                            <?php else:?>
                                <p class="mb-0">現在こちらの資料はございません。</p>
                            <?php endif;?>
                        </div>
                    </div>
                </div><!-- ウィナーズ（WS）関連資料 -->
            <?php endif; ?>
            <?php
                $pb_acor = CFS()->get('pb_acor');
                if ($_SESSION['member_info']['pb_flag']):
            ?>
                <div id="pb-exam" class="page-content-div pb-exam">
                    <h3 class="<?php if ($pb_acor == 1) { echo 'acor-menu opened'; } ?>">PB試験関連</h3>
                    <div class="container content-wrap px-3 <?php if ($pb_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                        <div class="row">
                            <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a class="target-link <?php echo $cls; ?> gtm-click-download" data-name="pb_exam" data-type="get-info" data-gtm-click="PB資格認定書">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 d-flex align-items-center justify-content-between"><span>PB資格認定書</span><i class="fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div> 
                                </a>
                            </div>
                            <?php if ($pb_exam_text_new) : ?>
                            <div class="page-content col-6 col-md-4 col-lg-3">
                                <a class="target-link gtm-click-download" href="<?php echo $pb_exam_text_new; ?>" target="_blank" data-gtm-click="試験問題集">
                                    <div class="page-content__detail">
                                        <button class="link-btn">
                                            <p class="mb-0 mb-0 d-flex align-items-center justify-content-between"><span>試験問題集</span><i class="fa-solid fa-file-pdf"></i></p>
                                        </button>
                                    </div>
                                </a>    
                            </div>
                            <?php endif; ?>
                            <?php if( CFS()->get('pb_exam_tejun_new')):?>
                                <div class="page-content col-6 col-md-4 col-lg-3">
                                    <a class="target-link gtm-click-download" href="<?php echo CFS()->get('pb_exam_tejun_new');?>" target="_blank" data-gtm-click="受験の手順">
                                        <div class="page-content__detail">
                                            <button class="link-btn">
                                                <p class="mb-0 d-flex align-items-center justify-content-between"><span>受験の手順</span><i class="fa-solid fa-angle-right"></i></p>
                                            </button>
                                        </div>
                                    </a>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php
                $business_free_loop_new = CFS()->get('business_free_loop_new');
                if($business_free_loop_new):
                    foreach ( $business_free_loop_new as $b ):
                        $free_acor = $b['free_acor'];
                        $business_free_title_new = $b['business_free_title_new'];
            ?>
                    <div id="<?php echo $b['business_free_link_new'];?>" class="page-content-div">
                        <h3 class="<?php if ($free_acor == 1) { echo 'acor-menu opened'; } ?>"><?php echo $business_free_title_new;?></h3>
                        <div class="container content-wrap <?php if ($free_acor == 1) { echo 'acor-menu-child opened'; } ?>" style="display: block;">
                            <div>
                                <div class="row">
                                    <?php
                                        $business_free_banner_loop_new = $b['business_free_banner_loop_new'];
                                        foreach ( $business_free_banner_loop_new as $bb ) :
                                            $banner_url_new = $bb['business_free_banner_url_new'];
                                            $banner_title_new = $bb['business_free_banner_title_new'];
                                            $banner_img_new = $bb['business_free_banner_img_new'];
                                    ?>
                                        <div class="page-content col-6 col-md-4 col-lg-3">
                                            <a class="target-link gtm-click-link" href="<?php echo $banner_url_new; ?>" target="_blank" data-gtm-click="<?php echo $business_free_title_new.' '.$banner_title_new;?>">
                                                <div class="page-content__detail img-item">
                                                    <button class="link-btn">
                                                        <img src="<?php echo $banner_img_new; ?>" alt="<?php echo $banner_title_new; ?>">
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="row">
                                    <?php
                                        $business_free_file_loop_new = $b['business_free_file_loop_new'] ?? [];
                                        if (!is_array($business_free_file_loop_new)) {
                                            $business_free_file_loop_new = [];
                                        }
                                        foreach ( $business_free_file_loop_new as $bf ) :
                                            $business_free_file_title_new = $bf['business_free_file_title_new'] ?? '';
                                    ?>
                                        <div class="page-content col-6 col-md-4 col-lg-3">
                                            <a class="target-link gtm-click-download" href="<?php echo $bf['business_free_file_upload_new'];?>" target="_blank" data-gtm-click="<?php echo $business_free_title_new.' '.$business_free_file_title_new; ?>">
                                                <div class="page-content__detail">
                                                    <button class="link-btn">
                                                        <p class="mb-0 d-flex align-items-center justify-content-between"><span><?php echo $business_free_file_title_new;?></span><i class="fa-solid fa-file-pdf"></i></p>
                                                    </button>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php
                                    $business_free_sub_loop_new = $b['business_free_sub_loop_new'] ?? [];
                                    if (is_array($business_free_sub_loop_new) && $business_free_sub_loop_new) :
                                ?>
                                    <div class="business-item free-sub mt-4">
                                        <?php foreach ($business_free_sub_loop_new as $bs) :
                                            $business_free_sub_title_new = $bs['business_free_sub_title_new'] ?? '';
                                        ?>
                                            <h4><?php echo esc_html($business_free_sub_title_new); ?></h4>
                                            <div class="row">
                                                <?php
                                                $files = $bs['business_free_sub_file_loop_new'] ?? [];
                                                if (!is_array($files)) {
                                                    $files = [];
                                                }
                                                foreach ($files as $file) :
                                                    $business_free_sub_file_title_new   = $file['business_free_sub_file_title_new'] ?? '';
                                                    $business_free_sub_file_upload_new  = $file['business_free_sub_file_upload_new'] ?? '';
                                                    $business_free_sub_file_caption_new = $file['business_free_sub_file_caption_new'] ?? '';
                                                ?>
                                                    <div class="business-item__content row">
                                                        <div class="business-item__content__inner col-6 col-md-4 col-lg-3">
                                                            <div class="business-item__content__detail">
                                                                <a class="target-link gtm-click-download"
                                                                href="<?php echo esc_url($business_free_sub_file_upload_new); ?>"
                                                                target="_blank"
                                                                data-gtm-click="<?php echo esc_attr(($business_free_title_new ?? '').' '.$business_free_sub_title_new.' '.$business_free_sub_file_title_new); ?>">
                                                                    <button class="link-btn">
                                                                        <p class="mb-0 d-flex align-items-center justify-content-between">
                                                                            <span><?php echo esc_html($business_free_sub_file_title_new); ?></span>
                                                                            <i class="fa-solid fa-file-pdf"></i>
                                                                        </p>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php if ($business_free_sub_file_caption_new) : ?>
                                                            <p class="mt-3 mb-0 etctr"><?php echo esc_html($business_free_sub_file_caption_new); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    $business_modal = CFS()->get('business_modal');
    $business_modal_style = CFS()->get('business_modal_style');
    $business_modal_color = CFS()->get('business_modal_color');
    if ($business_modal) :
?>
<div id="first-modal_business" class="js-modal_box_new modal_box_new <?php if ($business_modal_style) echo 'modal_box_new_side'; ?>">
    <div class="js-modal_bg_new modal_bg_new"></div>
    <div class="js-modal_inner_new modal_inner_new" style="border-color: <?php echo $business_modal_color; ?>;">
        <div class="modal_box_new_tit">
            <div class="d-flex justify-content-end">
                <button class="js-modal_close_new modal_close_new rounded-pill d-block ml-auto" style="border-color: <?php echo $business_modal_color; ?>; color: <?php echo $business_modal_color; ?>;">
                    × 閉じる
                </button>
            </div>
        </div>
        <div class="modal_block_new">
            <?php echo $business_modal; ?>
        </div>
    </div>
</div>
<?php endif; ?>