<?php
/*
 * カレンダー 詳細ページ
 */
session_start();
// P会員以外をホームへ遷移
if($_SESSION['member_info']['member_type'] !== 'p_member' ){
    wp_redirect(home_url('/'));
    exit;
} else {
    wp_redirect(home_url('/business/'));
    exit;
}