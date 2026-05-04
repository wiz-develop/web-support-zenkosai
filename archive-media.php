<?php
/*
 * メディアコンテンツ一覧ページ
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$login_slug = 'login';
$login_page = get_page_by_path($login_slug);
$login_url = $login_page ? get_permalink($login_page->ID) : home_url( '/' . trim( $login_slug, '/' ) . '/' );

$post_id = get_queried_object_id();
$current_slug = $post_id ? get_post_field( 'post_name', $post_id ) : '';

$is_restrict = false;
if ( function_exists( 'CFS' ) && $post_id ) {
    $val = CFS()->get( 'restrict_page', $post_id );
    if ( $val === true || $val === 'true' || $val === '1' || $val === 1 ) {
        $is_restrict = true;
    } elseif ( $val ) {
        $is_restrict = true;
    }
}

if ( $is_restrict && empty( $_SESSION['member_info'] ) ) {

    if ( $current_slug !== 'session-expired' && ( $login_page ? $post_id !== $login_page->ID : $current_slug !== $login_slug ) ) {

        if ( ! empty( $_SESSION['logout_info']['flag'] ) && $_SESSION['logout_info']['flag'] === 'timeout' ) {
            wp_safe_redirect( home_url( '/session-expired/' ) );
            exit;
        }

        if ( empty( $_SESSION['redirect_after_login'] ) ) {
            $current_url = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $_SESSION['redirect_after_login'] = $current_url;
        }

        wp_safe_redirect( $login_url );
        exit;
    }
}
get_header(); ?>

<?php
$page_data = get_page_by_path('media-list');
$page_id = $page_data->ID;
$loggedin = is_user_loggedin();
?>

<div id="archive-media" class="page-wrapper <?php echo $display_type; ?> <?php echo $loggedin; ?>">
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
            <div class="page-top__title container">
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
                <div class="article-list col-12 col-md-9">
                    <!-- <?php
                        // $paged = get_query_var('page') ? get_query_var('page') : 1;
                        // $media_arg = array(
                        //     'paged' => $paged,
                        //     'posts_per_page' => 2,
                        //     'post_type' => 'media',
                        //     'orderby' => 'date',
                        //     'post_status' => 'publish',
                        // );
                        // $media_posts = new WP_Query($media_arg);
                        // $max_num_pages = $media_posts->max_num_pages;
                        // if ( $media_posts->have_posts() ) :
                        //     while ( $media_posts->have_posts() ) : $media_posts->the_post();
                        //         get_template_part('templates/media-loop');
                        //     endwhile;
                        //     wp_reset_postdata();
                        // else :
                    ?>
                        <p>記事はありません。</p>
                    <?php //endif; ?> -->
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
                            $count_post = wp_count_posts('media');
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
                </div>
                <?php get_template_part('templates/searchform-media');?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>


