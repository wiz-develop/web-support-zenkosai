<?php
/*
 * Template Name: インフォメーション一覧
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
} else {
    wp_redirect(home_url('/faq'));
    exit;
}
?>