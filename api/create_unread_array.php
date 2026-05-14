<?php
function create_unread_array($member_id = 'default', $startday = 'default'){
require_once('/var/www/html/cms/wp-load.php');
global $wpdb;
global $mypage_directori;

// 全てのお知らせと社会貢献活動の「お知らせに表示する」を選択されているpostの情報を取得
if ($member_id === 'default' || $member_id === null || $member_id === '') {
    $member_id = isset($_SESSION['member_info']['member_id']) ? $_SESSION['member_info']['member_id'] : '';
}
if ($member_id !== '') {
    $member_id = intval($member_id);
}

// 利用開始日（より前のお知らせを既読状態にする）
if ($startday === 'default') {
    $startday = isset($_SESSION['member_info']['startdate']) ? $_SESSION['member_info']['startdate'] : '';
}
if ($startday) {
    $startdate = date("Y-m-d H:i:s", strtotime($startday));
} else {
    $startdate = "2021-04-01 00:00:00";
}

/*
 * Transientキャッシュ
 * 会員IDごとに5分間キャッシュする。
 * 投稿更新時の即時クリアは行わず、最大5分の時間経過で自然に古くなる方式。
 * 会員IDが空（未ログイン等）の場合はキャッシュを使わず従来通り処理する。
 */
$cache_key = '';
if (!empty($member_id)) {
    $cache_key = 'unread_array_' . $member_id;
    $cached = get_transient($cache_key);
    if ($cached !== false && is_array($cached) && isset($cached['list'], $cached['bar'])) {
        // セッション側は毎回最新の値で同期しておく（既存の動きを維持）
        unset($_SESSION['is_unread']);
        $_SESSION['is_unread'] = $cached['list'];
        session_write_close();
        return $cached;
    }
}

$arg = array(
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'fields'         => 'ids',
    'no_found_rows'  => true,
    'update_post_meta_cache' => false,
    'update_post_term_cache' => false,
    'post_type'      => array('information','social-contribution'),
    'meta_query'=> array(
        // 更新情報を覗いて未読取得したい場合コメントアウト外す
        // array(
        //     'relation' => 'OR',
        //     array(
        //         'key'     =>'update_information',
        //         'compare' => 'NOT EXISTS',
        //     ),
        //     array(
        //         'key'     =>'update_information',
        //         'value'   => '0', //true,falseの1
        //         'compare' => '=',
        //     ),
        // ),
        // array(
            'relation' => 'OR',
            array(
                'key'     =>'display_information',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     =>'display_information',
                'value'   => '1', //true,falseの1
                'compare' => '=',
            ),
        // ),
    ),
);
$posts = get_posts($arg);

$is_exist = array();
if (!is_null($member_id) && $member_id !== '') {
    // ログインした会員の既読post_idを取得
    // SQLインジェクション対策：$wpdb->prepare() でプレースホルダ経由にする
    $is_exist = $wpdb->get_results(
        $wpdb->prepare(
            "select post_id from {$wpdb->prefix}read where is_read = 1 and member_id = %d",
            $member_id
        )
    );
}


// 利用開始日以前に投稿されたインフォメーションのIDを取得
$is_no_exist = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_date < %s AND post_type = %s",
        $startdate,
        'information'
    )
);

// 利用開始日以前に投稿された社会貢献活動のIDを取得
$is_no_exist_social = $wpdb->get_results(
    $wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_date < %s AND post_type = %s",
        $startdate,
        'social-contribution'
    )
);

// 配列に直す
$is_exist = json_decode(json_encode($is_exist), true);
$is_no_exist = json_decode(json_encode($is_no_exist), true);
$is_no_exist_social = json_decode(json_encode($is_no_exist_social), true);

// post_idだけを抽出
$is_exist = array_column( $is_exist, 'post_id');
// IDだけ抽出
$is_no_exist = array_column( $is_no_exist, 'ID');
$is_no_exist_social = array_column( $is_no_exist_social, 'ID');

// 合わせる
$is_exist_all = array_merge($is_exist, $is_no_exist, $is_no_exist_social);

// 全てのpost_idから既読のものを削除
$posts_unread = array_diff($posts, $is_exist); // 全期間での未読のid
$posts_unread_list = array_diff($posts, $is_exist_all); // 利用開始日以降の未読のid

$posts_unread_all = array(
    'list' => $posts_unread_list, // 利用開始日以前の投稿のid(既読扱いにする)
    'bar' => $posts_unread, // 既読の投稿のid
);

// sessionのリセット
unset($_SESSION['is_unread']);
$_SESSION['is_unread'] = $posts_unread_list;
session_write_close();

// 会員IDがあるときだけキャッシュへ保存（5分）
if ($cache_key !== '') {
    set_transient($cache_key, $posts_unread_all, 5 * MINUTE_IN_SECONDS);
}

return $posts_unread_all;
}
