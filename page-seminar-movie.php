<?php
/*
 * Template Name: オンラインセミナー動画
 */
get_header(); ?>

<div id="page-login" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <img src="<?php echo $cfs->get('header_image', $page_id); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp', $page_id); ?>" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                    <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <div class="page-content-wrapper columns pt-0 pt-sm-4">
        <div class="flame-body first">
            <div class="container-fluid">
                <div>
                    <div class="page-content-innerwrap px-0">
                        <div class="page-overview mb-5">
                            <?php echo $cfs->get('overview'); ?>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="page-content-innerwrap precautions p-2 p-sm-4">
                        <h3 class="acor-menu mb-0">【注意事項】<br><i class="fas fa-angle-down"></i></h3>
                        <div class="precautions-txt acor-menu-child">
                            <p class="mb-0 p-2"><?php echo $cfs->get('precautions'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="instructors-list p-2 py-5 mb-5">
                    <div class="page-content-innerwrap text-center mb-0">
                        <h2 class="text-center">講師一覧</h2>
                        <div class="page-content-div row mb-0">
                            <?php
                                $fields = $cfs->get('instructors_list');
                                foreach ($fields as $field) :
                            ?>
                                <a class="page-content col-6 col-sm-4 col-md-3 px-0" href="#<?php echo $field['page_link']; ?>">
                                    <div class="instructors-list-btn-wrap px-1 px-sm-3 py-2 mx-auto mb-2">
                                        <button class="instructors-list-btn">
                                            <p class="mb-0"><?php echo $field['lecturer_name']; ?></p>
                                        </button>
                                    </div>
                                </a>
                            <?php
                                endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php if(is_user_loggedin()):?>
                    <div class="flame-side for-sp-nav col-lg-3 col-12 px-lg-0 mb-4 mb-lg-0">
                        <div class="page-content-innerwrap row col-12 col-sm-11 col-md-12 mx-auto px-md-0">
                            <?php
                                $fields = $cfs->get('instructors_list');
                                foreach ($fields as $field) :
                            ?>
                                <div class="link-btn">
                                    <a href="#<?php echo $field['page_link']; ?>">
                                        <button class="showall-btn">
                                            <p class="mb-0"><?php echo $field['lecturer_name']; ?></p>
                                        </button>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="flame-body <?php if(!(is_user_loggedin())) { echo'mx-auto'; } else { echo'col-lg-9'; } ?> col-12">
                    <div class="instructors-movie">
                        <?php
                            $fields = $cfs->get('instructors_list');
                            foreach ($fields as $field) :
                        ?>
                            <div id="<?php echo $field['page_link']; ?>" class="page-content-innerwrap">
                                <h4><?php echo $field['lecturer_name']; ?></h4>
                                <div class="page-content-div">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <?php
                                                $movies = $field['movie_list'];
                                                foreach ((array)$movies as $movie):
                                            ?>
                                                <div class="page-content seminar-video col-12 col-sm-6 mb-5 mb-sm-5 cursor-pointer">
                                                    <h5 class="m-0 p-0 text-center"><?php echo $movie['movie_title']; ?></h5>
                                                    <!-- <div class="movie-thumbnail"> -->
                                                        <iframe src="<?php echo $movie['movie_url']; ?>" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                                    <!-- </div> -->
                                                </div>
                                            <?php
                                                endforeach;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(function($){
    // $(document).on('click', '.seminar-video', function(){
    //     url = $(this).data('video');
    //     $('.s-pop-up-child iframe#seminar-video-player').attr("src", url);
    //     $('.s-pop-up-child').removeClass('d-none');
    // });
    // $(document).on('click', '.s-close-modal', function(){
    //     $('.s-pop-up-child iframe#seminar-video-player').attr("src", "");
    //     $('.s-pop-up-child').addClass('d-none');
    // });
    // $(document).on('click', '.s-pop-up-child', function(e){
    //     if($(e.target).hasClass('s-pop-up-child')||$(e.target).hasClass('s-close-modal')){
    //         $('.s-pop-up-child iframe#seminar-video-player').attr("src", "");
    //         $('.s-pop-up-child').addClass('d-none');
    //     }
    // });
    var windowWidth = window.innerWidth;
    $('.acor-menu').addClass('opened');
    $('.acor-menu-child').addClass('opened');
    $('.acor-menu-child').css('display','block');
    if(windowWidth <= 576){
        $('.acor-menu').removeClass('opened');
        $('.acor-menu-child').removeClass('opened');
    }
});
</script>
<?php get_footer(); ?>
