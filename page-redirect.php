<?php
/*
 * Template Name: 外部サイトリダイレクト用テンプレート
 */
session_start();
if (!$_SESSION['member_info'] || !isset($_GET['site'])) {
    wp_redirect(home_url('/'));
    exit;
}

$member_id = $_SESSION['member_info']['member_id'];
$member_id = substr($member_id, -8, 8);
$member_type = $_SESSION['member_info']['member_type'];

$referer = $_SERVER['HTTP_REFERER'];
$url = parse_url($referer);

$site = '';
if(isset($_GET['site'])) {
    $site = $_GET['site'];
}

$businsess_pages = array('hansoku', 'membertree', 'comission_meisai', 'comission_tyousyo', 'seminar_lecturer', 'seminar', 'intromember', 'managemember', 'registermember', 'fubi', 'ws_file');
get_header(); ?>

<div id="page-redirect" class="page-redirect page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="page-top">
            <div class="page-top__back">
                <img src="/cms/wp-content/uploads/2021/03/page-top_sp.jpg">
            </div>
            <div class="page-top__icon">
                <h1 class="mb-0">
                    <?php
                    if ($site == 'mypage') {
                        echo 'マイページ';
                    } else if (in_array($site, $businsess_pages)) {
                        echo 'ビジネス関連ページ';
                    } else {
                        echo '外部サイト';
                    }
                    ?>へ遷移します
                </h1>
            </div>
        </div>
    </div>
    <!-- page-header -->
    <div class="loading loading-circle"></div>
    <div id="message" class="d-none text-center">
        <div class="activities-link mt-4 mx-auto">
            <a href="<?php if ($referer) { echo $referer; } else { echo home_url('/'); } ?>">
                <div class="activities-link__name">前のページへ戻る</div>
            </a>
        </div>
    </div>
    <!-- <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap">
                <div>
                    <p class="mb-0">遷移中...</p>
                </div>
            </div>
        </div>
    </div> -->
    <div class="d-none">
        <button id="site-mypage" class="mypage_form" data-formid="submitMypage" data-formabout="mypage">
            マイページ
        </button>
        <button id="site-membertree" class="mypage_form" data-formid="submitMypage" data-formabout="membertreepre">
            組織図
        </button>
        <button id="site-comission_meisai" class="mypage_form" data-formid="submitMypage" data-formabout="comission_meisai">
            コミッション明細書
        </button>
        <button id="site-comission_tyousyo" class="mypage_form" data-formid="submitMypage" data-formabout="comission_tyousyo">
            年間支払額報告書
        </button>
        <button id="site-intromember" class="mypage_form" data-formid="submitMypage" data-formabout="intromember">
            新規会員紹介
        </button>
        <button id="site-managemember" class="mypage_form" data-formid="submitMypage" data-formabout="managemember">
            紹介メールの登録状況の確認・削除
        </button>
        <button id="site-registermember" class="mypage_form" data-formid="submitMypage" data-formabout="registermember">
            サービス受領者の登録
        </button>
        <button id="site-fubi" class="mypage_form" data-formid="submitMypage" data-formabout="fubi">
            新規申込者の不備一覧
        </button>
        <button id="site-ws_file" class="get-info" data-name="ws_file" data-type="get-info">
            WS資料
        </button>
        <button id="site-seminar_lecturer" class="seminar_form" data-formid="submitMypage" data-formabout="seminar_lecturer">
            PBS講師紹介動画
        </button>
        <button id="site-seminar" class="seminar_form" data-formid="submitMypage" data-formabout="seminar">
            セミナー予約・チケット確認
        </button>
        <p id="site-hansoku" class="js_form_btn">
            <a href="javascript:void(0)" data-formid="submit_shop">販促品注文サイト</a>
        </p>
        <p id="site-mall" class="js_form_btn">
            <a href="javascript:void(0)" data-formid="submit_mall">全厚済モール</a>
        </p>
        <p id="site-offtime" class="js_form_btn">
            <a href="javascript:void(0)" data-formid="submit_offTime">全厚済Off Time</a>
        </p>
        <p id="site-friendshop" class="js_form_btn">
            <a href="javascript:void(0)" data-formid="submit_fs_shop">フレンドショップ</a>
        </p>
        <p id="site-offtime" class="js_form_btn">
            <a href="javascript:void(0)"  data-formid="submit_offTime">全厚済Off Time</a>
        </p>
        <a href="javascript:void(0)" id="site-suit" class="seminar_form" data-formid="submitMypage" data-formabout="order_made_suit">
            オーダーメイドスーツ
        </a>
        <p id="site-member_board" class="js_form_btn">
            <a href="javascript:void(0)" data-formid="member_board_login">メンバーボード</a>
        </p>
        <p id="site-muteki" class="js_form_btn">
            <a href="javascript:void(0)" data-formid="submit_muteki">スマホ・タブレット無敵保証</a>
        </p>
        <a href="javascript:void(0)" id="site-life_seminar" class="seminar_form" data-formid="submitMypage" data-formabout="life_seminar">
            ライフセミナー
        </a>
    </div>
</div>

<?php wp_footer(); ?>
<?php if(isset($_GET['site'])) : ?>
<script>
    jQuery(function($){
        <?php if ($site == 'mypage') : ?>
            document.getElementById('site-mypage').click();
        <?php elseif (in_array($site, $businsess_pages)) : ?>
            <?php if ($member_type == 'p_member') : ?>
                var id_name = 'site-'+'<?php echo $site; ?>';
                document.getElementById(id_name).click();
            <?php else : ?>
                p_member_alert();
            <?php endif; ?>
        <?php elseif ($site == 'namecard') : ?>
            <?php if ($member_type == 'p_member') : ?>
                const entries = performance.getEntriesByType('navigation');
                entries.forEach((entry) => {
                if (entry.type !== 'back_forward') {
                    window.location.href = "https://bizcard-print.com/Login/AutoLogin?ID=<?php echo $member_id; ?>";
                }
                });
            <?php else : ?>
                p_member_alert();
            <?php endif; ?>
        <?php elseif ($site == 'mall') : ?>
            document.getElementById('site-mall').click();
        <?php elseif ($site == 'offtime') : ?>
            document.getElementById('site-offtime').click();
        <?php elseif ($site == 'friendshop') : ?>
            document.getElementById('site-friendshop').click();
        <?php elseif ($site == 'suit') : ?>
            document.getElementById('site-suit').click();
        <?php elseif ($site == 'member_board') : ?>
            document.getElementById('site-member_board').click();
        <?php elseif ($site == 'muteki') : ?>
            document.getElementById('site-muteki').click();
        <?php elseif ($site == 'life_seminar') : ?>
            document.getElementById('site-life_seminar').click();
        <?php
            else :
              wp_redirect($referer);
            endif;
        ?>

        function p_member_alert() {
            $('.loading').addClass('d-none');
            $('#message').removeClass('d-none');
            alert('P会員のみのページになります');
        }
    });
</script>
<?php endif; ?>