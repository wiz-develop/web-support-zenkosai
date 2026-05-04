<?php
function my_user_logout() {
    require_once('/var/www/html/cms/wp-load.php');
    global  $mypage_directori;
    // TODO:global変数でクッキーの保持時間指定
    $infoshown =
    [
        'message' => null,
        'flag' => null
    ];

    if (!empty($_SESSION['redirect_after_login'])) {
        $redirect_url = $_SESSION['redirect_after_login'];
        unset($_SESSION['redirect_after_login']);
        wp_redirect($redirect_url);
        exit;
    }

    // セッションに情報がない場合
    if (empty($_SESSION['member_info'])) {
        $infoshown['message'] = 'セッションの有効期限が切れました。再度ログインしてください。';
        $infoshown['flag'] = 'timeout';

        // 表示用のセッションに格納して専用ページへ
        $_SESSION['logout_info'] = $infoshown;
        wp_redirect(home_url('/session-expired/'));
        exit;
    }

    //ログアウトAPI
    $url = $mypage_directori.'/login/logout/';

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // レスポンスを文字列で受け取る

    //APIレスポンス処理（JSON)
    // レスポンスを変数に入れる
    $response = curl_exec($curl);
    curl_close($curl);

    redirect(home_url('/'));
}
?>