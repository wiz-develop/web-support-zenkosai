<?php
    require_once('/var/www/html/cms/wp-load.php');
    global $wpdb;

    session_start();
    if(!$_SESSION['member_info']){
        wp_redirect(home_url('/'));
        exit;
    }
    $_SESSION['member_info']['mypage_visit'] = 1;
