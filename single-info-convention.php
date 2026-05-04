<?php
/*
 * コンベンション お知らせ詳細
 */
session_start();
if(!$_SESSION['member_info'] ){
    header("Location: {$home_url}");
    exit;
}
get_header(); ?>

<div id="single-info-convention" class="page-information single-homenews page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo home_url(); ?>">
                                    <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/national-convention_2026/">
                                    <span itemprop="name">2026 National Convention</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/info-convention/">
                                    <span itemprop="name">National Convention お知らせ</span>
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
    </div><!-- page-header -->
    <div class="csr-newslist page-content-wrapper columns">
        <div class="csr-news container d-block">
            <div class="flame-body w-auto">
                <div class="page-content-innerwrap">
                    <div class="page-content-div">
                        <article>
                            <div class="row info-news-bar align-items-center">
                                <div class="news-date">
                                    <?php the_time('Y/m/d') ?>
                                </div>
                                <!-- <div class="news-cat d-flex flex-row align-items-center ml-3" style="background-color: <?php echo $color; ?>">
                                    <div class="cat-img-div">
                                        <img class="" src="<?php echo $logo['url']; ?>" title="<?php echo $t->name; ?>"/>
                                    </div>
                                    <p class="mb-0 news-cat-txt bold pl-2"><?php echo $t->name; ?></p>
                                </div> -->
                            </div>
                            <!-- TODO:タイトル文字数の制限 -->
                            <h1 class="pl-2 pl-md-3"><p class="mb-0 news-title"><?php the_title(); ?></p></h1>
                            <div class="article-detail">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <div class="back-button">
                            <a href="/info-convention/">
                                <button>一覧へ</button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php //get_template_part('templates/news-archive');?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>