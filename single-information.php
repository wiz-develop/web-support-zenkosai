<?php
/*
 * Template Name: インフォメーション詳細
 */
require_once("cms/wp-content/themes/zenkosai/api/posts_is_read.php");
$post_id = get_the_ID();
is_already_read($post_id);
get_header(); ?>

<?php
    $p_id = get_the_ID();
    $term =  get_the_terms( $p_id, 'news' );
    $t = $term[0];
    $logo = get_field('n_logo', $t);
    $color = get_field('n_color', $t);
?>
<div id="page-information" class="page-information single-homenews page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
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
                                <a itemprop="item" href="/information/">
                                    <span itemprop="name">インフォメーション</span>
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
            <div class="flame-body row w-auto">
                <div class="page-content-innerwrap col-12 col-md-9">
                    <div class="page-content-div">
                        <article>
                            <div class="row info-news-bar align-items-center">
                                <div class="news-date">
                                    <?php the_time('Y/m/d') ?>
                                </div>
                                <div class="news-cat d-flex flex-row align-items-center ml-3" style="background-color: <?php echo $color; ?>">
                                    <div class="cat-img-div">
                                        <img class="" src="<?php echo $logo['url']; ?>" title="<?php echo $t->name; ?>"/>
                                    </div>
                                    <p class="mb-0 news-cat-txt bold pl-2"><?php echo $t->name; ?></p>
                                </div>
                            </div>
                            <!-- TODO:タイトル文字数の制限 -->
                            <h1 class="pl-2 pl-md-3"><p class="mb-0 news-title"><?php the_title(); ?></p></h1>
                            <div class="article-detail">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <div class="back-button">
                            <a href="/information">
                                <button><span class="pr-2">インフォメーション一覧へ</span><i class="fas fa-arrow-right"></i></button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php get_template_part('templates/news-archive');?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>