<?php
    $txt_length = 40;
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

    // 体験談を取得
    // $experience_args = array(
    //     'posts_per_page' => -1,
    //     'post_type'      => 'service-experience',
    //     'post_status'    => 'publish',
    //     'meta_key' => 'service',
    //     'meta_value' => $post_id,
    //     'meta_compare' =>  '=',
    // );
    // $experience_query = get_posts($experience_args);
?>
<article class="cat-list__content__body__item bg-white">
    <div class="cat-list__content__body__item__name">
        <?php if (is_user_loggedin()) :?>
            <?php
                $status_icon = CFS()->get('status_icon', get_the_ID());
                if ($status_icon) :
            ?>
            <div class="new_wrap w-100">
                <?php
                    echo '<div class="new">'.$status_icon.'</div>';
                ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        <div class="cat-list__content__body__item__name__icon">
            <img src="<?php echo $service_icon; ?>" alt="<?php echo strip_tags( get_the_title()); ?>">
        </div>
        <h3>
            <?php echo strip_tags( get_the_title()); ?>
        </h3>
    </div>

    <div class="cat-list__content__body__item__link row m-0">
        <?php $detail_btn_text = CFS()->get('detail_btn_text'); ?>
        <?php if (is_user_loggedin()) :?>
            <div class="link-content col-6 p-1">
                <div class="service-link">
                    <a href="/lifesupport/<?php echo $post->post_name; ?>" class="gtm-click-link detail-button" data-gtm-click="<?php echo strip_tags(get_the_title()).' サービス詳細'; ?>">
                        <div class="btn-item rounded">
                            <button class="py-2 px-2 w-100">サービス詳細</button>
                        </div>
                    </a>
                    <?php if (is_user_loggedin() && $detail_btn_text) :?>
                    <div class="comment-item mt-1">
                        <?php echo $detail_btn_text; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php
            if (is_user_loggedin()) :
                $free_btn_name = CFS()->get('free_btn_name');
                $free_btn_text = CFS()->get('free_btn_text');
                $free_btn_url = CFS()->get('free_btn_url');
                $free_btn_blank = CFS()->get('free_btn_blank');
                $sso = array_keys(CFS()->get('free_btn_sso'));
                $sso = $sso[0];
        ?>
            <?php if ($free_btn_name) : ?>
            <div class="link-content col-6 p-1">
                <div class="link-item use-link <?php if ($sso !== 'no_select') echo 'js_form_btn'; ?>">
                    <?php
                        $sso_form_data = ''; // SSO連携用ソース
                        $deficient = ''; // メール不備確認
                        if ($sso == 'life_seminar') {
                            $deficient = 'deficient_popup';
                            $sso_form_data = 'data-formid="submitMypage" data-formabout="life_seminar"';
                        } else if ($sso == 'suit') {
                            $deficient = 'seminar_form';
                            $sso_form_data = 'data-formid="submitMypage" data-formabout="order_made_suit"';
                        } else if ($sso !== 'no_select') {
                            $sso_form_data = 'data-formid="'.$sso.'"';
                        }
                    ?>
                    <a class="<?php echo $deficient; ?> gtm-click-link detail-button" <?php echo $sso_form_data; if ($free_btn_url && $sso == 'no_select') echo 'href="'.$free_btn_url.'"'; if ($free_btn_blank || $sso !== 'no_select') echo 'target="_blank"'; echo ' data-gtm-click="'.strip_tags(get_the_title().' '.$free_btn_name).'"'; ?>>
                        <div class="btn-item rounded">
                            <button class="py-2 px-2 w-100"><?php echo $free_btn_name; ?></button>
                        </div>
                    </a>
                    <?php if ($free_btn_text) :?>
                    <div class="comment-item mt-1">
                        <?php echo $free_btn_text; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</article>