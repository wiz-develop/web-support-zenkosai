<?php
/*
 * FAQキーワード一覧
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
} else {
    $url = home_url('/faq/');
    header('Location: ' . $url);
}
