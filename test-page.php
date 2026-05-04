<?php
/*
 * Template Name: テスト用ページテンプレート
 */
get_header(); ?>

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
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image'); ?>">
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
    </div><!-- page-header -->
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap">
                <img src="/cms/wp-content/uploads/2024/04/サムネ.jpg" alt="テスト用画像" class="no-screenshot" onselectstart="return false;" onmousedown="return false;">
                <div>
                    <ul>
                        <li>印刷時に画像を非表示にする</li>
                        <li>PCでのスクリーンショットに関わるキー「shift」「PrintScreen」「Win」をクリックしたときに画像を非表示</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
<style>
    .no-screenshot {
        /* PCのクリック禁止 */
        pointer-events: none;
        /* SPの長押し禁止 */
        -webkit-touch-callout:none;
        -webkit-user-select:none;
        -moz-touch-callout:none;
        -moz-user-select:none;
        user-select:none;
    }
    .prohibit {
        opacity: 0;
        visibility: hidden;
    }
    @media print {
        .no-screenshot {
            opacity: 0;
            visibility: hidden;
        }
    }
</style>
<script type="text/javascript">
jQuery(function($){
    // キーを押したとき
    $(window).on('keydown', function(e){
        var keyCode = e.keyCode;
        
        if(keyCode == 16 || keyCode == 44 || keyCode == 91 || keyCode == 92){
            $('.no-screenshot').addClass('prohibit');
            return false;
        }
    });
    
    // キーを離したとき
    $(window).on('keyup', function(){
        $('.no-screenshot').removeClass('prohibit');
    });
});
</script>

<!-- アプリ
https://qiita.com/Nkot117/items/34e425958ecef25b6f4e -->