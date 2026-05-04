<?php
/*
 * Template Name: コンペンション動画ページ
 */
get_header(); ?>

<div id="page-conpension" class="page-conpension page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img class="w-100" src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                    <h1 class="mb-0 members p-2"><?php the_title();?></h1>
            </div>
        </div>
    </div>
    </div>
    <div class="content">
        <div class="container">
            <!-- <php the_content(); ?> -->
            <div class="mt-5">
                <div class="msg_area p-3 rounded07 mb-4">
                    <p>2020年、日常の生活を一変させた新型コロナウイルス感染症の発生から1年が過ぎ、<br>
                    感染予防の対策をとりつつ世の生が動きはじめた今、2021ナショナルコンベンションで皆様へご報告させていただきたかったことを動画にしてお送することといたしました。<br>
                    ぜひ会報誌、パンフレット、ホームページなどとあわせてご覧ください。</p>
                    <p>2022年には20周年という節目を迎える全厚済は、これからさらに社会に貢献できる団体として、<br>
                    また、より良いサービスを提供できる団体として成長して参ります。</p>
                    <p>皆様のおかげでコロナ禍の2020年を乗り越えることができたことに感謝を込めて･･･。</p>
                </div>
            </div>
        </div>
        <div class="container-fluid　px-0">
            <div class="d-flex flex-column zenpen align-items-center py-5">
                <p class="zenpen-title font-larger d-inline-block px-3">全編再生</p>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/QMT2-UWRkXU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="container pt-5">
                <div class="row">
                    <div class="col-12 col-sm-6 my-3 mx-auto text-center">
                        <div>1.一般財団法人全国福利厚生共済会<br>代表理事あいさつ</div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/oRktTLc1l00" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-12 col-sm-6 my-3 mx-auto text-center">
                        <div>2.一般財団法人全国福利厚生共済会<br>専務理事あいさつ</div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/fX7LogK4tqU" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-12 col-sm-6 my-3 mx-auto text-center">
                        <div>3.社会貢献活動についてのご報告<br>　</div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/qqibHIjytIQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="col-12 col-sm-6 my-3 mx-auto text-center">
                        <div>4.ライフサポートサービスなどのご報告<br class="d-none d-md-block">　</div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/wgrxRkUj4ZQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<style>
    .zenpen{
        background: aliceblue;
    }
    .zenpen-title{
        border-bottom: 2px solid gray;
    }
    .list_mokuji:before{
        content:  "";     /* 空の要素作成 */
    }
    .list_mokuji {
        padding:  10px;             /* 余白指定 */
        padding-left: 40px;
        background-color:  #e2d998; /* 背景色指定 */
        border-radius:  10px;       /* 角丸指定 */
        margin-bottom: 5px;         /* 要素と要素の間指定 */
        color: #000000;                /* 文字色指定 */
    }
    .msg_area{
        display: flex;
        align-items: left;
        flex-direction: column;
    }
    ul{
        list-style: none;
    }
    .page-top__back{
        background: #c1e2ff;
        height: 21vh;
    }
</style>
