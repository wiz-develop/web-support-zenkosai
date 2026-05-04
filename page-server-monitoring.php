<?php
/**
 * Template Name: 死活監視
 */
get_header();
global $mypage_directori;

$result_message = "";

require_once("cms/wp-content/themes/zenkosai/api/user_login.php");
if(isset($_POST['my_signin'])){
    $_POST['user_name'] = 10;
    $_POST['user_pass'] = 'nkyosai3120';
    $_POST['referer'] = 'server-monitoring';
    $error_show = array();

    // ログイン処理
    $error_show = my_user_login();

    // ログイン時にエラーが発生した場合のテストソース
    // $error_show['message'] = 'エラーが発生しました';
    // $error_show['flag'] = '2';

    if ($error_show === 'login-success') {
        // ログアウト処理
        session_unset();
        // session_unset(); は非推奨のため以下に変えた方がいい？
        // session_start();
        // $_SESSION = array();
        // session_destroy();
        header('Location: '.$mypage_directori.'/login/logout/');
        wp_redirect(home_url('/server-monitoring'));
        $_POST = array();
        exit;
    } else {
        $_POST = array();
    }
}
?>
<div id="page-login" class="container pt-5 page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
<div class="caution-text text-danger mx-auto"><?php if (!empty($error_show)) echo $error_show['message'];?></div>
<div class="caution-text text-primary mx-auto"><?php if (!empty($result_message)) echo $result_message; ?></div>
   
    <?php if(!$_SESSION['member_info']) : ?>
    <form class="my_form" name="my_login_form" id="my_login_form" action="" method="post" novalidate="novalidate">
        <div class="text-center">
            <button type="submit" name="my_signin" id="login-button-for-monitoring-zenkosai-site-servers" class="my_submit_btn btn border shadow-sm px-2 mt-3 mb-4" value="login" class="btn mt-2">ログイン</button>
        </div>
        <?php wp_nonce_field( 'my_nonce_action', 'my_nonce_name' );  //nonceフィールド設置 ?>
    </form>
    <?php else : ?>
        <p class="mb-0 text-center">ログインされています。</p>
    <?php endif; ?>

</div>
<?php get_footer(); ?>