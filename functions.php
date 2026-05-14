<?php
$hostname = $_SERVER['HTTP_HOST'];

if ($hostname === 'official-webdev.zenko-sai.or.jp') {
    // 【テスト環境】用の設定
    define('APP_ENV', 'development');
} else {
    // 【本番環境】用の設定（www.zenko-sai.or.jp および その他）
    define('APP_ENV', 'production');
}

// 使用例：環境ごとに処理を分ける場合
// if (APP_ENV === 'development') {
//     // テスト環境だけで実行したいコード（デバッグ表示など）をここに書く
// } else {
//     // 本番環境だけで実行したいコードをここに書く
// }

/*-------------------------------------------*/
/*  カスタム投稿タイプ「イベント情報」を追加
 /*-------------------------------------------*/
// add_action( 'init', 'add_post_type_event', 0 );
// function add_post_type_event() {
//     register_post_type( 'event', /* カスタム投稿タイプのスラッグ */
//         array(
//             'labels' => array(
//                 'name' => 'イベント情報',
//                 'singular_name' => 'イベント情報'
//             ),
//         'public' => true,
//         'menu_position' =>5,
//         'has_archive' => true,
//         'supports' => array('title','editor','excerpt','thumbnail','author')
//         )
//     );
// }

/*-------------------------------------------*/
/*  カスタム分類「イベント情報カテゴリー」を追加
 /*-------------------------------------------*/
// add_action( 'init', 'add_custom_taxonomy_event', 0 );
// function add_custom_taxonomy_event() {
//     register_taxonomy(
//         'event-cat', /* カテゴリーの識別子 */
//         'event', /* 対象の投稿タイプ */
//         array(
//             'hierarchical' => true,
//             'update_count_callback' => '_update_post_term_count',
//             'label' => 'イベントカテゴリー',
//             'singular_label' => 'イベント情報カテゴリー',
//             'public' => true,
//             'show_ui' => true,
//         )
//     );
// }

/********* 備考1 **********
 Lightningはカスタム投稿タイプを追加すると、
 作成したカスタム投稿タイプのサイドバー用のウィジェットエリアが自動的に追加されます。
 プラグイン VK All in One Expansion Unit のウィジェット機能が有効化してあると、
 VK_カテゴリー/カスタム分類ウィジェット が使えるので、このウィジェットで、
 今回作成した投稿タイプ用のカスタム分類を設定したり、
 VK_アーカイブウィジェット で、今回作成したカスタム投稿タイプを指定する事もできます。
 /********* 備考2 **********
 カスタム投稿タイプのループ部分やサイドバーをカスタマイズしたい場合は、
 下記の命名ルールでファイルを作成してアップしてください。
 module_loop_★ポストタイプ名★.php
 */

/*-------------------------------------------*/
/*  フッターのウィジェットエリアの数を増やす
 /*-------------------------------------------*/
// add_filter('lightning_footer_widget_area_count','lightning_footer_widget_area_count_custom');
// function lightning_footer_widget_area_count_custom($footer_widget_area_count){
//     $footer_widget_area_count = 4; // ← 1~4の半角数字で設定してください。
//     return $footer_widget_area_count;
// }

/*-------------------------------------------*/
/*  <head>タグ内に自分の追加したいタグを追加する
 /*-------------------------------------------*/
function add_wp_head_custom()
{ ?>
<!-- head内に書きたいコード -->
<?php date_default_timezone_set('Asia/Tokyo'); ?>
<link rel="stylesheet" href="/cms/wp-content/themes/zenkosai/slick/slick.css" type="text/css" />
<link href="https://use.fontawesome.com/releases/v6.7.1/css/all.css" rel="stylesheet">
<link rel='stylesheet'
    href='/cms/wp-content/themes/zenkosai/assets/css/style.css?<?php echo date("ymdHis", filemtime(get_stylesheet_directory() . "/assets/css/style.css")); ?>'
    type='text/css'>
<link rel='stylesheet'
    href='/cms/wp-content/themes/zenkosai/assets/css/member-search.css?<?php echo date("ymdHis", filemtime(get_stylesheet_directory() . "/assets/css/member-search.css")); ?>'
    type='text/css'>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Kosugi&family=Mada:wght@200;300;400;500;600;700;900&display=swap"
    rel="stylesheet">
<link rel="shortcut icon" href="/cms/wp-content/themes/zenkosai/assets/images/common/favicon.png">
<link rel="apple-touch-icon" href="apple-touch-icon.png" sizes="180×180">
<link rel="icon" href="apple-touch-icon.png">
<link rel="prefetch" href="/cms/wp-content/uploads/2021/03/トップ画面E.png" as="image">
<link rel="prefetch" href="/cms/wp-content/themes/zenkosai/assets/images/icons/home/csr_icon_magokoro.png" as="image">
<link rel="prefetch" href="/cms/wp-content/plugins/contact-form-7-add-confirm/includes/css/styles.css?ver=5.1"
    as="style">
<link rel="prefetch" href="/cms/wp-content/plugins/contact-form-7-multi-step-module/resources/cf7msm.css?ver=4.0.9"
    as="style">
<link rel="prefetch" href="/cms/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.3.2" as="style">
<link rel="prefetch" href="/cms/wp-includes/css/dist/block-library/style.min.css?ver=5.5.3" as="style">
<link rel="prefetch" href="https://static-v1.va-api.net/api/Endpoints/81/va-pc.css" as="style">

<?php
}
add_action('wp_head', 'add_wp_head_custom', 99);

function add_wp_footer_custom()
{ ?>
<script type="text/javascript" src="/cms/wp-content/themes/zenkosai/slick/slick.min.js"></script>
<script type="text/javascript" src="/cms/wp-content/themes/zenkosai/slick/common.js"></script>
<script type="text/javascript" src="/cms/wp-content/themes/zenkosai/assets/js/zenkosai.js?<?php echo date(" ymdHis",
        filemtime(get_stylesheet_directory() . "/assets/js/zenkosai.js")); ?>"></script>
<?php if (is_page('qr')): ?>
<script type="text/javascript" src="https://unpkg.com/@wiz-develop/server-clock@1.0.x/dist/bundle.min.js"></script>
<script type="text/javascript" src="/cms/wp-content/themes/zenkosai/assets/js/convention_qrcode.js?<?php echo date("
    ymdHis", filemtime(get_stylesheet_directory() . "/assets/js/convention_qrcode.js")); ?>"></script>
<?php
    endif; ?>
<script async="" charset="utf-8" src="/cms/wp-content/themes/zenkosai/va-loader.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery.qrcode.min.js"></script>
<?php
}
add_action('wp_footer', 'add_wp_footer_custom', 99);

// function enqueue_lifesupport_script() {
//     if (is_page('lifesupport') || is_post_type_archive('lifesupport')) {
//         wp_enqueue_script(
//             'lifesupport-script',
//             get_template_directory_uri() . '/js/lifesupport.js',
//             array(),
//             null,
//             true
//         );
//     }
// }
// add_action('wp_enqueue_scripts', 'enqueue_lifesupport_script');

// function add_defer_attribute_to_lifesupport_script($tag, $handle, $src) {
//     if ($handle === 'lifesupport-script') {
//         return '<script src="' . esc_url($src) . '" defer></script>';
//     }
//     return $tag;
// }
// add_filter('script_loader_tag', 'add_defer_attribute_to_lifesupport_script', 10, 3);

/*-------------------------------------------*/
/*  アップロードした画像を自動でリサイズさせない
 /*-------------------------------------------*/
add_filter('big_image_size_threshold', '__return_false');

function my_add_noindex_attachment()
{
    if (is_attachment()) {
        echo '<meta name="robots" content="noindex,follow">';
    }
}
add_action('wp_head', 'my_add_noindex_attachment');

/*-------------------------------------------*/
/*  プラグイン自動更新無効化
 /*-------------------------------------------*/
add_filter('auto_update_plugin', '__return_false');

/*-------------------------------------------*/
/*  gtag クリックイベント 
 /*-------------------------------------------*/
function gtag_click($label, $event = 'click', $event_cat = 'link')
{
    $label = htmlspecialchars($label);
    return 'onclick="gtag(\'event\', \'' . $event . '\', {\'event_category\': \'' . $event_cat . '\',\'event_label\': \'' . $label . '\',\'value\': \'1\'})"';
}

/*-------------------------------------------*/
/*  変数の設定
 /*-------------------------------------------*/
// API用のURL
global $api_load;
$api_load = '/var/www/html/cms/wp-load.php';
// この変数を変更してもheaderに書いてるログアウト時のURLは変わらない
global $api_directori;
$api_directori = 'cms/wp-content/themes/zenkosai/api/';
global $mypage_directori;
if (APP_ENV === 'development') {
    $mypage_directori = 'https://test-mypage.zenko-sai.or.jp';
} else {
    $mypage_directori = 'https://mypage.zenko-sai.or.jp';
}

/*-------------------------------------------*/
/*  社会貢献活動で投稿が「更新情報として投稿」・「更新情報タイトル」を選択して更新された場合
 /*-------------------------------------------*/
// post・page保存時に実行するアクションフックを作成
add_action('save_post', 'my_post_update_information', 10, 3);

/**
 * @param $post_id: 保存された投稿のID
 * @param $post: 保存された投稿のオブジェクト
 * @param $upadte: 更新か新規投稿かどうかの判定
 */
function my_post_update_information($post_id, $post, $update)
{
    // 更新の時のみ
    if (!($update)) {
        return;
    }
    // 社会貢献活動の投稿のみ
    if ('social-contribution' !== $post->post_type) {
        return;
    }
    // 「更新情報として投稿」が選択されいるか
    if (!(CFS()->get('post_as_update_information', get_the_ID()))) {
        return;
    }
    // 「更新情報タイトル」が選択されいるか
    $statement_title_array = CFS()->get('title_update_information', get_the_ID());

    $statement_title = '';
    foreach ($statement_title_array as $value) {
        $statement_title = $value;
    }
    if ('選択してください。' == $statement_title) {
        return;
    }

    // 投稿内容作成
    $content =
        '<p>' . $post->post_title . $statement_title . '</p><br>
    <a href="/social-contribution/' . $post->post_name . '"><u>対象の記事はこちら。</u></a>';

    $social_contribution_id = array(9);
    // 投稿オブジェクトを作成
    $my_post = array();
    $my_post = array(
        'post_title' => wp_strip_all_tags($post->post_title . $statement_title),
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'information',
        'post_author' => 1,
        'post_category' => $social_contribution_id,
    );
    // 投稿をデータベースへ追加
    $new_post_id = wp_insert_post($my_post);
    if (is_wp_error($new_post_id)) {
        return;
    }
    add_post_meta($new_post_id, '_edit_last', 1);
    add_post_meta($new_post_id, 'important_information', 0);
    add_post_meta($new_post_id, 'update_information', 1);
    add_post_meta($new_post_id, '_lightning_design_setting', 'a:1:{s:6:"layout";s:7:"default";}');
    wp_set_object_terms($new_post_id, $social_contribution_id, 'news');
}

/*-------------------------------------------*/
/*  端末判別
 /*-------------------------------------------*/
function is_mobile()
{
    $useragents = array(
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android', // 1.5+ Android
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser
    );
    $pattern = '/' . implode('|', $useragents) . '/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

function wp_is_tablet()
{
    $uat = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($uat, 'iPad') // iPad
    || (strpos($uat, 'Android') && strpos($uat, 'Mobile') === false) // Android搭載タブレット
    || strpos($uat, 'windows touch') //windows touch
    || strpos($uat, 'Kindle') // Kindle
    || strpos($uat, 'Silk') // Kindle に付属の Amazon 製ブラウザ
    || strpos($uat, 'firefox tablet') //firefox tablet
    || strpos($uat, 'WebOS') // Palm
    ) {
        return true;
    }
    else {
        return false;
    }
}

/*-------------------------------------------*/
/*  タブタイトル動的に変更（社会貢献活動）
 /*-------------------------------------------*/
function change_title_tag($title)
{
    //条件分岐タグ等を使ってページにより $title を変更する処理
    if (is_page('social-contributions/category')) {
        $t = get_term_by('slug', $_GET['csr_cat'], 'csr_cat');
        $title = $t->name;
    }
    return $title;
}
add_filter('pre_get_document_title', 'change_title_tag');

/*-------------------------------------------*/
/*  カスタム投稿カスタマイズ
 /*-------------------------------------------*/

add_action('acf/init', 'my_acf_add_local_field_groups');
function my_acf_add_local_field_groups()
{
    acf_add_local_field_group(array(
        'key' => 'lifesupport',
        'title' => 'ライフサポートサービス',
        'fields' => array(
                array('key' => 's_logo', 'label' => 'ロゴ', 'name' => 's_logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
                array('key' => 's_display', 'label' => 'ログイン前に表示しない', 'name' => 's_display', 'type' => 'checkbox', 'choices' => ['yes' => ''], )
        ),
        'location' => array(
                array(
                    array('param' => 'taxonomy', 'operator' => '==', 'value' => 'lifesupport_cat'),
            ),
        ),
    ));
    acf_add_local_field_group(array(
        'key' => 'homenews',
        'title' => 'お知らせ',
        'fields' => array(
                array('key' => 'n_logo', 'label' => 'ロゴ', 'name' => 'n_logo', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
                array('key' => 'n_color', 'label' => 'カラー', 'name' => 'n_color', 'type' => 'color_picker'),

        ),
        'location' => array(
                array(
                    array('param' => 'taxonomy', 'operator' => '==', 'value' => 'news'),
            ),
        ),
    ));
    acf_add_local_field_group(array(
        'key' => 'social-contribution',
        'title' => '社会貢献活動',
        'fields' => array(
                array('key' => 'csr_cat_icon', 'label' => 'カテゴリー画像', 'name' => 'csr_cat_icon', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
                array('key' => 'csr_cat_img', 'label' => 'メイン画像', 'name' => 'csr_cat_img', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'thumbnail', 'library' => 'all'),
                array('key' => 'csr_contents', 'label' => '概要', 'name' => 'csr_contents', 'type' => 'wysiwyg'),
                array('key' => 'csr_title01', 'label' => '項目1タイトル', 'name' => 'csr_title01', 'type' => 'text'),
                array('key' => 'csr_contents01', 'label' => '項目1内容', 'name' => 'csr_contents01', 'type' => 'wysiwyg'),
                array('key' => 'csr_title02', 'label' => '項目2タイトル', 'name' => 'csr_title02', 'type' => 'text'),
                array('key' => 'csr_contents02', 'label' => '項目2内容', 'name' => 'csr_contents02', 'type' => 'wysiwyg'),
                array('key' => 'csr_title03', 'label' => '項目3タイトル', 'name' => 'csr_title03', 'type' => 'text'),
                array('key' => 'csr_contents03', 'label' => '項目3内容', 'name' => 'csr_contents03', 'type' => 'wysiwyg'),
                array('key' => 'csr_linktitle', 'label' => '外部リンクタイトル', 'name' => 'csr_linktitle', 'type' => 'text'),
                array('key' => 'csr_linkcontents', 'label' => '外部リンク内容', 'name' => 'csr_linkcontents', 'type' => 'wysiwyg'),
                array('key' => 'csr_new_display', 'label' => 'NEW表記設定', 'name' => 'csr_new_display', 'type' => 'checkbox', 'choices' => ['yes' => '']),
        ),
        'location' => array(
                array(
                    array('param' => 'taxonomy', 'operator' => '==', 'value' => 'csr_cat'),
            ),
        ),
    ));
}


/*-------------------------------------------*/
/*  カスタム投稿タイプに子ページを作る
 /*-------------------------------------------*/
add_action('registered_post_type', 'kaiza_posts_hierarchical', 10, 2);
function kaiza_posts_hierarchical($post_type, $pto)
{
    global $wp_post_types;
    if ($post_type != 'lifesupport')
        return;
    $wp_post_types['lifesupport']->hierarchical = 1;
    add_post_type_support('lifesupport', 'page-attributes');
}

/**
 * 親投稿のスラッグを取得する関数
 */
function get_parent_post_slug($pet)
{
    if (!is_object($pet) || !$pet->post_parent) {
        return false;
    }
    return get_post($pet->post_parent)->post_name;
}

/**
 * get_sample_permalinkのfilterフック
 **/
add_filter('get_sample_permalink', function ($permalink, $post_id, $title, $name, $pet) {
    if ($pet->post_type != 'post' || !$pet->post_parent) {
        return $permalink;
    }

    $template_permalink = current($permalink);
    $replacement_permalink = next($permalink);

    $postname_string = '/%postname%/';

    $parent_slug = get_parent_post_slug($pet);

    $altered_template_with_parent_slug = '/' . $parent_slug . $postname_string;
    $new_template = str_replace($postname_string, $altered_template_with_parent_slug, $template_permalink);

    $new_permalink = [$new_template, $replacement_permalink];

    return $new_permalink;
}, 99, 5);

/**
 * post_linkのfilterフック
 **/
add_filter('post_link', function ($post_link, $pet, $leavename) {

    if ($pet->post_type != 'post' || !$pet->post_parent) {
        return $post_link;
    }

    $parent_slug = get_parent_post_slug($pet);
    $new_post_link = str_replace($pet->post_name, $parent_slug . '/' . $pet->post_name, $post_link);

    return $new_post_link;
}, 99, 3);

/**
 * pre_get_postsのactionフック
 */
add_action('pre_get_posts', function ($query) {
    global $wpdb, $wp_query;

    $original_query = $query;
    $uri = $_SERVER['REQUEST_URI'];

    if ($query->is_main_query() && !is_admin()) {

        $basename = basename($uri);
        $test_query = sprintf("select * from $wpdb->posts where post_type = '%s' and post_name = '%s';", 'pet', $basename);
        $result = $wpdb->get_results($test_query);

        if (!($pet = current($result)) || !$pet->post_parent) {
            return $original_query;
        }

        $parent_slug = get_parent_post_slug($pet);
        $hierarchal_slug = $parent_slug . '/' . $pet->post_name;

        if (!stristr($uri, $hierarchal_slug)) {
            return $original_query;
        }

        $query->query_vars['post_type'] = ['pet'];
        $query->is_home = false;
        $query->is_page = true;
        $query->is_single = true;
        $query->queried_object_id = $pet->ID;
        $query->set('page_id', $pet->ID);

        return $query;
    }

}, 1);


/*-------------------------------------------*/
/*  ショートコード
 /*-------------------------------------------*/

/*
 * 電話ボタン
 * @param  tel=  電話番号
 * @return string 電話ボタン
 */
function ls_tel_banner($atts)
{
    return
        '<div class="d-flex flex-row align-items-center">
        <div class="d-inline-block " style="width: 3rem; height: 3rem;">
            <img src="/cms/wp-content/themes/zenkosai/assets/images/lifesupport/tel.png" class="w-100" alt="専用電話">
        </div>
        <a href="tel:' . $atts['tel'] . '" class="pl-3 font-large bold mb-0">
            <font class="font-larger" color="#EC7925">' . $atts['tel'] . '</font>
        </a>
    </div>';
}
add_shortcode('tel_banner', 'ls_tel_banner');

// 文字大きく表示
function txt_bigger($atts, $content = null)
{
    return
        '<font//zenko-sai.welfare.club/#entry class="font-larger">' . $content . '</font>';
}
add_shortcode('tbig', 'txt_bigger');

// 文字小さく表示
function txt_smaller($atts, $content = null)
{
    return
        '<font class="font-smaller">' . $content . '</font>';
}
add_shortcode('tsmall', 'txt_smaller');

/*
 * 資料直ダウンロードボタン
 * @param  title= 表示文字
 * @return string リンクボタン
 */
function ls_form_dwnload_btn($atts)
{
    session_start();
    $dl_form = get_post_meta(get_the_ID(), 'dl_form', true);
    $new_dl_form = get_post_meta(get_the_ID(), 'new_dl_form', true);

    $today_date = new DateTime('now');
    $new_style_start = new DateTime('2022-04-01 00:00:00');
    if ($new_style_start <= $today_date || $_GET['disp_key'] == '202204') {
        if ($new_dl_form) {
            $p_id = $new_dl_form;
        }
        else {
            $p_id = $dl_form;
        }
    }
    else {
        $p_id = $dl_form;
    }

    $p_info = get_post($p_id);
    $url = $p_info->guid;
    return
        '<div class="dl-btn">
        <a href="' . $url . '" class="gtm-click-download" data-gtm-click="' . strip_tags($atts['title']) . '">
            <button class="showall-btn d-inline">
                <p class="mb-0">' . $atts['title'] . '</p>
            </button>
        </a>
    </div>';
// }
}
add_shortcode('dl_form_btn', 'ls_form_dwnload_btn');

/*
 * リンクボタン
 * @param  link=  リンク先
 * @param  title= 表示文字
 * @param  check= 空白・・サービス開始日制御
 none・・そのままリンクボタン表示
 * @return string リンクボタン
 */
function ls_link_btn($atts)
{
    // session_start();
    // if($atts['check'] == 'none'){
    return
        '<div class="link-btn">
            <a href="' . $atts['link'] . '">
                <button class="showall-btn d-inline">
                    <p class="mb-0">' . $atts['title'] . '</p>
                </button>
            </a>
        </div>';
// }else{
//     $today = date("Y/m/d");
//     $startday = $_SESSION['member_info']['startdate'];
//     if(strtotime($today) > strtotime($startday)){
//         return
//         '<div class="link-btn">
//             <a href="'.$atts['link'].'">
//                 <button class="showall-btn d-inline">
//                     <p class="mb-0">'.$atts['title'].'</p>
//                 </button>
//             </a>
//         </div>';
//     }
// }
}
add_shortcode('link_btn', 'ls_link_btn');

/*
 * 資料取り寄せボタン
 * @param  srv=  リンク先
 * @param  title= 表示文字
 * @return string リンクボタン
 */
function ls_apply_form_btn($atts)
{
    if ($atts['cate'] == 'mobile') {
        return
            '<div class="link-btn">
            <a href="/form/?cate=' . $atts['cate'] . '">
                <button class="showall-btn d-inline">
                    <p class="mb-0">' . $atts['title'] . '</p>
                </button>
            </a>
        </div>';
    }
    else {
        return
            '<div class="link-btn">
            <a href="/form/?cate=lifesupport&srv=' . $atts['link'] . '">
                <button class="showall-btn d-inline">
                    <p class="mb-0">' . $atts['title'] . '</p>
                </button>
            </a>
        </div>';
    }
}
add_shortcode('form_apply_btn', 'ls_apply_form_btn');

/*
 * テキストをバナーにするコード
 * @param  link=  リンク先
 * @param  title= 表示文字
 * @return string リンクボタン
 */
function txt_banner($atts)
{
    return
        '<a class="txt_banner d-flex mt-2 px-3 gtm-click-link" href="' . $atts['link'] . '" target="_blank" data-gtm-click="' . strip_tags($atts['title']) . '">
        <p class="mb-0">' . $atts['title'] . '</p>
        <i class="fas fa-caret-right d-flex align-items-center"></i>
    </a>';
}
add_shortcode('t_banner', 'txt_banner');

/*
 * 余分なところを押さないようにする
 */
function no_extra_btn($content)
{
    return
        '<div class="d-inline">
        ' . $content . '
    </div>';
}
add_shortcode('n_btn', 'no_extra_btn');

// 開始日制御
function banner_btn($atts, $content = null)
{
    // $today = date("Y/m/d");
    // session_start();
    // $startday = $_SESSION['member_info']['startdate'];
    // if(strtotime($today) > strtotime($startday)){
    return
        '<div class="d-inline">'
        . $content .
        '</div>';
// }
}
add_shortcode('banner', 'banner_btn');

// POINT表示
function ls_point_content($atts, $content = null)
{
    return
        '<div class="point mb-3 pt-4">
        <p class="mb-0">' . $atts['title'] . '</p>
        <div class="point__detail">
            ' . $content . '
        </div>
    </div>';
}
add_shortcode('point_content', 'ls_point_content');

// 送付先
function ls_address_content()
{
    return
        '<p>■送付先</p>
    <p>メール：kyosai@kknw.jp</p>
    <p>ＦＡＸ：079–457–0600</p>
    <p>郵送：〒675–0067</p>
    <p>兵庫県加古川市加古川町河原333–1 一般財団法人全国福利厚生共済会 サービス担当宛</p>';
}
add_shortcode('address_content', 'ls_address_content');

// GET/POST連携あり
/*
* バナーリンクボタン
* @param  service= サービス名
* @return string バナーリンクボタン
*/
function create_link_banner($attr, $content = null)
{
    session_start();
    $today = date("Y/m/d");
    $startday = $_SESSION['member_info']['startdate'];
    if (!$startday) {
        $startday = "2022/07/01";
    }
    $limit_startdate_layout = '<div class="limit_startdate js_form_btn">
                <div class="limit_startdate__content btn_opacity d-inline-block">
                ' . $content . '
                    <p class="limit_startdate__content__text mb-0">
                        <span>サービス利用開始日以降に<br>ご利用いただけます</span>
                    </p>
                </div>
            </div>';

    // 全厚済OFFTIME
    if ($attr['service'] == 'offtime') {
        return
            '<p class="homeMain_image-item js_form_btn">
            <a data-formid="submit_offTime" class="banner-shadow-radius btn_opacity gtm-click-link" data-gtm-click="全厚済OffTime専用サイト">
                ' . $content . '
            </a>
        </p>';
    }
    // 全厚済モール
    if ($attr['service'] == 'mall') {
        if (strtotime($today) >= strtotime($startday)) { // サービス利用開始日判定
            return
                '<p class="js_form_btn">
                <a data-formid="submit_mall" class="banner-shadow-radius btn_opacity d-inline gtm-click-link" data-gtm-click="全厚済モール">
                ' . $content . '
                </a>
            </p>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // フレンドショップ
    if ($attr['service'] == 'friendshop') {
        if (strtotime($today) >= strtotime($startday)) {
            return
                '<p class="js_form_btn">
                <a data-formid="submit_fs_shop" class="banner-shadow btn_opacity d-inline gtm-click-link" data-gtm-click="フレンドショップ">
                ' . $content . '
                </a>
            </p>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // 販促品
    if ($attr['service'] == 'hansoku') {
        return
            '<p class="js_form_btn">
            <a data-formid="submit_shop" class="btn_opacity d-inline gtm-click-link" data-gtm-click="販促品注文サイト">
            ' . $content . '
            </a>
        </p>
        ';
    }
    // ライフセミナー
    if ($attr['service'] == 'life_seminar') {
        if (strtotime($today) >= strtotime($startday)) {
            if (!$_SESSION['member_info']['mail_judge']) {
                $cls = 'deficient_popup';
            }
            else {
                $cls = 'seminar_form';
            }
            return
                '<div class="' . $cls . ' banner-shadow link-btn loading-parent cursor_pointer d-inline-block gtm-click-link" data-formid="submitMypage" data-formabout="life_seminar" data-gtm-click="ライフセミナー">
                ' . $content . '
            </div>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // セミナー申し込み一覧
    if ($attr['service'] == 'life_seminar_conv') {
        if (strtotime($today) >= strtotime($startday)) {
            if (!$_SESSION['member_info']['mail_judge']) {
                $cls = 'deficient_popup';
            }
            else {
                $cls = 'seminar_form';
            }
            return
                '<div class="' . $cls . ' banner-shadow link-btn loading-parent cursor_pointer d-inline-block gtm-click-link target-blank-trigger" data-formid="submitMypage" data-formabout="redirect_to" data-gtm-click="コンベンションチケット購入情報確認">
                ' . $content . '
            </div>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // チケット申込み
    if ($attr['service'] == 'life_seminar_glion') {
        if (strtotime($today) >= strtotime($startday)) {
            if (!$_SESSION['member_info']['mail_judge']) {
                $cls = 'deficient_popup';
            }
            else {
                $cls = 'seminar_form';
            }
            return
                '<div class="' . $cls . ' banner-shadow link-btn loading-parent cursor_pointer d-inline-block gtm-click-link target-blank-trigger" data-formid="submitMypage" data-formabout="redirect_from" data-gtm-click="ジーライオンアリーナ神戸会場チケット申込">
                ' . $content . '
            </div>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // 神戸国際会館 こくさいホールチケット申込み
    if ($attr['service'] == 'life_seminar_pv') {
        if (strtotime($today) >= strtotime($startday)) {
            if (!$_SESSION['member_info']['mail_judge']) {
                $cls = 'deficient_popup';
            }
            else {
                $cls = 'seminar_form';
            }
            return
                '<div class="' . $cls . ' banner-shadow link-btn loading-parent cursor_pointer d-inline-block gtm-click-link target-blank-trigger" data-formid="submitMypage" data-formabout="redirect_from" data-gtm-click="神戸国際会館 こくさいホールチケット申込">
                ' . $content . '
            </div>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // メンバーボード
    if ($attr['service'] == 'member_board') {
        if (strtotime($today) >= strtotime($startday)) {
            return
                '<p class="js_form_btn">
                <a data-formid="member_board_login" class="banner-shadow btn_opacity d-inline gtm-click-link" data-gtm-click="メンバーボード">
                ' . $content . '
                </a>
            </p>';
        }
        else {
            return $limit_startdate_layout;
        }
    }
    // スマホ・タブレット無敵保証
    if ($attr['service'] == 'muteki') {
        return
            '<p class="js_form_btn">
            <a data-formid="submit_muteki" class="banner-shadow btn_opacity d-inline gtm-click-link" data-gtm-click="スマホ・タブレット無敵保証">
            ' . $content . '
            </a>
        </p>';
    }
    // オーダーメイドスーツ 予約フォーム
    if ($attr['service'] == 'suit') {
        return
            '<div class="seminar_form banner-shadow link-btn loading-parent cursor_pointer d-inline-block gtm-click-link" data-formid="submitMypage" data-formabout="order_made_suit" data-gtm-click="オーダーメイドスーツ 予約フォーム">
            ' . $content . '
        </div>';
    }
}
add_shortcode('link_banner', 'create_link_banner');

/*
 * リンクボタン
 * @param  link=  リンク先
 * @param  label= アナリティクスのクリックイベント用のラベル
 * @return string リンクボタン
 */
if (!function_exists('zenkosai_safe_str')) {
    function zenkosai_safe_str($v)
    {
        if (is_array($v)) {
            $flat = array_map(function ($x) {
                return is_scalar($x) ? (string)$x : '';
            }, $v);
            return implode(',', $flat);
        }
        if (is_object($v))
            return '';
        return (string)$v;
    }
}

function ls_link_btn_analytics($atts, $content = null, $tag = '')
{
    $atts = shortcode_atts([
        'tab' => '',
        'label' => '',
        'link' => '',
        'img' => '',
        'img_id' => '',
    ], $atts, $tag ?: 'link_btn_analytics');

    $tab = strtolower(sanitize_text_field(zenkosai_safe_str($atts['tab'])));
    $href = esc_url($atts['link']);

    $label = $atts['label'] !== ''
        ? sanitize_text_field(zenkosai_safe_str($atts['label']))
        : trim(wp_strip_all_tags((string)$content));

    if ($href === '') {
        return '';
    }
    $open_map = ['open', 'new', '1', 'true'];
    $target = in_array($tab, $open_map, true) ? ' target="_blank" rel="noopener"' : '';

    $inner = '';
    if ($content !== null && trim($content) !== '') {
        // ネストしたショートコードを処理し、安全に通す
        $inner = wp_kses_post(do_shortcode($content));
    }
    elseif (!empty($atts['img_id']) && is_numeric($atts['img_id'])) {
        $att_id = (int)$atts['img_id'];
        // wp_get_attachment_image は安全に <img> を返す
        $img_html = wp_get_attachment_image($att_id, 'full', false, array('class' => 'alignnone'));
        if ($img_html) {
            $inner = $img_html;
        }
        else {
            $inner = esc_html($label);
        }
    }
    elseif (!empty($atts['img'])) {
        $img_url = esc_url_raw($atts['img']);
        // 最低限の属性で出力（alt にラベルを入れる）
        $inner = '<img src="' . esc_url($img_url) . '" alt="' . esc_attr($label) . '" class="alignnone" />';
    }
    else {
        $inner = esc_html($label);
    }

    return '<a href="' . $href . '"' . $target . ' class="gtm-click-nkyosai-link" data-gtm-click="' . esc_attr($label) . '"><div class="d-inline">' . $inner . '</div></a>';
}
add_shortcode('link_btn_analytics', 'ls_link_btn_analytics');

// 送信待ちのフォーム情報を一時保存するためのグローバル変数
$my_restricted_forms = [];
function restricted_link_final_func($atts, $content = null)
{
    // グローバル変数から $my_restricted_forms を削除しました
    global $member_id, $en_member_id, $mallid, $mallpw;
    
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
    $m_info = isset($_SESSION['member_info']) ? $_SESSION['member_info'] : [];

    $target_member_id = !empty($member_id) ? $member_id : (isset($m_info['member_id']) ? $m_info['member_id'] : '');

    $a = shortcode_atts(array(
        'url' => '',
        'action' => '',
        'method' => 'post',
        'inputs' => '',
        'gtm_label' => '',
        'target' => '_blank',
        'short_id' => 'false',
        'ignore_role' => 'false',
    ), $atts);

    $content = do_shortcode(shortcode_unautop($content));

    // 権限チェック
    $type = isset($m_info['member_type']) ? $m_info['member_type'] : (isset($m_info['type']) ? $m_info['type'] : '');
    $is_allowed = ($type === 'p_member' || $type === 'k_member');
    if ($a['ignore_role'] === 'true') {
        $is_allowed = true;
    }
    if (!$is_allowed) {
        return '<div class="restricted-img-wrap">' . $content . '<div class="restricted-overlay"><span>契約者のみ<br>お申込みいただけます</span></div></div>';
    }

    // --- フォーム連携モード ---
    if (!empty($a['action'])) {
        $form_id = 'form_' . uniqid();

        $final_member_id = $target_member_id;
        if ($a['short_id'] === 'true') {
            // 文字列の後ろから8文字だけを切り出す
            $final_member_id = substr($target_member_id, -8);
        }

        // 変数リストの準備
        $vars = [
            'EN_MEMBER_ID' => $en_member_id,
            'MALL_ID' => $mallid,
            'MALL_PW' => $mallpw,
            'MEMBER_ID' => $final_member_id,
            'MEMBER_ID_SUBSTR' => substr($final_member_id, -12, 12),
        ];

        // ★ 修正箇所：ここで formタグ と inputタグ を直接組み立てる
        $input_html = '';
        if (!empty($a['inputs'])) {
            $pairs = explode(',', $a['inputs']);
            foreach ($pairs as $pair) {
                $parts = explode(':', trim($pair));
                if (count($parts) === 2) {
                    $name = trim($parts[0]);
                    $val_key = trim($parts[1]);
                    $val = isset($vars[$val_key]) ? $vars[$val_key] : $val_key;
                    $input_html .= '<input type="hidden" name="' . esc_attr($name) . '" value="' . esc_attr($val) . '">';
                }
            }
        }

        $form_html = '<form id="' . esc_attr($form_id) . '" method="' . esc_attr($a['method']) . '" action="' . $a['action'] . '" target="' . esc_attr($a['target']) . '" style="display:none;">' . $input_html . '</form>';

        // 本文には aタグ と 組み立てた formタグ をセットで出力する
        return '<div class="restricted-img-wrap">
                <a href="javascript:void(0);" 
                   onclick="var f=document.getElementById(\'' . esc_attr($form_id) . '\'); if(f){ f.submit(); } return false;" 
                   class="gtm-click-link" 
                   data-gtm-click="' . esc_attr($a['gtm_label']) . '">' . $content . '</a>
            </div>' . $form_html;
    }

    // --- 通常リンクモード ---
    return '<div class="restricted-img-wrap"><a href="' . esc_url($a['url']) . '" target="' . esc_attr($a['target']) . '" class="gtm-click-link" data-gtm-click="' . esc_attr($a['gtm_label']) . '">' . $content . '</a></div>';
}
add_shortcode('restricted_link', 'restricted_link_final_func');

/**
 * ポップアップ開くボタン
 * [popup_btn id="doc-01" class="btn"]ボタンテキスト[/popup_btn]
 */
add_shortcode('popup_btn', function($atts, $content = null) {
    $a = shortcode_atts(array(
        'id' => '',
        'class' => '',
    ), $atts);
    // 既存のJSに合わせてボタンタグを生成
    return '<div class="js-document_popup_btn ' . esc_attr($a['class']) . '"><button type="button" data-type="' . esc_attr($a['id']) . '">' . $content . '</button></div>';
});

/**
 * ポップアップ本体
 * [popup_content id="doc-01" title="見出し" color="#ff0000" checkbox_text="同意します"]説明文[/popup_content]
 */
add_shortcode('popup_content', function($atts, $content = null) {
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    
    // IDが未入力の場合はランダム生成（重複回避のため）
    $id    = !empty($atts['id']) ? $atts['id'] : 'pop-' . bin2hex(random_bytes(4));
    $title = !empty($atts['title']) ? $atts['title'] : '';
    $color = !empty($atts['color']) ? $atts['color'] : '#000';
    
    // checkbox_textのクリーンアップ（ゴミ文字を徹底除去）
    $consent_text = '';
    $raw_text = !empty($atts['checkbox_text']) ? $atts['checkbox_text'] : '';
    if (!$raw_text) {
        foreach ((array)$atts as $val) {
            if (is_string($val) && (strpos($val, '内容') !== false || strpos($val, '確認') !== false)) {
                $raw_text = $val;
                break;
            }
        }
    }
    
    // タグや引用符の残骸を削除
    $consent_text = strip_tags($raw_text);
    $consent_text = preg_replace('/^[^>]*">/', '', $consent_text);
    $consent_text = str_replace(array('"', "'"), '', $consent_text);
    $consent_text = trim($consent_text);

    // コンテンツを「内容」と「リンクショートコード」に分離
    $pattern = '/(\[restricted_link.*?\][\s\S]*?\[\/restricted_link\])/';
    $parts = preg_split($pattern, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
    
    $main_text = isset($parts[0]) ? $parts[0] : '';
    $link_code = isset($parts[1]) ? $parts[1] : '';

    $style = '
        <style>
            #' . esc_attr($id) . '.document { 
                z-index: 10001 !important;
                padding-top: .25rem;
                top: 0; bottom: 0; left: 0; right: 0;
                max-width: 95%;
            }
            #' . esc_attr($id) . ' .document_popup_tit { border-bottom: 2px solid ' . esc_attr($color) . '; }
            #' . esc_attr($id) . ' .procedure_popup__close .rounded-pill { 
                border: 1px solid ' . esc_attr($color) . '; 
                color: ' . esc_attr($color) . '; 
                cursor: pointer;
            }
            .popup-consent-wrap {
                margin: 20px 0 !important;
                padding: 15px !important;
                background: #fffce7 !important;
                border: 1px solid #ffcc00 !important;
                border-radius: 5px !important;
                display: block !important;
            }
            .popup-consent-wrap label {
                display: flex !important;
                align-items: center !important;
                cursor: pointer !important;
                font-weight: bold !important;
                margin: 0 !important;
            }
            .js-popup-agree-check {
                width: 22px !important; height: 22px !important;
                margin-right: 12px !important; cursor: pointer !important;
                flex-shrink: 0;
            }
            .restricted-overlay {
                min-height: 6vh !important;
            }
        </style>
    ';

    $checkbox_html = '';
    $wrapper_class = '';
    if ($consent_text !== '') {
        $wrapper_class = 'has-consent-check';
        $checkbox_html = '
            <div class="popup-consent-wrap">
                <label>
                    <input type="checkbox" class="js-popup-agree-check">
                    <span class="consent-text">' . esc_html($consent_text) . '</span>
                </label>
            </div>';
    }

    $close_btn = '
        <div class="js-procedure_popup__close procedure_popup__close position-static">
            <div class="rounded-pill"><span class="pr-3">×</span>閉じる</div>
        </div>';

    // 順番通りに出力： 1.メイン内容 2.チェックボックス 3.リンク（ボタン）
    return $style . '
    <div class="js-procedure_popup procedure_popup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; z-index:10000;">
        <div class="js-procedure_popup__bg procedure_popup__bg" style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.7); cursor:pointer;"></div>
        <div id="' . esc_attr($id) . '" class="js-doc_modal document ' . $wrapper_class . '">
            <div class="document_popup_tit" style="padding:15px;">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0" style="font-weight:bold; font-size:1.2rem;">' . esc_html($title) . '</p>
                    <div>' . $close_btn . '</div>
                </div>
            </div>
            <div class="document_detail" style="padding:20px; overflow-y:auto; max-height:75vh;">
                <div class="document_detail__txt">' . do_shortcode($main_text) . '</div>
                ' . $checkbox_html . '
                <div class="document_detail__link" style="margin-top:15px;">' . do_shortcode($link_code) . '</div>
            </div>
        </div>
    </div>';
});

/**
 * 1. リンク設置タグ
 * [page_link url="#about"]テキスト[/page_link]
 */
add_shortcode('page_link', function($atts, $content = null) {
    $a = shortcode_atts(array('url' => ''), $atts);
    if (!empty($a['url'])) {
        return '<a href="' . esc_attr($a['url']) . '">' . $content . '</a>';
    }
    return $content;
});

/**
 * 2. 掲載内容設置タグ（アンカー遷移先）
 * [page_link_content url="#about"]内容[/page_link_content]
 */
add_shortcode('page_link_content', function($atts, $content = null) {
    $a = shortcode_atts(array('url' => ''), $atts);

    $target_id = '';
    if (!empty($a['url'])) {
        $fragment = parse_url($a['url'], PHP_URL_FRAGMENT);
        $target_id = $fragment ? $fragment : ltrim($a['url'], '#');
    }

    if (!empty($target_id)) {
        /**
         * 【解説】
         * 外枠を position: relative にし、
         * 中に id を持った span を position: absolute で「上に150px」浮かせて配置します。
         * ブラウザはこの span を目指してジャンプするため、結果的にコンテンツがヘッダーの下に綺麗に収まります。
         */
        return '
        <div class="js-anchor-wrapper" style="position: relative; clear: both;">
            <span id="' . esc_attr($target_id) . '" 
                  style="position: absolute; top: -100px; visibility: hidden; pointer-events: none;">
            </span>
            <div class="js-anchor-content">
                ' . do_shortcode($content) . '
            </div>
        </div>';
    }
    return do_shortcode($content);
});

function add_custom_anchor_script() {
    static $printed = false;
    if ($printed) return;
    $printed = true;
    ?>
    <script>
    jQuery(function($) {
        // 合計のヘッダー高さを計算する関数（既存ロジックをベースに作成）
        function getCalculatedHeaderHeight() {
            var pcTopUp = $('.siteHeader').outerHeight() || 0;
            var pcTopAnnounce = $('.header-announce').outerHeight() || 0;
            var pcTopUnder = 0;

            if ($('.page-header').length) {
                if ($('#page-lifesupport .page-header').length) {
                    pcTopUnder = $('.page-header').outerHeight() + 80;
                } else if ($('.page-seminar-movie .page-header').length) {
                    pcTopUnder = $('.page-header').outerHeight() + ($('.flame-body.first').outerHeight() || 0);
                } else {
                    pcTopUnder = $('.page-header').outerHeight();
                }
            }

            // 全ての合計 ＋ 少しの余白(30px)
            return pcTopUp + pcTopAnnounce + pcTopUnder + 30;
        }

        function smoothScrollTo(hash) {
            var $target = $(hash);
            if ($target.length) {
                var offset = getCalculatedHeaderHeight();
                var position = $target.offset().top - offset;

                $('html, body').stop().animate({
                    scrollTop: position
                }, 500, 'swing');
            }
        }

        // クリック時
        $(document).on('click', '.js-page-link', function(e) {
            var href = $(this).attr('href');
            if (href.indexOf('#') !== -1) {
                var hash = href.substring(href.indexOf('#'));
                if ($(hash).length) {
                    e.preventDefault();
                    smoothScrollTo(hash);
                    if (history.pushState) history.pushState(null, null, hash);
                }
            }
        });

        // ページ読み込み時（アンカーがある場合）
        $(window).on('load', function() {
            var hash = window.location.hash;
            if (hash && $(hash).length) {
                window.scrollTo(0, 0);
                setTimeout(function() {
                    smoothScrollTo(hash);
                }, 200);
            }
        });
    });
    </script>
    <?php
}

/*
 * ライフサポートサービス利用方法アコーディオン
 * @param app= 利用申請方法
 * @param title= タイトル
 * @return string アコーディオン
 */
function detail_app_accordion($atts, $content = null)
{
    $content = do_shortcode(shortcode_unautop($content)); //ショートコードの入れ子があっても実行する
    // $img = '';
    if ($atts['app'] == 'net') { //インターネット
        $img = '
        <div class="step-content__detail__app__title__item__icon">
            <img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_net.png">
        </div>';
    }
    if ($atts['app'] == 'form') { //利用申請書
        $img = '
        <div class="step-content__detail__app__title__item__icon">
            <img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_form.png">
        </div>';
    }
    if ($atts['app'] == 'other') { //インターネット以外
        $img = '
        <div class="step-content__detail__app__title__item__icon">
            <img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_fax.png">
        </div>
        <div class="step-content__detail__app__title__item__icon">
            <img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_tel.png">
        </div>
        <div class="step-content__detail__app__title__item__icon">
            <img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_mail.png">
        </div>';
    }
    if ($atts['app'] == 'line') { //LINE
        $img = '
        <div class="step-content__detail__app__title__item__icon">
            <img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_tel.png">
        </div>';
    }

    return
        '<div class="step-content__detail__app">
        <div class="step-content__detail__app__title acor-menu mb-2">
            <div class="step-content__detail__app__title__item">
                ' . $img . '
                <div class="step-content__detail__app__title__item__name">
                    ' . $atts['title'] . '
                </div>
            </div>
        </div>
        <div class="step-content__detail__app__detail acor-menu-child">
            <div class="step-content__detail__app__detail__txt">
                ' . $content . '
            </div>
        </div>
    </div>';
}
add_shortcode('detail_app', 'detail_app_accordion');

/*
 * ライフサポートサービス利用方法アコーディオン 入れ子の中身
 * @param app= 利用申請方法
 * @param title= タイトル
 * @return string アコーディオン
 */
function detail_app_other_accordion($atts, $content = null)
{
    $content = do_shortcode(shortcode_unautop($content)); //ショートコードの入れ子があっても実行する
    $img = '';
    if ($atts['app'] == 'fax') { //FAX
        $img = '<img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_fax.png">';
    }
    if ($atts['app'] == 'mail') { //メール
        $img = '<img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_mail.png">';
    }
    if ($atts['app'] == 'tel') { //電話
        $img = '<img src="' . get_stylesheet_directory_uri() . '/assets/images/lifesupport/app_tel.png">';
    }

    return
        '<div class="application-item acor-menu">
            <div class="application-item__detail">
                <div class="application-item__detail__icon">
                    ' . $img . '
                </div>
                <div class="application-item__detail__title">
                    ' . $atts['title'] . '
                </div>
            </div>
        </div>
        <div class="application-item acor-menu-child">
            ' . $content . '
        </div>';
}
add_shortcode('detail_app_other', 'detail_app_other_accordion');

/*
 * ライフサポートサービス利用方法 注意書き
 * @return string 注意書き
 */
function attention_box($atts, $content = null)
{
    $content = do_shortcode(shortcode_unautop($content)); //ショートコードの入れ子があっても実行する
    return '<div class="step-content__detail__note">' . $content . '</div>';
}
add_shortcode('attention_text', 'attention_box');

/*
 * ライフサポートサービス タブ切り替え
 * @param app= 利用申請方法
 * @param title= タイトル
 * @return string タブ
 */
// タブの囲み
function lifesupport_tab_wrap($atts, $content = null)
{
    $content = do_shortcode(shortcode_unautop($content)); //ショートコードの入れ子があっても実行する
    return '<div class="tab-wrap js-auto-nameadd">' . $content . '</div>';
}
add_shortcode('tab_wrap', 'lifesupport_tab_wrap');

// タイトル
function lifesupport_tab_content($atts, $content = null)
{
    $content = do_shortcode(shortcode_unautop($content)); //ショートコードの入れ子があっても実行する
    $title = $atts['title'];

    return
        '<input type="radio" class="tab-switch js-auto-input-nameadd">
        <label class="tab-label mb-0 text-center"><span>' . $title . '</span></label>
        <div class="tab-content">
            <div>
                ' . $content . '
            </div>
        </div>';
}
add_shortcode('tab', 'lifesupport_tab_content');

/*
 * 各種変更手続き ポップアップボタン
 * @param title= タイトル
 * @param popup= ポップアップの内容
 * @return string ボタン
 */
function procedure_popup_btn($atts, $content = null)
{
    $popup = $atts['popup'];
    return
        '<div class="js-document_popup_btn document_popup_btn">
            <button class="d-flex align-items-center justify-content-between" data-type="doc-' . $popup . '">
                <span class="d-block">' . $content . '</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>';
}
add_shortcode('procedure_popup', 'procedure_popup_btn');

/*-------------------------------------------*/
/*  ショップサイト
 /*-------------------------------------------*/
if (!defined('HL_INTEGRATION_API_URL')) {
    define('HL_INTEGRATION_API_URL', 'https://hayateuat-bff-sandbox-jp.insuremo.jp/api/hayateuat/hayate-ext-bff/bff/integration/NWEB162');
}
if (!defined('HL_APPLICATION_REDIRECT_BASE')) {
    define('HL_APPLICATION_REDIRECT_BASE', 'https://hayateuat-bff-sandbox-jp.insuremo.jp/application/#/auth/login?member_id=');
}
function add_link_form()
{
    require_once('/var/www/html/cms/wp-load.php');
    global $wpdb;
    global $mypage_directori;
    if ($_SESSION['member_info']) {
        $member_id = $_SESSION['member_info']['member_id'];
        $member_id = substr($member_id, -8, 8);
        $member_pw = $_SESSION['member_info']['member_pw_pre'];
        $mallid = $_SESSION['member_info']['mallid'];
        $mallpw = $_SESSION['member_info']['mallpass'];
        $password = 'ZenkosaiOpenSSLEncrypt';
        $en_member_id = _encrypt($member_id, $password);

        // PDFビューワーのポップアップブロック回避
        $blank = '_blank';
        if (is_page('redirect') || is_page('sso-gate')) {
            $blank = '_self'; // SSO時は同じタブで開く
        }

        // 全厚済OFFTIME
        echo '<form id="submit_offTime" method="post" action="https://www.club-off.com/zenkousai/index.cfm" target="' . $blank . '">
                <input id="U" type="hidden" name="U" value="' . $member_id . '">
            </form>';
        // 全厚済モール
        echo '<form id="submit_mall" method="post" action= "https://Nkyosai3120.shopcloud.jp/front/login/login/" target="' . $blank . '">
                 <input type="hidden" name="loginId" value="' . $mallid . '">
                 <input type="hidden" name="password" value="' . $mallpw . '">
             </form>';
        // echo'<form id="submit_mall" method="post" action= "https://Nkyosai3120.shopcloud.jp/front/login/login/" target="_blank">
        //        <input type="hidden" name="loginId" value="fiPEWxItZ+GUG5X6L+AToA==">
        //        <input type="hidden" name="password" value="bmtdivbP+R2JrQ8Je/PSSw==">
        //    </form>';
        // フレンドショップ
        echo '<form id="submit_fs_shop" method="get" action= "https://friend-shop.org/" target="' . $blank . '">
                <input type="hidden" name="member_id" value="' . $en_member_id . '">
            </form>';
        // 販促品
        echo '<form id="submit_shop" method="post" action= "https://kyosai.shopcloud.jp/front2/login/login" target="' . $blank . '">
                <input type="hidden" name="loginId" value="' . $mallid . '">
                <input type="hidden" name="password" value="' . $mallpw . '">
            </form>';
        // メンバーボード用
        echo '<form id="member_board_login" action="https://zenko-sai-memberboard.com/login-with-api" method="post" target="' . $blank . '" hidden>
                <input type="text" name="member_id" value="' . substr($_SESSION['member_info']['member_id'], -12, 12) . '">
            </form>';
        // スマホ・タブレット無敵保証
        echo '<form id="submit_muteki" method="post" action= "https://zenkousai-muteki.com/" target="' . $blank . '">
                <input type="hidden" name="memberid" value="' . $en_member_id . '">
            </form>';
        // Leminoセレクション
        echo '<form id="submit_lemino_selection" method="post" action="https://serial.lemino.docomo.ne.jp/" target="' . $blank . '">
                <input type="hidden" name="campaign_code" value="20678">
                <input type="hidden" name="linkage_identifier" value="' . htmlspecialchars($member_id, ENT_QUOTES, "UTF-8") . '">
            </form>';
        // Leminoプレミアム初回
        echo '<form id="submit_lemino_premium" method="post" action="https://stg.serial-payment.com/api/login?companyId=19&price_id=price_1ShOp9FwNTb9Nt00XgF1zhVR" target="' . $blank . '">
                <input type="hidden" name="campaign_code" value="77798">
                <input type="hidden" name="linkage_identifier" value="' . htmlspecialchars($member_id, ENT_QUOTES, "UTF-8") . '">
            </form>';

        // マイページ・ビジネス連携用
        $password = 'ZenkosaiOpenSSLEncrypt';
        $user_name = sprintf('%012d', $member_id);
        $en_user_name = _encrypt($user_name, $password);
        $en_user_pass = $member_pw;
        // ユーザーエージェント識別
        $user_agent = 'PC';
        if (is_mobile()) {
            $user_agent = 'SP';
        }

	        echo '<form id="submitMypage" action="' . esc_url($mypage_directori) . '" method="post" accept-charset="utf-8">';
	        $mypage_member_info = isset($_SESSION['mypage_member_info']) && is_array($_SESSION['mypage_member_info'])
	            ? $_SESSION['mypage_member_info']
	            : [];
	        if (empty($mypage_member_info)) {
	            //ログインAPI
	            $url = $mypage_directori . '/api/new-poral-login/';
            // 渡したいパラメータ
            $params =
            [
                'member_id' => $en_user_name,
                'password' => $en_user_pass,
                'user_agent' => $user_agent,
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, TRUE);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // パラメータをセット
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

            //APIレスポンス処理（JSON)
            // レスポンスを変数に入れる
            $response = curl_exec($curl);
            $response_info = curl_getinfo($curl); //結果に関する情報を格納
            $response_code = $response_info['http_code']; //通信結果のHTTPステータスコード
            $response_header_size = $response_info['header_size']; //通信結果のヘッダサイズ

	            // JSON連想配列へ変換
	            $arr = json_decode($response, true);
	            if (is_array($arr) && isset($arr['member_info']) && is_array($arr['member_info'])) {
	                $mypage_member_info = $arr['member_info'];
	                $_SESSION['mypage_member_info'] = $mypage_member_info;
	            }
	            curl_close($curl);
	        }
	        foreach ($mypage_member_info as $key => $value) {
	            echo '<input type="hidden" name="' . $key . '" value="' . $value . '">';
	        }

	        // サイト側のカスタムフィールドで設定した文章を、マイページへ表示する
        $mypage_page_data = get_page_by_path('file-download');
        $mypage_page_id = $mypage_page_data->ID;
        $request_text = CFS()->get('request_text', $mypage_page_id);
        $info_text = CFS()->get('info_text', $mypage_page_id);
        $cancel_text = CFS()->get('cancel_text', $mypage_page_id);
        $document_text = CFS()->get('document_text', $mypage_page_id);

        echo '<div id="mypage_only_date">
            <input type="hidden" name="request_text" value="' . $request_text . '">
            <input type="hidden" name="info_text" value="' . $info_text . '">
            <input type="hidden" name="cancel_text" value="' . $cancel_text . '">
            <input type="hidden" name="document_text" value="' . $document_text . '">
            </div>
        ';
        echo '</form>';

        $hl_action = esc_url(home_url('/insurance/comeback/'));
        $nonce = function_exists('wp_create_nonce') ? wp_create_nonce('hl_redirect') : '';
        $blank_attr = isset($blank) ? esc_attr($blank) : '_blank';
        echo '<form id="submit_hl" method="post" action="' . esc_attr($hl_action) . '" target="' . $blank_attr . '" style="display:none;">';
        echo '<input type="hidden" name="hl_nonce" value="' . esc_attr($nonce) . '">';
        echo '<input type="hidden" name="encryptedMemberId" value="' . esc_attr($en_member_id) . '">';
        echo '</form>';
    }

    if (!empty($_SESSION['member_info']) && !empty($_GET['target'])) {
        $target_key = esc_attr($_GET['target']);
        $deep_link_url = !empty($_GET['url']) ? esc_url_raw($_GET['url']) : '';

        // 【URLキー => [フォームID, aboutパラメータ, 外部サイト用URLパラメータ名]】
        $form_configs = [
            'offtime' => ['id' => 'submit_offTime', 'about' => '', 'param_name' => 'RELO_URL'],
            'mall' => ['id' => 'submit_mall', 'about' => '', 'param_name' => 'redirect_url'],
            'fs' => ['id' => 'submit_fs_shop', 'about' => '', 'param_name' => 'redirect_to'], // ここにパラメータ名を追加
            'shop' => ['id' => 'submit_shop', 'about' => '', 'param_name' => ''],
            'member_board' => ['id' => 'member_board_login', 'about' => '', 'param_name' => ''],
            'muteki' => ['id' => 'submit_muteki', 'about' => '', 'param_name' => ''],
            'lemino-sel' => ['id' => 'submit_lemino_selection', 'about' => '', 'param_name' => ''],
            'lemino-pre' => ['id' => 'submit_lemino_premium', 'about' => '', 'param_name' => ''],
            'hl' => ['id' => 'submit_hl', 'about' => '', 'param_name' => ''],
            'mypage' => ['id' => 'submitMypage', 'about' => '', 'param_name' => ''],
            'life-seminar' => ['id' => 'submitMypage', 'about' => 'life_seminar', 'param_name' => ''],
            'convention' => ['id' => 'submitMypage', 'about' => 'redirect_from', 'param_name' => ''],
            'geo_arena' => ['id' => 'submitMypage', 'about' => 'redirect_to', 'param_name' => ''],
            'suit' => ['id' => 'submitMypage', 'about' => 'order_made_suit', 'param_name' => ''],
        ];

        if (isset($form_configs[$target_key])) {
            $config = $form_configs[$target_key];
            $form_id = $config['id'];
            $about_val = $config['about'];
            $param_name = $config['param_name']; // configが確定した後に取得
?>
<style>
    body.pagename-sso-gate,
    body.pagename-sso {
        visibility: hidden !important;
        background: #fff !important;
    }

    #sso-loading-overlay {
        visibility: visible !important;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999999;
    }
</style>
<div id="sso-loading-overlay">
    <div>
        <p>自動ログイン処理中...</p>
    </div>
</div>

<script>
    jQuery(function ($) {
        const $targetForm = $('#<?php echo $form_id; ?>');
        if ($targetForm.length) {
            const targetKey = '<?php echo esc_js($target_key); ?>';
            const deepLinkUrl = '<?php echo esc_js($deep_link_url); ?>';
            const paramName = '<?php echo esc_js($param_name); ?>';

            // 1. 【fs専用】送信先(action)を直接書き換える（窓口がどこでも良いサイト用）
            if (deepLinkUrl && targetKey === 'fs') {
                $targetForm.attr('action', deepLinkUrl);
            }

            // 2. 【offtime等】外部サイト用パラメータの追加（窓口が固定されているサイト用）
            // fs以外で、かつparam_name(RELO_URL等)が設定されている場合に実行
            if (deepLinkUrl && paramName && targetKey !== 'fs') {
                $targetForm.find('input[name="' + paramName + '"]').remove();
                $targetForm.append('<input type="hidden" name="' + paramName + '" value="' + deepLinkUrl + '">');
            }

                    // 3. aboutパラメータが必要な場合は動的に追加（マイページ系）
                    <? php if ($about_val): ?>
                $targetForm.find('input[name="about"]').remove();
            $targetForm.append('<input type="hidden" name="about" value="<?php echo esc_js($about_val); ?>">');
                    <? php
            endif; ?>

                // 送信実行
                $targetForm.attr('target', '_self').submit();
        }
    });
</script>
<?php
        }
    }
}
add_action('wp_footer', 'add_link_form', 99);

function hl_nonce_data_attr()
{
    if (function_exists('wp_create_nonce')) {
        $nonce = wp_create_nonce('hl_redirect');
        return 'data-hl-nonce="' . esc_attr($nonce) . '"';
    }
    return '';
}

function hl_nonce_input()
{
    if (function_exists('wp_create_nonce')) {
        $nonce_field = '<input type="hidden" name="hl_nonce" value="' . esc_attr(wp_create_nonce('hl_redirect')) . '">';
        $trigger_field = '<input type="hidden" name="hl_apply_submit" value="1">';
        
        return $nonce_field . $trigger_field;
    }
    return '';
}

/*-------------------------------------------*/
/*  ファンクション
 /*-------------------------------------------*/

/*
 * エンコード処理実行
 * @param  string $str エンコード対象文字列
 * @param  string $password パスワード
 * @return string エンコードした文字列
 */
function _encrypt($str, $password)
{
    // Set a random salt
    $salt = openssl_random_pseudo_bytes(16);

    $salted = '';
    $dx = '';
    // Salt the key(32) and iv(16) = 48
    while (strlen($salted) < 48) {
        $dx = hash('sha256', $dx . $password . $salt, true);
        $salted .= $dx;
    }

    $key = substr($salted, 0, 32);
    $iv = substr($salted, 32, 16);

    $encrypted_data = openssl_encrypt($str, 'AES-256-CBC', $key, true, $iv);
    return base64_encode($salt . $encrypted_data);
}

/*
 * デコード処理実行
 * @param  string $estr エンコードされている文字列
 * @param  string $password パスワード
 * @return string デコードした文字列
 */
function _decrypt($estr, $password)
{
    $str = base64_decode($estr);
    $salt = substr($str, 0, 16);
    $ct = substr($str, 16);

    $rounds = 3; // depends on key length
    $data00 = $password . $salt;
    $hash = array();
    $hash[0] = hash('sha256', $data00, true);
    $result = $hash[0];
    for ($i = 1; $i < $rounds; $i++) {
        $hash[$i] = hash('sha256', $hash[$i - 1] . $data00, true);
        $result .= $hash[$i];
    }
    $key = substr($result, 0, 32);
    $iv = substr($result, 32, 16);

    return openssl_decrypt($ct, 'AES-256-CBC', $key, true, $iv);
}

/*
 * コンソールログ処理実行
 * @param  string $data 表示したいstr
 */
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

// 連想配列の値でソート
function sortByKey($key_name, $sort_order, $array)
{
    foreach ($array as $key => $value) {
        $standard_key_array[$key] = $value[$key_name];
    }
    array_multisort($standard_key_array, $sort_order, $array);
    return $array;
}

// ログインしているか判断
function is_user_loggedin()
{
    session_start();
    if ($_SESSION['member_info']) {
        return true;
    }
    else {
        return false;
    }
}

// pタグを自動挿入させない
add_action('init', function () {
    remove_filter('the_excerpt', 'wpautop');
    remove_filter('the_content', 'wpautop');
});
add_filter('tiny_mce_before_init', function ($init) {
    $init['wpautop'] = false;
    $init['apply_source_formatting'] = true;
    return $init;
});

/*
 * ライフサポートサービスAPI
 *
 * @param string $search_type　検索条件
 * 'default': サービスカテゴリー＋サービス＋申請書類有効
 * 'all': サービスカテゴリー＋サービス
 * 'cate': サービスカテゴリー
 * 'srv': サービス
 * @param int $return_type 返す型
 * @param int $check_doc 書類有無
 * @return object
 */
function get_lifesupportservice_data($search_type, $return_type, $check_doc = true)
{
    // return type
    $RETURN_JSON = 1;
    $RETURN_ARRAY = 2;

    // search type
    $SEARCH_DEFAULT = 'default';
    $SEARCH_ALL = 'all';
    $SEARCH_CATE = 'cate';
    $SEARCH_SRV = 'srv';
    $result = array();
    $srvResult = array();
    $cat_count = -1;
    // カテゴリ取得
    $catargs = array(
        'taxonomy' => 'lifesupport_cat',
    );
    $catlists = get_categories($catargs);

    foreach ($catlists as $cat):
        $post_count = 0;
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'lifesupport',
            'lifesupport_cat' => $cat->slug,
            'order' => 'ASC'
        );
        $my_posts = get_posts($args);
        // カテゴリ毎の投稿取得
        if ($my_posts) {
            foreach ($my_posts as $post):
                setup_postdata($post);
                if ($post->post_name == 'list') {
                    continue;
                }
                $exist_doc_flg = false;
                // 投稿毎の申請書有無チェック
                $add_service = CFS()->get('add_service', $post->ID);
                $new_dl_form = CFS()->get('new_dl_form', $post->ID);
                $new_document = CFS()->get('new_document', $post->ID);
                if ($check_doc) {
                    if ($add_service[0]['dl_form'] || $new_dl_form) {
                        // 在宅福祉用具レンタル利用料補助、全厚済メディカルコールセンターは近日サービス終了のため非表示に
                        // if ($post->post_name != 'lifesupport-medical-call-center' && $post->post_name != 'nursing-support' ) {
                        if (!$new_document) {
                            $exist_doc_flg = true;
                        }
                    // }
                    }
                }
                if (!$check_doc || $exist_doc_flg) {
                    $post_count = $post_count + 1;
                    if ($post_count == 1) {
                        $cat_count++;
                        $result[$cat_count]['post_list'] = array();
                        $result[$cat_count]['cat_id'] = $cat->cat_ID;
                        $result[$cat_count]['cat_slug'] = $cat->category_nicename;
                        $result[$cat_count]['cat_name'] = $cat->name;
                    }
                    $result[$cat_count]['post_list'][$post_count]['id'] = $post->ID;
                    $result[$cat_count]['post_list'][$post_count]['slug'] = $post->post_name;
                    $result[$cat_count]['post_list'][$post_count]['name'] = get_the_title($post->ID);
                }
            endforeach;
        }
        wp_reset_postdata();
    endforeach;

    if ($return_type === $RETURN_JSON) {
        return json_encode($result);
    }
    if ($return_type === $RETURN_ARRAY) {
        return $result;
    }
}

/*
 * 社会貢献活動API
 *
 */
function get_socialcontribution_data($search_type, $return_type, $check_doc = true)
{
    // return type
    $RETURN_JSON = 1;
    $RETURN_ARRAY = 2;

    // search type
    // $SEARCH_DEFAULT = 'default';
    // $SEARCH_ALL = 'all';
    // $SEARCH_CATE = 'cate';
    // $SEARCH_SRV = 'srv';
    $result = array();
    // $srvResult = array();
    $cat_count = -1;
    $post_count = 0;
    // カテゴリ取得
    $catargs = array(
        'taxonomy' => 'csr_cat',
    );
    $catlists = get_categories($catargs);

    if ( !empty($catlists) && !is_wp_error($catlists) ) {
        foreach ($catlists as $cat):
            if ($cat->category_nicename === 'csr-topics') {
                continue;
            }

            // 【修正3】$exist_doc_flg の代わりの判定処理が必要
            // ※とりあえずエラーを回避するため true にしていますが、本来の要件に合わせて直してください
            $exist_doc_flg = true; 

            if (!$check_doc || $exist_doc_flg) {
                $post_count++; // (スッキリ書けます)
                
                if ($post_count == 1) {
                    $cat_count++;
                    $result[$cat_count]['post_list'] = array();
                    $result[$cat_count]['cat_id'] = '1';
                    $result[$cat_count]['cat_slug'] = 'social-contribution';
                    $result[$cat_count]['cat_name'] = '社会貢献活動';
                }
                $result[$cat_count]['post_list'][$post_count]['id'] = $cat->cat_ID;
                $result[$cat_count]['post_list'][$post_count]['slug'] = $cat->category_nicename;
                $result[$cat_count]['post_list'][$post_count]['name'] = $cat->name;
            }
        endforeach;
    }

    if ($return_type === $RETURN_JSON) {
        return json_encode($result);
    }
    return $result;
}

/**
 * フォームのプルダウンの値を出力する
 * @param array $children select配下のoption値
 * @return array $atts フォームの要素
 */
function set_select_children($children, $atts)
{
    $search_type = 'default';
    $return_type = 2;

    // 対象プルダウン
    $targetAttr = array(
        'select_service_01',
        'select_service_02',
        'select_service_03',
    );

    if (in_array($atts['name'], $targetAttr)) {
        $children = array();
        $children[] = '選択してください';
        $result = get_lifesupportservice_data($search_type, $return_type);
        foreach ($result as $child) {
            $optGroupName = 'optgroup-' . $child['cat_name'];
            $children[] = $optGroupName;
            foreach ($child['post_list'] as $value) {
                $children[] = $value['name'];
            }
            $children[] = '/' . $optGroupName;
        }
    }
    return $children;
}
add_filter('mwform_choices_mw-wp-form-1884', 'set_select_children', 10, 2);

/*------------------------
 体験談検索
 ------------------------*/
function search_experience($paged)
{
    session_start();

    // ページ遷移元が体験談一覧ページの場合のみセッションを保持、それ以外は破棄
    $referer = $_SERVER['HTTP_REFERER'];
    $url = parse_url($referer);
    $path = $url['path'];
    $search_cat = $_GET["search"];
    $parent_cat = $_GET["parent"];

    if ($search_cat && $parent_cat) {
        $_SESSION['experience'] = array(
            'search_lifesupport' => $search_cat,
            'search_lifesupport_cat' => $parent_cat,
            // 'search_photo' => 'photo_all',
            // 'search_use_date_from' => '',
            // 'search_use_date_to' => '',
            'search_member_benefits' => '',
        );
    }
    elseif ($path !== '/service-experience/') {
        unset($_SESSION['experience']);
    }

    // 検索時の状態をセッションに退避
    $condition_change = 0;
    foreach ($_POST as $key => $value) {
        if (!$_SESSION['experience'][$key] || $_SESSION['experience'][$key] !== $_POST[$key]) {
            $_SESSION['experience'][$key] = $_POST[$key];
            // 検索条件が変わった時１ページ目から
            $condition_change = 1;
        }
    }
    if ($condition_change == 1) {
        wp_redirect(home_url('service-experience'));
        exit;
    }

    $args = array(
        'posts_per_page' => 10, //表示件数
        'paged' => $paged,
        'orderby' => array('term_order' => 'ASC', 'date' => 'DESC'), // Category Order and Taxonomy Terms Order を使用
        'post_type' => array('service-experience'),
        'post_status' => 'publish', //公開状態
    );

    //投稿ID指定
    if ($_GET["post_id"]) {
        $args['p'] = $_GET["post_id"];
    //検索条件指定
    }
    else {
        //ライフサポートサービス指定
        if (!empty($_SESSION['experience']['search_lifesupport'])) {
            // 投稿ID（サービスID）を指定して検索（＝サービス名Aを直接検索）
            $args['meta_query'][] = [
                'key' => 'service',
                'value' => $_SESSION['experience']['search_lifesupport'],
                'compare' => '=',
            ];
        }
        elseif (!empty($_SESSION['experience']['search_lifesupport_cat'])) {
            // サービスカテゴリーから対象のサービス投稿IDを抽出
            $cat_args = array(
                'posts_per_page' => -1,
                'post_type' => 'lifesupport',
                'tax_query' => array(
                        array(
                        'taxonomy' => 'lifesupport_cat',
                        'field' => 'slug',
                        'terms' => $_SESSION['experience']['search_lifesupport_cat'],
                    ),
                ),
            );
            $my_posts = get_posts($cat_args);
            $lifesupport = array();
            foreach ($my_posts as $post) {
                $lifesupport[] = $post->ID;
            }

            if (!empty($lifesupport)) {
                $args['meta_query'][] = [
                    'key' => 'service',
                    'value' => $lifesupport,
                    'compare' => 'IN',
                ];
            }
        }

        // 満足度（指定されていて "全て" 以外なら）
        if (!empty($_SESSION['experience']["search_member_benefits"]) && $_SESSION['experience']["search_member_benefits"] !== 'member_benefits_all') {
            $args['meta_query'][] = [
                'key' => 'member_benefits',
                'value' => $_SESSION['experience']["search_member_benefits"],
                'compare' => '=',
            ];
        }
    }

    $csr_topics_term = get_term_by('slug', 'csr-topics', 'csr_cat');
    if ($csr_topics_term) {
        $args['tax_query'][] = array(
            'taxonomy' => 'csr_cat',
            'field' => 'term_id',
            'terms' => array($csr_topics_term->term_id),
            'operator' => 'NOT IN',
        );
    }

    $wp_query = new WP_Query($args);

    $post_info = array();
    $posts = array();
    while ($wp_query->have_posts()):
        $wp_query->the_post();
        $post = array();
        $post['id'] = get_the_ID();
        $post['permalink'] = get_the_permalink();
        $post['name'] = get_the_title();
        $post['post_date'] = get_the_date();
        $post['icon_image'] = get_field('icon_image');
        $post['prefecture'] = get_field('prefecture');
        $post['age'] = get_field('age');
        if ($post['age'] == '非公開') {
            $post['age'] = '年齢非公開';
        }
        $post['service'] = get_field('service')->post_title;
        $post['service_id'] = get_field('service')->ID;
        $cat = get_the_terms(get_field('service')->ID, 'lifesupport_cat');
        //		$post['service_obj'] = get_field('service');
//		$post['cat_obj'] =$cat;
        $post['service_cat'] = $cat[0]->name;
        $use_date = str_split(get_field('use_date'), 4);
        $post['use_date'] = $use_date[0] . '年' . $use_date[1] . '月';
        $post['user'] = get_field('user');
        $post['experience'] = get_field('experience');
        $post['image1'] = get_field('image1');
        $post['image2'] = get_field('image2');
        $post['image3'] = get_field('image3');
        if ($post['image1'] || $post['image2'] || $post['image3']) {
            if (mb_strlen($post['experience'], 'UTF-8') > 30) {
                $post['experience_overview'] = mb_substr($post['experience'], 0, 36, 'UTF-8') . '…';
            }
            else {
                $post['experience_overview'] = $post['experience'];
            }
        }
        else {
            if (mb_strlen($post['experience'], 'UTF-8') > 30) {
                $post['experience_overview'] = mb_substr($post['experience'], 0, 108, 'UTF-8') . '…';
            }
            else {
                $post['experience_overview'] = $post['experience'];
            }
        }
        $post['guid'] = get_the_guid();
        $post['member_benefits'] = get_field('member_benefits');

        $posts[] = $post;
    endwhile;
    $post_info = $wp_query;
    $post_info->posts = [];
    $post_info->posts = $posts;
    return $post_info;
}

/*------------------------
 利用日リスト取得
 ------------------------*/
function get_use_date()
{
    $disp_month_num = 36;
    $current_month = date("Y-m");
    $month_firstday = strtotime($current_month . "-1");

    $firstday = $month_firstday;
    for ($i = 0; $i < $disp_month_num; $i++) {
        echo '<option value="' . date("Ym", $firstday) . '">' . date("Y年m月", $firstday) . '</option>';
        $firstday = strtotime("-1 month", $firstday);
    }
}

/*------------------------
 体験談投稿 ご利用サービス名（管理画面）
 ------------------------*/
// カスタムフィールドの追加
add_action('admin_menu', 'add_custom_field');
function add_custom_field()
{
    add_meta_box('custom-service', 'ご利用サービス名', 'create_service', 'service-experience', 'normal');
}

// カスタムフィールドのHTMLを追加する時の処理
function create_service()
{
    $keyname = 'service';
    global $post;
    // 保存されているカスタムフィールドの値を取得
    $get_value = get_post_meta($post->ID, $keyname, true);

    // selectの値
    $search_type = 'default';
    $return_type = 2;
    $check_dock = false;
    $result = get_lifesupportservice_data($search_type, $return_type, $check_dock);
    $result = array_merge($result, get_socialcontribution_data($search_type, $return_type, $check_dock));

    // nonceの追加
    wp_nonce_field('action-' . $keyname, 'nonce-' . $keyname);

    // HTMLの出力
    echo '<select name="' . $keyname . '">';
    echo '<option value="">-----</option>';
    foreach ($result as $child) {
        foreach ($child['post_list'] as $value) {
            $selected = '';
            if ($value['id'] == $get_value) {
                $selected = ' selected';
            }
            echo '<option value="' . $value['id'] . '"' . $selected . '>' . $value['name'] . '</option>';
        }
    }
    echo '</select>';
}

// カスタムフィールドの保存
add_action('save_post', 'save_custom_field');
function save_custom_field($post_id)
{
    $custom_fields = ['service'];

    foreach ($custom_fields as $d) {
        if (isset($_POST['nonce-' . $d]) && $_POST['nonce-' . $d]) {
            if (check_admin_referer('action-' . $d, 'nonce-' . $d)) {

                if (isset($_POST[$d]) && $_POST[$d]) {
                    update_post_meta($post_id, $d, $_POST[$d]);
                }
                else {
                    delete_post_meta($post_id, $d, get_post_meta($post_id, $d, true));
                }
            }
        }

    }
}

/*------------------------
 FAQ検索
 ------------------------*/
// カスタム投稿スラッグに合わせて読み込むsearch.phpを切り替える
add_filter('template_include', 'custom_search_template');
function custom_search_template($template)
{
    if (is_search()) {
        $post_types = get_query_var('post_type');
        foreach ((array)$post_types as $post_type)
            $templates[] = "search-{$post_type}.php";
        $templates[] = 'search.php';
        $template = get_query_template('search', $templates);
    }
    return $template;
}

// 検索対象にカスタムフィールドを追加
function custom_search($search, $wp_query)
{
    global $wpdb;

    //サーチページ以外だったら終了
    if (!$wp_query->is_search)
        return $search;

    if (!isset($wp_query->query_vars))
        return $search;

    // カスタムフィールドも検索対象に
    isset($_GET['s']) ? $input_freeword = $_GET['s'] : $input_freeword = '';
    if ($input_freeword) {
        $input_freeword = mb_convert_kana($input_freeword, 's');
        $freewords = preg_split('/[\s,]+/', $input_freeword);
        $search = '';

        foreach ($freewords as $freeword) {
            if (!empty($freeword)) {
                $freeword = $wpdb->escape("%{$freeword}%");
                $search .= " AND (
                    {$wpdb->posts}.post_title LIKE '{$freeword}'
                    OR {$wpdb->posts}.post_content LIKE '{$freeword}'
                    OR {$wpdb->posts}.ID IN ( 
                        SELECT post_id FROM {$wpdb->postmeta} 
                        WHERE meta_key = 'search_word_add' AND meta_value LIKE '%{$freeword}%'
                    )
                ) ";
            }
        }
    }
    return $search;
}
add_filter('posts_search', 'custom_search', 10, 2);

function empty_search($query)
{
    //全角スペースでAND検索できるようにする
    if ($query->is_main_query() && $query->is_search && !$query->is_admin) {
        $s = $query->get('s');
        $s = str_replace('　', ' ', $s);
        $query->set('s', $s);

        $query->set('posts_per_page', '-1');
        $query->set('post_status', 'publish');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_key', 'qa_number');

        if ($_SESSION['member_info']['member_id'] !== '000000000000') {
            $meta_query[] =
                array(
                'key' => 'pa_incompany',
                'value' => '0',
                'compare' => '=',
            );
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'empty_search');

/*
 * FAQ番号にシリアル番号を振る
 */
class NumberField
{
    protected $_postType; // 採番対象の投稿タイプ名

    public function __construct($post_type = 'post')
    {
        $this->_postType = $post_type;
        add_action('save_post_' . $this->_postType, array($this, 'setNumber'));
    }

    // 番号を格納するカスタムフィールドのキーを返す
    protected function _getMetaKey()
    {
        return 'number_field_' . $this->_postType;
    }

    // 採番用シーケンスを格納するサイトオプションのキーを返す
    protected function _getSequenceKey()
    {
        return 'number_sequence_' . $this->_postType;
    }

    // 当該投稿タイプが投稿されたら番号を付与する
    public function setNumber($post_ID)
    {
        // 採番済みならば何もしない
        if ($this->getNumber() !== '')
            return;

        // 採番用シーケンスが既存の場合は1進める。ない場合は1から始める。
        $sequence = get_option($this->_getSequenceKey());
        $sequence = (!empty($sequence)) ? $sequence + 1 : 1;

        // カスタムフィールドに番号を追加する
        if (update_post_meta($post_ID, $this->_getMetaKey(), $sequence)) {
            // カスタムフィールドの更新に成功したら、シーケンスをオプションに格納する
            update_option($this->_getSequenceKey(), $sequence);
        }
    }

    // 引数で指定された投稿 ID の持つ番号を取得する
    public function getNumber($post_ID = null)
    {
        // 引数がなければ現在の投稿 ID を使う
        if (empty($post_ID)) {
            $post_ID = get_the_ID();
        }
        return get_post_meta($post_ID, $this->_getMetaKey(), true);
    }
}
$numberField = new NumberField('ufaq'); // 採番対象の投稿タイプ名を指定する
// $postNumberField = new NumberField();    // デフォルトでは投稿タイプ「投稿」に番号を振る

// FAQ番号を編集できないようにする
// function my_admin_footer_script() {
//     echo '<script>
//     jQuery(function($){
//         $(".field-number_field_ufaq input").attr("readonly",true);
//     });
//     </script>'.PHP_EOL;
// }
// add_action('admin_print_footer_scripts', 'my_admin_footer_script');

// FAQ番号を一覧に表示し、ソートできるようにする
function my_add_columns($columns)
{
    $columns['my_column_name'] = 'FAQ番号';
    return $columns;
}
add_filter('manage_edit-ufaq_columns', 'my_add_columns');

function my_add_columns_content($column_name, $post_id)
{
    if ($column_name == 'my_column_name') {
        $metas = get_post_meta($post_id);
        $stitle = $metas['number_field_ufaq'][0];
    }
    if (isset($stitle) && $stitle) {
        echo esc_attr($stitle);
    }
}
add_action('manage_ufaq_posts_custom_column', 'my_add_columns_content', 10, 2);

function my_add_sort($columns)
{
    $columns['my_column_name'] = 'my_sort_name';
    return $columns;
}
function my_add_sort_by_meta($query)
{
    if ($query->is_main_query() && ($orderby = $query->get('orderby'))) {
        switch ($orderby) {
            case 'my_sort_name':
                $query->set('meta_key', 'number_field_ufaq');
                $query->set('orderby', 'meta_value_num');
                break;
        }
    }
}
add_filter('manage_edit-ufaq_sortable_columns', 'my_add_sort');
add_action('pre_get_posts', 'my_add_sort_by_meta', 1);

/*
 * FAQとライフサポートサービスの「フリーワード検索追加ワード」に共通の内容が保存されるようにする
 */
add_action('admin_init', 'my_admin_init');
function my_admin_init()
{
    add_action('save_post_ufaq', 'my_save_post_ufaq', 10, 3);
}
function my_save_post_ufaq($post_id, $post, $update)
{
    $relation_service_ids = get_post_meta($post_id, 'relation_service');
    if ($relation_service_ids) {
        $search_word_add = get_post_meta($post_id, 'search_word_add', true);
        foreach ($relation_service_ids as $relation_service_id) {
            update_post_meta($relation_service_id, 'search_words', $search_word_add);
        }
    }
}

/*
 *FAQの閲覧結果（解決した・しなかった）の保存
 */
function save_faq_resolve()
{
    session_start();
    global $wpdb;
    date_default_timezone_set('Asia/Tokyo');

    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'faq_resolve_action')) {
        echo 'fatal error';
        die;
    }

    $post_id = isset($_POST['post_id']) ? sanitize_text_field($_POST['post_id']) : '';
    $faq_no = isset($_POST['faq_no']) ? sanitize_text_field($_POST['faq_no']) : '';
    $post_title = isset($_POST['post_title']) ? sanitize_text_field($_POST['post_title']) : '';

    // クリックされたボタンのIDを取得
    $resolved = isset($_POST['resolved']) ? sanitize_text_field($_POST['resolved']) : '';


    if (empty($resolved)) {
        echo 'error: resolved missing';
        die;
    }

    // ここでデータベースに保存する処理を追加可能
    // 例: update_post_meta($post_id, 'faq_resolved', $element_id);

    // テーブルに挿入
    $wpdb->insert(
        'wpz_faq_resolve',
        array(
        'member_id' => $_SESSION['member_info']['member_id'],
        'created_at' => date("Y/m/d H:i:s"),
        'post_id' => $post_id,
        'faq_no' => $faq_no,
        'post_title' => $post_title,
        'is_resolve' => $resolved,
    ),
        array('%s', '%s', '%s')
    );


    echo $wpdb->insert_id;
    die;
}
add_action('wp_ajax_save_faq_resolve', 'save_faq_resolve');
add_action('wp_ajax_nopriv_save_faq_resolve', 'save_faq_resolve');

// 検索結果
function save_faq_all_resolve()
{
    session_start();
    global $wpdb;
    date_default_timezone_set('Asia/Tokyo');

    // 今回用のアクション名 'faq_all_resolve_action' で検証
    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'faq_all_resolve_action')) {
        echo 'fatal error';
        die;
    }

    // 参考コードの構造を維持
    $resolved = isset($_POST['resolved']) ? sanitize_text_field($_POST['resolved']) : '';

    if (empty($resolved)) {
        echo 'error: resolved missing';
        die;
    }

    // テーブルに挿入 (カラム名を今回のテーブル構造に合わせる)
    $wpdb->insert(
        'wpz_faq_all_resolve',
        array(
        'member_id' => $_SESSION['member_info']['member_id'],
        'created_at' => date("Y/m/d H:i:s"), // ご要望のスラッシュ形式
        'search_word' => isset($_POST['search_word']) ? sanitize_text_field($_POST['search_word']) : '',
        'search_quantity' => isset($_POST['search_quantity']) ? intval($_POST['search_quantity']) : 0,
        'is_resolve' => $resolved,
    ),
        array('%s', '%s', '%s', '%d', '%s') // カラム数に合わせたフォーマット指定
    );

    echo $wpdb->insert_id;
    die;
}
add_action('wp_ajax_save_faq_all_resolve', 'save_faq_all_resolve');
add_action('wp_ajax_nopriv_save_faq_all_resolve', 'save_faq_all_resolve');

/*
 *FAQの閲覧結果のコメントの保存
 */
function save_faq_resolve_comment()
{
    session_start();
    global $wpdb;
    date_default_timezone_set('Asia/Tokyo');

    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'faq_resolve_action')) {
        echo 'fatal error';
        die;
    }

    $resolve_id = isset($_POST['resolve_id']) ? sanitize_text_field($_POST['resolve_id']) : '';
    $resolve_comment = isset($_POST['resolve_comment']) ? sanitize_text_field($_POST['resolve_comment']) : '';
    // テーブルに保存
    $result = $wpdb->update(
        'wpz_faq_resolve',
    ['resolve_comment' => $resolve_comment], // Columns to update
    ['id' => $resolve_id], // WHERE condition
    ['%s'], // Data format for `resolve_comment`
    ['%d'] // Data format for `id`
    );

    echo 'success';
    die;
}
add_action('wp_ajax_save_faq_resolve_comment', 'save_faq_resolve_comment');
add_action('wp_ajax_nopriv_save_faq_resolve_comment', 'save_faq_resolve_comment');

//検索結果
function save_faq_all_resolve_comment()
{
    session_start();
    global $wpdb;
    date_default_timezone_set('Asia/Tokyo');

    if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'faq_all_resolve_action')) {
        echo 'fatal error';
        die;
    }

    $resolve_id = isset($_POST['resolve_id']) ? sanitize_text_field($_POST['resolve_id']) : '';
    $resolve_comment = isset($_POST['resolve_comment']) ? sanitize_text_field($_POST['resolve_comment']) : '';

    // テーブルに保存 (対象テーブルを all_resolve に統一)
    $result = $wpdb->update(
        'wpz_faq_all_resolve',
    ['resolve_comment' => $resolve_comment],
    ['id' => $resolve_id],
    ['%s'],
    ['%d']
    );

    echo 'success';
    die;
}
add_action('wp_ajax_save_faq_all_resolve_comment', 'save_faq_all_resolve_comment');
add_action('wp_ajax_nopriv_save_faq_all_resolve_comment', 'save_faq_all_resolve_comment');

add_action('admin_init', 'my_admin_init2');
function my_admin_init2()
{
    add_action('save_post_lifesupport', 'my_save_post_lifesupport', 10, 3);
}
function my_save_post_lifesupport($post_id)
{
    $search_words = get_post_meta($post_id, 'search_words', true);
    $args = array(
        'post_type' => 'ufaq',
        'posts_per_page' => -1,
        'meta_query' => array(
                array(
                'key' => 'relation_service',
                'value' => array($post_id),
                'compare' => 'IN',
            ),
        ),
    );
    $posts = get_posts($args);
    if ($posts) {
        foreach ($posts as $post) {
            setup_postdata($post);
            update_post_meta($post->ID, 'search_word_add', $search_words);
        }
        wp_reset_postdata();
    }
}

/*------------------------
 ログイン
 ------------------------*/
function login_action($en_user_name, $en_user_pass)
{
    require_once('/var/www/html/cms/wp-load.php');
    require_once(get_stylesheet_directory() . '/api/create_unread_array.php');
    global $wpdb;
    global $mypage_directori;

    // Ensure session is active before we start using $_SESSION
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // ユーザーエージェント識別
    $user_agent = 'PC';
    if (is_mobile()) {
        $user_agent = 'SP';
    }

    // ログインAPI
    $url = $mypage_directori . '/api/new-poral-login/';

    // 渡したいパラメータ
    $params = [
        'member_id' => $en_user_name,
        'password' => $en_user_pass,
        'user_agent' => $user_agent,
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $response_info = curl_getinfo($curl);
    $response_code = $response_info['http_code'] ?? 0;

    // Defensive: ensure we have JSON
    $arr = json_decode($response, true);
    if (!is_array($arr) || !isset($arr['success'])) {
        curl_close($curl);
        return '<p class="mb-0">通信エラーが発生しました。時間をおいて再度お試しください。</p>';
    }

    // デコード関数を呼び出す safely
    $password = 'ZenkosaiOpenSSLEncrypt';
    $resl_raw = $arr['success'];
    $resl_dec = '';
    try {
        $resl_dec = _decrypt($resl_raw, $password);
    }
    catch (Exception $e) {
        $resl_dec = '0';
    }
    $resl = (int)$resl_dec;

    if ($resl === 1) {
        $member_info = make_session_member_info($arr, $en_user_pass);
    }
    else {
        curl_close($curl);
        $message = '<p class="mb-0">ログインいただけない場合、以下の理由が考えられます。<br>
                    ご不明な場合は、全厚済サポートデスクまでご連絡ください。</p>
                    <ul class="list-unstyled ml-3 mt-0">
                        <li class="mb-1">1. 会員IDまたはパスワードを誤っている場合。</li>
                        <li class="mb-1">2. 会費が2か⽉連続で未納の場合。</li>
                        <li class="mb-1">3. 申込み内容に不備があった場合。</li>
                    </ul>';
        return $message;
    }

    curl_close($curl);

    // セッションに会員情報を保存（set_session_member_info の内部で session_start している場合もあるが
    // 先に session_start() を呼んでいるので安全）。
    $session_result = set_session_member_info($member_info);

    // Regenerate session id on successful login to ensure browser receives a fresh cookie
    // This helps avoid session fixation and ensures the session cookie is sent to client.
    if ($session_result === 'success') {
        // session_regenerate_id(true) requires an active session
        @session_regenerate_id(true);

        // Keep a copy used elsewhere in the code (mypage_member_info)
        if (isset($_SESSION['mypage_member_info'])) {
            unset($_SESSION['mypage_member_info']);
        }
        $_SESSION['mypage_member_info'] = $arr['member_info'];

        return 'success';
    }

    // fallback error
    return '<p class="mb-0">セッションの初期化に失敗しました。再度お試しください。</p>';
}

/**
 * ログイン成功直後に、保存されていたURLがあればそこへリダイレクトさせる処理
 */
add_action('init', function () {
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    if (!empty($_SESSION['member_info']) && !empty($_SESSION['redirect_after_login'])) {
        // お問い合わせ関連ページではリダイレクトを実行しない（フォーム送信を妨害するため）
        $current_uri = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($current_uri, '/contact/') !== false) {
            return;
        }

        $redirect_url = $_SESSION['redirect_after_login'];
        if (strpos($redirect_url, 'non-member_faq') !== false || strpos($redirect_url, 'info-convention') !== false) {
            $redirect_url = home_url('/');
        }
        unset($_SESSION['redirect_after_login']);
        wp_redirect($redirect_url);
        exit;
    }
}, 5);

add_action('template_redirect', function () {
    if (is_admin() || (defined('REST_REQUEST') && REST_REQUEST) || (defined('DOING_AJAX') && DOING_AJAX) || php_sapi_name() === 'cli') {
        return;
    }

    $current_uri = $_SERVER['REQUEST_URI'];

    // uploads/.htaccessの ErrorDocument 403 → /index.php からのリダイレクト対応
    // Apache が FilesMatch で PDF を 403 拒否 → ErrorDocument で /index.php へ内部リダイレクトした場合、
    // 元のPDF URLは REDIRECT_URL に格納される。
    if (
    isset($_SERVER['REDIRECT_STATUS']) && $_SERVER['REDIRECT_STATUS'] == '403'
    && isset($_SERVER['REDIRECT_URL'])
    && preg_match('/\.(pdf|doc|docx)$/i', $_SERVER['REDIRECT_URL'])
    ) {
        $current_uri = $_SERVER['REDIRECT_URL'];
    }

    // 独自セッションログイン判定
    $is_member_logged_in = is_user_loggedin();
    // WordPress管理者ログイン判定（テスト時はログアウトするかシークレットモードを使用）
    $is_wp_admin = current_user_can('manage_options');

    // 1. PDF/DOCデータのアクセス制御
    if (preg_match('/\.(pdf|doc|docx)$/i', $current_uri)) {
        if (!$is_member_logged_in && !$is_wp_admin) {
            wp_safe_redirect(home_url('/'));
            exit;
        }
        else {
            $path_part = urldecode(strtok($current_uri, '?'));
            // パターン1：$_SERVER['DOCUMENT_ROOT']基準
            $file_path = $_SERVER['DOCUMENT_ROOT'] . $path_part;

            // パターン2：ABSPATH基準（KUSANAGIなど環境によってDOCUMENT_ROOTがズレる場合のフォールバック）
            if (!file_exists($file_path)) {
                $relative_path = preg_replace('#^/cms/#', '', $path_part);
                $fallback_path = ABSPATH . ltrim($relative_path, '/');
                if (file_exists($fallback_path)) {
                    $file_path = $fallback_path;
                }
            }

            if (file_exists($file_path)) {
                // gzip圧縮などが有効な場合、Content-Lengthと実際のサイズが合わずエラーになるのを防ぐ
                if (function_exists('apache_setenv')) {
                    @apache_setenv('no-gzip', 1);
                }
                @ini_set('zlib.output_compression', 'Off');

                // 全出力バッファをクリアしてゴミ混入を防ぐ
                while (ob_get_level()) {
                    ob_end_clean();
                }

                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $mime_type = $finfo->file($file_path);

                // ErrorDocument 403 経由の場合、ステータスを200に上書き
                status_header(200);

                header('Content-Type: ' . $mime_type);
                header('Content-Disposition: inline; filename="' . basename($file_path) . '"');
                // Content-Lengthは圧縮の影響で狂うことがあるため、確実に送れる場合のみか外す
                header('Content-Length: ' . filesize($file_path));
                header('Accept-Ranges: bytes');
                nocache_headers(); // ブラウザキャッシュによる認証回避を防ぐ

                readfile($file_path);
                exit;
            }
            else {
                // ファイルが見つからない場合は404ページへ（これをしないとHTMLがPDFとして出力されエラーになる）
                status_header(404);
                nocache_headers();
                include(get_query_template('404'));
                exit;
            }
        }
    }


    // 2. お問合せ関連ページは常に許可（リダイレクトループ防止）
    $bypass_paths = array(
        '/contact/'  // お問合せ関連（確認・完了・エラーを含む階層下すべて）
    );

    foreach ($bypass_paths as $path) {
        if (strpos($current_uri, $path) !== false) {
            return;
        }
    }

    // 3. ログイン済みの場合は制限判定をスキップ
    if ($is_member_logged_in || $is_wp_admin) {
        return;
    }

    // --- 4. 制限判定ロジック ---
    $is_restrict = false;
    $post_id = get_queried_object_id();

    // CFS単体制限
    if ($post_id && function_exists('CFS')) {
        $val = CFS()->get('restrict_page', $post_id);
        if (!empty($val) && in_array($val, [true, 'true', '1', 1], true)) {
            $is_restrict = true;
        }
    }

    // site-settings 動的パス制限
    if (!$is_restrict && function_exists('CFS')) {
        $settings_page = get_page_by_path('site-settings', OBJECT, 'page');
        if ($settings_page) {
            $restricted_paths = CFS()->get('restrict_path_list', $settings_page->ID);
            if (is_array($restricted_paths)) {
                foreach ($restricted_paths as $row) {
                    if (!empty($row['path']) && strpos($current_uri, $row['path']) !== false) {
                        $is_restrict = true;
                        break;
                    }
                }
            }
        }
    }

    // スラッグ・投稿タイプ判定（URIに /lifesupport/ が含まれる場合を明示的に追加）
    if (!$is_restrict) {
        $pagename = get_query_var('pagename') ?: ($post_id ? get_post_field('post_name', $post_id) : '');
        $protect_slugs = array('media', 'media-list', 'sso-gate', 'info-convention', 'aul-archive', 'service-experience', 'plusa');
        $protect_post_types = array('lifesupport', 'ufaq', 'info-convention', 'service-experience', 'media');

        if (
        in_array($pagename, $protect_slugs, true) ||
        is_singular($protect_post_types) ||
        is_tax('ufaq-category') ||
        is_attachment() ||
        is_post_type_archive($protect_post_types) ||
        strpos($current_uri, '/plusa/') !== false ||
        strpos($current_uri, '/lifesupport/') !== false || // ライフサポート配下を保護
        strpos($current_uri, '/aul-archive/') !== false ||
        strpos($current_uri, '/service-experience/') !== false
        ) {
            $is_restrict = true;
        }
    }

    if (!$is_restrict)
        return;

    // リダイレクト処理
    $login_page = get_page_by_path('login');
    $login_url = $login_page ? get_permalink($login_page->ID) : home_url('/login/');

    if (strpos($current_uri, 'session-expired') !== false || ($login_page && $post_id === $login_page->ID)) {
        return;
    }

    if (!empty($_GET['return_url'])) {
        $_SESSION['redirect_after_login'] = esc_url_raw($_GET['return_url']);
    }
    else {
        $protocol = is_ssl() ? 'https://' : 'http://';
        $_SESSION['redirect_after_login'] = $protocol . $_SERVER['HTTP_HOST'] . $current_uri;
    }

    nocache_headers();
    $redirect_payload = urlencode($_SESSION['redirect_after_login']);
    $login_url = add_query_arg('redirect_to', $redirect_payload, $login_url);
    wp_safe_redirect($login_url);
    exit;
}, 1);
// add_action('template_redirect', function () {
//     // ログイン済み、または管理画面なら何もしない
//     if (is_user_loggedin() || is_admin()) return;

//     $current_uri = $_SERVER['REQUEST_URI'];

//     // URLに「/insurance/comeback/」が含まれている場合のみ発動
//     if (strpos($current_uri, '/insurance/comeback/') !== false) {
        
//         // セッション開始（戻り先保存用）
//         if (session_status() === PHP_SESSION_NONE) { @session_start(); }
        
//         $protocol = is_ssl() ? 'https://' : 'http://';
//         $_SESSION['redirect_after_login'] = $protocol . $_SERVER['HTTP_HOST'] . $current_uri;

//         // ログインページを取得してリダイレクト
//         $login_page = get_page_by_path('login');
//         $login_url = $login_page ? get_permalink($login_page->ID) : home_url('/login/');
        
//         // 戻り先URLをパラメータに付与
//         $login_url = add_query_arg('redirect_to', urlencode($_SESSION['redirect_after_login']), $login_url);
        
//         nocache_headers();
//         wp_safe_redirect($login_url);
//         exit;
//     }
// }, 10);

/*-------------------------------------------
 受け取ったログイン情報をわかりやすい形に整形
 -------------------------------------------*/
function make_session_member_info($arr, $en_user_pass)
{
    require_once('/var/www/html/cms/wp-load.php');
    global $wpdb;
    global $mypage_directori;

    $password = 'ZenkosaiOpenSSLEncrypt';

    $member_info = [];
    $encoded = [];
    if ($arr['member_info']) {
        $member_info = $arr['member_info'];
        $encoded = $arr['member_info'];
    }
    else {
        $member_info = $arr;
        $encoded = $arr;
    }

    //種別名称に変換
    $replace_membertype = ['1' => 'p_member', '2' => 'k_member', '3' => 'ps_member', '4' => 'ks_member'];

    foreach ($member_info as $key => $value) {
        if ($key !== 'member_list') {
            $member_info[$key] = _decrypt($value, $password);
        }
        else {
            foreach ($member_info['member_list'] as $key_2 => $value_2) {
                foreach ($member_info['member_list'][$key_2] as $key_3 => $value_3) {
                    $member_info['member_list'][$key_2][$key_3] = _decrypt($value_3, $password);
                    if ($key_3 === 'member_type') {
                        $member_info['member_list'][$key_2][$key_3] = $replace_membertype[$member_info['member_list'][$key_2][$key_3]];
                    }
                }
            }
        }
    }
    // タイトル名
    $replace_title = ['1' => 'member', '2' => 'goldmember', '3' => 'plutinummember', '4' => 'emeraldclubmember', '5' => 'diamondclubmember', '6' => 'primediamondclubmember'];
    // 都道府県コード
    $replace_pref = [
        '1' => '北海道',
        '2' => '青森県',
        '3' => '岩手県',
        '4' => '宮城県',
        '5' => '秋田県',
        '6' => '山形県',
        '7' => '福島県',
        '8' => '茨城県',
        '9' => '栃木県',
        '10' => '群馬県',
        '11' => '埼玉県',
        '12' => '千葉県',
        '13' => '東京都',
        '14' => '神奈川県',
        '15' => '新潟県',
        '16' => '富山県',
        '17' => '石川県',
        '18' => '福井県',
        '19' => '山梨県',
        '20' => '長野県',
        '21' => '岐阜県',
        '22' => '静岡県',
        '23' => '愛知県',
        '24' => '三重県',
        '25' => '滋賀県',
        '26' => '京都府',
        '27' => '大阪府',
        '28' => '兵庫県',
        '29' => '奈良県',
        '30' => '和歌山県',
        '31' => '鳥取県',
        '32' => '島根県',
        '33' => '岡山県',
        '34' => '広島県',
        '35' => '山口県',
        '36' => '徳島県',
        '37' => '香川県',
        '38' => '愛媛県',
        '39' => '高知県',
        '40' => '福岡県',
        '41' => '佐賀県',
        '42' => '長崎県',
        '43' => '熊本県',
        '44' => '大分県',
        '45' => '宮崎県',
        '46' => '鹿児島県',
        '47' => '沖縄県'
    ];
    // 登録状態
    // $replace_status = [ '0' => '正常', '1' => '書類不備'];
    // 不備理由
    // $replace_reason = ['0' => 'なし', '25' => '仮登録'];
    // 有無判定
    // $replace_qualification = ['0' => 'なし', '1' => 'あり'];
    $login_info = [];
    // 情報を変数に格納
    $login_info['member_id'] = $member_info['member_id']; //会員ID（12桁）
    $login_info['member_id_pre'] = $encoded['member_id']; //デコード前
    $login_info['member_pw_pre'] = $en_user_pass; //会員パスワードデコード前
    $login_info['member_name'] = $member_info['member_name']; //会員氏名
    $login_info['primary_name'] = $member_info['primary_name']; //契約者氏名
    $login_info['nextlv_num'] = $member_info['nextlv']; //タイトル（※1：M（ﾒﾝﾊﾞｰ）、2：G.M（ｺﾞｰﾙﾄﾞﾒﾝﾊﾞｰ）、3：P.M（ﾌﾟﾗﾁﾅﾒﾝﾊﾞｰ）、4：E.C.M（ｴﾒﾗﾙﾄﾞｸﾗﾌﾞﾒﾝﾊﾞｰ）、5：D.C.M（ﾀﾞｲﾔﾓﾝﾄﾞｸﾗﾌﾞﾒﾝﾊﾞｰ）、6：P.D.C.M（ﾌﾟﾗｲﾑﾀﾞｲﾔﾓﾝﾄﾞｸﾗﾌﾞﾒﾝﾊﾞｰ））
    $login_info['nextlv'] = $replace_title[$login_info['nextlv_num']];
    $login_info['member_type'] = $member_info['member_type']; //会員種別（※1：P会員、2：K会員、3：PS会員、4：KS会員）
    $login_info['member_type'] = $replace_membertype[$login_info['member_type']];
    $login_info['pref'] = $member_info['pref']; //都道府県コード
    $login_info['pref'] = $replace_pref[$login_info['pref']];
    $login_info['ex'] = $member_info['ex']; //EXフラグ（※エクスプラネーター資格　0：なし、1：あり）
    $login_info['pb'] = $member_info['pb']; //PBフラグ(※プライムビジネス資格　0：なし、1：あり)
    $login_info['startdate'] = $member_info['startdate']; //利用開始日
    $login_info['unread'] = $member_info['unread_count']; //未読件数
    $login_info['member_status'] = $member_info['member_status']; //登録状態（※0：正常、1：書類不備　）
    $login_info['deficient_reason'] = $member_info['deficient_reason']; //不備理由（※0：なし、25：仮登録）
    $login_info['mail_judge'] = $member_info['mail_judge']; //メールアドレス判定 true/false（※メールアドレスが設定されて入れば「true」）
    $login_info['sub_title'] = $member_info['sub_title']; //サービス受領者のタイトル（※P会員の契約者のタイトルがMでサービス受領者にタイトル保持者がいる場合のみ、1以上が返却されます。）
    $login_info['ws_limit'] = $member_info['ws_limit']; //WS資料締め切り期限（例：※2020年12月度更新済、12月31日までにご確認お願いいたします。）
    $login_info['defect_judge'] = $member_info['defect_judge']; //紹介者書類不備存在有り無し true/false（※「true」の場合のみ紹介者書類不備バナー表示）
    $login_info['mallid'] = $encoded['mallid']; //全厚済モール用ID(暗号化済そのまま設定)
    $login_info['mallpass'] = $encoded['mallpass']; //全厚済モール用PASS(暗号化済そのまま設定)
    $login_info['position_name'] = $member_info['position_name']; //代表者名
    $login_info['tel'] = $member_info['tel']; //TEL
    $login_info['mail'] = $member_info['mail']; //メール
    $login_info['zip_code'] = $member_info['zip_code']; //郵便番号
    $login_info['address'] = $member_info['address']; //住所
    $login_info['mail_flg'] = $member_info['mail_flg']; //郵送物設定判定（※0=未設定、1=設定済）
    $login_info['member_list'] = $member_info['member_list']; //会員情報
    $login_info['compl_attend_date'] = $member_info['compl_attend_date']; //コンプライアンス受講日
    $login_info['compl_attend_limit'] = $member_info['compl_attend_limit']; //コンプライアンス受講期限
    return $login_info;
}
/*-------------------------------------------
 会員情報をセッションに保持
 -------------------------------------------*/
function set_session_member_info($member_info)
{
    require_once('/var/www/html/cms/wp-load.php');
    require_once(get_stylesheet_directory() . '/api/create_unread_array.php');
    global $wpdb;
    global $mypage_directori;

    // 未読の投稿IDの配列を作成
    $posts_unread = create_unread_array($member_info['member_id'], $member_info['startdate']);

    // セッションスタート
    session_start();
    // 会員情報
    $_SESSION['member_info'] = array(
        'member_id' => $member_info['member_id'],
        'member_id_pre' => $member_info['member_id_pre'],
        'member_pw_pre' => $member_info['member_pw_pre'],
        'member_name' => $member_info['member_name'],
        'primary_name' => $member_info['primary_name'],
        'nextlv' => $member_info['nextlv'],
        'nextlv_num' => $member_info['nextlv_num'],
        'member_type' => $member_info['member_type'],
        'pref' => $member_info['pref'],
        'ex_flag' => $member_info['ex'],
        'pb_flag' => $member_info['pb'],
        'startdate' => $member_info['startdate'],
        'unread' => $member_info['unread'],
        'member_status' => $member_info['member_status'],
        // 'member_status'      => 1,
        'deficient_reason' => $member_info['deficient_reason'],
        // 'deficient_reason'   => 25,
        'mail_judge' => $member_info['mail_judge'],
        // 'mail_judge'         => 0,
        'sub_title' => $member_info['sub_title'],
        'ws_limit' => $member_info['ws_limit'],
        'defect_judge' => $member_info['defect_judge'],
        'mallid' => $member_info['mallid'],
        'mallpass' => $member_info['mallpass'],
        'position_name' => $member_info['position_name'],
        'tel' => $member_info['tel'],
        'mail' => $member_info['mail'],
        // 'mail' => '',
        'zip_code' => $member_info['zip_code'],
        'address' => $member_info['address'],
        'mail_flg' => $member_info['mail_flg'],
        'member_list' => $member_info['member_list'],
        'mypage_visit' => 0,
        'compl_attend_date' => $member_info['compl_attend_date'],
        'compl_attend_limit' => $member_info['compl_attend_limit'],
    );

    $_SESSION['is_unread'] = $posts_unread['list'];
    if (isset($_SESSION['member_info'])) {
        return 'success';
    }
}

/*------------------------
 Flamingoの文字コードをutf-8からShift-JISに変換
 ------------------------*/
add_filter('flamingo_csv_quotation', 'my_filter_convert_encoding_csv', 11);
function my_filter_convert_encoding_csv($input)
{
    return mb_convert_encoding($input, "SJIS", "UTF-8");
}


/**
 * 天然水の定期購入お申し込み バリデーション
 */
function my_mwwpform_validation_rule_water($Validation, $data)
{
    if (empty($data['member_birthday_year'])) {
        $Validation->set_rule('member_birthday_year', 'noEmpty', array('message' => '未入力です。'));
    }
    else if (empty($data['member_birthday_month'])) {
        $Validation->set_rule('member_birthday_month', 'noEmpty', array('message' => '未入力です。'));
    }
    else if (empty($data['member_birthday_day'])) {
        $Validation->set_rule('member_birthday_day', 'noEmpty', array('message' => '未入力です。'));
    }

    if (empty($data['service_qty'])) {
        $Validation->set_rule('service_qty', 'required', array('message' => '未入力です。'));
    }
    else if ($data['service_qty'] == 'その他' && empty($data['service_qty_num'])) {
        $Validation->set_rule('service_qty_num', 'noEmpty', array('message' => '未入力です。'));
    }

    if ($data['user_same'] != '同じ') {
        $Validation->set_rule('user_name', 'noEmpty', array('message' => '未入力です。'));
        $Validation->set_rule('user_name_kana', 'noEmpty', array('message' => '未入力です。'));
        if (empty($data['user_birthday_year'])) {
            $Validation->set_rule('user_birthday_year', 'noEmpty', array('message' => '未入力です。'));
        }
        else if (empty($data['user_birthday_month'])) {
            $Validation->set_rule('user_birthday_month', 'noEmpty', array('message' => '未入力です。'));
        }
        else if (empty($data['user_birthday_day'])) {
            $Validation->set_rule('user_birthday_day', 'noEmpty', array('message' => '未入力です。'));
        }
        $Validation->set_rule('user_tel1', 'noEmpty', array('message' => '未入力です。'));
        $Validation->set_rule('user_postalcode', 'noEmpty', array('message' => '未入力です。'));
        $Validation->set_rule('user_address_pref', 'noEmpty', array('message' => '未入力です。'));
        $Validation->set_rule('user_address_city', 'noEmpty', array('message' => '未入力です。'));
        $Validation->set_rule('user_address_house_num', 'noEmpty', array('message' => '未入力です。'));

    }
    return $Validation;
}
add_filter('mwform_validation_mw-wp-form-15995', 'my_mwwpform_validation_rule_water', 10, 2);



/*------------------------
 会員検索（単一）
 ------------------------*/
function member_search_action($user_name)
{
    require_once('/var/www/html/cms/wp-load.php');
    require_once(get_stylesheet_directory() . '/api/create_unread_array.php');
    global $wpdb;
    global $mypage_directori;

    //エンコード関数の呼び出し
    $password = 'ZenkosaiOpenSSLEncrypt';
    $en_user_name = _encrypt($user_name, $password);

    //ログインAPI
    $url = $mypage_directori . '/api/member-search/';

    // 渡したいパラメータ
    $params =
    [
        'member_id' => $en_user_name,
        'member_kana' => _encrypt("", $password),
        'tel' => _encrypt("", $password)
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // パラメータをセット
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

    //APIレスポンス処理（JSON)
    // レスポンスを変数に入れる
    $response = curl_exec($curl);
    $response_info = curl_getinfo($curl); //結果に関する情報を格納
    $response_code = $response_info['http_code']; //通信結果のHTTPステータスコード
    $response_header_size = $response_info['header_size']; //通信結果のヘッダサイズ

    // JSON連想配列へ変換
    $arr = json_decode($response, true);
    //デコード関数を呼び出す
    $password = 'ZenkosaiOpenSSLEncrypt';
    $resl = _decrypt($arr['success'], $password);
    $resl = (int)$resl;

    // curlの処理を終了
    curl_close($curl);

    if ($resl == 0) {
        return null;
    }
    $member_info = array();
    $list = $arr['list'];
    if (!empty($list) && !empty($list[0])) {
        $member_info['member_id'] = _decrypt($list[0]['member_id'], $password);
        $member_info['member_name'] = _decrypt($list[0]['member_name'], $password);
        $member_info['member_kana'] = _decrypt($list[0]['member_kana'], $password);
        $member_info['birthday'] = _decrypt($list[0]['birthday'], $password);
        $member_info['zip_code'] = _decrypt($list[0]['zip_code'], $password);
        $member_info['pref_code'] = _decrypt($list[0]['pref_code'], $password);
        $member_info['pref_name'] = _decrypt($list[0]['pref_name'], $password);
        $member_info['city_name'] = _decrypt($list[0]['city_name'], $password);
        $member_info['address_name'] = _decrypt($list[0]['address_name'], $password);
        $member_info['build_name'] = _decrypt($list[0]['build_name'], $password);
        if (_decrypt($list[0]['email_mobile'], $password) == "") {
            $member_info['email'] = _decrypt($list[0]['email'], $password);
        }
        else {
            $member_info['email'] = _decrypt($list[0]['email_mobile'], $password);
        }
    }
    return $member_info;

}



/*------------------------
 会員検索（複数件）
 ------------------------*/
function members_search_action($member_id, $tel)
{
    require_once('/var/www/html/cms/wp-load.php');
    require_once(get_stylesheet_directory() . '/api/create_unread_array.php');
    global $wpdb;
    global $mypage_directori;

    //会員検索API
    $url = $mypage_directori . '/api/member-search/';

    //エンコード関数の呼び出し
    $encrypt_key = 'ZenkosaiOpenSSLEncrypt';

    $member_id = trim($member_id);
    $tel = trim($tel);
    if (is_numeric($member_id) && $member_id <= 1000) {
        $member_id = "";
    }
    $en_member_id = _encrypt($member_id, $encrypt_key);
    $en_tel = _encrypt($tel, $encrypt_key);

    // 渡したいパラメータ
    $params =
    [
        'member_id' => $en_member_id,
        'member_kana' => _encrypt("", $encrypt_key),
        'tel' => $en_tel
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $params); // パラメータをセット
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

    //APIレスポンス処理（JSON)
    // レスポンスを変数に入れる
    $response = curl_exec($curl);
    $response_info = curl_getinfo($curl); //結果に関する情報を格納
    $response_code = $response_info['http_code']; //通信結果のHTTPステータスコード
    $response_header_size = $response_info['header_size']; //通信結果のヘッダサイズ

    // JSON連想配列へ変換
    $arr = json_decode($response, true);
    //デコード関数を呼び出す
    $resl = _decrypt($arr['success'], $encrypt_key);
    $resl = (int)$resl;

    // curlの処理を終了
    curl_close($curl);

    if ($resl == 0) {
        return null;
    }
    $member_info_list = array();
    $member_info = array();
    $list = $arr['list'];
    console_log($list);
    if (!empty($list)) {
        foreach ($list as $detail) {

            $member_info['member_id'] = _decrypt($detail['member_id'], $encrypt_key);
            $member_info['member_name'] = _decrypt($detail['member_name'], $encrypt_key);
            $member_info['member_kana'] = _decrypt($detail['member_kana'], $encrypt_key);
            $member_info['member_type'] = _decrypt($detail['member_type'], $encrypt_key);
            $member_info['position_name'] = _decrypt($detail['position_name'], $encrypt_key);
            $member_info['position_kana'] = _decrypt($detail['position_kana'], $encrypt_key);
            $member_info['regist_type'] = _decrypt($detail['regist_type'], $encrypt_key);
            $member_info['pb_flg'] = _decrypt($detail['pb_flg'], $encrypt_key);
            $member_info['ep_flg'] = _decrypt($detail['ep_flg'], $encrypt_key);
            $member_info['start_date'] = _decrypt($detail['start_date'], $encrypt_key);

            $member_info['member_status'] = _decrypt($detail['member_status'], $encrypt_key);

            //            $member_info['birthday'] = _decrypt($detail['birthday'], $encrypt_key);
//            $member_info['zip_code'] = _decrypt($detail['zip_code'], $encrypt_key);
//            $member_info['pref_code'] = _decrypt($detail['pref_code'], $encrypt_key);
//            $member_info['pref_name'] = _decrypt($detail['pref_name'], $encrypt_key);
//            $member_info['city_name'] = _decrypt($detail['city_name'], $encrypt_key);
//            $member_info['address_name'] = _decrypt($detail['address_name'], $encrypt_key);
//            $member_info['build_name'] = _decrypt($detail['build_name'], $encrypt_key);
//            if (_decrypt($detail['email_mobile'], $encrypt_key) == ""){
//                $member_info['email'] = _decrypt($detail['email'], $encrypt_key);
//            } else {
//                $member_info['email'] = _decrypt($detail['email_mobile'], $encrypt_key);
//            }

            $member_info_list[] = $member_info;
        }
    }
    return $member_info_list;

}

/**
 * 天然水の定期購入お申し込み メール
 */
function mwform_mail_raw_for_water($Mail_raw, $values, $Data)
{
    require_once "/var/www/html/vendor/autoload.php";

    //open
    $filepath = __DIR__ . "/file/water/water.xlsx";
    $reader = new PhpOffice\PhpSpreadsheet\Reader\Xlsx();


    $spreadsheet = $reader->load($filepath);
    $sheet = $spreadsheet->getSheet(0);

    //write
    $sheet->setCellValue('P2', date_i18n('Y年m月d日'));
    // member
    $sheet->setCellValue('O3', "会員ID:" . $Data->get('member_id'));
    $sheet->setCellValue('B8', $Data->get('member_name'));
    $sheet->setCellValue('B7', $Data->get('member_name_kana'));
    $sheet->setCellValue('N9', "西暦　" . $Data->get('member_birthday_year') . " 年 　" . $Data->get('member_birthday_month') . " 月 　" . $Data->get('member_birthday_day') . " 日 生　（満　　" . $Data->get('member_age') . " 歳）");

    $sheet->setCellValue('N6', convertFortmatTel($Data->get('member_tel1')));
    $sheet->setCellValue('N7', convertFortmatTel($Data->get('member_tel2')));

    if (strpos($Data->get('member_postalcode'), "-") === false) {
        $sheet->setCellValue('C11', substr($Data->get('member_postalcode'), 0, 3) . "-" . substr($Data->get('member_postalcode'), 3));
    }
    else {
        $sheet->setCellValue('C11', $Data->get('member_postalcode'));
    }

    $sheet->setCellValue('B12', $Data->get('member_address_pref') . " " . $Data->get('member_address_city') . $Data->get('member_address_house_num') . " " . $Data->get('member_address_detail'));
    //    $sheet->setCellValue('B10', $Data->get('member_address_kana'));
/*
    if ("男性" == $Data->get('member_gender')) {
        $sheet->setCellValue('Q13', "○男・女");
    } else {
        $sheet->setCellValue('Q13', "男・○女");
    }
*/
    /*
     $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
     $drawing->setPath(__DIR__ . "/file/water/circle.png");
     $drawing->setCoordinates('Q13');
     if ("男性" == $Data->get('member_gender')) {
     $drawing->setOffsetX(10);
     } else {
     $drawing->setOffsetX(50);
     }
     */
    $sheet->setCellValue('B13', $Data->get('member_mail'));

    // user
    $sheet->setCellValue('B17', $Data->get('user_name'));
    $sheet->setCellValue('B16', $Data->get('user_name_kana'));
    $sheet->setCellValue('N18', "西暦　" . $Data->get('user_birthday_year') . " 年 　" . $Data->get('user_birthday_month') . " 月 　" . $Data->get('user_birthday_day') . " 日 生　（満　　" . $Data->get('user_age') . " 歳）");

    $sheet->setCellValue('N15', convertFortmatTel($Data->get('user_tel1')));
    $sheet->setCellValue('N16', convertFortmatTel($Data->get('user_tel2')));

    if (strpos($Data->get('user_postalcode'), "-") === false) {
        $sheet->setCellValue('C20', substr($Data->get('user_postalcode'), 0, 3) . "-" . substr($Data->get('user_postalcode'), 3));
    }
    else {
        $sheet->setCellValue('C20', $Data->get('user_postalcode'));
    }

    $sheet->setCellValue('B21', $Data->get('user_address_pref') . " " . $Data->get('user_address_city') . $Data->get('user_address_house_num') . " " . $Data->get('user_address_detail'));
    $sheet->setCellValue('B22', $Data->get('user_mail'));

    /*
     if ("男性" == $Data->get('user_gender')) {
     $sheet->setCellValue('Q22', "○男・女");
     } else if ("女性" == $Data->get('user_gender')) {
     $sheet->setCellValue('Q22', "男・○女");
     }
     */

    // service
    if ("ホワイト" == $Data->get('service_server')) {
        $sheet->setCellValue('D31', '☑');
    }
    else if ("ブラック" == $Data->get('service_server')) {
        $sheet->setCellValue('D32', '☑');
    }
    else if ("ピンク" == $Data->get('service_server')) {
        $sheet->setCellValue('D33', '☑');
    }
    else if ("限定カラー ウッド（別途2200円/税込）" == $Data->get('service_server')) {
        $sheet->setCellValue('D34', '☑');
    }
    else if ("限定カラー ライトウッド（別途2200円/税込）" == $Data->get('service_server')) {
        $sheet->setCellValue('D35', '☑');
    }
    if ("2本" == $Data->get('service_qty')) {
        $sheet->setCellValue('J31', '☑');
    }
    else if ("4本" == $Data->get('service_qty')) {
        $sheet->setCellValue('N31', '☑');
    }
    else {
        $sheet->setCellValue('P31', '☑' . $Data->get('service_qty_num') . '本');
    }

    if ("1ヶ月間隔" == $Data->get('service_interval')) {
        $sheet->setCellValue('K34', '☑');
    }
    else if ("4週間隔" == $Data->get('service_interval')) {
        $sheet->setCellValue('K35', '☑');
    }
    else if ("3週間隔" == $Data->get('service_interval')) {
        $sheet->setCellValue('K36', '☑');
    }
    else if ("2週間隔" == $Data->get('service_interval')) {
        $sheet->setCellValue('N34', '☑');
    }
    else if ("1週間隔" == $Data->get('service_interval')) {
        $sheet->setCellValue('N35', '☑');
    }

    if ("エコ配達に協力する" == $Data->get('service_eco')) {
        $sheet->setCellValue('D51', '☑');
    }

    //    $sheet->setCellValue('E59', $Data->get('first_delivery_month') . '月　' . $Data->get('first_delivery_day') . '日');


    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $dirname = __DIR__ . "/file/water";
    $filename = $dirname . "/water_" . date_i18n('YmdHis') . "_" . $Data->get('member_id');
    $writer->save($filename . ".xlsx");

    // pdf
    // exec("export HOME=/var/www && export LANG=ja_JP.UTF-8 && /usr/bin/libreoffice7.6 --headless --convert-to pdf --outdir " . $dirname . " " . $filename . ".xlsx");

    // $attachments = [];
    // $attachments[] = $filename . ".pdf";
    // $Mail_raw->attachments = $attachments;

    // （本番環境のみ）PDF変換 動作確認用ソース
    if ($Data->get('member_id') == 15) {
        $Mail_raw->to = 'kyosai@kknw.jp,web-suppirt@wiznet.co.jp';
    }
    return $Mail_raw;

}
add_filter('mwform_admin_mail_raw_mw-wp-form-15995', 'mwform_mail_raw_for_water', 10, 3);
add_filter('mwform_auto_mail_raw_mw-wp-form-15995', 'mwform_mail_raw_for_water', 10, 3);

/*-------------------------------------------
 電話番号変換
 /*-------------------------------------------*/
function convertFortmatTel($text)
{
    $str = str_replace('-', '', $text);
    //    if (strlen($str) == 10) {
//        $str = substr($str ,0,2) . " ( " . substr($str ,2,4) . " ) " . substr($str ,6);
//    } else if (strlen($str) == 11) {
//        $str = substr($str ,0,3) . " ( " . substr($str ,3,4) . " ) " . substr($str ,7);
//    }
    return $str;
}

/*------------------------
 ペット保険 全厚済会員特典の申込みフォーム
 ------------------------*/
function pet_validation_rule($Validation, $data, $Data)
{
    if ($data['contract_plan'] == 'gold' || $data['contract_plan'] == 'platina') {
        $Validation->set_rule('desired_product', 'required');
    }
    return $Validation;
}
add_filter('mwform_validation_mw-wp-form-27672', 'pet_validation_rule', 10, 3);

function mwform_validation_rule_test($validation_rules)
{
    if (!class_exists("MW_Validation_Rule_Policy_Number")) {
        class MW_Validation_Rule_Policy_Number extends MW_WP_Form_Abstract_Validation_Rule
        {
            /**
             * バリデーションルール名を指定
             *
             * @var string
             */
            protected $name = 'policy_number';
            /**
             * バリデーションチェック
             *
             * @param string $key name属性
             * @param array  $option
             *
             * @return string エラーメッセージ
             */
            public function rule($key, array $options = array())
            {
                // 追加したいバリデーションの処理
                $pet_privilege = get_page_by_path('pet-privilege');
                $pet_privilege_id = $pet_privilege->ID;
                $pet_csv = CFS()->get('pet_csv', $pet_privilege_id);

                if ($pet_csv) {
                    $numbers = [];
                    $value = $this->Data->get($key);
                    if (!MWF_Functions::is_empty($value)) {
                        $fp = fopen($pet_csv, 'r');
                        while ($line = fgetcsv($fp)) {
                            if (preg_match('/^([0-9]{10})$/', $line[0])) {
                                array_push($numbers, $line[0]);
                            }
                        }
                        fclose($fp);

                        if (in_array($value, $numbers, true)) {
                            $defaults = array(
                                'message' => __('お申し込み済みの証券番号です。', 'mw-wp-form'),
                            );
                            $options = array_merge($defaults, $options);
                            return $options['message'];
                        }
                    }
                }
            }
            /**
             * 設定パネルに追加
             *
             * @param int   $key   バリデーションルールセットの識別番号
             * @param array $value バリデーションルールセットの内容
             */
            public function admin($key, $value)
            {
?>
<label>
    <input type="checkbox" <?php checked($value[$this->get_name()], 1); ?> name="
    <?php echo MWF_Config::NAME; ?>[validation][
    <?php echo $key; ?>][
    <?php echo esc_attr($this->get_name()); ?>]" value="1" />
    <?php esc_html_e('証券番号の照会', 'mw-wp-form'); ?>
</label>
<?php
            }
        }
    }
    $instance = new MW_Validation_Rule_Policy_Number();
    $validation_rules[$instance->get_name()] = $instance;
    return $validation_rules;
}
add_filter('mwform_validation_rules', 'mwform_validation_rule_test');

/*-------------------------------------------*/
/*  セッションの有効期限を1時間に設定
 /*-------------------------------------------*/
// 常時
// session_set_cookie_params(60 * 60);

// コンベンション用（6h）
session_set_cookie_params(60 * 60 * 6);
ini_set("session.gc_maxlifetime", 60 * 60 * 6);
ini_set("session.gc_probabity", 1000);

/*-------------------------------------------*/
/*  サービス利用申請
 /*-------------------------------------------*/
// バリデーション・エラーメッセージを設定
function my_mwform_validation_rule($Validation, $data)
{
    $Validation->set_rule('service_member_name', 'required', array(
        'message' => '選択してください。'
    ));
    $Validation->set_rule('file_1', 'fileSize', array(
        'bytes' => 11534336,
        'message' => 'ファイルサイズは10MB以内にしてください。'
    ));
    $Validation->set_rule('file_1', 'fileType', array(
        'types' => 'png,jpg,jpeg,pdf,heic',
        'message' => 'jpg/png/pdfのいずれかのファイル形式でアップロードしてください。'
    ));
    $Validation->set_rule('file_2', 'fileSize', array(
        'bytes' => 11534336,
        'message' => 'ファイルサイズは10MB以内にしてください。'
    ));
    $Validation->set_rule('file_2', 'fileType', array(
        'types' => 'png,jpg,jpeg,pdf,heic',
        'message' => 'jpg/png/pdfのいずれかのファイル形式でアップロードしてください。'
    ));
    $Validation->set_rule('file_3', 'fileSize', array(
        'bytes' => 11534336,
        'message' => 'ファイルサイズは10MB以内にしてください。'
    ));
    $Validation->set_rule('file_3', 'fileType', array(
        'types' => 'png,jpg,jpeg,pdf,heic',
        'message' => 'jpg/png/pdfのいずれかのファイル形式でアップロードしてください。'
    ));
    if (empty($data['file_1']) && empty($data['file_2']) && empty($data['file_3'])) {
        $Validation->set_rule('file_3', 'noEmpty', array('message' => '未入力です。'));
    }
    return $Validation;
}
add_filter('mwform_validation_mw-wp-form-30141', 'my_mwform_validation_rule', 10, 3); //お子様のお祝い
add_filter('mwform_validation_mw-wp-form-30143', 'my_mwform_validation_rule', 10, 3); //結婚祝い
add_filter('mwform_validation_mw-wp-form-30021', 'my_mwform_validation_rule', 10, 3); //健康診断支援
add_filter('mwform_validation_mw-wp-form-30144', 'my_mwform_validation_rule', 10, 3); //葬儀見舞金

function my_mwform_validation_rule_child($Validation, $data)
{
    $Validation->set_rule('child_birth_year', 'required', array(
        'message' => '未入力です。'
    ));
    $Validation->set_rule('child_birth_month', 'required', array(
        'message' => '未入力です。'
    ));
    $Validation->set_rule('child_birth_date', 'required', array(
        'message' => '未入力です。'
    ));
}
add_filter('mwform_validation_mw-wp-form-30141', 'my_mwform_validation_rule_child', 10, 3); //お子様のお祝い

function my_mwform_validation_rule_secom($Validation, $data)
{
    $Validation->set_rule('name', 'required', array(
        'message' => '未入力です。'
    ));
}
add_filter('mwform_validation_mw-wp-form-30024', 'my_mwform_validation_rule_secom', 10, 3); //セコム・オンラインセキュリティ／安全商品

// お問い合わせ内容をテキストファイルで添付
// テキストファイルの内容は管理画面の「管理者宛メール」本文にて設定    
function admin_mail($Mail, $values, $Data)
{
    if ($Data->get('service_member_name') == '選択してください') {
        $Mail->body = str_replace('　［申請者名］選択してください' . "\r\n", '', $Mail->body);
    }
    else if ($Data->get('service_member_name') == 'サービス受領者はいません') {
        $Mail->body = str_replace('　［申請者名］サービス受領者はいません' . "\r\n", '', $Mail->body);
    }

    if (!$Data->get('bank_name')) {
        $Mail->body = str_replace('［K会員/振込口座］', '', $Mail->body);
    }
    else {
        $bank_text = "
［K会員/振込口座］
　●金融機関●
　" . $Data->get('bank_code') . " " . $Data->get('bank_name') . "
　支店 " . $Data->get('branch_name') . " " . $Data->get('branch_code') . "
　口座番号 " . $Data->get('account_number') . "
　口座名義 " . $Data->get('account_holder_furigana') . " " . $Data->get('account_holder');
        $Mail->body = str_replace('［K会員/振込口座］', $bank_text, $Mail->body);
    }

    // 管理者宛メールにtxtファイルを添付
    $text = $Mail->body;
    $text = str_replace('申請受付が完了いたしましたので、お知らせいたします。', '', $text);
    $text = strstr($text, '…………………………', true);

    $dirname = __DIR__ . "/file/service";
    $filename = $dirname . "/service_" . date_i18n('YmdHis') . "_" . $Data->get('member_id') . '.txt';
    file_put_contents($filename, $text);
    $Mail->attachments = array_merge($Mail->attachments, array($filename));
    return $Mail;
}
add_filter('mwform_admin_mail_mw-wp-form-30141', 'admin_mail', 10, 3); //お子様のお祝い
add_filter('mwform_admin_mail_mw-wp-form-30143', 'admin_mail', 10, 3); //結婚祝い
add_filter('mwform_admin_mail_mw-wp-form-30021', 'admin_mail', 10, 3); //健康診断支援
add_filter('mwform_admin_mail_mw-wp-form-30144', 'admin_mail', 10, 3); //葬儀見舞金
add_filter('mwform_admin_mail_mw-wp-form-30023', 'admin_mail', 10, 3); //JTB団体旅行
add_filter('mwform_admin_mail_mw-wp-form-30024', 'admin_mail', 10, 3); //セコム・ホームセキュリティ
add_filter('mwform_admin_mail_mw-wp-form-69792', 'admin_mail', 10, 3); //訪問理美容「KamiBito（カミビト）」

// フォーム送信者の登録アドレスに自動返信メールを送る
function auto_mail($Mail, $values, $Data)
{
    if ($Data->get('service_member_name') == '選択してください') {
        $Mail->body = str_replace('　［申請者名］選択してください' . "\r\n", '', $Mail->body);
    }
    else if ($Data->get('service_member_name') == 'サービス受領者はいません') {
        $Mail->body = str_replace('　［申請者名］サービス受領者はいません' . "\r\n", '', $Mail->body);
    }
    if (!$Data->get('bank_name')) {
        $Mail->body = str_replace('［K会員/振込口座］', '', $Mail->body);
    }
    else {
        $bank_text = "
［K会員/振込口座］
　●金融機関●
　" . $Data->get('bank_code') . " " . $Data->get('bank_name') . "
　支店 " . $Data->get('branch_name') . " " . $Data->get('branch_code') . "
　口座番号 " . $Data->get('account_number') . "
　口座名義 " . $Data->get('account_holder_furigana') . " " . $Data->get('account_holder');
        $Mail->body = str_replace('［K会員/振込口座］', $bank_text, $Mail->body);
    }
    return $Mail;
}
add_filter('mwform_auto_mail_mw-wp-form-30141', 'auto_mail', 10, 3); //お子様のお祝い
add_filter('mwform_auto_mail_mw-wp-form-30023', 'auto_mail', 10, 3); //JTB団体旅行
add_filter('mwform_auto_mail_mw-wp-form-30024', 'auto_mail', 10, 3); //セコム・ホームセキュリティ
add_filter('mwform_auto_mail_mw-wp-form-30143', 'auto_mail', 10, 3); //結婚祝い
add_filter('mwform_auto_mail_mw-wp-form-30021', 'auto_mail', 10, 3); //健康診断支援
add_filter('mwform_auto_mail_mw-wp-form-30144', 'auto_mail', 10, 3); //葬儀見舞金

// 申請者名を動的に表示
function custom_choices($children, $atts)
{
    if ($atts['name'] == 'service_member_name') {
        $member_list = $_SESSION['member_info']['member_list'];
        if ($member_list) {
            $m_id = $_SESSION['member_info']['member_id'];
            $m_name = $_SESSION['member_info']['member_name'];
            $m_type = $_SESSION['member_info']['member_type'];
            $replace_membertype = ['p_member' => 'P会員', 'k_member' => 'K会員', 'ps_member' => 'PS会員', 'ks_member' => 'KS会員'];
            $m_type_name = $replace_membertype[$m_type];
            $children[$m_id] = '契約者 ' . $m_id . ' ' . $m_name . ' （' . $m_type_name . '）';

            foreach ($member_list as $member) {
                $children[$member['member_id']] = 'サービス受領者 ' . $member['member_id'] . ' ' . $member['member_name'] . ' （' . $replace_membertype[$member['member_type']] . '）';
            }
        }
        else {
            $children['no_select'] = 'サービス受領者はいません';
        }
    }
    if ($atts['name'] == 'child_birth_year') {
        $this_year = date("Y");
        $old_year = date("Y", strtotime('-16 year'));
        for ($year = $old_year; $year <= $this_year; $year++) {
            $children[$year] = $year;
        }
    }
    return $children;
}
add_filter('mwform_choices_mw-wp-form-30141', 'custom_choices', 10, 2); //お子様のお祝い
add_filter('mwform_choices_mw-wp-form-30143', 'custom_choices', 10, 2); //結婚祝い
add_filter('mwform_choices_mw-wp-form-30021', 'custom_choices', 10, 2); //健康診断支援
add_filter('mwform_choices_mw-wp-form-30144', 'custom_choices', 10, 2); //葬儀見舞金

// カスタムタグ
function custom_mail_tag($value, $key, $insert_contact_data_id)
{
    if ($key === 'form_contact_date') {
        date_default_timezone_set('Asia/Tokyo');
        return date('Y年n月j日 G:i');
    }
    return $value;
}
add_filter('mwform_custom_mail_tag_mw-wp-form-30141', 'custom_mail_tag', 10, 3); //お子様のお祝い
add_filter('mwform_custom_mail_tag_mw-wp-form-30023', 'custom_mail_tag', 10, 3); //JTB団体旅行
add_filter('mwform_custom_mail_tag_mw-wp-form-30024', 'custom_mail_tag', 10, 3); //セコム・ホームセキュリティ
add_filter('mwform_custom_mail_tag_mw-wp-form-30143', 'custom_mail_tag', 10, 3); //結婚祝い
add_filter('mwform_custom_mail_tag_mw-wp-form-30021', 'custom_mail_tag', 10, 3); //健康診断支援
add_filter('mwform_custom_mail_tag_mw-wp-form-30144', 'custom_mail_tag', 10, 3); //葬儀見舞金
add_filter('mwform_custom_mail_tag_mw-wp-form-69792', 'custom_mail_tag', 10, 3); //訪問理美容「KamiBito（カミビト）」

// 添付ファイルを保存
function mwwpform_upload_url($path, $Data, $key)
{
    return "/service_file";
}
add_filter('mwform_upload_dir_mw-wp-form-30141', 'mwwpform_upload_url', 10, 3); //お子様のお祝い
add_filter('mwform_upload_dir_mw-wp-form-30143', 'mwwpform_upload_url', 10, 3); //結婚祝い
add_filter('mwform_upload_dir_mw-wp-form-30021', 'mwwpform_upload_url', 10, 3); //健康診断支援
add_filter('mwform_upload_dir_mw-wp-form-30144', 'mwwpform_upload_url', 10, 3); //葬儀見舞金

// 保存するファイル名を変更
function my_mwform_upload_filename($filename, $Data, $key)
{
    if ($key) {
        return current_time('Ymd-His') . '-member_id_' . $Data->get('member_id') . '-' . $key;
    }
}
add_filter('mwform_upload_filename_mw-wp-form-30141', 'my_mwform_upload_filename', 10, 3); //お子様のお祝い
add_filter('mwform_upload_filename_mw-wp-form-30143', 'my_mwform_upload_filename', 10, 3); //結婚祝い
add_filter('mwform_upload_filename_mw-wp-form-30021', 'my_mwform_upload_filename', 10, 3); //健康診断支援
add_filter('mwform_upload_filename_mw-wp-form-30144', 'my_mwform_upload_filename', 10, 3); //葬儀見舞金

// 会員情報のバリデーションルールを追加
// 会員ID
function mwform_validation_rule_member_id($validation_rules)
{
    if (!class_exists("MW_Validation_Rule_Member_ID")) {
        class MW_Validation_Rule_Member_ID extends MW_WP_Form_Abstract_Validation_Rule
        {
            /**
             * バリデーションルール名を指定
             *
             * @var string
             */
            protected $name = 'member_id';
            /**
             * バリデーションチェック
             *
             * @param string $key name属性
             * @param array  $option
             *
             * @return string エラーメッセージ
             */
            public function rule($key, array $options = array())
            {
                // 追加したいバリデーションの処理
                $value = $this->Data->get($key);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (!empty($value)) {
                    if (sprintf('%012d', $value) !== $_SESSION['member_info']['member_id']) {
                        $defaults = array(
                            'message' => __('ログイン情報が正しく取得できませんでした。再度ログインのうえ、ご申請ください。', 'mw-wp-form'),
                        );
                        $options = array_merge($defaults, $options);
                        return $options['message'];
                    }
                }
            }
            /**
             * 設定パネルに追加
             *
             * @param int   $key   バリデーションルールセットの識別番号
             * @param array $value バリデーションルールセットの内容
             */
            public function admin($key, $value)
            {
?>
<label>
    <input type="checkbox" <?php checked($value[$this->get_Name()], 1); ?> name="
    <?php echo MWF_Config::NAME; ?>[validation][
    <?php echo $key; ?>][
    <?php echo esc_attr($this->get_Name()); ?>]" value="1" />
    <?php esc_html_e('会員IDのチェック', 'mw-wp-form'); ?>
</label>
<?php
            }
        }
    }
    $instance = new MW_Validation_Rule_Member_ID();
    $validation_rules[$instance->get_Name()] = $instance;
    return $validation_rules;
}
add_filter('mwform_validation_rules', 'mwform_validation_rule_member_id');

// 会員氏名
function mwform_validation_rule_member_name($validation_rules)
{
    if (!class_exists("MW_Validation_Rule_Member_Name")) {
        class MW_Validation_Rule_Member_Name extends MW_WP_Form_Abstract_Validation_Rule
        {
            /**
             * バリデーションルール名を指定
             *
             * @var string
             */
            protected $name = 'member_name';
            /**
             * バリデーションチェック
             *
             * @param string $key name属性
             * @param array  $option
             *
             * @return string エラーメッセージ
             */
            public function rule($key, array $options = array())
            {
                // 追加したいバリデーションの処理
                $value = $this->Data->get($key);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (!empty($value)) {
                    session_start();
                    $array = array(' ', '　', "\r\n", "\r", "\n", "\t");
                    $member_name = str_replace($array, '', $_SESSION['member_info']['member_name']);
                    $value_member_name = str_replace($array, '', $value);
                    if ($value_member_name !== $member_name) {
                        $defaults = array(
                            'message' => __('ログイン情報が正しく取得できませんでした。再度ログインのうえ、ご申請ください。', 'mw-wp-form'),
                        );
                        $options = array_merge($defaults, $options);
                        return $options['message'];
                    }
                }
            }
            /**
             * 設定パネルに追加
             *
             * @param int   $key   バリデーションルールセットの識別番号
             * @param array $value バリデーションルールセットの内容
             */
            public function admin($key, $value)
            {
?>
<label>
    <input type="checkbox" <?php checked($value[$this->get_Name()], 1); ?> name="
    <?php echo MWF_Config::NAME; ?>[validation][
    <?php echo $key; ?>][
    <?php echo esc_attr($this->get_Name()); ?>]" value="1" />
    <?php esc_html_e('会員氏名のチェック', 'mw-wp-form'); ?>
</label>
<?php
            }
        }
    }
    $instance = new MW_Validation_Rule_Member_Name();
    $validation_rules[$instance->get_Name()] = $instance;
    return $validation_rules;
}
add_filter('mwform_validation_rules', 'mwform_validation_rule_member_name');

// 会員種別
function mwform_validation_rule_member_type($validation_rules)
{
    if (!class_exists("MW_Validation_Rule_Member_Type")) {
        class MW_Validation_Rule_Member_Type extends MW_WP_Form_Abstract_Validation_Rule
        {
            /**
             * バリデーションルール名を指定
             *
             * @var string
             */
            protected $name = 'member_type';
            /**
             * バリデーションチェック
             *
             * @param string $key name属性
             * @param array  $option
             *
             * @return string エラーメッセージ
             */
            public function rule($key, array $options = array())
            {
                // 追加したいバリデーションの処理
                $value = $this->Data->get($key);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (!empty($value)) {
                    session_start();
                    $member_type_array = array(
                        'p_member' => 'P会員',
                        'k_member' => 'K会員',
                        'ps_member' => 'PS会員',
                        'ks_member' => 'KS会員',
                    );
                    if ($value !== $member_type_array[$_SESSION['member_info']['member_type']]) {
                        $defaults = array(
                            'message' => __('ログイン情報が正しく取得できませんでした。再度ログインのうえ、ご申請ください。', 'mw-wp-form'),
                        );
                        $options = array_merge($defaults, $options);
                        return $options['message'];
                    }
                }
            }
            /**
             * 設定パネルに追加
             *
             * @param int   $key   バリデーションルールセットの識別番号
             * @param array $value バリデーションルールセットの内容
             */
            public function admin($key, $value)
            {
?>
<label>
    <input type="checkbox" <?php checked($value[$this->get_Name()], 1); ?> name="
    <?php echo MWF_Config::NAME; ?>[validation][
    <?php echo $key; ?>][
    <?php echo esc_attr($this->get_Name()); ?>]" value="1" />
    <?php esc_html_e('会員種別のチェック', 'mw-wp-form'); ?>
</label>
<?php
            }
        }
    }
    $instance = new MW_Validation_Rule_Member_Type();
    $validation_rules[$instance->get_Name()] = $instance;
    return $validation_rules;
}
add_filter('mwform_validation_rules', 'mwform_validation_rule_member_type');

// サービス利用開始日
function mwform_validation_rule_start_date($validation_rules)
{
    if (!class_exists("MW_Validation_Rule_Start_Date")) {
        class MW_Validation_Rule_Start_Date extends MW_WP_Form_Abstract_Validation_Rule
        {
            /**
             * バリデーションルール名を指定
             *
             * @var string
             */
            protected $name = 'start_date';
            /**
             * バリデーションチェック
             *
             * @param string $key name属性
             * @param array  $option
             *
             * @return string エラーメッセージ
             */
            public function rule($key, array $options = array())
            {
                // 追加したいバリデーションの処理
                $value = $this->Data->get($key);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if (!empty($value)) {
                    $startdate = $_SESSION['member_info']['startdate'];
                    $startdate_datetime = new DateTime($startdate);
                    $startdate_display = $startdate_datetime->format('Y年n月j日');
                    if ($value !== $startdate_display) {
                        $defaults = array(
                            'message' => __('ログイン情報が正しく取得できませんでした。再度ログインのうえ、ご申請ください。', 'mw-wp-form'),
                        );
                        $options = array_merge($defaults, $options);
                        return $options['message'];
                    }
                }
            }
            /**
             * 設定パネルに追加
             *
             * @param int   $key   バリデーションルールセットの識別番号
             * @param array $value バリデーションルールセットの内容
             */
            public function admin($key, $value)
            {
?>
<label>
    <input type="checkbox" <?php checked($value[$this->get_Name()], 1); ?> name="
    <?php echo MWF_Config::NAME; ?>[validation][
    <?php echo $key; ?>][
    <?php echo esc_attr($this->get_Name()); ?>]" value="1" />
    <?php esc_html_e('会員の利用開始日のチェック', 'mw-wp-form'); ?>
</label>
<?php
            }
        }
    }
    $instance = new MW_Validation_Rule_Start_Date();
    $validation_rules[$instance->get_Name()] = $instance;
    return $validation_rules;
}
add_filter('mwform_validation_rules', 'mwform_validation_rule_start_date');

/*-------------------------------------------*/
/*  使用していないページを出力しない
 /*-------------------------------------------*/
// 編集者ページを無効にする
// add_filter( 'author_rewrite_rules', '__return_empty_array' );
// function disable_author_archive() {
// 	if( $_GET['author'] || preg_match('#/author/.+#', $_SERVER['REQUEST_URI']) ){
// 		wp_redirect( home_url( '/' ) );
// 		exit;
// 	}
// }
// add_action('init', 'disable_author_archive');
add_filter('author_rewrite_rules', '__return_empty_array');
add_action('init', function () {
    if (preg_match('#/author/.+#', $_SERVER['REQUEST_URI'])) {
        wp_redirect(esc_url(home_url('/404.php')));
        exit;
    }
});

/*-------------------------------------------*/
/*  お問い合わせフォーム
 /*-------------------------------------------*/
// バリデーションルールを追加 日本語を含むことを必須にする
if (class_exists('MW_WP_Form_Abstract_Validation_Rule')) {
    class MW_WP_Form_Validation_Rule_Japanese extends MW_WP_Form_Abstract_Validation_Rule
    {
        protected $name = 'japanese';

        public function rule($key, array $options = array())
        {
            $value = $this->Data->get($key);
            if (is_null($value)) {
                return;
            }
            if (preg_match('/[一-龠]+|[ぁ-ん]+|[ァ-ヴー]/u', $value)) {
                return;
            }
            $defaults = array(
                'message' => '日本語で入力してください。'
            );
            $options = array_merge($defaults, $options);
            return $options['message'];
        }

        public function admin($key, $value)
        {
?>
<label><input type="checkbox" <?php checked($value[$this->get_name()], 1); ?> name="
    <?php echo MWF_Config::NAME; ?>[validation][
    <?php echo $key; ?>][
    <?php echo esc_attr($this->get_name()); ?>]" value="1" />日本語を含む
</label>
<?php
        }
    }

    function mwform_validation_rule_japanese($validation_rules)
    {
        $instance = new MW_WP_Form_Validation_Rule_Japanese();
        $validation_rules[$instance->get_name()] = $instance;
        return $validation_rules;
    }

    add_filter('mwform_validation_rules', 'mwform_validation_rule_japanese');

    add_filter('wpcf7_autop_or_not', 'wpcf7_autop_return_false');
    function wpcf7_autop_return_false()
    {
        return false;
    }
}

/*-------------------------------------------*/
/*  あうるアンケート
 /*-------------------------------------------*/
// バリデーション・エラーメッセージを設定
// function aul_mwform_validation_rule($Validation, $data) {
//     if (isset($data['interest_page'])) {
//         if ($data['interest_page'] == 'はい') {
//             $Validation->set_rule('interest_page_yes', 'required', array('message' => '「はい」をご選択いただいた場合、こちらの項目は必須です'));
//         }
//     }

//     $interest_page_yes = $data['interest_page_yes'];
//     if( isset( $interest_page_yes ) && $interest_page_yes === '改善してほしいところがある' ) {
//       $Validation->set_rule( 'interest_page_yes_comment', 'noEmpty', array( 'message' => '「改善してほしいところがある」をご選択いただいた場合、こちらの項目は必須です') );
//     }

//     return $Validation;
// }
// add_filter('mwform_validation_mw-wp-form-67845', 'aul_mwform_validation_rule', 10, 3);
function aul_mwform_validation_rule($Validation, $data, $Form)
{
    // book_viewing がセットされていて "はい" のときに book_viewing_use を必須にする
    $Validation->set_rule(
        'book_viewing',
        'noEmpty',
        array('message' => '選択してください')
    );

    if (isset($data['book_viewing']) && $data['book_viewing'] === 'はい') {
        $Validation->set_rule(
            'book_viewing_use',
            'noEmpty',
            array('message' => '「はい」をご選択いただいた場合、こちらの項目は必須です')
        );
    }

    if (isset($data['participate']) && $data['participate'] === 'その他') {
        $Validation->set_rule(
            'book_viewing_use',
            'noEmpty',
            array('message' => '「その他」をご選択いただいた場合、こちらの項目は必須です')
        );
    }

    return $Validation;
}
add_filter('mwform_validation_mw-wp-form-67845', 'aul_mwform_validation_rule', 10, 3);


add_filter('mwform_validation_mw-wp-form-67845', function ($Validation, $data, $Form) {

    if (!session_id()) {
        session_start();
    }

    $start_time = $_SESSION['form_start_time'] ?? 0;

    if ($start_time && (time() - $start_time) < 10) {
        $Validation->set_rule('spam_check_time', 'noEmpty', array(
            'message' => '不正な送信です。'
        ));
    }

    // if (!empty($data['hidden_spam_field'])) {
    //     $Validation->set_rule('hidden_spam_field', 'required', array(
    //         'message' => '不正な送信が検出されました。'
    //     ));
    // }

    return $Validation;

}, 9, 3);

function check_post_data_missing($Validation, $data, $obj)
{
    if (!isset($_POST['_mwform_confirm_submit'])) {
        return $Validation;
    }

    $missing = false;
    // [data]構造を持つ項目リスト
    $complex_fields = ['volume', 'participate', 'agree', 'book_viewing_use'];

    $required_keys = [
        'volume',
        'name',
        'email',
        'agree',
        'book_viewing',
    ];

    // book_viewingが「はい」なら book_viewing_use を必須に追加
    if (isset($data['book_viewing']) && $data['book_viewing'] === 'はい') {
        $required_keys[] = 'book_viewing_use';
    }

    // book_viewingが「はい」なら participateは必須（既存の要件があれば残す）
    if (
    isset($data['book_viewing']) &&
    $data['book_viewing'] === 'はい'
    ) {
        $required_keys[] = 'participate';

        // participate[data] or participate どちらでも取得
        $raw_participate = $data['participate']['data'] ?? $data['participate'] ?? null;

        if (is_array($raw_participate)) {
            $participate_values = $raw_participate;
        }
        elseif (is_string($raw_participate)) {
            $participate_values = [$raw_participate];
        }
        else {
            $participate_values = [];
        }

        // 「その他」が含まれていたら book_viewing_use の文字数検査を行う（さらに厳密化）
        if (in_array('その他', $participate_values, true)) {

            $book_viewing_use_val = '';

            if (array_key_exists('book_viewing_use', $data)) {
                if (is_array($data['book_viewing_use'])) {
                    $book_viewing_use_val = $data['book_viewing_use']['data'] ?? '';
                }
                elseif (is_string($data['book_viewing_use'])) {
                    $book_viewing_use_val = $data['book_viewing_use'];
                }
            }

            if (mb_strlen(trim($book_viewing_use_val)) < 2) {
                $Validation->set_rule('book_viewing_use', 'noEmpty', [
                    'message' => '「その他」をご選択いただいた場合、2文字以上の入力が必要です。',
                    'force' => true,
                ]);
                $missing = true;
            }
        }
    }

    // 入力漏れチェック
    foreach ($required_keys as $key) {
        // 最初に未定義チェックを追加
        if (!isset($data[$key])) {
            $missing = true;
            break;
        }

        $target = $data[$key];

        if (in_array($key, $complex_fields, true)) {
            if (is_array($target) && isset($target['data'])) {
                $target = $target['data'];
            }
            elseif (is_array($target) && array_keys($target) === range(0, count($target) - 1)) {
                $target = $target;
            }
        }

        if (is_array($target)) {
            if (count(array_filter($target, 'strlen')) === 0) {
                $missing = true;
                break;
            }
        }
        elseif (is_string($target)) {
            if (trim($target) === '') {
                $missing = true;
                break;
            }
        }
        else {
            // string/array以外は無効とする
            $missing = true;
            break;
        }
    }

    if ($missing) {
        foreach ($required_keys as $field) {
            $Validation->set_rule($field, 'noEmpty', [
                'message' => 'セッションが切れたか、入力内容に不備があります。もう一度ご入力ください。',
                'force' => true,
            ]);
        }
    }

    return $Validation;
}
add_filter('mwform_validation_mw-wp-form-67845', 'check_post_data_missing', 10, 3);

function log_cleaned_post_data_with_rotation($Data, $Mail, $FormKey)
{
    if ($FormKey !== 'mw-wp-form-67845')
        return;

    $log_path = get_stylesheet_directory() . '/log/aul_form-log.txt';
    $max_size = 102400;

    $cleaned = [];
    foreach ($Data as $key => $value) {
        if (
        strpos($key, '__') === 0 ||
        in_array($key, ['_wpnonce', 'mw-wp-form-id'])
        ) {
            continue;
        }

        if (is_array($value) && isset($value['data'])) {
            $cleaned[] = trim($value['data']);
        }
        elseif (is_array($value)) {
            $cleaned[] = implode(',', array_map('trim', $value));
        }
        else {
            $cleaned[] = trim($value);
        }
    }

    $date = new DateTime('now', new DateTimeZone('Asia/Tokyo'));
    $timestamp = $date->format('Y-m-d H:i:s (T)');
    $log_entry = "=== {$timestamp} ===\n" . implode(',', $cleaned) . "\n\n";

    $current_log = file_exists($log_path) ? file_get_contents($log_path) : '';
    $current_log .= $log_entry;

    $lines = explode("\n", $current_log);
    while (strlen(implode("\n", $lines)) > $max_size && count($lines) > 20) {
        array_splice($lines, 0, 10);
    }

    @file_put_contents($log_path, implode("\n", $lines));
}
add_action('mwform_before_send_mw-wp-form-67845', 'log_cleaned_post_data_with_rotation', 10, 3);


// add_action('init', function () {
//     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         $log_path = get_stylesheet_directory() . '/log/aul_form-log.txt';
//         $max_size = 102400;

//         if (file_exists($log_path) && filesize($log_path) > $max_size) {
//             file_put_contents($log_path, "=== Log reset due to size limit ===\n");
//         }

//         $log_data = "POST: " . print_r($_POST, true) . "\n";
//         $log_data .= "REQUEST: " . print_r($_REQUEST, true) . "\n";

//         $log_entry = "=== " . date('Y-m-d H:i:s') . " (" . date_default_timezone_get() . ") ===\n" . $log_data . "\n";

//         $result = @file_put_contents($log_path, $log_entry, FILE_APPEND);
//         if ($result === false) {
//             error_log("!!! Failed to write to $log_path");
//         }
//     }
// });

/*-------------------------------------------*/
/*  親ページのスラッグを取得
 /*-------------------------------------------*/
function is_parent_slug()
{
    global $post;
    if ($post->post_parent) {
        $post_data = get_post($post->post_parent);
        return $post_data->post_name;
    }
}

/*-------------------------------------------*/
/*  contact form 7
 /*-------------------------------------------*/
// お問い合わせページを除き、「reCAPTCHA」を読み込ませない
function load_recaptcha_js()
{
    $cf7_pages = array('cancel-mail-magazine', 'questionnaire', 'confirmation', 'thanks', 'service-survey', 'convention-ticket');
    if (!is_page($cf7_pages)) {
        wp_deregister_script('google-recaptcha');
    }
}
add_action('wp_enqueue_scripts', 'load_recaptcha_js', 100);

add_filter('wpcf7_recaptcha_threshold',
    function ($threshold) {
        $threshold = 0.2;
        return $threshold;
    },
    10, 1
);

// サービスアンケート
// IDがef848baのフォームにのみ適用
add_filter('wpcf7_validate_textarea', 'custom_text_validation_filter', 20, 2);
add_filter('wpcf7_validate_textarea*', 'custom_text_validation_filter', 20, 2);
function custom_text_validation_filter($result, $tag)
{
    // 現在のフォームインスタンスを取得
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $contact_form = WPCF7_ContactForm::get_current();
        if ($contact_form->id() != 'ef848ba') { // サービスアンケートのみ以下のバリデーションを適用
            // フォームIDが一致しなければ何もせず返す
            return $result;
        }
    }

    // バリデーションロジック
    $name = $tag['name'];
    $value = isset($_POST[$name]) ? trim($_POST[$name]) : '';
    if ($name == 'textarea-internet_usage-free') {
        if (empty($value) && isset($_POST['checkbox-internet_usage']) && $_POST['checkbox-internet_usage'] == 'その他') {
            $result->invalidate($tag, "入力してください。");
        }
    }
    return $result;
}

add_filter('wpcf7_validate', 'my_wpcf7_validate', 11, 2);
function my_wpcf7_validate($result, $tags)
{
    // 現在のフォームインスタンスを取得
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $contact_form = WPCF7_ContactForm::get_current();
        if ($contact_form->id() != 'ef848ba') { // サービスアンケートのみ以下のバリデーションを適用
            // フォームIDが一致しなければ何もせず返す
            return $result;
        }

        $data = $submission->get_posted_data();

        // 日常生活でのインターネットやWEBの利用状況
        $internet_usage = isset($data['checkbox-internet_usage']) ? $data['checkbox-internet_usage'] : '';
        $internet_usage_free = isset($data['textarea-internet_usage-free']) ? $data['textarea-internet_usage-free'] : '';
        if (in_array('その他', (array)$internet_usage) && !$internet_usage_free) {
            $result->invalidate('textarea-internet_usage-free', '必須項目に入力してください。');
        }

        // ライフサポートサービスの利用状況
        $radio_use = isset($data['radio-use']) ? $data['radio-use'] : '';
        $checkbox_use_history = isset($data['checkbox-use_history']) ? $data['checkbox-use_history'] : '';
        $use_history_free = isset($data['textarea-use_history-free']) ? $data['textarea-use_history-free'] : '';
        $checkbox_not_use = isset($data['checkbox-not_use']) ? $data['checkbox-not_use'] : '';
        $not_use_free = isset($data['textarea-not_use-free']) ? $data['textarea-not_use-free'] : '';

        if ($radio_use == '利用したことがある') {
            if (empty($checkbox_use_history)) {
                $result->invalidate('checkbox-use_history', '必須項目に入力してください。');
            }
            if (in_array('その他', (array)$checkbox_use_history) && !$use_history_free) {
                $result->invalidate('textarea-use_history-free', '必須項目に入力してください。');
            }
        }
        else if ($radio_use == '利用したことがない') {
            if (empty($checkbox_not_use)) {
                $result->invalidate('checkbox-not_use', '必須項目に入力してください。');
            }
            if (in_array('その他', (array)$checkbox_not_use) && !$not_use_free) {
                $result->invalidate('textarea-not_use-free', '必須項目に入力してください。');
            }
        }

        // 充実させてほしいサービスのジャンル
        $service_genre = isset($data['checkbox-service_genre']) ? $data['checkbox-service_genre'] : '';
        $service_about = isset($data['textarea-service_about']) ? $data['textarea-service_about'] : '';
        if (in_array('その他', (array)$service_genre) && !$service_about) {
            $result->invalidate('textarea-service_about', '必須項目に入力してください。');
        }
    }

    return $result;
}

function output_report_date_select()
{
    $options = ['お選びください'];
    for ($i = 0; $i < 36; $i++) {
        $date = new DateTime('first day of this month');
        $date->modify("-{$i} months");
        $label = $date->format('Y年m月');
        $options[] = $label;
    }
    $option_str = implode(',', $options);
    return do_shortcode('[mwform_select name="use_report_date" class="w-100" children="' . esc_attr($option_str) . '"]');
}
add_shortcode('output_report_date_select', 'output_report_date_select');

add_filter('mwform_custom_mail_tag_mw-wp-form-71563', function ($value, $key) {
    if ($key === 'use_report_date' && isset($_POST[$key])) {
        return sanitize_text_field($_POST[$key]);
    }
    return $value;
}, 10, 2);

/*-------------------------------------------*/
/*  管理画面メニューカスタマイズ
 /*-------------------------------------------*/
add_action('admin_menu', 'custom_menu_page');
function custom_menu_page()
{
    // 親メニューを追加
    add_menu_page(
        'データダウンロード', // ページタイトル
        'FAQ検索結果フィードバック', // メニューの名前
        'manage_options', // 権限
        'faq-all-resolve-download-menu', // スラッグ
        'add_custom_menu_page_faq_all_resolve_data', // 表示する関数
        'dashicons-admin-generic', // アイコン
        28 // 表示順
    );
    add_menu_page(
        'データダウンロード', // ページタイトル
        'FAQフィードバック', // メニューの名前
        'manage_options', // 権限
        'faq-resolve-download-menu', // スラッグ
        'add_custom_menu_page_faq_resolve_data', // 表示する関数
        'dashicons-admin-generic', // アイコン
        28 // 表示順
    );
    // 親メニューを追加
    add_menu_page(
        'データダウンロード', // ページタイトル
        'キャンペーン応募データ', // メニューの名前
        'manage_options', // 権限
        'campaign-download-menu', // スラッグ
        'add_custom_menu_page_campaign_data', // 表示する関数
        'dashicons-admin-generic', // アイコン
        29 // 表示順
    );
}
function add_custom_menu_page_faq_resolve_data()
{
    require_once(dirname(__FILE__) . '/templates-admin/admin-faq_resolve_data.php');
}
function add_custom_menu_page_faq_all_resolve_data()
{
    require_once(dirname(__FILE__) . '/templates-admin/admin-faq_all_resolve_data.php');
}
function add_custom_menu_page_campaign_data()
{
    require_once(dirname(__FILE__) . '/templates-admin/admin-campaign_data.php');
}

/*-------------------------------------------*/
/*  キャンペーン応募フォーム
 /*-------------------------------------------*/
function campaign_entry_form($atts)
{
    // ショートコードの属性を取得（デフォルト値あり）
    $atts = shortcode_atts([
        'title' => 'キャンペーン応募フォーム',
        'back_url' => '/'
    ], $atts, 'campaign_form');

    // WordPressのnonceを生成（二重送信対策）
    $nonce = wp_create_nonce('campaign_entry_nonce');

    ob_start(); // 出力をバッファリング
?>
<form id="campaign-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <div class="campaign-form">
        <div class="campaign-form__content mt-5">
            <input type="hidden" name="action" value="campaign_entry">
            <input type="hidden" name="campaign_title" value="<?php if (!$atts['title']) {
        echo 'キャンペーン応募フォーム';
    }
    else {
        echo esc_attr($atts['title']);
    }?>">
            <input type="hidden" name="campaign_nonce" value="<?php echo esc_attr($nonce); ?>">
            <div class="inputbox row">
                <div class="col-md-5 titlearea">会員ID</div>
                <div class="col-md-7 inputarea form-group mt-2 mt-md-0 mb-4">
                    <input type="text" name="member_id" class="readonly border-0 bg-white form-control" size="60"
                        value="<?php echo $_SESSION['member_info']['member_id']; ?>" readonly="readonly" required>
                </div>
            </div>
            <div class="inputbox last row">
                <div class="col-md-5 titlearea">氏名</div>
                <div class="col-md-7 inputarea form-group mt-2 mt-md-0 mb-4">
                    <input type="text" name="member_name" class="readonly border-0 bg-white form-control" size="60"
                        value="<?php echo $_SESSION['member_info']['member_name']; ?>" readonly="readonly" required>
                </div>
            </div>
            <p id="message" class="text-danger text-center mb-3" style="display: none;"></p>
            <div class="next-action mx-auto text-center">
                <input type="submit" id="submit-button" value="応募する"
                    class="next-action_btm px-4 rounded-pill btn bg_darkg">
                <div id="loading" class="loading-parent loading-style" style="display: none;">
                    <span class="loading loading-circle"></span>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="campaign-form mt-2 mb-4">
    <div class="next-action mx-auto text-center">
        <a href="<?php if ($atts['back_url']) {
        echo esc_attr($atts['back_url']);
    }
    else {
        echo '/';
    }?>" class="confirm__back px-4 rounded-pill btn">戻る</a>
    </div>
</div>

<script>
    document.getElementById("campaign-form").addEventListener("submit", function (event) {
        event.preventDefault(); // 通常の送信を防ぐ

        let form = event.target;
        let formData = new FormData(form);
        let submitButton = document.getElementById("submit-button");
        let loading = document.getElementById("loading");
        let message = document.getElementById("message");
        // let campaignContainer = document.getElementById("campaign-container");

        submitButton.disabled = true; // ボタンを無効化
        loading.style.display = "block"; // ローディングを表示
        message.style.display = "none"; // メッセージを非表示

        fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                loading.style.display = "none"; // ローディングを非表示
                if (data.success) {
                    submitButton.classList.add("no-click");
                    message.innerHTML = "ご応募が完了いたしました。";
                    message.style.display = "block";
                } else {
                    message.innerHTML = data.data.message;
                    message.style.display = "block";
                    submitButton.disabled = false; // エラー時はボタンを再度有効化
                }
            })
            .catch(error => {
                loading.style.display = "none";
                message.innerHTML = "通信エラーが発生しました。";
                message.style.display = "block";
                submitButton.disabled = false;
            });
    });
</script>

<?php
    return ob_get_clean();
}
add_shortcode('campaign_form', 'campaign_entry_form');

function handle_campaign_entry()
{
    session_start();

    // 入力チェック
    if (empty($_POST['member_id']) || $_POST['member_id'] != $_SESSION['member_info']['member_id']) {
        wp_send_json_error(['message' => '会員IDが正しく入力されていません。応募内容やログイン状況を見直してください。']);
    }

    if (empty($_POST['member_name']) || $_POST['member_name'] != $_SESSION['member_info']['member_name']) {
        wp_send_json_error(['message' => '氏名が正しく入力されていません。応募内容やログイン状況を見直してください。']);
    }

    if (empty($_POST['campaign_title']) || empty($_POST['campaign_nonce'])) {
        wp_send_json_error(['message' => 'データの送信に失敗しました。']);
    }

    // nonceチェック
    if (!wp_verify_nonce($_POST['campaign_nonce'], 'campaign_entry_nonce')) {
        wp_send_json_error(['message' => 'エラーが発生しました。不正なリクエストです。']);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'campaign_entries';

    // データをサニタイズ
    $member_id = sanitize_text_field($_POST['member_id']);
    $member_name = sanitize_text_field($_POST['member_name']);
    $campaign_name = sanitize_text_field($_POST['campaign_title']);

    // DBへ保存
    $data = [
        'member_id' => $member_id,
        'member_name' => $member_name,
        'campaign_name' => $campaign_name,
        'entry_date' => current_time('mysql'),
        'created_at' => current_time('mysql'),
        'updated_at' => current_time('mysql')
    ];

    $result = $wpdb->insert($table_name, $data);

    if ($result) {
        wp_send_json_success();
    }
    else {
        wp_send_json_error(['message' => 'データの送信に失敗しました。']);
    }
}
add_action('wp_ajax_campaign_entry', 'handle_campaign_entry');
add_action('wp_ajax_nopriv_campaign_entry', 'handle_campaign_entry'); // 未ログインでも実行

add_action('send_headers', 'add_nosniff_header_on_frontpage_video');
function add_nosniff_header_on_frontpage_video()
{
    if (is_front_page() && function_exists('CFS')) {
        $login_top_movie = CFS()->get('nmember_page_top_movie', get_queried_object_id());

        if (!empty($login_top_movie)) {
            header('X-Content-Type-Options: nosniff');
        }
    }
}

// add_filter('mwform_form_tag_mwform_select', function( $tag, $atts ) {
//     if (isset($tag['name']) && $tag['name'] === 'use_report_date') {
//         $children = ['お選びください'];
//         for ($i = 0; $i < 36; $i++) {
//             $ts = strtotime(date('Y-m-01') . " -{$i} months");
//             $label = date('Y年m月', $ts);
//             $children[] = $label;
//         }
//         $tag['children'] = $children;
//     }
//     return $tag;
// }, 10, 2);

function custom_maintenance_mode()
{
    if (!current_user_can('manage_options')) { // 管理者以外に表示
        $now = current_time('timestamp');
        $start = strtotime('2026-03-3 10:00:00');
        $end = strtotime('2026-03-3 12:00:00');

        if ($now >= $start && $now <= $end) {
            wp_die(
                '<h1>メンテナンス中</h1><p>ご不便をおかけしており申し訳ございません。<br>現在、システムメンテナンス中です。<br>終了予定：2026年3月4日 AM9:00</p>',
                'メンテナンス中',
                array('response' => 503)
            );
        }
    }
}
add_action('template_redirect', 'custom_maintenance_mode');

add_action('save_post_lifesupport', function ($post_id, $post, $update) {
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id))
        return;

    $terms = wp_get_post_terms($post_id, 'lifesupport_cat', ['fields' => 'ids']);
    if (is_wp_error($terms) || empty($terms))
        return;

    foreach ($terms as $term_id) {
        foreach ([0, 1] as $loginFlag) {
            delete_transient(sprintf('ls_cat_%d_login_%d_v1', (int)$term_id, $loginFlag));
        }
    }
}, 10, 3);

add_action('edited_lifesupport_cat', function ($term_id) {
    foreach ([0, 1] as $loginFlag) {
        delete_transient(sprintf('ls_cat_%d_login_%d_v1', (int)$term_id, $loginFlag));
    }
}, 10, 1);

add_action('save_post_service-experience', function ($post_id) {
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }

    $service_id = get_post_meta($post_id, 'service', true);
    if ($service_id) {
        delete_transient("exp_total_{$service_id}");
    }
});

// 汎用ヘルパー：画像フィールドをURLに正規化
function get_image_field_url($post_id, $key, $size = 'full')
{
    // 1) まず生メタ
    $v = get_post_meta($post_id, $key, true);

    // A. 配列（ACFの返りが配列設定）→ ['url'] 優先
    if (is_array($v)) {
        if (!empty($v['sizes'][$size]))
            return $v['sizes'][$size];
        if (!empty($v['url']))
            return $v['url'];
        if (!empty($v['ID']))
            return wp_get_attachment_image_url((int)$v['ID'], $size) ?: '';
    }

    // B. 数値（添付ID）→ 画像URLに変換
    if (is_numeric($v)) {
        $url = wp_get_attachment_image_url((int)$v, $size);
        if ($url)
            return $url;
    }

    // C. 文字列URLがそのまま入っているケース
    if (is_string($v) && $v !== '') {
        return $v;
    }

    // D. 生メタで取れなければ ACF/CFS にフォールバック（互換維持）
    if (function_exists('get_field')) {
        $fv = get_field($key, $post_id);
        if (is_array($fv)) {
            if (!empty($fv['sizes'][$size]))
                return $fv['sizes'][$size];
            if (!empty($fv['url']))
                return $fv['url'];
            if (!empty($fv['ID']))
                return wp_get_attachment_image_url((int)$fv['ID'], $size) ?: '';
        }
        elseif (is_numeric($fv)) {
            $url = wp_get_attachment_image_url((int)$fv, $size);
            if ($url)
                return $url;
        }
        elseif (is_string($fv) && $fv !== '') {
            return $fv;
        }
    }
    if (function_exists('CFS')) {
        $cv = CFS()->get($key, $post_id);
        if (is_array($cv)) {
            if (!empty($cv['sizes'][$size]))
                return $cv['sizes'][$size];
            if (!empty($cv['url']))
                return $cv['url'];
            if (!empty($cv['ID']))
                return wp_get_attachment_image_url((int)$cv['ID'], $size) ?: '';
        }
        elseif (is_numeric($cv)) {
            $url = wp_get_attachment_image_url((int)$cv, $size);
            if ($url)
                return $url;
        }
        elseif (is_string($cv) && $cv !== '') {
            return $cv;
        }
    }

    return '';
}

// ===== 共通：キャッシュ版数 =====
function ls_get_cat_cache_version(): int
{
    return (int)get_option('ls_cat_cache_version', 1);
}
function ls_bump_cat_cache_version(): void
{
    $v = ls_get_cat_cache_version();
    update_option('ls_cat_cache_version', $v + 1, false); // autoloadしない
}

// ===== 共通：キー生成 =====
function ls_cat_cache_key(int $term_id, int $paged = 1): string
{
    return sprintf('ls_cat_%d_p%d_v1', $term_id, max(1, $paged));
}

// ===== オブジェクトキャッシュがあればそれを優先 =====
function ls_cache_get(string $key)
{
    if (wp_using_ext_object_cache()) {
        return wp_cache_get($key, 'ls');
    }
    return get_transient($key);
}
function ls_cache_set(string $key, $value, int $ttl): bool
{
    if (wp_using_ext_object_cache()) {
        return wp_cache_set($key, $value, 'ls', $ttl);
    }
    return set_transient($key, $value, $ttl);
}

// ===== 無効化トリガ（投稿/ターム/添付の更新でバージョンを上げる） =====
add_action('save_post', 'ls_bump_cat_cache_version'); // すべての投稿
add_action('deleted_post', 'ls_bump_cat_cache_version');
add_action('save_post_attachment', 'ls_bump_cat_cache_version'); // 画像やPDF差し替えにも対応
add_action('created_term', 'ls_bump_cat_cache_version', 10, 3);
add_action('edited_term', 'ls_bump_cat_cache_version', 10, 3);
add_action('delete_term', 'ls_bump_cat_cache_version', 10, 4);
add_action('set_object_terms', 'ls_bump_cat_cache_version', 10, 6);

function info_ajax_log($msg)
{
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[info-ajax] ' . $msg);
    }
}

/**
 * Parse incoming IDs from various request formats:
 * - FormData with ids[] -> $_POST['ids'] as array
 * - application/x-www-form-urlencoded with ids JSON string in $_POST['ids']
 * - raw JSON body: {"ids": [1,2,3]}
 * Returns array of ints or empty array.
 */
function info_ajax_parse_ids()
{
    $ids = [];

    // 1) If $_POST['ids'] exists and is array (FormData ids[])
    if (isset($_POST['ids']) && is_array($_POST['ids'])) {
        $ids = $_POST['ids'];
    }
    // 2) If $_POST['ids'] exists and is string (maybe JSON)
    elseif (isset($_POST['ids']) && is_string($_POST['ids'])) {
        $maybe = json_decode(strval($_POST['ids']), true);
        if (is_array($maybe)) {
            $ids = $maybe;
        }
        else {
            // maybe comma separated string
            $str = trim($_POST['ids']);
            if ($str !== '') {
                $parts = preg_split('/\s*,\s*/', $str);
                if ($parts && count($parts) > 0)
                    $ids = $parts;
            }
        }
    }

    // 3) If still empty, try raw JSON body
    if (empty($ids)) {
        $raw = file_get_contents('php://input');
        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded) && isset($decoded['ids']) && is_array($decoded['ids'])) {
                $ids = $decoded['ids'];
            }
        }
    }

    // Normalize to integer values and remove empties
    $ids = array_filter(array_map(function ($v) {
        // allow numeric strings; cast to int, then to string if desired
        return is_numeric($v) ? intval($v) : null;
    }, $ids), function ($v) {
        return !is_null($v);
    });

    // Reindex and return
    return array_values($ids);
}

// AJAX: mark_info_read
add_action('wp_ajax_mark_info_read', 'mark_info_read_ajax');
add_action('wp_ajax_nopriv_mark_info_read', 'mark_info_read_ajax');

function mark_info_read_ajax()
{
    global $wpdb;

    // Ensure session
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Parse incoming ids (supports ids[] via FormData)
    $ids = [];
    if (isset($_POST['ids']) && is_array($_POST['ids'])) {
        $ids = $_POST['ids'];
    }
    elseif (isset($_POST['ids']) && is_string($_POST['ids'])) {
        $maybe = json_decode(strval($_POST['ids']), true);
        if (is_array($maybe))
            $ids = $maybe;
    }
    else {
        // also check raw JSON body
        $raw = file_get_contents('php://input');
        if ($raw) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded) && isset($decoded['ids']) && is_array($decoded['ids'])) {
                $ids = $decoded['ids'];
            }
        }
    }
    // Normalize and cast to ints
    $ids = array_values(array_filter(array_map(function ($v) {
        return is_numeric($v) ? intval($v) : null;
    }, (array)$ids)));

    $all_flag = (isset($_POST['all']) && strval($_POST['all']) === '1') || (isset($_REQUEST['all']) && strval($_REQUEST['all']) === '1');

    // Defensive: require either ids or all flag
    if (!$all_flag && empty($ids)) {
        wp_send_json_error(['message' => 'invalid_ids']);
        wp_die();
    }

    // Ensure session array exists
    if (!isset($_SESSION['is_unread']) || !is_array($_SESSION['is_unread'])) {
        $_SESSION['is_unread'] = [];
    }

    // If user is logged in, persist into DB table (prefix_read)
    $user_id = null;
    if (is_user_logged_in()) {
        $user_id = get_current_user_id();
    }
    elseif (isset($_SESSION['member_info']['member_id'])) {
        // If you store member_id in session for non-WP-login, use it
        $user_id = intval($_SESSION['member_info']['member_id']);
    }

    $table_name = $wpdb->prefix . 'read'; // will become e.g. wpz_read if prefix is 'wpz_'

    if ($all_flag) {
        // mark all unread as read: clear session and optionally persist to DB
        if ($user_id) {
            // For performance, you may want to insert in bulk or use REPLACE; here we loop safely
            foreach ($_SESSION['is_unread'] as $pid) {
                $pid = intval($pid);
                if ($pid <= 0)
                    continue;
                // check existence
                $exists = $wpdb->get_var($wpdb->prepare(
                    "SELECT COUNT(*) FROM {$table_name} WHERE member_id = %d AND post_id = %d",
                    $user_id, $pid
                ));
                if (empty($exists)) {
                    $wpdb->insert($table_name, [
                        'member_id' => $user_id,
                        'post_id' => $pid,
                        'read_date' => current_time('mysql'),
                        'is_read' => 1,
                    ], ['%d', '%d', '%s', '%d']);
                }
            }
        }
        $_SESSION['is_unread'] = [];
    }
    else {
        // handle specific ids
        foreach ($ids as $pid) {
            $pid = intval($pid);
            if ($pid <= 0)
                continue;

            // persist to DB if we have a user_id
            if ($user_id) {
                $exists = $wpdb->get_var($wpdb->prepare(
                    "SELECT COUNT(*) FROM {$table_name} WHERE member_id = %d AND post_id = %d",
                    $user_id, $pid
                ));
                if (empty($exists)) {
                    $wpdb->insert($table_name, [
                        'member_id' => $user_id,
                        'post_id' => $pid,
                        'read_date' => current_time('mysql'),
                        'is_read' => 1,
                    ], ['%d', '%d', '%s', '%d']);
                }
            }

            // remove from session unread list
            if (!empty($_SESSION['is_unread'])) {
                $_SESSION['is_unread'] = array_values(array_diff($_SESSION['is_unread'], [$pid]));
            }
        }
    }

    // For backward compatibility, keep is_read key aligned (some code referenced is_read)
    $_SESSION['is_read'] = isset($_SESSION['is_unread']) ? $_SESSION['is_unread'] : [];

    // if logged in, optionally persist session into user_meta as backup (optional)
    if ($user_id && is_numeric($user_id)) {
        update_user_meta($user_id, 'member_unread_list', $_SESSION['is_unread']);
        delete_transient('unread_array_' . $user_id);
        delete_transient('unread_counts_all_' . $user_id);
        delete_transient('unread_important_counts_' . $user_id);
    }

    wp_send_json_success(['removed' => $ids, 'remaining' => $_SESSION['is_unread']]);
    wp_die();
}


// AJAX: get_info_list (returns HTML fragment)
add_action('wp_ajax_get_info_list', 'ajax_get_info_list');
add_action('wp_ajax_nopriv_get_info_list', 'ajax_get_info_list');

function ajax_get_info_list()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $tab = isset($_REQUEST['tab']) ? sanitize_text_field($_REQUEST['tab']) : 'all';
    $paged = isset($_REQUEST['paged']) ? intval($_REQUEST['paged']) : 1;
    $txt_limit = (function_exists('is_mobile') && is_mobile()) ? 50 : 100;

    $date = [];
    if (isset($_REQUEST['anu']))
        $date[0]['year'] = (int)$_REQUEST['anu'];
    if (isset($_REQUEST['mont']))
        $date[0]['month'] = (int)$_REQUEST['mont'];

    $arg = [
        'paged' => $paged,
        'posts_per_page' => 10,
        'post_type' => ['information', 'social-contribution'],
        'date_query' => $date,
        'post_status' => 'publish',
    ];

    // If requesting unread and there are no unread IDs, return empty message directly
    if ($tab === 'unread') {
        if (!isset($_SESSION['is_unread']) || !is_array($_SESSION['is_unread']) || count($_SESSION['is_unread']) === 0) {
            // Return the same HTML fragment you'd expect when there are no posts
            echo '<p class="mx-auto py-3">現在未読の記事はありません。</p>';
            wp_die();
        }
        $arg['post__in'] = $_SESSION['is_unread'];
    }

    // NOTE: if your archive page has additional tax_query / meta_query logic,
    // copy that logic here to keep behavior identical.
    $cate = isset($_REQUEST['cate']) ? sanitize_text_field(wp_unslash($_REQUEST['cate'])) : '';
    // ensure arrays exist
    if (!isset($arg['tax_query']) || !is_array($arg['tax_query']))
        $arg['tax_query'] = array();
    if (!isset($arg['meta_query']) || !is_array($arg['meta_query']))
        $arg['meta_query'] = array();

    if ($cate === 'csr') {
        // CSR 特別処理（archive と同じ）
        $arg['tax_query'][] = array(
            'relation' => 'OR',
                array(
                'taxonomy' => 'news',
                'field' => 'slug',
                'terms' => 'csr',
            ),
                array(
                'taxonomy' => 'csr_cat',
                'field' => 'slug',
                'terms' => 'csr-topics',
            ),
        );

        $arg['meta_query'][] = array(
            'relation' => 'AND',
                array(
                'relation' => 'OR',
                    array(
                    'key' => 'display_information',
                    'compare' => 'NOT EXISTS',
                ),
                    array(
                    'key' => 'display_information',
                    'value' => '1',
                    'compare' => '=',
                ),
            ),
        );

        if (empty($_SESSION['member_info'])) {
            $arg['meta_query'][] = array(
                'relation' => 'OR',
                    array(
                    'key' => 'csr_info_nologin',
                    'compare' => 'NOT EXISTS',
                ),
                    array(
                    'key' => 'csr_info_nologin',
                    'value' => '0',
                    'compare' => '=',
                ),
            );
        }
    }
    elseif ($cate !== '') {
        // 通常カテゴリ
        $arg['tax_query'][] = array(
            'taxonomy' => 'news',
            'field' => 'slug',
            'terms' => $cate,
        );

        // display_information の制約を追加（archive と揃える）
        $arg['meta_query'][] = array(
            'relation' => 'OR',
                array(
                'key' => 'display_information',
                'compare' => 'NOT EXISTS',
            ),
                array(
                'key' => 'display_information',
                'value' => '1',
                'compare' => '=',
            ),
        );

        // important / update 用 meta_key（archive と同じ特別処理）
        if ($cate === 'important' || $cate === 'update') {
            $arg['meta_key'] = $cate . '_information';
            $arg['meta_value'] = '1';
            $arg['meta_compare'] = '=';
        }

        // ログイン前の除外（archive と同じロジック）
        if (empty($_SESSION['member_info'])) {
            $attatchment = get_term_by('slug', 'attatchment', 'news');
            $business = get_term_by('slug', 'business', 'news');
            $campaign = get_term_by('slug', 'campaign', 'news');
            $exclude_ids = array();
            if ($attatchment && !is_wp_error($attatchment))
                $exclude_ids[] = (int)$attatchment->term_id;
            if ($business && !is_wp_error($business))
                $exclude_ids[] = (int)$business->term_id;
            if ($campaign && !is_wp_error($campaign))
                $exclude_ids[] = (int)$campaign->term_id;

            if (!empty($exclude_ids)) {
                $arg['tax_query'][] = array(
                    'taxonomy' => 'news',
                    'field' => 'id',
                    'terms' => $exclude_ids,
                    'operator' => 'NOT IN',
                );
            }

            $arg['meta_query'][] = array(
                'relation' => 'OR',
                    array(
                    'key' => 'restriction_information',
                    'compare' => 'NOT EXISTS',
                ),
                    array(
                    'key' => 'restriction_information',
                    'value' => '0',
                    'compare' => '=',
                ),
            );
        }
    }

    $the_query = new WP_Query($arg);

    ob_start();
    if ($the_query->have_posts()): ?>
<div class="info-news-div my-1">
    <?php while ($the_query->have_posts()):
            $the_query->the_post();
            $member_type = isset($member_type) ? $member_type : '';
            $p_type = (get_post_type() === 'social-contribution') ? 'csr_cat' : 'news';
            $terms = get_the_terms(get_the_ID(), $p_type);
            $t = is_array($terms) && !empty($terms) ? $terms[0] : null;
            $cat_term = ($p_type === 'csr_cat') ? get_term_by('slug', 'csr', 'news') : $t;
            $logo = $cat_term ? get_field('n_logo', $cat_term) : null;
            $color = $cat_term ? get_field('n_color', $cat_term) : '';
            $cat_name = ($p_type === 'csr_cat') ? '社会貢献活動' : ($t ? $t->name : '');
            $title = mb_strimwidth(strip_tags(get_the_title()), 0, $txt_limit, '…', 'UTF-8');
            $is_unread = (isset($_SESSION['is_unread']) && in_array(get_the_ID(), $_SESSION['is_unread'], true));
?>
    <div class="info-item <?php echo $member_type; ?><?php echo $is_unread ? ' unread-news' : ''; ?>"
        data-id="<?php echo get_the_ID(); ?>" data-unread="<?php echo $is_unread ? '1' : '0'; ?>">
        <div class="info-news mx-0 mt-2 mb-1 border-0">
            <?php if ($is_unread): ?>
            <span class="info-dot"></span>
            <?php
            endif; ?>
            <a href="<?php the_permalink(); ?>">
                <div class="info-news-bar d-flex align-items-center">
                    <div class="news-cat d-flex align-items-center"
                        style="background-color: <?php echo esc_attr($color); ?>">
                        <div class="cat-img-div">
                            <img src="<?php echo esc_url($logo['url'] ?? ''); ?>"
                                alt="<?php echo esc_attr($cat_name); ?>" />
                        </div>
                        <p class="mb-0 news-cat-txt bold pl-2">
                            <?php echo esc_html($cat_name); ?>
                        </p>
                    </div>
                    <div class="news-date ml-2">
                        <?php the_time('Y/m/d'); ?>
                    </div>
                </div>
                <p class="mb-0 news-title pt-1">
                    <?php echo esc_html($title); ?>
                </p>
            </a>
        </div>
        <div class="select-area <?php echo $member_type; ?>">
            <button class="select-btn btn btn-outline-primary btn-sm" style="display:none;">選択する</button>
            <?php if (!$is_unread): ?>
            <span class="read-label text-secondary" style="display:none;">既読</span>
            <?php
            endif; ?>
        </div>
    </div>
    <?php
        endwhile; ?>
</div>
<div class="pnavi mt-3">
    <?php
        $big = 999999999;

        // 1) JS から明示的に渡された page_url を優先（fetchArticles で form.append('page_url', ...) を送っている前提）
        $page_url = '';
        if (isset($_REQUEST['page_url']) && $_REQUEST['page_url'] !== '') {
            $page_url = esc_url_raw(wp_unslash($_REQUEST['page_url']));
        }

        // 2) フォールバック：HTTP_REFERER のパス部分を利用（クエリは除去）
        if (empty($page_url) && !empty($_SERVER['HTTP_REFERER'])) {
            $ref = trim(wp_unslash($_SERVER['HTTP_REFERER']));
            $ref = preg_replace('/#.*/', '', $ref);
            $page_url = strtok($ref, '?'); // クエリを取り除く
            $page_url = rtrim($page_url, '/') . '/';
        }

        // 3) 既知のページスラッグを試す（site 固有）
        if (empty($page_url)) {
            $page_obj = get_page_by_path('information');
            if ($page_obj) {
                $page_url = get_permalink($page_obj->ID);
            }
        }

        // 4) 旧スラッグの互換
        if (empty($page_url)) {
            $page_obj = get_page_by_path('info-list');
            if ($page_obj) {
                $page_url = get_permalink($page_obj->ID);
            }
        }

        // 5) 最終フォールバック
        if (empty($page_url)) {
            $page_url = home_url('/');
        }

        // persistent args（POST/REQUEST から取り出す）
        $add_args = array();
        if (isset($tab) && $tab !== '')
            $add_args['tab'] = $tab;
        if (isset($_REQUEST['cate']) && $_REQUEST['cate'] !== '')
            $add_args['cate'] = sanitize_text_field(wp_unslash($_REQUEST['cate']));
        if (isset($_REQUEST['anu']) && $_REQUEST['anu'] !== '')
            $add_args['anu'] = intval(wp_unslash($_REQUEST['anu']));
        if (isset($_REQUEST['mont']) && $_REQUEST['mont'] !== '')
            $add_args['mont'] = intval(wp_unslash($_REQUEST['mont']));

        // base を作る（paged プレースホルダ付与）
        $base_with_args = add_query_arg($add_args, $page_url);
        $base_with_args = esc_url($base_with_args);

        if (strpos($base_with_args, '?') === false) {
            $base = $base_with_args . '?paged=%#%';
        }
        else {
            $base = $base_with_args . '&paged=%#%';
        }

        echo paginate_links(array(
            'base' => $base,
            'format' => '',
            'current' => max(1, intval($paged)),
            'total' => intval($the_query->max_num_pages),
            'prev_text' => '<',
            'next_text' => '>',
            'type' => 'list',
            'add_args' => false,
        ));
?>
</div>
<?php
    else: ?>
<p class="mx-auto py-3">現在未読の記事はありません。</p>
<?php
    endif;
    wp_reset_postdata();

    $html = ob_get_clean();
    echo $html;
    wp_die();
}

if (is_user_logged_in()) {
    $user_id = get_current_user_id();
    update_user_meta($user_id, 'member_unread_list', $_SESSION['is_unread']);
// if (defined('WP_DEBUG') && WP_DEBUG) {
//     error_log('[info-ajax] saved unread list to user_meta for user ' . $user_id . ' (count=' . count($_SESSION['is_unread']) . ')');
// }
}

if (!function_exists('cf7_member_answers_by_form')) {
    /**
     * CF7 Advanced DB からログインユーザーの回答を取得して表示
     * $form_identifier : CF7 の投稿ID（数値）かフォーム名（文字列）
     * $limit           : 最大件数
     * $since           : 絞り込み開始日時（'YYYY-MM-DD HH:MM:SS'）
     */
    function cf7_member_answers_by_form($form_identifier, $limit = 5, $since = '2025-08-01 00:00:00')
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            @session_start();
        }

        // セッション優先で会員IDを取得（先頭ゼロを除去）
        $member_id_for_match = '';
        if (isset($_SESSION['member_info']['member_id']) && $_SESSION['member_info']['member_id'] !== '') {
            $member_id_for_match = strval($_SESSION['member_info']['member_id']);
        }
        elseif (isset($_SESSION['mypage_member_info']['member_id']) && $_SESSION['mypage_member_info']['member_id'] !== '') {
            $member_id_for_match = strval($_SESSION['mypage_member_info']['member_id']);
        }
        else {
            $member_id_for_match = strval(get_current_user_id());
        }
        // 先頭ゼロのみ除去（全ゼロだった場合は '0' を残す）
        $member_id_for_match = preg_replace('/^0+(?!$)/', '', (string)$member_id_for_match);
        if ($member_id_for_match === '') {
            $member_id_for_match = '0';
        }

        global $wpdb;
        $table_vdata = $wpdb->prefix . 'cf7_vdata';
        $table_entry = $wpdb->prefix . 'cf7_vdata_entry';

        if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_entry)) === null) {
            return '<p>データテーブルが見つかりません（' . esc_html($table_entry) . '）。</p>';
        }
        if ($wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $table_vdata)) === null) {
            return '<p>データテーブルが見つかりません（' . esc_html($table_vdata) . '）。</p>';
        }

        // フォーム識別子解決
        $cf7_id = 0;
        if (is_numeric($form_identifier)) {
            $cf7_id = intval($form_identifier);
        }
        else {
            $forms = get_posts(array(
                'post_type' => 'wpcf7_contact_form',
                'title' => $form_identifier,
                'numberposts' => 1,
                'fields' => 'ids',
            ));
            if (!empty($forms) && is_array($forms)) {
                $cf7_id = intval($forms[0]);
            }
        }
        if ($cf7_id <= 0) {
            return '<p>フォームが特定できません。フォームID またはフォーム名を確認してください。</p>';
        }

        // 集約クエリ（先頭ゼロを除去した値で比較）。
        // ORDER BY を追加して DB 側で最新順にしてから LIMIT を適用する。
        $sql = $wpdb->prepare(
            "
            SELECT
              e.data_id AS data_id,
              MAX(CASE WHEN e.name = %s THEN e.value END) AS convention_ticket_hyphen,
              MAX(CASE WHEN e.name = %s THEN e.value END) AS convention_ticket_underscore,
              MAX(CASE WHEN e.name = %s THEN e.value END) AS wheelchair,
              MAX(CASE WHEN e.name = %s THEN e.value END) AS submit_time,
              MAX(CASE WHEN e.name = %s THEN e.value END) AS submit_date,
              MAX(CASE WHEN e.name = %s THEN e.value END) AS member_id_raw,
              MAX(v.created) AS created
            FROM {$table_entry} e
            LEFT JOIN {$table_vdata} v ON v.id = e.data_id
            WHERE e.cf7_id = %d
            GROUP BY e.data_id
            HAVING (CASE WHEN TRIM(LEADING '0' FROM member_id_raw) = '' THEN '0' ELSE TRIM(LEADING '0' FROM member_id_raw) END) = %s
              AND (
                COALESCE(
                  MAX(CASE WHEN e.name = %s THEN e.value END),
                  MAX(CASE WHEN e.name = %s THEN e.value END),
                  MAX(v.created)
                ) >= %s
              )
            ORDER BY CAST(
              COALESCE(
                MAX(CASE WHEN e.name = %s THEN e.value END),
                MAX(CASE WHEN e.name = %s THEN e.value END),
                MAX(v.created)
              ) AS DATETIME
            ) DESC
            LIMIT %d
            ",
            // placeholders (順番に対応)
            'convention-ticket',
            'convention_ticket',
            'wheelchair',
            'submit_time',
            'submit_date',
            'member_id',
            $cf7_id,
            $member_id_for_match,
            'submit_time',
            'submit_date',
            $since,
            'submit_time',
            'submit_date',
            $limit
        );

        $rows = $wpdb->get_results($sql, ARRAY_A);
        if (empty($rows)) {
            return '';
        }

        // 整形：DB の日時を UTC として解釈 → サイトのタイムゾーンに変換して表示
        $items = array();

        // サイトのタイムゾーン取得（wp_timezone があればそれを使う）
        if (function_exists('wp_timezone')) {
            $site_tz = wp_timezone(); // DateTimeZone or WP_Timezone object
        }
        else {
            $tz_string = get_option('timezone_string');
            $site_tz = $tz_string ? new DateTimeZone($tz_string) : new DateTimeZone('Asia/Tokyo');
        }

        foreach ($rows as $r) {
            $ticket = '';
            if (!empty($r['convention_ticket_hyphen'])) {
                $ticket = $r['convention_ticket_hyphen'];
            }
            elseif (!empty($r['convention_ticket_underscore'])) {
                $ticket = $r['convention_ticket_underscore'];
            }

            $wheelchair = isset($r['wheelchair']) ? $r['wheelchair'] : '';

            // 優先日時文字列（DBのそのままの文字列）
            $time_str = '';
            if (!empty($r['submit_time'])) {
                $time_str = $r['submit_time'];
            }
            elseif (!empty($r['submit_date'])) {
                $time_str = $r['submit_date'];
            }
            elseif (!empty($r['created'])) {
                $time_str = $r['created'];
            }

            $ts = 0;
            if ($time_str) {
                // DB が UTC で保存されている想定：UTC タイムゾーンとしてパース
                $dt = DateTime::createFromFormat('Y-m-d H:i:s', $time_str, new DateTimeZone('UTC'));
                if ($dt && $dt->format('Y-m-d H:i:s') === $time_str) {
                    // サイトのタイムゾーンに変換
                    if ($site_tz instanceof DateTimeZone) {
                        $dt->setTimezone($site_tz);
                    }
                    else {
                        $dt->setTimezone($site_tz);
                    }
                    $ts = (int)$dt->getTimestamp();
                }
                else {
                    // フォールバック：strtotime を使って UTC と仮定して補正
                    $fallback_ts = strtotime($time_str);
                    if ($fallback_ts !== false) {
                        $dt2 = new DateTime("@$fallback_ts"); // UTC-based
                        if ($site_tz instanceof DateTimeZone) {
                            $dt2->setTimezone($site_tz);
                        }
                        else {
                            $dt2->setTimezone($site_tz);
                        }
                        $ts = (int)$dt2->getTimestamp();
                    }
                    else {
                        $ts = 0;
                    }
                }
            }

            $items[] = array(
                'ticket' => $ticket,
                'wheelchair' => $wheelchair,
                'time_str' => $time_str,
                'ts' => $ts,
            );
        }

        // 新しい順にソート（念のため）
        usort($items, function ($a, $b) {
            return intval($b['ts']) - intval($a['ts']);
        });

        // 出力（HTML構成はそのまま維持、日時の表示は 'n月j日 G時i分'）
        $out = '<div class="cf7-member-answers">';
        foreach ($items as $it) {
            // 表示ラベル：サイトタイムゾーンに変換した timestamp を使ってフォーマット
            $date_label = $it['ts'] ? date_i18n('n月j日 G時i分', $it['ts']) : '日時不明';
            $ticket_label = $it['ticket'] !== '' ? esc_html($it['ticket']) : '—';
            $wheelchair_label = strlen(trim((string)$it['wheelchair'])) > 0 ? esc_html($it['wheelchair']) : '';

            $out .= '<div class="cf7-answer-item d-flex align-items-center py-1 px-2">';
            $out .= '<div class="cf7-answer-date">' . esc_html($date_label) . '</div>';
            $out .= '<div class="cf7-answer-fields d-flex align-items-center pl-2">';
            $out .= '<div class="cf7-answer-ticket">' . $ticket_label . '</div>';
            // wheelchair が空でなければ表示
            if ($wheelchair_label !== '') {
                $out .= '<div class="cf7-answer-wheelchair pl-2">' . $wheelchair_label . '</div>';
            }
            $out .= '</div>';
            $out .= '</div>';
        }
        $out .= '</div>';

        return $out;
    }
}

// 利用体験談専用権限
// 管理画面を service-experience のみ表示に制限するロールと制御
add_action('init', function () {
    // 希望表示名
    $display_name = '利用体験談';
    $role_slug = 'service_experience_manager';

    // 付与する最低限の capability（必要に応じて増減してください）
    $caps = array(
        'read' => true,
        'upload_files' => true,

        // デフォルト投稿系（保険）
        'edit_posts' => true,
        'publish_posts' => true,
        'edit_published_posts' => true,
        'edit_others_posts' => true,
        'delete_posts' => true,
        'delete_published_posts' => true,

        // カスタム投稿 type 'service-experience' を register_post_type で
        // capability_type => 'service_experience', map_meta_cap => true としている想定の capability
        'edit_service_experience' => true,
        'read_service_experience' => true,
        'delete_service_experience' => true,

        'edit_service_experiences' => true,
        'edit_others_service_experiences' => true,
        'edit_published_service_experiences' => true,
        'publish_service_experiences' => true,
        'read_private_service_experiences' => true,
        'delete_service_experiences' => true,
        'delete_others_service_experiences' => true,
        'delete_published_service_experiences' => true,
        'read_private_posts' => true, // コアの非公開を読む権限
        'delete_private_posts' => true, // コアの非公開を削除する権限
        'delete_private_service_experiences' => true,
        'edit_private_service_experiences' => true,
        'edit_private_posts' => true,
    );

    // 既存ロールがある場合は表示名だけを更新（ユーザー割当を壊さない）
    if (get_role($role_slug)) {
        if (isset($GLOBALS['wp_roles']) && isset($GLOBALS['wp_roles']->roles[$role_slug])) {
            if ($GLOBALS['wp_roles']->roles[$role_slug]['name'] !== $display_name) {
                $GLOBALS['wp_roles']->roles[$role_slug]['name'] = $display_name;
                $GLOBALS['wp_roles']->role_names[$role_slug] = $display_name;
            }
        }

        // 既存ロールがあれば、必要な capability を追加する（既存の capability を壊さない）
        $role = get_role($role_slug);
        if ($role) {
            foreach ($caps as $cap => $grant) {
                if (!$role->has_cap($cap)) {
                    $role->add_cap($cap);
                }
            }
        }
    }
    else {
        // ロールが存在しなければ作成（必要な capability を与える）
        add_role(
            $role_slug,
            $display_name,
            $caps
        );
    }
}, 10);

// ユーザーが service_experience_manager ロールかを判定するヘルパー
function is_service_experience_manager_user($user = null)
{
    if (!$user) {
        $user = wp_get_current_user();
    }
    if (!$user || !isset($user->roles))
        return false;
    return in_array('service_experience_manager', (array)$user->roles, true);
}

// 管理メニューを制限（表示されるメニュー項目自体を削除）
add_action('admin_menu', function () {
    if (!is_user_logged_in())
        return;
    if (!is_service_experience_manager_user())
        return;

    global $menu, $submenu;

    // 許可するメニュー slug のホワイトリスト
    $allowed = array(
        'edit.php?post_type=service-experience', // カスタム投稿一覧
        'profile.php', // プロファイル編集（任意で残す）
        'upload.php', // メディア（メディアアップロードを許可するため追加）
    );

    // $menu の各エントリをチェックしてホワイトリスト以外は削除
    foreach ((array)$menu as $k => $m) {
        $slug = isset($m[2]) ? $m[2] : '';
        // 一部メニューは配列キーで同じ slug が複数ある場合があるので厳密比較
        if (!in_array($slug, $allowed, true)) {
            unset($menu[$k]);
            if (isset($submenu[$slug])) {
                unset($submenu[$slug]);
            }
        }
    }

// 管理バー（右上の "New" 等）を残すかの調整は admin_bar_menu フックで行う
}, 999);

// 管理バーの不要アイテムを削除
add_action('admin_bar_menu', function ($wp_admin_bar) {
    if (!is_user_logged_in())
        return;
    if (!is_service_experience_manager_user())
        return;

    // 削除リスト（必要に応じて調整）
    $remove_nodes = array(
        // '+New' を残すため 'new-content' は除外しています
        'comments',
        'wp-logo',
        'updates',
    );
    foreach ($remove_nodes as $n) {
        $wp_admin_bar->remove_node($n);
    }

// 管理バーに service-experience の新規作成リンクだけを追加したい場合はここで add_node 可能
// 例：$wp_admin_bar->add_node(array('id'=>'new-service-experience','title'=>'新規お知らせ','href'=>admin_url('post-new.php?post_type=service-experience')));
}, 999);

// 管理画面への直接アクセスの制限（URL直打ち対応）
add_action('admin_init', function () {
    if (!is_user_logged_in())
        return;
    if (!is_service_experience_manager_user())
        return;

    // 許可する admin ページ（ホワイトリスト）
    $allowed_pagenow = array(
        'admin-ajax.php', // AJAX 呼び出し（必要に応じて許可）
        'admin-post.php', // admin-post（必要なら許可）
        'profile.php', // プロフィール
        'upload.php', // メディアライブラリ／アップロード（追加）
        'media-new.php', // メディア新規追加（追加）
        'async-upload.php', // 非同期アップロードエンドポイント（追加）
    );

    $pagenow = isset($GLOBALS['pagenow']) ? $GLOBALS['pagenow'] : '';

    // edit.php 系の許可（post_type=service-experience の場合のみ許可）
    if ($pagenow === 'edit.php') {
        if (isset($_GET['post_type']) && $_GET['post_type'] === 'service-experience') {
            return; // 許可
        }
    }
    // 新規作成ページ
    if ($pagenow === 'post-new.php') {
        if (isset($_GET['post_type']) && $_GET['post_type'] === 'service-experience') {
            return; // 許可
        }
    }
    // 編集ページ（post.php）は対象の投稿が service-experience であれば許可
    if ($pagenow === 'post.php') {
        // 投稿ID は GET ではなく POST に来ることがあるため、REQUEST から取得するようにする
        $post_id = 0;
        if (isset($_REQUEST['post'])) {
            $post_id = intval($_REQUEST['post']);
        }
        elseif (isset($_REQUEST['post_ID'])) {
            $post_id = intval($_REQUEST['post_ID']);
        }

        if ($post_id) {
            $pt = get_post_type($post_id);
            if ($pt === 'service-experience') {
                return; // 許可
            }
        }
    }

    // ここまでに許可されていなければ、ホワイトリスト pagenow もチェック
    if (in_array($pagenow, $allowed_pagenow, true)) {
        return;
    }

    // それ以外の管理ページへ来ようとしている -> service-experience の一覧へリダイレクト
    wp_safe_redirect(admin_url('edit.php?post_type=service-experience'));
    exit;
}, 1);

if (!function_exists('ls_clear_lifesupport_cache_for_terms')) {
    function ls_clear_lifesupport_cache_for_terms(array $term_ids)
    {
        if (empty($term_ids)) {
            return;
        }
        $display_types = array('pc', 'sp'); // テンプレートで使われる表示種別があれば増やす
        foreach ($term_ids as $term_id) {
            $term_id = (int)$term_id;
            foreach (array(0, 1) as $login_flag) { // ログインフラグ 0/1
                foreach ($display_types as $disp) {
                    $cache_key = sprintf('ls_cat_%d_login_%d_disp_%s_v1', $term_id, $login_flag, $disp);
                    delete_transient($cache_key);
                }
            }
        }
    }
}

// 投稿保存時（公開・更新・下書き等）のフック：lifesupport 投稿タイプ向け
add_action('save_post_lifesupport', function ($post_id, $post, $update) {
    // 自動保存やリビジョンは無視
    if (wp_is_post_autosave($post_id) || wp_is_post_revision($post_id)) {
        return;
    }
    // 該当投稿の属するタームID を取得
    $term_ids = wp_get_post_terms($post_id, 'lifesupport_cat', array('fields' => 'ids'));
    if (is_wp_error($term_ids)) {
        return;
    }
    ls_clear_lifesupport_cache_for_terms((array)$term_ids);
}, 10, 3);

// 投稿がゴミ箱に入れられた・削除されたときにもクリア
add_action('trashed_post', function ($post_id) {
    if (get_post_type($post_id) !== 'lifesupport')
        return;
    $term_ids = wp_get_post_terms($post_id, 'lifesupport_cat', array('fields' => 'ids'));
    if (is_wp_error($term_ids))
        return;
    ls_clear_lifesupport_cache_for_terms((array)$term_ids);
});

add_action('delete_post', function ($post_id) {
    if (get_post_type($post_id) !== 'lifesupport')
        return;
    $term_ids = wp_get_post_terms($post_id, 'lifesupport_cat', array('fields' => 'ids'));
    if (is_wp_error($term_ids))
        return;
    ls_clear_lifesupport_cache_for_terms((array)$term_ids);
});

// タームが編集・作成・削除されたらそのタームのキャッシュをクリア
add_action('created_lifesupport_cat', function ($term_id) {
    ls_clear_lifesupport_cache_for_terms(array($term_id));
});
add_action('edited_lifesupport_cat', function ($term_id) {
    ls_clear_lifesupport_cache_for_terms(array($term_id));
});
add_action('delete_lifesupport_cat', function ($term_id) {
    ls_clear_lifesupport_cache_for_terms(array($term_id));
});