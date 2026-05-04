<?php
ini_set('display_errors', "On");
// global $api_load;
require_once('/var/www/html/cms/wp-load.php');

//表示させる年月を設定
$anu = date('Y');
$mont = date('m');
if ($_GET['anu'] && $_GET['mont']) {
    $anu = $_GET['anu'];
    $mont = $_GET['mont'];
}
$c_date = $anu.'-'.$mont;

// 月初日を設定
$first_date = date('Y-m-d', strtotime('first day of ' . $c_date));
//月末日を取得
$last_date = date('Y-m-d', strtotime('last day of ' . $c_date));


$arg=[];
// 投稿の表示条件設定
$arg = array(
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'post_type'      => 'b_calender',
    'meta_query'=> array(
        'relation' => 'AND',
        // 指定日より前
        array(
            'key' => 'b_calender_date',
            'value' => $first_date,
            'compare' => '>=',
            'type' => 'DATE'
        ),
        // 指定日よりあと
        array(
            'key'     =>'b_calender_date',
            'value' => $last_date,
            'compare' => '<=',
            'type' => 'DATE'
        ),
    ),
);

$posts = get_posts($arg);
$c_post = array();

$i = 0;
foreach ($posts as $p) {
    // カスタムフィールドの日付取得
    $e_date = $cfs->get('b_calender_date', $p->ID);
    $terms = get_the_terms($p->ID, 'b_calendar_cat');

    $c_post[$i] = new stdClass;
    $c_post[$i]->post_date = $e_date;

    if ($terms) {
        $term_list = array();
        foreach ($terms as $index_sub => $term) {
            $term_list['term'] = $term;
            if (class_exists('Vk_term_color')) {
                $term_color = Vk_term_color::get_term_color($term->term_id);
                $term_list['bg_color'] = $term_color;
            }
            $c_post[$i]->post_terms[$index_sub] = $term_list;
        }
    }
    $c_post[$i]->post_title = $posts[$i]->post_title;
    $c_post[$i]->post_content = $posts[$i]->post_content;
    $i++;
}
echo json_encode($c_post, true);
