<?php
/*
 * Template Name: FAQキーワード一覧
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header();
$faq_post_type = 'ufaq';
?>

<div id="page-ufaq" class="search-ufaq page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
    <div class="page-header container">
        <!-- <div class="container"> -->
            <?php
                /*-------------------------------------------*/
                /* BreadCrumb
                /*-------------------------------------------*/
                do_action( 'lightning_breadcrumb_before' );
                $old_file_name[] = 'module_panList.php';
                if ( locate_template( $old_file_name, false, false ) ) {
                    locate_template( $old_file_name, true, false );
                } else {
                    get_template_part( 'template-parts/breadcrumb' );
                }
                do_action( 'lightning_breadcrumb_after' );
            ?>
        <!-- </div> -->
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <div class="container mb-5">
            <div class="flame-body">
                <div class="page-content-innerwrap">
                    <?php
                        $search_query = get_search_query(); //検索ワードを取得
                        $ids = array();
                        $faq_count = 0;
                        if (have_posts()) :
                            $search_query_convert = mb_convert_kana($search_query, 's');
                            $freewords = preg_split('/[\s,]+/', $search_query_convert);
                            while(have_posts()): the_post();
                                $not_search_words = $cfs->get('not_search_word_add');
                                $not_search_word_convert = mb_convert_kana($not_search_words, 's');
                                $not_search_word = preg_split('/[\s,]+/', $not_search_word_convert);
                                if (!array_intersect($freewords, $not_search_word)) {
                                    $add_id = get_the_ID();
                                    $ids = array_merge($ids, array($add_id));
                                }
                            endwhile;
                        endif;
                        wp_reset_postdata();

                        if ($ids) :
                        $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
                        $args = array(
                            'post_type' => $faq_post_type,
                            'posts_per_page' => 10,
                            'paged' => $paged,
                            'post__in' => $ids,
                            'orderby' => 'meta_value_num',
                            'order' => 'ASC',
                            'meta_key' => 'qa_number',
                        );
                        $faq_posts = new WP_Query($args);
                        console_log($faq_posts);
                            if($faq_posts->have_posts()) :
                                $faq_count = $faq_posts->found_posts;
                    ?>
                        <div class="page-content-div">
                            <h1 class="faq-title pl-2 px-md-3"><p class="mb-0">検索結果：全 <?php echo $faq_count; ?> 件</p></h1>
                            <div class="faq-search-word px-md-3">検索ワード：<?php echo get_search_query(); ?></div>
                            <div>
                                <ul class="faq-cat-list">
                                    <?php
                                        while ( $faq_posts->have_posts() ) :
                                            $faq_posts->the_post();
                                    ?>
                                        <a href="<?php echo get_permalink(); ?>">
                                            <li class="faq-nextanswer">
                                                <p class="faq-cat mb-0">
                                                <?php
                                                $faq_cat_slug = 'ufaq-category'; // 念のため再定義（上部でもしてますが）
                                                $terms = get_the_terms(get_the_ID(), $faq_cat_slug);

                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                    $term = $terms[0]; // 最初のカテゴリだけ使用
                                                    $hierarchy = [$term->name];

                                                    while ($term->parent != 0) {
                                                        $term = get_term($term->parent, $faq_cat_slug);
                                                        if (is_wp_error($term)) break;
                                                        array_unshift($hierarchy, $term->name);
                                                    }

                                                    echo esc_html(implode(' ＞ ', $hierarchy));
                                                }
                                                ?>
                                                </p>
                                                <?php echo get_the_title(); ?>
                                            </li>
                                        </a>
                                    <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!-- ページネーション -->
                        <div class="pnavi mt-3 mx-auto">
                            <?php
                                $pnum = 2;
                                if($display_type == 'sp'){
                                    $pnum = 1;
                                }
                                if ($faq_posts->max_num_pages > 1) {
                                    echo paginate_links(array(
                                        'base'      => '%_%',
                                        'format'    => '?page=%#%',
                                        'current'   => max(1, $paged),
                                        'mid_size'  => $pnum,
                                        'total'     => $faq_posts->max_num_pages,
                                        'prev_text' => '<',
                                        'next_text' => '>',
                                        'type'      => 'list'
                                    ));
                                }
                                wp_reset_postdata();
                            ?>
                        </div><!-- ページネーションここまで -->
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="page-content-div">
                            <h1 class="faq-title pl-2 px-md-3"><p class="mb-0">検索結果：全 0 件</p></h1>
                            <div class="faq-search-word px-md-3">検索ワード：<?php echo get_search_query(); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php //get_template_part('templates/news-archive');?>
            </div>
            <div class="page-content-div text-center">
                <div class="faq-questionnaire my-5">
                    <p>問題は解決しましたか？​</p>
                    <div class="faq-questionnaire__btn-list d-flex align-items-center justify-content-center">
                        <button id="faq-questionnaire-yes" class="faq_resolve gtm-click-link mx-1 btn rounded-pill d-flex align-items-center justify-content-center" data-gtm-click="問題は解決しましたか？​「良かったです！」">
                            <span>解決しました！​</span>
                            <img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/images/faq/yes-lino_icon.png">
                        </button>
                        <button id="faq-questionnaire-no"  class="faq_resolve gtm-click-link mx-1 btn rounded-pill d-flex align-items-center justify-content-center" data-gtm-click="問題は解決しましたか？​「解決しませんでした。」">
                            <span>解決しませんでした。</span>
                            <img src="<?php echo get_stylesheet_directory_uri() ; ?>/assets/images/faq/no-lino_icon.png">
                        </button>
                        <?php wp_nonce_field('faq_all_resolve_action', 'faq_all_resolve_nonce'); ?>
                    </div>
                    <div id="faq-questionnaire-form" style="display: none;">
                        <div class="cancel-form">
                            <div class="inputbox mb-4">
                                <div class="container-fluid">
                                    <?php
                                        $args = array(
                                            'name'        => 'faq',
                                            'post_type'   => 'page',
                                            'post_status' => 'publish',
                                            'posts_per_page' => 1
                                        );

                                        $query = new WP_Query($args);
                                        if ($query->have_posts()) :
                                            while ($query->have_posts()) : $query->the_post();
                                                the_content();
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                    ?>
                                    <div class="inputarea form-group border-0">
                                        <textarea cols="40" rows="10" class="form-control" id="textarea-faq" name="textarea-faq"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto text-center">
                                <input id="send-faq-comment-button" class="btn rounded-pill px-5 faq-submit btn-primary" type="button" value="送信する">
                            </div>
                        </div>
                    </div>
                    <div class="answer-thanks mt-4" style="display: none;"><p class="mb-0"></p></div>
                </div>
            </div>
        </div>
        <?php get_template_part('/templates/searchform-faq');?>
    </div>
</div>
<script>
    let resolve_id = "";

    jQuery(document).ready(function () {
        const yesButton = jQuery("#faq-questionnaire-yes");
        const noButton = jQuery("#faq-questionnaire-no");
        const answerThanks = jQuery(".answer-thanks");
        const questionnaireForm = jQuery("#faq-questionnaire-form");
        const sendFaqCommentbutton = jQuery("#send-faq-comment-button");
    
        // 初期状態ではメッセージとフォームを非表示
        answerThanks.css("display", "none");
        questionnaireForm.css("display", "none");
    
        function disableButton(button) {
            button.prop("disabled", true);
            button.css({"opacity": "0.5", "pointer-events": "none"});
        }
    
        yesButton.click(function () {
            answerThanks.css("display", "block");
            disableButton(yesButton);
            disableButton(noButton);
        });
    
        noButton.click(function () {
            questionnaireForm.css("display", "block");
            disableButton(yesButton);
            disableButton(noButton);
        });
        sendFaqCommentbutton.click(function () {
            answerThanks.css("display", "block");
            questionnaireForm.prop("disabled", true);
            questionnaireForm.css({"opacity": "0.5", "pointer-events": "none"});
            disableButton(sendFaqCommentbutton);
        });
    });

    document.querySelector('.faq-questionnaire__btn-list').addEventListener('click', (e) => {
        e.preventDefault(); // イベント動作を止める
    
        let button = e.target.closest('button'); // ボタン要素を取得
        if (!button) return; // クリック対象がボタンでなければ処理しない
    
        let elementId = button.id;
        let nonce = document.querySelector('[name="faq_all_resolve_nonce"]').value; // nonceを取得
    
        let resolved = 'not resolved';
        if (elementId == 'faq-questionnaire-yes') {
            resolved = 'resolved';
        }
        let param = {
            action: 'save_faq_all_resolve',
            resolved: resolved,
            search_word: '<?php echo esc_js(get_search_query()); ?>',
            search_quantity: <?php echo (int)$faq_count; ?>,
            _wpnonce: nonce
        };
    
        // fetch のオプション設定
        const opt = {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // `application/json` ではなく `x-www-form-urlencoded`
            body: new URLSearchParams(param) // 正しくデータを送信する
        };
    
        // Ajax 送信
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', opt)
            .then(response => {
                if (!response.ok) {
                    throw new Error();
                }
                return response.text();
            })
            .then(text => {
                if (text !== '') {
                    document.querySelector('.answer-thanks p').innerHTML = 'ご回答ありがとうございました';
                    resolve_id = text;
                } else {
                    document.querySelector('.answer-thanks p').innerHTML = '保存に失敗しました';
                }
            })
            .catch(error => {
                document.querySelector('.answer-thanks p').innerHTML = 'エラーが発生しました';
            });
    });


    document.querySelector('#send-faq-comment-button').addEventListener('click', (e) => {
        e.preventDefault(); // イベント動作を止める
    
        let nonce = document.querySelector('[name="faq_all_resolve_nonce"]').value; // nonceを取得
        let param = {
            action: 'save_faq_all_resolve_comment',
            resolve_id: resolve_id,
            resolve_comment: document.querySelector('#textarea-faq').value,
            _wpnonce: nonce
        };
        console.log(param)
    
        // fetch のオプション設定
        const opt = {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, // `application/json` ではなく `x-www-form-urlencoded`
            body: new URLSearchParams(param) // 正しくデータを送信する
        };
        // Ajax 送信
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', opt)
            .then(response => {
                if (!response.ok) {
                    throw new Error();
                }
                return response.text();
            })
            .then(text => {
                if (text === 'success') {
                    document.querySelector('.answer-thanks p').innerHTML = 'ご回答ありがとうございました';
                } else {
                    document.querySelector('.answer-thanks p').innerHTML = '保存に失敗しました';
                }
            })
            .catch(error => {
                document.querySelector('.answer-thanks p').innerHTML = 'エラーが発生しました';
            });
    });
</script>
<?php get_footer(); ?>