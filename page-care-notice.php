<?php
/*
 * Template Name: 『全厚済ケアプラス保険』・『全厚済がんサポート保険』告知内容
 */
get_header(); ?>
<style>
.breadcrumb li:nth-child(2) {
    display: none;
}
</style>
<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
            <!-- <div class="page-top__back">
                <img src="<?php // echo $cfs->get('header_image'); ?>" class="pc-bnr">
                <img src="<?php // echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
            </div> -->
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                    <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper columns pt-0">
        <div class="container d-block">
            <div class="flame-body">
                <div class="page-content-innerwrap">
                    <?php the_content(); ?>
                        <?php
                            $fields = $cfs->get('faq_list');
                            if ($fields) :
                        ?>
                        <div class="page-content-div"><!-- よくあるご質問 -->
                            <h3>よくあるご質問</h3>
                            <?php foreach ($fields as $field) : ?>
                                <div class="page-content-innerdiv service-note faq">
                                    <button class="btn btn-primary acor-menu">
                                        <div class="question">
                                            <div class="question__mark">Q</div>
                                            <div class="question__detail">
                                                <p class="mb-0 pl-0"><?php echo $field['question']; ?></p>
                                            </div>
                                            <div class="question__answer">
                                                <p class="mb-0"><span class="text-danger">回答</span><br><span class="questioner-toggle-txt">を見る</span></p><!-- 回答が開いてるときはjsで「を見る」を「閉じる」に変わるように -->
                                            </div>
                                        </div>
                                    </button>
                                    <!-- <div class="acor-menu-child" id=""> -->
                                        <div class="card card-body acor-menu-child">
                                            <div class="answer">
                                                <div class="answer__mark">A</div>
                                                <div class="answer__detail clearfix">
                                                    <p class="mb-0"><?php echo $field['answer']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>