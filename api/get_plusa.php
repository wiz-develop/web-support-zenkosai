<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] )[0];
require_once( $parse_uri . 'wp-load.php' );

$status = $_POST['status']; // 開催中・終了・開催準備中
$html = '';

$today = wp_date('Y-m-d');
$args = array(
    'posts_per_page' => -1,
    'post_type' => 'plusa',
    'post_status' => 'publish',
);

if ($status == 'underway') {
    // 開催中
    $args_add = array(
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'plusa_period_start',
                'value' => $today,
                'compare' => '<=',
                'type' => 'DATE',
            ),
            array(
                'key' => 'plusa_period_end',
                'value' => $today,
                'compare' => '>=',
                'type' => 'DATE',
            ),
        ),
    );
} elseif ($status == 'end') {
    // 終了
    $args_add = array(
        'meta_query' => array(
            array(
                'key' => 'plusa_period_end',
                'value' => $today,
                'compare' => '<',
                'type' => 'DATE',
            ),
        ),
    );
} elseif ($status == 'preparation') {
    // 開催準備中
    $args_add = array(
        'meta_query' => array(
            array(
                'key' => 'plusa_period_start',
                'value' => $today,
                'compare' => '>',
                'type' => 'DATE',
            ),
        ),
    );
}

$args = array_merge($args, $args_add);
$the_query = new WP_Query($args);

if ($the_query -> have_posts()) :
    while ($the_query -> have_posts()) : $the_query -> the_post();
    $plusa_link = CFS()->get('plusa_link');

    // $html .= 投稿記事の内容を記述
    $html .= '
    <article class="plusa-article">
        <div class="plusa-article__content">
            <h2 class="plusa-article__content__title mb-2 border-bottom border-secondary">
                '.get_the_title().'
            </h2>';
    $html .= '
            <div class="row">
                <div class="plusa-article__content__image col-12 col-sm-4">
                    <a href="'.$plusa_link.'" target="_blank" onclick="gtag(\'event\', \'click\', {\'event_category\': \'plusa\',\'event_label\': \''.get_the_title().'\',\'value\': \'1\'})">
                        <img src="'.get_the_post_thumbnail_url(get_the_ID(), 'full').'" alt="'.get_the_title().'">
                    </a>
                </div>
                <div class="plusa-article__content__detail col-12 col-sm-8">
                    <div class="article-detail font-weight-bold">
                        '.get_the_content().'
                    </div>';
                
                $plusa_period_text = CFS()->get('plusa_period_text');
                if ($plusa_period_text) {
                    $html .= '
                        <div class="article-period mt-3">
                            <p class="mb-0">'.$plusa_period_text.'</p>
                        </div>';
                }

                $terms = get_the_terms(get_the_ID(), 'plusa_tag');
                if ( $terms ) {
                    $html .= '<div class="article-tags mt-1 d-flex">';
                    foreach ( $terms as $index => $term ) {
                        $html .= '
                            <p class="border border-info rounded-pill py-1 px-2 mx-1 text-info">
                                '.$term->name.'
                            </p>';
                    }
                    $html .= '</div>';
                }
    $html .=  '
                </div>
            </div>';
    $html .=  '
        </div>
    </article>';
    endwhile;
else :
    $html = '<p class="text-center">該当するキャンペーンはございません。</p>';
endif;
wp_reset_postdata();

echo $html;