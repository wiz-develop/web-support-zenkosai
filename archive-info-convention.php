<?php
/*
 * コンベンションのお知らせ一覧
 */
session_start();
if(!$_SESSION['member_info'] ){
    header("Location: {$home_url}");
    exit;
}
get_header(); ?>
<div id="archive-info-convention" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <?php
                /*-------------------------------------------*/
                /* BreadCrumb
                /*-------------------------------------------*/
                do_action( 'lightning_breadcrumb_before' );
                $old_file_name[] = 'module_panList.php';
                if ( locate_template( $old_file_name, false, false ) ) {
                    locate_template( $old_file_name, true, false );
                } else {
                    get_template_part( 'template-parts/breadcrumb' );
                }
                do_action( 'lightning_breadcrumb_after' );
            ?>
        </div>
        <div class="page-top">
            <div class="page-top__icon">
                <h1 class="mb-0">
                    2026 National Convention <br class="d-sm-none">お知らせ
                </h1>
            </div>
        </div>
    </div>
    <!-- page-header -->

    <div class="page-content-wrapper py-4 mb-5">
        <div class="container">
            <div class="info-convention">
                <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            get_template_part('templates/convention-loop');
                        endwhile;
                    else :
                        echo '<p>現在お知らせはありません。</p>';
                    endif;
                ?>
            </div>
            <!-- ページネーション -->
            <div class="pnavi mt-3 mb-5 mx-auto">
                <?php
                    $count_post = wp_count_posts('info-convention');
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
            <div class="back-button">
                <a href="/national-convention_2026/">
                    <button>2026 National Conventionページへ</button>
                </a>
            </div>
    </div>
</div>
<?php get_footer(); ?>