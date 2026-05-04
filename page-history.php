<?php
/*
 * Template Name: 全厚済のあゆみ
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
    <div id="page-new-company" class="page-company page-history page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-history-new'); ?>
    </div>
<?php else : ?>
    <div id="page-company" class="page-company page-history page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
        <?php get_template_part('templates/content-history-old'); ?>
    </div>
<?php
    endif;
    get_footer();
?>