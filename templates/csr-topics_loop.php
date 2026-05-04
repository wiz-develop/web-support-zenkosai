<?php 
    global $login;
    $csr_info_nologin = CFS()->get('csr_info_nologin', $post->ID);
?>
<?php if ($login || !$csr_info_nologin): ?>
    <?php $terms = get_the_terms(get_the_ID(), 'csr_cat'); ?>
    <a class="csr-topics-content__list__item" href="<?php the_permalink(); ?>">
        <div class="csr-topics-content__list__item__about">
            <div class="news-txtinnerbox d-flex align-items-center">
                <?php
                    $days_limit = 7;
                    $post_time = get_the_time('U');
                    $current_time = current_time('timestamp');
                    if ( ($current_time - $post_time) <= (60*60*24*$days_limit) ) {
                        echo '<div class="new">NEW</div> ';
                    }
                ?>
                <div class="news-date">
                    <p class="mb-0"><?php the_time('Y/m/d') ?> 更新</p>
                </div>
            </div>
            <div class="news-title">
                <p class="mb-0"><?php echo get_the_title(); ?></p>
            </div>
        </div>
    </a>
<?php endif; ?>