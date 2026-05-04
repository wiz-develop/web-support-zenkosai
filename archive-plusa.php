<?php
/*
 *  プラスa一覧ページ
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header(); ?>

<div id="page-plusa" class="page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
            <div class="page-top__back">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/plusa/plusa_top.jpg" class="pc-bnr">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/plusa/plusa_sp-top.jpg" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <h1 class="mb-0"><?php the_archive_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <?php
        $today = wp_date('Y-m-d');

        // 開催中
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'plusa',
            'post_status' => 'publish',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'plusa_period_start',
                    'value' => $today,
                    'compare' => '<=',
                    'type' => 'DATE',
                ),
                array(
                    'key' => 'plusa_period_end',
                    'value' => $today,
                    'compare' => '>=',
                    'type' => 'DATE',
                ),
            ),
        );
        $posts = get_posts($args);

        // 終了
        $end_args = array(
            'posts_per_page' => -1,
            'post_type' => 'plusa',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'plusa_period_end',
                    'value' => $today,
                    'compare' => '<',
                    'type' => 'DATE',
                ),
            ),
        );
        $end_posts = get_posts($end_args);

        // 開催準備中
        $start_args = array(
            'posts_per_page' => -1,
            'post_type' => 'plusa',
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => 'plusa_period_start',
                    'value' => $today,
                    'compare' => '>',
                    'type' => 'DATE',
                ),
            ),
        );
        $start_posts = get_posts($start_args);
    ?>
    <div class="page-content-wrapper columns">
        <div class="page-content-innerwrap">
            <div class="<?php if (!is_mobile()) { echo 'container'; } ?> d-block">
                <div class="page-content-div d-flex mb-5 w-100">
                    <button class="plusa-status plusa-active d-block" data-status="underway">開催中<br class="d-block d-sm-none">（<?php echo count($posts); ?>件）</button>
                    <button class="plusa-status d-block" data-status="end">終了<br class="d-block d-sm-none">（<?php echo count($end_posts); ?>件）</button>
                    <button class="plusa-status d-block" data-status="preparation">開催準備中<br class="d-block d-sm-none">（<?php echo count($start_posts); ?>件）</button>
                </div>
            </div>
            <div class="container d-block">
                <div class="page-content-div">
                    <!-- <div class="col-9"> -->
                        <div id="plusa-list">
                            <?php
                                if ($posts) {
                                    foreach ( $posts as $post ) : setup_postdata( $post );
                                        get_template_part('templates/plusa-loop');
                                    endforeach;
                                } else {
                                ?>
                                    <p class="mb-0">現在開催中のキャンペーンはございません。</p>
                                <?php
                                }
                                wp_reset_postdata();
                            ?>
                        </div>
                    <!-- </div> -->
                    <!-- <div class="col-3">
                        <img src="/cms/wp-content/uploads/2022/05/kentou.png" alt="検索">
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>