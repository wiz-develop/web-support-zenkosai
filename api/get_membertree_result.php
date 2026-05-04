<?php
    function get_membertree_date() {
        require_once('/var/www/html/cms/wp-load.php');
        global $wpdb;
        global $mypage_directori;
        $infoshown =
        [
            'message' => null,
            'flag' => null
        ];
        // ログインAPI
        $url = $mypage_directori.'/api/get-wording';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, '');
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

        if ($resl === 1) {
            foreach ($arr as $key => $value){
                $arr[$key] = _decrypt($value, $password);
            }
            $membertree = $arr;
            return $membertree;
        }else{
            $infoshown['message']= '取得に失敗しました。';
            return $infoshown;
        }

        // curlの処理を終了
        curl_close($curl);
    }
?>