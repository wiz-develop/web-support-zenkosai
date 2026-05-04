<?php
/*
 * Template Name: ライフサポートアーカイブ
 */
$prime_app_flg = '';
if ( isset($_POST['prime_app_flg']) ) {
    $prime_app_flg = sanitize_text_field( wp_unslash( $_POST['prime_app_flg'] ) );
} elseif ( isset($_GET['prime_app_flg']) ) {
    $prime_app_flg = sanitize_text_field( wp_unslash( $_GET['prime_app_flg'] ) );
}

$posts_unread = isset($posts_unread) && is_array($posts_unread) ? $posts_unread : [];

if ( $prime_app_flg ) {
    $member_id = isset($_POST['member_id']) ? sanitize_text_field( wp_unslash($_POST['member_id']) ) : '';
    $password  = isset($_POST['password'])  ? (string) wp_unslash($_POST['password']) : '';

    if ( $member_id === '' || $password === '' ) {
        wp_safe_redirect( home_url( '/' ) );
        exit;
    }

    $member_info = make_session_member_info( $_POST, $password );
    set_session_member_info( $member_info, $posts_unread );
}
get_header();

$page_data = get_page_by_path('lifesupport-list');
$page_id = $page_data->ID;
$loggedin = is_user_loggedin();
$css = $cfs->get( 'css', $page_id );
?>

<div id="archive-<?php echo $css; ?>" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
        <div class="page-top text-left">
            <div class="page-top__title">
                <div class="container">
                    <div class="page-top__title__icon">
                        <h1 class="mb-0 font-weight-bold">ライフサポートサービス</h1>
                    </div>
                </div>
            </div>
            <?php
                if (is_user_loggedin()) :
                $provider_arg = array(
                    'posts_per_page' => 1,
                    'no_found_rows'  => true,
                    'update_post_term_cache' => false,
                    'suppress_filters' => true,
                    'post_type' => array('information', 'provider-information'),
                    'meta_query' => array(
                        array(
                            'key' => 'provider_service',
                            'value' => '',
                            'compare' => '!=',
                        ),
                    ),
                    'date_query' => array(
                        array(
                            'after' => date("Y-m-d",strtotime("-1 month")),
                            'inclusive' => true,
                        ),
                    ),
                    'orderby' => 'date',
                    'post_status' => 'publish',
                );
                $provider_posts = new WP_Query($provider_arg);
            ?>
            <div class="info-content-wrap">
                <div class="container">
                    <section class="info-content bg-white position-relative py-3 mt-3">
                        <div class="lifesupport-info pr-5">
                            <h2 class="mb-0 pb-1 text-body">
                                <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/lifesupport/news-icon.png"></span>
                                サービス提供会社からのお知らせ
                            </h2>
                            <div class="lifesupport-info__list">
                                <?php
                                    if ( $provider_posts->have_posts() ) :
                                        while ( $provider_posts->have_posts() ) : $provider_posts->the_post();
                                            get_template_part( 'templates/provider-loop' );
                                        endwhile;
                                    else :
                                ?>
                                <p class="mb-0 text-body">現在、最新の情報はございません。</p>
                                <?php endif; wp_reset_postdata(); ?>
                            </div>
                            <div class="activities-link position-absolute">
                                <a href="/provider-info/">
                                    <div class="activities-link__name">
                                        <?php if ( $provider_posts->have_posts() ) : ?>
                                            もっと見る →
                                        <?php else : ?>
                                            過去のお知らせを見る →
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <?php endif; // is_user_loggedin() ?>
        </div>
    </div>
    <!-- page-header -->

    <div class="page-content-wrapper">
        <?php
            $service_terms = get_terms('lifesupport_cat', array('parent' => 0));

            // 文字数制限
            $txt_length = 40;
            $arg = array(
                'posts_per_page' => 16,
                'post_type'      => 'lifesupport',
                'no_found_rows'  => true,
                'update_post_term_cache' => false,
                'suppress_filters' => true,
                'orderby'        => 'meta_value_num',
                'meta_key'       => 'new_order',
                'order' => 'ASC',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'lifesupport_cat',
                        'field' => 'term_id',
                        'terms' => array(),
                    )
                ),
            );
            if (!($_SESSION['member_info'])) {
                $arg = array_merge($arg, array(
                    'meta_query' => array(
                        array(
                            'key'     =>'new_restriction_information',
                            'value'   => '1', //true,falseの1
                            'compare' => '!=',
                        ),
                    ),
                ),);
            }
        ?>   
        <div class="page-content-div">   
            <div class="container">
                <?php
                    if (is_user_loggedin()) :
                        $lifesupport_list_page = get_page_by_path('lifesupport-list');
                        $lifesupport_list_id = $lifesupport_list_page->ID;
                        $plusa_bnr = CFS()->get('plusa_bnr', $lifesupport_list_id);
                        $plusa_url = CFS()->get('plusa_url', $lifesupport_list_id);
                        $plusa_about = CFS()->get('plusa_about', $lifesupport_list_id);
                        $experiences_about = CFS()->get('experiences_about', $lifesupport_list_id);
                        $fields = CFS()->get('service_link_list', $lifesupport_list_id);
                        if ($fields) :
                ?>
                    <div class="ll-special-link row mt-4 mx-0">
                        <div class="ll-special-link__item mx-0 p-0">
                            <div class="service_link_list ll-special-link__item__about row mx-auto">
                            <?php
                                foreach ($fields as $field) :
                            ?>
                                <div class="service_link_list__item col-6">
                                    <a href="<?php echo $field['url']; ?>">
                                        <div class="service_link_list__item__img">
                                            <img class="w-100 rounded shadow-none" src="<?php echo $field['link_img']; ?>" />
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (is_user_loggedin()) :?>
                <div class="cat-list">
                    <div class="content-tit d-flex align-items-center w-100 pr-0 mb-2">
                        <svg class="content-tit__icon pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                            <g transform="translate(5801 -2402)">
                                <rect width="50" height="50" transform="translate(-5801 2402)" fill="none"/>
                                <path d="M18.467,34.378A5.275,5.275,0,1,1,9.515,28.8l-.326-.152,9.057-9.057L25.959,27.3a5.274,5.274,0,1,1-7.492,7.076ZM0,22.988a5.272,5.272,0,0,1,2.555-4.521A5.275,5.275,0,1,1,8.136,9.515l.152-.326,9.057,9.057L9.633,25.958A5.274,5.274,0,0,1,0,22.988Zm28.8,4.43-.152.327-9.057-9.057L27.3,10.976a5.274,5.274,0,1,1,7.076,7.49A5.275,5.275,0,1,1,28.8,27.418ZM10.976,9.633a5.274,5.274,0,1,1,7.49-7.076,5.275,5.275,0,1,1,8.951,5.579l.327.152-9.057,9.057Z" transform="translate(-5794.467 2408.533)"/>
                            </g>
                        </svg>
                        <p class="mb-0">ライフサポートサービス一覧</p>
                    </div>
                    <?php
                        foreach ($service_terms as $t):
                            // TODO:ログイン前非表示のものについては出さない
                            $restrict = get_term_meta($t->term_id, 's_display', true);
                            if (!$loggedin && $restrict) { continue; }
                            if ($t->slug == 'other') { continue; }

                            $afc = 'lifesupport_cat_'.$t->term_id;
                            $s_logo = get_field('s_logo', $afc);
                            $s_logo_img = $s_logo['url'];
                    ?>
                        <section id="<?php echo $t->slug; ?>" class="cat-list__content">
                            <div class="cat-list__content__header <?php if ($display_type == 'sp') { echo 'acor-menu'; } ?>">
                                <h2>
                                    <span class="cat-list__content__header__icon">
                                        <img src="<?php echo $s_logo_img; ?>" alt="<?php echo $t->name; ?>">
                                    </span>
                                    <?php echo $t->name; ?>
                                </h2>
                            </div>
                            <?php
                                $loggedin = is_user_loggedin(); 
                                $disp = isset($display_type) ? sanitize_key( (string) $display_type ) : 'pc';
                                $cache_key  = sprintf('ls_cat_%d_login_%d_disp_%s_v1', (int)$t->term_id, $loggedin ? 1 : 0, $disp);
                                $cached_html = get_transient($cache_key);

                                if ($cached_html !== false && $cached_html !== '') {
                                echo $cached_html;
                                } else {

                                $arg['tax_query'][0]['terms'] = $t->term_id;
                                $arg['update_post_meta_cache'] = true;

                                $posts = get_posts($arg);

                                ob_start();
                            ?>
                            <div class="cat-list__content__body row <?php if ($display_type == 'sp') { echo 'acor-menu-child'; } ?>">
                                <?php
                                    if($posts):
                                        foreach ($posts as $post): setup_postdata($post);

                                        // 霊園リストの場合非表示
                                        if($post->post_name == 'list'){
                                            continue;
                                        }

                                        // ログイン前非表示の場合
                                        $restrict = get_post_meta(get_the_ID(), 'restriction_information', true);
                                        if (!$loggedin && $restrict) { continue; }

                                        get_template_part('templates/lifesupport-loop');
                                ?>
                                    <?php endforeach; ?>
                                <?php endif;?>
                            </div>
                            <?php
                                $html = ob_get_clean();
                                if (trim($html) !== '') {
                                    set_transient($cache_key, $html, DAY_IN_SECONDS);
                                } else {
                                    delete_transient($cache_key);
                                }
                                echo $html;

                                wp_reset_postdata();
                                }
                            ?>
                        </section><!-- service-cat__wrap -->
                    <?php endforeach; ?>
                </div>
                <?php else : ?>
                <div class="cat-list no_login_service-list">
                    <div class="content-tit d-flex align-items-center w-100 pr-0">
                        <svg class="content-tit__icon pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
                            <g transform="translate(5801 -2402)">
                                <rect width="50" height="50" transform="translate(-5801 2402)" fill="none"/>
                                <path d="M18.467,34.378A5.275,5.275,0,1,1,9.515,28.8l-.326-.152,9.057-9.057L25.959,27.3a5.274,5.274,0,1,1-7.492,7.076ZM0,22.988a5.272,5.272,0,0,1,2.555-4.521A5.275,5.275,0,1,1,8.136,9.515l.152-.326,9.057,9.057L9.633,25.958A5.274,5.274,0,0,1,0,22.988Zm28.8,4.43-.152.327-9.057-9.057L27.3,10.976a5.274,5.274,0,1,1,7.076,7.49A5.275,5.275,0,1,1,28.8,27.418ZM10.976,9.633a5.274,5.274,0,1,1,7.49-7.076,5.275,5.275,0,1,1,8.951,5.579l.327.152-9.057,9.057Z" transform="translate(-5794.467 2408.533)"/>
                            </g>
                        </svg>
                        <p class="mb-0">カテゴリーメニュー</p>
                    </div>
                    <div class="llservice-nav d-flex flex-wrap mb-5">
                        <?php
                            foreach ($service_terms as $t):
                                $restrict = get_term_meta($t->term_id, 's_display', true);
                                if (!$loggedin && $restrict) { continue; }
                                if ($t->slug == 'other') { continue; }

                                $afc = 'lifesupport_cat_'.$t->term_id;
                                $s_logo = get_field('s_logo', $afc);
                                $s_logo_img = $s_logo['url'];
                        ?>
                        <div class="llservice-nav__item rounded">
                            <a href="#<?php echo $t->slug; ?>">
                                <div class="llservice-nav__item__name d-flex align-items-center">
                                    <div class="llservice-icon">
                                        <img src="<?php echo $s_logo_img; ?>" alt="<?php echo $t->name; ?>">
                                    </div>
                                    <span class="d-block pl-2"><?php echo $t->name; ?></span>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php
                        foreach ($service_terms as $t):
                            // TODO:ログイン前非表示のものについては出さない
                            $restrict = get_field('s_display', $t);
                            if (!$loggedin && $restrict) { continue; }
                            if ($t->slug == 'other') { continue; }

                            $afc = 'lifesupport_cat_'.$t->term_id;
                            $s_logo = get_field('s_logo', $afc);
                            $s_logo_img = $s_logo['url'];
                    ?>
                        <section id="<?php echo $t->slug; ?>" class="cat-list__content">
                            <div class="cat-list__content__header d-flex align-items-center">
                                <h2>
                                    <span class="cat-list__content__header__icon rounded-circle">
                                        <img src="<?php echo $s_logo_img; ?>" alt="<?php echo $t->name; ?>">
                                    </span>
                                    <?php echo $t->name; ?>
                                </h2>
                                <div class="llservice-detail_link ml-2 rounded-pill">
                                    <a href="/lifesupport_cat/<?php echo $t->slug; ?>/" class="px-2 py-1 d-inline-block">
                                        <span>詳細</span><i class="fas fa-solid fa-chevron-right pl-2"></i></i>
                                    </a>
                                </div>
                            </div>
                            <?php
                                $term_description = $t->description;
                                if ($term_description) :
                            ?>
                            <div class="cat-about px-3">
                                <?php echo $term_description; ?>
                            </div>
                            <?php
                                endif;
                                $loggedin = is_user_loggedin(); 
                                $disp = isset($display_type) ? sanitize_key( (string) $display_type ) : 'pc';
                                $cache_key  = sprintf('ls_cat_%d_login_%d_disp_%s_v1', (int)$t->term_id, $loggedin ? 1 : 0, $disp);
                                $cached_html = get_transient($cache_key);

                                if ($cached_html !== false && $cached_html !== '') {
                                echo $cached_html;
                                } else {

                                $arg['tax_query'][0]['terms'] = $t->term_id;
                                $arg['update_post_meta_cache'] = true;

                                $posts = get_posts($arg);

                                ob_start();
                            ?>
                            <div class="cat-list__content__body row rounded mt-3">
                                <?php
                                    if($posts):
                                        foreach ($posts as $post): setup_postdata($post);

                                        // 霊園リストの場合非表示
                                        if($post->post_name == 'list'){
                                            continue;
                                        }

                                        // ログイン前非表示の場合
                                        $restrict = get_post_meta(get_the_ID(), 'restriction_information', true);
                                        if (!$loggedin && $restrict) { continue; }

                                        get_template_part('templates/lifesupport-loop');
                                ?>
                                    <?php endforeach; ?>
                                <?php endif;?>
                            </div>
                            <?php
                                $html = ob_get_clean();
                                if (trim($html) !== '') {
                                    set_transient($cache_key, $html, DAY_IN_SECONDS);
                                } else {
                                    delete_transient($cache_key);
                                }
                                echo $html;

                                wp_reset_postdata();
                                }
                            ?>
                        </section><!-- service-cat__wrap -->
                    <?php endforeach; ?>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php
    // 検索
    if (wp_is_mobile()) {
        get_template_part('templates/searchform-lifesupport');
    }
    get_footer();
?>
<script>
jQuery(function ($) {
    // 表示文字数制限
    $('p.service-name').each(function () {
        if (window.matchMedia('(min-width: 992px) and (max-width: 1210px)').matches) {
            if ($(this).height() > 60) {
                let overtext = $(this).text();
                overtext = overtext.slice(0, -5) + '...';
                $(this).text(overtext);
            }
        }
    });

    const pathname = window.location.pathname;
    const isLifeSupportTop = pathname === "/lifesupport/";

    // アンカーリンククリック時に sessionStorage に保存して遷移
    $('a[href^="/lifesupport/#"]').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const hash = href.split('#')[1];
        const $target = $('#' + hash);

        // 現在のページが /lifesupport/ なら、ページ内移動で対応
        if (window.location.pathname === '/lifesupport/') {
            if ($target.length) {
                const headerHeight = $('.siteHeader').outerHeight() || 0;
                const isPC = window.innerWidth > 999;
                const isIpad = /iPad/.test(navigator.userAgent) || (navigator.userAgent.includes("Macintosh") && "ontouchend" in document);

                let offsetBase = 0;
                if (isPC) {
                    offsetBase = 100;
                } else {
                    offsetBase = 40;
                }

                let position = $target.offset().top - headerHeight - offsetBase;
                if (isPC) {
                    position += 80;
                } else if (isIpad) {
                    position += 200;
                } else {
                    position += 20;
                }

                $('html, body').stop().animate({ scrollTop: position }, 300);
            }

            history.replaceState(null, null, href); // ハッシュをURLに反映
        } else {
            // ページ移動ありの場合はセッションに保存して遷移
            sessionStorage.setItem('lifesupport_hash', hash);
            window.location.href = '/lifesupport/';
        }
    });

    $('.detail-button').on('click', function (e) {
        const $accordion = $(this).closest('.cat-list__content[id]');
        if (!$accordion.length) return;

        const hash = $accordion.attr('id');
        const scrollY = window.scrollY;

        sessionStorage.setItem('lifesupport_hash', hash);
        sessionStorage.setItem('lifesupport_scrollY', scrollY); // ← 位置を直接保存

        window.location.href = '/lifesupport/';
    });

    // ページ読み込み後、該当アコーディオンを開く
    $(window).on('load', function () {
        let hash = sessionStorage.getItem('lifesupport_hash') || location.hash.replace('#', '');

        if (!hash) return;

        const $target = $('#' + hash);
        if (!$target.length) return;

        // SP限定でアコーディオンを開く
        let accordionOpened = false;
        if ($('#archive-lifesupport.sp').length) {
            const $menu = $target.find('.acor-menu');
            const $body = $menu.next('.acor-menu-child');

            if ($menu.length && $body.length) {
                $menu.addClass("opened");
                $body.addClass("opened").css("display", "block");
                accordionOpened = true;
            }
        }

        const scrollAfterAccordion = () => {
            const savedY = parseInt(sessionStorage.getItem('lifesupport_scrollY'), 10);

            if (!isNaN(savedY)) {
                $('html, body').stop().animate({ scrollTop: savedY }, 0);
            } else {
                // fallback: 通常のスクロール調整
                const headerHeight = $('.siteHeader').outerHeight() || 0;
                const isPC = window.innerWidth > 999;
                const isIpad = /iPad/.test(navigator.userAgent) || (navigator.userAgent.includes("Macintosh") && "ontouchend" in document);

                // デバイス別のベースオフセット
                let offsetBase = 0;
                if (isPC) {
                    offsetBase = 100;
                } else {
                    offsetBase = 40;
                }

                let position = $target.offset().top - headerHeight - offsetBase;

                if (isPC) {
                    position += 80;
                } else if (isIpad) {
                    position += 200;
                } else {
                    position += 20;
                }

                $('html, body').stop().animate({ scrollTop: position }, 300);
            }

            sessionStorage.removeItem('lifesupport_hash');
            sessionStorage.removeItem('lifesupport_scrollY');
        };

        // アコーディオンが反映されるのを待ってスクロール
        if (accordionOpened) {
            setTimeout(scrollAfterAccordion, 50); // 50ms 待つ
        } else {
            scrollAfterAccordion();
        }
    });
});
</script>
