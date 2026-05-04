<?php
$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] )[0];
require_once( $parse_uri . 'wp-load.php' );

session_start();
$member_id = $_SESSION['member_info']['member_id'];

global $wpdb;
$member_data = $wpdb->get_results("SELECT member_id, area_name, gate_name, seat_name FROM ".$wpdb->prefix."ticket_members WHERE member_id = '".$member_id."'");

if (!empty($member_data[0])) {
    $member_data = json_encode($member_data);
    echo $member_data;
} else {
    echo false;
}

