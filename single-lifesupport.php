<?php
/*
 * Template Name: ライフサポートサービス詳細
 */
// TODO:カテゴリのカスタムフィールドに「ログイン前に表示させない」があった場合非表示
$terms = get_the_terms(get_the_ID(), 'lifesupport_cat');
$lt_id = $terms[0]->term_id;
$key = 'lifesupport_cat_'.$lt_id;
$is_restrict_cat = get_field('s_display', $terms);
if($is_restrict_cat){
    session_start();
    if(!$_SESSION['member_info']){
        wp_redirect(home_url('/lifesupport'));
        exit;
    }
}
if($cfs->get('restriction_information') || $cfs->get('new_restriction_information')){
    session_start();
    if(!$_SESSION['member_info']){
        wp_redirect(home_url('/lifesupport'));
        exit;
    }
}
get_header();

// ペット葬儀 霊園リスト
if (is_single('list')) : ?>
    <div id="single-lifesupport" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-lifesupport-old'); ?>
    </div>
<?php
else :
// ペット葬儀 霊園リスト以外のページ
?>
    <div id="single-lifesupport" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-lifesupport-new'); ?>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
<?php
    // メンテナンス表示
    $today_date = new DateTime('now');
    $maintenance_start = new DateTime('2023-10-17 08:00:00');
    $maintenance_end = new DateTime('2023-10-17 09:00:00');
    if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) :
?>
<style>
	.seminar_form[data-formabout="life_seminar"] {
		pointer-events: none;
	}
    .seminar_form[data-formabout="life_seminar"]:before {
        content: "\30E1\30F3\30C6\30CA\30F3\30B9\4E2D";
        font-size: .8rem;
        color: #fff;
        word-break: keep-all;
        position: absolute;
        z-index: 100;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .seminar_form[data-formabout="life_seminar"]:after {
        content: "";
        background-color: rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        border-radius: 0.5rem;
    }
</style>
<?php endif; ?>
