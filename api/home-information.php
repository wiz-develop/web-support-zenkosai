<?php
require_once('/var/www/html/cms/wp-load.php');
global $wpdb;
global $mypage_directori;

session_start();

$info_cat = $_GET['cate'];
// var_dump($info_cat);

$arg=[];

// 投稿の表示条件設定
$arg = array(
    'posts_per_page' => 10,
    'post_type'      => array('information','social-contribution'),
    'date_query'     => $date,
);

// 重要、もしくは更新情報のカテゴリが選択されている場合
if ($info_cat == 'important' || $info_cat == 'update'){
    $arg = array_merge($arg, array(
        'meta_key'     => $info_cat.'_information',
        'meta_value'   => '1', //true,falseの1
        'meta_compare' => '=' )
    );
}
// お知らせが選択されている状態
else{
    $arg = array_merge($arg, array(
        'meta_query'=> array(
            array(
                'relation' => 'OR',
                array(
                    'key'     =>'update_information',
                    'compare' => 'NOT EXISTS',
                ),
                array(
                    'key'     =>'update_information',
                    'value'   => '0', //true,falseの1
                    'compare' => '=',
                ),
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
    ));
}

if(!($_SESSION['member_info'])){
    $attatchment = get_term_by('slug','attatchment','news');
    $attatchment_id = $attatchment->term_id;
    $business = get_term_by('slug','business','news');
    $business_id = $business->term_id;
    $campaign = get_term_by('slug','campaign','news');
    $campaign_id = $campaign->term_id;
    $arg = array_merge($arg, array(
        'tax_query' => array(
            array(
                'taxonomy' => 'news',
                'field' => 'id',
                'terms' => array($attatchment_id,$business_id,$campaign_id,),
                'operator' => 'NOT IN',
            )
        ),
    ));
    // ログイン前表示しないに設定されているものを表示しない
    $arg['meta_query'][3] = array(
        'relation' => 'OR',
        array(
            'key'     =>'restriction_information',
            'compare' => 'NOT EXISTS',
        ),
        array(
            'key'     =>'restriction_information',
            'value'   => '0', //true,falseの1
            'compare' => '=',
        ),
    );
}

$posts = get_posts($arg);
$result = '';
$days = 7; // New を表示させたい期間の日数
$today = date_i18n('U');

if($posts){

    foreach ($posts as $post){
        setup_postdata($post);
        // 社会貢献活動のカスタム投稿として投稿されているものを
        // お知らせの「社会貢献活動」として扱うための設定
        $p_type = 'news';
        if($post->post_type == 'social-contribution'){
            $p_type = 'csr_cat';
        }

        // 新着記事に New マークを表示
        $entry = get_post_time();
        $total = date('U', ($today - $entry)) / 86400;

        $terms = get_the_terms($post->ID, $p_type);
        foreach($terms as $t){
            $logo = get_field('n_logo', $t);
            $color = get_field('n_color', $t);
            $cat_name = $t->name;
            $title = mb_strimwidth( strip_tags( get_the_title() ), 0, 50, '…', 'UTF-8' );
            if($p_type == 'csr_cat'){
                $temp = get_term_by('slug', 'csr', 'news');
                $logo = get_field('n_logo', $temp);
                $color = get_field('n_color', $temp);
                $cat_name = '社会貢献活動';
            }
            $important = '';
            if($cfs->get('important_information')) {
                $important = 'important-news';
            }
            // 未読か判断
            $unread = '';
            // if(isset($_SESSION['is_unread']) && in_array( get_the_ID(), $_SESSION['is_unread'] )) {
            //     $unread = 'unread-news';
            // }

            $result .= '
            <a class="info-news col-12 mx-auto '.$important.' '.$unread.'" href="'.get_the_permalink().'">
                <div class="row info-news-bar">
                    <div class="new-mark">';
                    if ($days > $total) {
                        $result .= '<span>NEW</span>';
                    }
            $result .= '</div>
                    <div class="important-label">';
                    if ($important) {
                        $result .= '<span class="important rounded07 px-2 text-center text-white bg-danger mr-2">重要</span>';
                    }
            $result .= '
                    </div>
                    <div class="news-date">
                        '.get_the_time('Y/m/d').'
                    </div>
                    <div class="news-cat '.$t->slug.' d-flex flex-row pl-0 pl-2 pr-0" style="background-color: '.$color.'">
                        <div class="cat-img-div">
                            <img class="" src="'.$logo['url'].'" title="'.$cat_name.'"/>
                        </div>
                        <p class="mb-0 news-cat-txt bold">'.$cat_name.'</p>
                    </div>
                    <div class="mb-0 news-title py-1">
                        '.$title.'
                    </div>
                </div>
            </a>';
        }
        wp_reset_postdata();
    }
}else{
$result = '<p>現在投稿記事はありません。</p>';
}
// var_dump($result);
echo json_encode($result);
