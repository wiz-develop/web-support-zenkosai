<?php
/*
 * Template Name: キャッシュ削除
 */
get_header(); ?>

<div id="page-cache" class="page-cache page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                    <h1 class="pt-5 mb-0"><?php the_title();?></h1>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <div class="mt-5 pt-5">
        <div class="container my-5">
            <h5 class="bold">■　iphone</h5>
            <h6 class="bold mini-title font-larger p-2 d-inline-block mt-2 mb-3">Safariなどブラウザのデータを消す</h6>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">1</span>「設定」画面の「safari」をクリック
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/iphone1-1.png" alt="">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                        <p class="my-3">
                            <span class="no rounded-circle bold text-center my-3 p-1">2</span>「履歴とWebサイトデータを削除」をクリック
                        </p>
                        <div class="col-8 mx-auto">
                            <img src="/cms/wp-content/uploads/2021/03/iphone1-2.png" alt="">
                        </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">3</span>「履歴とデータを削除」をクリック。<br>
                        <span class="text-danger">こちらの操作をされると自動ログインしていたサイトからはログアウトされるのでご注意ください。</span>
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/iphone1-3.png" alt="">
                    </div>
                </div>
            </div>
            <h6 class="bold mini-title font-larger d-inline-block p-2 mt-5 mb-3">履歴も一緒に削除</h6>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">1</span>「iPhoneストレージ」画面の「safari」をクリック
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/iphone2-1.png" alt="" class="">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">2</span>「Webサイトデータ」をクリック<br>
                            「全Webサイトデータを削除」で全てのサイトのデータを削除一括で削除できます。
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/iphone2-2.png" alt="" class="">
                    </div>
                </div>
            </div>
            <h5 class="bold">■　android</h5>
            <p class="mb-0">機種により対応方法は異なります。<br>
            （ここではgalaxyでのキャッシュ削除の紹介しています。）</p>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">1</span> 設定からお使いのブラウザアプリを選択
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/android1.png" alt="">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">2</span> 「ストレージ」をクリック
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/android2.png" alt="">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 d-flex flex-column justify-content-between">
                    <p class="my-3">
                        <span class="no rounded-circle bold text-center my-3 p-1">3</span> 「キャッシュの削除」にてキャッシュを削除いただけます。
                    </p>
                    <div class="col-8 mx-auto">
                        <img src="/cms/wp-content/uploads/2021/03/android3.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .no{
        display: inline-block;
        width: 30px;
        height: 30px;
        background: #09365d;
        color: white;
        font-size: 1rem;
        line-height: 24px;
    }
    .mini-title{
        border-bottom: 2px solid #09365d;
    }
</style>
<?php get_footer(); ?>
