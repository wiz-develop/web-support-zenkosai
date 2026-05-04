<?php
/*
 * Template Name: 利用体験談 詳細
 */
get_header();

$posts = search_experience(0);
$post = $posts->posts;
$post = $post[0];

$service_id = get_post_meta($post['id'], 'service');
$class = '';

// ライフサポートサービス
$service_id = $service_id[0];
$se_t = get_term($service_id, 'csr_cat');

if ($se_t) {
    $class = 'post-detail__csr';
    $date_use = '参加日';
    $link_page = '社会貢献活動';

    // アイコン
    $service_icon_data = get_field('new_csr_cat_img', $se_t);
    if (!$service_icon_data) {
        $service_icon_data = get_field('csr_cat_icon', $se_t);
    }
    $service_icon = $service_icon_data['url'];

    $se_t = get_term($service_id, 'csr_cat');
    if ($se_t->parent == 0 ) {
        $service_parent_title = '社会貢献活動';
    } else {
        $se_t_parent = get_term($se_t->parent, 'csr_cat');
        $service_parent_title = $se_t_parent->name;
    }
    $service_title = $se_t->name; // サービス名
    $service_url = '/social-contributions/category/?csr_cat='.$se_t->slug; // URL
} else {
    $service_icon = CFS()->get('service_icon', $service_id);
    if (!$service_icon) {
        $service_icon = CFS()->get('icon', $service_id);
        if (!$service_icon) {
            $service_icon = '/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_llservice.png';
        }
    }
    $class = 'post-detail__lifesupport';
    $date_use = 'サービスご利用日';
    $link_page = 'サービス';
    $service_post = get_post($service_id);
    $se_t = get_the_terms($service_id, 'lifesupport_cat');
    $service_parent_title = $se_t[0]->name; //カテゴリー名
    $service_title = $service_post->post_title; // サービス名
    $service_url = $service_post->guid; // URL
}
?>

<div id="page-experience" class="page-experience single-experience page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                    <div class="container">
                        <div class="row">
                            <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                                <li id="panHome" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/">
                                        <span itemprop="name">
                                            <i class="fa fa-home"></i> HOME
                                        </span>
                                    </a>
                                </li>
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <a itemprop="item" href="/service-experience/">
                                        <span itemprop="name">利用体験談</span>
                                    </a>
                                </li>
                                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                    <span itemprop="name">投稿いただいた方の体験談</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap post-detail <?php echo $class; ?>"><!-- 投稿一覧 -->
                <div class="page-content-div article-title">
                    <h1 class="pb-2"><font color="#EABC64">体</font><font color="#52C3F1">験</font><font color="#A9CF52">談</font></h1>
                </div>

                <div class="page-content-div report-detail rounded05 px-3 pt-3 pb-2">
                    <div class="d-flex align-items-center">
                        <div class="service-icon">
                            <img src="<?php echo $service_icon; ?>" alt="<?php echo $service; ?>">
                        </div>
                        <div class="service-txt pl-0 ml-3">
                            <p class="mb-0 service-name"><?php echo $service_title; ?></p>
                        </div>
                    </div>
                    <div class="report-txt my-3">
                        <p><?php echo $post['experience']; ?></p>
                    </div>
                    <div class="report-image">
                        <?php 
                            for ($i = 1; $i <= 3; $i++) :
                                $image_num = 'image'.$i;
                                $img = $post[$image_num];
                                if ($img) :
                        ?>
                            <div class="photo_space_images cursor-pointer not-click modal_trigger">
                                <img class="" src="<?php echo $img['url']; ?>">
                                <div class="glass_zoom">
                                    <i class="fas fa-search p-1"></i>
                                </div>
                            </div>
                            <div class="modal_box">
                                <div class="modal_bg"></div>
                                <div class="modal_inner">
                                    <img src="<?php echo $img['url']; ?>" alt="<?php echo $service_title; ?>の体験写真<?php echo $i; ?>">
                                    <div class="modal_close">
                                        <div class="rounded-pill">
                                            閉じる<span class="pl-3">×</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; endfor; ?>
                    </div>
                    <div class="contributor d-flex justify-content-between align-items-center mb-0">
                        <div class="d-flex align-items-center">
                            <div class="contributor__icon pr-2">
                                <?php
                                    $image_url = "/cms/wp-content/themes/zenkosai/assets/images/serviceexperience";
                                    if ($post['icon_image'] =="男性") {
                                        $image_url .= '/img_man.png';
                                    } elseif ($post['icon_image'] =="女性") {
                                        $image_url .= '/img_lady.png';
                                    } elseif ($post['icon_image'] =="ライノくん") {
                                        $image_url .= '/img_animal.png';
                                    }
                                ?>
                                <img class="rounded-circle bg-white border mx-auto" src="<?php echo $image_url; ?>">
                            </div>

                            <?php if ($post['age'] !="" && $post['prefecture'] != "") { ?>
                                <p class="mb-0 bio-txt"><?php echo $post['age']; ?>/<?php echo $post['prefecture']; ?>在住</p>
                            <?php } elseif ($post['age'] !="" && $post['prefecture'] == "") { ?>
                                <p class="mb-0 bio-txt"><?php echo $post['age']; ?></p>
                            <?php } elseif ($post['age'] =="" && $post['prefecture'] != "") { ?>
                                <p class="mb-0 bio-txt"><?php echo $post['prefecture']; ?>在住</p>
                            <?php } else { ?>
                                <p class="mb-0 bio-txt"></p>
                            <?php } ?>
                        </div>
                        <?php
                            $seid = $post['id'];
                            $satisfaction = get_field('member_benefits', $seid);

                            $rating_map = [
                                '満足'     => 4,
                                'やや満足' => 3,
                                'やや不満' => 2,
                                '不満'     => 1,
                            ];

                            if (!empty($satisfaction) && isset($rating_map[$satisfaction])) :
                                $max_stars = 4;
                                $filled_stars = $rating_map[$satisfaction];

                                echo '<p class="mb-0 satisfaction-txt text-right">満足度：';
                                for ($i = 1; $i <= $max_stars; $i++) {
                                    if ($i <= $filled_stars) {
                                        echo '<i class="fa-solid fa-star"></i>';
                                    } else {
                                        echo '<i class="fa-regular fa-star"></i>';
                                    }
                                }
                                echo '</p>';
                            else :
                                echo '<p class="mb-0 satisfaction-txt text-right">満足度：-</p>';
                            endif;
                        ?>
                    </div>
                </div>
                <div class="report-footer d-flex justify-content-end align-items-center py-1 px-2">
                    <div class="page-content-div">
                        <p class="post_date text-right mb-0">公開日：<span><?php echo $post['post_date']; ?></span></p>
                    </div>
                </div>

                <div class="page-content-div post-link">
                    <a href="/service-experience/">
                        <div class="post-button report-list">
                            <button class="index-btn px-4">
                                一覧へ
                            </button>
                        </div>
                    </a>
                    <a href="/service-experience-list/form/">
                        <div class="post-button">
                            <button class="index-btn px-4">
                                <i class="far fa-paper-plane pr-2"></i>体験談を投稿する
                            </button>
                        </div>
                    </a>
                </div>
                <div class="page-content-div mb-5">
                    <div class="service-link d-block mx-auto">
                        <a href="<?php echo $service_url; ?>" class="d-inline-block text-center py-2 py-md-3 pl-4">
                            <?php echo $service_title; ?>の<br class="d-sm-none"><?php echo $link_page; ?>についてはこちら
                        </a>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </div>
</div>

<script>

jQuery(function($){
	// 一覧に戻るボタン押下時の処理
	$(document).on('click', '.back-btn', function(){
		history.back();
	});
});
</script>

<?php get_footer(); ?>