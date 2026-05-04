<?php
    $p_id = get_the_ID();
    $term =  get_the_terms( $p_id, 'lifesupport_cat' );
    $t = $term[0];
    $t_name = $t->name;
    $t_slug = $t->slug;

    if ($_SESSION['member_info']) {
        $login = true;
    } else {
        $login = false;
    }
?>

<div class="page-header">
    <div class="container">
        <div class="section breadSection">
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                        <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="<?php echo home_url();?>">
                                <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                            </a>
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="/lifesupport/">
                                <span itemprop="name">ライフサポートサービス</span>
                            </a>
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="/lifesupport/#<?php echo $t_slug; ?>">
                                <span itemprop="name"><?php echo $t_name; ?></span>
                            </a>
                        </li>
                        <li>
                            <span><?php the_title(); ?></span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- 資料ファイルのみの表示がある時（保険用） -->
    <?php
        $only_file_content = CFS()->get('only_file_content'); //新
        $llservice_only_file = CFS()->get('llservice_only_file'); //旧
        if ($only_file_content || $llservice_only_file) :
    ?>
        <?php if ($login) : ?>
            <div class="document-llservice container pt-5">
                <?php
                    if ($only_file_content) {
                        echo $only_file_content;
                    } else {
                        echo $llservice_only_file;
                    }
                ?>
                </div>
            </div>
        <?php else : ?>
            <div class="page-top__title text-left">
                <div class="page-top__title_wrap">
                    <div class="container">
                        <div class="page-top__title__icon">
                            <div class="d-flex justify-content-start justify-md-content-center align-items-center">
                                <?php
                                    $service_icon = CFS()->get('service_icon'); //新
                                    $icon = CFS()->get('icon'); //旧
                                ?>
                                <?php if ($service_icon || $icon) : ?>
                                    <div class="icon-image">
                                        <?php
                                            if ($service_icon) {
                                                echo '<img src="'.$service_icon.'">';
                                            } else {
                                                echo '<img src="'.$icon.'">';
                                            }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                <h1 class="mb-0 font-weight-bold"><?php the_title(); ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    
    <?php else : ?>
    <!-- 資料ファイルのみの表示ではないとき（保険以外用） -->
    <div class="page-top">
        <div class="page-top__title text-left">
            <div class="page-top__title_wrap">
                <div class="container">
                    <div class="page-top__title__icon">
                        <div class="d-flex justify-content-start justify-md-content-center align-items-center">
                            <?php
                                $service_icon = CFS()->get('service_icon'); //新
                                $icon = CFS()->get('icon'); //旧
                            ?>
                            <?php if ($service_icon || $icon) : ?>
                                <div class="icon-image">
                                    <?php
                                        if ($service_icon) {
                                            echo '<img src="'.$service_icon.'">';
                                        } else {
                                            echo '<img src="'.$icon.'">';
                                        }
                                    ?>
                                </div>
                            <?php endif; ?>
                            <h1 class="mb-0 font-weight-bold"><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if ($login) :
                // 体験談を取得
                $experience_args = array(
                    'posts_per_page' => -1,
                    'post_type'      => 'service-experience',
                    'post_status'    => 'publish',
                    'meta_key' => 'service',
                    'meta_value' => get_the_ID(),
                    'meta_compare' =>  '=',
                );
                $experience_query = get_posts($experience_args);

                $service_provider = CFS()->get('service_provider'); //新
                $provider = CFS()->get('provider'); //旧
                if ($service_provider || $provider) :
        ?>
            <div class="page-top__provider <?php echo $member_type; ?>">
                <div class="provider">
                    <p class="text-right text-md-center mb-0">
                        <?php if ($service_provider) { echo '提供元：'.$service_provider; } else { echo '提供元：'.$provider; } ?>
                    </p>
                </div>
            </div>
            <?php
                endif; // if ($service_provider || $provider) :
                $term = get_the_terms(get_the_ID(), 'lifesupport_cat');
                $term_slug = $term[0]->slug;
            ?>
            <div class="page-top__experience text-right text-md-center mt-2">
                <div class="page-top__experience__btn d-inline-block">
                    <a href="/service-experience/?search=<?php echo get_the_ID(); ?>&parent=<?php echo $term_slug; ?>" class="text-center text-body d-inline-block py-2 px-3 px-md-5">
                        <span class="pr-2 font-smaller">
                            <span class="d-none d-md-inline-block">サービス利用体験を見る</span>
                            <span class="d-md-none">サービス利用体験談</span>
                        </span>
                        <span class="lifesupport-color"><?php echo count($experience_query); ?></span>
                        <span class="font-smaller">件</span>
                    </a>
                </div>
            </div>
        <?php endif; //if ($login) : ?>
    </div>
    <?php endif; ?>
</div>
<!-- page-header -->

<!-- 資料ファイルのみの表示（保険）のとき かつ ログイン前のとき -->
<?php if ($only_file_content && !$llservice_only_file) : ?>
    <?php if (!$login) : ?>
        <?php
            // TODO: ログイン前の保険ページとその他サービス詳細ページはソースが同じなので整理
            // 旧
            $add_service = CFS()->get('add_service');
            $old_service = $add_service['0'];
            $service_sub_title = $old_service['service_sub_title'];
            $service_explain = $old_service['service_explain'];

            // 新
            $service_overview_img = CFS()->get('service_overview_img_new');
            $service_overview_detail = CFS()->get('service_overview_detail_new');
        ?>
        <div class="page-content-wrapper">
            <div class="container lifesupport-container">
                <div class="flame-body mx-auto">
                    <div class="page-content-innerwrap">
                        <section class="page-content-div">
                            <h3 class="d-none">サービス概要</h3>
                            <div>
                                <div class="service-overview">
                                    
                                    <?php if ($service_overview_detail) : ?>
                                        <?php if ($service_overview_img) : ?>
                                            <div class="service-overview__img">
                                                <img src="<?php echo $service_overview_img; ?>">
                                            </div>
                                        <?php endif; ?>
                                        <div class="service-overview__detail">
                                            <?php echo $service_overview_detail; ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="service-overview__detail">
                                            <?php if ($service_sub_title) { echo '<p>'.$service_sub_title.'</p>'; } ?>
                                            <?php if ($service_explain) { echo $service_explain; } ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-content-wrapper columns lifesupport-category">
            <div class="container">
                <div class="flame-body category-list">
                    <div class="page-content-innerwrap">
                        <div class="page-content-div mb-0">
                            <h3 class="cat-list-title">同じカテゴリのサービス</h3>
                            <div class="page-content-innerdiv">
                                <div class="d-sm-flex d-block flex-sm-wrap justify-content-sm-start">
                                    <?php
                                        $ID = get_the_ID();
                                        $term = get_the_terms( $ID , 'lifesupport_cat');
                                        $t_id = $term[0] ->term_id;
                                        $arg = array(
                                            'posts_per_page' => -1,
                                            'post_type'      => 'lifesupport',
                                            'orderby'        => 'meta_value_num',
                                            'meta_key'       => 'new_order',
                                            'order' => 'ASC',
                                            'tax_query'      => array(
                                                array(
                                                    'taxonomy' => 'lifesupport_cat',
                                                    'field'    => 'term_taxonomy_id',
                                                    'terms'    => array($t_id),
                                                )
                                            ),
                                        );
                                        if (!(is_user_loggedin())) {
                                            $arg = array_merge($arg, array(
                                                'meta_query' => array(
                                                    array(
                                                        'key'     =>'restriction_information',
                                                        'value'   => '1', //true,falseの1
                                                        'compare' => '!=',
                                                    ),
                                                ),
                                            ),);
                                        }
                                        $posts = get_posts($arg);
                                    ?>
                                    <?php if($posts):?>
                                        <?php foreach ($posts as $post): setup_postdata($post);?>
                                        <!-- ペット霊園リスト非表示に -->
                                        <?php
                                            if($post->post_name == 'list'){
                                                continue;
                                            }
                                        ?>
                                            <div class="link-btn">
                                                <?php
                                                    $status_icon = CFS()->get('status_icon', get_the_ID());
                                                    if ($status_icon) {
                                                        echo '<div class="new">'.$status_icon.'</div>';
                                                    }
                                                    $service_icon = CFS()->get('service_icon', get_the_ID()); //新
                                                    $icon = CFS()->get('icon', get_the_ID()); //旧
                                                ?>
                                                <a href="/lifesupport/<?php echo $post->post_name; ?>">
                                                    <button class="showall-btn ls-btn">
                                                        <div class="service_icon">
                                                            <div class="service_icon__img">
                                                                <?php if ($service_icon) : ?>
                                                                    <img src="<?php echo $service_icon; ?>" alt="<?php the_title(); ?>">
                                                                <?php elseif ($icon) : ?>
                                                                    <img src="<?php echo $icon; ?>" alt="<?php the_title(); ?>">
                                                                <?php else : ?>
                                                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/menu/menu_icon_llservice.png" alt="<?php the_title(); ?>">
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0"><?php the_title(); ?></p>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                            <g transform="translate(8176.361 -1665.095)">
                                                                <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                                <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                            </g>
                                                        </svg>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endforeach; wp_reset_postdata(); ?>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<!-- 資料ファイルのみの表示ではないとき（保険以外用） -->
<?php if (!$only_file_content && !$llservice_only_file) : ?>
    <div class="page-content-wrapper">    
        <?php
            if ($login) :
                $notices = CFS()->get('notices'); //新
                $service_note = CFS()->get('service_note'); //旧
                $notices_modal_btn = CFS()->get('notices_modal_btn');
                $notices_modal_title = CFS()->get('notices_modal_title');
                if ($service_note || $notices) :
        ?>
        <div class="page-content-div provider-content my-4">
            <div class="container">
                <?php if(!$notices_modal_btn) : ?>
                    <div class="provider-note">
                        <?php
                            if ($notices) {
                                echo $notices;
                            } else {
                                echo $service_note;
                            }
                        ?>
                    </div>
                <?php else : ?>
                    <div class="modal_trigger provider-modal-btn position-relative text-left text-md-center d-flex justify-content-start bg-white">
                        <p class="mb-0 pl-3 pl-md-3 py-2"><?php echo $notices_modal_btn; ?></p>
                        <svg class="position-absolute b-0" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415" fill="#05914d">
                            <g transform="translate(8176.361 -1665.095)">
                                <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"></rect>
                                <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"></path>
                            </g>
                        </svg>
                    </div>
                    <div class="modal_box" style="display: block;">
                        <div class="modal_bg"></div>
                        <div class="modal_inner">
                            <div class="modal_close close-bth">
                                <span>×</span>
                            </div>
                            <div class="modal_block">
                                <div class="provider-modal-content">
                                    <?php if ($notices_modal_title) : ?>
                                        <div class="article-title my-3 px-2 py-1">
                                            <p class="mb-0 font-weight-bold"><?php echo $notices_modal_title; ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <?php
                                            if ($notices) {
                                                echo $notices;
                                            } else {
                                                echo $service_note;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal_close">
                                <div class="rounded-pill">
                                    閉じる<span class="pl-3">×</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
                endif;
            endif;
        ?>
        <div class="container lifesupport-container">
            <?php
                // TODO:新テンプレートにペット霊園リストページを作る
                // if($login):
                //     if ( is_single('list') ) :
                //         // ペット霊園リストページ
                //         get_template_part('pet-list');
                //     endif;
                // endif;
            ?>
            <?php
                if (!is_single('list')) :
                    // 旧
                    $add_service = CFS()->get('add_service');
                    $old_service = $add_service['0'];
                    $service_sub_title = $old_service['service_sub_title'];
                    $service_explain = $old_service['service_explain'];

                    // 新
                    $service_overview_img = CFS()->get('service_overview_img_new');
                    $service_overview_detail = CFS()->get('service_overview_detail_new');
                    $service_overview_detail_login = CFS()->get('service_overview_detail_login');
            ?>
                <div class="flame-body mx-auto">
                    <div class="page-content-innerwrap">
                        <!-- <div class="page-content-div service-overview-content"> -->
                        <section class="page-content-div">
                            <h3 class="d-none">サービス概要</h3>
                            <div>
                                <div class="service-overview">
                                    <?php if ($service_overview_detail || $service_overview_detail_login) : ?>
                                        <div class="service-overview__detail">
                                            <?php if ($login) : ?>
                                                <?php echo $service_overview_detail_login; ?>
                                            <?php else : ?>
                                                <?php echo $service_overview_detail; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="service-overview__detail">
                                            <?php if ($service_sub_title) { echo '<p>'.$service_sub_title.'</p>'; } ?>
                                            <?php if ($service_explain) { echo $service_explain; } ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </section>
                        <?php if ($login) : ?>
                            <?php
                                $easy_access = CFS()->get('easy_access');
                                if ($easy_access) {
                                    echo '<div class="easy_access">'.$easy_access.'</div>';
                                }

                                $member_bg = CFS()->get('member_bg');
                                $member_tit = CFS()->get('member_tit');
                                $member_benefits = CFS()->get('member_benefits'); //新
                                $benefit_detail = $old_service['benefit_detail']; //旧
                                if ($member_benefits || $benefit_detail) :
                                    $member_tab = CFS()->get('member_tab');
                                    if ($member_tab['open']) {
                                        $tab_open = 'opened';
                                        $d_block = 'style="display: block;"';
                                    } else {
                                        $tab_open = '';
                                        $d_block = '';
                                    }
                            ?>
                            <!-- <div class="page-content-div member-benefits-content"> -->
                            <div class="page-content-div <?php if ($member_bg['lightgreen']) { echo 'lightgreen'; } ?>">
                                <h3 id="benefits" class="acor-menu <?php echo $tab_open; ?>">
                                    <?php if ($member_tit) : ?>
                                        <span><?php echo $member_tit; ?></span>
                                    <?php else : ?>
                                        <span>会員特典</span>
                                    <?php endif; ?>
                                </h3>
                                <div class="free-area acor-menu-child <?php echo $tab_open; ?>" <?php echo $d_block; ?>>
                                    <?php
                                        if ($member_benefits) {
                                            echo $member_benefits;
                                        } else {
                                            echo $benefit_detail;
                                        }
                                    ?>
                                </div>
                            </div>
                            <?php
                                endif;
                                $free1_bg = CFS()->get('free1_bg');
                                $ca_item_title = CFS()->get('ca_item_title');
                                $ca_content = CFS()->get('ca_content');
                                if ($ca_item_title && $ca_content) :
                                    if(wp_is_mobile()) {
                                        $ca_item_title = acorMaxLength($ca_item_title);
                                    }
                                    $free1_tab = CFS()->get('free1_tab');
                                    if ($free1_tab['open']) {
                                        $tab_open = 'opened';
                                        $d_block = 'style="display: block;"';
                                    } else {
                                        $tab_open = '';
                                        $d_block = '';
                                    }
                            ?>
                            <div class="page-content-div <?php if ($free1_bg['lightgreen']) { echo 'lightgreen'; } ?>">
                                <h3 id="lifesupport-info1" class="acor-menu <?php echo $tab_open; ?>"><span><?php echo $ca_item_title; ?></span></h3>
                                <div class="free-area acor-menu-child  <?php echo $tab_open; ?>" <?php echo $d_block; ?>>
                                    <?php echo $ca_content; ?>
                                </div>
                            </div>
                            <?php
                                endif;
                                $user_bg = CFS()->get('user_bg');
                                $user_range_tit = CFS()->get('user_range_tit');
                                $user_range = CFS()->get('user_range'); //新
                                $available_detail = $old_service['available_detail']; //旧
                                $user_tab = CFS()->get('user_tab');
                                if ($user_tab['open']) {
                                    $tab_open = 'opened';
                                    $d_block = 'style="display: block;"';
                                } else {
                                    $tab_open = '';
                                    $d_block = '';
                                }
                            ?>
                            <div class="page-content-div <?php if ($user_bg['lightgreen']) { echo 'lightgreen'; } ?>">
                                <h3 id="service-terms" class="acor-menu <?php echo $tab_open; ?>">
                                    <?php if ($user_range_tit) : ?>
                                        <span><?php echo $user_range_tit; ?></span>
                                    <?php else : ?>
                                        <span>利用者範囲・利用条件など</span>
                                    <?php endif; ?>
                                </h3>
                                <div class="free-area acor-menu-child <?php echo $tab_open; ?>" <?php echo $d_block; ?>>
                                    <?php if ($user_range || $available_detail) : ?>
                                        <div class="free-area__content">
                                            <h4>利用者範囲</h4>
                                            <div class="free-area__content__detail">
                                                <?php
                                                    if ($user_range) {
                                                        echo $user_range;
                                                    } else {
                                                        echo $available_detail;
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php
                                        endif;
                                        $detail_rules_page = get_page_by_path('lifesupport-list');
                                        $rules_page_id = $detail_rules_page->ID;
                                        $service_basic_rules = CFS()->get('service_basic_rules' , $rules_page_id);
                                        $user_detail = CFS()->get('user_detail'); //新
                                        $condition_detail = $old_service['condition_detail']; //旧
                                    ?>
                                    <div class="free-area__content">
                                        <h4>利用条件</h4>
                                        <div class="free-area__content__detail">
                                            <?php if ($user_detail || $condition_detail) : ?>
                                                <div>
                                                    <?php
                                                        if ($user_detail) {
                                                            echo $user_detail;
                                                        } else {
                                                            echo $condition_detail;
                                                        }
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="service-rule_popup">
                                                <div class="modal_trigger provider-modal-btn d-inline-block rounded-pill">
                                                    <p class="mb-0 px-3 py-2 w-100">サービス利用時の基本ルール<i class="fa-regular fa-window-restore pl-2"></i></p>
                                                </div>
                                                <div class="modal_box">
                                                    <div class="modal_bg"></div>
                                                    <div class="modal_inner">
                                                        <div class="modal_close close-bth">
                                                            <span>×</span>
                                                        </div>
                                                        <div class="modal_block">
                                                            <div class="provider-modal-content">
                                                                <div class="article-title my-3 px-2 py-1">
                                                                    <p class="mb-0 font-weight-bold">サービス利用時の基本ルール</p>
                                                                </div>
                                                                <div class="free-area__content__detail__txt">
                                                                    <?php echo $service_basic_rules; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal_close">
                                                            <div class="rounded-pill">
                                                                閉じる<span class="pl-3">×</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $how_to_use_tit = CFS()->get('how_to_use_tit'); //新
                                $use_step_loop = CFS()->get('use_step'); //新
                                $use_about = $old_service['use_about']; //旧
                                if ($use_step_loop || $use_about) :
                                    $how_to_bg = CFS()->get('how_to_bg');
                                    $how_to_tab = CFS()->get('how_to_tab');
                                    if ($how_to_tab['open']) {
                                        $tab_open = 'opened';
                                        $d_block = 'style="display: block;"';
                                    } else {
                                        $tab_open = '';
                                        $d_block = '';
                                    }
                            ?>
                            <div class="page-content-div how_to_use <?php if ($how_to_bg['lightgreen']) { echo 'lightgreen'; } ?>">
                                <h3 id="service-use" class="acor-menu <?php echo $tab_open; ?>">
                                    <?php if ($how_to_use_tit) : ?>
                                        <span><?php echo $how_to_use_tit; ?></span>
                                    <?php else : ?>
                                        <span>利用について</span>
                                    <?php endif; ?>
                                </h3>
                                <div class="free-area acor-menu-child <?php echo $tab_open; ?>" <?php echo $d_block; ?>>
                                    <?php
                                        if ($use_step_loop) :
                                            foreach ($use_step_loop as $step) :
                                            $use_step_number = $step['use_step_namber'];
                                            $use_step_title = $step['use_step_title'];
                                            $use_step_detail = $step['use_step_detail'];
                                    ?>
                                    <div class="free-area__content step-content">
                                        <?php if ($use_step_title) : ?>
                                            <h4><span class="d-block">STEP<?php echo $use_step_number; ?></span><?php echo $use_step_title; ?></h4>
                                        <?php
                                            endif;
                                            if ($use_step_detail) :
                                        ?>
                                            <div class="free-area__content__detail step-content__detail">
                                                <?php echo $use_step_detail; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                            endforeach;
                                        else: //$use_step_loop
                                            foreach ($use_about as $step) :
                                            $step_number = $step['step_namber'];
                                            $use_step_title = $step['use_title'];
                                            $use_step_detail = $step['use_detail'];
                                    ?>
                                    <div class="free-area__content step-content">
                                        <?php if ($use_step_title) : ?>
                                            <h4><span class="d-block">STEP<?php echo $step_number; ?></span><?php echo $use_step_title; ?></h4>
                                        <?php
                                            endif;
                                            if ($use_step_detail) :
                                        ?>
                                            <div class="free-area__content__detail step-content__detail">
                                                <?php echo $use_step_detail; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                            endforeach;
                                        endif; //$use_step_loop
                                    ?>
                                </div>
                            </div>
                            <?php endif; //$use_step ?>
                            <?php
                                $free2_bg = CFS()->get('free2_bg');
                                $free_item_title = CFS()->get('free_item_title');
                                $free_content = CFS()->get('free_content');
                                if ($free_item_title && $free_content) :
                                    if(wp_is_mobile()) {
                                        $free_item_title = acorMaxLength($free_item_title);
                                    }
                                    $free2_tab = CFS()->get('free2_tab');
                                    if ($free2_tab['open']) {
                                        $tab_open = 'opened';
                                        $d_block = 'style="display: block;"';
                                    } else {
                                        $tab_open = '';
                                        $d_block = '';
                                    }
                            ?>
                            <div class="page-content-div <?php if ($free2_bg['lightgreen']) { echo 'lightgreen'; } ?>">
                                <h3 id="lifesupport-info2" class="acor-menu <?php echo $tab_open; ?>"><span><?php echo $free_item_title; ?></span></h3>
                                <div class="free-area acor-menu-child <?php echo $tab_open; ?>" <?php echo $d_block; ?>>
                                    <?php echo $free_content; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php
                                $faq_list = CFS()->get('faq_list');
                                $faq_item_tit = CFS()->get('faq_item_tit');
                                $faqs = $old_service['faq']; //旧
                                if ($faq_list || $faqs) :
                                    $faq_bg = CFS()->get('faq_bg');
                                    $faq_tab_open = CFS()->get('faq_tab_open');
                                    if ($faq_tab_open['open']) {
                                        $tab_open = 'opened';
                                        $d_block = 'style="display: block;"';
                                    } else {
                                        $tab_open = '';
                                        $d_block = '';
                                    }
                            ?>
                                <div class="page-content-div <?php if ($faq_bg['lightgreen']) { echo 'lightgreen'; } ?>">
                                    <h3 id="lifesupport-faq" class="acor-menu <?php echo $tab_open; ?>">
                                        <?php if ($faq_item_tit) : ?>
                                            <span><?php echo $faq_item_tit; ?></span>
                                        <?php else : ?>
                                            <span>よくある質問</span>
                                        <?php endif; ?>
                                    </h3>
                                    <div class="faq-content acor-menu-child bg-white px-0 <?php echo $tab_open; ?>" <?php echo $d_block; ?>>
                                    <?php
                                        if ($faq_list) :
                                            foreach ($faq_list as $faq) :
                                                $faq_question = $faq['faq_question'];
                                                $faq_answer = $faq['faq_answer'];
                                    ?>
                                        <div class="faq-content__question acor-menu">
                                            <?php echo  $faq_question; ?>
                                        </div>
                                        <div class="faq-content__answer acor-menu-child w-100 p-3">
                                            <div class="d-flex bg-white px-2 py-3 faq-content__answer__txt">
                                                <div><?php echo $faq_answer; ?></div>
                                            </div>
                                        </div>
                                    <?php
                                            endforeach;
                                        else :
                                            foreach ($faqs as $faq) :
                                                $faq_question = $faq['question'];
                                                $faq_answer = $faq['answer'];
                                    ?>
                                        <div class="faq-content__question acor-menu">
                                            <?php echo  $faq_question; ?>
                                        </div>
                                        <div class="faq-content__answer acor-menu-child w-100 p-3">
                                            <div class="d-flex bg-white px-2 py-3 faq-content__answer__txt">
                                                <div><?php echo $faq_answer; ?></div>
                                            </div>
                                        </div>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; //$login ?>
                    </div>
                </div>
            <?php endif; // !is_single('list') ?>
        </div>
    </div>
    <?php
        $ID = get_the_ID();
        $term = get_the_terms( $ID , 'lifesupport_cat');
        $t_id = $term[0] ->term_id;
        $arg = array(
            'posts_per_page' => -1,
            'post_type'      => 'lifesupport',
            'orderby'        => 'meta_value_num',
            'meta_key'       => 'new_order',
            'order' => 'ASC',
            'tax_query'      => array(
                array(
                    'taxonomy' => 'lifesupport_cat',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => array($t_id),
                )
            ),
        );
        if (!(is_user_loggedin())) {
            $arg = array_merge($arg, array(
                'meta_query' => array(
                    array(
                        'key'     =>'restriction_information',
                        'value'   => '1', //true,falseの1
                        'compare' => '!=',
                    ),
                ),
            ),);
        }
        $posts = get_posts($arg);
    ?>
    <div class="page-content-wrapper columns lifesupport-category">
        <div class="container">
            <div class="flame-body category-list">
                <div class="page-content-innerwrap">
                    <?php if ($login) :?>
                        <div class="page-content-div mb-0"><!-- サービス利用体験 -->
                            <h3 class="cat-list-title">サービス利用者様の体験談</h3>
                            <div class="page-content-innerdiv service-report-list p-0">
                                <div class="container px-0 d-block"><!-- PCとSPで表示件数変更 -->
                                    <div class="service-report d-flex flex-row flex-wrap mt-3 mx-auto">
                                        <?php
                                            $show_num = 4;
                                            $args = array(
                                                'posts_per_page' => $show_num,
                                                'post_type'      => 'service-experience',
                                                'orderby' => array('term_order' => 'ASC', 'date' => 'DESC'),
                                                'post_status' => 'publish',
                                                'meta_query' => array(
                                                    array(
                                                        'key'     =>'service',
                                                        'value'   => get_the_ID(),
                                                        'compare' => '=',
                                                    ),
                                                ),
                                            );
                                            $post_data = get_posts($args);
                                        ?>
                                        <?php if($post_data):?>
                                            <?php foreach ($post_data as $se): setup_postdata($se);?>
                                            <?php
                                            $seid = $se->ID;
                                            $txt_limit = 150;
                                            if( $display_type == 'sp'){
                                                $txt_limit = 100;
                                            }
                                            $experience = get_field('experience', $seid);
                                            $experience = str_replace($remove_array, '', $experience);
                                            $remove_array = ["\r\n", "\r", "\n", " ", "　"];
                                            $content = wp_trim_words($experience, $txt_limit, '…' );
                                            $content = str_replace($remove_array, '', $content);

                                            // 日付フォーマット指定
                                            $se_date = get_field('use_date', $seid); //値の取得
                                            // 画像生成
                                            $image_url = "/cms/wp-content/themes/zenkosai/assets/images/serviceexperience";
                                            if ( get_field('icon_image', $seid) =="男性") {
                                                $image_url .= '/img_man.png';
                                            } elseif ( get_field('icon_image', $seid) =="女性") {
                                                $image_url .= '/img_lady.png';
                                            } elseif ( get_field('icon_image', $seid) =="ライノくん") {
                                                $image_url .= '/img_animal.png';
                                            }

                                            // 公開日
                                            $release_date = $se->post_date;
                                            $release_day = date('Y年n月j日', strtotime($release_date));
                                            ?>
                                            <!-- <a href="/service-experience-list/detail/?post_id=<?php echo $seid; ?>" class="my-3 report">
                                                <div class="rounded05 report-content bg-white">
                                                    <div class="px-4 report-content-txt">
                                                        <p class="mb-0 pt-2 text-left border-bottom text-secondary date-txt">サービスご利用日：<?php echo substr($se_date, 0,4); ?>年<?php echo mb_substr($se_date, -2); ?>月</p>
                                                        <div class="d-flex align-items-center mt-2">
                                                            <div class="report-txtbox text-left pl-0 ml-3">
                                                                <p class="mb-0 cat-txt"><?php echo $se_t[0]->name; ?></p>
                                                                <p class="mb-0 service-txt"><?php echo $service_title; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="my-2 thoughts-txt">
                                                            <p class="mb-0"><?php echo $content; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="px-4 pt-1 pb-2 pb-md-1 service-user">
                                                        <div class="d-flex align-items-center flex-wrap flex-sm-nowrap">
                                                            <div class="service-user__icon">
                                                                <img class="rounded-circle bg-white border mx-auto" src="<?php echo $image_url; ?>" title="サービス利用体験アイコン"/>
                                                            </div>
                                                            <p class="mb-0 ml-2 text-left text-secondary bio-txt"><?php echo get_field('age', $seid);?>　<?php echo get_field('prefecture', $seid);?>在住</p>
                                                            <p class="rounded-pill mb-sm-0 mb-1 ml-auto px-3 pt-1 text-white detail-txt">記事詳細へ >></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-0 text-secondary text-right post-date-txt">公開日：<?php echo $release_day; ?></p>
                                            </a> -->
                                            <div class="report">
                                                <div class="rounded05 report-content bg-white report__lifesupport">
                                                    <div class="px-4 report-content-txt">
                                                        <a href="/service-experience-list/detail/?post_id=<?php echo $seid; ?>" >
                                                            <p class="mb-0 pt-2 text-left border-bottom text-secondary date-txt">
                                                                サービスご利用日：：<?php echo substr($se_date, 0,4); ?>年<?php echo mb_substr($se_date, -2); ?>月
                                                            </p>
                                                            <div class="my-2 thoughts-txt">
                                                                <p class="mb-0 text-left"><?php echo $content; ?></p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <a href="/service-experience-list/detail/?post_id=<?php echo $seid; ?>" >
                                                        <div class="px-4 pt-1 pb-2 pb-lg-1 service-user">
                                                            <div class="d-flex align-items-center flex-wrap flex-lg-nowrap">
                                                                <div class="service-user__icon">
                                                                    <img class="rounded-circle bg-white border mx-auto" src="<?php echo $image_url; ?>" title="サービス利用体験アイコン"/>
                                                                </div>
                                                                <p class="mb-0 ml-2 text-left text-secondary bio-txt"><?php echo get_field('age', $seid);?>　<?php echo get_field('prefecture', $seid);?>在住</p>
                                                                <p class="rounded-pill mb-sm-0 mb-1 ml-auto px-3 pt-1 text-white detail-txt">記事詳細へ >></p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <p class="mb-0 text-secondary text-right post-date-txt">公開日：<?php echo $release_day; ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="">現在投稿はありません。</p>
                                    <?php endif; ?>
                                    </div>
                                    <div class="text-center py-2">
                                        <a href="/service-experience/?search=<?php echo get_the_ID(); ?>&parent=<?php echo $term_slug; ?>">
                                            <button class="report-btn btn rounded-pill text-white">体験談一覧</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="page-content-div mb-0">
                        <h3 class="cat-list-title">同じカテゴリのサービス</h3>
                        <div class="page-content-innerdiv">
                            <div class="d-sm-flex d-block flex-sm-wrap justify-content-sm-start">
                                <?php if($posts):?>
                                    <?php foreach ($posts as $post): setup_postdata($post);?>
                                    <!-- ペット霊園リスト非表示に -->
                                    <?php
                                        if($post->post_name == 'list'){
                                            continue;
                                        }
                                    ?>
                                        <div class="link-btn">
                                                                                                                                            <?php
                                                        $status_icon = CFS()->get('status_icon', get_the_ID());
                                                        if ($status_icon) {
                                                            echo '<div class="new">'.$status_icon.'</div>';
                                                        }
                                                        $service_icon = CFS()->get('service_icon', get_the_ID()); //新
                                                        $icon = CFS()->get('icon', get_the_ID()); //旧
                                                    ?>
                                            <a href="/lifesupport/<?php echo $post->post_name; ?>">
                                                <button class="showall-btn ls-btn">
                                                    <div class="service_icon">
                                                        <div class="service_icon__img">
                                                            <?php if ($service_icon) : ?>
                                                                <img src="<?php echo $service_icon; ?>" alt="<?php the_title(); ?>">
                                                            <?php elseif ($icon) : ?>
                                                                <img src="<?php echo $icon; ?>" alt="<?php the_title(); ?>">
                                                            <?php else : ?>
                                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/menu/menu_icon_llservice.png" alt="<?php the_title(); ?>">
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0"><?php the_title(); ?></p>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                        <g transform="translate(8176.361 -1665.095)">
                                                            <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                            <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                    <?php endforeach; wp_reset_postdata(); ?>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    endif;

    /*-------------------------------------------
        ライフサポートサービス タブの文字数上限
    /*-------------------------------------------*/
    function acorMaxLength($text) {
        $textLength = strip_tags($text);
        if(mb_strlen($textLength) > 14) {
            $textShort = mb_substr($textLength, 0, 14, 'UTF-8').'…';
        } else {
            $textShort = $textLength;
        }
        return $textShort;
    }
?>
<!-- end:資料ファイルのみの表示ではないとき -->