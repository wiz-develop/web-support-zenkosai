<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$login_slug = 'login';
$login_url = home_url('/' . trim($login_slug, '/') . '/');

global $post;
$current_slug = $post ? $post->post_name : '';

global $is_restrict_page;
if (function_exists('CFS') && isset($post->ID)) {
    $is_restrict_page = CFS()->get('restrict_page', $post->ID);
} else {
    $is_restrict_page = null;
}

// 常時
define('SESSION_TIMEOUT', 3600);

// コンベンション用
// define('SESSION_TIMEOUT', 21600);

if (!empty($_SESSION['member_info']) && !empty($_SESSION['logout_info'])) {
    unset($_SESSION['logout_info']);
}

if (!empty($_SESSION['member_info'])) {
    if (empty($_SESSION['last_access'])) {
        $_SESSION['last_access'] = time();
    } elseif ((time() - $_SESSION['last_access']) > SESSION_TIMEOUT) {
        $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $_SESSION['redirect_after_login'] = $current_url;

        unset($_SESSION['member_info']);
        $_SESSION['logout_info'] = [
            'message' => 'ログインの有効期限が切れました。再度ログインしてください。',
            'flag' => 'timeout'
        ];

        if ($current_slug !== 'session-expired') {
            wp_redirect(home_url('/session-expired/'));
            exit;
        }
    } else {
        $_SESSION['last_access'] = time();
    }
}

if (!empty($is_restrict_page) && empty($_SESSION['member_info'])) {

    // お問い合わせ関連ページはログイン不要のため除外
    $current_request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $is_contact_flow = (strpos($current_request_uri, '/contact/') !== false);

    if (!$is_contact_flow && $current_slug !== 'session-expired' && $current_slug !== $login_slug) {

        if (!empty($_SESSION['logout_info']['flag']) && $_SESSION['logout_info']['flag'] === 'timeout') {
            wp_redirect(home_url('/session-expired/'));
            exit;
        }

        if (empty($_SESSION['redirect_after_login'])) {
            $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $_SESSION['redirect_after_login'] = $current_url;
        }

        wp_redirect($login_url);
        exit;
    }
}

// メンテナンス表示
$today_date = new DateTime('now');
$maintenance = '';
$disabled = '';
$tabindex = '';
$maintenance_text = '';

$maintenance_start = new DateTime('2025-05-18 6:00:00');
$maintenance_end = new DateTime('2025-06-05 14:00:00');
if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
	$maintenance = 'now-maintenance';
	$disabled = 'disabled';
	$maintenance_pass = 'd-none';
	// $tabindex = 'tabindex="-1"';
	$maintenance_text = '<p class="login-maintenance">メンテナンス中</p>';
	$maintenance_text_sp = '<p class="login-maintenance p-4">メンテナンス中</p>';
}
?>

<head>
    <script>
    var member_type = '<?php echo $_SESSION['member_info']['member_type']; ?>';
    if (!member_type) {
        member_type = 'n_member';
    }
    dataLayer = [{
        'member_type': member_type
    }];
    </script>
    <!-- Google Tag Manager -->
    <script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-527PKHPR');
    </script>
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
    <?php if (!is_front_page()) : ?>
    <meta name="robots" content="noindex">
    <?php endif; ?>
    <?php
global $lightning_theme_options;
$lightning_theme_options = get_option( 'lightning_theme_options' );
?>

    <?php
session_start();
// ログアウト時の処理
if(isset($_POST['my_logout'])) {
	session_unset();
	header('Location: '.$mypage_directori.'/login/logout/');
	exit;
}
wp_head();
?>
    <!-- ヘッダー開始 -->
    <?php
	// ログイン判定
	global $login;
	$login = '';
	if(is_user_loggedin()){
		$login = 'user_loggedin';
	}

	// 会員種別判別
	global $member_type;
	$member_type = 'n_member';
	if(is_user_loggedin()) {
		$member_type = $_SESSION['member_info']['member_type'];
		$m_id = $_SESSION['member_info']['member_id'];
    	$m_name = $_SESSION['member_info']['member_name'];
	}
	console_log($_SESSION['member_info']);

	// 登録書類不備チェック
	global $r_deficient;
	$r_deficient = false;
	if($_SESSION['member_info']['member_status'] == 1 && $_SESSION['member_info']['deficient_reason'] == 25 ){
		$r_deficient = true;
	}
	if( $r_deficient && $_SESSION['member_info']['mypage_visit'] == 1){
		login_action($_SESSION['member_info']['member_id_pre'], $_SESSION['member_info']['member_pw_pre']);
		if($_SESSION['member_info']['member_status'] !== 1 && $_SESSION['member_info']['deficient_reason'] !== 25 ){
			$r_deficient = false;
		}
	}
	if($r_deficient){
		if(!is_page('deficient') && !is_page('logout')){
			wp_redirect(home_url('/deficient'));
			exit;
		}
	}

	// ヘッダーの表示
	$menuHeader = true;
	if (is_page('cancel-mail-magazine') || is_parent_slug() == 'cancel-mail-magazine') {
		$menuHeader = false;
	}
	if (is_page('redirect')) {
		$menuHeader = false;
	}
?>
    <meta name="sitelock-site-verification" content="2440" />
	<script type="text/javascript">
		(function(c,l,a,r,i,t,y){
			c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
			t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
			y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
		})(window, document, "clarity", "script", "sgpqnc7lua");
	</script>
</head>
<?php
	$member_id = $_SESSION['member_info']['member_id'] ?? 0;

	$unread_exist = 0;
	$unread_month = 0;

	if ($member_id && function_exists('count_unreads_all')) {
		$counts = count_unreads_all($member_id);
		$unread_exist = (int)($counts['tab'] ?? 0);
		$unread_month = (int)($counts['bar'] ?? 0);
	}
?>

<body <?php body_class('display_'.$display_type.' '.$unread_exist); ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-527PKHPR" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <?php if ($menuHeader) : ?>
    <header class="siteHeader shadow-sm w-100 <?php echo $member_type; ?> <?php echo $login;?>">
        <div class="inner-header bg-white w-100">

            <?php
			$lifesupport_cats = get_terms('lifesupport_cat', array('parent' => 0));
			$csr_cats = get_terms('csr_cat', array('parent' => 0, 'hide_empty' => false, 'orderby' => 'id'));

			// SPのショートカットボタン
			function header_shortcut($member_type, $display_type, $llservice_icon, $csr_icon, $intromember_icon, $about_icon, $registermember_icon, $info_icon, $unread, $bell, $llservice_txt){
				// if ( $display_type == 'sp'){
					echo '<div class="header-shortcut sp d-md-none">';
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
				// }
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
			$aul_icon      = '<img class="aul-icon" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_aul.png" >';
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
            <?php if ($r_deficient || is_page('server-monitoring')) : // 登録書類不備ページ・死活監視用ページ ?>
            <div class="header-top <?php echo $display_type; ?> bg-white d-flex justify-content-between">
                <div class="site-logo d-flex align-items-center">
                    <a href="/deficient/">
                        <div class="d-flex align-items-center">
                            <img class="site-logo-img" src="/cms/wp-content/uploads/2020/11/header-logo.png">
                        </div>
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <?php if (!$r_deficient && !is_page('server-monitoring')) : // 登録書類不備ページ・死活監視用ページでない場合 ?>
            <div class="header-top <?php echo $display_type; ?> d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="site-logo">
                        <a href="<?php echo $home_url; ?>" class="gtm-click-link" data-gtm-click="ロゴ">
                            <div class="d-flex align-items-center">
                                <img class="site-logo-img w-100" src="/cms/wp-content/uploads/2020/11/header-logo.png">
                            </div>
                        </a>
                    </div>
                    <?php //if ($display_type == 'pc') : ?>
                    <div class="header-shortcut pc d-none d-md-block">
                        <ul class="pc-menu my-0 d-flex align-items-center">
                            <?php if(!is_user_loggedin()) : ?>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="home gtm-click-link" href="<?php echo $home_url; ?>" data-gtm-click="PCヘッダー ホーム">
                                    <div class="sc-imgbox">
                                        <div class="pt-1"><?php echo $home_icon; ?></div>
                                    </div>
                                    <p class="mb-0 pt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53">
                                            <g transform="translate(7266 -6936)"><text id="ホーム" data-name="ホーム" transform="translate(-7186.5 6970.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em">
                                                    <tspan x="-33.39" y="0">ホーム</tspan>
                                                </text>
                                                <rect transform="translate(-7266 6936)" fill="none" />
                                            </g>
                                        </svg>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="about hover-clear gtm-click-link" href="/about/company/" data-gtm-click="PCヘッダー 全厚済とは">
                                    <div class="sc-imgbox">
                                        <div class="pt-1"><?php echo $about_icon; ?></div>
                                    </div>
                                    <p class="mb-0 pt-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(7158 -7021)"><text id="全厚済_とは" data-name="全厚済とは" transform="translate(-7079.5 7055.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-56.28" y="0">全厚済</tspan><tspan y="0">とは</tspan></text><rect width="158" height="53" transform="translate(-7158 7021)" fill="none"/></g></svg></p>
                                </a>
                                <ul class="pc-sub-menu p-0 my-0">
                                    <li><a href="/about/company/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー 全厚済とは">全厚済とは</a></li>
                                    <li><a href="/about/message/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー 代表理事について">代表理事について</a></li>
									<?php if(!is_user_loggedin()) : ?>
                                    <li><a href="/about/history/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー 全厚済の歩み">全厚済の歩み</a></li>
									<?php endif; ?>
                                    <?php if(is_user_loggedin()) : ?>
									<li><a href="/about/talk/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー 代表理事・専務理事対談">代表理事・専務理事対談</a></li>
									<li><a href="/about/history/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー 全厚済の歩み">全厚済の歩み</a></li>
                                    <li><a href="/about/service-use/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー サービス利用件数・決算報告">サービス利用件数・<br>決算報告</a></li>
                                    <li><a href="/media/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー メディアコンテンツ">メディアコンテンツ</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="lifesupport hover-clear gtm-click-link" href="/lifesupport/" data-gtm-click="PCヘッダー ライフサポートサービス">
                                    <div class="sc-imgbox">
                                        <div class="pt-1"><?php echo $llservice_icon; ?></div>
                                    </div>
                                    <p class="mb-0 pt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152.5 48.5"><text id="ライフサポート_サービス" data-name="ライフサポートサービス" transform="translate(76.25 21.25)" stroke="#000" stroke-width="0.25" font-size="20" font-family="M PLUS 1p" letter-spacing="0.09em">
                                                <tspan x="-75.4" y="0">ライフサポート</tspan>
                                                <tspan x="-42.7" y="21">サービス</tspan>
                                            </text></svg>
                                    </p>
                                </a>
                                <ul class="pc-sub-menu p-0 my-0">
                                    <?php
										foreach ($lifesupport_cats as $t) {
											if (get_field('s_display', $t) && !$login) {
												continue;
											}
											if ($t->slug == 'other') { continue; }
											if (!$login) {
												echo '<a href="/lifesupport_cat/'.$t->slug.'/" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー '.$t->name.'"><li class="text-left">'.$t->name.'</li></a>';
												continue;
											}
											echo '<a href="/lifesupport/#'.$t->slug.'" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー '.$t->name.'"><li class="text-left">'.$t->name.'</li></a>';
										}
									?>
                                </ul>
                            </li>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="csr hover-clear gtm-click-link" href="/social-contribution/" data-gtm-click="PCヘッダー 社会貢献活動">
                                    <div class="sc-imgbox">
                                        <div class="pt-1"><?php echo $csr_icon; ?></div>
                                    </div>
                                    <p class="mb-0 pt-1"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53">
                                            <g transform="translate(7014 -6978)"><text id="社会貢献活動" data-name="社会貢献活動" transform="translate(-6935.5 7012.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em">
                                                    <tspan x="-67.725" y="0">社会貢献活動</tspan>
                                                </text>
                                                <rect transform="translate(-7014 6978)" fill="none" />
                                            </g>
                                        </svg></p>
                                </a>
								<?php
									$excluded_slugs = ['csr-topics', 'volunteer2', 'clean', 'education', 'education_scholarship'];

									$ordered_terms = array_filter($csr_cats, function($t) use ($excluded_slugs) {
										return !in_array($t->slug, $excluded_slugs, true);
									});

									usort($ordered_terms, function($a, $b) {
										$order_a = get_field('menu_order', 'csr_cat_' . $a->term_id);
										$order_b = get_field('menu_order', 'csr_cat_' . $b->term_id);
										return ($order_a ?? 9999) <=> ($order_b ?? 9999);
									});
								?>
                                <ul class="pc-sub-menu p-0 my-0">
									<?php foreach ($ordered_terms as $t) :
										$id = $t->term_id;
										$child = get_term_children($id, 'csr_cat');

										$url = '/social-contributions/category/?csr_cat=' . $t->slug;
										if ($child) {
											$url = '/social-contribution/?cat_id=' . $id;
										}

										if ($id == 82) {
											$url = '/social-contribution/#mottainai_pro';
										} elseif ($id == 84) {
											$url = '/social-contributions/category/?csr_cat=csr-activities';
										} elseif ($id == 305) {
											$url = '/social-contributions/category/?csr_cat=brights';
										}
									?>
                                    <li class="<?php echo $t->slug; ?>">
                                        <a href="<?php echo $url; ?>" aria-current="page" class="gtm-click-link" data-gtm-click="PCヘッダー サブメニュー <?php echo strip_tags($t->name); ?>">
                                            <?php echo $t->name; ?>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <?php if(is_user_loggedin()) : ?>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="intromember gtm-click-link" href="/introduce/" data-gtm-click="PCヘッダー 新規会員紹介">
                                    <div class="sc-imgbox">
                                        <div class="pt-1"><?php echo $intromember_icon; ?></div>
                                    </div>
                                    <p class="mb-0 pt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53">
                                            <g transform="translate(6918 -6979)"><text id="新規会員紹介" data-name="新規会員紹介" transform="translate(-6767.5 7013.5)" fill="#302d2c" stroke="#302d2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" font-size="21" font-family="M PLUS 1p" letter-spacing="0.16em">
                                                    <tspan x="-142.8" y="0">新規会員紹介</tspan>
                                                </text>
                                                <rect transform="translate(-6918 6979)" fill="none" />
                                            </g>
                                        </svg>
                                    </p>
                                </a>
                            </li>
                            <?php else : ?>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="registermember gtm-click-link" href="/regist/" data-gtm-click="PCヘッダー 新規会員登録">
                                    <div class="sc-imgbox">
                                        <div class="pt-0"><?php echo $registermember_icon; ?> </div>
                                    </div>
                                    <p class="mb-0 pt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53">
                                            <g transform="translate(7018 -7026)"><text id="新規会員登録" data-name="新規会員登録" transform="translate(-6867.5 7060.5)" fill="#302d2c" stroke="#302d2c" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.5" font-size="21" font-family="M PLUS 1p" letter-spacing="0.16em">
                                                    <tspan x="-142.8" y="0">新規会員登録</tspan>
                                                </text>
                                                <rect transform="translate(-7018 7026)" fill="none" />
                                            </g>
                                        </svg>
                                    </p>
                                </a>
                            </li>
                            <?php endif; ?>
                            <li class="border-color-<?php echo $member_type; ?>">
                                <a class="contact gtm-click-link" href="/contact/" data-gtm-click="PCヘッダー お問合せ">
                                    <div class="sc-imgbox">
                                        <div class="pt-0"><?php echo $contact_icon; ?></div>
                                    </div>
                                    <p class="mb-0 pt-1">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 158 53"><g transform="translate(6314 -6965)"><text id="お_問_い_合_わせ" data-name="お問合せ" transform="translate(-6211.5 6999.5)" stroke="#000" stroke-width="0.25" font-size="21" font-family="M PLUS 1p" letter-spacing="0.09em"><tspan x="-67.725" y="0">お</tspan><tspan y="0">問</tspan><tspan y="0">合</tspan><tspan y="0">せ</tspan></text><rect transform="translate(-6314 6965)" fill="none"/></g></svg>
									</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php //endif; ?>
                </div>
                <div class="d-flex justify-content-between align-items-stretch">
                    <?php if (is_user_loggedin()) : ?>
                    <div id="js-header-member-card" class="header-member-card rounded px-2 px-sm-1 px-lg-3">
                        <p class="font-smaller mb-0 d-flex flex-nowrap"><span class="text-nowrap"><?php echo sprintf('%08d', $m_id); ?></span></p>
                        <p class="font-smaller mb-0">
                            <?php
								$limit = 8;
								if(mb_strlen($m_name) > $limit) { 
									$name = mb_substr($m_name, 0, $limit);
									echo '<span class="text-nowrap">'.$name.'</span><span>…</span>';
								} else {
									echo $m_name;
								}
							?>
                        </p>
                    </div>
                    <?php endif; ?>
                    <?php //if ($display_type == 'pc') : ?>
                    <div class="header-login-button border-color-<?php echo $member_type; ?> ml-2 rounded px-3 px-sm-0 px-lg-2 d-md-flex d-none position-relative <?php echo $maintenance; ?>">
                        <?php if (is_user_loggedin()) : ?>
                        <form class="logout align-self-center" method="post">
                            <button type="submit" name="my_logout" class="border-0 px-0 gtm-click-link" data-gtm-click="PCヘッダー ログアウト">
                                <div class="sc-imgbox"><?php echo $logout_icon; ?></div>
                                <span class="text-dark">ログアウト</span>
                            </button>
                        </form>
                        <?php else : ?>
                        <a class="login border-color-<?php echo $member_type; ?> d-block align-self-center gtm-click-link" href="/login/" data-gtm-click="PCヘッダー ログイン">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="sc-imgbox mr-sm-2"><?php echo $login_icon; ?></div>
                                <span>ログイン</span>
                            </div>
                        </a>
                        <?php endif; ?>
						<?php echo $maintenance_text; ?>
                    </div>
                    <?php //endif; ?>
					<?php
						if (is_user_loggedin()) :
					?>
					<section class="raino-faq">
						<div class="raino-faq__content">	
							<button id="js-raino-faq-open">
								<p class="raino-faq-title mx-auto mb-0">検索</p>
								<div class="raino-faq__content__image">
									<img class="d-sm-none" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/common/faq_raino-search.png">
									<img class="d-none d-sm-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/common/faq_raino-search-pc.png">
								</div>
							</button>	
						</div>
						<div class="js-raino-faq__search raino-faq__search position-absolute pt-1 pb-3 py-md-3 px-4">
							<div class="position-relative">
								<button id="js-raino-faq-close" class="ml-auto d-block"><span>閉じる</span><i class="fa-solid fa-xmark"></i></button>
								<section class="mt-2">
									<a href="/faq/" class="raino-faq__search__link d-block">
										<img class="w-100" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/common/faq_raino.png">
									</a>
								</section>
								<section class="mt-3">
									<h2 class="raino-faq-subtitle">フリーワード検索</h2>
									<form method="get" class="search position-relative" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
										<input type="hidden" name="post_type" value="ufaq">
										<input type="text" placeholder="<?php if (!is_search()) { echo '単語など短い言葉を入力してください'; } ?>" value="<?php if(is_search()){ echo get_search_query(); } ?>" class="ufaq-searchbody" name="s">
										<button type="submit" class="search-submit btn">検索</button>
									</form>
								</section>
							</div>
						</div>
					</section>
					<?php
						endif;
					?>
                </div>
            </div>
            <div class="header-bottom <?php echo $display_type; ?> p-1 justify-content-sm-between align-items-sm-center">
                <div class="b-tab-wrap rounded d-flex align-items-center">
                    <?php
						if (is_user_loggedin()) :
							$current_url = get_the_permalink();
							$home_url = home_url('/');
							$bussiness_url = home_url('/business/');
							if ($member_type == 'p_member') : // ビジネス・ホーム・マイページ
					?>
                    <!-- ビジネス -->
                    <a href="/business/" class="b-tab d-flex justify-content-center rounded <?php if($current_url == $bussiness_url) echo 'open'; ?> gtm-click-link" aria-current="page" data-gtm-click="ヘッダー ビジネス">
                        <div class="tab-imgbox mr-sm-3 mr-1"><?php echo $business_icon; ?></div>
                        <p class="mb-0 mr-sm-3 mr-1">ビジネス</p>
                    </a>
                    <?php endif; ?>
                    <!-- ホーム -->
                    <a href="/" class="b-tab d-flex justify-content-center rounded <?php if($current_url == $home_url) echo 'open'; ?> gtm-click-link" aria-current="page" data-gtm-click="ヘッダー ホーム">
                        <div class="tab-imgbox mr-sm-3 mr-1"><?php echo $home_icon; ?></div>
                        <p class="mb-0 mr-sm-3 mr-0">ホーム</p>
                    </a>
                    <!-- マイページ -->
                    <a href="javascript:void(0)" class="b-tab d-flex justify-content-center rounded mypage_form gtm-click-link" data-formid="submitMypage" data-formabout="mypage" target="_blank" data-gtm-click="ヘッダー マイページ">
                        <div class="tab-imgbox mr-sm-3 mr-1"><?php echo $mypage_icon; ?></div>
                        <p class="mb-0 mr-sm-3 mr-1">マイページ</p>
                    </a>
                    <?php elseif (!is_user_loggedin()) : ?>
                    <?php //elseif ($display_type == 'sp' && !is_user_loggedin()) : ?>
                    <!-- ホーム -->
                    <a href="/" class="b-tab justify-content-center flex-column flex-sm-row border border-color-<?php echo $member_type; ?> rounded gtm-click-link" aria-current="page" data-gtm-click="ヘッダー ホーム">
                        <div class="tab-imgbox mr-sm-3 mr-1"><?php echo $home_icon; ?></div>
                        <p class="mb-0 mr-sm-3 mr-0">ホーム</p>
                    </a>
                    <!-- ログイン -->
                    <a href="/login/" class="b-tab b-tab-login justify-content-center <?php if (!is_user_loggedin()) echo 'flex-column flex-sm-row'; ?> position-relative rounded border border-color-<?php echo $member_type; ?> gtm-click-link <?php echo $maintenance; ?>" aria-current="page" data-gtm-click="ヘッダー ログイン">
                        <?php
								if( !$_SESSION['member_info']['mypage_visit'] && $class == 'mypage_form'){
									echo '<div class="unread position-absolute text-danger">●</div>';
								}
							?>
                        <div class="tab-imgbox mr-sm-3 mr-1 bg-white"><?php echo $login_icon; ?></div>
                        <p class="mb-0">ログイン</p>
						<?php echo $maintenance_text; ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php //if ($display_type == 'sp') : ?>
                <a class="menu-logo border-color-<?php echo $member_type; ?> rounded ml-auto justify-content-center align-items-center gtm-click-link" data-gtm-click="ハンバーガーメニュー">
                    <div class="menu-toggle mr-2">
                        <svg class="tab-imgbox fill-<?php echo $member_type; ?>" height="100%" viewBox="0 0 100 99" width="100%" xmlns="http://www.w3.org/2000/svg">
                            <g fill="">
                                <path d="m0 39.5h100v20h-100z" />
                                <path d="m0 0h100v20h-100z" />
                                <path d="m0 79h100v20h-100z" />
                            </g>
                        </svg>
                    </div>
                    <span>MENU</span>
                </a>
                <?php //endif; ?>
            </div>
            <div class="header-middle <?php echo $display_type; ?> d-md-none">
                <?php header_shortcut($member_type, $display_type, $llservice_icon, $csr_icon, $intromember_icon, $about_icon, $registermember_icon, $info_icon, $unread_month, $bell, $llservice_txt); ?>
            </div>
            <?php endif; ?>
            <?php if (is_front_page() && !is_user_loggedin()) : ?>
            <div class="login-forget-guide text-center mr-0 ml-auto <?php echo $maintenance_pass; ?>">
                <p class="forget-guide px-3 py-2 bg-white">ログイン情報をお忘れの方は<a href="<?php echo $mypage_directori; ?>/reminder/password/" class="gtm-click-link" data-gtm-click="ヘッダー ログイン情報をお忘れの方">こちら</a></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- ハンバーガーメニュー -->
        <?php if(!$r_deficient && !is_page('server-monitoring')){
	//if($display_type == 'sp' && !$r_deficient && !is_page('server-monitoring')){
		echo
		'<div class="menu-hamburger bg-white d-md-none" id="">
		<div class="menu-hamburger-inner">
			<div class="close ham-sp-menu bold position-absolute d-flex align-items-center"><p>閉じる</p><span>×</span></div>';
			if(!$login){
				echo'<div class="menu-hamburger-guide text-center mb-4">
					<a href="/login" class="gtm-click-link position-relative '. $maintenance .'" data-gtm-click="SPメニュー ログインはこちらから">
						<button class="guide-btn rounded07 shadow-sm mx-auto p-3 px-4 mb-2">
							ログインはこちらから　<span class="px-3"></span>
						</button>
						'. $maintenance_text_sp .'
					</a>
					<p class="guide-forget '. $maintenance_pass .'">ログイン情報をお忘れの方は<a href="'.$mypage_directori.'/reminder/password/" class="gtm-click-link" data-gtm-click="SPメニュー ログイン情報をお忘れの方">こちらから</a></p>
				</div>';
			}
			if($login){
				echo'<section class="raino-faq">
						<div class="js-raino-faq__search raino-faq__search py-1 py-md-3 px-4 w-100">
							<section>
								<h2 class="raino-faq-subtitle">フリーワード検索</h2>
								<form method="get" class="search position-relative" action="' . esc_url( home_url( '/' ) ) . '" >
									<input type="hidden" name="post_type" value="ufaq">
									<input type="text" placeholder="' . (!is_search() ? '単語など短い言葉を入力してください' : '') . '" value="' . (is_search() ? get_search_query() : '') . '" class="ufaq-searchbody" name="s">
									<button type="submit" class="search-submit btn">検索</button>
								</form>
							</section>
						</div>
				</section>';
			}
			echo'<ul id="header-sp-menu" class="header-sp-menu px-0">
				<li id="" class="has-children">
					<a class="acor-menu-ham gtm-click-link" aria-current="page" data-gtm-click="SPメニュー ライフサポートサービス">'.$llservice_icon.'ライフサポートサービス</a>
					<ul class="lsservice p-0 py-2">
						<li id="" class="lsservice-special w-100"><a class="d-flex align-items-center gtm-click-link" href="/plusa/" aria-current="page" data-gtm-click="SPメニュー 期間限定 おすすめ情報">'.$new_plusa_icon.'<span>期間限定 おすすめ情報</span></a></li>
						<li id="" class="lsservice-special w-100"><a class="d-flex align-items-center gtm-click-link" href="/service-experience/" aria-current="page" data-gtm-click="SPメニュー サービス利用体験談">'.$experiences_icon.'<span>サービス利用体験談</span></a></li>';
						foreach ($lifesupport_cats as $t){
							if (get_field('s_display', $t) && !$login) {
								continue;
							}
							if ($t->slug == 'other'){ continue; }
							$tmp = get_field('s_logo', $t);
							if (!$login) {
								echo '<li id="" class="close-menu"><a href="/lifesupport_cat/'.$t->slug.'" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー '.$t->name.'"><div class="img-box"><img src="'.$tmp['url'].'"></div><span class="txt-box">'.$t->name.'</span></a></li>';
								continue;
							}
							echo '<li id="" class="close-menu"><a href="/lifesupport/#'.$t->slug.'" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー '.$t->name.'"><div class="img-box"><img src="'.$tmp['url'].'"></div><span class="txt-box">'.$t->name.'</span></a></li>';
						}
					echo'</ul>
				</li>
				<li id="" class="has-children">
					<a class="acor-menu-ham gtm-click-link" aria-current="page" data-gtm-click="SPメニュー 全厚済とは">'.$about_icon.'全厚済とは</a>
					<ul class="acor-menu-child px-0 py-2">';
					$page_ID = get_page_by_path('about');
					$args = array(
						'post_parent' => $page_ID->ID,
						'post_status' => 'publish',
						'post_type'   => 'page',
						'order'       => 'ASC',
						'orderby'     => 'menu_order',
					);
					$children_array = get_children( $args );
					foreach ( $children_array as $child ) {
						if(CFS()->get('restrict_page',$child->ID))
						{
							if(!$_SESSION['member_info']){
								continue;
							}
						}
						echo'<li id="" class=""><a href="'.get_permalink($child->ID).'" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー '.$child->post_title.'"><span class="txt-box">'.$child->post_title.'</span></a></li>';
					}
					if (is_user_loggedin()) {
						echo'<li id="" class=""><a href="/media/" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー メディアコンテンツ"><span class="txt-box">メディアコンテンツ</span></a></li>';
					}
					echo'</ul>
				</li>
				<li id="" class="has-children">
					<a class="acor-menu-ham gtm-click-link" aria-current="page" data-gtm-click="SPメニュー 社会貢献活動">'.$csr_icon.'社会貢献活動</a>
					<ul class="acor-menu-child px-0 py-2">';
					$excluded_slugs = ['csr-topics', 'volunteer2', 'clean', 'education', 'education_scholarship'];

					$ordered_terms = array_filter($csr_cats, function($t) use ($excluded_slugs) {
						return !in_array($t->slug, $excluded_slugs, true);
					});

					usort($ordered_terms, function($a, $b) {
						$order_a = get_field('menu_order', 'csr_cat_' . $a->term_id);
						$order_b = get_field('menu_order', 'csr_cat_' . $b->term_id);
						return ($order_a ?? 9999) <=> ($order_b ?? 9999);
					});
					foreach ($ordered_terms as $t) {
						$id = $t->term_id;
						$child = get_term_children($id, 'csr_cat');
			
						$url = '/social-contributions/category/?csr_cat=' . $t->slug;
						if ($child) {
							$url = '/social-contribution/?cat_id=' . $id;
						}
			
						if ($id == 82) {
							$url = '/social-contribution/#mottainai_pro';
						} elseif ($id == 84) {
							$url = '/social-contributions/category/?csr_cat=csr-activities';
						} elseif ($id == 305) {
							$url = '/social-contributions/category/?csr_cat=brights';
						}
			
						echo '<li class="' . esc_attr($t->slug) . '">';
						echo '<a href="' . esc_url($url) . '" aria-current="page">';
						echo '<span class="txt-box gtm-click-link" data-gtm-click="SPメニュー サブメニュー 社会貢献活動 ' . esc_attr(strip_tags($t->name)) . '">' . esc_html($t->name) . '</span>';
						echo '</a></li>';
					}
						echo'</ul>
				</li>';
				if($login){
					echo '
					<li id="" class=""><a href="/aul/" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー 会報誌aul【あうる】専用ページ">'.$aul_icon.'会報誌aul【あうる】専用ページ</a></li>
					<li id="" class=""><a href="/#recommended-insurance" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー おすすめ保険">'.$insurance_icon.'おすすめ保険</a></li>
					<li id="" class="hamburger-mypage"><a data-formid="submitMypage" data-formabout="mypage" class="mypage_form d-inline-block text-nowrap gtm-click-link" aria-current="page" data-gtm-click="SPメニュー マイページ"><svg width="3rem" height="3rem" class="mypage-icon d-inlineblock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 99.28"><path id="ic_person_add_24px" d="M65.966,53.64a24.821,24.821,0,1,0-25-24.82A24.9,24.9,0,0,0,65.966,53.64Zm0,12.41c-16.687,0-50,8.315-50,24.82v12.41h100V90.87C115.966,74.365,82.653,66.05,65.966,66.05Z" transform="translate(-15.966 -4)" fill=""/></svg>マイページ</a></li>
					<li id="" class="sp-business_menu"><a href="/business/" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー ビジネス"><img src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_business.png">ビジネス</a></li>';
				}
				echo'<li id="" class=""><a href="/contact" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー お問合せ">'.$contact_icon.'お問合せ</a></li>';
				if(!$login){
					echo '<li id="" class="hamburger-registermember"><a href="/regist" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー 新規会員登録">'.$registermember_icon.'新規会員登録</a></li>';
					echo '<li id="" class="has-children">
							<a class="acor-menu-ham gtm-click-link" aria-current="page" data-gtm-click="SPメニュー 各種変更手続きについて">
								<svg class="procedure-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
									<g transform="translate(5619 -2402)">
										<rect transform="translate(-5619 2402)" fill="none"/>
										<g id="アンケートシートの無料アイコン" transform="translate(-5634.879 2406.424)">
											<path d="M130.353,8.422h9.865a2.114,2.114,0,0,0,2.115-2.115V4.188a2.114,2.114,0,0,0-2.115-2.115h-2.673a2.268,2.268,0,0,0-4.52,0h-2.672a2.116,2.116,0,0,0-2.116,2.115V6.306A2.115,2.115,0,0,0,130.353,8.422Zm4.933-7.178a1.036,1.036,0,1,1-1.037,1.036A1.036,1.036,0,0,1,135.286,1.244Z" transform="translate(-95.128)" fill="#bbab72"/>
											<path d="M480.09,161a.137.137,0,0,1,.015.018.151.151,0,0,1,.015.011Z" transform="translate(-420.075 -148.685)" fill="#154560"/>
											<path d="M431.846,155.2a1.745,1.745,0,0,0-2.456.011l-1.555,1.555,2.441,2.441,1.555-1.555A1.746,1.746,0,0,0,431.846,155.2Z" transform="translate(-371.816 -142.871)" fill="#383838"/>
											<path d="M239.794,299.775l5.3-5.3-3.164-3.164-5.3,5.3a.817.817,0,0,0,0,1.152l2.011,2.011A.815.815,0,0,0,239.794,299.775Z" transform="translate(-195.013 -269.036)" fill="#383838"/>
											<path d="M209.263,379.781l-.734.735.423.423.735-.734,3.15-1.031-2.542-2.542Z" transform="translate(-169.28 -347.831)" fill="#383838"/>
											<path d="M332.1,59.965V67.1l2.488-2.488v-4.5a3.526,3.526,0,0,0-3.526-3.526h-3.108v1.979a3.365,3.365,0,0,1-.073.7h3.514A.705.705,0,0,1,332.1,59.965Z" transform="translate(-279.503 -52.258)" fill="#b2b2b2"/>
											<path d="M52.6,87.223a.705.705,0,0,1-.706.705H28.424a.705.705,0,0,1-.7-.705V59.965a.705.705,0,0,1,.7-.705h3.515a3.366,3.366,0,0,1-.074-.7V56.585H28.757a3.525,3.525,0,0,0-3.525,3.526V87.885a3.525,3.525,0,0,0,3.525,3.525h22.8a3.526,3.526,0,0,0,3.526-3.525V74.454L52.6,76.942V87.223Z" transform="translate(0 -52.258)" fill="#b2b2b2"/>
											<path d="M316.172,190.707l3.164,3.164,7.719-7.72-3.163-3.163Zm8.473-5.31a.7.7,0,0,1,0,.989l-3.756,3.756a.7.7,0,0,1-.989-.989l3.757-3.756A.7.7,0,0,1,324.645,185.4Z" transform="translate(-268.692 -168.995)" fill="#383838"/>
											<rect width="18" height="2" transform="translate(30.879 12.576)" fill="#464646"/>
											<rect width="15" height="2" transform="translate(30.879 18.576)" fill="#464646"/>
											<rect width="10" height="2" transform="translate(30.879 24.576)" fill="#464646"/>
											<rect width="6" height="2" transform="translate(30.879 30.576)" fill="#464646"/>
										</g>
									</g>
								</svg>
								各種変更手続きについて
							</a>
							<ul class="acor-menu-child px-0 py-2">
								<li><a href="/procedure/membership/" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー 会員種別変更のご案内">会員種別変更のご案内</a></li>
								<li><a href="/procedure/contract/" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー 契約者変更・サービス受領者変更のご案内">契約者変更・サービス受領者変更のご案内</a></li>
								<li><a href="/procedure/cooling-off/" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー サブメニュー 契約者変更・サービス受領者変更のご案内">解約・クーリングオフのご案内</a></li>
							</ul>
						</li>';
				}
				if($login){
					echo '<li id="" class=""><a href="/suggestion" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー 代表理事目安箱">'.$commentbox_ico.'代表理事目安箱</a></li>
					<li id="" class="hamburger-intromember"><a href="/introduce" aria-current="page" class="gtm-click-link" data-gtm-click="SPメニュー 新規会員紹介">'.$intromember_icon.'新規会員紹介</a></li>
					<li class="logout">
					<form method="post">
						<button type="submit" name="my_logout" class="border-0 shadow-none gtm-click-link" data-gtm-click="SPメニュー ログアウト">
							<p class="mb-0"><svg class="logout-icon d-inlineblock" width="3rem" height="3rem" viewBox="0 0 100 95.812" xmlns="http://www.w3.org/2000/svg"><g fill=""><path d="m25.021 178.778-5.921 5.922-13.179-13.179-5.921-5.921 5.921-5.921 13.179-13.179 5.921 5.922-8.993 8.991h50.439v8.373h-50.439z" transform="translate(0 -117.694)"/><path d="m162.14 0h-66.14v29.941h14.378v-14.97h46.01v65.87h-46.01v-14.97h-14.378v29.941h74.767v-95.812z" transform="translate(-70.767)"/></g></svg>ログアウト</p>
						</button>
					</form>
					</li>';
				}
			echo'</ul>
		</div>
	</div>';
	}
?>
    </header>
    <?php endif; // if ($menuHeader) ?>

    <script>
    jQuery(function($) {
        // ヘッダースクロールアニメーション処理
        var startPos = 0,
            winScrollTop = 0;
        $(window).on('scroll', function() {
            winScrollTop = $(this).scrollTop();

            if (winScrollTop >= startPos) {
                if (winScrollTop > 0) {
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