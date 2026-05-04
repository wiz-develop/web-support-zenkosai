<?php
get_header();
$t = get_term_by('slug', $_GET['csr_cat'], 'csr_cat');
?>

<div class="page-header">
    <div class="container">
        <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/">
                                    <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/social-contribution/">
                                    <span itemprop="name">社会貢献活動</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                                <span itemprop="name"><?php echo $t->name;?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
    </div>
</div>
<div>
    <div class="csr-description container-fluid bg-descript mt-5 mb-2 p-3">
        <div class="container">
            <h3 class="mb-3"><?php echo $t->name;?>とは</h3>
            <div class="csr-cat-wrapper">
                <div class="px-1">
                    <?php the_field('csr_contents', $t); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
        $txt_limit = 1000;
        if( $display_type == 'sp'){
            $txt_limit = 500;
        }
        $t_id = $t->term_id;
        // 投稿の表示条件設定
        $arg = array(
            'posts_per_page' => -1,
            'post_type'      => 'social-contribution',  // カスタム投稿タイプ名
            'tax_query'      => array(
                array(
                    'taxonomy' => 'csr_cat',  // カスタムタクソノミー名
                    'field'    => 'id',  // ターム名を term_id,slug,name のどれで指定するか
                    'terms'    => $t_id // タクソノミーに属するターム名
                )
            ),
            'meta_key'       => 'article_announcing',
            'meta_value'     => 1,
        );
        $posts = get_posts($arg);
    ?>
    <?php if($posts): ?>
        <div class="page-content-div csr-newslist">
            <div class="csr-news container-fluid px-3 px-md-5 pt-3 pb-0 pb-md-3">
                <h3 class="mb-3 container"><span class="csr-title">案内中</span></h3>
                    <div class="news-wrapper container my-0 my-md-3">
                        <!-- TODO：css画像の表示サイズ -->
                        <!-- そのカテゴリの案内中にチェックが入っている記事表示 -->
                        <!-- 768px以下は2記事表示768px以上は3記事表示 -->
                        <?php foreach ($posts as $post): setup_postdata( $post ); ?>
                            <?php
                            $remove_array = ["\r\n", "\r", "\n", " ", "　"];
                            $content = wp_trim_words(strip_shortcodes(get_the_content()), $txt_limit, '…' );
                            $content = str_replace($remove_array, '', $content);
                            ?>
                            <div class="news-div">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="news-innerdiv">
                                        <div class="content-wrapper">
                                            <div class="news-detail open">
                                                <p class="mb-0 news-date col-12 px-0"><?php the_time('Y/m/d') ?></p>
                                                    <div class="news-txt">
                                                        <div class="news-title">
                                                            <p class="mb-0 news-cat-txt bold"><?php the_title(); ?></p>
                                                        </div>
                                                        <div class="news-txtinnerbox">
                                                            <p class="mb-0 news-content"><?php echo $content; ?></p>
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
                    </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if(get_field('csr_contents01', $t)): ?>
        <div class="page-content-div csr-detail">
            <!-- 自由編集(最大3つまで) -->
            <?php for($i = 1; $i <= 3; $i++){ ?>
                <?php if(get_field('csr_title0'.$i, $t) && get_field('csr_contents0'.$i, $t)): ?>
                <div class="csr-free-contants container-fluid p-3 mt-3">
                    <!-- カスタムフィールド：自由編集のタイトル -->
                    <h3 class="mb-3 container"><span class="csr-title"><?php $key ='csr_title0'.$i; the_field($key, $t); ?></span></h3>
                    <div class="csr-free-wrapper container mx-auto">
                        <!-- カスタムフィールド：自由編集の内容が入ってくる -->
                        <p><?php $key ='csr_contents0'.$i; the_field($key, $t); ?></p>
                    </div>
                </div>
                <?php endif; ?>
            <?php } ?>
            <?php if(get_field('csr_linktitle', $t) && get_field('csr_linkcontents', $t)): ?>
            <div class="csr-free-contants container-fluid p-3 mt-3">
                <!-- 外部リンク用 -->
                <h3 class="mb-3 container"><span class="csr-title"><?php the_field('csr_linktitle', $t); ?></span></h3>
                <div class="csr-free-wrapper container mx-auto">
                    <?php the_field('csr_linkcontents', $t); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php
        $year = '';
        $arg = array(
            'posts_per_page' => -1,
            'post_type'      => 'social-contribution',  // カスタム投稿タイプ名
            'tax_query'      => array(
                array(
                    'taxonomy' => 'csr_cat',  // カスタムタクソノミー名
                    'field'    => 'id',  // ターム名を term_id,slug,name のどれで指定するか
                    'terms'    => $t_id // タクソノミーに属するターム名
                )
            )
        );
        $posts = get_posts($arg);
    ?>
    <?php if($posts): ?>
    <div class="page-content-div activity-report bg-lightcsr">
        <div class="csr-posts-index">
            <h3><span class="csr-title">これまでの活動報告</span></h3>
            <div class="csr-posts-wrapper">
                <div class="row">
                <?php foreach ($posts as $post): setup_postdata( $post ); ?>
                    <?php if ($year != get_the_date('Y')): // 同じ年でなければ表示 ?>
                    <?php $year = get_the_date('Y');?>
                    <div class="col-12 col-md-4">
                        <div class="arrow-btn posts-index bg-csr rounded-0 p-2">
                            <a href="/social-contributions/category/activities/?csr_cat=<?php echo $t->slug; ?>&anu=<?php echo $year; ?>">
                                <p class="text-white mb-0 px-2"><?php echo $year; ?>年の活動<span></span></p>
                            </a>
                        </div>
                    </div>
                    <?php endif;?>
                <?php endforeach;?>
                </div>
                <div class="csr-posts-index-btn text-center">
                    <button class="showall-btn" onclick="location.href='/social-contributions/category/activities/?csr_cat=<?php echo $t->slug; ?>'">
                        <p class="mb-0 pr-2">これまでの活動報告一覧を見る</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php get_template_part('templates/csr-nav');?>
</div>