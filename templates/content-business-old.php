<?php
require_once(get_stylesheet_directory().'/api/get_membertree_result.php');
$membertree = get_membertree_date();
$member_type = $_SESSION['member_info']['member_type'];

// メール登録不備判定
$deficient_popup = '';
if(!$_SESSION['member_info']['mail_judge']){
    $deficient_popup = 'deficient_popup';
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
        <div class="row">
            <div class="flame-side-info col-12 col-lg-3 order-1 order-lg-2 px-lg-0 mb-4 mb-lg-0">
                <div class="page-content-innerwrap row">
                    <div class="side-item sp">
                        <p class="name">ようこそ<span class="welcome"><?php echo $_SESSION['member_info']['member_name']; ?></span>様</p>
                    </div>
                    <div class="side-item pc <?php if (wp_is_mobile()) { echo 'acor-menu'; } ?>">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/icons/member-card.png"><span>会員情報</span>
                    </div>
                    <div class="side-item <?php if (wp_is_mobile()) { echo 'acor-menu-child'; } ?>">
                        <div class="side-item__member">
                            <p class="name">ようこそ<span class="welcome"><?php echo $_SESSION['member_info']['member_name']; ?></span>様</p>
                        </div>
                        <div class="side-item__content">
                            <h2 class="business-item">タイトル</h2>
                                <div class="lank-img">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/rank_<?php echo $_SESSION['member_info']['nextlv']; ?>.png" alt="ランク">
                                </div>
                        </div>
                        <div class="side-item__content">
                            <h2 class="business-item">資格</h2>
                                <div class="side-item__content__qualification d-flex">
                                    <div class="qualification-item w-50">
                                        <?php if( $_SESSION['member_info']['pb_flag']): ?>
                                            <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                                            <a class="<?php echo $cls; ?> cursor-pointer" data-name="pb_exam" data-type="get-info" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'PB資格','value': '1'})">
                                                <div class="qualification-icon">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/pb.png" alt="PB資格">
                                                </div>
                                                <div class="qualification-btn">
                                                    <span>認定書</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.264 14.609">
                                                        <g transform="translate(-23.574)">
                                                            <path d="M59.775,4.89H56.4V0H51.276V4.89H47.9l5.937,7.2Z" transform="translate(-23.632)"/>
                                                            <rect width="13.264" height="2.058" transform="translate(23.574 12.551)"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php else:?>
                                            <img  class="disactive-pbflag" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/pb-unacquired.png" alt="PB資格が未取得です">
                                        <?php endif;?>
                                    </div>
                                    <?php if( $_SESSION['member_info']['ex_flag']): ?>
                                        <div class="qualification-item w-50">
                                            <a href="<?php echo CFS()->get('business_ep_file_new'); ?>" class="cursor-pointer"  rel="noreferrer" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'EP資格','value': '1'})">
                                                <div class="qualification-icon">
                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/ep.png" alt="EP資格">
                                                </div>
                                                <div class="qualification-btn">
                                                    <span>資料</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.264 14.609">
                                                        <g transform="translate(-23.574)">
                                                            <path d="M59.775,4.89H56.4V0H51.276V4.89H47.9l5.937,7.2Z" transform="translate(-23.632)"/>
                                                            <rect width="13.264" height="2.058" transform="translate(23.574 12.551)"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif;?>
                                </div>
                        </div>
                    </div>
                    <div class="side-item pc <?php if (wp_is_mobile()) { echo 'acor-menu'; } ?>">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/business/icons/member.png"><span>現在の会員口数</span>
                    </div>
                    <div class="side-item <?php if (wp_is_mobile()) { echo 'acor-menu-child'; } ?>">
                        <?php if (wp_is_mobile()) { echo '<div class="d-flex flex-nowrap align-items-center justify-content-center">'; } ?>
                            <div class="side-item__membership">
                                <?php echo CFS()->get('business_member_number_new'); ?><span class="unit">口</span>
                            </div>
                        <?php
                            $business_member_number_update_new = date('Y年m月d日', strtotime(CFS()->get('business_member_number_update_new')));
                            if (!wp_is_mobile()) :
                        ?>
                            <div class="side-item__date">
                                <?php echo $business_member_number_update_new; ?><span>現在</span>
                            </div>
                        <?php else : ?>
                            <div class="side-item__date">
                                （<?php echo $business_member_number_update_new; ?><span>現在</span>）
                            </div>
                            </div><!-- <div class="d-flex flex-nowrap align-items-center"> -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="flame-body col-12 col-lg-9 order-2 order-lg-1">
                <div class="page-content-innerwrap">
                    <div class="page-content-div business-schedule">
                        <h3 class="<?php if (wp_is_mobile()) { echo 'acor-menu'; } ?>">スケジュール</h3>
                        <div id="event" class="content event <?php if (wp_is_mobile()) { echo 'acor-menu-child'; } ?>">
                            <div class="event-content">
                                <input type="radio" name="tab_name" id="list" checked>
                                <label class="tab_class list-tab" for="list">一覧表示</label>
                                <div id="events" class="content_class">
                                <?php
                                    $today_date = date( "Y-m-d" );
                                    $three_month = date('Y-m-1', strtotime('+3 month'));
                                    $week = array( "日", "月", "火", "水", "木", "金", "土" );
                                    // ループを変更したら/cms/wp-content/themes/zenkosai/api/event-readmore.phpも変更する
                                    $posts_per_page = 5;
                                    $args = array(
                                        'post_status' => 'publish',
                                        'posts_per_page' => $posts_per_page,
                                        'post_type' => 'b_calender',
                                        'orderby' => 'meta_value',
                                        'order' => 'ASC',
                                        'meta_key' => 'b_calender_date',
                                        'meta_query' => array(
                                            'relation' => 'AND',
                                            'three_month' => array(
                                                'key'     => 'b_calender_date',
                                                'value'   => $three_month,
                                                'compare' => '<',
                                            ),
                                            'today_date' => array(
                                                'key'     => 'b_calender_date',
                                                'value'   => $today_date,
                                                'compare' => '>=',
                                            ),
                                        ),
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
                                    <div class="more_disp some-article text-center mt-4 mb-2">
                                        <button class="py-1 pl-3 pr-5 rounded-pill">もっと見る</button>
                                    </div>
                                    <!-- <div class="more_disp all-article text-center font-smaller">
                                        <button data-postnum="<?php echo $publish_posts; ?>" class="border-bottom border-dark">直近のスケジュールを全て表示</button>
                                    </div> -->
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
                    <?php
                        if ( CFS()->get('business_campain_loop_new')) :
                            $tab_info_title = CFS()->get('tab_info_title');
                            $tab_info_acor = CFS()->get('tab_info_acor');
                    ?>
                    <div class="page-content-div business-news">
                        <h3 class="<?php if ($tab_info_acor == 1) { echo 'acor-menu'; } ?>">
                            <?php
                                if ($tab_info_title) {
                                    echo $tab_info_title;
                                } else {
                                    echo 'お知らせ';
                                }
                            ?>
                        </h3>
                        <div class="container content <?php if ($tab_info_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="campaign_bnr row d-flex flex-row text-center">
                            <?php foreach ( CFS()->get('business_campain_loop_new') as $b ):?>
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
                                <a href="<?php echo $link;?>" <?php echo $blank;?> onclick="gtag('event', 'click', {'event_category': 'link','event_label': '<?php echo $link;?>','value': '1'})">
                                    <img src="<?php echo $b['business_campain_file_new']; ?>">
                                </a>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php
                        $pb_exam_text_new = CFS()->get('pb_exam_text_new');
                        if (!($_SESSION['member_info']['pb_flag'])):
                    ?>
                    <?php $pb_acor = CFS()->get('pb_acor'); ?>
                    <div id="pb-exam" class="page-content-div pb-exam">
                        <h3 class="<?php if ($pb_acor == 1) { echo 'acor-menu'; } ?>">PB試験関連</h3>
                        <div class="container content-wrap <?php if ($pb_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="row">
                                <?php if ($pb_exam_text_new) : ?>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="target-link" href="<?php echo $pb_exam_text_new; ?>" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '試験問題集','value': '1'})">
                                            <button class="link-btn">
                                                <p class="mb-0">試験問題集</p>
                                            </button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                <g transform="translate(-0.11)">
                                                    <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                    <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php
                                    $pb_exam_tejun_new = CFS()->get('pb_exam_tejun_new');
                                    if ($pb_exam_tejun_new) :
                                ?>
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <a class="target-link" href="<?php echo $pb_exam_tejun_new; ?>" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '受験の手順','value': '1'})">
                                                <button class="link-btn">
                                                    <p class="mb-0">受験の手順</p>
                                                </button>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                    <g transform="translate(-0.11)">
                                                        <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                        <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif;?>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='modal_trigger';}?>
                                        <?php
                                            // $today_date = new DateTime('now');
                                            // $maintenance = '';
                                            // $disabled = '';
                                            // $maintenance_text = '';

                                            // $maintenance_start = new DateTime('2022-01-13 10:00:00');
                                            // $maintenance_end = new DateTime('2022-01-13 20:00:00');
                                            // if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
                                            //     $maintenance = 'now-maintenance';
                                            //     $disabled = 'disabled';
                                            //     $maintenance_text = '<span class="business-maintenance">1月14日AM8:00〜AM9:00まで<br>メンテナンス中</span>';
                                            // }
                                        ?>
                                        <div class="<?php echo $cls; ?>">
                                            <button class="link-btn <?php //echo $maintenance; ?>" data-name="pb_exam" data-type="pop-up" <?php //echo $disabled; ?>>
                                                <p class="mb-0">PB試験を<br class="d-none d-sm-block">受験する</p>
                                                <?php //echo $maintenance_text; ?>
                                            </button>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                <g transform="translate(8176.361 -1665.095)">
                                                    <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                    <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="modal_box">
                                            <div class="modal_bg"></div>
                                            <div class="modal_inner">
                                                <div class="modal_block">
                                                    <div class="pb_detail_title px-2 py-1 mb-3">
                                                        <p class="mb-0">PB試験を受験する</p>
                                                    </div>
                                                    <?php echo CFS()->get('business_exam_apply_new'); ?>
                                                    <div class="btn-box row justify-content-around flex-column-reverse flex-sm-row-reverse">
                                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0 cursor-pointer">
                                                            <button class="link-btn modal_close">
                                                                <p class="mb-0">閉じる</p><span class="close-icon mt-0"></span>
                                                            </button>
                                                        </div>
                                                        <div class="col-12 col-sm-6 cursor-pointer">
                                                            <button class="get-info link-btn loading-parent <?php //echo $maintenance; ?>" data-name="pb_exam" <?php //echo $disabled; ?>>
                                                                <p class="mb-0">受験する</p>
                                                                <?php //echo $maintenance_text; ?>
                                                            </button>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                                <g transform="translate(8176.361 -1665.095)">
                                                                    <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                                    <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                                </g>
                                                            </svg>
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
                        <h3 class="<?php if ($membertree_acor == 1) { echo 'acor-menu'; } ?>">組織図</h3>
                        <div class="container content-wrap <?php if ($membertree_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="row">
                                <div class="chart-content">
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <a class="mypage_form" data-formid="submitMypage" data-formabout="membertreecurrent" >
                                                <button class="link-btn">
                                                    <p class="mb-0">組織図（当月）</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                        <g transform="translate(8176.361 -1665.095)">
                                                            <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                            <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                        $current_text_new = $membertree['current_text'];
                                        if ($current_text_new) :
                                    ?>
                                    <p class="mt-3 mb-0 etctr"><?php echo $current_text_new; ?><br></p>
                                    <?php
                                        endif;
                                        $arrival_text_new = $membertree['arrival_text'];
                                        if ($arrival_text_new) :
                                    ?>
                                    <p class="mt-0 font-small etctr"><?php echo $arrival_text_new; ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="chart-content">
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <a class="mypage_form" data-formid="submitMypage" data-formabout="membertreepre">
                                                <button class="link-btn">
                                                    <p class="mb-0">組織図（前月）</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                        <g transform="translate(8176.361 -1665.095)">
                                                            <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                            <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <p class="mb-0 etctr"><?php echo $membertree['previous_text'] ?></p>
                                </div>
                                <?php if(CFS()->get('business_tree_file_new')):?>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a href="<?php echo CFS()->get('business_tree_file_new'); ?>" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '組織図の確認方法（資料）','value': '1'})">
                                            <button class="link-btn target-link">
                                                <p class="mb-0">組織図の確認<br>方法（資料）</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div><!-- 組織図 -->
                    <!-- プライムビジネス試験（PB試験）関連 -->
                    <?php $commission_acor = CFS()->get('commission_acor'); ?>
                    <div id="commission" class="page-content-div">
                        <h3 class="<?php if ($commission_acor == 1) { echo 'acor-menu'; } ?>">コミッション関連</h3>
                        <div class="container content-wrap <?php if ($commission_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="row">
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="mypage_form" data-formid="submitMypage" data-formabout="comission_meisai">
                                            <button class="link-btn">
                                                <p class="mb-0">コミッション<br>明細書</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div> 
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="target-link" href="<?php echo CFS()->get('business_comission_file_new'); ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'コミッションのお支払いに関して','value': '1'})">
                                            <button class="link-btn">
                                                <p class="mb-0">コミッションの<br>お支払いに関して</p>
                                            </button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                <g transform="translate(-0.11)">
                                                    <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                    <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="mypage_form" data-formid="submitMypage" data-formabout="comission_tyousyo">
                                            <button class="link-btn">
                                                <p class="mb-0">年間支払額報告書</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="target-link" href="<?php echo CFS()->get('business_comission_confirm_new'); ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'コミッション明細確認方法','value': '1'})">
                                            <button class="link-btn">
                                                <p class="mb-0">コミッション明細確認方法</p>
                                            </button>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                <g transform="translate(-0.11)">
                                                    <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                    <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- コミッション関連 -->
                                        <?php $seminar_acor = CFS()->get('seminar_acor'); ?>
                    <div id="seminar" class="page-content-div">
                        <h3 class="<?php if ($seminar_acor == 1) { echo 'acor-menu'; } ?>">セミナー関連</h3>
                        <div class="container content-wrap <?php if ($seminar_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="row">
                                <?php
                                    $seminar_apply = false;
                                    $seminar_search = false;
                                    // セミナー申請表示条件指定
                                    // P会員であること
                                    // GM以上のタイトルの方or紐づくサービス受領者にGM以上のタイトルの方
                                    // PB資格があるかた
                                    // メールアドレスが設定されている方
                                    if($member_type == 'p_member' && $_SESSION['member_info']['nextlv_num'] > 1 && $_SESSION['member_info']['pb_flag'] == 1 && $_SESSION['member_info']['mail_judge']){
                                        $seminar_apply = true;
                                    }
                                    // 管理者アカウントであること
                                    if($_SESSION['member_info']['member_id'] === '000000000000') {
                                        $seminar_apply = true;
                                    }
                                    // セミナー検索表示条件指定
                                    // P会員であること
                                    if($member_type == 'p_member' ){
                                        $seminar_search = true;
                                    }
                                ?>
                                <?php if($seminar_search): ?>
                                    <?php
                                        $maintenance = '';
                                        $disabled = '';
                                        $maintenance_text = '';
                                        $today_date = new DateTime('now');
                                        $maintenance_start = new DateTime('2023-06-06 07:00:00');
                                        $maintenance_end = new DateTime('2023-06-06 09:00:00');

                                        if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
                                            $maintenance = 'now-maintenance bg-white text-body';
                                            $disabled = 'disabled style="pointer-events: none;""';
                                            $maintenance_text = '<span class="business-maintenance">6月6日 AM7:00〜9:00まで<br>メンテナンス中</span>';
                                        }
                                    ?>
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'seminar_form';}?>
                                            <button class="<?php echo $cls; ?> link-btn loading-parent <?php echo $maintenance; ?>" data-formid="submitMypage" data-formabout="seminar" <?php echo $disabled; ?>>
                                                <p class="mb-0 pr-sm-4">セミナー予約･チケット確認</p>
                                                <?php echo $maintenance_text; ?>
                                            </button>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                <g transform="translate(8176.361 -1665.095)">
                                                    <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                    <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                </g>
                                            </svg>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php
                                    $business_seminar_pdfs_new = CFS()->get('business_seminar_pdfs_new');
                                    if($business_seminar_pdfs_new) :
                                        foreach ($business_seminar_pdfs_new as $business_seminar_pdf_new) :
                                ?>
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <a class="target-link" href="<?php echo $business_seminar_pdf_new['business_seminar_pdf_data_new']; ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '<?php echo $business_seminar_pdf_new['business_exam_apply_new']; ?>','value': '1'})">
                                                <button class="link-btn">
                                                    <p class="mb-0"><?php echo $business_seminar_pdf_new['business_exam_apply_new']; ?></p>
                                                </button>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                    <g transform="translate(-0.11)">
                                                        <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                        <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
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
                        <h3 class="<?php if ($intro_acor == 1) { echo 'acor-menu'; } ?>">新規会員紹介</h3>
                        <div class="container content-wrap <?php if ($intro_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="row">
                            <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'mypage_form';}?>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="<?php echo $cls; ?>" data-formid="submitMypage" data-formabout="intromember" data-type="submitMypage">
                                            <button class="link-btn">
                                                <p class="mb-0">新規会員紹介</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">   
                                        <a class="mypage_form" data-formid="submitMypage" data-formabout="managemember">
                                            <button class="link-btn">
                                                <p class="mb-0">紹介メールの登録状況の確認・削除</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="<?php echo $cls; ?>" data-formid="submitMypage" data-formabout="registermember">
                                            <button class="link-btn">
                                                <p class="mb-0">サービス受領者の登録</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a class="mypage_form" data-formid="submitMypage" data-formabout="fubi">
                                            <button class="link-btn">
                                                <p class="mb-0">新規申込者の不備一覧</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="page-content">
                                    <div class="page-content__detail">
                                        <a href="/document-list/#panflet">
                                            <button class="link-btn">
                                                <p class="mb-0">WEB関連マニュアル</p>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- 新規会員紹介 -->
                    <?php $support_acor = CFS()->get('support_acor'); ?>
                    <div id="support" class="page-content-div">
                        <h3 class="<?php if ($support_acor == 1) { echo 'acor-menu'; } ?>">ビジネスサポート関連</h3>
                        <?php $startdate = $_SESSION['member_info']['startdate']; ?>
                        <div class="container content-wrap <?php if ($support_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <div class="business-item">
                                <h4>販促品注文</h4>
                                <div class="business-support row">
                                    <div class="business-item__content banner-file">
                                        <div class="business-item__content__detail">
                                            <p class="js_form_btn">
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
                                    <div class="business-item__content">
                                        <div class="business-item__content__detail h-100">
                                            <a href="<?php echo $bs_doc_data; ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '販促品資料 <?php echo strip_tags($bs_doc_title); ?>','value': '1'})">
                                                <div class="target-link h-100">
                                                    <button class="link-btn">
                                                        <p class="mb-0"><?php echo strip_tags($bs_doc_title, '<br>'); ?></p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                        <g transform="translate(-0.11)">
                                                            <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                            <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                            <div class="business-item">
                                <h4>モバイルレンタル</h4>
                                <div class="business-support row">
                                    <div class="business-item__content">
                                        <div class="business-item__content__detail">
                                            <a href="/business/mobile-rental/">
                                                <button class="link-btn">
                                                    <p class="mb-0">モバイルレンタル</p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                        <g transform="translate(8176.361 -1665.095)">
                                                            <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                            <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="business-item">
                                <h4>全厚済会員名刺工房</h4>
                                <div class="business-support row">
                                    <div class="business-item__content banner-file">
                                        <div class="business-item__content__detail">
                                            <?php
                                                // $maintenance = '';
                                                // $disabled = '';
                                                // $maintenance_text = '';
                                                // $today_date = new DateTime('now');
                                                // $maintenance_start = new DateTime('2023-04-28 13:00:00');
                                                // $maintenance_end = new DateTime('2023-04-28 17:00:00');

                                                // if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
                                                //     $maintenance = 'now-maintenance bg-white text-body';
                                                //     $disabled = 'disabled style="pointer-events: none;""';
                                                //     $maintenance_text = '<span class="business-maintenance">12月26日 AM6:00〜8:00まで<br>メンテナンス中</span>';
                                                // }
                                            ?>
                                            <?php
                                                $member_id = $_SESSION['member_info']['member_id'];
                                                $member_id = substr($member_id, -8, 8);
                                            ?>
                                            <a class="<?php //echo $maintenance; ?>" <?php //echo $disabled; ?> href="https://bizcard-print.com/Login/AutoLogin?ID=<?php echo $member_id; ?>" target="_blank">
                                                <img class="w-100" src="<?php echo CFS()->get('business_namecard_file_new'); ?>" alt="全厚済会員名刺工房">
                                            </a>
                                            <?php //echo $maintenance_text; ?>
                                        </div>
                                    </div>
                                    <?php
                                        $business_namecard_specification_file_new = CFS()->get('business_namecard_specification_file_new');
                                        if ($business_namecard_specification_file_new) :
                                    ?>
                                    <div class="business-item__content">
                                        <div class="business-item__content__detail h-100">
                                            <a href="<?php echo $business_namecard_specification_file_new; ?>" target="_blank" rel="noopener noreferrer" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '会員名刺 仕様書','value': '1'})">
                                                <div class="target-link h-100">
                                                    <button class="link-btn">
                                                        <p class="mb-0">会員名刺　仕様書</p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                        <g transform="translate(-0.11)">
                                                            <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                            <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="business-item__content">
                                        <div class="business-item__content__detail h-100">
                                            <a href="<?php echo CFS()->get('business_namecard_guide_file_normal_new'); ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'シンボルガイドライン(一般財団法人 全国福利厚生共済会)','value': '1'})">
                                                <div class="target-link h-100">
                                                    <button class="link-btn">
                                                        <p class="mb-0">シンボルガイドライン<br>(一般財団法人 全国福利厚生共済会)</p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                        <g transform="translate(-0.11)">
                                                            <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                            <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="business-item__content">
                                        <div class="business-item__content__detail h-100">
                                            <a href="<?php echo CFS()->get('business_namecard_guide_file_prime_new'); ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'シンボルガイドライン(プライム倶楽部)','value': '1'})">
                                                <div class="target-link h-100">
                                                    <button class="link-btn">
                                                        <p class="mb-0">シンボルガイドライン<br>(プライム倶楽部)</p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                        <g transform="translate(-0.11)">
                                                            <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                            <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                        </g>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- ビジネスサポート関連 -->
                    <?php $business_acor = CFS()->get('business_acor'); ?>
                    <div id="bp-materials" class="page-content-div">
                        <h3 class="<?php if ($business_acor == 1) { echo 'acor-menu'; } ?>">ビジネス資料関連</h3>
                        <div class="container content-wrap <?php if ($business_acor == 1) { echo 'acor-menu-child'; } ?>">
                            <?php
                                $compliances = CFS()->get('business_compliance_loop_new');
                                if ($compliances) :
                                    foreach ($compliances as $compliance) :
                                        $compliance_subtitle = $compliance['business_compliance_subtitle'];
                                        $compliance_loop = $compliance['business_compliance_file_loop'];
                            ?>
                            <div class="business-item">
                                <h4 class="acor-menu"><?php echo $compliance_subtitle; ?></h4>
                                <div class="business-item__content row acor-menu-child">
                                    <div class="business-materials">
                                        <?php
                                            foreach($compliance_loop as $c_file) :
                                                $compliance_title = $c_file['business_compliance_title_new'];
                                                $compliance_file = $c_file['business_compliance_file_new'];
                                                $compliance_etc = $c_file['business_compliance_etc_new'];
                                        ?>
                                        <div class="business-item__content__detail">
                                            <div class="business-item__content__detail__btn bg-white">
                                                <a class="target-link" href="<?php echo $compliance_file ;?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '<?php echo $compliance_subtitle.' '.$compliance_title; ?>','value': '1'})">
                                                    <button class="link-btn">
                                                        <p class="mb-0"><?php echo $compliance_title; ?></p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.264 14.609">
                                                        <g transform="translate(-23.574)">
                                                            <path d="M59.775,4.89H56.4V0H51.276V4.89H47.9l5.937,7.2Z" transform="translate(-23.632)"/>
                                                            <rect width="13.264" height="2.058" transform="translate(23.574 12.551)"/>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                            <?php if ($compliance_etc) : ?>
                                                <p class="mt-3 mb-0 etctr"><?php echo $compliance_etc; ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div><!-- プライムビジネス資料 -->
                    <?php
                        $ws_acor = CFS()->get('ws_acor');
                        if($_SESSION['member_info']['nextlv_num'] >= 2 || $_SESSION['member_info']['sub_title'] >= 2 || $_SESSION['member_info']['member_id'] == '000000000000'):
                    ?>
                        <div id="ws" class="page-content-div">
                            <h3 class="<?php if ($ws_acor == 1) { echo 'acor-menu'; } ?>">WS（ウィナーズ）関連資料</h3>
                            <div class="container content-wrap <?php if ($ws_acor == 1) { echo 'acor-menu-child'; } ?>">
                                <div class="business-item">
                                    <h4>WS資料</h4>
                                    <div class="business-support row">
                                        <div class="business-item__content">
                                            <div class="business-item__content__detail">
                                                <?php
                                                    // $maintenance = '';
                                                    // $disabled = '';
                                                    // $maintenance_text = '';
                                                    // $today_date = new DateTime('now');
                                                    // $maintenance_start = new DateTime('2022-10-11 10:00:00');
                                                    // $maintenance_end = new DateTime('2022-10-11 16:59:59');

                                                    // if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
                                                    //     $maintenance = 'now-maintenance';
                                                    //     $disabled = 'disabled';
                                                    //     $maintenance_text = '<span class="business-maintenance">10月11日 AM10:00〜PM6:00まで<br>メンテナンス中</span>';
                                                    // }
                                                ?>
                                                <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                                                <button class="<?php echo $cls; ?> link-btn loading-parent <?php //echo $maintenance; ?>" data-name="ws_file" data-type="get-info" <?php //echo $disabled; ?>>
                                                    <p class="mb-0">WS資料</p>
                                                    <?php //echo $maintenance_text; ?>
                                                </button>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
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
                                        <?php if($business_ws_file_text_new): ?>
                                            <p class="mb-0 d-sm-none etctr"><?php echo $business_ws_file_text_new; ?></p>
                                        <?php endif; ?>
                                        <div class="business-item__content">
                                            <div class="business-item__content__detail">
                                                <a class="target-link" href="<?php echo CFS()->get('business_ws_tejun_new');?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'ウィナーズ（WS）関連資料 ご利用手順','value': '1'})">
                                                    <button class="link-btn">
                                                        <p class="mb-0">ご利用手順</p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                        <g transform="translate(-0.11)">
                                                            <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                            <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($business_ws_file_text_new): ?>
                                        <p class="mt-3 mb-0 d-none d-sm-block etctr"><?php echo $business_ws_file_text_new; ?></p>
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
                                                    if ($index == 3) {
                                                        echo '<div class="d-flex flex-column-reverse w-100">';
                                                        echo '<div class="text-center font-smaller d-inline-block border-bottom border-dark py-1 pl-3 pr-5 acor-menu my-3 mx-auto">すべて表示</div>';
                                                        echo '<div class="acor-menu-child"><div class="d-flex flex-wrap">';
                                                    }
                                                ?>
                                                    <div class="business-item__content">
                                                        <div class="business-item__content__detail">
                                                            <a class="target-link" href="<?php echo $bs['business_ws_promote_file_new'];?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '<?php echo $b['business_ws_promote_title_new'].' '.$bs['business_ws_promote__title_new'];?>','value': '1'})">
                                                                <button class="link-btn">
                                                                    <p class="mb-0"><?php echo $bs['business_ws_promote__title_new'];?></p>
                                                                </button>
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                                    <g transform="translate(-0.11)">
                                                                        <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                                        <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                                    </g>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <?php if($bs['business_ws_promote_file_caption_new']): ?>
                                                            <p class="mt-3 mb-0"><?php echo $bs['business_ws_promote_file_caption_new'];?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php
                                                    if ($index >= 3 && $index == $count) {
                                                        echo '</div></div></div>';
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
                            <h3 class="<?php if ($pb_acor == 1) { echo 'acor-menu'; } ?>">PB試験関連</h3>
                            <div class="container content-wrap <?php if ($pb_acor == 1) { echo 'acor-menu-child'; } ?>">
                                <div class="row">
                                    <?php if($deficient_popup){ $cls=$deficient_popup; }else{ $cls='get-info';}?>
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <a class="target-link <?php echo $cls; ?>" data-name="pb_exam" data-type="get-info" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': 'PB資格認定書','value': '1'})">
                                                <button class="link-btn">
                                                    <p class="mb-0">PB資格認定書</p>
                                                </button>
                                                <svg class="dl-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13.264 14.609">
                                                    <g transform="translate(-23.574)">
                                                        <path d="M59.775,4.89H56.4V0H51.276V4.89H47.9l5.937,7.2Z" transform="translate(-23.632)"/>
                                                        <rect width="13.264" height="2.058" transform="translate(23.574 12.551)"/>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div> 
                                    </div>
                                    <?php if ($pb_exam_text_new) : ?>
                                    <div class="page-content">
                                        <div class="page-content__detail">
                                            <a class="target-link" href="<?php echo $pb_exam_text_new; ?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '試験問題集','value': '1'})">
                                                <button class="link-btn">
                                                    <p class="mb-0">試験問題集</p>
                                                </button>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                    <g transform="translate(-0.11)">
                                                        <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                        <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if( CFS()->get('pb_exam_tejun_new')):?>
                                        <div class="page-content">
                                            <div class="page-content__detail">
                                                <a class="target-link" href="<?php echo CFS()->get('pb_exam_tejun_new');?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '受験の手順','value': '1'})">
                                                    <button class="link-btn">
                                                        <p class="mb-0">受験の手順</p>
                                                    </button>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                        <g transform="translate(8176.361 -1665.095)">
                                                            <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                            <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
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
                                <h3 class="<?php if ($free_acor == 1) { echo 'acor-menu'; } ?>"><?php echo $business_free_title_new;?></h3>
                                <div class="container content-wrap <?php if ($free_acor == 1) { echo 'acor-menu-child'; } ?>">
                                    <div>
                                        <div class="row">
                                            <?php
                                                $business_free_banner_loop_new = $b['business_free_banner_loop_new'];
                                                foreach ( $business_free_banner_loop_new as $bb ) :
                                                    $banner_url_new = $bb['business_free_banner_url_new'];
                                                    $banner_title_new = $bb['business_free_banner_title_new'];
                                                    $banner_img_new = $bb['business_free_banner_img_new'];
                                            ?>
                                                <div class="page-content">
                                                    <div class="page-content__detail">
                                                        <a class="target-link" href="<?php echo $banner_url_new; ?>" target="_blank" onclick="gtag('event', 'click', {'event_category': 'link','event_label': '<?php echo $business_free_title_new.' '.$banner_title_new;?>','value': '1'})">
                                                            <button class="link-btn">
                                                                <img src="<?php echo $banner_img_new; ?>" alt="<?php echo $banner_title_new; ?>">
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="row">
                                            <?php
                                                $business_free_file_loop_new = $b['business_free_file_loop_new'];
                                                foreach ( $business_free_file_loop_new as $bf ) :
                                                    $business_free_file_title_new = $bf['business_free_file_title_new'];
                                            ?>
                                                <div class="page-content">
                                                    <div class="page-content__detail">
                                                        <a class="target-link" href="<?php echo $bf['business_free_file_upload_new'];?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '<?php echo $business_free_title_new.' '.$business_free_file_title_new; ?>','value': '1'})">
                                                            <button class="link-btn">
                                                                <p class="mb-0"><?php echo $business_free_file_title_new;?></p>
                                                            </button>
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                                <g transform="translate(-0.11)">
                                                                    <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                                    <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php if($b['business_free_sub_loop_new']):?>
                                            <div class="business-item free-sub mt-4">
                                                <?php
                                                    foreach ( $b['business_free_sub_loop_new'] as $bs ):
                                                        $business_free_sub_title_new = $bs['business_free_sub_title_new'];
                                                ?>
                                                    <h4><?php echo $business_free_sub_title_new; ?></h4>
                                                    <div class="row">
                                                        <?php
                                                            foreach ( $bs['business_free_sub_file_loop_new'] as $bs ):
                                                                $business_free_sub_file_title_new = $bs['business_free_sub_file_title_new'];
                                                        ?>
                                                            <div class="business-item__content">
                                                                <div class="business-item__content__inner">
                                                                    <div class="business-item__content__detail">
                                                                        <a class="target-link" href="<?php echo $bs['business_free_sub_file_upload_new'];?>" target="_blank" onclick="gtag('event', 'download', {'event_category': 'pdf','event_label': '<?php echo $business_free_title_new.' '.$business_free_sub_title_new.' '.$business_free_sub_file_title_new; ?>','value': '1'})">
                                                                            <button class="link-btn">
                                                                                <p class="mb-0"><?php echo $business_free_sub_file_title_new; ?></p>
                                                                            </button>
                                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                                                <g transform="translate(-0.11)">
                                                                                    <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                                                    <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                                                </g>
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <?php if($bs['business_free_sub_file_caption_new']): ?>
                                                                    <p class="mt-3 mb-0 etctr"><?php echo $bs['business_free_sub_file_caption_new'];?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach;?>
                                                    </div>
                                                <?php endforeach;?>
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
    </div>
</div>