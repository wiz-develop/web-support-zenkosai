<?php
/*
 * Template Name: FAQ 質問・回答詳細
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
$pa_incompany = $cfs->get('pa_incompany');
if ($pa_incompany && $_SESSION['member_info']['member_id'] !== '000000000000') {
    wp_redirect(home_url('/faq'));
    exit;
}

get_header();
$faq_post_type = 'ufaq';
$faq_cat_slug = 'ufaq-category';
$faq_tag_slug = 'ufaq-tag';

$p_id = get_the_ID();
?>

<div id="page-ufaq"
    class="single-ufaq page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
    <div class="page-header container">
        <!-- <div class="container"> -->
        <?php
        /*-------------------------------------------*/
        /* BreadCrumb
        /*-------------------------------------------*/
        do_action('lightning_breadcrumb_before');
        $old_file_name[] = 'module_panList.php';
        if (locate_template($old_file_name, false, false)) {
            locate_template($old_file_name, true, false);
        } else {
            get_template_part('template-parts/breadcrumb');
        }
        do_action('lightning_breadcrumb_after');
        ?>
        <!-- </div> -->
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <div class="container">
            <div class="flame-body">
                <div class="page-content-innerwrap">
                    <div class="page-content-div">
                        <div class="answer-title">
                            <div class="faq-namber pl-2 px-md-3">
                                <?php $faq_number = $cfs->get('number_field_ufaq'); ?>
                                No.<?php echo $faq_number; ?>
                            </div>
                            <h1 class="faq-title pl-2 pl-md-3">
                                <p class="mb-0"><?php the_title(); ?></p>
                            </h1>
                        </div>
                        <div class="faq-answer mt-3">
                            <div class="faq-answer__heading">
                                回答
                            </div>
                            <div class="faq-answer__explanation">
                                <?php
                                if (have_posts()):
                                    while (have_posts()):
                                        the_post();
                                        $answer = get_the_content();
                                        echo $answer;
                                    endwhile;
                                endif;
                                ?>
                            </div>
                            <?php
                            $relation_details = $cfs->get('relation_details');
                            $relation_links = $cfs->get('relation_links');
                            $relation_pdfs = $cfs->get('relation_pdfs');

                            if ($relation_links):
                                ?>
                                <div class="faq-answer__link">
                                    <div class="faq-answer__link__title">
                                        関連ウェブページ
                                    </div>
                                    <div class="faq-answer__link__list">
                                        <?php
                                        foreach ($relation_links as $relation_link):
                                            $relation_link_title = $relation_link['relation_link_title'];
                                            $relation_url = $relation_link['relation_url'];
                                            if ($relation_url):
                                                ?>
                                                <a href="<?php echo $relation_url; ?>" target="_blank">
                                                    <div
                                                        class="faq-answer__link__list__item d-flex justify-content-between align-items-center">
                                                        <span><?php echo $relation_link_title; ?></span>
                                                        <div class="faq-answer__link__list__item__icon">
                                                            <img src="/cms/wp-content/themes/zenkosai/assets/images/faq/link-icon.png">
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                                <?php
                            endif;
                            if ($relation_pdfs):
                                ?>
                                <div class="faq-answer__link">
                                    <div class="faq-answer__link__title">
                                        資料ダウンロード
                                    </div>
                                    <div class="faq-answer__link__list">
                                        <?php
                                        foreach ($relation_pdfs as $relation_pdf):
                                            $relation_pdf_title = $relation_pdf['relation_pdf_title'];
                                            $relation_file = $relation_pdf['relation_file'];
                                            if ($relation_file):
                                                ?>
                                                <a href="<?php echo $relation_file; ?>" target="_blank">
                                                    <div
                                                        class="faq-answer__link__list__item d-flex justify-content-between align-items-center">
                                                        <span><?php echo $relation_pdf_title; ?></span>
                                                        <div class="faq-answer__link__list__item__icon">
                                                            <img src="/cms/wp-content/themes/zenkosai/assets/images/faq/dl-icon.png">
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php
                                            endif;
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                                <?php
                            endif;
                            if ($relation_details):
                                foreach ($relation_details as $relation_detail):
                                    $relation_detail_title = $relation_detail['relation_detail_title'];
                                    $relation_text = $relation_detail['relation_text'];
                                    ?>
                                    <div class="faq-answer__detail">
                                        <div class="faq-answer__detail__title mb-3">
                                            <?php echo $relation_detail_title; ?>
                                        </div>
                                        <div class="faq-answer__detail__txt">
                                            <?php echo $relation_text; ?>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
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
                                <?php wp_nonce_field('faq_resolve_action', 'faq_resolve_nonce'); ?>
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
            </div>
        </div>
        <?php
        $reration_faq_categories = $cfs->get('reration_faq_categories');
        if ($reration_faq_categories):
            ?>
            <section class="search-faq related-q">
                <div class="columns pb-0">
                    <div class="container">
                        <div class="page-content-innerwrap">
                            <div class="serch-item d-block">
                                <h2>関連の質問</h2>
                            </div>
                            <?php
                            foreach ($reration_faq_categories as $reration_faq_category):
                                $reration_faq_cat = $reration_faq_category['reration_faq_cat'];
                                $reration_faq = $reration_faq_category['reration_faq'];

                                if ($reration_faq_cat):
                                    ?>
                                    <div class="serch-item-sub">
                                        <h3><?php echo $reration_faq_cat; ?></h3>
                                    </div>
                                <?php endif; ?>
                                <div class="faq-backlink">
                                    <?php foreach ($reration_faq as $reration_faq_id): ?>
                                        <a href="<?php the_permalink($reration_faq_id); ?>">
                                            <div class="faq-nextanswer">
                                                <span><?php echo get_the_title($reration_faq_id); ?></span>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <?php get_template_part('/templates/searchform-faq'); ?>
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
        let nonce = document.querySelector('[name="faq_resolve_nonce"]').value; // nonceを取得
    
        let resolved = 'not resolved';
        if (elementId == 'faq-questionnaire-yes') {
            resolved = 'resolved'
        }
        let param = {
            action: 'save_faq_resolve',
            post_id: <?php echo $p_id; ?>,
            faq_no: <?php echo $cfs->get('number_field_ufaq'); ?>,
            post_title: '<?php the_title(); ?>',
            resolved: resolved,
            _wpnonce: nonce // nonceを送信
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
    
        let nonce = document.querySelector('[name="faq_resolve_nonce"]').value; // nonceを取得
        let param = {
            action: 'save_faq_resolve_comment',
            resolve_id: resolve_id,
            resolve_comment: document.querySelector('#textarea-faq').value,
            _wpnonce: nonce // nonceを送信
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