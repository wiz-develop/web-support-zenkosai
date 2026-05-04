<?php
/*
 * ライフサポートサービス カテゴリー別ページ
 */
$term_object = get_queried_object();
$afc = 'lifesupport_cat_'.$term_object->term_id;
$s_display = get_field('s_display', $afc);
$s_logo = get_field('s_logo', $afc);
if ($s_logo['url']) {
    $s_logo = $s_logo['url'];
} else {
    $s_logo = get_stylesheet_directory_uri().'/assets/images/icons/menu/menu_icon_llservice.png';
}

if ($s_display || is_user_loggedin()) {
    $url = home_url('/lifesupport/');
    header('Location: ' . $url);
}

get_header();
?>
<div id="single-lifesupport" class="page-wrapper pc llservice-cat_about" style="margin-top: 80px;">
<div class="page-header">
    <div class="container">
        <?php
        /*-------------------------------------------*/
        /* BreadCrumb
        /*-------------------------------------------*/
        do_action('lightning_breadcrumb_before');
        $old_file_name[] = 'module_panList.php';
        if (locate_template($old_file_name, false, false)) {
            locate_template($old_file_name, true, false);
        } else {
            get_template_part('template-parts/breadcrumb');
        }
        do_action('lightning_breadcrumb_after');
        ?>
    </div>

    <div class="page-top">
        <div class="page-top__title text-left">
            <div class="page-top__title_wrap">
                <div class="container">
                    <div class="page-top__title__icon">
                        <div class="d-flex justify-content-start justify-md-content-center align-items-center">
                            <div class="icon-image">
                                <img src="<?php echo $s_logo; ?>">
                            </div>
                            <h1 class="mb-0 font-weight-bold"><?php echo single_term_title('', true); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- page-header -->

<?php
    $term_description = term_description();
    if ($term_description) :
?>
<div class="page-content-wrapper">
    <div class="container lifesupport-container">
        <div class="flame-body mx-auto">
            <div class="page-content-innerwrap">
                <div class="service-overview">
                    <div class="service-overview__detail mt-3 text-left">
                        <?php echo $term_description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
    $args = array(
        'post_type' => 'lifesupport',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_type'      => 'lifesupport',
        'orderby'        => 'meta_value_num',
        'meta_key'       => 'new_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy'=>'lifesupport_cat',
                'terms' => $term_object->slug,
                'field'=>'slug',
            ),
        ),
    );
    $posts = get_posts($args);
?>
<div class="page-content-wrapper columns lifesupport-category">
    <div class="container">
        <div class="flame-body category-list">
            <div class="page-content-innerwrap">
                <div class="page-content-div mb-0">
                    <?php if ($posts): ?>
                    <div class="page-content-innerdiv llservice-list cat row">
                        <?php
                            foreach ($posts as $post): setup_postdata($post);

                            // 霊園リストの場合非表示
                            if($post->post_name == 'list'){
                                continue;
                            }

                            // ログイン前非表示の場合
                            $restrict = $cfs->get('restriction_information', get_the_ID());
                            if (!$loggedin && $restrict) { continue; }

                            $post_id = get_the_ID();

                            // 新アイコンが設定されていたら表示
                            $service_icon = CFS()->get('service_icon', $post_id);
                            if (!$service_icon) {
                                $icon = CFS()->get('icon', $post_id);
                                if ($icon) {
                                    $service_icon = $icon;
                                } else {
                                    $service_icon = get_stylesheet_directory_uri().'/assets/images/icons/menu/menu_icon_llservice.png';
                                }
                            }
                        ?>
                        <div class="llservice-list__item col-12 col-md-6 col-lg-4 bg-white position-relative pb-0">
                            <div class="llservice-list__item__about">
                                <div class="llservice-list__item__about__header d-flex align-items-center">
                                    <img src="<?php echo $service_icon; ?>" alt="<?php echo strip_tags(get_the_title()); ?>"><span><?php echo strip_tags(get_the_title()); ?></span>
                                </div>
                                <div class="llservice-list__item__img">
                                    <?php
                                        $service_overview_img = CFS()->get('service_overview_img_new');
                                        if ($service_overview_img) :
                                    ?>
                                    <img class="w-100 rounded" src="<?php echo $service_overview_img; ?>" alt="<?php echo strip_tags(get_the_title()); ?>">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="llservice-list__item__about__body text-left">
                                <?php
                                    $service_overview_detail = CFS()->get('service_overview_detail_new');
                                    if ($service_overview_detail) {
                                        echo $service_overview_detail;
                                    }
                                ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; wp_reset_postdata(); ?>
                    <div class="list-back_btn rounded text-center">
                        <a href="<?php echo home_url() ; ?>/lifesupport/">
                            <span>カテゴリーページへ戻る</span><i class="fas fa-solid fa-chevron-right pl-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="llservice-cat_footer text-left">
<?php get_footer(); ?>
</div>