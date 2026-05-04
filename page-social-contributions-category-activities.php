<?php
/*
 * Template Name: 社会貢献活動ー活動一覧
 */
get_header(); ?>

<?php $t = get_term_by('slug', $_GET['csr_cat'], 'csr_cat');?>
<div id="new-csr">
    <div class="csr csr-category csr-activities-index page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                                <li>
                                    <span>これまでの活動報告</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-top">
                <div class="page-top__back">
                    <img src="<?php echo $cfs->get('header_image'); ?>" class="pc-bnr">
                    <img src="<?php echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
                </div>
                <div class="page-top__icon">
                    <?php if($cfs->get('title_icon') ): ?>
                        <div class="icon-image">
                            <img src="<?php echo $cfs->get('title_icon'); ?>">
                        </div>
                    <?php endif; ?>
                            <h1 class="mb-0">
                                <span>
                                    <?php echo get_the_title(); ?>
                                </span>
                            </h1>
                </div>
            </div>
        </div>
        <div class="page-content-div csr-newslist">
            <div class="csr-news container d-block">
                <div class="row">
                    <div class="article-list col-12 col-md-9">
                        <div class="container-fluid">
                            <div class="row news-wrapper mb-4">
                                <?php
                                    // 表示文字数制限用
                                    $txt_limit = 300;
                                    if( $display_type == 'sp'){
                                        $txt_limit = 300;
                                    }
                                    // タームID
                                    $t_id = $t->term_id;
                                    // 年・月別表示
                                    $date = [];
                                    if($_GET['anu']){
                                        $date[0]['year']= $_GET['anu'];
                                    }
                                    if($_GET['mont']){
                                        $date[0]['month']= $_GET['mont'];
                                    }
                                    $paged = (int) get_query_var('paged');
                                    // 投稿の表示条件設定
                                    $arg = array(
                                        'paged'          => $paged,
                                        'posts_per_page' => 10,
                                        'post_type'      => 'social-contribution',  // カスタム投稿タイプ名
                                        'tax_query'      => array(
                                            array(
                                                'taxonomy' => 'csr_cat',  // カスタムタクソノミー名
                                                'field'    => 'term_id',  // ターム名を term_id,slug,name のどれで指定するか
                                                'terms'    => $t_id // タクソノミーに属するターム名
                                            ),
                                        ),
                                        'date_query'     => $date,
                                    );
                                    $posts = get_posts($arg);
                                ?>
                                <?php 
                                    if($posts):
                                    foreach ($posts as $post):
                                    setup_postdata( $post );
                                    $is_hidden = CFS()->get('csr_info_nologin', $post->ID);
                                    if ( !empty($is_hidden) && !is_user_loggedin() ) {
                                        continue; 
                                    }
                                ?>
                                <?php
                                        $remove_array = ["\r\n", "\r", "\n", " ", "　"];
                                        $content = wp_trim_words(strip_shortcodes(get_the_content()), $txt_limit, '…' );
                                        $content = str_replace($remove_array, '', $content);
                                        ?>
                                    <div class="news-div w-100">
                                        <a href="<?php the_permalink(); ?>">
                                            <div class="news-innerdiv">
                                                <div class="content-wrapper csr-activities">
                                                    <div class="news-detail">
                                                            <div class="news-title">
                                                                <p class="mb-0 news-cat-txt bold"><?php the_title(); ?></p>
                                                            </div>
                                                            <div class="article-detail">
                                                                <?php if(has_post_thumbnail()){
                                                                    echo '<div class="article-img">';
                                                                    the_post_thumbnail(array( 200, 150 ),array( 'class' => 'mx-auto' ));
                                                                    echo'</div>';
                                                                }?>
                                                                <div class="news-txt">
                                                                    <div class="news-txtinnerbox">
                                                                        <p class="mb-0 news-content"><?php echo $content; ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="news-link mx-auto text-center mt-2">
                                                        <div class="news-more">
                                                            <div class="news-txt_bg"></div>
                                                                <button class="news-btn">
                                                                    <p class="mb-0">続きを読む</p>
                                                                </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="col-12 col-md-10">投稿記事はありません。</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="pnavi mt-3">
                            <?php
                            $the_query = new WP_Query($arg);
                            if ($the_query->max_num_pages > 1) {
                                echo paginate_links(array(
                                    'base'      => get_pagenum_link(1) . '%_%',
                                    'format'    => '&paged=%#%',
                                    'current'   => max(1, $paged),
                                    'mid_size'  => 2,
                                    'total'     => $the_query->max_num_pages,
                                    'prev_text' => '<',
                                    'next_text' => '>',
                                    'type'      => 'list'
                                ));
                            } ?>
                        </div>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <!-- アーカイブ -->
                    <div class="archive-list col-12 col-md-3">
                        <div class="csr-posts-index px-md-0">
                            <div class="csr-posts-wrapper container px-0 pb-4 mx-auto">
                                <?php
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

                                    $is_hidden_side = CFS()->get('csr_info_nologin', $post->ID);
                                    if ( (empty($login) || $login === 'guest') && !empty($is_hidden_side) ) {
                                        continue; 
                                    }
                                ?>
                                    <?php if ($p_year != get_the_date('Y')): // 同じ年でなければ表示 ?>
                                    <?php
                                        $p_month = '';
                                        $p_year = get_the_date('Y');?>
                                    <?php //if ($i != 0){ echo '</div>'; }?>
                                    <div class="year-link col-12 py-2 px-0 mt-0">
                                        <div class="arrow-btn posts-index bg-csr rounded-0 p-2">
                                            <a href="/social-contributions/category/activities/?csr_cat=<?php echo $t->slug; ?>&anu=<?php echo $p_year; ?>">
                                                <p class="text-white mb-0 px-2"><?php echo $p_year; ?>年の更新<span></span></p>
                                            </a>
                                        </div>
                                    </div>
                                    <!--<div class="col-12 my-2 d-flex flex-column">-->
                                    <?//php $i++; ?>
                                    <?//php endif;?>
                                    <?//php if ($p_month != get_the_date('M')): // 同じ月でなければ表示 ?>
                                    <?//php $p_month = get_the_date('M');?>
                                        <!--<a class="py-1" href="/social-contributions/category/activities/?csr_cat=<?//php echo $t->slug; ?>&anu=<?//php echo $p_year; ?>&mont=<?//php $num_month = rtrim($p_month, '月'); echo $num_month; ?>" style="order:<?//php echo $num_month; ?>">-->
                                            <!--<p class="mb-0">▶︎　<?//php the_date('M'); ?></p>-->
                                        <!--</a>-->
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
        <?php get_template_part('templates/csr-nav-new');?>
    </div>
</div>
<?php get_footer(); ?>
