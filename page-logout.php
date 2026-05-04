<?php
/**
 * Template Name: ログアウト
 */

session_start();
session_unset();
wp_redirect(home_url('/'));
?>
