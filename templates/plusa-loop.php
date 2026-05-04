<?php $plusa_period_text = CFS()->get('plusa_period_text'); ?>
<article class="plusa-article">
    <div class="plusa-article__content">
        <h2 class="plusa-article__content__title mb-2 border-bottom border-secondary">
            <?php the_title(); ?>
        </h2>
        <div class="row">
            <div class="plusa-article__content__image col-12 col-sm-4">
                <a href="<?php echo CFS()->get('plusa_link'); ?>" target="_blank" class="gtm-click-link" data-gtm-click="<?php the_title(); ?>">
                    <img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>">
                </a>
            </div>
            <div class="plusa-article__content__detail col-12 col-sm-8">
                <div class="article-detail font-weight-bold">
                    <?php the_content(); ?>
                </div>
                <?php if ($plusa_period_text) : ?>
                <div class="article-period mt-3">
                    <p class="mb-0"><?php echo $plusa_period_text; ?></p>
                </div>
                <?php
                    endif;
                    $terms = get_the_terms(get_the_ID(), 'plusa_tag');
                    if ( $terms ) :
                ?>
                <div class="article-tags mt-1 d-flex">
                    <?php foreach ( $terms as $index => $term ) : ?>
                        <p class="border border-info rounded-pill py-1 px-2 mx-1 text-info">
                            <?php echo $term->name; ?>
                        </p>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</article>