<?php
    require_once('/var/www/html/cms/wp-load.php');
    session_start();
    if($_SESSION['member_info']){
        echo 'loggedin';
    }else{
        echo 'loggedout';
    }
?>