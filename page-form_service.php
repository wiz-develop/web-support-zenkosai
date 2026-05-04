<?php
/*
 * Template Name: サービス利用申請フォーム
 */
get_header();
console_log($_SESSION['member_info']);

$page_slug = $post->post_name;
$m_id   = $_SESSION['member_info']['member_id'];

if (!is_user_loggedin()) {
    wp_safe_redirect(home_url('/'));
    exit;
}

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
<div id="page-<?php echo $page_slug; ?>" class="page-<?php echo $page_slug; ?> page-form_service page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
    <div class="page-content-wrapper pt-5">
        <div class="container">
            <div class="content">
                <div class="content__body">
                    <div class="service-form-wrap">
                        <div class="service-form-wrap__content">
                            <?php the_content() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
<?php if ($page_slug == 'funeral-form' && $m_type == 'k_member') : ?>
    <script src="https://zipaddr.github.io/bankauto0.js" charset="UTF-8"></script>
<?php endif; ?>
<script>
jQuery(function($){
    // 会員IDを入力する
    var m_id = <?php echo (int)$m_id; ?>;
    $('.js-member_id').val(m_id);

    // 会員氏名を入力する
    var m_name = <?php echo "'".$m_name." ".$position_name."'"; ?>;
    $('.js-member_name').val(m_name);

    // 会員種別を入力する
    const m_type_array = [
        {type: "p_member", type_name: "P会員"},
        {type: "k_member", type_name: "K会員"},
        {type: "ps_member", type_name: "PS会員"},
        {type: "ks_member", type_name: "KS会員"},
    ];
    var m_type = <?php echo "'".$m_type."'"; ?>;
    var item = m_type_array.find(item => item.type === m_type);
    var m_type_name = item.type_name;

    if(m_type != "k_member") {
        $('#kouza_kmember').remove();
    }
    if (!$('.js-member_type').val()) {
        $('.js-member_type').val(m_type_name);
    }

    // 郵便番号を入力する
    var zip_code = <?php echo "'".$zip_code."'"; ?>;
    if (!$('.js-zip_code').val()) {
         $('.js-zip_code').val(zip_code);
    }

    // 住所を入力する
    var address = <?php echo "'".$address."'"; ?>;
    if (!$('.js-address').val()) {
        $('.js-address').val(address);
    }

    // 電話番号を入力する
    var tel = <?php echo "'".$tel."'"; ?>;

    <?php if ($m_type == 'p_member' || $m_type == 'k_member') : ?>
    $('.js-funeral_tel').addClass('js-tel_number readonly border-0');
    $('.js-funeral_tel').attr('readonly',true);
    <?php else : ?>
    $('.js-funeral_tel_title').append('<span class="needlabel py-1 px-2 ml-3">必須</span>');
    <?php endif; ?>

    if (!$('.js-tel_number').val()) {
        $('.js-tel_number').val(tel);
    }

    // メールアドレスを入力する
    var mail = <?php echo "'".$mail."'"; ?>;
    if (!$('.js-mail').val()) {
         $('.js-mail').val(mail);
    }

    // サービス名を入力する
    var service_form = <?php echo "'".$form."'"; ?>;
    if (service_form && !$('.js-contract_plan').val()) {
        $('.js-contract_plan').val(service_form);
    }

    // サービス利用開始日
    var start_date = <?php echo "'".$startdate_display."'"; ?>;
    $('.js-start_date').val(start_date);

    // 申請者名
    var member_list = JSON.parse('<?php echo $member_list; ?>');
    if (member_list === null || !member_list[0]) {
        $('.js-form-service_member_name').addClass('d-none');
        $('.js-service_member_name').val('no_select');
    }

    var member_list = JSON.parse('<?php echo $member_list; ?>');
    if ($('.js-child_birth').length) {
        $('.js-child_birth option:first-child').text('');
    }

    $('.marry_account_information').on('click', function() {
        if ($(this).prop('checked')){
        // 一旦全てをクリアして再チェックする
        $('.marry_account_information').prop('checked', false);
        $(this).prop('checked', true);
        }
    });

});
</script>
