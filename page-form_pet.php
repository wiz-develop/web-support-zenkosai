<?php
/*
 * Template Name: ペット保険 全厚済会員特典の申込みフォーム
 */
global $post;
get_header();

// console_log(CFS()->get('csv'));
// $csv = CFS()->get('pet_csv');
    
// // // ファイルを開く
// $fp = fopen($csv, 'r');
// $numbers = [];
// // // 1行ずつ読み込む
// while($line = fgetcsv($fp)){
//     if(preg_match('/^([0-9]{10})$/', $line[0])) {
//         array_push($numbers, $line[0]);
//     }
// }
// console_log($numbers);
// // // ファイルを閉じる
// fclose($fp);

?>

<?php
    $m_id   = $_SESSION['member_info']['member_id'];
    $m_name = $_SESSION['member_info']['member_name'];
?>
<div id="page-form_pet" class="page-form_pet page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/">
                                    <span itemprop="name">
                                        <i class="fa fa-home"></i> HOME
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a itemprop="item" href="#">
                                    <span itemprop="name">
                                        ペット保険
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a itemprop="item" href="/lifesupport-list/pet-privilege">
                                    <span>
                                        全厚済会員特典の申込みフォーム
                                    </span>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top mb-4">
            <div class="row align-items-center">
                <div class="page-top__img col-12 col-lg-3 p-0">
                    <?php if(wp_is_mobile()) : ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/head-t_sp.png">
                    <?php else : ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/head-l_pc.png">
                    <?php endif; ?>
                </div>
                <div class="page-top__about col-12 col-lg-6 px-0">
                    <div class="pet_logo w-75 mx-auto">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/pet_tit.png?ver=20240118" alt="いぬとねこの保険">
                    </div>
                    <p class="mb-0">ペット保険ご契約いただいた方に<span class="d-block">オリジナルロゴ入りグッズをプレゼント！</span></p>
                    <div class="pet-zenkosai_logo w-50 mx-auto">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/pet_zenkosai_logo.png" alt="PET×ZENKOSAI">
                    </div>
                </div>
                <div class="page-top__img col-12 col-lg-3 p-0">
                    <?php if(wp_is_mobile()) : ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/head-b_sp.png">
                    <?php else : ?>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/head-r_pc.png">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <div class="page-content-innerwrap">
            <div class="content mt-5">
                <div class="content__header container">
                    <div class="page-about">
                        <p class="mb-0">新規ご加入いただいた全厚済会員様に会員特典としてオリジナルロゴ入りグッズをプレゼントいたします。<span class="d-block">お手元に保険証券が届きましたら、以下のフォームより会員特典をお申込みください。</span></p>
                    </div>
                    <div class="page-note rounded px-4 my-5">
                        <div class="page-note__tit">
                            <p class="mb-0 text-center">- ご注意 -</p>
                        </div>
                        <div class="page-note__about">
                            <ul class="p-0">
                                <li class="mb-0">会員特典は新規加入の特典となりますのでプラン変更や更新時などは対象外とさせていただきます</li>
                                <li class="mb-0">多頭契約の場合は証券（契約）ごとに特典をお受取りいただけます</li>
                                <li class="mb-0">会員特典のお受取りには、保険加入後に受取り申込みが必要です</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content__body">
                    <div class="privilege-about position-relative">
                        <div class="privilege-about__detail row align-items-center">
                            <div class="privilege-about__detail__txt col-12 col-lg-6 text-center">
                                <p class="sub-catch mb-0">ご加入者全員プレゼント</p>
                                <div class="main-catch my-3">
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/eco-back_tit.svg">
                                </div>
                                <p class="remarks mb-0">カラー：ライトブルー<span class="d-block">材質：ポリプロピレン</span><span class="d-block">サイズ：W410 × H500mm</span></p>
                            </div>
                            <div class="privilege-about__detail__img col-12 col-lg-6">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/eco_back.png">
                            </div>
                        </div>
                        <div class="privilege-about__plus text-center">
                            <p class="sub-catch mb-0">さらに<span class="d-block">ゴールド（ライト）プランまたはプラチナ（ネクスト）プランにご加入の方は</span></p>
                            <p class="privilege-about__plus__detail">もう<span class="quantity pl-2">1</span><span class="pr-2">点</span>特典をプレゼント！</p>
                        </div>
                        <div class="privilege-about__plan rounded bg-white mb-4">
                            <p class="plan-name gold rounded-top mb-0 text-center">ゴールド（ライト）プラン</p>
                            <div class="privilege-about__plan__item-list row">
                                <div class="privilege-item col-12 col-lg-3">
                                    <p class="privilege-item__name">オーガニックコットンタオル<span class="d-block">DCLバスタオル（ハーフサイズ）</p>
                                    <div class="privilege-item__img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/half-towel.png">
                                    </div>
                                    <div class="privilege-item__note">
                                        <p class="mb-0">カラー：<span class="d-block">無地ネイビー（帯封ロゴ）</span><span class="d-block">サイズ：約34cm×約120㎝</span><span class="d-block">重さ：160ｇ　材質：綿100％</span></p>
                                    </div>
                                </div>
                                <div class="privilege-item col-12 col-lg-1 d-flex justify-content-center align-items-center">
                                     <p class="next text-canter mb-0">or</p>
                                </div>
                                <div class="privilege-item col-12 col-lg-3">
                                    <p class="privilege-item__name">マグカップ</p>
                                    <div class="privilege-item__img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/mug.png">
                                    </div>
                                    <div class="privilege-item__note">
                                        <p class="mb-0">材質：セラミック<span class="d-block">容量：３５０ｍｌ</span></p>
                                    </div>
                                </div>
                                <div class="privilege-item col-12 col-lg-1 d-flex justify-content-center align-items-center">
                                     <p class="next text-canter mb-0">or</p>
                                </div>
                                <div class="privilege-item col-12 col-lg-3">
                                    <p class="privilege-item__name">フードボウル</p>
                                    <div class="privilege-item__img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/food-bowl.png">
                                    </div>
                                    <div class="privilege-item__note">
                                        <p class="mb-0">材質：セラミック<span class="d-block">サイズ：直径161㎜　高さ67㎜</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="privilege-about__plan rounded bg-white">
                            <p class="plan-name platinum rounded-top mb-0 text-center">プラチナ（ネクスト）プラン</p>
                            <div class="privilege-about__plan__item-list row">
                                <div class="privilege-item col-12 col-lg-3">
                                    <p class="privilege-item__name">マグカップ&<span class="d-block">フードボウル</span></p>
                                    <div class="privilege-item__img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/mug-bowl.png">
                                    </div>
                                    <div class="privilege-item__note">
                                        <p class="mb-0">【マグカップ】<span class="d-block">材質：セラミック</span><span class="d-block pb-5">容量：３５０ｍｌ</span><span class="d-block">【フードボウル】</span><span class="d-block">材質：セラミック</span><span class="d-block">サイズ：直径161㎜高さ67㎜</span></p>
                                    </div>
                                </div>
                                <div class="privilege-item col-12 col-lg-1 d-flex justify-content-center align-items-center">
                                     <p class="next text-canter mb-0">or</p>
                                </div>
                                <div class="privilege-item col-12 col-lg-3">
                                    <p class="privilege-item__name">オーガニックコットンタオル<span class="d-block">DCLバスタオル（フルサイズ）</p>
                                    <div class="privilege-item__img">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/bath-towel.png">
                                    </div>
                                    <div class="privilege-item__note">
                                        <p class="mb-0">カラー：<span class="d-block">無地ブラウン（帯封ロゴ）</span><span class="d-block">サイズ：約60cm×約120㎝</span><span class="d-block">重さ：255ｇ　材質：綿100％</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pet-insurance">
                            <a href="https://www.nihonpet.co.jp/landingpage/zenkosai/" target="_blank">
                                <button class="rounded-pill">かんたん見積り・お申込み・<br class="d-block d-sm-none">資料請求はこちらから<span class="d-block"><small>（日本ペット少額短期保険のページへ）</small></span></button>
                            </a>
                        </div>
                        <div class="privilege-about__bg position-absolute">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/form/pet-privilege/pet_bg_last.png">
                        </div>
                    </div>
                    <div class="privilege-form">
                        <div class="privilege-form__content">
                            <?php echo do_shortcode('[mwform_formkey key="27672"]'); ?>
                            <?php the_content() ?>
                        </div>
                    </div>
                    <div class="privilege-send">
                        <div class="privilege-send__tit">
                            <p class="mb-0">特典の発送時期について</p>
                        </div>
                        <div class="privilege-send__about">
                            <p class="mb-0">全厚済会員特典お申込みフォーム送信後、初回保険料のお支払いが確認でき次第、順次発送をいたします。<span class="d-block">※特典に関するお問合せは、恐れ入りますが以下に記載の「日本共済株式会社　保険事業部」までご連絡をいただきますようお願いいたします。</span></p>
                        </div>
                        <div class="privilege-send__sender">
                            <p class="privilege-send__sender__tit mb-0"><u>発送元</u></p>
                            <p class="privilege-send__sender__about mb-0">日本共済株式会社　保険事業部<span class="d-block">TEL　0120-990-011　（平日10時～17時）</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
<script>
jQuery(function($){
    // 会員IDを入力する
    console.log('sxad');
    var m_id = <?php echo (int)$m_id; ?>;
    $('input#member_id').val(m_id);

    // 会員氏名を入力する
    var m_name = <?php echo "'".$m_name."'"; ?>;
    $('input#member_name').val(m_name);

    // 会員IDと会員氏名欄を読み取り飲みに設定
    $('.readonly').attr('readonly',true);
});
</script>
