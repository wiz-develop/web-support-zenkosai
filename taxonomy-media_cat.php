<?php
/*
 * メディアコンテンツ一覧ページ
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header(); ?>

<?php
$page_data = get_page_by_path('media-list');
$page_id = $page_data->ID;
$loggedin = is_user_loggedin();
$media_cat = 'media_cat';
?>

<div id="archive-media" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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

                $get_page_id = get_page_by_path("media_contents");
                $get_page_id = $get_page_id->ID;
                $the_content = get_post($get_page_id)->post_content;
                $header_image = $cfs->get('header_image', $get_page_id);
                $header_image_sp = $cfs->get('header_image_sp', $get_page_id);
            ?>
        </div>
        <div class="page-top" <?php if (wp_is_mobile()&&$header_image_sp) { echo 'style="background-image: url('.$header_image_sp.');"'; } elseif (!wp_is_mobile()&&$header_image) { echo 'style="background-image: url('.$header_image.');"'; } ?>>
            <div class="page-top__title">
                <div class="page-top__title__icon">
                    <h1 class="mb-0">全厚済メディアコンテンツ</h1>
                    <?php
                        if ($the_content) :
                            $the_content = apply_filters('the_content', $the_content);
                    ?>
                    <div class="page-about">
                        <p class="mb-0">
                            <?php echo $the_content; ?>
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">   
        <div class="page-content-div">
            <div class="media-content row align-items-start mb-5">
                <div class="article-list col-12 col-md-8">
                    <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                                get_template_part('templates/media-loop');
                            endwhile;
                        else :
                            echo '<p>記事はありません。</p>';
                        endif;
                    ?>
                    <!-- ページネーション -->
                    <div class="pnavi mt-3 mb-3 mb-sm-0 mx-auto">
                        <?php
                            $term = get_queried_object();

                            $pnum = 2;
                            if($display_type == 'sp'){
                                $pnum = 1;
                            }
                            if ($term->count > get_option('posts_per_page')) {
                                echo paginate_links(array(
                                    'mid_size'  => $pnum,
                                    'prev_text' => '<',
                                    'next_text' => '>',
                                    'type'      => 'list'
                                ));
                            }
                        ?>
                    </div><!-- ページネーションここまで -->
                </div>
                <?php get_template_part('templates/searchform-media');?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>