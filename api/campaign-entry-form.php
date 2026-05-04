<?php
/**
 * キャンペーン応募フォーム
 *
 */
// $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] )[0];
// require_once( $parse_uri . 'wp-load.php' );
// global $wpdb;

if($_POST) {
  echo "HTMLからPOST送信を受け取りました";
} else {
  echo "HTMLからのPOST送信受信に失敗しました";
}
