<?php
/*
 * Template Name: 資料直接ダウンロード
 */

if ($cfs->get('mypage_file_loops')) {
    foreach ($cfs->get('mypage_file_loops') as $l) {
        if ($l['file_name'] == $_GET['file']) {
            wp_redirect($l['file_for_download']);
            exit;
        }
    }
}
wp_redirect(home_url('/'));
exit;
get_header(); ?>
