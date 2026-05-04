<?php
    $days = 7; // New を表示させたい期間の日数
    $today = date_i18n('U');
    $entry = get_post_time();
    $total = date('U', ($today - $entry)) / 86400;

    $name = '';
    $cat = '';
    $terms = get_the_terms(get_the_ID(), 'media_cat');
    foreach ($terms as $term) {
        $has_parent = $term->parent;
        $parent_slug = get_term($has_parent, 'media_cat');
    
        if ($parent_slug->slug == 'media_list') {
            $media_list = $term->name;
            $color = '';
            if (class_exists('Vk_term_color')) {
                $color = Vk_term_color::get_term_color($media_list->term_id);
                $color = ($color) ? ' style="background-color:' . $color . ';"' : '';
            }
        } else if ($parent_slug->slug == 'media_csr_cat') {
            $media_csr_cat = $term->name;
            $media_csr_cat_term = $term;
        }
    }
?>
<div class="media-article">
    <a href="<?php the_permalink(); ?>">
        <div class="media-article__content d-flex align-items-center justify-content-between">
            <div class="media-article__content__detail">
                <div class="media-article-heder">
                    <div class="article-status d-flex row align-items-center">
                        <?php if ($days > $total) : ?>
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
                                <img src="<?php echo $cat_icon; ?>">
                                <?php else : ?>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/menu/menu_icon_csr.png">
                                <?php endif; ?>
                            </div>
                            <div class="sub-category__name">
                                <?php echo $media_csr_cat; ?>
                            </div>
                        </div>
                        <div class="media-cat" <?php echo $color; ?>>
                            <?php echo $media_list; ?>
                        </div>
                    </div>
                    <div class="article-title mb-0">
                        <?php the_title(); ?>
                    </div>
                </div>
                <div class="article-detail">
                    <p class="mb-0"><?php the_excerpt(); ?></p>
                </div>
                <div class="article-link row align-items-center">
                    <div class="article-link__detail">
                        <span>続きを読む</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                            <g transform="translate(8176.361 -1665.095)">
                                <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <?php $thumbnail = get_the_post_thumbnail_url(); ?>
            <div class="media-article__content__image">
                <?php if ($thumbnail) : ?>
                    <img src="<?php echo $thumbnail; ?>" alt="<?php the_title(); ?>">
                <?php else : ?>
                    <img src="/cms/wp-content/themes/zenkosai/assets/images/icons/csr/paper-bg.png" alt="<?php the_title(); ?>">
                <?php endif; ?>
            </div>
        </div>
    </a>
</div>