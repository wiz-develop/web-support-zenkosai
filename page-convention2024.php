<?php
/*
 * Template Name: 2024 コンベンション特設ページ
 */
get_header();
$css = CFS()->get('css');

/*
 * 出欠回答履歴の取得はDB負荷が高いため、P会員のみ実行する。
 * また同一リクエスト内で複数回呼ばれていたのを一度だけ取得し、以降は $answers_html を使い回す。
 */
$answers_html = '';
if ( isset($member_type) && $member_type === 'p_member' ) {
    $answers_html = cf7_member_answers_by_form( 'National Conventionチケットお申込みフォーム（確認画面）' );
}
?>

<div id="page-<?php echo $css; ?>" class="page-<?php echo $css; ?> <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/">
                                    <span itemprop="name">
                                        <i class="fa fa-home"></i> HOME
                                    </span>
                                </a>
                            </li>
                            <li>
                                <span>2026 National Convention</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top">
            <div class="page-top__icon">
                <h1 class="mb-0">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/convention/2024/page-tit.png" alt="2026 National Convention">
                </h1>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="page-nav">
            <div class="content-body container">
                <div class="page-nav__list row justify-content-start">
                    <div class="page-nav__list__item text-center">
                        <a href="#news">
                            <button class="rounded-pill">
                                <p class="mb-0 d-flex justify-content-between align-items-center"><span>インフォメーション</span><span class="pl-2"><i class="fas fa-solid fa-caret-down"></i></span></p>
                            </button>
                        </a>
                    </div>
                    <div class="page-nav__list__item text-center">
                        <a href="#schedule">
                            <button class="rounded-pill">
                                <p class="mb-0 d-flex justify-content-between align-items-center"><span>チケット表示</span><span class="pl-2"><i class="fas fa-solid fa-caret-down"></i></span></p>
                            </button>
                        </a>
                    </div>
                    <!-- <div class="page-nav__list__item text-center">
                        <a href="#ticket-application">
                            <button class="rounded-pill">
                                <p class="mb-0 d-flex justify-content-between align-items-center"><span>チケット申込み</span><span class="pl-2"><i class="fas fa-solid fa-caret-down"></i></span></p>
                            </button>
                        </a>
                    </div> -->
                    <?php if($member_type == 'p_member'): ?>
                    <div class="page-nav__list__item text-center">
                        <a href="#purchasing-info">
                            <button class="rounded-pill">
                                <p class="mb-0 d-flex justify-content-between align-items-center"><span>チケット購入情報</span><span class="pl-2"><i class="fas fa-solid fa-caret-down"></i></span></p>
                            </button>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php
                        if ( strpos( $answers_html, '<div class="cf7-member-answers">' ) !== false ) :
                    ?>
                    <div class="page-nav__list__item text-center">
                        <a href="#attendance">
                            <button class="rounded-pill">
                                <p class="mb-0 d-flex justify-content-between align-items-center"><span>出欠回答履歴</span><span class="pl-2"><i class="fas fa-solid fa-caret-down"></i></span></p>
                            </button>
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php
                        $fields = CFS()->get('menu_list');
                        foreach ($fields as $field) :
                    ?>
                    <div class="page-nav__list__item text-center">
                        <a href="#<?php echo $field['url']; ?>">
                            <button class="rounded-pill">
                                <p class="mb-0 d-flex justify-content-between align-items-center"><span><?php echo $field['name']; ?></span><span class="pl-2"><i class="fas fa-solid fa-caret-down"></i></span></p>
                            </button>
                        </a>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
        <section id="theme" class="content-theme mt-4 py-4">
            <?php the_content();?>
        </section>
        <section id="news" class="content-news py-2">
            <div class="bg-white py-4">
                <div class="content-body container">
                    <div class="info-convention">
                        <div class="info-convention__header d-flex justify-content-between align-items-center mb-3">
                            <h2 class="convention-tit"><span>インフォメーション</span></h2>
                            <div class="link-btn">
                                <a href="<?php echo home_url(); ?>/info-convention/">
                                    <button class="rounded-pill">一覧へ</button>
                                </a>
                            </div>
                        </div>
                        <?php
                            $args_service = array(
                                'posts_per_page' => 3,
                                'no_found_rows'  => true,
                                'post_type' => 'info-convention',
                            );
                            $posts_service = new WP_Query($args_service);
                            if ( $posts_service->have_posts() ) {
                                while ( $posts_service->have_posts() ) : $posts_service->the_post();
                                    include ( "templates/convention-loop.php" );
                                endwhile;
                                wp_reset_postdata();
                            } else {
                                echo '<p class="mx-auto py-3">現在投稿記事はありません。</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- <section id="ticket-application" class="content-attendance pt-5 border-0">
            <div class="content-body container">
                <h2 class="convention-tit mb-1"><span>チケット申込みはこちら</span></h2>
                <div class="content-body__item mb-4 mt-1 py-2 px-3 rounded" style="background-color: aliceblue;">
                    <?php echo CFS()->get('g_lion_about');?>
                    <div class="link-list">
                        <div class="link-list__item link-btn mb-2 col-12 col-lg-3">
                            <?php 
                            if ($deficient_popup) { 
                                $cls = $deficient_popup; 
                            } else { 
                                $cls = 'seminar_form';
                            }

                            $is_lion_checked = get_post_meta(get_the_ID(), 'is_lion_checked', true);
                            
                            if ( $is_lion_checked ) {
                                $bg_color       = '#cccccc';
                                $disabled_attr  = 'disabled';
                                $pointer_events = 'pointer-events: none;';
                                $box_shadow     = 'box-shadow: none;';
                            } else {
                                $bg_color       = '#fd4949';
                                $disabled_attr  = '';
                                $pointer_events = '';
                                $box_shadow     = '';
                            }
                            ?>
                            <button class="<?php echo esc_attr($cls); ?> rounded-pill w-100 gtm-click-link target-blank-trigger" 
                                    style="background-color: <?php echo esc_attr($bg_color); ?>; <?php echo esc_attr($pointer_events); ?> <?php echo esc_attr($box_shadow); ?>" 
                                    data-formid="submitMypage" 
                                    data-formabout="reserve_cnv" 
                                    data-gtm-click="ジーライオンアリーナ神戸会場チケット申込" 
                                    data-target-blank="true" 
                                    <?php echo $disabled_attr; ?>>
                                チケット申込みはこちら
                            </button>
                        </div>
                    </div>
                </div>
                <div class="content-body__item mt-1 py-2 px-3 rounded" style="background-color: #effcf4;">
                    <?php echo CFS()->get('kokusai_about');?>
                    <div class="link-list">
                        <div class="link-list__item link-btn mb-2 col-12 col-lg-3">
                        <?php 
                        if ($deficient_popup) { 
                            $cls = $deficient_popup; 
                        } else { 
                            $cls = 'seminar_form';
                        }

                        $is_kokusai_checked = get_field('is_kokusai_checked');
                        
                        if ( $is_kokusai_checked ) {
                            $bg_color       = '#cccccc';
                            $disabled_attr  = 'disabled';
                            $pointer_events = 'pointer-events: none;';
                            $box_shadow     = 'box-shadow: none;';
                        } else {
                            $bg_color       = '#fd4949';
                            $disabled_attr  = '';
                            $pointer_events = '';
                            $box_shadow     = '';
                        }
                        ?>
                        <button class="<?php echo esc_attr($cls); ?> rounded-pill w-100 gtm-click-link target-blank-trigger" 
                                style="background-color: <?php echo esc_attr($bg_color); ?>; <?php echo esc_attr($pointer_events); ?> <?php echo esc_attr($box_shadow); ?>" 
                                data-formid="submitMypage" 
                                data-formabout="reserve_cnv_pv" 
                                data-gtm-click="神戸国際会館 こくさいホール会場" 
                                data-target-blank="true" 
                                <?php echo $disabled_attr; ?>>
                            チケット申込みはこちら
                        </button>
                    </div>
                    </div>
                </div>
            </div>
        </section> -->
        <section id="schedule" class="content-schedule pt-5 border-0">
            <div class="content-body container">
                <h2 class="convention-tit"><span><?php echo CFS()->get('schedule_title'); ?></span></h2>
                <div class="content-body__item">
                    <div class="comment">
                        <p><?php echo CFS()->get('comment'); ?></p>
                    </div>
                    <!-- <div class="link-list">
                        <?php
                            $fields = CFS()->get('link_list');
                            foreach ($fields as $field) :
                        ?>
                        <div class="link-list__item link-btn mb-2 col-12 col-lg-3">
                            <a href="<?php echo $field['link_url']; ?>">
                                <button class="rounded-pill w-100" style="background-color: <?php echo $field['link_btn_bg']; ?>;">
                                    <?php echo $field['link_name']; ?>
                                </button>
                            </a>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                    <div class="calendar-img">
                        <img src="<?php echo CFS()->get('schedule_img'); ?>">
                    </div> -->

                    <?php if(CFS()->get('after_link_list') ): ?>
                    <!-- <div class="link-list mt-3">
                        <?php
                            $fields = CFS()->get('after_link_list');
                            foreach ($fields as $field) :
                        ?>
                        <div class="link-list__item link-btn mb-2 col-12 col-lg-3">
                            <a href="<?php echo $field['after_link_url']; ?>">
                                <button class="rounded-pill w-100" style="background-color: <?php echo $field['after_link_btn_bg']; ?>;">
                                    <?php echo $field['after_link_name']; ?>
                                </button>
                            </a>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div> -->
                    <?php endif;?>
                    <div class="link-list mt-3">
                        <div class="link-list__item link-btn mb-3 col-12 col-lg-4">
                            <a href="<?php echo home_url(); ?>/national-convention_2026/qr/">
                                <button class="rounded-pill w-100" style="background-color: <?php echo CFS()->get('ticket_btn_bg'); ?>;">
                                    <p class="mb-0 p-0 text-center" style="color: <?php echo CFS()->get('ticket_btn_text_color'); ?>;"><span class="pr-1"><?php echo CFS()->get('ticket_btn_name'); ?></span></p>
                                </button>
                            </a>
                        </div>
                        <?php
                            $sale_link_list = CFS()->get('sale_link_list');
                            if($sale_link_list):
                                foreach ($sale_link_list as $sale_link) :
                        ?>
                            <div class="link-list__item link-btn mb-3 col-12 col-lg-4">
                                <a href="<?php echo $sale_link['sale_link_url']; ?>" target="_blank">
                                    <button class="rounded-pill w-100" style="background-color: <?php echo $sale_link['sale_link_btn_bg']; ?>;">
                                        <p class="mb-0 p-0 text-center" style="color: <?php echo $sale_link['sale_link_text_color']; ?>;"><span class="pr-1"><?php echo $sale_link['sale_link_name']; ?></span><i class="fas fa-arrow-alt-circle-down fa-rotate-270 p-0"></i></p>
                                    </button>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="content-body__item">
                    <?php if(CFS()->get('after_link_list') ): ?>
                    <div class="link-list mt-3">
                        <?php
                            $fields = CFS()->get('after_link_list');
                            foreach ($fields as $field) :
                        ?>
                        <div class="link-list__item link-btn mb-3 col-12 col-lg-4">
                            <a href="<?php echo $field['after_link_url']; ?>">
                                <button class="rounded-pill w-100" style="background-color: <?php echo $field['after_link_btn_bg']; ?>;">
                                    <p class="mb-0 p-0 text-center" style="color: white;"><?php echo $field['after_link_name']; ?></p>
                                </button>
                            </a>
                        </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </section>
        <?php if($member_type == 'p_member'): ?>
        <section id="purchasing-info" class="content-attendance pt-5 border-0">
            <div class="content-body container">
                <h2 class="convention-tit mb-1"><span>チケット購入情報</span></h2>
                <div class="content-body__item">
                    <p class="mb-0">ボタンからは以下の手続きが可能です。</p>
                    <ul class="mt-0">
                        <li class="mb-0">申込内容の確認​</li>
                        <li class="mb-0">チケット領収書の確認​</li>
                    </ul>
                    <div class="link-list">
                        <div class="link-list__item link-btn mb-2 col-12 col-lg-3">
                            <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'seminar_form';}?>
                            <button class="<?php echo $cls; ?> rounded-pill w-100 gtm-click-link target-blank-trigger" style="background-color: #fd4949;" data-formid="submitMypage" data-formabout="reservation" data-gtm-click="コンベンションチケット購入情報確認" data-target-blank="true">
                                セミナー申込一覧ページへ
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <?php
            // 上部で取得済みの $answers_html をそのまま使い回す（同一リクエスト内のSQL重複を解消）
            if ( strpos( $answers_html, '<div class="cf7-member-answers">' ) !== false ) :
        ?>
        <section id="attendance" class="content-attendance py-5">
            <div class="content-body container mb-5">
                <h2 class="convention-tit mb-1"><span>ご招待出欠の回答</span></h2>
                <p class="mb-3">※最新のものが適用されます。</p>
                <div class="content-body__item">
                    <?php echo $answers_html; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <section id="faq" class="content-faq py-5">
            <div class="content-body container">
                <h2 class="convention-tit"><span>よくあるご質問</span></h2>
                <div class="faq-list">
                    <?php
                        $fields = CFS()->get('faq_list');
                        foreach ($fields as $field) :
                    ?>
                    <div class="faq-list__content">
                        <div class="acor-menu">
                            <p class="mb-0">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/convention/2024/q-icon.png">
                                <?php echo $field['question']; ?>
                            </p>
                        </div>
                        <div class="acor-menu-child">
                            <div class="answer">
                                <p class="mb-0">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/convention/2024/a-icon.png">
                                    <?php echo $field['answer']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php if(CFS()->get('campaign') ): ?>
        <section id="info" class="content-info py-5">
            <div class="content-body container">
                <h2 class="convention-tit"><span><?php echo CFS()->get('campaign_tit'); ?></span></h2>
                <div class="info-about">
                    <?php echo CFS()->get('campaign'); ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
