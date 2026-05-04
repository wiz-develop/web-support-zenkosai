<div class="archive-list info-archive-list col-12 col-md-3 px-md-0">
    <h2>アーカイブ</h2>
    <div class="csr-posts-index px-md-0">
        <h3 class="archive-item acor-menu">カテゴリー</h3>
        <div class="csr-posts-wrapper container px-0 pb-4 mx-auto acor-menu-child">
            <?php foreach (get_terms('news', array('parent' => 0, 'hide_empty' => false, 'orderby' => 'id')) as $t):?>
                <?php
                // ログイン前は「送付物」、「ビジネス」、「キャンペーン」に関するお知らせを表示しない。
                if(!($_SESSION['member_info'])){
                    $t_id =  $t->term_id;
                    $attatchment = get_term_by('slug','attatchment','news');
                    $attatchment_id = $attatchment->term_id;
                    $business = get_term_by('slug','business','news');
                    $business_id = $business->term_id;
                    $campaign = get_term_by('slug','campaign','news');
                    $campaign_id = $campaign->term_id;
                    if($t_id == $attatchment_id || $t_id == $business_id || $t_id == $campaign_id ){
                        continue;
                    }
                }
                ?>
                <div class="month-link col-12 p-0 px-0 mt-0">
                    <div class="arrow-btn posts-index rounded-0 px-2">
                        <a href="/information/?cate=<?php echo $t->slug; ?>">
                            <p class="mb-0"><i class="fas fa-chevron-circle-right"></i><?php echo $t->name; ?></p>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
                <div class="month-link col-12 p-0 px-0 mt-0">
                    <div class="arrow-btn posts-index rounded-0 px-2">
                        <a href="/information/?cate=important">
                            <p class="mb-0"><i class="fas fa-chevron-circle-right"></i>重要なお知らせ</p>
                        </a>
                    </div>
                </div>
                <div class="month-link col-12 p-0 px-0 mt-0">
                    <div class="arrow-btn posts-index rounded-0 px-2">
                        <a href="/information/?cate=update">
                            <p class="mb-0"><i class="fas fa-chevron-circle-right"></i>更新情報</p>
                        </a>
                    </div>
                </div>
        </div>
    </div>
    <div class="csr-posts-index px-md-0">
        <h3 class="archive-item acor-menu">年月一覧</h3>
        <div class="csr-posts-wrapper container px-0 pb-4 mx-auto acor-menu-child">
            <?php
                $p_year = '';
                $p_month = '';
                $arg = array(
                    'posts_per_page' => -1,
                    'post_type'      => array('information','social-contribution'),
                    'meta_query'=> array(
                        array(
                            'relation' => 'OR',
                            array(
                                'key'     =>'update_information',
                                'compare' => 'NOT EXISTS',
                            ),
                            array(
                                'key'     =>'update_information',
                                'value'   => '0', //true,falseの1
                                'compare' => '=',
                            ),
                        ),
                        array(
                            'relation' => 'OR',
                            array(
                                'key'     =>'display_information',
                                'compare' => 'NOT EXISTS',
                            ),
                            array(
                                'key'     =>'display_information',
                                'value'   => '1', //true,falseの1
                                'compare' => '=',
                            ),
                        ),
                    ),
                );
                if(!($_SESSION['member_info'])){
                    $attatchment = get_term_by('slug','attatchment','news');
                    $attatchment_id = $attatchment->term_id;
                    $business = get_term_by('slug','business','news');
                    $business_id = $business->term_id;
                    $campaign = get_term_by('slug','campaign','news');
                    $campaign_id = $campaign->term_id;
                    $arg = array_merge($arg, array(
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'news',
                                'field' => 'id',
                                'terms' => array($attatchment_id,$business_id,$campaign_id,),
                                'operator' => 'NOT IN',
                            )
                        ),
                    ));
                }
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
                            <a href="/information/?anu=<?php echo $p_year; ?>">
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
                            <a class="py-1" href="/information/?anu=<?php echo $p_year; ?>&mont=<?php $num_month = rtrim($p_month, '月'); echo $num_month; ?>" style="order:<?php echo $num_month; ?>">
                                <p class="mb-0"><i class="fas fa-chevron-circle-right"></i><?php the_date('M'); ?></p>
                            </a>
                        </div>
                    </div>
                <?php endif;?>
            <?php endforeach;?>
            </div>
            <?php else: ?>
                <p class="">インフォメーションございません。</p>
            <?php endif;?>
        </div>
        <div class="csr-posts-index-btn text-center">
                <button class="showall-btn" onclick="location.href='/information/'">
                    <p class="mb-0 pr-2">全て表示</p>
                </button>
            </div>
    </div>
</div>