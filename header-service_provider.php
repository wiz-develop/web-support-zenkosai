<?php
session_start();

$login_status = is_user_logged_in();

// サービス提供会社権限以外で管理者ログイン済みの場合、強制ログアウト
if ($login_status && !current_user_can('service_provider')) {
    wp_logout();
    wp_redirect(home_url('/login_service_provider/'));
}


// サービス提供会社権限 で 管理者ログイン済 
if ($login_status && current_user_can('service_provider')) {
    if (get_the_permalink() != home_url('/member-search/')) {
        wp_redirect(home_url('member-search'));
    }
// 管理者未ログイン
} else {
    if (get_the_permalink() != home_url('/login_service_provider/')) {
        wp_redirect(home_url('/login_service_provider/'));
    }
}
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<!-- End Google Tag Manager -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- safariでの電話番号自動リンクをさせない -->
<meta name="format-detection" content="telephone=no">
<link rel="apple-touch-icon" sizes="180x180" href="/cms/wp-content/themes/zenkosai/assets/images/common/apple-touch-icon.png">
<link rel="icon" sizes="180x180" href="/cms/wp-content/themes/zenkosai/assets/images/common/apple-touch-icon.png">
<?php
	global $mypage_directori;
	// 端末判定
	// モバイル＝SP　それ以外＝PC
	global $display_type;
	$display_type = 'pc';
	if (is_mobile()){
		$display_type = 'sp';
	}
	// viewport width設定
	// モバイル = 575
	// タブレット = 755
	// PC = 1139
	$viewport = 575;
	if($display_type == 'pc'){
		$viewport = 1139;
		if(wp_is_tablet()){
			$viewport = 755;
		}
	}
?>
<meta name="viewport" content="width=device-width, initial-scale=1 ,user-scalable=1">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="apple-mobile-web-app-title" content="全厚済HP">
<meta name="keywords" content="一般財団法人,福利厚生,全国福利厚生共済会,全厚済">
<meta name="description" content="みなさんの会費が一般財団法人全国福利厚生共済会の「相互扶助事業」をつくります。一般財団法人全国福利厚生共済会（全厚済）は、会員及びご家族の皆様への多様な事業提案を通じて、より安全で安定的な生活を送っていただくための、ライフサポーターを目指しています。">
<meta property="og:description" content="みなさんの会費が一般財団法人全国福利厚生共済会の「相互扶助事業」をつくります。一般財団法人全国福利厚生共済会（全厚済）は、会員及びご家族の皆様への多様な事業提案を通じて、より安全で安定的な生活を送っていただくための、ライフサポーターを目指しています。">
<meta property="og:locale" content="ja_JP">
<?php
global $lightning_theme_options;
$lightning_theme_options = get_option( 'lightning_theme_options' );
?>

<?php
session_start();
// ログアウト時の処理
if(isset($_POST['my_logout'])) {
	session_unset();
    wp_logout();
    wp_redirect(home_url('/login_service_provider/'));
	exit;
}
wp_head();
?>

<meta name="sitelock-site-verification" content="2440" />
</head>
<body <?php body_class('display_'.$display_type.' '.$unread_exist); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-527PKHPR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="siteHeader shadow-sm w-100 <?php echo $member_type; ?> <?php echo $login;?>">
	<div class="inner-header bg-white w-100">

	<?php
			$lifesupport_cats = get_terms('lifesupport_cat', array('parent' => 0));
			$csr_cats = get_terms('csr_cat', array('parent' => 0, 'hide_empty' => false, 'orderby' => 'id'));

			// SPのショートカットボタン
			function header_shortcut($member_type, $display_type, $llservice_icon, $csr_icon, $intromember_icon, $about_icon, $registermember_icon, $info_icon, $unread, $bell, $llservice_txt){
				if ( $display_type == 'sp'){
					echo '<div class="header-shortcut sp">';
					if (is_user_loggedin()){
						echo
						'<a class="shortcut-left lifesupport-sc gtm-click-link" href="'.home_url('/lifesupport').'" data-gtm-click="SPヘッダー ライフサポートサービス">
							<div class="icon-image">'.$llservice_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152.5 48.5"><text id="ライフサポート_サービス" data-name="ライフサポートサービス" transform="translate(76.25 21.25)" stroke="#000" stroke-width="0.25" font-size="20" font-family="M PLUS 1p" font-weight="500" letter-spacing="0.09em"><tspan x="-75.4" y="0">ライフサポート</tspan><tspan x="-42.7" y="21">サービス</tspan></text></svg></p>
						</a>
						<a class="shortcut-left-center csr-sc gtm-click-link" href="'.home_url('/social-contribution').'" data-gtm-click="SPヘッダー 社会貢献活動">
							<div class="icon-image">'.$csr_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(7014 -6978)"><text id="社会貢献活動" data-name="社会貢献活動" transform="translate(-6935.5 7012.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-67.725" y="0">社会貢献活動</tspan></text><rect transform="translate(-7014 6978)" fill="none"/></g></svg></p>
						</a>
						<a class="shortcut-right-center intromember-sc gtm-click-link" href="'.home_url('/introduce').'" data-gtm-click="SPヘッダー 新規会員紹介">
							<div class="icon-image">'.$intromember_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(6918 -6979)"><text id="新規会員紹介" data-name="新規会員紹介" transform="translate(-6767.5 7013.5)" fill="#302d2c" stroke="#302d2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" font-size="21" font-family="M PLUS 1p" letter-spacing="0.16em"><tspan x="-142.8" y="0">新規会員紹介</tspan></text><rect transform="translate(-6918 6979)" fill="none"/></g></svg></p>
						</a>
						<a class="shortcut-right info-sc position-relative gtm-click-link" href="'.home_url('/information').'" data-gtm-click="SPヘッダー インフォメーション">';
							if($_SESSION['is_unread']){ echo '<div class="position-absolute unread-bell d-inline-block">'.$bell.'</div>';}
							echo '<div class="icon-image">'.$info_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(6685 -7066)"><text id="インフォ_メーション" data-name="インフォメーション" transform="translate(-6606.5 7089.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-44.835" y="0">インフォ</tspan><tspan x="-56.28" y="22">メーション</tspan></text><rect transform="translate(-6685 7066)" fill="none"/></g></svg></p>
						</a>';
					}else{
						echo
						'<a class="shortcut-left about-sc gtm-click-link" href="'.home_url('/about/company').'" data-gtm-click="SPヘッダー 全厚済とは">
							<div class="icon-image">'.$about_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(7158 -7021)"><text id="全厚済_とは" data-name="全厚済とは" transform="translate(-7079.5 7055.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-56.28" y="0">全厚済</tspan><tspan y="0">とは</tspan></text><rect transform="translate(-7158 7021)" fill="none"/></g></svg></p>
						</a>
						<a class="shortcut-left-center csr-sc gtm-click-link" href="'.home_url('/social-contribution').'" data-gtm-click="SPヘッダー 社会貢献活動">
							<div class="icon-image">'.$csr_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(7014 -6978)"><text id="社会貢献活動" data-name="社会貢献活動" transform="translate(-6935.5 7012.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-67.725" y="0">社会貢献活動</tspan></text><rect transform="translate(-7014 6978)" fill="none"/></g></svg></p>
						</a>
						<a class="shortcut-right-center lifesupport-sc gtm-click-link" href="'.home_url('/lifesupport').'" data-gtm-click="SPヘッダー ライフサポートサービス">
							<div class="icon-image">'.$llservice_icon.'</div>
							<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152.5 48.5"><text id="ライフサポート_サービス" data-name="ライフサポートサービス" transform="translate(76.25 21.25)" stroke="#000" stroke-width="0.25" font-size="20" font-family="M PLUS 1p" font-weight="500" letter-spacing="0.09em"><tspan x="-75.4" y="0">ライフサポート</tspan><tspan x="-42.7" y="21">サービス</tspan></text></svg></p>
						</a>
						<a class="shortcut-right registermember-sc gtm-click-link" href="'.home_url('/regist').'" data-gtm-click="SPヘッダー 新規会員登録">
						<div class="icon-image">'.$registermember_icon.'</div>
						<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(7018 -7026)"><text id="新規会員登録" data-name="新規会員登録" transform="translate(-6867.5 7060.5)" fill="#302d2c" stroke="#302d2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" font-size="21" font-family="M PLUS 1p" letter-spacing="0.16em"><tspan x="-142.8" y="0">新規会員登録</tspan></text><rect transform="translate(-7018 7026)" fill="none"/></g></svg></p>
						</a>';
					}
					echo
					'
					</div>';
				}
			}

			$bell                = '<img class="bell-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_bell.png" >';
			$llservice_icon      = '<img class="llservice-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_llservice.png" >';
			$about_icon          = '<img class="about-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_about.png" >';
			$csr_icon            = '<img class="csr-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_csr.png" >';
			$contact_icon        = '<img class="contact-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_contact.png" >';
			$plusa_icon          = '<img class="plusa-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_plusa.png" >';
			$new_plusa_icon          = '<img class="new_plusa-icon" src="/cms/wp-content/themes/zenkosai/assets/images/common/plusa-icon.png" >';
			$experiences_icon          = '<img class="experiences-icon" src="/cms/wp-content/themes/zenkosai/assets/images/common/experiences-icon.png" >';
			$commentbox_ico      = '<img class="commentbox-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_commentbox.png" >';
			$calender_icon       = '<img class="calender-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_calender.png" >';
			$insurance_icon      = '<img class="intromember-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_insurance.png" >';
			$mypage_icon         = '<div><svg width="100%" class="mypage-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 99.28"><path id="ic_person_add_24px" d="M65.966,53.64a24.821,24.821,0,1,0-25-24.82A24.9,24.9,0,0,0,65.966,53.64Zm0,12.41c-16.687,0-50,8.315-50,24.82v12.41h100V90.87C115.966,74.365,82.653,66.05,65.966,66.05Z" transform="translate(-15.966 -4)" fill=""/></svg></div>';
			$intromember_icon    = '<img class="intromember-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_intromember.png" >';
			$registermember_icon = '<img class="intromember-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_registermember.png" >';
			$home_icon           = '<div class="home-icon">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35">
											<g transform="translate(3777 -3540)">
												<path d="M20.16,30.806V22.995H14.476v7.811H5.332V19.2L17.325,7.215,29.306,19.2V30.806ZM17.325,5.13,2.566,19.876,0,17.311,17.325,0,20.9,3.586,24.619,7.3V3.947h4.688v8.038l5.332,5.325-2.566,2.565Z" transform="translate(-3777 3542)" fill="#ffdc60"/>
												<rect width="35" height="35" transform="translate(-3777 3540)" fill="none"/>
											</g>
										</svg>
									</div>';
			$business_icon      = '<div class="business-icon">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35">
											<g transform="translate(3822 -3542)">
												<g transform="translate(-3819 3545)">
												<path d="M319.966,426.937a7.374,7.374,0,0,0,12.472,5.224V421.709a7.372,7.372,0,0,0-12.472,5.228Z" transform="translate(-304.379 -407.804)" fill="#4ea6ff"/>
												<path d="M321.385,421.064a12.937,12.937,0,0,1,6.539-1.754,12.743,12.743,0,0,1,6.855,1.952V412.9H316.859a10.038,10.038,0,0,1,2.339,1.745A8.271,8.271,0,0,1,321.385,421.064Z" transform="translate(-306.721 -412.899)" fill="#4ea6ff"/>
												<path d="M313.626,423.342c3.672,0,5.235-1.07,5.9-1.971a2.855,2.855,0,0,0,.587-1.954,3.786,3.786,0,0,0-.993-3c-.7-.742-2.5-1.976-6.706-1.976-.566,0-1.022.026-1.341.049v8.686A25.271,25.271,0,0,0,313.626,423.342Z" transform="translate(-311.078 -411.734)" fill="#0050a1"/>
												<path d="M319.853,421.863a25.125,25.125,0,0,1-8.307,1.184c-.156,0-.312-.014-.468-.016V434.2H323.1a12.789,12.789,0,0,1-3.714-8.926A12.6,12.6,0,0,1,319.853,421.863Z" transform="translate(-311.078 -406.143)" fill="#0050a1"/>
												</g>
												<rect width="35" height="35" transform="translate(-3822 3542)" fill="none"/>
											</g>
										</svg>
									</div>';
			$info_icon           = '<img class="business-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_info.png" >';
			$llservice_txt_b     = '<svg xmlns="http://www.w3.org/2000/svg" width="152.5" height="48.5" viewBox="0 0 152.5 48.5"><text id="ライフサポート_サービス" data-name="ライフサポートサービス" transform="translate(76.25 21.25)" stroke="#000" stroke-width="0.25" font-size="20" font-family="M PLUS 1p" font-weight="500" letter-spacing="0.09em"><tspan x="-75.4" y="0">ライフサポート</tspan><tspan x="-42.7" y="21">サービス</tspan></text></svg>';
			$llservice_txt = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152.5 48.5"><text id="ライフサポート_サービス" data-name="ライフサポートサービス" transform="translate(76.25 21.25)" stroke="#000" stroke-width="0.25" font-size="20" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-75.4" y="0">ライフサポート</tspan><tspan x="-42.7" y="21">サービス</tspan></text></svg>';
			$mypage_icon = '<svg class="mypage-icon fill-'.$member_type.'" xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 100 99.28"><path id="ic_person_add_24px" d="M65.966,53.64a24.821,24.821,0,1,0-25-24.82A24.9,24.9,0,0,0,65.966,53.64Zm0,12.41c-16.687,0-50,8.315-50,24.82v12.41h100V90.87C115.966,74.365,82.653,66.05,65.966,66.05Z" transform="translate(-15.966 -4)" fill=""/></svg>';
			$login_icon = '<div class="mypage-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
									<g transform="translate(3639 -3536)">
										<g transform="translate(-3600.943 3573.448) rotate(180)">
										<path d="M26.8,28.9v-.015l-.4.4a5.056,5.056,0,0,1-2.632,1.4,4.872,4.872,0,0,1-.967.1,5.024,5.024,0,0,1-.617-.041l-.011,0h-.011v.07H4.64V4.64H22.155V7.583l0,.387h0v.011a5.048,5.048,0,0,1,4.237,1.445l.232.232.16.171V9.818l.011.011V0H0V35.437H0v.011H26.8V31.6l.008-2.709Z" fill="#604c07"/>
										<path d="M.854,7.208,7.2.859A2.926,2.926,0,0,1,9.281,0,2.563,2.563,0,0,1,9.92.075a2.865,2.865,0,0,1,1.439.784,2.739,2.739,0,0,1,.526.714,2.557,2.557,0,0,1,.215.532,2.924,2.924,0,0,1,.123.838,2.978,2.978,0,0,1-.123.838,2.858,2.858,0,0,1-.741,1.241l-.767.767-.528.538h8.647a2.943,2.943,0,0,1,0,5.886H13.637l-3.575.008,1.3,1.3a2.741,2.741,0,0,1,.526.714,2.56,2.56,0,0,1,.215.532,2.923,2.923,0,0,1,.123.838,2.98,2.98,0,0,1-.123.838,2.948,2.948,0,0,1-1.713,1.885,2.46,2.46,0,0,1-.467.145.405.405,0,0,1-.075.021,3.34,3.34,0,0,1-.564.054,3.22,3.22,0,0,1-.559-.054,2.9,2.9,0,0,1-1.52-.811L5.28,15.758.854,11.338a2.924,2.924,0,0,1,0-4.13Z" transform="translate(13.401 10.503)" fill="#604c07"/>
										</g>
										<rect transform="translate(-3639 3536)" fill="none"/>
									</g>
								</svg>
							</div>';
			$logout_icon = '<svg class="logout-icon" width="95%" viewBox="0 0 100 95.812" xmlns="http://www.w3.org/2000/svg"><g fill=""><path d="m25.021 178.778-5.921 5.922-13.179-13.179-5.921-5.921 5.921-5.921 13.179-13.179 5.921 5.922-8.993 8.991h50.439v8.373h-50.439z" transform="translate(0 -117.694)"></path><path d="m162.14 0h-66.14v29.941h14.378v-14.97h46.01v65.87h-46.01v-14.97h-14.378v29.941h74.767v-95.812z" transform="translate(-70.767)"></path></g></svg>';

			$home_url = '/';
			?>
			<div class="header-top <?php echo $display_type; ?> d-flex justify-content-between align-items-center">
				<div class="d-flex align-items-center">
					<div class="site-logo member-search">
                        <div class="d-flex align-items-center">
                            <img class="site-logo-img w-100" src="/cms/wp-content/uploads/2020/11/header-logo.png">
                        </div>
					</div>
				</div>
				<div class="d-flex justify-content-between align-items-stretch">

					<?php if ($display_type == 'pc') : ?>
                        <?php if (is_user_logged_in()) : ?>
                            <div class="header-login-button border-color-<?php echo $member_type; ?> ml-2 rounded px-3 d-flex">
								<form class="logout align-self-center mb-0" method="post">
									<button type="submit" name="my_logout" class="border-0 px-0 d-flex justify-content-between align-items-center gtm-click-link" data-gtm-click="PCヘッダー ログアウト">
										<div class="sc-imgbox"><?php echo $logout_icon; ?></div>
										<span class="ml-2">ログアウト</span>
									</button>
								</form>
                            </div>
                        <?php endif; ?>
					<?php endif; ?>
				</div>
			</div>	
	</div>
</header>

<script>
jQuery(function($){
	// ヘッダースクロールアニメーション処理
	var startPos = 0,winScrollTop = 0;
	$(window).on('scroll',function(){
		winScrollTop = $(this).scrollTop();

		if (winScrollTop >= startPos) {
			if(winScrollTop > 0){
				$('header').addClass('scrolled');
			}
		} else {
			$('header').removeClass('scrolled');
		}
		startPos = winScrollTop;
	});
});
</script>

<?php do_action( 'lightning_header_after' ); ?>