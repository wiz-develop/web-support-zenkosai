<?php
/*
 * Template Name: 資料一覧
 */
get_header();

// メンテナンス表示
$today_date = new DateTime('now');
$maintenance = '';
$disabled = '';
$maintenance_text = '';

$maintenance_start = new DateTime('2024-09-21 6:00:00');
$maintenance_end = new DateTime('2024-09-28 0:00:00');
if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
    $maintenance = 'now-maintenance-document';
    $disabled = 'disabled';
    $maintenance_text = '<span class="business-maintenance">メンテナンス中</span>';
}
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
            <div class="row">
                <div class="flame-side for-sp-nav col-12 col-lg-3 mb-4 mb-lg-0">
                    <div class="page-content-innerwrap row">
                        <?php
                            $fields = $cfs->get('document_list');
                            if($fields):
                        ?>
                            <?php foreach ($fields as $field):?>
                                <div class="link-btn">
                                    <a href="#<?php echo $field['list_link_id']; ?>">
                                        <button class="showall-btn">
                                            <p class="mb-0"><?php echo $field['list_name']; ?></p>
                                        </button>
                                    </a>
                                </div>
                            <?php endforeach;?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flame-body col-12 col-lg-9">
                    <?php
                        $fields = $cfs->get('document_list');
                        if($fields):
                        foreach ($fields as $field) :
                    ?>
                        <div id="<?php echo $field['list_link_id']; ?>" class="page-content-innerwrap">
                            <h2><?php echo $field['list_name']; ?></h2>
                                <div class="page-content-div">
                                    <?php
                                        $fields = $field['archive_list'];
                                        foreach ((array)$fields as $field):
                                            $update = $field['update'];
                                    ?>
                                    <div <?php if ($field['list_link_sub_id']) echo 'id="' , $field['list_link_sub_id'] , '"'; ?>>
                                        <h3><?php echo $update; ?></h3>
                                            <ul class="list-unstyled">
                                                <?php
                                                    $fields = $field['document'];
                                                    foreach ((array)$fields as $field):
                                                        $title = $field['title'];
                                                ?>
                                                    <li>
                                                        <div class="document-title">
                                                            <p class="mb-0"><?php echo $title; ?></p>
                                                        </div>
                                                        <div class="di-list">
                                                            <?php
                                                                $fields = $field['dl_list'];
                                                                foreach ((array)$fields as $field):
                                                                    $dl_about = $field['dl_about'];
                                                            ?>
                                                                <div  class="dl-detail">
                                                                    <?php
                                                                        $title_about = $update;
                                                                        if ($title) {
                                                                            $title_about .= ' '.$title;
                                                                        }
                                                                        if($dl_about):
                                                                            $title_about .= ' '.$dl_about;
                                                                    ?>
                                                                        <p class="m-0"><?php echo $dl_about; ?></p>
                                                                    <?php endif; ?>
                                                                        <div class="dl-link">
                                                                            <a href="<?php echo $field['dl_link']; ?>" class="gtm-click-download" data-gtm-click="<?php echo $title_about; ?>">
                                                                                <button>資料をダウンロード ↓</button>
                                                                            </a>
                                                                        </div>
                                                                </div>
                                                            <?php
                                                                endforeach;
                                                            ?>
                                                        </div>
                                                    </li>
                                                <?php
                                                    endforeach;
                                                ?>
                                            </ul>
                                    </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                        </div>
                    <?php
                        endforeach;
                        endif;
                    ?>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="btn showall-btn mt-3 mb-5 py-2 mypage_form d-block <?php echo $maintenance; ?>" data-formid="submitMypage" data-formabout="mypage" target="_blank" <?php echo $disabled; ?>>
            <p class="mb-0">マイページへ戻る</p>
        </a>
        <?php echo $maintenance_text; ?>
    </div>
</div>
<?php get_footer(); ?>