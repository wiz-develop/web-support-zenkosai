<?php
/*
 * Template Name: 社会貢献活動のお知らせ一覧
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
<div id="archive-provider" class="page-wrapper page-provider-information csr-topics-content pb-0 <?php echo $display_type; ?> <?php echo $login; ?>">
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
        $csr_arg = array(
            'paged' => $paged,
            'posts_per_page' => 10,
            'post_type' => 'social-contribution',
            'orderby' => 'date',
            'post_status' => 'publish',
            'date_query' => $date,
            'tax_query' => array(
                array(
                    'taxonomy' => 'csr_cat',
                    'field'    => 'slug',
                    'terms'    => 'csr-topics',
                ),
            ),
        );
        if (!$login) {
            $csr_arg['meta_query'] = array(
                'relation' => 'OR',
                array(
                    'key'     => 'csr_info_nologin',
                    'compare' => 'NOT EXISTS',
                ),
                array(
                    'key'     => 'csr_info_nologin',
                    'value'   => '0',
                    'compare' => '=',
                ),
            );
        }
        
        $csr_topics_posts = new WP_Query($csr_arg);
    ?>
    <div class="page-content-wrapper columns"> 
        <section class="page-content-div info-content cst-topics_bg">
            <div class="container">
                <div class="lifesupport-info csr">
                    <h1 class="mb-4">
                        社会貢献活動のお知らせ
                    </h1>
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-8">
                            <div class="csr-topics-content__list mt-0">
                                <?php
                                    if ($csr_topics_posts->have_posts()) :
                                        while ( $csr_topics_posts->have_posts() ) : $csr_topics_posts->the_post();
                                            get_template_part( 'templates/csr-topics_loop' );
                                        endwhile;
                                    else:
                                        echo '<p class="mb-0 text-center">お知らせはございません。</p>';
                                    endif;

                                    wp_reset_postdata();
                                ?>
                            </div>
                            <div class="pnavi mt-3">
                                <?php
                                if ($csr_topics_posts->max_num_pages > 1) {
                                    echo paginate_links(array(
                                        'format'    => '?paged=%#%',
                                        'current'   => max(1, $paged),
                                        'mid_size'  => 2,
                                        'total'     => $csr_topics_posts->max_num_pages,
                                        'prev_text' => '<',
                                        'next_text' => '>',
                                        'type'      => 'list'
                                    ));
                                }
                                ?>
                            </div>
                            <?php if ($date) : ?>
                                <div class="activities-link mt-4 mx-auto">
                                    <a href="/social-contribution/topics/">
                                        <div class="activities-link__name">
                                            社会貢献活動のお知らせ一覧へ戻る
                                        </div>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="activities-link mt-4 mx-auto">
                                    <a href="/social-contribution/">
                                        <div class="activities-link__name">
                                            社会貢献活動トップへ戻る
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                         <?php get_template_part('templates/csr-topics-archive');?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<?php get_footer(); ?>