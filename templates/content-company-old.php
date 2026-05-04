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
            <img src="<?php echo CFS()->get('header_image'); ?>" class="pc-bnr">
            <img src="<?php echo CFS()->get('header_image_sp'); ?>" class="sp-bnr">
        </div>
        <div class="page-top__icon">
            <?php if(CFS()->get('title_icon') ): ?>
                <div class="icon-image">
                    <img src="<?php echo CFS()->get('title_icon'); ?>">
                </div>
            <?php endif; ?>
                    <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container">
        <div class="page-content-innerwrap">
            <h3>会概要</h3>
                <?php
                    foreach( CFS()->get('company') as $company ) :
                ?>
                    <div class="page-content-div">
                        <h4><?php echo $company['company_item']; ?></h4>
                            <div class="page-content-innerdiv">
                                <?php echo $company['company_detail']; ?>
                            </div>
                    </div>
                <?php
                    endforeach;
                ?>
                <div class="page-content-div">
                    <!-- ビジネスページの情報なので -->
                    <!-- ビジネスページのID取得 -->
                    <?php
                        $page_ID = get_page_by_path('business');
                        $page_ID = $page_ID->ID;
                    ?>
                    <h4>有効会員口数</h4>
                        <div class="page-content-innerdiv">
                        <?php echo CFS()->get('business_member_number_new', $page_ID); ?>口（<?php echo date('Y年m月d日', strtotime(CFS()->get('business_member_number_update_new', $page_ID))); ?>現在）
                        </div>
                </div>
                <div class="page-content-div">
                    <h4>導入サービス</h4>
                        <div class="page-content-innerdiv">
                            11カテゴリー提供企業数600以上（全厚済OffTime含む）
                        </div>
                </div>
        </div>
        <div class="page-content-innerwrap philosophy">
            <h3>基本理念</h3>
                <div class="page-content-div">
                    <?php echo CFS()->get('philosophy'); ?>
                </div>
                <div class="page-content-div tokutei-div rounded07 p-3 mb-3">
                    <p class="mb-0">
                        当会は、入会された方への福利厚生サービスの提供を目的とする一般の民間団体であり、金融庁その他一切の公的機関等の委託を受けて業務をおこなっている団体ではありません。<br>
                        また、当会のおこなう事業は、許認可、届出等を要する事業ではなく、当会は、国、地方公共団体その他一切の公的機関の許認可を受け、あるいは、公的機関等へ届出、登録等をおこなっている団体ではありません。
                    </p>
                </div>

                <div class="page-content-div questionnaire-note">
                    <p class="mb-0">
                    現在、当会への紹介の説明を受けられた方へのアンケートのご協力をお願いいたしております。<br>
                    ご入会された、ご入会されなかったに関わりなく、お話を聞かれた際にお気づきの点がございましたらお聞かせいただけますようお願いいたします。
                    </p>
                    <div class="questionnaire-link">
                        <a href="/questionnaire/"><button><p class="mb-0">アンケートはこちら</p></button></a>
                    </div>
                </div>
        </div>
    </div>
</div>
<?php get_template_part('templates/about-nav');?>