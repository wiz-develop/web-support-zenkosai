<?php
/*
 * Template Name:[サービス提供会社様向け]会員情報検索
 */
session_start();
global $wpdb;

$member_info_list = array();

$search_pattern = $_POST['search_pattern'];
$search_member_id = $_POST['search_member_id'];
$search_tel = $_POST['search_tel'];
if (!empty($search_member_id)) {
    $member_info_list = members_search_action($search_member_id,'');
} else if (!empty($search_tel)) {
    $member_info_list = members_search_action('',$search_tel);
}

if (!empty($search_member_id) || !empty($search_tel)) {
    /** ログ書き込み START*/
    date_default_timezone_set('Asia/Tokyo');
    
    //ユーザーID取得
    $user = wp_get_current_user();
    $user_data = $user->data;
    $user_login = $user_data->user_login;
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
    //search_result
    $result_member_id = "";
    foreach($member_info_list as $member_info){
        $result_member_id .= $member_info['member_id'] . ',';
    }
    // テーブルに挿入
    $wpdb->insert(
        'wpz_access_log', 
        array(
            'user_type' => 'service_provider',
            'login_id' => $user_login,
            'created_at' => date("Y/m/d H:i:s"),
            'ip' => $ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'action' => 'search_member',
            'value1' => 'search condition: member_id=' . $search_member_id . " tel=" . $search_tel,
            'value2' => 'search result: ' . $result_member_id
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
    /** ログ書き込み END*/
}

get_header('service_provider');

?>


<div id="member-search" class="page-wrapper member-search <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
        </div>
        <div class="page-top">
            <h1 class="mb-0">全厚済会員情報検索</h1>
        </div>
    </div><!-- page-header -->
    
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap w-100">
                <div class="page-content-div mod-head rounded px-3 pt-3 pb-2">
                    <div class="search-content row p-0">
                        <div class="search-content__item col-6">
                            <h2>会員ID</h2>
                            <form method="post" class="search" action="" >
                                <input type="hidden" value="member_id" name="search_pattern">
                                <input type="text" placeholder="00000000" value="<?php if($search_member_id){ echo $search_member_id;} ?>" name="search_member_id">
                                <button type="submit" class="search-submit btn">検索</button>
                                <button type="button" class="search-clear btn clear-member_id">クリア</button>
                                <?php if ($search_pattern == 'member_id' && !$search_member_id) { ?><p class="error_message">会員IDを入力してください</p><?php } ?>
                            </form>
                        </div>
                        <div class="search-content__item col-6">
                            <h2>電話番号</h2>
                            <form method="post" class="search" action="" >
                                <input type="hidden" value="tel" name="search_pattern">
                                <input type="text" placeholder="0000000000" value="<?php if($search_tel){ echo $search_tel;} ?>" name="search_tel">
                                <button type="submit" class="search-submit btn">検索</button>
                                <button type="button" class="search-clear btn clear-tel">クリア</button>
                                <?php if ($search_pattern == 'tel' && !$search_tel) { ?><p class="error_message">電話番号を入力してください</p><?php } ?>
                            </form>
                        </div>
                    </div>
                    <div class="reset-btn mx-auto text-right">
<!--                         <button class="bg-transparent shadow-none border-0 w-auto my-1">検索条件をクリア</button> -->
                    </div>
                </div>
                <div class="page-content-div mod-body mt-5">  
                    <div class="search-result">
                        <div class="search-result__header d-flex justify-content-between align-items-baseline">
                           <p class="search-result__header__tit mb-0">検索結果</p><!-- <p class="mb-0">00件中 / 00件〜00件を表示</p> -->
                        </div>
                        <table>
                            <tr class="item-name">
                                <th><p class="mb-0">会員ID</p></th>
                                <th><p class="mb-0">会員名</p></th>
                                <th><p class="mb-0">会員名カナ</p></th>
                                <th><p class="mb-0">代表者名</p></th>
                                <th><p class="mb-0">代表者名カナ</p></th>
                                <th><p class="mb-0">会員種別</p></th>
                                <th><p class="mb-0">登録区分</p></th>
                                <th class="item-name__qualification"><p class="mb-0">PB資格</p></th>
                                <th class="item-name__qualification"><p class="mb-0">EP資格</p></th>
                            </tr>

                            <?php // 検索前
                                if (!$search_member_id && !$search_tel) {
                            ?>

                            <?php // 検索後：該当データあり
                                } else {
                            ?>
                                <?php 
                                    $disp_count = 0;
                                    foreach($member_info_list as $member_info){
                                        $disp_count++;
                                        if ($disp_count <= 10) {
                                ?>
                                            <tr>
                                                <td><p class="mb-0"><?php echo $member_info['member_id']; ?></p></td>
        
                                                <?php // 退会会員
                                                    if ($member_info['member_status'] != 0) {
                                                ?>
                                                    <td colspan="9" class="text-center">
                                                        <p class="mb-0">対象の会員は退会済みか、正常な会員状態ではありません</p>
                                                    </td>
                                                <?php } else {
                                                    // 会員種別
                                                    $m_type = $member_info['member_type'];
                                                    $replace_membertype = ['1'=>'P会員', '2'=>'K会員', '3'=>'PS会員', '4'=>'KS会員'];
                                                    $m_type_name = $replace_membertype[$m_type];

                                                    // 登録区分
                                                    $r_type = $member_info['regist_type'];
                                                    $replace_rtype = ['1'=>'個人', '2'=>'法人', '3'=>'個人事業主'];
                                                    $r_type_name = $replace_rtype[$r_type];                                                    
                                                ?>
                                                    <td><p class="mb-0"><?php echo $member_info['member_name']; ?></p></td>
                                                    <td><p class="mb-0"><?php echo $member_info['member_kana']; ?></p></td>
                                                    <td><p class="mb-0"><?php echo $member_info['position_name']; ?></p></td>
                                                    <td><p class="mb-0"><?php echo $member_info['position_kana']; ?></p></td>
                                                    <td><p class="mb-0"><?php echo $m_type_name; ?></p></td>
                                                    <td><p class="mb-0"><?php echo $r_type_name; ?></p></td>
                                                    <td><?php echo $member_info['pb_flg']    ? '<p class="circle mb-0">〇</p>' : '<p class="bad mb-0">×</p>'; ?></td>
                                                    <td><?php echo $member_info['ep_flg'] ? '<p class="circle mb-0">〇</p>' : '<p class="bad mb-0">×</p>'; ?></td>
                                                <?php } ?>
                                            </tr>
                            <?php       }
                                    }
                                ?>
                            <?php } ?>

                            <?php // 検索後：該当データなし
                                if ($disp_count == 0) {
                            ?>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        <p class="mb-0">対象の会員は存在しません</p>
                                    </td>
                                </tr>
                            <?php } ?>

                        </table>
                        <?php if ($disp_count > 10) {
                            echo '<p class="limit_over_message">' . $disp_count . '件中 最大10件のみ表示</p>';
                        } ?>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<script>
    jQuery('.clear-member_id').click(function(){
        jQuery('input[name="search_member_id"]').val('');
    })
    jQuery('.clear-tel').click(function(){
        jQuery('input[name="search_tel"]').val('');
    })
</script>

<?php // get_footer();
?>