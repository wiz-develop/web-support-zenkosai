<?php
function create_unread_array($member_id = 'default'){
require_once('/var/www/html/cms/wp-load.php');
global $wpdb;
global $mypage_directori;

// 全てのお知らせと社会貢献活動の「お知らせに表示する」を選択されているpostの情報を取得
$member_id = $_SESSION['member_info']['member_id'];

// 利用開始日（より前のお知らせを既読状態にする）
$startday = $_SESSION['member_info']['startdate'];
if ($startday) {
    $startdate = date("Y-m-d H:i:s", strtotime($startday));
} else {
    $startdate = "2021-04-01 00:00:00";
}

$arg = array(
    'post_status'    => 'publish',
    'posts_per_page' => -1,
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
// post_idだけを抽出
$posts = array_column( $posts, 'ID');

$is_exist = array();
if (!is_null($member_id)){
    // ログインした会員の既読post_idを取得
    $is_exist = $wpdb->get_results("select post_id from wpz_read where is_read = 1 and member_id = $member_id");
}


// 利用開始日以前に投稿されたインフォメーションのIDを取得
$sql = 'SELECT ID FROM wpz_posts WHERE post_date < "'.$startdate.'"'.' AND post_type = "information"';
$is_no_exist = $wpdb->get_results($sql);

// 利用開始日以前に投稿された社会貢献活動のIDを取得
$social_sql = 'SELECT ID FROM wpz_posts WHERE post_date < "'.$startdate.'"'.' AND post_type = "social-contribution"';
$is_no_exist_social = $wpdb->get_results($social_sql);

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

return $posts_unread_all;
}