<?php
/*
 * Template Name: National Conventionチケットお申込み
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
global $post;
get_header();
?>

<?php
    $m_id   = $_SESSION['member_info']['member_id'];
    $m_name = $_SESSION['member_info']['member_name'];
    $mail = $_SESSION['member_info']['mail'];
?>
<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <img src="<?php echo $cfs->get('header_image'); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
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
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="flame-body mx-auto">
                <div class="page-content-innerwrap">
                    <?php
                        if ($post->post_name == 'convention-ticket') {
                            echo '<div id="form_message" class="page-content-div"></div>';
                        } elseif ($post->post_name == 'confirmation') {
                            echo 'ご入力内容をご確認ください。​';
                        }
                    ?>
                    <div class="my-5">
                        <div class="service-experience-form mt-5">
                            <?php if (have_posts()): ?>
                                <?php while (have_posts()) : the_post(); ?>
                                    <?php the_content(); ?>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
<style>
.web-form .lasting-btn {
    font-size:0.8em;
}
.select-service i.service-hide {
    color: #35B574;
}
</style>
<?php
        $application_types = $cfs->get('application_types');
        $types = json_encode($application_types);
    ?>
<script>
jQuery(function($){
    // 会員IDを入力する
    var m_id = <?php echo (int)$m_id; ?>;
    $('input[name="member_id"]').val(m_id);

    // 会員氏名を入力する
    var m_name = <?php echo "'".$m_name."'"; ?>;
    $('input[name="member_name"]').val(m_name);

    // 会員ID・会員氏名・応募種別を読み取りのみに設定
    $('.readonly').attr('readonly',true);

    // メールアドレスを入力する
    var mail = <?php echo "'".$mail."'"; ?>;
    if (!$('.js-mail').val()) {
         $('.js-mail').val(mail);
    }

    // チケットを「希望しない」とき車椅子を選択できないようにする
    console.log($('input[name="convention-ticket"]').val());
    if ($('input[name="convention-ticket"]').val() == '不参加') {
        document.querySelector('input[name="wheelchair[]"]').disabled = true;
    }
    $('input[name="convention-ticket"]').change(function() {
        if ($(this).val() == '不参加') {
            document.querySelector('input[name="wheelchair[]"]').disabled = true;
        }
        if ($(this).val() == '参加') {
            document.querySelector('input[name="wheelchair[]"]').disabled = false;
        }
    });
    
    var params = (new URL(document.location)).searchParams,
        application_types = <?php echo $types; ?>,
        application_type_code = params.get('application_type'),
        application_type_name = '',
        today = new Date();

    Object.keys(application_types).forEach( function (e) {
        if (application_types[e]['application_type_query'] == application_type_code) {
            var start = application_types[e]['convention_start']+' '+application_types[e]['convention_start_time']+':00',
                end = application_types[e]['convention_end']+' '+application_types[e]['convention_end_time']+':00';

            var start = new Date(start),
                end = new Date(end),
                message = 'お申込みの開始までお待ちください。';

            if (today < start) {
                $('.service-experience-form').addClass('d-none');
            } else if (end < today) {
                $('.service-experience-form').addClass('d-none');
                message = application_types[e]['message_after'];
            } else {
                $('#message_before, #message_after').addClass('d-none');
                application_type_name = application_types[e]['application_type_name'];
                message = application_types[e]['message_period'];
                if (application_types[e]['ticket_attention']) {
                    $('#convention-ticket-price').html('<p>'+application_types[e]['ticket_attention']+'</p>');
                }
            }
            $('#form_message').html(message);
        }
    });
    $('textarea[name="application_type"]').val(application_type_name);
});
</script>

<?php
// 投稿完了画面
if ($post->post_name == 'confirmation') :
?>
    <style>
    .confirm-d-none {
        display: none!important;
    }
    </style>
<?php endif; ?>