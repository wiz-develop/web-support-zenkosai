<?php
/*
 *  あうる一覧ページ
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header();

$get_aul_page_data = get_page_by_path("aul");
$aul_page_id = $get_aul_page_data->ID;
?>

<div id="archive-aul" class="page-aul page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container-fluid">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo home_url(); ?>">
                                    <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/aul/">
                                    <span itemprop="name">会報誌aul【あうる】専用ページ</span>
                                </a>
                            </li>
                            <li>
                                <span>会報誌aul【あうる】お楽しみ企画</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top aul-archive_header">
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image', $aul_page_id); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp', $aul_page_id); ?>" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <?php if(CFS()->get('title_icon', $aul_page_id) ): ?>
                    <div class="icon-image">
                        <img src="<?php echo CFS()->get('title_icon', $aul_page_id); ?>">
                    </div>
                <?php endif; ?>
                    <h1 class="mb-0">会報誌aul【あうる】お楽しみ企画</h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="page-content-innerwrap">
            <div class="archive-aul-plan bg-white mt-4">
                <div class="plan-content container d-block">
                    <div class="plan-content__body page-content-div row">
                        <?php
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                        ?>
                            <div class="plan-article_list col-12 col-lg-6">
                                <?php get_template_part('templates/aul-archive-loop'); ?>
                            </div>
                        <?php
                                endwhile;
                            else :
                                echo '<p>記事はございません。</p>';
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>
                    <!-- ページネーション -->
                    <div class="pnavi mt-3 mb-5 mx-auto">
                        <?php
                            $count_post = wp_count_posts('aul-archive');
                            $count_posts = $count_post->publish;
                            $pnum = 2;
                            if($display_type == 'sp'){
                                $pnum = 1;
                            }
                            if ($count_posts > get_option('posts_per_page')) {
                                echo paginate_links(array(
                                    'mid_size'  => $pnum,
                                    'prev_text' => '<',
                                    'next_text' => '>',
                                    'type'      => 'list'
                                ));
                            }
                        ?>
                    </div><!-- ページネーションここまで -->
                    <div class="activities-link mt-4 mx-auto">
                        <a href="/aul/">
                            <div class="activities-link__name">会報誌aul【あうる】専用ページへ戻る</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>