<?php
/*
 * Template Name: モバイルレンタル
 */
// TODO:カテゴリのカスタムフィールドに「ログイン前に表示させない」があった場合非表示
$terms = get_the_terms(get_the_ID(), 'lifesupport_cat');
$lt_id = $terms[0]->term_id;
$key = 'lifesupport_cat_'.$lt_id;
$is_restrict_cat = get_field('s_display', $terms);
if($is_restrict_cat){
    session_start();
    if(!$_SESSION['member_info']){
        wp_redirect(home_url('/lifesupport'));
        exit;
    }
}
if($cfs->get('restriction_information')){
    session_start();
    if(!$_SESSION['member_info']){
        wp_redirect(home_url('/'));
        exit;
    }
}
get_header(); ?>
<?php $p_id = get_the_ID();?>

<div id="page-lifesupport" class="page-lifesupport single-lifesupport <?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <img src="<?php echo $cfs->get( 'header_image', $page_id); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get( 'header_image_sp', $page_id); ?>" class="sp-bnr">
            </div>
            <div class="page-top__title">
                <div class="page-top__title__icon">
                    <?php if($cfs->get('icon') ): ?>
                        <div class="icon-image">
                            <img src="<?php echo $cfs->get('icon'); ?>">
                        </div>
                    <?php endif; ?>
                            <h1 class="mb-0"><?php the_title(); ?></h1>
                </div>
                <?php if($cfs->get('provider') ): ?>
                    <div class="page-top__title__provider <?php echo $member_type; ?>">
                        <div class="provider">
                            <p class="mb-0"><?php echo $cfs->get('provider'); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container lifesupport-container">
            <div class="flame-body">
                <div class="page-content-innerwrap ml-0 ml-lg-3">
                    <?php foreach( $cfs->get('add_service') as $s ) : ?>
                        <?php if($s['service_sub_title']):?>
                            <h2 id="#<?php echo $s['service_link']; ?>"><?php echo $s['service_sub_title']; ?></h2>
                        <?php endif; ?>
                        <div class="page-content-div explain clearfix">
                            <?php echo $s['service_explain']; ?>
                        </div>
                        <!-- ここから先はログイン後のみ -->
                        <?php if(is_user_loggedin()):?>
                            <?php if($cfs->get('service_note') ): ?>
                                <div class="provider-note">
                                    <p class="mb-0"><?php echo $cfs->get('service_note'); ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if($s['available_range']):?>
                                <div id="<?php echo  $s['available_link']; ?>" class="page-content-div">
                                    <h3>利用者範囲</h3>
                                    <div class="page-content-innerdiv clearfix">
                                        <?php echo $s['available_detail']; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                                <div id="<?php echo  $s['condition_link']; ?>" class="page-content-div"><!-- 利用条件 -->
                                    <h3>利用条件</h3>
                                    <div class="page-content-innerdiv clearfix">
                                        <?php echo $s['condition_detail']; ?>
                                    </div>
                                </div>
                                <?php if($s['benefit_detail']): ?>
                                <div id="member_benefit" class="page-content-div">
                                    <h3>会員特典</h3>
                                    <div class="page-content-innerdiv member_benefit clearfix">
                                        <?php echo $s['benefit_detail']; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($s['service_detail']): ?>
                                <div id="service_about" class="page-content-div">
                                    <h3>端末詳細​</h3>
                                    <div class="page-content-innerdiv service_about clearfix">
                                        <?php echo $s['service_detail']; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($s['use_about']): ?>
                                <div id="<?php echo $s['use_link']; ?>" class="page-content-div"><!-- 利用方法 -->
                                    <h3>利用方法</h3>
                                    <?php foreach( $s['use_about'] as $use_about ) : ?>
                                        <div class="page-content-innerdiv for-steps">
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
                                <div id="<?php echo $s['faq_link']; ?>" class="page-content-div"><!-- よくあるご質問 -->
                                    <h3>よくあるご質問</h3>
                                    <?php foreach( $s['faq'] as $faq) : ?>
                                        <div class="page-content-innerdiv service-note faq">
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
                        <?php if(is_page('medicine')):?>
                            <div class="page-content-div mb-0 d-block"><!-- サービス利用体験 -->
                                <h3>サービス利用者様の体験談</h3>
                                <div class="page-content-innerdiv service-report-list">
                                    <div class="container px-0"><!-- PCとSPで表示件数変更 -->
                                        <div class="row service-report d-flex flex-row justify-content-start">
                                            <?php
                                                $post_id = 3248;
                                                $show_num = 4;
                                                $args = array(
                                                    'posts_per_page' => $show_num,
                                                    'post_type'      => 'service-experience',
                                                    'orderby' => array('term_order' => 'ASC', 'date' => 'DESC'),
                                                    'post_status' => 'publish',
                                                    'meta_query' => array(
                                                        array(
                                                            'key'     =>'service',
                                                            'value'   => $post_id,
                                                            'compare' => '=',
                                                        ),
                                                    ),
                                                );
                                                $post_data = get_posts($args);
                                                console_log($post_data);
                                            ?>
                                            <?php if($post_data):?>
                                                <?php foreach ($post_data as $se): setup_postdata($se);?>
                                                <?php
                                                console_log($se);
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
                                                ?>
                                                <a href="<?php echo $se->guid; ?>" class="report col-12 rounded05 d-flex align-items-center mb-3">
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
</div>
<?php get_footer(); ?>