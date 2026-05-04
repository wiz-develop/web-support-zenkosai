<?php
/*
 * Template Name: コンベンション予告
 */
session_start();

// P会員以外をホームへ遷移
if($_SESSION['member_info']['member_type'] !== 'p_member' ){
    wp_redirect(home_url('/'));
    exit;
}
require_once(get_stylesheet_directory().'/api/judge_login.php');
require_once(get_stylesheet_directory().'/api/get_membertree_result.php');
$membertree = get_membertree_date();

get_header(); ?>


<div id="page-convention" class="<?php echo $display_type; ?> <?php echo $login; ?>">
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
        <div class="page-top text-center">
            <div class="page-top__title">
                <div class="page-top__title__main">
                    <h1><?php echo $cfs->get('year');?>年<span class="d-block"><?php the_title(); ?></span></h1>
                </div>
                <div class="page-top__title__ornament">
                    <img src="/cms/wp-content/themes/zenkosai/assets/images/convention/page_tit_ornament.png">
                </div>
            </div>
            <div class="page-top__title">
                <h2 class="text-center"><?php echo $cfs->get('movie_title');?></h2>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper">
        <div class="page-content-innerwrap">
            <div class="page-content-div">
                <div class="movie-detail">
                    <?php echo $cfs->get('movie_detail');?>
                </div>
                <?php
                    $advertisement_pdf = $cfs->get('advertisement_pdf');
                    if ($advertisement_pdf) :
                ?>
                <div class="movie-link dm">
                    <a href="<?php echo $advertisement_pdf;?>" target="_blank" class="d-flex justify-content-between align-items-center gtm-click-link" data-gtm-click="<?php echo strip_tags($cfs->get('year')); ?>年 National Conveention チラシダウンロード">
                        <div class="movie-link__pdf-tit">
                            <?php echo $cfs->get('year');?>年 National Convention <span>チラシダウンロード</span>
                        </div>
                        <div class="movie-link__dl-icon">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/convention/dl-icon.png">
                        </div>
                    </a>
                </div>
                <?php
                    endif;
                    $ticket_pdf = $cfs->get('ticket_pdf');
                    if ($ticket_pdf) :
                ?>
                <div class="movie-link ticket">
                    <a href="<?php echo $ticket_pdf;?>" target="_blank" class="d-flex justify-content-between align-items-center gtm-click-download" data-gtm-click="コンベンションチケット抽選購入について">
                        <div class="movie-link__pdf-tit">
                            コンベンションチケット<span>抽選購入について</span>
                        </div>
                        <div class="movie-link__dl-icon">
                            <img src="/cms/wp-content/themes/zenkosai/assets/images/convention/dl-icon.png">
                        </div>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="page-content-div">
                <div class="pop-up" class="gtm-click-link" data-gtm-click="<?php echo strip_tags($cfs->get('movie_title')); ?>">
                    <div class="movie-th">
                        <img src="<?php echo $cfs->get('movie_th');?>">
                    </div>
                    <div class="movie-play-btn">
                        <img src="/cms/wp-content/themes/zenkosai/assets/images/convention/play-btn.png" alt="再生">
                    </div>
                </div>
                <div class="pop-up-child">
                    <div class="movie">
                        <div class="movie__item">
                            <video id="movie-play" controls webkit-playsinline="" playsinline="" controlslist="nodownload" poster="<?php echo $cfs->get('movie_th');?>" preload="auto">
                                <source src="<?php echo $cfs->get('movie');?>" type="video/mp4">
                            </video>
                        </div>
                        <div class="close-modal text-center font-large cursor-pointer">
                            <i class="fas fa-times pr-2"></i><span>閉じる</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content-innerwrap">
            <div class="page-content-div">
                <div class="event-title d-flex justify-content-between align-items-center">
                    <div class="event-title__ornament">
                        <img src="/cms/wp-content/themes/zenkosai/assets/images/convention/tit_ornament_l.png">
                    </div>
                    <h2><?php echo $cfs->get('notice_title');?></h2>
                    <div class="event-title__ornament">
                        <img src="/cms/wp-content/themes/zenkosai/assets/images/convention/tit_ornament_r.png">
                    </div>
                </div>
                <div class="event-image">
                    <img src="<?php echo $cfs->get('event-image');?>">
                </div>
            </div>
            <div class="page-content-div">
                <div class="event-catch">
                    <h3><?php echo $cfs->get('notice_catch');?></h3>
                </div>
                <div class="event-detail">
                    <div class="event-detail__txt">
                        <?php echo $cfs->get('event_detail');?>
                    </div>
                    <?php
                        $event_pdf = $cfs->get('event_pdf');
                        if ($event_pdf) :
                    ?>
                    <div class="event-detail__link">
                        <a href="<?php echo $event_pdf;?>" target="_blank" class="gtm-click-download" data-gtm-click="<?php echo $cfs->get('year');?>年<?php the_title(); ?> 詳細はこちら">
                            <div class="event-detail__link__item">
                                詳細はこちら
                            </div>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
