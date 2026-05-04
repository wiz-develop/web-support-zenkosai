<?php
/*
 * Template Name: 会費のお支払いができなかった場合
 */
if($cfs->get('mypage_failed_file')){
    wp_redirect($cfs->get('mypage_failed_file'));
    exit;
}
wp_redirect(home_url('/'));
exit;
get_header(); ?>



<?php get_footer(); ?>