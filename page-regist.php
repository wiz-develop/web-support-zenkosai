<?php
/*
 * Template Name: 新規会員登録
 */
if (is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}

require_once("cms/wp-content/themes/zenkosai/api/user_login.php");
if(isset($_POST['my_signin'])){
    $error_show = my_user_login();
}
get_header();

$input_invalid_id = '';
$input_invalid_pass = '';
if (isset($error_show)) {
    $flag = $error_show['flag'];
    if (in_array(1, (array)$flag) == true) {
        $input_invalid_id = 'input-invalid';
    }
    if (in_array(2, (array)$flag) == true) {
        $input_invalid_id = 'input-invalid';
    }
}

// メンテナンス表示
$today_date = new DateTime('now');
$maintenance = '';
$disabled = '';
$tabindex = '';
$maintenance_text = '';

$maintenance_start = new DateTime('2025-05-18 6:00:00');
$maintenance_end = new DateTime('2025-05-05 14:00:00');
if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
	$maintenance = 'now-maintenance';
	$disabled = 'disabled';
	$maintenance_pass = 'd-none';
	// $tabindex = 'tabindex="-1"';
	$maintenance_text = '<p class="login-maintenance">メンテナンス中</p>';
}
?>
<div id="page-login" class="page-regist page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
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
        </div>
        <div class="page-top">
            <div class="page-top__back">
                <img src="/cms/wp-content/uploads/2021/02/page-top_none.jpg">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container position-relative">
            <div class="page-content-innerwrap">
                <p class="mb-5">
                一般財団法人全国福利厚生共済会のホームページにアクセスしていただきありがとうございます。<br>
                当会への会員申込みは、当会の会員様からのご紹介によりお申込いただけます。<br>
                会の説明および会員申込方法などをお聞きいただいたうえでお申込ください。<br><br>
                会員様でWEB申込みの紹介メールを出す場合は、ログインをしてからお手続きください。
                </p>
                <div class="join">
                    <div class="page-content-div">
                        <!-- <form class="my_form" name="my_login_form" id="my_login_form" action="" method="post" novalidate="novalidate">
                            <div class="login-form col-11 col-lg-7 d-flex flex-column align-items-center mx-auto p-0">
                                <div class="check-id-box mb-2 text-left col-12 col-md-10 row m-0">
                                    <label class="col-12 col-md-4 text-nowrap" for="login_user_name">会員ID　</label>
                                    <div class="col-12 col-md-8 mx-auto px-0 my-0">
                                        <input id="login_user_name" class="w-auto <?php echo $input_invalid_id; ?>" name="user_name" type="text" value="<?php if (!empty($error_show)) { echo $error_show['user_name']; } ?>" pattern="^[0-9A-Za-z]+$" required>
                                    </div>
                                </div>
                                <div class="check-id-box mb-2 text-left col-12 col-md-10 row m-0">
                                    <label class="col-12 col-md-4 text-nowrap" for="login_password">パスワード</label>
                                    <div class="col-12 col-md-8 mx-auto px-0 my-0 d-flex flex-row">
                                        <input id="login_password" class="w-auto <?php echo $input_invalid_pass; ?>" name="user_pass" id="user_pass" type="password" value="<?php if (!empty($error_show)) { echo $error_show['user_pass']; } ?>" min-length="6" max-length="12" pattern="^([a-zA-Z0-9]{6,12})$" required>
                                        <input type="hidden" name="referer" value="<?php the_permalink(); ?>">
                                        <p class="pass-visible cursor-pointer text-center rounded05 bg-lightyellow border shadow-sm mb-1 p-1 ml-1">表示</p>
                                    </div>
                                </div>
                                <u class="my_forgot_pass mt-3">
                                    <a href="<?php echo $mypage_directori; ?>/reminder/password/" class="text-danger">パスワードを忘れた方はこちら</a>
                                </u>
                            </div>
                            <div class="text-center mb-0 bg-transparent p-0">
                                <button type="submit" name="my_signin" class="my_submit_btn btn border shadow-sm px-2 mt-3 mb-4" value="login" class="btn mt-2">ログイン</button>
                            </div>
                        </form> -->
                        <div class="caution-text text-center bg-white text-danger mx-auto"><?php if (!empty($error_show)) { echo $error_show['message']; } ?></div>
                        <form class="my_form" name="my_login_form" id="my_login_form" action="" method="post" novalidate="novalidate">
                            <div class="login-form col-11 col-lg-7 d-flex flex-column align-items-center ml-auto mr-auto">
                                <div class="check-id-box mb-2 text-left col-12 col-md-10 row">
                                    <label class="col-12 col-md-4" for="login_user_name">会員ID　</label>
                                    <div class="col-12 col-md-8 mx-auto px-0 mb-0">
                                        <input id="login_user_name" class="<?php echo $input_invalid_id; ?>" name="user_name" type="text" value="<?php if (!empty($error_show)) { echo $error_show['user_name']; } ?>" pattern="^[0-9A-Za-z]+$" required>
                                    </div>
                                </div>
                                <div class="check-pass-box mb-2 text-left col-12 col-md-10 row">
                                    <label class="col-12 col-md-4 text-nowrap" for="login_password">パスワード</label>
                                    <div class="col-12 col-md-8 mx-auto px-0 mb-0 d-flex flex-row">
                                        <input id="login_password" class="<?php echo $input_invalid_pass; ?>" name="user_pass" id="user_pass" type="password" value="<?php if (!empty($error_show)) { echo $error_show['user_pass']; } ?>" min-length="6" max-length="12" pattern="^([a-zA-Z0-9]{6,12})$" required>
                                        <p class="pass-visible cursor-pointer text-center rounded05 bg-lightyellow border shadow-sm mb-1 p-1 ml-1">表示</p>
                                    </div>
                                    <input type="hidden" name="referer" value="<?php echo $_SESSION['referer'];?>">
                                </div>
                                <u class="my_forgot_pass mt-3 <?php echo $maintenance_pass; ?>">
                                    <a href="<?php echo $mypage_directori; ?>/reminder/password/" class="text-danger">パスワードを忘れた方はこちら</a>
                                </u>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="my_signin" class="my_submit_btn btn border shadow-sm px-2 mt-3 mb-4 position-relative <?php echo $maintenance; ?>" value="login" class="btn mt-2">
                                    <span>ログイン</span>
                                    <?php echo $maintenance_text; ?>
                                </button>
                                <!--<p class="my_signup mt-3">
                                    <a href="/regist/">新規会員登録</a>
                                </p>-->
                            </div>
                            <?php wp_nonce_field( 'my_nonce_action', 'my_nonce_name' );  //nonceフィールド設置 ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<script>
    jQuery(function($){
    // submit前validationチェック
        $('form').submit(function(){
            is_error_input = 0;
            $('p.precautious').remove();
            toolong = '<p class="precautious text-danger">入力項目が長すぎます。</p>';
            tooshort = '<p class="precautious text-danger">入力項目が短かすぎます。</p>';
            if($('input#login_user_name').val().length > 20 || $('input#login_password').val().length > 12){
                if($('input#login_user_name').val().length > 20){
                    $('input#login_user_name').addClass('input-invalid');
                    $('.check-id-box').after(toolong);
                }
                if($('input#login_password').val().length > 12){
                    $('input#login_password').addClass('input-invalid');
                    $('.check-pass-box').after(toolong);
                }
                is_error_input = 1;
            }
            if($('input#login_user_name').val().length < 1 || $('input#login_password').val().length < 6){
                if($('input#login_user_name').val().length < 1 ){
                    $('input#login_user_name').addClass('input-invalid');
                    $('.check-id-box').after(tooshort);
                }
                if($('input#login_password').val().length < 6){
                    $('input#login_password').addClass('input-invalid');
                    $('.check-pass-box').after(tooshort);
                }
                is_error_input = 1;
            }
            if(is_error_input == 1){
                return false;
            }
            return true;
        });

        $(document).on('click','.pass-visible',function(){
            $(this).toggleClass('visible');
            if($(this).hasClass('visible')){
                $('input#login_password').attr('type', 'text');
                $(this).text('非表示');
                $(this).addClass('bg-lightgray');
                $(this).removeClass('bg-lightyellow');
                $(this).removeClass('border-sm');
            } else {
                $('input#login_password').attr('type', 'password');
                $(this).text('表示');
                $(this).removeClass('bg-lightgray');
                $(this).addClass('bg-lightyellow');
                $(this).addClass('border-sm');
            }
        });
        
    });
    </script>