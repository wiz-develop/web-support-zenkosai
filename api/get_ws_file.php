<?php
    require_once('/var/www/html/cms/wp-load.php');
    global $wpdb;
    global $mypage_directori;
    session_start();
    $user_name = $_SESSION['member_info']['member_id'];
    if ($user_name == null || empty($user_name)) {
        echo '/login';
        exit;
    } else {
        $user_name = sprintf('%012d', $user_name);
        $infoshown =
        [
            'user_name' => $user_name,
            'message' => null,
            'flag' => null
        ];

        //エンコード関数の呼び出し
        $password = 'ZenkosaiOpenSSLEncrypt';
        $en_user_name = _encrypt($user_name, $password);

        //ログインAPI
        $url = $mypage_directori.'/api/get-ws-elearning-url';

        // 渡したいパラメータ
        $params =
        [
            'member_id' => $en_user_name,
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);   // パラメータをセット
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // レスポンスを文字列で受け取る

        //APIレスポンス処理（JSON)
        // レスポンスを変数に入れる
        $response = curl_exec($curl);
        $response_info        = curl_getinfo($curl);              //結果に関する情報を格納
        $response_code        = $response_info['http_code'];      //通信結果のHTTPステータスコード
        $response_header_size = $response_info['header_size'];    //通信結果のヘッダサイズ

        // JSON連想配列へ変換
        $arr = json_decode($response, true);

        //デコード関数を呼び出す
        $password = 'ZenkosaiOpenSSLEncrypt';
        $resl = _decrypt($arr['success'], $password);
        $resl = (int)$resl;

        //カウントの初期化
        if ($resl === 1) {
            // $fileurl  = json_encode($arr['url']);
            // $fileurl　= str_replace( '"' , '' , $fileurl);
            $fileurl  = $arr['url'];
            echo $fileurl;
        }else{
            $infoshown['message']= '処理に失敗しました。';
            return $infoshown;
            exit;
        }

        // curlの処理を終了
        curl_close($curl);
    }
?>