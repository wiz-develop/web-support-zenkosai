<?php
    function my_user_login() {
        require_once('/var/www/html/cms/wp-load.php');
        global $wpdb;
        global  $mypage_directori;
        $user_name = $_POST['user_name'];
        if(!is_null($user_name)){
            $user_name = sprintf('%012d', $user_name);
        }
        $user_pass = $_POST['user_pass'];
        $referer   = $_POST['referer'];
        $infoshown =
        [
            'user_name' => $_POST['user_name'],
            'user_pass' => $_POST['user_pass'],
            'message' => null,
            'flag' => null
        ];
        //空じゃないかチェック
        if (is_null($user_name) || is_null($user_pass)) {
            $infoshown['message'] = '情報が不足しています。';
            $flag = [];
            if (is_null($user_name)) {
                $flag[] = 1;
            }
            if (is_null($user_pass)) {
                $flag[] = 2;
            }
            $infoshown['flag'] = $flag;
            return $infoshown;
        }
        //エンコード関数の呼び出し
        $password = 'ZenkosaiOpenSSLEncrypt';
        $en_user_name = _encrypt($user_name, $password);
        $en_user_pass = _encrypt($user_pass, $password);
        $if_success = login_action($en_user_name, $en_user_pass);
        if($if_success == 'success'){
            wp_redirect(home_url('member-search'));
            exit;
        }else{
            $infoshown['message'] = $if_success;
            $flag[] = 1;
            $flag[] = 2;
            $infoshown['flag'] = $flag;
            return $infoshown;
        }
    }
?>