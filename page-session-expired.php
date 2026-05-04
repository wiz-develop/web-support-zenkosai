<?php
/*
 * Template Name: セッションタイムアウト
 */
  session_start();
  unset($_SESSION['logout_info']);
?>
<?php
  get_header();
?>
<style>
header,.siteFooter,.wpfront-scroll-top-container,.raino-faq {
  display: none;
}
.my_submit_btn {
    background-color: #bdaf41;
    color: #fff;
}
.my_submit_btn:hover {
    opacity: .7;
    color: #fff;
}
</style>
<div id="page-session-expired" class="session-expired page-wrapper <?php echo $display_type; ?>">
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="content-item text-center">
                <p class="mb-0">ログインの有効期限が切れました。​<br>再度ログインしてください。​</p>
                <a href="<?php echo home_url() ; ?>/login/">
                  <div class="my_submit_btn btn border shadow-sm px-5 mt-3 mb-4">ログイン画面へ</div>
                </a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
