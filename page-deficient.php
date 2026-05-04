<?php
/*
 * Template Name: 登録書類不備
 */

get_header();?>
<?php
if(!$r_deficient){
    wp_redirect(home_url('/'));
    exit;
}
?>

<div id="page-deficient" class="page-deficient page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-content-wrapper columns mt-0">
        <div class="container">
            <div class="row mx-auto">
                <div class="container-fluid text-center">
                    <div class="page-content-innerwrap">
                        <div id="commission" class="page-content-div">
                            <p class="">会員登録が完了していません。<br>こちらのリンクから登録を完了してください。</p>
                            <div class="">
                                <div class="">
                                    <div class="page-content">
                                        <a class="mypage_form" data-formid="submitMypage" data-formabout="mail_deficient">
                                            <button class="bg-lightblue rounded05 border shadow-sm">
                                                <p class="mb-0 pl-3 py-2">本人確認証明書アップロード<i class="fas fa-caret-right font-larger px-3"></i></p>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>