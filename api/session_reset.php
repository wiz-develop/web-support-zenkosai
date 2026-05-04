<?php
    require_once('/var/www/html/cms/wp-load.php');
    global $wpdb;

    session_start();
    $result = login_action($_SESSION['member_info']['member_id_pre'], $_SESSION['member_info']['member_pw_pre']);
    if ($result == 'success' && $_SESSION['member_info']['mail_judge'] == "1") {
        echo 'resetted';
        return;
    }
    echo 'failed';
    return;
?>

