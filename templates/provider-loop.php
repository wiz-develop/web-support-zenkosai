<?php
    $provider_post = $post;
    $provider_id = get_the_ID();
    $service_id = CFS()->get('provider_service', $provider_id);
    $service_id_count = count($service_id);
    if ($service_id_count == 1) {
        $service = get_post($service_id[0]);
        $service_title = strip_tags($service->post_title);
        $service_icon = CFS()->get('service_icon', $service->ID);
        if (!$service_icon) {
            $service_icon = CFS()->get('icon', $service->ID);
        }
    } else {
        $service_icon = '/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_llservice.png';
        $service_title = '複数サービスのお知らせ（全'.$service_id_count.'件）';
    }

    // 投稿日
    $post_date = new Datetime($provider_post->post_date);
    $new_post_date = $post_date->modify('+7 day');

    // NEW表示判定
    $today = new DateTime();
    $new = false;
    if ($today <= $new_post_date) {
        $new = true;
    }
?>
<div class="lifesupport-info__list__item">
    <a class="info-news mx-auto my-1" href="<?php the_permalink(); ?>">
        <div class="row info-news-bar align-items-center">
            <div class="new-and-date">
                <?php
                if ($new) {
                    echo '<div class="new text-danger d-inline-block">NEW</div>';
                }
                ?>
                <div class="news-date d-inline-block"><?php echo get_the_date('Y.m.d'); ?><span>更新</span></div>
            </div>
            <div class="news-cat d-flex flex-row align-items-center ml-0 ml-sm-3">
                <div class="cat-img-div">
                    <img src="<?php echo $service_icon; ?>" alt="<?php echo $service_title; ?>">
                </div>
                <p class="mb-0 news-cat-txt bold text-left"><?php echo $service_title; ?></p>
            </div>
        </div>
        <p class="news-title mb-0"><?php the_title(); ?></p>
    </a>
</div>