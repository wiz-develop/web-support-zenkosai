<?php
/*
 * Template Name: 会報誌aul【あうる】専用ページ
 */
get_header(); ?>

<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
<div class="page-header mb-5">
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
                <img src="<?php echo $cfs->get('header_image'); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <h1 class="mb-0"><?php the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <div class="page-content-innerwrap">
            <div class="container">
                <div class="page-content-div row mb-5">
                    <?php
                        $aul_archive_data = $cfs->get('aul_archive_data');
                        if ($aul_archive_data[0]) :
                    ?>
                    <article class="first-magazine_content col-12 col-lg-6">
                        <div class="magazine-item row">
                            <div class="magazine-about col-6">
                                <h2 class="pl-3 mb-3" style="border-left: solid 5px <?php echo $aul_archive_data[0]['aul_archive_title_border']; ?>"><?php echo $aul_archive_data[0]['aul_archive_title']; ?></h2>
                                <p class="pl-3"><?php echo $aul_archive_data[0]['aul_archive_overview']; ?></p>
                                <a href="<?php echo $aul_archive_data[0]['aul_archive_link']; ?>" class="gtm-click-link" data-gtm-click="会報誌aul【あうる】<?php echo strip_tags($aul_archive_data[0]['aul_archive_number']); ?>">
                                    <div class="aul-link">
                                        <button class="px-3 py-2 ml-3">
                                            <p class="mb-0 d-flex align-items-center">
                                                <?php echo $aul_archive_data[0]['aul_archive_number']; ?><span class="pl-1 pr-2">を読む</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                    <g transform="translate(-0.11)">
                                                        <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                        <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                    </g>
                                                </svg>
                                            </p>
                                        </button>
                                    </div>
                                </a>
                                <div class="brights-report_link mt-2">
                                    <a href="<?php echo $aul_archive_data[0]['brights-report_link']; ?>" target="_link">
                                        <img src="<?php echo $aul_archive_data[0]['brights-report_btn']; ?>">
                                    </a>
                                </div>
                                <div class="next-shipping text-center mt-3 p-2" style="background-color: <?php echo $cfs->get('aul_send_bg_color'); ?>;">
                                    <p class="mb-0" style="color: <?php echo $cfs->get('aul_send_tx_color'); ?>;"><?php echo $cfs->get('aul_archive_text'); ?></p>
                                </div>
                            </div>
                            <div class="magazine-img col-6">
                                <img src="<?php echo $aul_archive_data[0]['aul_archive_image']; ?>" alt="<?php echo strip_tags($aul_archive['aul_archive_title']); ?>">
                                <p class="shipping-date mb-0 text-right"><?php echo $aul_archive_data[0]['aul_archive_send']; ?><span class="pl-1">発送</span></p>
                            </div>
                        </div>   
                    </article>
                    <?php endif; ?>
                    <div class="magazine-list col-12 col-lg-6">
                        <?php
                            if ($aul_archive_data[1]) :
                            foreach ($aul_archive_data as $index => $aul_archive) :
                                if ($index > 0) :
                        ?>
                            <article class="second-magazine_content">
                                <div class="magazine-item row">
                                    <div class="magazine-about col-7 col-lg-8">
                                        <h2 class="pl-2 mb-2" style="border-left: solid 5px <?php echo $aul_archive['aul_archive_title_border']; ?>"><?php echo $aul_archive['aul_archive_title']; ?></h2>
                                        <p class="pl-3"><?php echo $aul_archive['aul_archive_overview']; ?></p>
                                        <a href="<?php echo $aul_archive['aul_archive_link']; ?>" class="gtm-click-link" data-gtm-click="会報誌aul【あうる】<?php echo strip_tags($aul_archive['aul_archive_number']); ?>">
                                            <div class="aul-link">
                                                <button class="px-3 py-2 ml-3">
                                                    <p class="mb-0 d-flex align-items-center">
                                                        <?php echo $aul_archive['aul_archive_number']; ?><span class="pl-1 pr-2">を読む</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                                            <g transform="translate(-0.11)">
                                                                <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"/>
                                                                <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"/>
                                                            </g>
                                                        </svg>
                                                    </p>
                                                </button>
                                            </div>
                                        </a>
                                        <div class="brights-report_link arc mt-2">
                                            <a href="<?php echo $aul_archive['brights-report_link']; ?>" target="_link">
                                                <img src="<?php echo $aul_archive['brights-report_btn']; ?>">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="magazine-img col-5 col-lg-4">
                                        <img src="<?php echo $aul_archive['aul_archive_image']; ?>" alt="<?php echo strip_tags($aul_archive['aul_archive_title']); ?>">
                                        <p class="shipping-date mb-0 text-right"><?php echo $aul_archive['aul_archive_send']; ?><span class="pl-1">発送</span></p>
                                    </div>
                                </div>
                            </article>
                        <?php endif; endforeach; endif; ?>
                    </div>
                </div>
            </div>
            <section class="archive-aul-plan py-5">
                <?php
                    $args = array(
                        'posts_per_page' => 6, //TODO:最大12記事までの表示でいいか要確認
                        'post_type' => 'aul-archive',
                        'post_status' => 'publish',
                    );
                    $posts = get_posts($args);
                ?>
                <div class="plan-content container">
                    <div class="plan-content__header border-bottom mb-4">
                        <h2><?php echo $cfs->get('aul_plan_tit_en'); ?><span><?php echo $cfs->get('aul_plan_tit'); ?></span></h2>
                    </div>
                    <div class="plan-content__body page-content-div row">
                        <?php
                            if ($posts) {
                                foreach ( $posts as $post ) : setup_postdata( $post );
                        ?>
                            <div class="plan-article_list col-12 col-lg-6">
                                <?php get_template_part('templates/aul-archive-loop'); ?>
                            </div>
                        <?php
                                endforeach;
                            } else {
                            ?>
                                <p class="mb-0">記事はございません。</p>
                            <?php
                            }
                            wp_reset_postdata();
                        ?>
                    </div>
                    <div class="activities-link mt-4 mx-auto">
                        <a href="/aul-archive/">
                            <div class="activities-link__name">他の企画を見る</div>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<?php get_footer(); ?>