<?php
    $parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] )[0];
    require_once( $parse_uri . 'wp-load.php' );

    session_start();
    if(isset($_SESSION['member_info'])){
        echo $_SESSION['member_info']['member_type'];
    } else {
        echo 'loggedout';
    }
?>