<div class="archive-list info-archive-list col-12 col-md-3 px-md-0">
    <h2 class="text-left">アーカイブ</h2>
    <div class="csr-posts-index px-md-0">
        <h3 class="archive-item acor-menu">年月一覧</h3>
        <div class="csr-posts-wrapper container px-0 pb-4 mx-auto acor-menu-child">
            <?php
                $p_year = '';
                $p_month = '';
                $arg = array(
                    'posts_per_page' => -1,
                    'post_type' => 'social-contribution',
                    'orderby' => 'date',
                    'post_status' => 'publish',
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'csr_cat',
                            'field'    => 'slug',
                            'terms'    => array('csr-topics'),
                            'include_children' => false,
                        ),
                    ),
                );
                $posts = get_posts($arg);
            ?>
            <?php $i = 0; if($posts):
                foreach ($posts as $post): setup_postdata( $post ); ?>
                <?php if ($p_year != get_the_date('Y')): // 同じ年でなければ表示 ?>
                <?php
                    $p_month = '';
                    $p_year = get_the_date('Y');?>
                <?php if ($i != 0){ echo '</div>'; }?>
                    <div class="year-link col-12 p-0 px-0">
                        <div class="arrow-btn posts-index rounded-0 px-2">
                            <a href="<?php echo home_url('/social-contributions/csr-topics/'); ?>?anu=<?php echo $p_year; ?>">
                                <p class=" mb-0 px-2"><?php echo $p_year; ?>年<span></span></p>
                            </a>
                        </div>
                    </div>
                <div class="my-2 pl-2">
                <?php $i++; ?>
                <?php endif;?>
                <?php if ($p_month != get_the_date('M')): // 同じ月でなければ表示 ?>
                    <?php $p_month = get_the_date('M');?>
                    <div class="month-link col-12 p-0 px-0 mt-0">
                        <div class="arrow-btn posts-index rounded-0 pr-2">
                            <a class="py-1" href="<?php echo home_url('/social-contributions/csr-topics/'); ?>?anu=<?php echo $p_year; ?>&mont=<?php $num_month = rtrim($p_month, '月'); echo $num_month; ?>" style="order:<?php echo $num_month; ?>">
                                <p class="mb-0"><i class="fas fa-chevron-circle-right"></i><?php the_date('M'); ?></p>
                            </a>
                        </div>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            </div>
            <?php else: ?>
                <p class="">社会貢献活動からのお知らせはございません。</p>
            <?php endif;?>
        </div>
        <div class="csr-posts-index-btn text-center">
                <button class="showall-btn" onclick="location.href='/social-contributions/csr-topics/'">
                    <p class="mb-0 pr-2">全て表示</p>
                </button>
            </div>
    </div>
</div>