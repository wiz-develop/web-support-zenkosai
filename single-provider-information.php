<?php
/*
 * サービス提供会社からのお知らせ詳細
 */
session_start();
if(!$_SESSION['member_info'] ){
    header("Location: {$home_url}");
    exit;
}
get_header();

    $provider_id = get_the_ID();
    $service_id = CFS()->get('provider_service', $provider_id);
    $service_id_count = count($service_id);
    if ($service_id_count == 1) {
        $service = get_post($service_id[0]);
        $service_title = strip_tags($service->post_title);
        $service_icon = CFS()->get('service_icon', $service->ID);
        if (!$service_icon) {
            $service_icon = CFS()->get('icon', $service->ID);
        }
    } else {
        $service_icon = '/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_llservice.png';
        $service_title = '複数サービスのお知らせ（全'.$service_id_count.'件）';
    }
?>

<div id="single-provider-information" class="page-provider-information single-homenews page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
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
                                <a itemprop="item" href="/provider-info/">
                                    <span itemprop="name">サービス提供会社からのお知らせ</span>
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
                            <div class="row info-news-bar align-items-center">
                                <div class="news-date">
                                    <?php the_time('Y/m/d') ?>
                                </div>
                                <div class="news-cat w-auto d-flex flex-row align-items-center ml-0 ml-sm-3">
                                    <div class="cat-img-div">
                                        <img src="<?php echo $service_icon; ?>" alt="<?php echo $service_title; ?>">
                                    </div>
                                    <p class="mb-0 news-cat-txt bold text-left"><?php echo $service_title; ?></p>
                                </div>
                            </div>
                            <h1 class="pl-2 pl-md-3"><p class="mb-0 news-title"><?php the_title(); ?></p></h1>
                            <div class="article-detail">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <div class="back-button">
                            <a href="/provider-info/">
                                <button><span class="pr-2">サービス提供会社からのお知らせ一覧へ</span><i class="fas fa-arrow-right"></i></button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php get_template_part('templates/provider-archive');?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>