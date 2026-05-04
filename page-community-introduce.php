<?php
/*
 * Template Name: 全厚済コミュニティ　サービス紹介ページ
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header(); ?>


<div id="page-community-introduce" class="<?php echo $display_type; ?> <?php echo $login; ?>">
    <!-- <div class="page-header"> -->
    <div>
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
        <div class="container">
            <div class="page-top">
                <div class="page-top__title mx-auto mt-4 d-block">
                    <h1>
                        <img src="/cms/wp-content/themes/zenkosai/assets/images/lifesupport/community/community-title.png" alt="全厚済コミュニティ">
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content-wrapper pb-5">
        <div class="container">
            <section id="intro-friendshop" class="page-content-div px-3 py-4 bg-white mb-4">
                <h2 class="text-center mb-2">
                    <span class="intro-title-bg px-3">会員様同士の交流を<br class="d-sm-none">会員様のお店で</span>
                </h2>
                <div class="row align-items-center">
                    <div class="intro-banner col-sm-5 col-12">
                        <a href="/lifesupport/friendshop-shopping/">
                            <img class="w-100" src="/cms/wp-content/themes/zenkosai/assets/images/lifesupport/community/friendshop-banner.png" alt="フレンドショップ">
                        </a>
                    </div>
                    <div class="col-sm-7 col-12">
                        <dl class="pl-3 pl-sm-0">
                            <dt>フレンドショップ店舗掲載無料！</dt>
                            <dd class="mb-3">店舗掲載時にお店を利用する会員様への会員特典をご用意ください。</dd>
                            <dt>お店の利⽤時に会員カードを提⽰すると、会員特典が受けられる！</dt>
                            <dd class="mb-3">フレンドショップサイトでお店を検索するとお店ごとの特典の記載があります。</dd>
                            <dt>クーポンは、お店の利用時に提示するだけ！​</dt>
                            <dd>お店側の精算もスマートフォンもしくはタブレットで読み込む、もしくはクーポンコードを入力するだけ。​</dd>
                        </dl>
                    </div>
                </div>
                <div class="friend-campaign-text p-3 my-3">
                    <p class="mb-2 font-weight-bold text-md-center text-left">
                        <span class="font-larger">2,000円クーポンを<span class="text-danger">毎月500名</span>にプレゼント！</span>
                    </p>
                    <p class="font-smaller mb-0 text-md-center text-left">※毎月1日10時に、当選者にはフレンドショップサイトのマイアカウントにクーポンが表示されます。</p>
                </div>
                <div class="link-text p-3 text-center">
                    <p class="mb-2 mb-md-0 font-weight-bold">フレンドショップ店舗随時募集中！</p>
                </div>
            </section>
            <section id="intro-memberboard" class="page-content-div px-3 py-4 bg-white mb-4">
                <h2 class="text-center mb-2">
                    <span class="intro-title-bg px-3">社会貢献・レクリエーション・<br class="d-lg-none">新たな⼈脈作りの発信に</span>
                </h2>
                <div class="row align-items-center">
                    <div class="intro-banner col-sm-5 col-12">
                        <a href="/lifesupport/memberboard/">
                            <img class="w-100" src="/cms/wp-content/themes/zenkosai/assets/images/lifesupport/community/memberboard-banner.png" alt="メンバーボード">
                        </a>
                        <p class="zenkosai-comment mt-3 mx-auto mb-0">
                            <span class="d-inline-block mx-auto">全厚済も参加募集を投稿します！</span>
                        </p>
                    </div>
                    <div class="col-sm-7 col-12">
                        <dl class="mb-0 pl-3 pl-sm-0">
                            <dt>会員間で使⽤できる掲⽰板です。</dt>
                            <dd class="mb-3">「ボランティア活動やバーベキューの参加者募集。」<br>
                                「専⾨分野に⻑けた⽅に仕事をお願いしたい。」<br>
                                「お店のメニューについて意⾒を聞きたい。」など使い⽅は様々。</dd>
                            <dt>シンプルな仕組みで便利な機能で参加者募集も簡単</dt>
                            <dd class="mb-3">
                                <ol class="pl-3 mt-0 mb-2">
                                    <li class="mb-0">募集記事を投稿</li>
                                    <li class="mb-0">記事を⾒た希望者は「参加希望」ボタン</li>
                                    <li class="mb-0">投稿者に参加者⼀覧が表⽰されます。</li>
                                </ol>
                                さらに、投稿者は参加希望者⼀覧から⼀括でお知らせメールを送信！</dd>
                            <dt>安⼼のメール配信</dt>
                            <dd>全厚済のアドレスを経由するため、お互いのメールアドレスは交換不要。</dd>
                        </dl>
                    </div>
                </div>
            </section>
            <section id="intro-lifeseminar" class="page-content-div px-3 py-4 bg-white">
                <h2 class="text-center mb-2">
                    <span class="intro-title-bg px-3">様々な分野のセミナーを通じ、<br class="d-sm-none">価値観の共有を</span>
                </h2>
                <div class="row align-items-center">
                    <div class="intro-banner col-sm-5 col-12">
                        <a href="/lifesupport/lifeseminar/">
                            <img class="w-100" src="/cms/wp-content/themes/zenkosai/assets/images/lifesupport/community/lifeseminar-banner.png" alt="ライフセミナー">
                        </a>
                    </div>
                    <div class="col-sm-7 col-12">
                        <dl class="mb-0 pl-3 pl-sm-0">
                            <dt>オンラインセミナーを無料で視聴</dt>
                            <dd class="mb-3">仕事のスキルアップから⽇々の⽣活に役⽴つ情報まで、様々な分野の専⾨の⽅からたくさんの学びを得られます。<br>
                                ※⼀部有料セミナーあり</dd>
                            <dt>全厚済ホームページで予約から視聴までできてとっても簡単！</dt>
                            <dd>視聴のためのアカウント登録などありません。<br>
                                全厚済ホームページからリアルタイムでセミナー視聴できます。</dd>
                        </dl>
                    </div>
                </div>
                <div class="seminar-examples mt-3 p-3 bg-light">
                    <p class="seminar-examples__title mb-0 py-1 px-2">たとえば、こんなセミナーを開催！</p>
                    <ul class="seminar-examples__list row list-unstyled mb-0">
                        <li class="col-lg-6 col-12">
                            <div class="bg-white">
                                <p class="mb-0 py-1 px-3 font-weight-bold">体調管理もできる耳つぼ活用術！<br class="d-sm-none">見た目の印象で終わらせない！</p>
                                <p class="mb-0 py-1 px-3">東京五輪でも選手に導入！<br class="d-sm-none">耳から健康と美にアプローチ</p>
                            </div>
                        </li>
                        <li class="col-lg-6 col-12">
                            <div class="bg-white">
                                <p class="mb-0 py-1 px-3 font-weight-bold">伝えたい事が伝わる話し方！<br class="d-sm-none">活舌お悩み克服！</p>
                                <p class="mb-0 py-1 px-3">コールセンターお客様満足度NO.1の実績で、声優や企業ナレーションに従事。</p>
                            </div>
                        </li>
                        <li class="col-lg-6 col-12">
                            <div class="bg-white">
                                <p class="mb-0 py-1 px-3 font-weight-bold">働くママ・パパのためのライフプラン</p>
                                <p class="mb-0 py-1 px-3">将来のライフイベントに掛かる費用と国の制度を学ぼう。</p>
                            </div>
                        </li>
                        <li class="col-lg-6 col-12">
                            <div class="bg-white">
                                <p class="mb-0 py-1 px-3 font-weight-bold">今年こそトライしたい！<br class="d-sm-none">ふるさと納税セミナー</p>
                                <p class="mb-0 py-1 px-3">ふるさと納税や税金対策を学んで、資産形成の一歩を踏みだ出そう！</p>
                            </div>
                        </li>
                        <li class="col-lg-6 col-12">
                            <div class="bg-white">
                                <p class="mb-0 py-1 px-3 font-weight-bold">知ってると差がつく！介護とお金の制度活用術</p>
                                <p class="mb-0 py-1 px-3">人生100年時代到来！<br class="d-sm-none">第2の人生を楽しく過ごすためのコツとは？</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
    </div>
</div>
<?php get_footer(); ?>
