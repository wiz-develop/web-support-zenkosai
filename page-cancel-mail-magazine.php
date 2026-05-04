<?php
/*
 * Template Name: メルマガ配信停止
 */

get_header();
$mail = '';
if (isset($_GET['mail'])) {
    $mail = $_GET['mail'];
}
?>
<div id="page-cancel-mail-magazine" class="page-cancel-mail-magazine page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> mt-0">
    <div class="page-content-wrapper pt-5">
        <div class="container">
            <div class="content">
                <div class="content__body">
                    <div class="cancel-form-wrap">
                        <div class="cancel-form-wrap__content">
                            <?php the_content() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
<script>
jQuery(function($){
    // メールアドレスを入力する
    var mail = <?php echo "'".$mail."'"; ?>;
    if (!$('.js-mail').val()) {
         $('.js-mail').val(mail);
    }

    $('.js-cancel-form-submit').on('click', function () {
        $(this).css('pointer-events','none');
        $(this).css('color','gray');
        $('#send-pending-message').removeClass('d-none');
    });

    // // 確認画面→完了画面
    // document.addEventListener( 'wpcf7mailsent', function( event ) {
    //     location = 'https://official-webdev.zenko-sai.or.jp/cancel-mail-magazine/thanks/';
    // }, false );
});
</script>
