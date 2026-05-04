<?php
/*
 * Template Name: メディアコンテンツ詳細
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header();

$media_cat = 'media_cat';
$media_csr_cat = 'media_csr_cat';
$media_list = 'media_list';
$p_id = get_the_ID();

$terms =  get_the_terms( $p_id, $media_cat );
foreach ($terms as $t) {
    $has_parent = $t->parent;
    $parent_slug = get_term($has_parent, $media_cat);
    if ($parent_slug->slug == $media_csr_cat) {
        $media_csr_cat_term = $t;
        $logo = get_field('cat_icon', $t);
        if (!$logo) {
            $logo = '/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_csr.png';
        }
    } elseif ($parent_slug->slug == $media_list) {
        $media_list = $t;
        $color = '';
        if (class_exists('Vk_term_color')) {
            $color = Vk_term_color::get_term_color($media_list->term_id);
            $color = ($color) ? ' style="background-color:' . $color . ';"' : '';
        }
    }
}
?>
<div id="archive-media" class="page-information single-homenews page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/">
                                    <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/media/">
                                    <span itemprop="name">メディアコンテンツ</span>
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
            <div class="flame-body w-auto row align-items-start">
                <div class="page-content-innerwrap col-12 col-md-9">
                    <div class="page-content-div">
                        <article>
                            <div class="media-article">
                                <div class="media-article__content align-items-center">
                                    <div class="media-article__content__detail">
                                        <div class="media-article-heder">
                                            <div class="article-status d-flex row align-items-center">
                                                <?php
                                                    $days = 7; // New を表示させたい期間の日数
                                                    $today = date_i18n('U');
                                                    $entry = get_post_time();
                                                    $total = date('U', ($today - $entry)) / 86400;
                                                
                                                    if ($days > $total) :
                                                ?>
                                                    <div class="new text-danger pr-2">NEW</div>
                                                <?php endif; ?>
                                                <div class="date pr-2"><?php echo get_the_date('Y.m.d'); ?></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="sub-category row align-items-center">
                                                    <div class="sub-category__icon">
                                                        <?php
                                                            $cat_icon = get_field('cat_icon', $media_csr_cat_term);
                                                            if ($cat_icon) :
                                                        ?>
                                                            <img src="<?php echo $logo; ?>" alt="<?php echo $media_csr_cat_term->name; ?>">
                                                        <?php else : ?>
                                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/menu/menu_icon_csr.png">
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="sub-category__name">
                                                        <p class="mb-0 news-cat-txt bold pl-2"><?php echo $media_csr_cat_term->name; ?></p>
                                                    </div>
                                                </div>
                                                <div class="media-cat" <?php echo $color; ?>>
                                                    <?php echo $media_list->name; ?>
                                                </div>
                                            </div>
                                            <div class="article-title mb-0">
                                                <?php the_title(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- TODO:タイトル文字数の制限 -->
                            <div class="article-detail">
                                <?php the_content(); ?>
                            </div>
                        </article>
                        <div class="back-button">
                            <a href="/media">
                                <button>一覧へ</button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php get_template_part('templates/searchform-media');?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>