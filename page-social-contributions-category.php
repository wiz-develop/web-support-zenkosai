<?php
/*
 * Template Name: 社会貢献活動詳細
 */

get_header();

get_header();
$t = get_term_by('slug', $_GET['csr_cat'], 'csr_cat');
console_log($t);

// $today_date = new DateTime('now');
// $new_style_start = new DateTime('2022-04-01 00:00:00');
// $style_type = false;
// if ($new_style_start <= $today_date) {
//     $style_type = true;
// }

// if ($style_type == true || $_GET['disp_key'] == '202204') :
?>
<div id="new-csr">
    <div id="page-csr-category" class="csr csr-category whole-page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <div class="page-header">
            <div class="container">
                <div class="section breadSection">
                    <div class="container">
                        <div class="row">
                            <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                                <li id="panHome" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/">
                                        <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                    </a>
                                </li>
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/social-contribution/">
                                        <span itemprop="name">社会貢献活動</span>
                                    </a>
                                </li>
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <span itemprop="name"><?php echo $t->name;?></span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="csr-cat-content">
            <div class="csr-description container-fluid bg-descript mt-5 mb-2 p-3">
                <div class="container">
                    <h3 class="mb-3"><?php echo $t->name; ?></h3>
                </div>
            </div>
            <div class="csr-description container">
                <div class="csr-cat-wrapper">
                    <div class="csr-page_about">
                        <?php
                            $new_csr_contents = get_field('new_csr_contents', $t); //新
                            $csr_contents = get_field('csr_contents', $t); //旧
                            if ($new_csr_contents) {
                                echo $new_csr_contents;
                            } else {
                                echo $csr_contents;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php        
                $txt_limit = 1000;
                if( $display_type == 'sp'){
                    $txt_limit = 500;
                }
                $t_id = $t->term_id;
                // 投稿の表示条件設定
                $arg = array(
                    'posts_per_page' => 3,
                    'post_type'      => 'social-contribution',  // カスタム投稿タイプ名
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'csr_cat',  // カスタムタクソノミー名
                            'field'    => 'id',  // ターム名を term_id,slug,name のどれで指定するか
                            'terms'    => $t_id // タクソノミーに属するターム名
                        )
                    ),
                );
                $posts = get_posts($arg);
            ?>
            <div class="page-content-div csr-newslist">
                <div class="csr-news container pt-3 pb-0 pb-md-3">
                    <h3 class="mb-3"><span class="csr-title"><?php the_field('update_info_title', $t); ?></span></h3>
                        <div class="news-wrapper my-0 my-md-3">
                        <?php
                            if ($posts) :
                            $days = 7; // New を表示させたい期間の日数
                            $today = strtotime(wp_date('Y-m-d'));

                            foreach ($posts as $post): setup_postdata( $post );
                                $is_hidden = CFS()->get('csr_info_nologin', $post->ID);
                                if ( !empty($is_hidden) && !is_user_loggedin() ) {
                                    continue; 
                                }
                                
                                $remove_array = ["\r\n", "\r", "\n", " ", "　"];
                                $content = wp_trim_words(strip_shortcodes(get_the_content()), $txt_limit, '…' );
                                $content = str_replace($remove_array, '', $content);

                                $entry = get_post_time();
                                $total = wp_date($today - $entry) / 86400;
                        ?>
                        <div class="news-div">
                            <a href="<?php the_permalink(); ?>">
                                <div class="news-innerdiv">
                                    <div class="content-wrapper">
                                        <div class="news-detail">
                                            <div class="news-txt">
                                                <?php
                                                    if ($days > $total) {
                                                        echo '<div class="new-label"><span>NEW</span></div>';
                                                    }
                                                ?>
                                                <div class="mb-0 news-date col-12 px-0">
                                                    <?php the_time('Y.m.d') ?><span>更新</span>
                                                </div>
                                                <div class="news-title">
                                                    <p class="mb-0 news-cat-txt bold"><?php the_title(); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                                endforeach;
                            else :
                        ?>
                        <p class="mb-0">投稿記事はありません。</p>
                        <?php endif; ?>
                    </div>
                    <?php if ($posts) :
                        // 「もっと見る」リンクの組み立て
                        //   ・サポートプロジェクト個別カテゴリー（storks/victorina/epic-exe/sdd/glion-arena/marathon）
                        //     から来た場合のみ、活動一覧側で対応タグを初期選択させるため
                        //     csr_cat=csr-activities&from=スラッグ の形式にする
                        //   ・その他のカテゴリー（ボランティア活動・まごころ募金 等）は従来通り
                        //     csr_cat=自スラッグ で活動一覧に遷移（旧仕様の「これまでの活動報告」表示）
                        $sp_target_slugs = ['storks', 'victorina', 'epic-exe', 'sdd', 'glion-arena', 'marathon'];
                        $current_t_slug  = isset($t->slug) ? $t->slug : '';
                        if ( in_array($current_t_slug, $sp_target_slugs, true) ) {
                            $more_url = '/social-contributions/category/activities/?csr_cat=csr-activities&from=' . rawurlencode($current_t_slug);
                        } else {
                            // 親ページ（csr-activities）自身、およびサポートプロジェクト外のカテゴリーは従来通り
                            $more_url = '/social-contributions/category/activities/?csr_cat=' . rawurlencode($current_t_slug);
                        }
                    ?>
                    <div class="activities-link">
                        <a href="<?php echo esc_url($more_url); ?>">
                            <div class="activities-link__name">
                                もっと見る
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ここから -->
            <?php
                $new_csr_contents01 = get_field('new_csr_contents01', $t); //新
                $csr_contents01 = get_field('csr_contents01', $t); //旧
                if ($new_csr_contents01 || $csr_contents01) :
            ?>
                <div class="page-content-div csr-detail">
                    <!-- 自由編集(最大3つまで) -->
                    <?php for($i = 1; $i <= 3; $i++){ ?>
                        <?php
                            $title = get_field('new_csr_title0'.$i, $t);
                            if (!$title) {
                                $title = get_field('csr_title0'.$i, $t);
                            }

                            $contents = get_field('new_csr_contents0'.$i, $t);
                            if (!$contents) {
                                $contents = get_field('csr_contents0'.$i, $t);
                            }

                            if ($title && $contents) :
                        ?>
                        <div class="csr-free-contants container py-3 mt-3">
                            <!-- カスタムフィールド：自由編集のタイトル -->
                            <h3 class="mb-3">
                                <span class="csr-title"><?php echo $title; ?></span>
                            </h3>
                            <div class="csr-free-wrapper">
                                <?php
                                    $url = $_SERVER['REQUEST_URI'];
                                    if(strstr($url,'?csr_cat=fund-raising')==true):
                                ?>
                                    <?php $front_page_id = get_option('page_on_front'); ?>
                                    <div class="charity-amount text-center">
                                        <p class="mb-0 charity-amount-txt">現在のまごころ募金総額</p>
                                        <p class="mb-0 charity-amount-number"><span class="donation-amount font-weight-bold"><?php echo CFS()->get('home_magokoro_amount', $front_page_id); ?></span>円</p>
                                        <p class="mb-0 charity-update">（<?php echo date('Y年m月d日', strtotime(CFS()->get('home_magokoro_update', $front_page_id))); ?> 現在）</p>
                                    </div>
                                <?php endif; ?>
                                <!-- カスタムフィールド：自由編集の内容が入ってくる -->
                                <p><?php echo $contents; ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php } ?>
                    <?php
                        $csr_linktitle = get_field('new_csr_linktitle', $t); //新
                        if (!$csr_linktitle) {
                            $csr_linktitle = get_field('csr_linktitle', $t); //旧
                        }

                        $csr_linkcontents = get_field('new_csr_linkcontents', $t); //新
                        if (!$csr_linkcontents) {
                            $csr_linkcontents = get_field('csr_linkcontents', $t); //旧
                        }

                        if ($csr_linktitle && $csr_linkcontents) :
                    ?>
                    <div class="csr-free-contants container py-3 mt-3">
                        <!-- 外部リンク用 -->
                        <h3 class="mb-3">
                            <span class="csr-title"><?php echo $csr_linktitle; ?></span>
                        </h3>
                        <div class="csr-free-wrapper">
                            <?php echo $csr_linkcontents; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php
                $current_cat = isset($_GET['csr_cat']) ? $_GET['csr_cat'] : '';
                if ( $current_cat === 'csr-activities' ) :
                    $target_page_id = get_queried_object_id();
                    $fields = CFS()->get('support_pro_list', $target_page_id);
                    if ( !empty($fields) && is_array($fields) ) :
            ?>
            <div class="page-content-innerwrap social-contribution_menu container-fluid social-contribution-list mt-5">
                <div class="page-content-div py-0">
                    <div class="container sp-page_link">
                        <div class="csr-tit page-link_list w-100 acor-menu opened">
                            <h2 class="w-100">サポートプロジェクトをご紹介</h2>
                        </div>
                        <div class="acor-menu-child opened acor-menu-child__no-bottom" style="display: block;">
                            <div class="content-body row">
                                <?php
                                    foreach ($fields as $field) :
                                ?>
                                <a href="#<?php echo $field['support_pro_page_link']; ?>" class="content-body__item col-6 col-lg-3 col-md-4">
                                    <p class="mb-0 d-flex align-items-center justify-content-between w-100">
                                        <span class="d-block"><?php echo $field['support_pro_tit']; ?></span>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </p>
                                </a>
                                <?php
                                    endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="csr-free-contents support-project_list container py-3 mt-3">
                <div class="row">
                    <?php
                        foreach ($fields as $field) :
                    ?>
                    <div id="<?php echo $field['support_pro_page_link']; ?>" class="content-body__item col-12 col-lg-6 col-md-6 mb-5">
                        <a href="<?php echo $field['support_pro_bnr_link']; ?>" class="content-body__item__list__bnr d-block gtm-click-link" data-gtm-click="サポートプロジェクトトップページ <?php echo $field['support_pro_tit']; ?>バナー">
                            <h3 class="acor-subtit"><?php echo $field['support_pro_tit']; ?></h3>
                            <div class="content-body__item__about row justify-content-between h-100">
                                <div class="support-icon col-4 pr-0">
                                    <img src="<?php echo $field['support_pro_bnr']; ?>" alt="<?php echo $field['support_pro_tit']; ?>">
                                </div>  
                                <div class="content-body__item__list__about__detail col-8">
                                    <?php if($field['support_pro_about']):?>
                                    <p class="mb-0"><?php echo $field['support_pro_about']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                        endforeach;
                    ?>
                </div>
            </div>
            <?php
                    endif; // !empty($fields) の終わり
                endif; // $target_page の終わり
            ?>
            <?php get_template_part('templates/csr-nav-new');?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<script>
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