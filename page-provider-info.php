<?php
/*
 * Template Name: サービス提供会社からのお知らせ一覧
 */
if ($_POST['prime_app_flg']) {
    if (!$_POST['member_id'] || !$_POST['password']) {
        wp_redirect(home_url('/'));
        exit;
    }
    $member_info = make_session_member_info($_POST, $_POST['password']);
    set_session_member_info($member_info, $posts_unread);
}
get_header();

$loggedin = is_user_loggedin();
?>
<div id="archive-provider" class="page-wrapper page-provider-information <?php echo $display_type; ?> <?php echo $login; ?>">
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
    </div>
    <!-- page-header -->

    <div class="page-content-wrapper">
    <?php
        // 年・月別表示
        $date = [];
        if($_GET['anu']){
            $date[0]['year']= (int)$_GET['anu'];
        }
        if($_GET['mont']){
            $date[0]['month']= (int)$_GET['mont'];
        }
        $paged = (int) get_query_var('paged');
        $provider_arg = array(
            'paged' => $paged,
            'posts_per_page' => 10,
            'post_type' => array('information', 'provider-information'),
            'meta_query' => array(
                array(
                    'key' => 'provider_service',
                    'value' => '',
                    'compare' => '!=',
                ),
            ),
            'orderby' => 'date',
            'post_status' => 'publish',
            'date_query' => $date,
        );
        $provider_posts = new WP_Query($provider_arg);
    ?>
    <div class="page-content-wrapper columns"> 
        <section class="page-content-div info-content">
            <div class="container">
                <div class="lifesupport-info">
                    <h1 class="mb-4">
                        <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/lifesupport/news-icon.png"></span>
                        サービス提供会社からのお知らせ
                    </h1>
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-8">
                            <div class="lifesupport-info__list mt-0">
                                <?php
                                    if ($provider_posts->have_posts()) :
                                        while ( $provider_posts->have_posts() ) : $provider_posts->the_post();
                                            get_template_part( 'templates/provider-loop' );
                                        endwhile;
                                    else :
                                ?>
                                    <p class="mb-0 text-center">お知らせはございません。</p>
                                <?php endif; wp_reset_postdata(); ?>
                            </div>
                            <div class="pnavi mt-3">
                                <?php
                                if ($provider_posts->max_num_pages > 1) {
                                    echo paginate_links(array(
                                        'format'    => '?paged=%#%',
                                        'current'   => max(1, $paged),
                                        'mid_size'  => 2,
                                        'total'     => $provider_posts->max_num_pages,
                                        'prev_text' => '<',
                                        'next_text' => '>',
                                        'type'      => 'list'
                                    ));
                                }
                                ?>
                            </div>
                            <?php if ($date) : ?>
                                <div class="activities-link mt-4 mx-auto">
                                    <a href="/provider-info/">
                                        <div class="activities-link__name">
                                            サービス提供会社のお知らせ一覧へ戻る
                                        </div>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="activities-link mt-4 mx-auto">
                                    <a href="/lifesupport/">
                                        <div class="activities-link__name">
                                            ライフサポートサービス一覧へ戻る
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                         <?php get_template_part('templates/provider-archive');?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php get_footer(); ?>