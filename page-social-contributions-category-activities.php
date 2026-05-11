<?php
/*
 * Template Name: 社会貢献活動ー活動一覧
 */
get_header(); ?>

<?php
/*------------------------------------------------------------------
 * 社会貢献活動 - 活動一覧
 *
 * ◆対象ページ判定
 *   - 「サポートプロジェクト」関連カテゴリーから来た時のみ、新機能を有効化する
 *     対象スラッグ: csr-activities / storks / victorina / epic-exe /
 *                   sdd / glion-arena / marathon
 *   - 上記以外（例: ボランティア活動・まごころ募金など）は従来通りの
 *     「これまでの活動報告」ページとして表示する（検索UI・戻りリンクなし）
 *
 * ◆新機能（サポートプロジェクト対象ページのみ）
 *   - ページタイトル「サポートプロジェクトの活動報告」
 *   - support_pro タグの複数選択フィルター（サイド）
 *   - カテゴリーページからの遷移時に対応タグで初期選択 + 戻りリンク
 *   - 検索結果件数表示
 *
 * ◆DB負荷対策
 *   - WP_Query は本ページで 2 回のみ
 *      1) 一覧用：paged + posts_per_page=10
 *      2) アーカイブ年集計用：'fields'=>'ids' で ID のみ取得し YEAR() を 1 クエリで集計
 *------------------------------------------------------------------*/

// ----- サポートプロジェクト対象スラッグ -----
$support_project_slugs = [
    'csr-activities',
    'storks',
    'victorina',
    'epic-exe',
    'sdd',
    'glion-arena',
    'marathon',
];

// 親カテゴリ取得（現在の csr_cat）
$current_slug   = isset($_GET['csr_cat']) ? sanitize_key($_GET['csr_cat']) : '';
$parent_term    = $current_slug ? get_term_by('slug', $current_slug, 'csr_cat') : null;
$t              = $parent_term; // 既存変数名を維持（後方互換）
$parent_term_id = $parent_term ? (int) $parent_term->term_id : 0;

// 子ページ（カテゴリー）からの遷移
$from_slug = isset($_GET['from']) ? sanitize_key($_GET['from']) : '';
$from_term = $from_slug ? get_term_by('slug', $from_slug, 'csr_cat') : null;

// 対象ページ判定（csr_cat または from がサポートプロジェクト一覧に含まれているか）
$is_support_project_page = in_array($current_slug, $support_project_slugs, true)
    || in_array($from_slug,    $support_project_slugs, true);

// ----- ここから「サポートプロジェクト対象ページ」専用の準備処理 -----
$support_pro_taxonomy = 'support_pro';
$support_pro_order    = [
    'storks',
    'victorina',
    'epic-exe',
    'sdd',
    'glion-arena',
    'marathon',
    'others',
];

$support_projects = []; // slug => label（対象ページ時のみ使用）
$selected_slugs   = [];
$is_initial_from  = false;
$is_filtered      = false;

if ( $is_support_project_page ) {
    // support_pro タグの一覧を取得
    //   ※ social-contribution 投稿（公開済み）に1件でも紐付いているタグのみ表示する
    //   未使用タグはフィルターに出さない（運用者がタグを作っただけ＆未使用＝表示する意味がない）
    //
    //   ※ 旧実装で csr-activities カテゴリーまで限定したJOINにしていたが、
    //     カテゴリー階層・付与運用次第で拾えないケースがあるため、
    //     post_type='social-contribution' と post_status='publish' のみで判定する
    $sp_terms = [];
    if ( taxonomy_exists($support_pro_taxonomy) ) {
        global $wpdb;
        $sql = $wpdb->prepare(
            "SELECT DISTINCT t.term_id, t.name, t.slug
             FROM {$wpdb->terms} t
             INNER JOIN {$wpdb->term_taxonomy} tt ON tt.term_id = t.term_id
             INNER JOIN {$wpdb->term_relationships} tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
             INNER JOIN {$wpdb->posts} p ON p.ID = tr.object_id
             WHERE tt.taxonomy = %s
               AND p.post_type = %s
               AND p.post_status = %s",
            $support_pro_taxonomy,
            'social-contribution',
            'publish'
        );
        $rows = $wpdb->get_results($sql);
        if ( $rows ) {
            foreach ( $rows as $row ) {
                $sp_terms[ $row->slug ] = (object) [
                    'term_id' => (int) $row->term_id,
                    'name'    => $row->name,
                    'slug'    => $row->slug,
                ];
            }
        }
    }
    // 表示順を依頼資料の順番で固定。未指定スラッグは末尾に名前順で。
    foreach ( $support_pro_order as $slug ) {
        if ( isset($sp_terms[ $slug ]) ) {
            $support_projects[ $slug ] = $sp_terms[ $slug ]->name;
        }
    }
    $rest_terms = array_diff_key($sp_terms, $support_projects);
    if ( ! empty($rest_terms) ) {
        uasort($rest_terms, function($a, $b){
            return strnatcasecmp($a->name, $b->name);
        });
        foreach ( $rest_terms as $slug => $term ) {
            $support_projects[ $slug ] = $term->name;
        }
    }

    // 選択中タグ
    if ( isset($_GET['sp']) ) {
        $raw = (array) $_GET['sp'];
        foreach ( $raw as $s ) {
            $s = sanitize_key($s);
            if ( $s !== '' && isset($support_projects[$s]) ) {
                $selected_slugs[] = $s;
            }
        }
        $selected_slugs = array_values(array_unique($selected_slugs));
    }

    // カテゴリーページ遷移時の初期選択（sp[] 未指定時のみ）
    if ( empty($selected_slugs) ) {
        if ( $current_slug && $current_slug !== 'csr-activities' && isset($support_projects[$current_slug]) ) {
            $selected_slugs  = [ $current_slug ];
            $is_initial_from = true;
        }
        elseif ( $from_slug && isset($support_projects[$from_slug]) ) {
            $selected_slugs  = [ $from_slug ];
            $is_initial_from = true;
        }
    }
    $is_filtered = ! empty($_GET['sp']) || $is_initial_from;
}

// 年・月別表示（既存仕様を維持）
$date = [];
if ( ! empty($_GET['anu']) ) {
    $date[0]['year']  = (int) $_GET['anu'];
}
if ( ! empty($_GET['mont']) ) {
    $date[0]['month'] = (int) $_GET['mont'];
}

$paged = max(1, (int) get_query_var('paged'));

// ----- tax_query 構築 -----
$tax_query = [];

if ( $is_support_project_page ) {
    // サポートプロジェクト対象ページ
    //   ・親 csr_cat=csr-activities 配下に固定（既存運用を踏襲）
    //   ・選択 support_pro タグが指定されていれば AND で絞る
    $activities_root_term = get_term_by('slug', 'csr-activities', 'csr_cat');
    $activities_root_id   = $activities_root_term ? (int) $activities_root_term->term_id : 0;

    $tax_query = [ 'relation' => 'AND' ];

    if ( $activities_root_id ) {
        $tax_query[] = [
            'taxonomy' => 'csr_cat',
            'field'    => 'term_id',
            'terms'    => $activities_root_id,
        ];
    } elseif ( $parent_term_id ) {
        $tax_query[] = [
            'taxonomy' => 'csr_cat',
            'field'    => 'term_id',
            'terms'    => $parent_term_id,
        ];
    }
    if ( ! empty($selected_slugs) && taxonomy_exists($support_pro_taxonomy) ) {
        $tax_query[] = [
            'taxonomy' => $support_pro_taxonomy,
            'field'    => 'slug',
            'terms'    => $selected_slugs,
            'operator' => 'IN',
        ];
    }
} else {
    // 対象外ページ：旧仕様通りに csr_cat だけで絞る
    if ( $parent_term_id ) {
        $tax_query[] = [
            'taxonomy' => 'csr_cat',
            'field'    => 'term_id',
            'terms'    => $parent_term_id,
        ];
    }
}

// 一覧用クエリ
$list_args = [
    'paged'          => $paged,
    'posts_per_page' => 10,
    'post_type'      => 'social-contribution',
    'tax_query'      => $tax_query,
    'date_query'     => $date,
    'no_found_rows'  => false,
];
$list_query  = new WP_Query( $list_args );
$total_found = (int) $list_query->found_posts;

// 表示文字数制限用
$txt_limit = 300;
if ( $display_type == 'sp' ) {
    $txt_limit = 300;
}

// 戻りリンク用ラベル（対象ページのみ）
$back_label = '';
$back_url   = '';
if ( $is_support_project_page ) {
    if ( $from_term && $from_term->slug !== 'csr-activities' ) {
        $back_label = $from_term->name;
        $back_url   = '/social-contributions/category/?csr_cat=' . rawurlencode($from_term->slug);
    } elseif ( $parent_term && $parent_term->slug !== 'csr-activities' ) {
        $back_label = $parent_term->name;
        $back_url   = '/social-contributions/category/?csr_cat=' . rawurlencode($parent_term->slug);
    }
}

// 検索フォームを送る時の csr_cat / from（対象ページのみ）
$form_csr_cat = $current_slug ? $current_slug : 'csr-activities';
$form_from    = $from_slug ? $from_slug : ( ( $parent_term && $parent_term->slug !== 'csr-activities' ) ? $parent_term->slug : '' );

// 表示用：ページタイトル
$page_title = $is_support_project_page ? 'サポートプロジェクトの活動報告' : 'これまでの活動報告';
// パンくず最下層
$breadcrumb_last = $page_title;
?>
<div id="new-csr">
    <div class="csr csr-category csr-activities-index page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/social-contribution/">
                                        <span itemprop="name">社会貢献活動</span>
                                    </a>
                                </li>
                                <?php if ( $is_support_project_page && $back_label && $back_url ) : ?>
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="<?php echo esc_url($back_url); ?>">
                                        <span itemprop="name"><?php echo esc_html($back_label); ?></span>
                                    </a>
                                </li>
                                <?php elseif ( $parent_term ) : ?>
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/social-contributions/category/?csr_cat=<?php echo esc_attr($parent_term->slug); ?>">
                                        <span itemprop="name"><?php echo esc_html($parent_term->name); ?></span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <li>
                                    <span><?php echo esc_html($breadcrumb_last); ?></span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
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
                            <h1 class="mb-0">
                                <span>
                                    <?php if ( $is_support_project_page ) : ?>
                                        サポートプロジェクトの活動報告
                                    <?php else : ?>
                                        <?php echo get_the_title(); ?>
                                    <?php endif; ?>
                                </span>
                            </h1>
                </div>
            </div>
        </div>
        <div class="page-content-div csr-newslist">
            <div class="csr-news container d-block">

                <?php if ( $is_support_project_page && $back_label && $back_url ) : ?>
                <!-- 子ページからの遷移：戻りリンク -->
                <div class="csr-back-link mb-3">
                    <a href="<?php echo esc_url($back_url); ?>" class="csr-back-link__btn">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span><?php echo esc_html($back_label); ?>のページに戻る</span>
                    </a>
                </div>
                <?php endif; ?>

                <div class="row">
                    <div class="article-list col-12 col-md-9">

                        <?php if ( $is_support_project_page && $is_filtered ) :
                            $selected_labels = [];
                            foreach ( $selected_slugs as $s ) {
                                if ( isset($support_projects[$s]) ) {
                                    $selected_labels[] = $support_projects[$s];
                                }
                            }
                            $clear_url_qs = [ 'csr_cat' => $form_csr_cat ];
                            if ( $form_from ) { $clear_url_qs['from'] = $form_from; }
                            $clear_url = '?' . http_build_query($clear_url_qs);
                        ?>
                        <!-- 検索結果バー -->
                        <div class="csr-search-result mb-3">
                            <p class="csr-search-result__lead mb-1">
                                <span class="csr-search-result__label">検索結果</span>
                                <span class="csr-search-result__count"><strong><?php echo number_format($total_found); ?></strong> 件</span>
                            </p>
                            <?php if ( ! empty($selected_labels) ) : ?>
                            <p class="csr-search-result__terms mb-0">
                                <span class="csr-search-result__terms-label">絞り込み条件：</span>
                                <?php foreach ( $selected_labels as $label ) : ?>
                                    <span class="csr-search-result__tag"><?php echo esc_html($label); ?></span>
                                <?php endforeach; ?>
                                <a class="csr-search-result__clear" href="<?php echo esc_url($clear_url); ?>">条件をクリア</a>
                            </p>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <div class="container-fluid">
                            <div class="row news-wrapper mb-4">
                                <?php if ( $list_query->have_posts() ) :
                                    while ( $list_query->have_posts() ) : $list_query->the_post();
                                        $is_hidden = CFS()->get('csr_info_nologin', get_the_ID());
                                        if ( ! empty($is_hidden) && ! is_user_loggedin() ) {
                                            continue;
                                        }
                                        $remove_array = ["\r\n", "\r", "\n", " ", "　"];
                                        $content = wp_trim_words(strip_shortcodes(get_the_content()), $txt_limit, '…' );
                                        $content = str_replace($remove_array, '', $content);
                                ?>
                                    <div class="news-div w-100">
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="news-innerdiv">
                                                <div class="content-wrapper csr-activities">
                                                    <div class="news-detail">
                                                            <div class="news-title">
                                                                <p class="mb-0 news-cat-txt bold"><?php the_title(); ?></p>
                                                            </div>
                                                            <div class="article-detail">
                                                                <?php if(has_post_thumbnail()){
                                                                    echo '<div class="article-img">';
                                                                    the_post_thumbnail(array( 200, 150 ),array( 'class' => 'mx-auto' ));
                                                                    echo'</div>';
                                                                }?>
                                                                <div class="news-txt">
                                                                    <div class="news-txtinnerbox">
                                                                        <p class="mb-0 news-content"><?php echo $content; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="news-link mx-auto text-center mt-2">
                                                        <div class="news-more">
                                                            <div class="news-txt_bg"></div>
                                                                <button class="news-btn">
                                                                    <p class="mb-0">続きを読む</p>
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                    endwhile;
                                else :
                                ?>
                                    <p class="col-12 col-md-10">
                                        <?php
                                        if ( $is_support_project_page && $is_filtered ) {
                                            echo '該当する活動報告はありませんでした。条件を変えてお試しください。';
                                        } else {
                                            echo '投稿記事はありません。';
                                        }
                                        ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="pnavi mt-3">
                            <?php
                            if ( $list_query->max_num_pages > 1 ) {
                                $base_url = remove_query_arg('paged');
                                echo paginate_links([
                                    'base'      => add_query_arg('paged', '%#%', $base_url),
                                    'format'    => '',
                                    'current'   => $paged,
                                    'mid_size'  => 2,
                                    'total'     => $list_query->max_num_pages,
                                    'prev_text' => '<',
                                    'next_text' => '>',
                                    'type'      => 'list',
                                ]);
                            }
                            ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    </div>

                    <!-- サイドメニュー：検索 + アーカイブ -->
                    <div class="archive-list col-12 col-md-3">

                        <?php if ( $is_support_project_page && ! empty($support_projects) ) : ?>
                        <!-- 【新規】サポートプロジェクトの絞り込み（対象ページのみ） -->
                        <div class="csr-filter">
                            <form method="get" action="" class="csr-filter__form" id="csrFilterForm">
                                <input type="hidden" name="csr_cat" value="<?php echo esc_attr($form_csr_cat); ?>">
                                <?php if ( $form_from ) : ?>
                                    <input type="hidden" name="from" value="<?php echo esc_attr($form_from); ?>">
                                <?php endif; ?>

                                <div class="csr-filter__head">
                                    <p class="csr-filter__title mb-0">
                                        <span>活動報告を探す</span>
                                        <span class="csr-filter__note">※複数選択可</span>
                                    </p>
                                    <button type="button" class="csr-filter__toggle" aria-expanded="true" aria-controls="csrFilterBody">
                                        <i class="fa-solid fa-chevron-up"></i>
                                    </button>
                                </div>

                                <div class="csr-filter__body" id="csrFilterBody">
                                    <?php
                                        $sp_count       = count($support_projects);
                                        // 初期表示する件数（最大6件まで。それ以上はアコーディオン展開で表示）
                                        $visible_count  = 6;
                                        $hidden_count   = max(0, $sp_count - $visible_count);

                                        // 選択中のタグが隠しエリアに含まれているかを判定
                                        //   → 含まれていれば初期から「展開状態」にして、選択中タグが見えるようにする
                                        $is_initially_expanded = false;
                                        if ( $hidden_count > 0 && ! empty($selected_slugs) ) {
                                            $slugs_array = array_keys($support_projects);
                                            $hidden_slugs = array_slice($slugs_array, $visible_count);
                                            foreach ( $selected_slugs as $sel ) {
                                                if ( in_array($sel, $hidden_slugs, true) ) {
                                                    $is_initially_expanded = true;
                                                    break;
                                                }
                                            }
                                        }
                                        $i = 0;
                                    ?>
                                    <ul class="csr-filter__tags list-unstyled mt-0 mb-2 <?php echo $is_initially_expanded ? 'is-expanded' : ''; ?>" data-count="<?php echo (int) $sp_count; ?>" data-visible="<?php echo (int) $visible_count; ?>">
                                        <?php foreach ( $support_projects as $sp_slug => $sp_label ) :
                                            $is_checked = in_array($sp_slug, $selected_slugs, true);
                                            $is_hidden_tag = ( $i >= $visible_count );
                                            $i++;
                                        ?>
                                        <li class="csr-filter__tag-item <?php echo $is_hidden_tag ? 'is-hidden-tag' : ''; ?>">
                                            <label class="csr-filter__tag <?php echo $is_checked ? 'is-selected' : ''; ?>">
                                                <input type="checkbox" name="sp[]" value="<?php echo esc_attr($sp_slug); ?>" <?php checked($is_checked); ?>>
                                                <span><?php echo esc_html($sp_label); ?></span>
                                            </label>
                                        </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <?php if ( $hidden_count > 0 ) : ?>
                                    <button type="button" class="csr-filter__more-btn" aria-expanded="<?php echo $is_initially_expanded ? 'true' : 'false'; ?>" data-hidden-count="<?php echo (int) $hidden_count; ?>">
                                        <span class="csr-filter__more-text-collapsed">
                                            <i class="fa-solid fa-plus"></i>
                                            もっと見る <strong><?php echo (int) $hidden_count; ?></strong>
                                        </span>
                                        <span class="csr-filter__more-text-expanded">
                                            <i class="fa-solid fa-minus"></i>
                                            折りたたむ
                                        </span>
                                    </button>
                                    <?php endif; ?>
                                    <div class="csr-filter__actions">
                                        <button type="submit" class="csr-filter__submit">
                                            <span class="csr-filter__submit-text">この条件で<span class="csr-filter__submit-break"></span>絞り込む</span>
                                        </button>
                                        <?php
                                            $reset_qs = [ 'csr_cat' => $form_csr_cat ];
                                            if ( $form_from ) { $reset_qs['from'] = $form_from; }
                                            $reset_url = '?' . http_build_query($reset_qs);
                                        ?>
                                        <a href="<?php echo esc_url($reset_url); ?>" class="csr-filter__reset">条件をクリア</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php endif; ?>

                        <!-- アーカイブ年バナー -->
                        <div class="csr-posts-index px-md-0">
                            <div class="csr-posts-wrapper container px-0 pb-4 mx-auto">
                                <?php
                                // アーカイブ年集計用クエリ（IDのみ + 軽量化）
                                $archive_args = [
                                    'posts_per_page'         => -1,
                                    'post_type'              => 'social-contribution',
                                    'tax_query'              => $tax_query,
                                    'fields'                 => 'ids',
                                    'no_found_rows'          => true,
                                    'update_post_meta_cache' => false,
                                    'update_post_term_cache' => false,
                                ];
                                if ( ! is_user_loggedin() ) {
                                    $archive_args['meta_query'] = [
                                        'relation' => 'OR',
                                        [
                                            'key'     => 'csr_info_nologin',
                                            'compare' => 'NOT EXISTS',
                                        ],
                                        [
                                            'key'     => 'csr_info_nologin',
                                            'value'   => '',
                                            'compare' => '=',
                                        ],
                                        [
                                            'key'     => 'csr_info_nologin',
                                            'value'   => '0',
                                            'compare' => '=',
                                        ],
                                    ];
                                }
                                $archive_ids = get_posts($archive_args);

                                $years_with_posts = [];
                                if ( ! empty($archive_ids) ) {
                                    global $wpdb;
                                    $ids_str = implode(',', array_map('intval', $archive_ids));
                                    $rows = $wpdb->get_col(
                                        "SELECT DISTINCT YEAR(post_date) AS y
                                         FROM {$wpdb->posts}
                                         WHERE ID IN ({$ids_str})
                                           AND post_status = 'publish'
                                         ORDER BY y DESC"
                                    );
                                    foreach ( $rows as $y ) {
                                        $years_with_posts[] = (int) $y;
                                    }
                                }

                                // 年バナーリンクのベースクエリ
                                if ( $is_support_project_page ) {
                                    $base_qs = [ 'csr_cat' => $form_csr_cat ];
                                    if ( ! empty($selected_slugs) ) {
                                        $base_qs['sp'] = $selected_slugs;
                                    }
                                    if ( $form_from ) {
                                        $base_qs['from'] = $form_from;
                                    }
                                } else {
                                    // 旧仕様：csr_cat だけ維持
                                    $base_qs = [ 'csr_cat' => $current_slug ];
                                }

                                if ( ! empty($years_with_posts) ) :
                                    foreach ( $years_with_posts as $p_year ) :
                                        $year_qs  = array_merge($base_qs, ['anu' => $p_year]);
                                        $year_url = '/social-contributions/category/activities/?' . http_build_query($year_qs);
                                ?>
                                    <div class="year-link col-12 py-2 px-0 mt-0">
                                        <div class="arrow-btn posts-index bg-csr rounded-0 p-2">
                                            <a href="<?php echo esc_url($year_url); ?>">
                                                <p class="text-white mb-0 px-2"><?php echo esc_html($p_year); ?>年の更新<span></span></p>
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <div class="csr-posts-index-btn text-center">
                                        <?php
                                            if ( $is_support_project_page ) {
                                                $showall_qs = [ 'csr_cat' => $form_csr_cat ];
                                                if ( $form_from ) { $showall_qs['from'] = $form_from; }
                                            } else {
                                                $showall_qs = [ 'csr_cat' => $current_slug ];
                                            }
                                            $showall_url = '/social-contributions/category/activities/?' . http_build_query($showall_qs);
                                        ?>
                                        <button class="showall-btn" onclick="location.href='<?php echo esc_url($showall_url); ?>'">
                                            <p class="mb-0 pr-2">これまでの<br>活動報告一覧</p>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part('templates/csr-nav-new');?>
    </div>
</div>

<?php if ( $is_support_project_page ) : ?>
<script>
(function(){
    // タグの選択/解除のビジュアル切替
    var labels = document.querySelectorAll('.csr-filter__tag');
    labels.forEach(function(l){
        var input = l.querySelector('input[type="checkbox"]');
        if (!input) return;
        input.addEventListener('change', function(){
            if (input.checked) {
                l.classList.add('is-selected');
            } else {
                l.classList.remove('is-selected');
            }
        });
    });

    // 「あと○件のタグを見る」アコーディオン
    var moreBtn = document.querySelector('.csr-filter__more-btn');
    var tagsUl  = document.querySelector('.csr-filter__tags');
    if (moreBtn && tagsUl) {
        moreBtn.addEventListener('click', function(){
            var isExpanded = tagsUl.classList.toggle('is-expanded');
            moreBtn.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        });
    }

    // SPでフィルター本体の開閉
    var toggle = document.querySelector('.csr-filter__toggle');
    var body   = document.getElementById('csrFilterBody');
    if (toggle && body) {
        var setInit = function(){
            if (window.matchMedia('(max-width: 576px)').matches) {
                body.classList.add('is-closed');
                toggle.setAttribute('aria-expanded', 'false');
                var icon = toggle.querySelector('i');
                if (icon) {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            } else {
                body.classList.remove('is-closed');
                toggle.setAttribute('aria-expanded', 'true');
                var icon2 = toggle.querySelector('i');
                if (icon2) {
                    icon2.classList.add('fa-chevron-up');
                    icon2.classList.remove('fa-chevron-down');
                }
            }
        };
        setInit();
        window.addEventListener('resize', setInit);

        toggle.addEventListener('click', function(){
            var isClosed = body.classList.toggle('is-closed');
            toggle.setAttribute('aria-expanded', String(!isClosed));
            var icon = toggle.querySelector('i');
            if (icon) {
                icon.classList.toggle('fa-chevron-up', !isClosed);
                icon.classList.toggle('fa-chevron-down', isClosed);
            }
        });
    }
})();
</script>
<?php endif; ?>

<?php get_footer(); ?>
