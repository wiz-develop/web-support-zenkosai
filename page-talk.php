<?php
/*
 * Template Name: 全厚済とは 対談
 */
get_header();
?>

<div id="page-new-company" class="page-company page-wrapper page-company-talk <?php echo $display_type; ?> <?php echo $login; ?>">
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
                                <span itemprop="name"><?php the_title(); ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top">
            <div class="page-top__title">
                <div class="page-top__title__icon">
                    <h1 class="mb-0"><?php the_title(); ?></h1>
                </div>
            </div>
            <div class="page-top__nav">
                <?php get_template_part('templates/about-pagetop-nav');?>
            </div>
        </div>
    </div><!-- page-header -->

    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-about">
                <?php the_content();?>
            </div>
            <?php
                $fields = CFS()->get('talk_list');

                $has_valid_item = false;
                if (is_array($fields)) {
                    foreach ($fields as $field) {
                        if (!empty($field['talk_page_link']) && !empty($field['talk_tit'])) {
                            $has_valid_item = true;
                            break;
                        }
                    }
                }

                if ($has_valid_item) :
            ?>
            <div class="main-talk page-link row pb-5">
                <?php foreach ($fields as $field) : ?>
                    <?php if (!empty($field['talk_page_link'])): ?>
                    <div class="main-talk__content col-12 col-md-6 p-2">
                        <a href="#<?php echo $field['talk_page_link']; ?>" style="color: <?php echo $field['link_text_color']; ?>;">
                            <div class="main-talk__content__link-name" style="border: solid 1px <?php echo $field['link_btn_boder']; ?>; background-color: <?php echo $field['link_btn_bg']; ?>;" onMouseOut="this.style.background='<?php echo $field['link_btn_bg']; ?>';" onMouseOver="this.style.background='<?php echo $field['link_btn_hover']; ?>'">
                            <?php echo $field['talk_tit']; ?>
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                <?php
                    endforeach;
                ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="sub-talk">
            <?php
                $fields = CFS()->get('talk_list');
                foreach ($fields as $field) :
            ?>
            <div id="<?php if (!empty($field['talk_page_link'])): ?><?php echo $field['talk_page_link']; ?><?php endif; ?>" class="sub-talk__content row<?php if (!empty($field['talk_bg_img'])): ?> bg-content<?php endif; ?>"<?php if (!empty($field['talk_bg_img'])): ?> style="background-image: url('<?php echo $field['talk_bg_img']; ?>');"<?php endif; ?>>
                <div class="talk-item container">
                    <?php if (!empty($field['talk_tit'])): ?>
                    <div class="sub-talk__content__detail__item col-12" style="background-color: <?php echo $field['tit_border_bottom']; ?>;">
                        <p class="mb-0"><?php echo $field['talk_tit']; ?></p>
                    </div>
                    <?php endif; ?>
                    <div class="sub-talk__content__detail">
                        <div class="sub-talk__content__detail__header">
                            <?php echo $field['talk_about']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            ?>
        </div>
        <div class="container">
            <?php get_template_part('templates/about-nav_new');?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
