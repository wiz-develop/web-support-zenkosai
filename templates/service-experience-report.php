<?php
    $se = $post;
    if ($se->ID) {
        // 社会貢献活動ページ
        $seid = $se->ID;
        $release_date = $se->post_date; //公開日
        $release_day = date('Y年n月j日', strtotime($release_date));
    } else {
        // 体験談一覧
        $seid = $se['id'];
        $release_day = $se['post_date']; //公開日
    }

    // 日付フォーマット指定
    $se_date = get_field('use_date', $seid); //値の取得

    // 画像生成
    $image_url = get_stylesheet_directory_uri()."/assets/images/serviceexperience";
    if ( get_field('icon_image', $seid) =="男性") {
        $image_url .= '/img_man.png';
    } elseif ( get_field('icon_image', $seid)  =="女性") {
        $image_url .= '/img_lady.png';
    } elseif ( get_field('icon_image', $seid)  =="ライノくん") {
        $image_url .= '/img_animal.png';
    }

    // サービス名取得
    $service = get_post_meta($seid, 'service');
    $service_id = $service[0];
    $se_t = get_the_terms($service_id, 'lifesupport_cat');

    if ($se_t[0]) {
        // ライフサポートサービス
        $class = 'report__lifesupport';
        $date_use = 'サービスご利用日';

        // タイトル・カテゴリー
        $service_parent_title = $se_t[0]->name;
        $service_data = get_post($service_id);
        $service_title = $service_data->post_title;

        // カテゴリーアイコン
        $service_icon = CFS()->get('service_icon', $service_id); //新カスタムフィールド
        if (!$service_icon) {
            $service_icon = CFS()->get('icon', $service_id); //旧カスタムフィールド
        }

        if (!$service_icon) {
            $service_icon = get_stylesheet_directory_uri().'/assets/images/icons/menu/menu_icon_llservice.png';
        }

    } else {
        // 社会貢献活動
        $class = 'report__csr';
        $date_use = '参加日';

        // タイトル・カテゴリー
        $se_t = get_term($service_id, 'csr_cat');
        if ($se_t->parent == 0 ) {
            $service_parent_title = '社会貢献活動';
        } else {
            $se_t_parent = get_term($se_t->parent, 'csr_cat');
            $service_parent_title = $se_t_parent->name;
        }
        $service_title = $se_t->name;

        // カテゴリーアイコン
        $service_icon_data = get_field('new_csr_cat_img', $se_t); //新カスタムフィールド
        if (!$service_icon_data) {
            $service_icon_data = get_field('csr_cat_icon', $se_t); //旧カスタムフィールド
        }
        $service_icon = $service_icon_data['url'];
    }

    $remove_array = ["\r\n", "\r", "\n", " ", "　"];
    $service_title = str_replace($remove_array, '', $service_title);

    // 感想
    $experience = get_field('experience', $seid);

    // 取り消し線・改行・太字・文字色の変更のみ反映
    $experience_excerpt = strip_tags($experience, '<strong><br><p><span><del>');
?>
    <div class="report">
        <div class="rounded05 report-content bg-white <?php echo $class; ?>">
            <div class="px-4 report-content-txt">
                <a href="/service-experience-list/detail/?post_id=<?php echo $seid; ?>" >
                    <p class="mb-0 pt-2 text-left border-bottom date-txt text-secondary">
                        <?php
                            if ($se_date == '-1') {
                                echo '&nbsp;'; 
                            } else {
                                echo $date_use.'：'.substr($se_date, 0,4).'年'.mb_substr($se_date, -2).'月';
                            }
                        ?>
                    </p>
                    <div class="d-flex align-items-center mt-2">
                        <div class="report-imgbox">
                            <img class="bg-white mx-auto" src="<?php echo $service_icon; ?>" title="<?php echo $service_title; ?>"/>
                        </div>
                        <div class="report-txtbox text-left pl-0 ml-3">
                            <p class="mb-0 cat-txt"><?php echo $service_parent_title; ?></p>
                            <p class="mb-0 service-txt"><?php echo $service_title; ?></p>
                            <?php
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

                                    echo '<p class="mb-0 satisfaction-txt text-secondary">満足度：';
                                    for ($i = 1; $i <= $max_stars; $i++) {
                                        if ($i <= $filled_stars) {
                                            echo '<i class="fa-solid fa-star"></i>';
                                        } else {
                                            echo '<i class="fa-regular fa-star"></i>';
                                        }
                                    }
                                    echo '</p>';
                                else :
                                    echo '<p class="mb-0 satisfaction-txt text-secondary">満足度：-</p>';
                                endif;
                            ?>
                        </div>
                    </div>
                    <div class="my-2 thoughts-txt"><?php echo $experience_excerpt; ?></div>
                </a>
                <div class="report-image row">
                    <?php
                        for ($i = 1; $i <= 3; $i++) :
                            $image_num = 'image'.$i;
                            $img_id = get_post_meta($se->ID, $image_num);
                            if ($img_id) { //トップページ・社会貢献活動ページ
                                $img =  wp_get_attachment_url($img_id[0], 'full');
                            } else { //体験談一覧
                                $img_data = $se[$image_num];
                                $img = $img_data['url'];
                            }
                            if ($img) :
                    ?>
                        <div class="photo_space_images cursor-pointer not-click modal_trigger col-4">
                            <img class="" src="<?php echo $img; ?>">
                            <div class="glass_zoom">
                                <i class="fas fa-search p-1"></i>
                            </div>
                        </div>
                        <div class="modal_box">
                            <div class="modal_bg"></div>
                            <div class="modal_inner">
                                <img src="<?php echo $img; ?>" alt="<?php echo $service_title; ?>の体験写真<?php echo $i; ?>">
                                <div class="modal_close">
                                    <div class="rounded-pill">
                                        閉じる<span class="pl-3">×</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; endfor; ?>
                </div>
            </div>
            <a href="/service-experience-list/detail/?post_id=<?php echo $seid; ?>" >
                <div class="px-4 pt-1 pb-2 pb-lg-1 service-user">
                    <div class="d-flex align-items-center flex-wrap flex-lg-nowrap">
                        <div class="service-user__icon">
                            <img class="rounded-circle bg-white border mx-auto" src="<?php echo $image_url; ?>" title="サービス利用体験アイコン"/>
                        </div>
                        <p class="mb-0 ml-2 text-left text-secondary bio-txt"><?php echo get_field('age', $seid);?>　<?php echo get_field('prefecture', $seid);?>在住</p>
                        <p class="rounded-pill mb-sm-0 mb-1 ml-auto px-3 pt-1 text-white detail-txt">詳しく見る >></p>
                    </div>
                </div>
            </a>
        </div>
        <p class="mb-0 text-secondary text-right post-date-txt">公開日：<?php echo $release_day; ?></p>
    </div>