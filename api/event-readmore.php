<?php
    require_once('/var/www/html/cms/wp-load.php');

    $now_post_num = $_POST['now_post_num']; // 現時点で表示されている投稿数
    $get_post_num = $_POST['get_post_num']; // 取得する投稿数
    $html = '';

    $today_date = date( "Y-m-d" );
    $three_month = date('Y-m-1', strtotime('+3 month'));

    // 最も古い投稿のidを取得
    $old_args = array(
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'post_type' => 'b_calender',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_key' => 'b_calender_date',
        'meta_query' => array(
            'relation' => 'AND',
            'three_month' => array(
                'key'     => 'b_calender_date',
                'value'   => $three_month,
                'compare' => '<',
            ),
            'today_date' => array(
                'key'     => 'b_calender_date',
                'value'   => $today_date,
                'compare' => '>=',
            ),
        ),
    );

    $old_posts = get_posts( $old_args );
    foreach ( $old_posts as $old_post ) {
        setup_postdata( $old_post );
        $old_post_id = $old_post->ID;
    }
    wp_reset_postdata();
    $most_old_post = '';

    $args = array(
        'offset' => $now_post_num,
        'post_status' => 'publish',
        'posts_per_page' => $get_post_num,
        'post_type' => 'b_calender',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_key' => 'b_calender_date',
        'meta_query' => array(
            'relation' => 'AND',
            'three_month' => array(
                'key'     => 'b_calender_date',
                'value'   => $three_month,
                'compare' => '<',
            ),
            'today_date' => array(
                'key'     => 'b_calender_date',
                'value'   => $today_date,
                'compare' => '>=',
            ),
        ),
    );
    $the_query = new WP_Query($args);


if ($the_query -> have_posts()) :
    $week = array( "日", "月", "火", "水", "木", "金", "土" );

    while ($the_query -> have_posts()) : $the_query -> the_post();

    // $html .= 投稿記事の内容を記述
    $postid = get_the_ID();
    $terms = get_the_terms($postid, 'b_calendar_cat');
    $event_date = $cfs->get('b_calender_date', $postid);

    if ($old_post_id == $postid) {
        $most_old_post = 'most_old_post';
    }

    $html .= '<article class="modal_trigger add_event">';
    $html .= '
        <div class="article-content d-md-flex mb-2">
            <div class="article-detail d-flex">
                <div class="date mr-3">
                    <div class="article-detail__postday">
                        <p class="mb-0">
                            <time datetime="'.$event_date.'">'.date('Y.m.d', strtotime($event_date)).'</time>
                        </p>
                    </div>
                </div>';

                    if ($terms) :
                        foreach ($terms as $term) :
                            $term_color = '';
                            if (class_exists('Vk_term_color')) {
                                $term_color = Vk_term_color::get_term_color($term->term_id);
                                $term_color = ($term_color) ? ' style="background-color:' . $term_color . ';"' : '';
                            }
                            $html .= '
                                <div class="category-list mr-md-3 mr-0">
                                    <div class="article-detail__category '.$term->slug.' rounded-pill" '.$term_color.'>
                                        <span class="text-white font-smaller">'.$term->name.'</span>
                                    </div>
                                </div>';
                        endforeach;
                    endif;

        $html .= '
                </div>
                <div class="article-title">
                    <p class="mb-0">'.get_the_title().'</p>
                </div>
            </div>
        </article>';

    $html .= '
    <div class="modal_box '.$most_old_post.'">
        <div class="modal_bg"></div>
        <div class="modal_inner">
            <div class="modal_block">
                <div class="event-content">
                    <div class="event-content__detail">
                        <div class="event-content__detail__header">';
                        $event_date_week =  date('Y/m/d', strtotime($event_date)) . "(" . $week[date('w', strtotime($event_date))] . ")";
                        $html .= '
                            <div class="article-date font-weight-bold">
                                <p class="mb-0">
                                    <time datetime="'.$event_date.'">
                                        '.$event_date_week.'
                                    </time>
                                </p>
                            </div>
                            <div class="article-title mt-3 px-2 py-1 font-weight-bold d-md-flex justify-content-md-between">';
                                if ($terms) :
                                    $html .= '<div class="category-list order-md-2 mb-2 mb-md-0">';
                                    foreach ($terms as $term) :
                                        $html .= '
                                                <div class="article-detail__category '.$term->slug.' rounded-pill" '.$term_color.'>
                                                    <span class="text-white font-smaller">
                                                        '.$term->name.'
                                                    </span>
                                                </div>';
                                    endforeach;
                                    $html .= '</div>';
                                endif;
                        $html .= '
                                <p class="mb-0 order-md-1">'.get_the_title().'</p>
                            </div>
                        </div>
                        <div class="event-content__detail__body">
                            '.get_the_content().'
                        </div> 
                    </div>
                </div>';

                $html .= '
            </div>
            <div class="modal_close">
                <div class="rounded-pill">
                    閉じる<span class="pl-3">×</span>
                </div>
            </div>
        </div>
    </div>';

    endwhile;
endif; wp_reset_postdata();

echo $html;
