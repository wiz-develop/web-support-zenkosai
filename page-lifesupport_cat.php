<?php
/*
 * Template Name: ライフサポートサービスカテゴリーページ
 */
get_header(); ?>

<?php
    // $p_id = get_the_ID();
    // $term =  get_the_terms( $p_id, 'lifesupport_cat' );
    // $t = $term[0];
    // $t_name = $t->name;
    // $t_slug = $t->slug;

    // if ($_SESSION['member_info']) {
    //     $login = true;
    // } else {
    //     $login = false;
    // }
?>
<div id="single-lifesupport" class="page-wrapper pc llservice-cat_about" style="margin-top: 80px;">
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
                        <li>
                            <span><?php the_title(); ?></span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="page-top">
        <div class="page-top__title text-left">
            <div class="page-top__title_wrap">
                <div class="container">
                    <div class="page-top__title__icon">
                        <div class="d-flex justify-content-start justify-md-content-center align-items-center">
                            <div class="icon-image">
                                <img src="https://official-webdev.zenko-sai.or.jp/cms/wp-content/uploads/2022/07/全厚済コミュニティ　アイコン「C」.png">
                            </div>
                            <h1 class="mb-0 font-weight-bold"><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- page-header -->


<div class="page-content-wrapper">    
    <div class="container lifesupport-container">
        <div class="flame-body mx-auto">
            <div class="page-content-innerwrap">
                <div class="service-overview">
                    <div class="service-overview__detail my-3">
                        <p class="mb-0 text-left">全厚済会員同士の人とのつながりと助けあいの輪を広げるためのサービスです。​<br>たくさんの方と交流し、たくさん学び、互いの価値観を尊重し成長していくことで皆様の人生を豊かにしていくことを目標にしたサービスです。​</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-content-wrapper columns lifesupport-category">
    <div class="container">
        <div class="flame-body category-list">
            <div class="page-content-innerwrap">
                <div class="page-content-div mb-0">
                    <div class="page-content-innerdiv llservice-list">
                        <div class="llservice-list__item d-flex align-items-start">
                            <?php if(!wp_is_mobile()) : ?>
                            <div class="llservice-list__item__icon col-lg-2">
                                <img src="/cms/wp-content/uploads/2022/07/フレンドショップあいこん-1.png" alt="フレンドショップ">
                            </div>
                            <?php endif; ?>
                            <div class="llservice-list__item__about col-lg-6 col-12">
                                <div class="llservice-list__item__about__header">
                                    <?php if(wp_is_mobile()) : ?>
                                    <span>
                                        <img src="/cms/wp-content/uploads/2022/07/フレンドショップあいこん-1.png" alt="フレンドショップ">
                                    </span>
                                    <?php endif; ?>
                                    <span>フレンドショップ</span>
                                </div>
                                <div class="llservice-list__item__about__body">
                                    <p class="mb-0 text-left">フレンドショップサイトでご自身のお店をご紹介していただけます。<br>登録料など費用はかからず申請から登録まで、全厚済がしっかりサポートいたします。<br>会員様がご利用の際の会員特典だけご用意ください。<br>お店を利用される会員様は、会員特典をつけていただけるのでお得にご利用いただけます。</p>
                                </div>
                            </div>
                            <div class="llservice-list__item__img col-lg-4 col-12">
                                <img class="w-100" src="https://official-webdev.zenko-sai.or.jp/cms/wp-content/uploads/2024/09/cat-sample_yuricago.png" alt="フレンドショップ">
                            </div>
                        </div>
                        <div class="llservice-list__item d-flex align-items-start">
                            <?php if(!wp_is_mobile()) : ?>
                            <div class="llservice-list__item__icon col-lg-2">
                                <img src="/cms/wp-content/uploads/2022/07/フレンドショップあいこん-1.png" alt="フレンドショップ">
                            </div>
                            <?php endif; ?>
                            <div class="llservice-list__item__about col-lg-6 col-12">
                                <div class="llservice-list__item__about__header">
                                    <?php if(wp_is_mobile()) : ?>
                                    <span>
                                        <img src="/cms/wp-content/uploads/2022/07/フレンドショップあいこん-1.png" alt="フレンドショップ">
                                    </span>
                                    <?php endif; ?>
                                    <span>フレンドショップ</span>
                                </div>
                                <div class="llservice-list__item__about__body">
                                    <p class="mb-0 text-left">フレンドショップサイトでご自身のお店をご紹介していただけます。<br>登録料など費用はかからず申請から登録まで、全厚済がしっかりサポートいたします。<br>会員様がご利用の際の会員特典だけご用意ください。<br>お店を利用される会員様は、会員特典をつけていただけるのでお得にご利用いただけます。</p>
                                </div>
                            </div>
                            <div class="llservice-list__item__img col-lg-4 col-12">
                                <img class="w-100" src="https://official-webdev.zenko-sai.or.jp/cms/wp-content/uploads/2024/09/cat-sample2.png" alt="フレンドショップ">
                            </div>
                        </div>
                        <div class="llservice-list__item d-flex align-items-start">
                            <?php if(!wp_is_mobile()) : ?>
                            <div class="llservice-list__item__icon col-lg-2">
                                <img src="/cms/wp-content/uploads/2022/07/フレンドショップあいこん-1.png" alt="フレンドショップ">
                            </div>
                            <?php endif; ?>
                            <div class="llservice-list__item__about col-lg-6 col-12">
                                <div class="llservice-list__item__about__header">
                                    <?php if(wp_is_mobile()) : ?>
                                    <span>
                                        <img src="/cms/wp-content/uploads/2022/07/フレンドショップあいこん-1.png" alt="フレンドショップ">
                                    </span>
                                    <?php endif; ?>
                                    <span>フレンドショップ</span>
                                </div>
                                <div class="llservice-list__item__about__body">
                                    <p class="mb-0 text-left">フレンドショップサイトでご自身のお店をご紹介していただけます。<br>登録料など費用はかからず申請から登録まで、全厚済がしっかりサポートいたします。<br>会員様がご利用の際の会員特典だけご用意ください。<br>お店を利用される会員様は、会員特典をつけていただけるのでお得にご利用いただけます。</p>
                                </div>
                            </div>
                            <div class="llservice-list__item__img col-lg-4 col-12">
                                <img class="w-100" src="https://official-webdev.zenko-sai.or.jp/cms/wp-content/uploads/2024/09/cat-sample3.png" alt="フレンドショップ">
                            </div>
                        </div>
                    </div>
                    <div class="list-back_btn rounded text-center">
                        <a href="<?php echo home_url() ; ?>/lifesupport/">
                            <span>ライフサポートサービス一覧へ戻る</span><i class="fas fa-solid fa-chevron-right pl-2"></i>
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