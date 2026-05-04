<?php
function count_important_unread( $unread ){
require_once('/var/www/html/cms/wp-load.php');
require_once(get_stylesheet_directory().'/api/create_unread_array.php');
global $wpdb;
global $mypage_directori;

if (empty($unread)){
    return;
}

$unread = create_unread_array();

// お知らせタブの「重要」
// $arg=[];
// 投稿の表示条件設定
$arg = array(
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'post_type'      => array('information','social-contribution'),
    'meta_query'=> array(
        'relation' => 'AND',
        array(
            'key'     =>'important_information',
            'value' => 1, //true,falseの1
            'compare' => '=',
        ),
        array(
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
        ),
    ),
);
// 未読の配列と重要なお知らせの投稿の配列で同じIDがいくつあるか抽出
$posts = get_posts($arg);
$posts = array_column( $posts, 'ID');
$arr_combaine = array_merge($unread['list'], $posts);
$arr_unreads = array_filter(array_count_values($arr_combaine), function($v){return --$v;});
$count_unreads = count($arr_unreads);


// ヘッダーメニュー下のバー
// $arg_month=[];
// 取得する期間（1ヶ月）を設定

// 投稿の表示条件設定
$arg_month = array(
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
        array(
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
        ),
    ),
    'date_query' => array(
        array(
            'after' => '1 month ago',
            'inclusive' => true,
        ),
    ),
);
// 未読の配列と重要なお知らせの投稿の配列で同じIDがいくつあるか抽出
$posts_month = get_posts($arg_month);
$posts_month = array_column( $posts_month, 'ID');
$arr_combaine_month = array_merge($unread['bar'], $posts_month);
$arr_unreads_month = array_filter(array_count_values($arr_combaine_month), function($v){return --$v;});
$count_unreads_month = count($arr_unreads_month);

$count_unreads_all = array(
    'tab' => $count_unreads, // トップページの「重要」タブ
    'bar' => $count_unreads_month, // ヘッダーメニュー直下の１ヶ月以内の未読のインフォメーション
);

return $count_unreads_all;
}