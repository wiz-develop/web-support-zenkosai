<?php
/*
 * Template Name: 新規会員紹介
 */
get_header(); ?>

<?php
$deficient_popup = '';
if(!$_SESSION['member_info']['mail_judge']){
    $deficient_popup = 'deficient_popup';
}

// 9月21日の朝6時～9時にかけてマイページのリニューアルに伴うメンテナンス表示
$today_date = new DateTime('now');
$maintenance = '';
$disabled = '';
$maintenance_text = '';

$maintenance_start = new DateTime('2024-09-18 6:00:00');
$maintenance_end = new DateTime('2024-09-21 9:00:00');
if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
    $maintenance = 'now-maintenance';
    $disabled = 'disabled';
    $maintenance_text = '<span class="business-maintenance">メンテナンス中</span>';
}
?>

<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
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
                <img src="<?php echo $cfs->get('header_image'); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
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
        <div class="container d-block">
            <div class="d-sm-flex justify-content-between flex-wrap">
                <?php if($member_type == 'ps_member' || $member_type == 'ks_member'): ?>
                    <div class="page-content-innerwrap">
                        <p class="mb-0">サービス受領者のログインページからは紹介を出すことができません。<br>
                        Ｐサービス受領者のポジションから紹介を出す場合、契約者の会員ＩＤでログインをして紹介メールの作成する際に、紹介者の項目にＰサービス受領者の会員IDをお選びください。</p>
                    </div>
                <?php else: ?>
                    <?php if($deficient_popup){ $cls = $deficient_popup; }else{ $cls = 'mypage_form';}?>
                    <div class="page-content-innerwrap">
                        <h3>新規会員紹介</h3>
                        <p class="mb-0">会員紹介を出す場合はこちらから新規申込者へ紹介メールをお送りください。</p>
                        <div class="mx-auto <?php echo $maintenance; ?>">
                            <a class="<?php echo $cls; ?>" data-formid="submitMypage" data-formabout="intromember" <?php echo $disabled; ?>>
                                <button>紹介メールを送信</button>
                                <?php echo $maintenance_text; ?>
                            </a>
                        </div>
                    </div>
                    <div class="page-content-innerwrap">
                        <h3>紹介メールの登録状況の確認・削除</h3>
                        <p class="mb-0">送信した紹介メールの登録状況の確認または紹介メール再送（取消し）がおこなえます。</p>
                        <div class="mx-auto <?php echo $maintenance; ?>">
                            <a class="mypage_form" data-formid="submitMypage" data-formabout="managemember" <?php echo $disabled; ?>>
                                <button>紹介メール登録状況を確認</button>
                                <?php echo $maintenance_text; ?>
                            </a>
                        </div>
                    </div>
                    <div class="page-content-innerwrap">
                        <h3>サービス受領者の登録</h3>
                        <p class="mb-0">契約者がサービス受領者の登録をする際はこちらからお手続きください。<br>
                        サービス受領者の会費は契約者の会費に合算して請求となります。</p>
                        <div class="mx-auto <?php echo $maintenance; ?>">
                            <a class="<?php echo $cls; ?>" data-formid="submitMypage" data-formabout="registermember" <?php echo $disabled; ?>>
                                <button>サービス受領者を登録</button>
                                <?php echo $maintenance_text; ?>
                            </a>
                        </div>
                    </div>
                    <?php if($member_type == 'p_member' ): ?>
                        <div class="page-content-innerwrap">
                            <h3>新規申込者の不備⼀覧</h3>
                            <p class="mb-0">紹介者、アシスタントとして登録されている新規申し込み者に不備がある場合はお名前が表示されます。不備の解消に向けて対応をお願いします。</p>
                            <div class="mx-auto <?php echo $maintenance; ?>">
                                <a class="mypage_form" data-formid="submitMypage" data-formabout="fubi" <?php echo $disabled; ?>>
                                    <button>不備⼀覧を確認</button>
                                    <?php echo $maintenance_text; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="manual-wrap text-center mt-3 mb-5 p-3">
                <h3 class="mb-3 pb-2">WEB関連マニュアル</h3>
                <p class="mb-0 text-left text-sm-center">WEB関連のマニュアルをご確認いただけます。</p>
                <div class="mx-auto">
                    <a href="/document-list/#web-manual">
                        <button>マニュアルを見る</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>