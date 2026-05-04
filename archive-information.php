<?php
/*
 * Template Name: インフォメーション一覧
 */
if ($_POST['prime_app_flg']) {
    if (!$_POST['member_id'] || !$_POST['password']) {
        wp_redirect(home_url('/'));
        exit;
    }
    $member_info = make_session_member_info($_POST, $_POST['password']);
    if (!isset($posts_unread) || !is_array($posts_unread)) {
        $posts_unread = [];
    }
    if (!isset($_SESSION['is_unread']) || !is_array($_SESSION['is_unread']) || count($_SESSION['is_unread']) === 0) {
    // セッション未設定／空なら従来通りセット
    set_session_member_info($member_info, $posts_unread);
    } else {
        // 既にセッションに未読がある場合はマージして上書きを避ける
        $_SESSION['is_unread'] = array_values(array_unique(array_merge($_SESSION['is_unread'], (array)$posts_unread)));

        // 追加: セッションに残る未読IDは公開済のみとする（draft等を除外）
        $_SESSION['is_unread'] = array_values(array_filter($_SESSION['is_unread'], function($id) {
            return get_post_status($id) === 'publish';
        }));
    }
}
get_header();

$loggedin = isset($_SESSION['member_info']);

// ページ・クエリ情報
$page_data = get_page_by_path('info-list');
$page_id = $page_data->ID;
$display_type = isset($display_type) ? $display_type : '';
$login = isset($login) ? $login : '';
$member_type = isset($member_type) ? $member_type : '';
$current_tab = isset($_GET['tab']) && $_GET['tab'] === 'unread' ? 'unread' : 'all';
$txt_limit = ($display_type === 'sp') ? 50 : 100;
$t = get_term_by('slug', $_GET['cate'], 'news');
$n_slug = $t ? $t->slug : '';
$date = [];
if (isset($_GET['anu'])) $date[0]['year'] = (int)$_GET['anu'];
if (isset($_GET['mont'])) $date[0]['month'] = (int)$_GET['mont'];
$paged = isset($_GET['paged']) ? (int)$_GET['paged'] : 1;

// WP_Query条件
$arg = [
    'paged' => $paged,
    'posts_per_page' => 10,
    'post_type' => ['information', 'social-contribution'],
    'date_query' => $date,
    'post_status' => 'publish',
];
if ($current_tab === 'unread' && !empty($_SESSION['is_unread'])) {
    $arg['post__in'] = $_SESSION['is_unread'];
}

$current_tab = isset($_GET['tab']) && $_GET['tab'] === 'unread' ? 'unread' : 'all';
$txt_limit = ($display_type === 'sp') ? 50 : 100;
$t = get_term_by('slug', $_GET['cate'], 'news');
$n_slug = $t ? $t->slug : '';
$date = [];
if ($_GET['anu']) $date[0]['year'] = (int)$_GET['anu'];
if ($_GET['mont']) $date[0]['month'] = (int)$_GET['mont'];
$paged = (int) get_query_var('paged');
$arg = [
'paged' => $paged,
'posts_per_page' => 10,
'post_type' => ['information', 'social-contribution'],
'date_query' => $date,
'post_status' => 'publish',
];


if ($current_tab === 'unread' && !empty($_SESSION['is_unread'])) {
$arg['post__in'] = $_SESSION['is_unread'];
}

// カテゴリが設定されている時だけの処理
if ($n_slug === 'csr') {
    // 社会貢献カテゴリーの場合
    $arg['tax_query'] = array(
        'relation' => 'OR',
        array(
            'taxonomy' => 'news',
            'field'    => 'slug',
            'terms'    => 'csr',
        ),
        array(
            'taxonomy' => 'csr_cat',
            'field'    => 'slug',
            'terms'    => 'csr-topics',
        ),
    );

    $arg['meta_query'] = array(
        'relation' => 'AND',
        array(
            'relation' => 'OR',
            array(
                'key'     => 'display_information',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => 'display_information',
                'value'   => '1',
                'compare' => '=',
            ),
        ),
    );

    if (!($_SESSION['member_info'])) {
        $arg['meta_query'][] = array(
            'relation' => 'OR',
            array(
                'key'     => 'csr_info_nologin',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => 'csr_info_nologin',
                'value'   => '0',
                'compare' => '=',
            ),
        );
    }
} else {
    // 通常カテゴリ
    if ($n_slug) {
        $arg['tax_query'][] = array(
            'taxonomy' => 'news',
            'field'    => 'slug',
            'terms'    => $n_slug,
        );
    }

    $arg['meta_query'][] = array(
        'relation' => 'OR',
        array(
            'key'     => 'display_information',
            'compare' => 'NOT EXISTS',
        ),
        array(
            'key'     => 'display_information',
            'value'   => '1',
            'compare' => '=',
        ),
    );

    // 重要・更新情報カテゴリの特別処理
    if ($_GET['cate'] == 'important' || $_GET['cate'] == 'update') {
        $arg['meta_key']     = $_GET['cate'] . '_information';
        $arg['meta_value']   = '1';
        $arg['meta_compare'] = '=';
    }

    // ログイン前の除外
    if (!($_SESSION['member_info'])) {
        $attatchment = get_term_by('slug', 'attatchment', 'news');
        $business    = get_term_by('slug', 'business', 'news');
        $campaign    = get_term_by('slug', 'campaign', 'news');

        $arg['tax_query'][] = array(
            'taxonomy' => 'news',
            'field'    => 'id',
            'terms'    => array($attatchment->term_id, $business->term_id, $campaign->term_id),
            'operator' => 'NOT IN',
        );

        $arg['meta_query'][] = array(
            'relation' => 'OR',
            array(
                'key'     => 'restriction_information',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => 'restriction_information',
                'value'   => '0',
                'compare' => '=',
            ),
        );
    }
}
// ログイン前は「送付物」、「ビジネス」、「キャンペーン」に関するお知らせを表示しない。
if (!($_SESSION['member_info']) && $n_slug !== 'csr') {  // ← csrならスキップ
    $attatchment = get_term_by('slug','attatchment','news');
    $attatchment_id = $attatchment->term_id;
    $business = get_term_by('slug','business','news');
    $business_id = $business->term_id;
    $campaign = get_term_by('slug','campaign','news');
    $campaign_id = $campaign->term_id;

    // もし、カテゴリが選択されていた場合
    $tax_number = 0;
    if ($n_slug) {
        $tax_number = 1;
    }
    $arg['tax_query'][$tax_number] = array(
        array(
            'taxonomy' => 'news',
            'field' => 'id',
            'terms' => array($attatchment_id, $business_id, $campaign_id),
            'operator' => 'NOT IN',
        ),
    );

    // ログイン前表示しないに設定されているものを表示しない
    $arg['meta_query'][3] = array(
        'relation' => 'OR',
        array(
            'key'     => 'restriction_information',
            'compare' => 'NOT EXISTS',
        ),
        array(
            'key'     => 'restriction_information',
            'value'   => '0',
            'compare' => '=',
        ),
    );
}


$the_query = new WP_Query($arg);

// ▼▼▼ AJAXリクエストなら記事リストのみ返す ▼▼▼
if (isset($_GET['ajax']) && $_GET['ajax'] == '1') {
    // 記事リストHTMLのみ出力
    if ($the_query->have_posts()) : ?>
        <div class="info-news-div my-1">
            <?php while ($the_query->have_posts()) : $the_query->the_post();
                // スキップ判定や各種変数定義
                $skip = false;
                if (get_post_type() === 'social-contribution') {
                    if (!$loggedin && CFS()->get('csr_info_nologin', get_the_ID())) { $skip = true; }
                }
                if ($skip) continue;

                $p_type = (get_post_type() === 'social-contribution') ? 'csr_cat' : 'news';
                $terms = get_the_terms(get_the_ID(), $p_type);
                $t = is_array($terms) && !empty($terms) ? $terms[0] : null;
                $cat_term = ($p_type === 'csr_cat') ? get_term_by('slug', 'csr', 'news') : $t;
                $logo = $cat_term ? get_field('n_logo', $cat_term) : null;
                $color = $cat_term ? get_field('n_color', $cat_term) : '';
                $cat_name = ($p_type === 'csr_cat') ? '社会貢献活動' : ($t ? $t->name : '');
                $title = mb_strimwidth(strip_tags(get_the_title()), 0, $txt_limit, '…', 'UTF-8');
                $important = CFS()->get('important_information') ? 'important-news' : '';
                $is_unread = (isset($_SESSION['is_unread']) && in_array(get_the_ID(), $_SESSION['is_unread'], true));
                $unread = $is_unread ? 'unread-news' : '';
                $is_read = !$is_unread;
            ?>
            <div class="info-item <?php echo $member_type; ?><?php echo $is_unread ? ' unread-news' : ''; ?>" data-id="<?php echo get_the_ID(); ?>" data-unread="<?php echo $is_unread ? '1' : '0'; ?>">
              <div class="info-news mx-0 mt-2 mb-1 border-0">
                <?php if ($is_unread): ?>
                    <span class="info-dot"></span>
                <?php endif; ?>
                <a href="<?php the_permalink(); ?>">
                  <div class="info-news-bar d-flex align-items-center">
                    <div class="news-cat d-flex align-items-center" style="background-color: <?php echo esc_attr($color); ?>">
                      <div class="cat-img-div">
                          <img src="<?php echo esc_url($logo['url'] ?? ''); ?>" alt="<?php echo esc_attr($cat_name); ?>" />
                      </div>
                      <p class="mb-0 news-cat-txt bold pl-2"><?php echo esc_html($cat_name); ?></p>
                    </div>
                    <div class="news-date ml-2"><?php the_time('Y/m/d'); ?></div>
                  </div>
                  <p class="mb-0 news-title pt-1">
                      <?php if ($important) echo '<span class="important rounded07 px-2 text-center text-white bg-danger mr-2">重要</span>'; ?>
                      <?php echo esc_html($title); ?>
                  </p>
                </a>
              </div>
              <div class="select-area <?php echo $member_type; ?>">
                <!-- 選択ボタンは初期非表示 -->
                <button class="select-btn btn btn-outline-primary btn-sm" style="display:none;">選択する</button>
                <!-- 既読ラベルは既読のみ、初期は非表示 -->
                <?php if ($login): ?>
                  <?php if ($is_read): ?>
                      <span class="read-label text-secondary" style="display:none;">既読</span>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
        <?php endwhile; ?>
        </div>
        <div class="pnavi mt-3">
            <?php
              // Replace the existing paginate_links call inside the AJAX response block with this:
              $big = 999999999;
              $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );

              // preserve currently active filters
              $add_args = array();
              if ( isset( $current_tab ) && $current_tab !== '' ) $add_args['tab'] = $current_tab;
              if ( isset( $_GET['cate'] ) && $_GET['cate'] !== '' ) $add_args['cate'] = $_GET['cate'];
              if ( isset( $_GET['anu'] ) && $_GET['anu'] !== '' ) $add_args['anu'] = $_GET['anu'];
              if ( isset( $_GET['mont'] ) && $_GET['mont'] !== '' ) $add_args['mont'] = $_GET['mont'];

              echo paginate_links( array(
                  'base'      => $base,
                  'format'    => '?paged=%#%',
                  'current'   => max( 1, intval( $paged ) ),
                  'total'     => intval( $the_query->max_num_pages ),
                  'prev_text' => '<',
                  'next_text' => '>',
                  'type'      => 'list',
                  'add_args'  => $add_args,
              ) );
            ?>
        </div>
    <?php else : ?>
        <p class="mx-auto py-3">現在未読の記事はありません</p>
    <?php endif;
    wp_reset_postdata();
    exit;
}
// ▲▲▲ AJAXここまで ▲▲▲
?>

<link href="https://fonts.googleapis.com/css2?family=BIZ+UDPGothic&display=swap" rel="stylesheet">
<div id="page-<?php echo CFS()->get('css', $page_id); ?>" class="page-wrapper page-<?php echo $cfs->get('css', $page_id); ?> <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
    <!-- ...（ヘッダー・パンくずなど省略せず現状通り） -->
    <div class="page-header">
        <div class="container">
            <?php
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
                <img src="<?php echo $cfs->get( 'header_image', $page_id); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get( 'header_image_sp', $page_id); ?>" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon', $page_id) ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get( 'title_icon', $page_id); ?>">
                    </div>
                <?php endif; ?>
                <h1 class="mb-0">インフォメーション一覧</h1>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper csr-newslist">
        <div class="csr-news container">
            <div class="row">
                <div class="article-list col-12 col-md-9">
                    <div class="row news-wrapper mb-4">
                        <div class="news-div col-12 col-md-11">
                            <?php if ($login): ?>
                            <!-- タブ -->
                            <div class="news-list_header d-flex justify-content-between <?php echo $member_type; ?>">
                              <div class="info-tabs mb-3 d-flex">
                                <button class="tab-btn active" data-tab="all">すべて</button>
                                <button class="tab-btn" data-tab="unread">未読</button>
                              </div>
                              <div class="info-action mb-3 d-flex">
                                  <button class="read-btn btn btn-primary rounded-pill mr-2">既読にする<i class="fa-classic fa-solid fa-circle-check pl-1"></i></button>
                                  <div class="select-all-btn" style="display:none;">
                                      <input type="checkbox" id="select-all-chk">
                                      <label for="select-all-chk">すべて選択</label>
                                  </div>
                              </div>
                            </div>
                            <?php endif; ?>

                            <!-- 記事リスト本体（AJAXで上書きする部分） -->
                            <div class="news-list" id="js-news-list">
                                <div class="info-news-div my-1">
                                <?php if ( $the_query->have_posts() ) : ?>
                                    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                                    <?php
                                        $skip = false;
                                        if (get_post_type() === 'social-contribution') {
                                            if (!$loggedin && CFS()->get('csr_info_nologin', get_the_ID())) { $skip = true; }
                                        }
                                        if ($skip) continue;

                                        $p_type = (get_post_type() === 'social-contribution') ? 'csr_cat' : 'news';
                                        $terms = get_the_terms(get_the_ID(), $p_type);
                                        $t = is_array($terms) && !empty($terms) ? $terms[0] : null;

                                        // タームが無い場合のガード
                                        $cat_term = ($p_type === 'csr_cat') ? get_term_by('slug', 'csr', 'news') : $t;
                                        $logo = $cat_term ? get_field('n_logo', $cat_term) : null;
                                        $color = $cat_term ? get_field('n_color', $cat_term) : '';
                                        $cat_name = ($p_type === 'csr_cat') ? '社会貢献活動' : ($t ? $t->name : '');
                                        $title = mb_strimwidth(strip_tags(get_the_title()), 0, $txt_limit, '…', 'UTF-8');

                                        $important = CFS()->get('important_information') ? 'important-news' : '';
                                        // ★ isset で未定義注意
                                        $is_unread = (isset($_SESSION['is_unread']) && in_array(get_the_ID(), $_SESSION['is_unread'], true));
                                        $unread = $is_unread ? 'unread-news' : '';
                                    ?>
                                    <div class="info-item <?php echo $member_type; ?><?php echo $is_unread ? ' unread-news' : ''; ?>" data-id="<?php echo get_the_ID(); ?>" data-unread="<?php echo $is_unread ? '1' : '0'; ?>">
                                      <div class="info-news mx-0 mt-2 mb-1 border-0">
                                        <?php if ($is_unread): ?>
                                            <span class="info-dot"></span>
                                        <?php endif; ?>
                                        <a href="<?php the_permalink(); ?>">
                                          <div class="info-news-bar d-flex align-items-center">
                                            <div class="news-cat d-flex align-items-center" style="background-color: <?php echo esc_attr($color); ?>">
                                              <div class="cat-img-div">
                                                  <img src="<?php echo esc_url($logo['url'] ?? ''); ?>" alt="<?php echo esc_attr($cat_name); ?>" />
                                              </div>
                                              <p class="mb-0 news-cat-txt bold pl-2"><?php echo esc_html($cat_name); ?></p>
                                            </div>
                                            <div class="news-date ml-2"><?php the_time('Y/m/d'); ?></div>
                                          </div>
                                          <p class="mb-0 news-title pt-1">
                                              <?php if ($important) echo '<span class="important rounded07 px-2 text-center text-white bg-danger mr-2">重要</span>'; ?>
                                              <?php echo esc_html($title); ?>
                                          </p>
                                        </a>
                                      </div>
                                      <div class="select-area <?php echo $member_type; ?>">
                                        <!-- 選択ボタンは初期非表示 -->
                                        <button class="select-btn btn btn-outline-primary btn-sm" style="display:none;">選択する</button>
                                        <!-- 既読ラベルは既読のみ、初期は非表示 -->
                                        <?php if ($login): ?>
                                          <?php if ($is_read): ?>
                                              <span class="read-label text-secondary" style="display:none;">既読</span>
                                          <?php endif; ?>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <p class="mx-auto py-3">現在未読の記事はありません。</p>
                                <?php endif; ?>
                                </div>
                                <div class="pnavi mt-3">
                                <?php
                                  // Replace the existing paginate_links call in the page body with this:
                                  $big = 999999999;
                                  $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );

                                  // preserve current GET parameters so filtered state is kept on links
                                  $add_args = array();
                                  if ( isset( $current_tab ) && $current_tab !== '' ) $add_args['tab'] = $current_tab;
                                  if ( isset( $_GET['cate'] ) && $_GET['cate'] !== '' ) $add_args['cate'] = $_GET['cate'];
                                  if ( isset( $_GET['anu'] ) && $_GET['anu'] !== '' ) $add_args['anu'] = $_GET['anu'];
                                  if ( isset( $_GET['mont'] ) && $_GET['mont'] !== '' ) $add_args['mont'] = $_GET['mont'];

                                  echo paginate_links( array(
                                      'base'      => $base,
                                      'format'    => '?paged=%#%',
                                      'current'   => max( 1, intval( $paged ) ),
                                      'total'     => intval( $the_query->max_num_pages ),
                                      'prev_text' => '<',
                                      'next_text' => '>',
                                      'type'      => 'list',
                                      'add_args'  => $add_args,
                                  ) );
                                ?>
                                </div>
                            </div>

                            <!-- 下部アクションバー -->
                            <div class="info-bottom-action fixed-bottom p-3 text-center <?php echo $member_type; ?>" style="display:none; z-index:100;">
                                <button class="action-btn btn btn-primary rounded-pill mr-2" id="all-read-btn" style="display:none;">すべて既読にする</button>
                                <button class="action-btn btn btn-primary rounded-pill mr-2" id="selected-read-btn" style="display:none;">選択記事を既読にする</button>
                                <button class="close-btn btn btn-outline-secondary rounded-pill" id="close-select-btn"><i class="fa-classic fa-solid fa-xmark pr-1"></i>閉じる</button>
                            </div>
                            <div class="info-popup <?php echo $member_type; ?>" style="display:none; position:fixed; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.3); z-index:999;">
                                <div class="popup-content bg-white rounded p-4 text-center" style="max-width:340px; margin:12vh auto;">
                                    <div>選択した記事をすべて既読にしますか？</div>
                                    <div class="popup-btns mt-3 d-flex justify-content-center gap-4">
                                        <button class="ok-btn btn btn-primary rounded-pill px-4">はい</button>
                                        <button class="cancel-btn btn btn-outline-secondary rounded-pill px-4">いいえ</button>
                                    </div>
                                </div>
                            </div>
                            <div class="info-toast" style="display:none; position:fixed; left:50%; top:37%; transform:translateX(-50%); background:#222; color:#fff; padding:1.2rem 2rem; border-radius:10px; font-size:1.1rem; z-index:1000;">
                                既読にしました
                            </div>
                        </div>
                    </div>
                </div>
                <?php get_template_part('templates/news-archive');?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
  let mode = 'normal'; // 'normal' or 'select'
  let tab = 'all';
  let selectedIds = new Set();
  const SELECTED_IDS_KEY = 'info_selected_ids';
  const ALL_UNREAD_IDS = <?php echo json_encode(array_map('strval', $_SESSION['is_unread'] ?? [])); ?>;
  // 要素取得
  const tabBtns = document.querySelectorAll('.tab-btn');
  const readBtn = document.querySelector('.read-btn');
  const selectAllDiv = document.querySelector('.select-all-btn');
  let selectAllChk = document.getElementById('select-all-chk');
  const bottomAction = document.querySelector('.info-bottom-action');
  const allReadBtn = document.getElementById('all-read-btn');
  const selectedReadBtn = document.getElementById('selected-read-btn');
  const closeSelectBtn = document.getElementById('close-select-btn');
  const popup = document.querySelector('.info-popup');
  const okBtn = popup.querySelector('.ok-btn');
  const cancelBtn = popup.querySelector('.cancel-btn');
  const toast = document.querySelector('.info-toast');
  const newsList = document.getElementById('js-news-list');
  const MEMBER_TYPE = '<?php echo esc_js($member_type); ?>';

  // === 処理中オーバーレイの定義（okBtn ハンドラの【前】に入れてください） ===
  (function () {
    // すでに定義済みなら何もしない
    if (window.showProcessingOverlay && window.hideProcessingOverlay) return;

    // overlay 要素を作る関数（1 回だけ）
    const overlay = document.createElement('div');
    overlay.id = 'info-processing-overlay';
    overlay.style.cssText = [
      'display:none',
      'position:fixed',
      'left:0',
      'top:0',
      'width:100%',
      'height:100%',
      'background:rgba(0,0,0,0.45)',
      'z-index:2000',
      'align-items:center',
      'justify-content:center'
    ].join(';');

    overlay.innerHTML = `
      <div style="background:transparent;color:#fff;text-align:center;">
        <div style="display:inline-block;background:#222;border-radius:10px;padding:1rem 1.4rem;min-width:240px;">
          <div class="processing-text" style="font-size:1rem;margin-bottom:0.6rem;">処理中です。しばらくお待ちください…</div>
          <div style="display:flex;align-items:center;justify-content:center;">
            <div style="width:28px;height:28px;border-radius:50%;border:4px solid rgba(255,255,255,0.2);border-top-color:#fff;animation:spin 1s linear infinite"></div>
          </div>
        </div>
      </div>
      <style>
        @keyframes spin { to { transform: rotate(360deg); } }
      </style>
    `;

    document.body.appendChild(overlay);

    // 内部：UI を無効化する処理（安全に要素を探して操作）
    function disableUiWhileProcessing() {
      // hide selection controls to avoid confusion
      const selDiv = document.querySelector('.select-all-btn');
      const bottom = document.querySelector('.info-bottom-action');
      const tabBtns = document.querySelectorAll('.tab-btn, .tab-button');
      if (selDiv) selDiv.style.display = 'none';
      if (bottom) bottom.style.display = 'none';
      // disable main action buttons if present
      ['.read-btn','#all-read-btn','#selected-read-btn','#close-select-btn','.select-all-btn'].forEach(s => {
        const el = document.querySelector(s);
        if (el) { el.disabled = true; el.classList && el.classList.add('disabled'); }
      });
      tabBtns && tabBtns.forEach(tb => { tb.disabled = true; tb.classList && tb.classList.add('disabled'); });
      // disable article links to prevent navigation
      document.querySelectorAll('.info-item a').forEach(a => { if (!a.dataset._href_backup) a.dataset._href_backup = a.href; a.href = 'javascript:void(0)'; });
    }

    function enableUiAfterProcessing() {
      const selDiv = document.querySelector('.select-all-btn');
      const bottom = document.querySelector('.info-bottom-action');
      const tabBtns = document.querySelectorAll('.tab-btn, .tab-button');
      if (selDiv) selDiv.style.display = '';
      if (bottom) bottom.style.display = '';
      ['.read-btn','#all-read-btn','#selected-read-btn','#close-select-btn','.select-all-btn'].forEach(s => {
        const el = document.querySelector(s);
        if (el) { el.disabled = false; el.classList && el.classList.remove('disabled'); }
      });
      tabBtns && tabBtns.forEach(tb => { tb.disabled = false; tb.classList && tb.classList.remove('disabled'); });
      document.querySelectorAll('.info-item a').forEach(a => { if (a.dataset._href_backup) { a.href = a.dataset._href_backup; delete a.dataset._href_backup; } });
    }

    // 外から呼べる関数を window に公開
    window.showProcessingOverlay = function (msg) {
      try {
        const txt = overlay.querySelector('.processing-text');
        if (txt && msg) txt.textContent = msg;
        overlay.style.display = 'flex';
        disableUiWhileProcessing();
      } catch (e) { console.error('showProcessingOverlay error', e); }
    };

    window.hideProcessingOverlay = function () {
      try {
        overlay.style.display = 'none';
        enableUiAfterProcessing();
      } catch (e) { console.error('hideProcessingOverlay error', e); }
    };
  })();

  function saveSelectedIds() {
    localStorage.setItem(SELECTED_IDS_KEY, JSON.stringify(Array.from(selectedIds)));
  }
  function loadSelectedIds() {
    const ids = localStorage.getItem(SELECTED_IDS_KEY);
    selectedIds = new Set(ids ? JSON.parse(ids) : []);
  }

  function bindSelectAll() {
    const existing = document.getElementById('select-all-chk');
    if (!existing) {
      selectAllChk = null;
      return;
    }
    // clone node to remove previous listeners safely
    const cloned = existing.cloneNode(true);
    existing.parentNode.replaceChild(cloned, existing);
    selectAllChk = cloned;
    selectAllChk.addEventListener('change', function () {
      selectedIds.clear();

      if (this.checked) {
        // ALL_UNREAD_IDS は PHP で埋め込まれている想定（全ページ分の未読ID）
        (ALL_UNREAD_IDS || []).forEach(id => selectedIds.add(String(id)));
        updateSelection();
        saveSelectedIds();
        updateBottomButtonsVisibility();
        setBackPopupIfNeeded();
      } else {
        // チェック解除時は選択解除して UI 更新
        updateSelection();
        saveSelectedIds();
        updateBottomButtonsVisibility();
        setBackPopupIfNeeded();
      }
    });
  }

  function initialize() {
    mode = 'normal';
    selectedIds.clear();
    saveSelectedIds();
    updateModeUI();
    setupTab();
    setupPaginationLinks();
    filterArticles();
    setupSelectButtons();
    updateSelection();

    // bottomAction と checkbox の安全な初期化
    if (bottomAction) {
      bottomAction.style.display = 'none';
      bottomAction.classList && bottomAction.classList.remove('show');
    }
    if (selectAllChk) {
      selectAllChk.checked = false;
    }

    // 下部ボタンの初期表示／disabled を明示的にクリア
    if (allReadBtn) {
      allReadBtn.style.display = 'none';
      allReadBtn.disabled = true;
      allReadBtn.classList && allReadBtn.classList.remove('disabled');
      allReadBtn.style.opacity = '';
    }
    if (selectedReadBtn) {
      selectedReadBtn.style.display = 'none';
      selectedReadBtn.disabled = true;
      selectedReadBtn.classList && selectedReadBtn.classList.remove('disabled');
      selectedReadBtn.style.opacity = '';
    }

    // 初期バインド（select-all checkbox を再バインドする関数があれば呼ぶ）
    if (typeof bindSelectAll === 'function') bindSelectAll();

    // 初期の下部ボタン表示状態を決定（念のため）
    if (typeof updateBottomButtonsVisibility === 'function') updateBottomButtonsVisibility();
  }

  function updateModeUI() {
    if (mode === 'select') {
      readBtn && (readBtn.style.display = 'none');
      selectAllDiv && (selectAllDiv.style.display = '');
    } else {
      readBtn && (readBtn.style.display = '');
      selectAllDiv && (selectAllDiv.style.display = 'none');
    }
  }

  function setupTab() {
    const params = new URLSearchParams(window.location.search);
    if (params.get('tab') === 'unread') {
      tab = 'unread';
      tabBtns.forEach(b => b.classList.remove('active'));
      document.querySelector('.tab-btn[data-tab="unread"]').classList.add('active');
    } else {
      tab = 'all';
      tabBtns.forEach(b => b.classList.remove('active'));
      document.querySelector('.tab-btn[data-tab="all"]').classList.add('active');
    }
  }

  tabBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      tab = btn.dataset.tab;
      tabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      fetchArticles(tab, 1);
    });
  });

  // ページネーションのリンククリック時にページトップへスクロール
  function setupPaginationLinks() {
  // remove previous handlers safely by cloning nodes (avoid duplicated handlers)
    document.querySelectorAll('.pnavi a').forEach(orig => {
      const a = orig.cloneNode(true);
      orig.parentNode.replaceChild(a, orig);
    });

    document.querySelectorAll('.pnavi a').forEach(a => {
      a.addEventListener('click', function(e) {
        e.preventDefault();

        // 1) まず href を取得（相対/絶対どちらでもOK）
        const href = a.getAttribute('href') || '';

        // 2) 試行的に paged を抽出するための順序：
        //   A. href の query string の paged
        //   B. href のパスに /page/(\d+)/ の形式
        //   C. data-paged 属性（サーバで追加できる場合の最短フォールバック）
        //   D. リンク内のテキスト（数字のみ）
        let nextPage = 1;

        try {
          const url = new URL(href, location.origin);
          const qPaged = url.searchParams.get('paged');
          if (qPaged && !isNaN(parseInt(qPaged))) {
            nextPage = parseInt(qPaged);
          } else {
            // パス内に /page/2/ の形式があるか
            const m = url.pathname.match(/\/page\/(\d+)\/?$/);
            if (m && m[1]) {
              nextPage = parseInt(m[1]);
            } else {
              // data-paged 属性
              if (a.dataset && a.dataset.paged && !isNaN(parseInt(a.dataset.paged))) {
                nextPage = parseInt(a.dataset.paged);
              } else {
                // 最後の手段：リンクテキスト（数字）を使う
                const txt = a.textContent && a.textContent.trim();
                const n = parseInt(txt, 10);
                if (!isNaN(n) && n > 0) nextPage = n;
              }
            }
          }
        } catch (err) {
          // URL parse に失敗したらフォールバック
          if (a.dataset && a.dataset.paged && !isNaN(parseInt(a.dataset.paged))) {
            nextPage = parseInt(a.dataset.paged);
          } else {
            const txt = a.textContent && a.textContent.trim();
            const n = parseInt(txt, 10);
            if (!isNaN(n) && n > 0) nextPage = n;
          }
        }

        // 最終的に fetchArticles に渡す
        fetchArticles(tab, nextPage);
        window.scrollTo({top: 0, behavior: "smooth"});
      });
    });
  }

  // --- AJAXで差し替えたDOMに member_type クラスを付与するユーティリティ ---
  function ensureMemberTypeClasses(rootContainer) {
    if (!MEMBER_TYPE) return;
    const root = rootContainer || document;
    root.querySelectorAll('.info-item').forEach(item => {
      // info-item 自体に MEMBER_TYPE が無ければ追加
      if (!item.classList.contains(MEMBER_TYPE)) {
        item.classList.add(MEMBER_TYPE);
      }
      // select-area にも付与
      const sel = item.querySelector('.select-area');
      if (sel && !sel.classList.contains(MEMBER_TYPE)) {
        sel.classList.add(MEMBER_TYPE);
      }
    });
  }

  function fetchArticles(tabParam, pagedParam) {
    return new Promise((resolve, reject) => {
      const tabToUse = tabParam || tab || 'all';
      const pagedToUse = pagedParam || 1;

      // show loader
      newsList.innerHTML = '<div class="loader py-5 text-center">読み込み中...</div>';

      const form = new FormData();
      form.append('action', 'get_info_list');
      form.append('tab', tabToUse);
      form.append('paged', String(pagedToUse));
      // これを送るとサーバ側で正しい一覧ページ URL を基準に paginate_links を作れる
      form.append('page_url', window.location.origin + window.location.pathname);

      // 現在の URL の GET パラメータを admin-ajax に渡す（cate / anu / mont など）
      try {
        const currentParams = new URLSearchParams(window.location.search || '');
        ['cate','anu','mont','tab'].forEach(k => {
          if (currentParams.has(k)) {
            form.append(k, currentParams.get(k));
          }
        });
        if (!form.has('cate')) {
          const m = location.href.match(/[?&]cate=([^&#]+)/);
          if (m && m[1]) form.append('cate', decodeURIComponent(m[1]));
        }

        if (typeof window.cate !== 'undefined' && window.cate !== null) {
          form.append('cate', String(window.cate));
        }
        if (typeof window.anu !== 'undefined' && window.anu !== null) {
          form.append('anu', String(window.anu));
        }
        if (typeof window.mont !== 'undefined' && window.mont !== null) {
          form.append('mont', String(window.mont));
        }

        // フォールバック：location.href から直接 cate を取得
        if (!form.has('cate')) {
          const m = location.href.match(/[?&]cate=([^&#]+)/);
          if (m && m[1]) form.append('cate', decodeURIComponent(m[1]));
        }
      } catch (e) {
        console.warn('Could not append current URL params to AJAX form', e);
      }

      fetch('<?php echo esc_js( admin_url("admin-ajax.php") ); ?>', {
        method: 'POST',
        credentials: 'same-origin',
        body: form
      })
      .then(res => res.text())
      .then(htmlText => {
        try {
          const parser = new DOMParser();
          const doc = parser.parseFromString(htmlText, 'text/html');
          const newList = doc.querySelector('.info-news-div');
          const newPnav = doc.querySelector('.pnavi');

          // ----- info-news-div 差し替え -----
          const existingList = newsList.querySelector('.info-news-div');
          if (newList) {
            if (existingList && existingList.parentNode) {
              existingList.parentNode.replaceChild(newList, existingList);
            } else {
              newsList.innerHTML = '';
              newsList.insertAdjacentElement('afterbegin', newList);
            }
            ensureMemberTypeClasses(newsList);
          } else {
            newsList.innerHTML = htmlText;
          }

          // ----- pnavi 差し替え -----
          const existingPnav = newsList.querySelector('.pnavi');
          if (newPnav) {
            if (existingPnav && existingPnav.parentNode) {
              existingPnav.parentNode.replaceChild(newPnav, existingPnav);
            } else {
              newsList.appendChild(newPnav);
            }
          } else {
            if (existingPnav && existingPnav.parentNode) existingPnav.parentNode.removeChild(existingPnav);
          }

          // 再バインド・状態復元
          setupPaginationLinks();
          loadSelectedIds();
          if (typeof bindSelectAll === 'function') bindSelectAll();

          if (selectAllChk && selectAllChk.checked) {
            getUnreadIds().forEach(id => selectedIds.add(id));
            saveSelectedIds();
          }

          setupSelectButtons();
          updateSelection();
          toggleBottomAction();
          updateModeUI();

          resolve();
        } catch (e) {
          console.error('fetchArticles parsing error', e);
          newsList.innerHTML = '<p class="py-5 text-center">一覧の読み込みに失敗しました。</p>';
          selectAllChk && (selectAllChk.checked = false);
          bottomAction.style.display = 'none';
          resolve();
        }
      })
      .catch(err => {
        console.error('fetchArticles error', err);
        newsList.innerHTML = '<p class="py-5 text-center">一覧の読み込みに失敗しました。</p>';
        selectAllChk && (selectAllChk.checked = false);
        bottomAction.style.display = 'none';
        resolve();
      })
      .finally(() => {
        const loader = newsList.querySelector('.loader');
        if (loader) loader.remove();
        setupPaginationLinks();
      });
    });
  }

  // 既存の updateBottomButtonsVisibility() を以下に丸ごと置き換えてください
  function updateBottomButtonsVisibility() {
    // 選択モードのときは下部バーを表示（タブで表示するボタンを切り替え）
    if (mode === 'select') {
      if (bottomAction) bottomAction.style.display = '';

      if (tab === 'all') {
        // 「すべて」タブ：すべて既読にするボタンを表示（未読が無ければ無効化）
        if (allReadBtn) {
          const unreadCount = getUnreadIds().length;
          allReadBtn.style.display = '';
          allReadBtn.disabled = (unreadCount === 0);
          allReadBtn.textContent = 'すべて既読にする';
          if (unreadCount === 0) {
            allReadBtn.classList && allReadBtn.classList.add('disabled');
            allReadBtn.style.opacity = '1';
          } else {
            allReadBtn.classList && allReadBtn.classList.remove('disabled');
            allReadBtn.style.opacity = '';
          }
        }
        // 選択記事ボタンは隠す＆無効にする（テキストは保持）
        if (selectedReadBtn) {
          selectedReadBtn.style.display = 'none';
          selectedReadBtn.disabled = true;
          selectedReadBtn.classList && selectedReadBtn.classList.remove('disabled');
          selectedReadBtn.style.opacity = '';
          selectedReadBtn.textContent = '選択記事を既読にする';
        }
      } else { // tab === 'unread'
        // 「未読」タブ：選択記事を既読にするボタンを表示（選択がなければ無効化）
        if (allReadBtn) {
          allReadBtn.style.display = 'none';
          allReadBtn.disabled = true;
          allReadBtn.classList && allReadBtn.classList.remove('disabled');
          allReadBtn.style.opacity = '';
          allReadBtn.textContent = 'すべて既読にする';
        }
        if (selectedReadBtn) {
          const disabled = (selectedIds.size === 0);
          selectedReadBtn.style.display = '';
          selectedReadBtn.disabled = disabled;
          selectedReadBtn.textContent = '選択記事を既読にする';
          if (disabled) {
            selectedReadBtn.classList && selectedReadBtn.classList.add('disabled');
            selectedReadBtn.style.opacity = '1';
          } else {
            selectedReadBtn.classList && selectedReadBtn.classList.remove('disabled');
            selectedReadBtn.style.opacity = '';
          }
        }
      }
    } else {
      // normal モードや初期状態では既存の選択状態に基づくロジックを使う
      if (allReadBtn) {
        const showAll = (selectAllChk && selectAllChk.checked && selectedIds.size > 0);
        if (showAll) {
          allReadBtn.style.display = '';
          allReadBtn.disabled = false;
          allReadBtn.classList && allReadBtn.classList.remove('disabled');
          allReadBtn.style.opacity = '';
          allReadBtn.textContent = 'すべて既読にする';
        } else {
          allReadBtn.style.display = 'none';
          allReadBtn.disabled = true;
          allReadBtn.classList && allReadBtn.classList.remove('disabled');
          allReadBtn.style.opacity = '';
          allReadBtn.textContent = 'すべて既読にする';
        }
      }
      if (selectedReadBtn) {
        const showSelected = ((!selectAllChk || !selectAllChk.checked) && (selectedIds.size > 0));
        if (showSelected) {
          selectedReadBtn.style.display = '';
          selectedReadBtn.disabled = false;
          selectedReadBtn.classList && selectedReadBtn.classList.remove('disabled');
          selectedReadBtn.style.opacity = '';
          selectedReadBtn.textContent = '選択記事を既読にする';
        } else {
          selectedReadBtn.style.display = 'none';
          selectedReadBtn.disabled = true;
          selectedReadBtn.classList && selectedReadBtn.classList.remove('disabled');
          selectedReadBtn.style.opacity = '';
          selectedReadBtn.textContent = '選択記事を既読にする';
        }
      }
      if (bottomAction) bottomAction.style.display = (selectedIds.size > 0) ? '' : 'none';
    }
  }

  readBtn && readBtn.addEventListener('click', function () {
    mode = 'select';
    updateModeUI();
    setupSelectButtons();    // ① 先にボタンにイベントセット
    updateSelection();       // ② 次に表示制御
    // 下部バーは「既読にする」クリック時に表示する（タブによってどのボタンを出すか決める）
    updateBottomButtonsVisibility();
    document.querySelectorAll('.info-item').forEach(item => {
      item.classList.add('select-mode');
    });
  });

  if (selectAllChk) {
    selectAllChk.addEventListener('change', function () {
      selectedIds.clear();

      if (this.checked) {
        // ALL_UNREAD_IDS は PHP で埋め込まれている想定（全ページ分の未読ID）
        (ALL_UNREAD_IDS || []).forEach(id => selectedIds.add(String(id)));
        updateSelection();
        saveSelectedIds();
        updateBottomButtonsVisibility();
        setBackPopupIfNeeded();
      } else {
        // チェック解除時は選択解除して UI 更新
        updateSelection();
        saveSelectedIds();
        updateBottomButtonsVisibility();
        setBackPopupIfNeeded();
      }
    });
  }

  function setupSelectButtons() {
    document.querySelectorAll('.select-btn').forEach(btn => {
        btn.onclick = function () {
        const id = btn.closest('.info-item').dataset.id;
        if (selectedIds.has(id)) {
            selectedIds.delete(id);
            btn.innerHTML = '選択する'; // 選択解除時
        } else {
            selectedIds.add(id);
            btn.innerHTML = '選択済み <i class="fa fa-check"></i>'; // Font Awesomeチェック
        }
        updateSelection();
        toggleBottomAction();
        saveSelectedIds();
        };
        // 初期表示も制御
        const id = btn.closest('.info-item').dataset.id;
        btn.innerHTML = selectedIds.has(id) ? '選択済み <i class="fa fa-check"></i>' : '選択する';
    });
    }

  function updateSelection() {
    document.querySelectorAll('.info-item').forEach(item => {
      const id = item.dataset.id;
      // tolerant check for unread flag
      const rawUnread = item.dataset.unread;
      const isUnread = (String(rawUnread) === '1' || String(rawUnread).toLowerCase() === 'true');
      const isRead = !isUnread;
      const isSelected = selectedIds.has(id);

      // select button handling (guarded)
      const btn = item.querySelector('.select-btn');
      if (btn) {
        if (mode === 'select' && isUnread) {
          btn.style.display = '';
          btn.innerHTML = isSelected ? '選択済み <i class="fa fa-check"></i>' : '選択する';
        } else {
          btn.style.display = 'none';
        }
      }

      // ensure read-label exists: if missing, create one (keeps markup consistent)
      let label = item.querySelector('.read-label');
      if (!label) {
        label = document.createElement('span');
        label.className = 'read-label text-secondary';
        label.style.display = 'none';
        label.textContent = '既読';
        // append to select-area if exists, otherwise to item
        const selArea = item.querySelector('.select-area') || item;
        selArea.appendChild(label);
      }

      // show/hide read label
      if (mode === 'select' && isRead) {
        label.style.display = 'inline-block';
      } else {
        label.style.display = 'none';
      }

      // selected class
      item.classList.toggle('selected', isSelected);
    });

    // safe update for selectAllChk (guard)
    if (selectAllChk) {
      const unreadCount = getUnreadIds().length;
      selectAllChk.checked = (selectedIds.size === unreadCount && selectedIds.size > 0);
    }
  }

  function toggleBottomAction() {
    updateBottomButtonsVisibility();
  }

  function openSelectedPopup() {
    showPopup('selected');
  }

  // 両方のボタンは「選択記事を既読にする」と同じダイアログを開く
  function openSelectedPopup() {
    showPopup('selected');
  }

  if (allReadBtn) allReadBtn.addEventListener('click', openSelectedPopup);
  if (selectedReadBtn) selectedReadBtn.addEventListener('click', openSelectedPopup);
  closeSelectBtn && closeSelectBtn.addEventListener('click', function () {
    mode = 'normal';
    selectedIds.clear();
    saveSelectedIds();
    updateModeUI();
    updateSelection();
    bottomAction.style.display = 'none';
    selectAllChk.checked = false;
    document.querySelectorAll('.info-item').forEach(item => {
      item.classList.remove('select-mode'); // 追加したクラス名と合わせる
    });
  });

  function getUnreadIds() {
    // 現在 DOM 上にある未読記事の ID を文字列で返す（型を統一）
    return [...document.querySelectorAll('.info-item[data-unread="1"]')].map(item => String(item.dataset.id));
  }

  function filterArticles() {
    document.querySelectorAll('.info-item').forEach(item => {
      const isUnread = item.dataset.unread === '1';
      if (tab === 'all' || isUnread) {
        item.style.display = '';
      } else {
        item.style.display = 'none';
      }
      // 選択モード時のみ選択ボタン・既読ラベル表示
      if (mode === 'select' && isUnread) {
        item.querySelector('.select-btn').style.display = '';
      } else {
        item.querySelector('.select-btn').style.display = 'none';
      }
      if (mode === 'select' && !isUnread && item.querySelector('.read-label')) {
        item.querySelector('.read-label').style.display = 'inline-block';
      } else if (item.querySelector('.read-label')) {
        item.querySelector('.read-label').style.display = 'none';
      }
    });
    updateBottomButtonsVisibility();
  }

  function showPopup(type) {
    popup.dataset.type = type;
    popup.style.display = '';
  }

  if (okBtn) {
    okBtn.addEventListener('click', function () {
      if (popup) popup.style.display = 'none';

      // 常に「選択記事を既読にする」挙動に統一する
      // selectedIds が空でかつ select-all がチェックされているなら一覧の未読（現在ページ）を対象にする
      let idsToSend = [...selectedIds];

      if ((!idsToSend || idsToSend.length === 0) && selectAllChk && selectAllChk.checked) {
        // 全ページ分を選択している場合は ALL_UNREAD_IDS を優先する（全未読ID）
        idsToSend = (ALL_UNREAD_IDS && ALL_UNREAD_IDS.length) ? ALL_UNREAD_IDS.slice() : getUnreadIds();
      }

      if (!idsToSend || idsToSend.length === 0) {
        mode = 'normal';
        if (selectedIds.clear) selectedIds.clear();
        saveSelectedIds && saveSelectedIds();
        updateModeUI && updateModeUI();
        updateSelection && updateSelection();
        if (bottomAction) bottomAction.style.display = 'none';
        if (selectAllChk) selectAllChk.checked = false;
        if (typeof showToast === 'function') showToast('既読にする未読記事がありません');
        return;
      }

      const form = new FormData();
      form.append('action', 'mark_info_read');
      // 重要：all フラグは送らない（サーバ側の全件既読処理を呼ばない）
      idsToSend.forEach(id => form.append('ids[]', String(id)));

      if (typeof showProcessingOverlay === 'function') {
        showProcessingOverlay('既読処理中です。しばらくお待ちください。');
      } else {
        if (typeof showToast === 'function') showToast('既読処理中...');
      }

      const SAFETY_TIMEOUT = 30000;
      let timeoutHandle = setTimeout(() => {
        try { if (typeof hideProcessingOverlay === 'function') hideProcessingOverlay(); } catch(e){}
        if (typeof showToast === 'function') showToast('処理が長くなっています。後で一覧を再読み込みしてください。');
      }, SAFETY_TIMEOUT);

      fetch('<?php echo esc_js( admin_url("admin-ajax.php") ); ?>', {
        method: 'POST',
        credentials: 'same-origin',
        body: form
      })
      .then(res => res.json())
      .then(data => {
        clearTimeout(timeoutHandle);
        try { if (typeof hideProcessingOverlay === 'function') hideProcessingOverlay(); } catch(e){}
        if (!data || !data.success) {
          console.error('mark_info_read failed', data);
          if (typeof showToast === 'function') showToast('既読処理に失敗しました');
          return;
        }
        // UI をリセット
        mode = 'normal';
        if (selectedIds.clear) selectedIds.clear(); else selectedIds = new Set();
        saveSelectedIds && saveSelectedIds();
        updateModeUI && updateModeUI();
        updateSelection && updateSelection();
        if (bottomAction) bottomAction.style.display = 'none';
        if (selectAllChk) selectAllChk.checked = false;

        const refreshTab = tab || 'all';
        fetchArticles(refreshTab, 1)
          .then(() => {
            if (typeof showToast === 'function') showToast('既読にしました');
          })
          .catch(err => {
            console.error('refresh after mark_info_read failed', err);
            if (typeof showToast === 'function') showToast('既読にしました（表示の更新に失敗しました）');
          });
      })
      .catch(err => {
        clearTimeout(timeoutHandle);
        console.error('mark_info_read request failed', err);
        try { if (typeof hideProcessingOverlay === 'function') hideProcessingOverlay(); } catch(e){}
        if (typeof showToast === 'function') showToast('既読処理に失敗しました（通信エラー）');
        mode = 'normal';
        selectedIds.clear && selectedIds.clear();
        saveSelectedIds && saveSelectedIds();
        updateModeUI && updateModeUI();
        updateSelection && updateSelection();
        if (bottomAction) bottomAction.style.display = 'none';
        if (selectAllChk) selectAllChk.checked = false;
      });
    });
  } else {
    console.warn('okBtn not found — cannot bind ok handler');
  }

  cancelBtn.addEventListener('click', function () {
    popup.style.display = 'none';
  });

  function showToast(msg) {
    toast.textContent = msg;
    toast.style.display = '';
    setTimeout(() => { toast.style.display = 'none'; }, 2000);
  }

  // --- ブラウザバック警告ポップアップ追加 ---
  // ポップアップDOM生成
  const backPopup = document.createElement('div');
  backPopup.className = 'back-popup';
  backPopup.style.cssText = 'display:none;position:fixed;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.3);z-index:2002;';
  backPopup.innerHTML = `
    <div class="popup-content bg-white rounded p-4 text-center" style="max-width:340px; margin:30vh auto 12vh;">
      <div>既読にする記事の選択状態が<br>解除されます。<br>よろしいですか？</div>
      <div class="popup-btns mt-3 d-flex justify-content-center gap-4">
        <button class="back-ok-btn btn btn-primary rounded-pill px-4">はい</button>
        <button class="back-cancel-btn btn btn-outline-secondary rounded-pill px-4">いいえ</button>
      </div>
    </div>
  `;
  document.body.appendChild(backPopup);

  let waitForBackPopup = false;
  let lastBackUrl = null;

  // pushStateで履歴の一手先にダミーを置く
  function setBackPopupHistory() {
    lastBackUrl = location.href;
    history.pushState({backPopup:true}, '', location.href);
    waitForBackPopup = true;
  }

  window.addEventListener('popstate', function(event) {
    // ブラウザバックでダミー履歴ならここでポップアップ
    if (waitForBackPopup || (event.state && event.state.backPopup)) {
      // 選択モードかつ未読記事が選択されている場合のみ
      const hasSelectedUnread = mode === 'select' && [...selectedIds].some(id => {
        const item = document.querySelector(`.info-item[data-id="${id}"]`);
        return item && item.dataset.unread === '1';
      });
      if (hasSelectedUnread) {
        backPopup.style.display = '';
        waitForBackPopup = false;
        return;
      } else {
        // 選択されてなければ通常戻す
        history.back();
        return;
      }
    }

    // 通常のpopstate処理（既読記事の選択解除も含む）
    mode = 'normal';
    loadSelectedIds();
    document.querySelectorAll('.info-item').forEach(item => {
      const id = item.dataset.id;
      const isUnread = item.dataset.unread === '1';
      if (!isUnread && selectedIds.has(id)) {
        selectedIds.delete(id);
      }
    });
    saveSelectedIds();
    updateModeUI();
    setupTab();
    setupPaginationLinks();
    filterArticles();
    setupSelectButtons();
    updateSelection();
    toggleBottomAction();
  });

  // ページ離脱前に履歴ダミー追加（選択状態ありの場合のみ）
  window.addEventListener('beforeunload', function(e) {
    // 画面遷移時の保険(通常不要)
    waitForBackPopup = false;
    lastBackUrl = null;
  });

  // 履歴の一手先にダミーを置く（選択モードで未読選択時のみ）
  function setBackPopupIfNeeded() {
    const hasSelectedUnread = mode === 'select' && [...selectedIds].some(id => {
      const item = document.querySelector(`.info-item[data-id="${id}"]`);
      return item && item.dataset.unread === '1';
    });
    if (hasSelectedUnread && !waitForBackPopup) {
      setBackPopupHistory();
    }
  }

  // 選択モードになったタイミングや選択変更時に履歴ダミーをセット
  readBtn && readBtn.addEventListener('click', setBackPopupIfNeeded);
  selectAllChk && selectAllChk.addEventListener('change', setBackPopupIfNeeded);
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('select-btn')) setBackPopupIfNeeded();
  });

  // ポップアップの「はい」「いいえ」ボタン
  backPopup.querySelector('.back-ok-btn').addEventListener('click', function() {
    backPopup.style.display = 'none';
    mode = 'normal';
    selectedIds.clear();
    saveSelectedIds();
    updateModeUI();
    setupTab();
    setupPaginationLinks();
    filterArticles();
    setupSelectButtons();
    updateSelection();
    toggleBottomAction();
    // ポップアップを閉じて一つ前の履歴へ
    history.go(-1);
  });
  backPopup.querySelector('.back-cancel-btn').addEventListener('click', function() {
    backPopup.style.display = 'none';
    // 履歴を進めて元に戻す（キャンセル）
    history.go(1);
  });
  // --- ここまでブラウザバック警告ポップアップ追加 ---

  initialize();
});

</script>