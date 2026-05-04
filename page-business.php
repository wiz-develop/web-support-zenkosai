<?php
/*
 * Template Name: ビジネス
 */
session_start();
// SSOログイン処理
if ( ! empty($_POST['prime_app_flg']) ) {
    if ( empty($_POST['member_id']) || empty($_POST['password']) ) {
        wp_redirect(home_url('/'));
        exit;
    }
    $member_info = make_session_member_info($_POST, $_POST['password']);
    set_session_member_info($member_info, $posts_unread);
}
// P会員以外をホームへ遷移
if($_SESSION['member_info']['member_type'] !== 'p_member' ){
    wp_redirect(home_url('/'));
    exit;
}
require_once(get_stylesheet_directory().'/api/judge_login.php');
get_header();?>

<?php
// $today_date = new DateTime('now');
// $new_style_start = new DateTime('2023-06-29 14:00:00');
// $style_type = false;
// if ($new_style_start <= $today_date) {
//     $style_type = true;
// }

// if ($style_type == true || $_GET['disp_key'] == '20230629') :
?>
    <div id="page-new-business" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-business-new'); ?>
    </div>
<?php //else : ?>
    <!-- <div id="page-new-business" class="page-wrapper <?php // echo $display_type; ?> <?php // echo $login; ?>">
        <?php // get_template_part('templates/content-business-old'); ?>
    </div> -->
<?php
    //endif;
    get_footer();
?>