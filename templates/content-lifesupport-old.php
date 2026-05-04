<?php
    $p_id = get_the_ID();
    $term =  get_the_terms( $p_id, 'lifesupport_cat' );
    $t = $term[0];
    $t_name = $t->name;
    $t_slug = $t->slug;
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
    <?php if (CFS()->get('llservice_only_file')):?>
        <div class="document-llservice container pt-5">
            <?php echo CFS()->get('llservice_only_file');?>
            </div>
        </div>
    </div>
    <?php endif;?>
    <!-- start:資料ファイルのみの表示ではないとき（保険以外用） -->
    <?php if (!CFS()->get('llservice_only_file')): ?>
        <div class="page-top">
            <div class="page-top__title">
                <div class="page-top__title__icon">
                    <?php if(CFS()->get('icon') ): ?>
                        <div class="icon-image">
                            <img src="<?php echo CFS()->get('icon'); ?>">
                        </div>
                    <?php endif; ?>
                            <h1 class="mb-0"><?php the_title(); ?></h1>
                </div>
                <?php if(CFS()->get('provider') && $login): ?>
                    <div class="page-top__title__provider <?php echo $member_type; ?>">
                        <div class="provider">
                            <p class="mb-0"><?php echo CFS()->get('provider'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <!-- SP用ページ内リンク -->
    <div class="page-content-wrapper columns">
        <div class="container lifesupport-container">
            <div class="row">
                <?php if(is_user_loggedin()):?>
                    <div class="flame-side for-sp-nav col-lg-3 col-12 px-lg-0 mb-4 mb-lg-0">
                        <div class="page-content-innerwrap sp-bottom-menu <?php if ( is_single('list') ) { echo 'd-flex d-lg-block'; } ?>">
                            <?php foreach( CFS()->get('add_service') as $s ) : ?>
                                <?php if ( !is_single('list') ): ?>
                                    <?php if(count(CFS()->get('add_service'))>1):?>
                                        <div class="link-btn">
                                            <a href="#<?php echo $s['service_link']; ?>">
                                                <button class="showall-btn">
                                                    <p class="mb-0"><?php echo $s['service_sub_title']; ?></p>
                                                </button>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <?php if($s['available_range']):?>
                                            <div class="link-btn">
                                                <a href="#available">
                                                    <button class="showall-btn">
                                                        <p class="mb-0">利用者範囲</p>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="link-btn">
                                            <a href="#terms">
                                                <button class="showall-btn">
                                                    <p class="mb-0">利用条件</p>
                                                </button>
                                            </a>
                                        </div>
                                        <?php if($s['benefit_detail']): ?>
                                            <div class="link-btn">
                                                <a href="#member_benefit">
                                                    <button class="showall-btn">
                                                        <p class="mb-0">会員特典</p>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($s['service_detail']): ?>
                                            <div class="link-btn">
                                                <a href="#service_about">
                                                    <button class="showall-btn">
                                                        <p class="mb-0">内容</p>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($s['use_about']): ?>
                                            <div class="link-btn">
                                                <a href="#use_link">
                                                    <button class="showall-btn">
                                                        <p class="mb-0">利用方法</p>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($s['faq']): ?>
                                            <div class="link-btn">
                                                <a href="#faq_link">
                                                    <button class="showall-btn">
                                                        <p class="mb-0">よくあるご質問</p>
                                                    </button>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if ( is_single('list') ): ?>
                                <?php
                                    $fields = CFS()->get('cemetery_list');
                                    foreach ($fields as $field) :
                                ?>
                                    <div class="link-btn">
                                        <a href="#<?php echo $field['rural_link']; ?>">
                                            <button class="showall-btn pet-list-item">
                                                <p class="mb-0"><?php echo $field['rural']; ?></p>
                                            </button>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="flame-body <?php if(!(is_user_loggedin())) { echo'mx-auto'; } else { echo'col-lg-9'; } ?> col-12">
                    <div class="page-content-innerwrap">
                    <!-- ペット霊園の場合 -->
                    <?php if(is_single('list')): ?>
                        <div id="cemetery-list" class="page-content-div"><!-- ペット霊園 -->
                            <h3 class="pl-2">全国加盟ペット霊園リスト</h3>
                            <p class="mb-0">※ 霊園名をクリックすると各霊園のサイトに移動します。</p>
                            <?php
                                $fields = CFS()->get('cemetery_list');
                                foreach ($fields as $field) :
                            ?>
                                <div id="<?php echo $field['rural_link']; ?>">
                                    <h4><?php echo $field['rural']; ?></h4>
                                    <?php
                                        $fields = $field['prefectures'];
                                        foreach ((array)$fields as $field):
                                    ?>
                                        <div class="cemetery_list">
                                            <h5><?php echo $field['prefectures_name']; ?></h5>
                                            <?php
                                                $fields = $field['cemetery'];
                                                foreach ((array)$fields as $field):
                                            ?>
                                                <div class="cemetery">
                                                    <div class="cemetery__name">
                                                        <div class="cemetery__name__item">
                                                                <p class="mb-0">霊園名</p>
                                                        </div>
                                                        <div class="cemetery__name__detail">
                                                            <a href="<?php echo $field['cemetery_link']; ?>" target="_blank">
                                                                <p class="mb-0"><?php echo $field['cemetery_name']; ?></p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="cemetery__tel">
                                                        <div class="cemetery__tel__item">
                                                            <p class="mb-0">電話番号</p>
                                                        </div>
                                                        <div class="cemetery__tel__number">
                                                            <p class="mb-0"><?php echo $field['cemetery_number']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="cemetery__address">
                                                        <div class="cemetery__address__item">
                                                            <p class="mb-0">住所</p>
                                                        </div>
                                                        <div class="cemetery__address__number">
                                                            <p class="mb-0"><?php echo $field['cemetery_address']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!is_single('list')): ?>
                            <?php if(is_user_loggedin()):?>
                                <?php if(CFS()->get('service_note') && count(CFS()->get('add_service'))>1 ): ?>
                                    <div class="provider-note">
                                        <p class="mb-0"><?php echo CFS()->get('service_note'); ?></p>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php foreach( CFS()->get('add_service') as $s ) : ?>
                                <?php if($s['service_sub_title']):?>
                                    <h2 id="<?php echo $s['service_link']; ?>"><?php echo $s['service_sub_title']; ?></h2>
                                <?php endif; ?>
                                <?php if($s['service_explain']):?>
                                    <div class="page-content-div explain clearfix">
                                        <?php echo $s['service_explain']; ?>
                                    </div>
                                <?php endif; ?>
                                <!-- ここから先はログイン後のみ -->
                                <?php if(is_user_loggedin()):?>
                                    <?php if(CFS()->get('service_note') && count(CFS()->get('add_service')) == 1 ): ?>
                                        <div class="provider-note">
                                            <p class="mb-0"><?php echo CFS()->get('service_note'); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($s['available_range']):?>
                                        <div id="available" class="page-content-div">
                                            <h3>利用者範囲</h3>
                                            <div class="page-content-innerdiv d-block clearfix">
                                                <?php echo $s['available_detail']; ?>
                                            </div>
                                            <div class="page-content-innerdiv d-block member-rank"><!-- 固定（チェックボックス） -->
                                                <p class="member-rank__other mb-0">利用できる会員種別</p>
                                                <?php $range_p= $range_k= $range_ps= $range_ks = '';?>
                                                <?php foreach( $s['available_range'] as $key => $value ){
                                                    $range = str_replace('会員', '', $value);
                                                    $small_r = mb_strtolower($range, 'UTF-8');
                                                    if ($value == $range.'会員') {
                                                        ${'range_'.$small_r} = 'selected';
                                                    }
                                                } ?>
                                                <p class="member-rank__p <?php echo $range_p;?> mb-0">P</p>
                                                <p class="member-rank__k <?php echo $range_k;?> mb-0">K</p>
                                                <p class="member-rank__ps <?php echo $range_ps;?> mb-0">PS</p>
                                                <p class="member-rank__ks <?php echo $range_ks;?> mb-0">KS</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                        <div id="terms" class="page-content-div"><!-- 利用条件 -->
                                            <h3>利用条件</h3>
                                            <div class="page-content-innerdiv d-block clearfix">
                                                <?php echo $s['condition_detail']; ?>
                                            </div>
                                            <div class="page-content-innerdiv d-block service-note"><!-- サービスをご利用の際のご注意点 -->
                                                <button class="btn btn-primary acor-menu">
                                                    <p class="mb-0"><img src="/cms/wp-content/themes/zenkosai/assets/images/lifesupport/icon-note.png" alt="" class="d-inline mb-0 pr-1 mr-2">サービスをご利用の際のご注意点</p>
                                                </button>
                                                <div class="service-note acor-menu-child">
                                                    <div>
                                                        <ul>
                                                            <li>全てのサービスは、<font color="#FF9872">サービス利用時に会員資格があり、会費のお支払いされている</font>ことが条件となります（退会後の請求はお受付できません）。</li>
                                                            <li>サービスの提供は日本国内に限ります。（一部サービスを除く）</li>
                                                            <li>地域限定など<font color="#FF9872">サービスごとに利用条件を設けております</font>ので、あらかじめご確認ください。<br>※ 離島・山間部などではご利用いただけない場合がございます。</li>
                                                            <li>サービス内容により外国籍の方はご利用いただけない場合がございます。</li>
                                                            <li>証明書類が必要な場合は利用申請時より6か月以内のものをご提出ください。</li>
                                                            <li>証明書類は日本の公的機関発行の<font color="#FF9872">日本語の証明書類</font>をご提出ください。</li>
                                                            <li>ご提出いただきました証明書類はご返却いたしかねますのでコピーをご提出ください。</li>
                                                            <li>サービス内容は予告なく変更になる場合がございます。</li>
                                                        </ul>
                                                        <p class="mb-0">
                                                            ※ 一般財団法人全国福利厚生共済会・日本共済株式会社は価格・内容・結果などについて一切の責任は負いません。内容をよくご確認のうえ、ご利用ください。
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if($s['benefit_detail']): ?>
                                        <div id="member_benefit" class="page-content-div">
                                            <h3>会員特典</h3>
                                            <div class="page-content-innerdiv d-block member_benefit clearfix">
                                                <?php echo $s['benefit_detail']; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($s['service_detail']): ?>
                                        <div id="service_about" class="page-content-div">
                                            <h3>内容</h3>
                                            <div class="page-content-innerdiv d-block service_about clearfix">
                                                <?php echo $s['service_detail']; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($s['use_about']): ?>
                                        <div id="use_link" class="page-content-div"><!-- 利用方法 -->
                                            <h3>利用方法</h3>
                                            <?php foreach( $s['use_about'] as $use_about ) : ?>
                                                <div class="page-content-innerdiv d-block for-steps">
                                                    <div class="page-content use row">
                                                        <div class="use__step col-2 px-0 mx-0">
                                                            <p class="bg-white mb-0"><span>STEP</span><br><?php echo $use_about['step_namber']; ?></p>
                                                        </div>
                                                        <div class="use__detail col-10 px-0 mx-0">
                                                            <h4><?php echo $use_about['use_title']; ?></h4>
                                                            <div class="detail-contents clearfix">
                                                                <?php echo $use_about['use_detail']; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($s['faq']): ?>
                                        <div id="faq_link" class="page-content-div"><!-- よくあるご質問 -->
                                            <h3>よくあるご質問</h3>
                                            <?php foreach( $s['faq'] as $faq) : ?>
                                                <div class="page-content-innerdiv d-block service-note faq">
                                                    <button class="btn btn-primary acor-menu">
                                                        <div class="question">
                                                            <div class="question__mark">Q</div>
                                                            <div class="question__detail">
                                                                <p class="mb-0 pl-0"><?php echo $faq['question']; ?></p>
                                                            </div>
                                                            <div class="question__answer">
                                                                <p class="mb-0"><span class="text-danger">回答</span><br><span class="questioner-toggle-txt">を見る</span></p><!-- 回答が開いてるときはjsで「を見る」を「閉じる」に変わるように -->
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <!-- <div class="acor-menu-child" id=""> -->
                                                        <div class="card card-body acor-menu-child">
                                                            <div class="answer">
                                                                <div class="answer__mark">A</div>
                                                                <div class="answer__detail clearfix">
                                                                    <p class="mb-0"><?php echo $faq['answer']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- </div> -->
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if(is_user_loggedin()):?>
                                <div class="page-content-div mb-0"><!-- サービス利用体験 -->
                                    <h3>サービス利用者様の体験談</h3>
                                    <div class="page-content-innerdiv d-block service-report-list">
                                        <div class="container px-0"><!-- PCとSPで表示件数変更 -->
                                            <div class="row service-report d-flex flex-row justify-content-start">
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
                                                    $txt_limit = 50;
                                                    if( $display_type == 'sp'){
                                                        $txt_limit = 27;
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
                                                    <a href="/service-experience-list/detail/?post_id=<?php echo $seid; ?>" class="report col-12 rounded05 d-flex align-items-center mb-3">
                                                        <div class="col-4 col-md-3 report-imgbox d-flex">
                                                            <img class="rounded-circle bg-white border mx-auto mb-0" src="<?php echo $image_url; ?>" title="サービス利用体験アイコン"/>
                                                        </div>
                                                        <div class="col-8 col-md-9 report-txtbox text-left pl-0">
                                                            <p class="mb-0 date-txt"><?php echo substr($se_date, 0,4); ?>年<?php echo mb_substr($se_date, -2); ?>月利用</p>
                                                            <p class="mb-0 bio-txt"><?php echo get_field('age', $seid);?>　<?php echo get_field('prefecture', $seid);?>在住</p>
                                                            <p class="mb-0 content-txt"><?php echo $experience; ?></p>
                                                        </div>
                                                    </a>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <p class="">現在投稿はありません。</p>
                                            <?php endif; ?>
                                            </div>
                                            <div class="page-link">
                                                <a href="/service-experience/">
                                                    <button class="showall-btn"><p class="mb-0">体験談一覧</p></button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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
            'meta_key'       => 'order',
            'order'          => 'ASC',
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
<?php endif;?>
<!-- end:資料ファイルのみの表示ではないとき -->