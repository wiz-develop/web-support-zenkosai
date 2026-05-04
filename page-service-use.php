<?php
/*
 * Template Name: サービス利用件数：決算報告書
 */
get_header(); ?>

<?php
$today_date = new DateTime('now');
$new_style_start = new DateTime('2022-07-01 10:00:00');
$style_type = false;
if ($new_style_start <= $today_date) {
    $style_type = true;
}

if ($style_type == true || $_GET['disp_key'] == '202207') :
?>
    <div id="page-new-company" class="page-company service-use page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-service-use-new'); ?>
    </div>
<?php else : ?>
    <div id="page-company" class="page-company service-use page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-service-use-old'); ?>
    </div>
<?php
    endif;
    get_footer();
?>