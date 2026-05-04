<?php
/*
 * Template Name: 社会貢献活動ー活動詳細
 */
require_once("cms/wp-content/themes/zenkosai/api/posts_is_read.php");
$post_id = get_the_ID();
is_already_read($post_id);
get_header(); ?>


<?php
$p_id = get_the_ID();
$term =  get_the_terms( $p_id, 'csr_cat' );
$t = $term[0];
?>
<?php $csr_id = 253; //固定ページ「社会貢献」のポストID ?>
<?php if ($t->slug === 'csr-topics') : ?>
    <div id="single-csr-topics" class="page-provider-information single-homenews csr-topics-content page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
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
                                <a itemprop="item" href="/social-contributions/csr-topics/">
                                    <span itemprop="name">社会貢献活動のお知らせ</span>
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
            <div class="flame-body w-auto row justify-content-between">
                <div class="page-content-innerwrap col-12 col-md-8">
                    <div class="page-content-div">
                        <article>
                            <div class="row info-news-bar align-items-center mb-0">
                                <div class="news-date">
                                    <?php the_time('Y/m/d') ?>
                                </div>
                            </div>
                            <h1 class="pl-2 pl-md-3 mt-1"><p class="mb-0 news-title"><?php the_title(); ?></p></h1>
                            <div class="article-detail">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <div class="back-button">
                            <a href="/social-contributions/csr-topics/">
                                <button><span class="pr-2">社会貢献活動のお知らせ一覧へ</span><i class="fas fa-arrow-right"></i></button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php get_template_part('templates/csr-topics-archive');?>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<div class="csr csr-article csr-activities-index pt-3 page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
        <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/">
                                    <span itemprop="name">
                                        <i class="fa fa-home"></i> HOME
                                    </span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/social-contribution/">
                                    <span itemprop="name">社会貢献活動</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/social-contributions/category/?csr_cat=<?php echo $t->slug; ?>">
                                    <span itemprop="name"><?php echo $t->name;?></span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/social-contributions/category/activities/?csr_cat=<?php echo $t->slug; ?>">
                                    <span itemprop="name">これまでの活動報告</span>
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
    </div>
    <div class="page-content-div csr-newslist">
        <div class="csr-news container d-block">
            <div class="row">
                <div class="col-12 col-md-9">
                    <article class="clearfix my-3">
                        <div class="csr-article-title mb-2">
                            <p class="mb-0 bold font-large"><?php the_title(); ?></p>
                        </div>
                        <div class="csr-article-detail mb-4">
                            <?php the_content(); ?>
                        </div>
                    </article>
                </div>
                <!-- アーカイブ -->
                <div class="archive-list col-12 col-md-3">
                    <div class="csr-posts-index px-md-0">
                        <div class="csr-posts-wrapper container px-0 pb-4 mx-auto">
                            <?php
                                $t_id = $t->term_id;
                                $p_year = '';
                                $p_month = '';
                                $arg = array(
                                    'posts_per_page' => -1,
                                    'post_type'      => 'social-contribution',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'csr_cat',
                                            'field'    => 'id',
                                            'terms'    => $t_id
                                        )
                                    )
                                );
                                $posts = get_posts($arg);
                            ?>
                            <?php 
                                $i = 0;
                                if($posts):
                                    foreach ($posts as $post):
                                        setup_postdata( $post );

                                        $is_hidden = CFS()->get('csr_info_nologin', $post->ID);

                                        if ( (empty($login) || $login === 'guest') && !empty($is_hidden) ) {
                                            continue; 
                                        }
                            ?>
                                <?php if ($p_year != get_the_date('Y')): ?>
                                <?php
                                    $p_month = '';
                                    $p_year = get_the_date('Y');?>
                                <div class="year-link col-12 py-2 px-0 mt-0">
                                    <div class="arrow-btn posts-index bg-csr rounded-0 p-2">
                                        <a href="/social-contributions/category/activities/?csr_cat=<?php echo $t->slug; ?>&anu=<?php echo $p_year; ?>">
                                            <p class="text-white mb-0 px-2"><?php echo $p_year; ?>年の更新<span></span></p>
                                        </a>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                <?php endif;?>
                            <?php endforeach;?>
                            <!--</div>-->
                            <div class="csr-posts-index-btn text-center">
                                <button class="showall-btn" onclick="location.href='/social-contributions/category/activities/?csr_cat=<?php echo $t->slug; ?>'">
                                    <p class="mb-0 pr-2">これまでの<br>活動報告一覧</p>
                                </button>
                            </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_footer(); ?>
