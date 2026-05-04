<?php
/*
 * Template Name: コンベンション動画 テンプレート
 */
get_header();
?>


<div id="page-convention_movie" class="page-convention_2023 <?php echo $display_type; ?> <?php echo $login; ?>">
    <?php if (wp_is_mobile()) :?>
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
                            <li>
                                <span><?php echo CFS()->get('tit_name'); ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top">
            <div class="page-top__title" style="background: url(<?php echo CFS()->get('top_bg'); ?>) no-repeat; background-size: cover; background-position: center; z-index: -1;">
                <div class="page-top__title__main">
                    <h1><img src="<?php echo CFS()->get('tit_img'); ?>" alt="<?php echo CFS()->get('tit_name'); ?>"><span class="d-block"><?php echo CFS()->get('subtit_name'); ?></span></h1>
                </div>
            </div>
            <div class="page-top__about">
                <?php echo CFS()->get('about'); ?>
                <div class="page-top__about__note">
                    <?php echo CFS()->get('please_note'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="page-header" style="background: url(<?php echo CFS()->get('top_bg'); ?>) no-repeat; background-size: cover; background-position: center;">
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
                            <li>
                                <span><?php echo CFS()->get('tit_name'); ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top">
            <div class="page-top__title">
                <div class="page-top__title__main">
                    <h1><img src="<?php echo CFS()->get('tit_img'); ?>" alt="<?php echo CFS()->get('tit_name'); ?>"><span class="d-block"><?php echo CFS()->get('subtit_name'); ?></span></h1>
                </div>
            </div>
            <div class="page-top__about">
                <?php echo CFS()->get('about'); ?>
                <div class="page-top__about__note">
                    <?php echo CFS()->get('please_note'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>

    <div class="page-content-wrapper">
        <div class="main-movie page-link row">
            <?php
                $fields = CFS()->get('movie_list');
                foreach ($fields as $field) :
            ?>
            <div class="main-movie__content col-12 col-md-6 p-2">
                <a href="#<?php echo $field['movie_page_link']; ?>" style="color: <?php echo $field['link_text_color']; ?>;">
                    <div class="main-movie__content__link-name" style="border: solid 1px <?php echo $field['link_btn_boder']; ?>; background-color: <?php echo $field['link_btn_bg']; ?>;" onMouseOut="this.style.background='<?php echo $field['link_btn_bg']; ?>';" onMouseOver="this.style.background='<?php echo $field['link_btn_hover']; ?>'">
                    <?php echo $field['movie_tit']; ?>
                    </div>
                </a>
            </div>
            <?php
                endforeach;
            ?>
        </div>
        <div class="sub-movie row">
            <?php
                $fields = CFS()->get('movie_list');
                foreach ($fields as $field) :
            ?>
            <div id="<?php echo $field['movie_page_link']; ?>" class="sub-movie__content col-lg-6 col-md-6 col-12">
                <div class="sub-movie__content__detail__item" style="border-bottom: solid 1px <?php echo $field['tit_border_bottom']; ?>;">
                    <p class="mb-0"><?php echo $field['movie_tit']; ?></p>
                </div>
                <div class="sub-movie__content__detail">
                    <iframe src="<?php echo $field['movie_url']; ?>" width="100%" height="auto" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen poster="<?php echo $field['movie_th']; ?>"></iframe>
                </div>
            </div>
            <?php
                endforeach;
            ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
