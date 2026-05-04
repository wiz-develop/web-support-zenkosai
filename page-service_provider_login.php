<?php
/**
 * Template Name: [サービス提供会社様向け]ログイン
 */
session_start();
global $wpdb;

if(isset($_POST['my_signin'])) {
    $login_status = is_user_logged_in();
    $creds = array();
    $creds['user_login'] = $_POST['user_name'];
    $creds['user_password'] = $_POST['user_pass'];
    $creds['remember'] = true;
    $user = wp_signon( $creds, false );
    
    $message = "";
    
    if (is_wp_error($user)) {
        $message = 'ログインできませんでした。ユーザーIDまたはパスワードを確認してください';
    } else if (current_user_can('service_provider')) {
        wp_logout();
        $message = 'ログインできませんでした。ユーザーIDまたはパスワードを確認してください';
    } else {
        /** ログ書き込み START*/
        date_default_timezone_set('Asia/Tokyo');
        //IP取得
        $ip = '';
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $xForwardedFor = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if (!empty($xForwardedFor)) {
                $ip = trim($xForwardedFor[0]);
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = (string)$_SERVER['REMOTE_ADDR'];
        }
        // テーブルに挿入
        $wpdb->insert(
            'wpz_access_log', 
            array(
                'user_type' => 'service_provider',
                'login_id' => $_POST['user_name'],
                'created_at' => date("Y/m/d H:i:s"),
                'ip' => $ip,
                'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                'action' => 'login',
                'value1' => null,
                'value2' => null
            ),
            array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
        );
        /** ログ書き込み END*/
        wp_redirect(home_url('member-search'));
    }
}

get_header('service_provider');



/**
if($_SESSION['member_info']){
    wp_redirect(home_url('member-search'));
    exit;
}
require_once("cms/wp-content/themes/zenkosai/api/user_service_login.php");
if(isset($_POST['my_signin'])){
    $error_show = my_user_login();
}
get_header('member-search');

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

if($_SERVER['HTTP_REFERER'] !== home_url('/login/')){
    $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}
*/
?>
<div id="page-login" class="container pt-5 page-wrapper member-search">
    <div class="page-header">
        <div class="page-top">
            <h1 class="mb-0">全厚済会員情報検索</h1>
        </div>
    </div><!-- page-header -->


    <div class="caution-text text-danger mx-auto"><?php if (!empty($error_show)) echo $error_show['message'];?></div>
        <form class="my_form" name="my_login_form" id="my_login_form" action="" method="post" novalidate="novalidate">
            <div class="col-11 col-lg-7 d-flex flex-column align-items-center ml-auto mr-auto">
                <div class="check-id-box mb-2 text-left col-12 col-md-10 row">
                    <label class="col-12 col-md-4" for="login_user_name">ユーザーID　</label>
                    <div class="col-12 col-md-8 mx-auto px-0 mb-0">
                        <input id="login_user_name" class="<?php echo $input_invalid_id; ?>" name="user_name" type="text" value="<?php if (!empty($error_show)) { echo $error_show['user_name']; } ?>" pattern="^[0-9A-Za-z]+$" required>
                        <p class="pass-visible ml-1"></p>
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
                <div class="col-12 row">
                    <div class="" style="color:red"><?php echo $message; ?></div>
                </div>

                <!-- <u class="my_forgot_pass mt-3">
                    <a href="<?php //echo $mypage_directori; ?>/reminder/password/" class="text-danger">パスワードを忘れた方はこちら</a>
                </u> -->
            </div>
            <div class="text-center">
                <button type="submit" name="my_signin" class="my_submit_btn btn border shadow-sm px-2 mt-3 mb-4" value="login" class="btn mt-2">ログイン</button>
                <!--<p class="my_signup mt-3">
                    <a href="/regist/">新規会員登録</a>
                </p>-->
            </div>
            <?php wp_nonce_field( 'my_nonce_action', 'my_nonce_name' );  //nonceフィールド設置 ?>
        </form>
    </div>
<?php get_footer(); ?>
<script>
    jQuery(function($){
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