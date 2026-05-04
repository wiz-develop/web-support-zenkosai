<?php
/*
 * Template Name: クリーンキャンペーン参加報告
 */
get_header();
console_log($_SESSION['member_info']);

$page_slug = $post->post_name;
$m_id   = $_SESSION['member_info']['member_id'];
$m_name = $_SESSION['member_info']['member_name'];
$position_name = $_SESSION['member_info']['position_name'];
$m_type = $_SESSION['member_info']['member_type'];
$zip_code = $_SESSION['member_info']['zip_code'];
$address = $_SESSION['member_info']['address'];
$tel = $_SESSION['member_info']['tel'];
$mail = $_SESSION['member_info']['mail'];
$startdate = $_SESSION['member_info']['startdate'];
if (!$startdate && $_SESSION['member_info']['member_id'] == '000000000000') {
    $startdate = '2022/07/01';
}
$startdate_datetime = new DateTime($startdate);
$startdate_display = $startdate_datetime->format('Y年n月j日');
$member_list = json_encode($_SESSION['member_info']['member_list']);

$form = $_GET['form'];

?>
<div id="page-clean-form" class="page-contact page-questionnaire aul-questionnaire page-form_service clean-form page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <?php
                /*-------------------------------------------*/
                /* BreadCrumb
                /*-------------------------------------------*/
                do_action( 'lightning_breadcrumb_before' );
                $old_file_name[] = 'module_panList.php';
                if ( locate_template( $old_file_name, false, false ) ) {
                    locate_template( $old_file_name, true, false );
                } else {
                    get_template_part( 'template-parts/breadcrumb' );
                }
                do_action( 'lightning_breadcrumb_after' );
            ?>
        </div>
        <div class="page-top">
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image'); ?>">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper pt-5 columns">
        <div class="container">
            <div class="row">
                <div class="flame-body">
                    <div class="page-content-innerwrap">
                        <div id="mail-contact" class="page-content-div container web-form mt-5">
                            <div class="service-form-wrap pt-5">
                                <div class="service-form-wrap__content">
                                    <?php the_content() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
<script>
jQuery(function($){
    // 会員IDを入力する
    var m_id = <?php echo (int)$m_id; ?>;
    $('.js-member_id').val(m_id);

    // 会員氏名を入力する
    var m_name = <?php echo "'".$m_name." ".$position_name."'"; ?>;
    $('.js-member_name').val(m_name);

    // チェックボックスの挙動制御
    $('.marry_account_information').on('click', function() {
        if ($(this).prop('checked')){
            $('.marry_account_information').prop('checked', false);
            $(this).prop('checked', true);
        }
    });
});
</script>
