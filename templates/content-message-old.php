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
            <img src="<?php echo CFS()->get('header_image'); ?>" class="pc-bnr">
            <img src="<?php echo CFS()->get('header_image_sp'); ?>" class="sp-bnr">
        </div>
        <div class="page-top__icon">
            <?php if(CFS()->get('title_icon') ): ?>
                <div class="icon-image">
                    <img src="<?php echo CFS()->get('title_icon'); ?>">
                </div>
            <?php endif; ?>
                    <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container">
        <div class="page-content-innerwrap">
            <div class="message">
                <div class="message__image">
                    <div class="director">
                        <img src="/cms/wp-content/themes/zenkosai/assets/images/about/message/director_photo.png" alt="高井 利夫">
                    </div>
                    <p class="mb-0">一般財団法人全国福利厚生共済会</p>
                    <div class="director-detail">
                        <p class="mb-0">代表理事</p>
                            <div class="director-name">
                                <img src="/cms/wp-content/themes/zenkosai/assets/images/about/message/director_name.png" alt="高井 利夫">
                            </div>
                    </div>
                </div>
                <div class="message__detail">
                    <p class="mb-0">私は、歯科技工士として社会人をスタートし、1982年に株式会社髙井デンタルスタジオを設立いたしました。その後、様々なビジネスに携わり、1988年に協同組合近畿ハイウェイセンターを発起設立、中小企業間の助けあいを推進する協同組合事業を中心に全国への事業展開をおこなってきました。その経験の中で、中小企業間の助けあいはもちろんですが、これからは個人の助けあいが必要な時代が来ると思い、「相互扶助事業の全国構築」を目的として2002年に18人の仲間と共に全国福利厚生共済会を創立いたしました。そして、今年20年という節目の年を迎えます。会員口数は20万口を超えるまでに成長し、スケールメリットを活用してライフサポートサービスのさらなる充実を図ることも可能となりました。これもひとえに会員の皆様が全厚済と想いをともにし、ご尽力いただいた結果と心より感謝いたします。</p>
                    <p class="mb-0">また、当会の基本理念の一つである「社会貢献」にも会員の皆様のご賛同をいただき、様々な分野で社会貢献活動をおこなうことができる団体に成長しています。</p>
                    <p class="mb-0">現代社会は社会保障制度の深刻化、少子高齢化、環境問題、貧困層の拡大等の問題が山積みですが、行政に頼るだけではなく、私達自身が問題に真摯に向き合い解決に向けて取り組んでいく必要があると感じます。一人で出来ることには限界がありますが、仲間と協力し、知恵を出しあい助けあうことで様々な問題を乗り切っていけるものと信じております。</p>
                    <p class="mb-0">これからも様々な時代の変化はあると思います。しかし、どんな時代も人と人との助けあいは必要不可欠です。</p>
                    <p class="mb-0">「人と人とが助けあう&nbsp;そんなあたり前なことが&nbsp;あたり前にある日常をかなえたい」という想いで全国福利厚生共済会は、これからも皆様と共に日々精進して参ります。</p>
                </div>

            </div>
            <h3>代表理事について</h3>
                <div class="page-content-div">
                    <?php the_content(); ?>
                </div>
        </div>
    </div>
</div>
<?php get_template_part('templates/about-nav');?>
