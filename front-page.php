<?php
/*
 * Template Name: ホーム
 */

global $unread;
global $unread_exist;
$unread_exist = '';
$unread_exist_month = '';
if (is_user_loggedin()){
	// 重要なお知らせの未読があるかどうか
	require(get_stylesheet_directory()."/api/count_unreads.php");
	$all_unread = count_important_unread($_SESSION['is_unread']);
	$unread = $all_unread['tab']; //お知らせタブの「重要」
	$unread_month = $all_unread['bar']; //ヘッダーメニュー下のバー

	if($unread>0){
		$unread_exist = 'unread-exist';
	}
	if($unread_month>0){
		$unread_exist_month = 'unread-exist-month';
	}
	$_SESSION['is_unread'] = $unread_month;
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
	// $tabindex = 'tabindex="-1"';
	$maintenance_text = '<p class="login-maintenance front-page">メンテナンス中</p>';
}

get_header(); ?>

<?php
	$home_id = get_the_ID();
	$login_top_movie = CFS()->get('nmember_page_top_movie');
?>
<div id="home" class="page-wrapper container-fluid px-0 <?php if($member_type){echo $member_type; }else{ echo 'n_member';} ?> <?php echo $display_type; ?> <?php echo $login; ?>">
	<?php if($_SESSION['member_info']): ?>
		<?php if ($login): ?>
			<?php if ($unread_exist_month) : ?>
			<div class="header-announce container <?php echo $display_type; ?> rounded">
				<p class="mb-0 py-1 text-danger">
					<span class="px-txt">過去１か月の</span>未読が<span class="unread-info bold px-sm-2 px-1" style="font-size: 1.4rem;"><?php echo $unread_month; ?></span>件あります。
					<span class="sp-txt">(過去１か月)</span>
				</p>
				<div class="unread-link">
					<a href="/information/?tab=unread" class="check-info-button btn btn-sm btn-outline-danger px-4 m-0 ml-sm-2 mb-sm-1 rounded-pill gtm-click-link" data-gtm-click="ホーム 過去1ヶ月の未読のインフォメーション">
						確認する
					</a>
				</div>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<?php
			// スライドを優先度順にソート
			$top_slide = $cfs->get('top_slide_add');
			$startdate = $_SESSION['member_info']['startdate'];
			if ($top_slide) :
				$top_slide_ary = sortByKey('top_slide_priority', SORT_ASC, $top_slide);
				$data_js =  json_encode( $top_slide_ary );
		?>
		<div class="top_slide_wrapper container bg-white pt-5 pb-3">
			<div class="top_slide_innerwrapper">
				<div class="top-slide-div">
					<?php foreach( $top_slide_ary as $ts ) : ?>
						<?php
							$class = '';
							$setting = 'href="'.$ts['top_slide_link'].'" class="slide-img gtm-click-link" data-gtm-click="'.strip_tags($ts['top_slide_link']).'"';
							if($ts['top_slide_offtime']){
								$setting = 'data-formid="submit_offTime" class="gtm-click-link" data-gtm-click=全厚済Off Time""';
								$class = 'js_form_btn';
							}
							if($ts['top_slide_mall']){
								if ($startdate <= date("Y/m/d")) {
									$setting = 'data-formid="submit_mall" class="gtm-click-link" data-gtm-click="全厚済モール"';
									$class = 'js_form_btn';
								} else {
									$setting = 'class="limit_startdate"';
									$class = 'js_form_btn';
									$limit_startdate = '<p class="limit_startdate__text">サービス利用開始日以降にご利用いただけます</p>';
								}
							}
							$title = str_replace('<br />', '', $ts['top_slide_title']);
						?>
						<div class="top-slide <?php echo $class; ?>">
							<a <?php echo $setting; ?>>
								<img class="mx-auto" src="<?php echo $ts['top_slide_img']; ?>" alt="<?php echo $ts['top_slide_title']; ?>">
								<?php if($ts['top_slide_mall']){ echo $limit_startdate; } ?>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
	<?php else:?>
		<div class="home-page-top-wrapper bg-white position-relative">
			<div class="home-page-top-innerwrapper text-center">
				<?php if(wp_is_mobile()) : ?>
				<img class="mb-0" src="<?php echo CFS()->get('nmember_page_top_sp'); ?>" alt="一般財団法人全国福利厚生共済会">
				<?php else: ?>
				<img class="mb-0" src="<?php echo CFS()->get('nmember_page_top'); ?>" alt="一般財団法人全国福利厚生共済会">
				<?php endif; ?>
			</div>
			<div class="home-page-top-movie">
				<div class="modal_trigger--video h-100">
					<button class="link-btn" data-type="pop-up" class="gtm-click-link" data-gtm-click="ログイン前 <?php echo CFS()->get('movie_btn_name'); ?>">
					<p class="mb-0 d-flex align-items-center justify-content-between">
						<span><?php echo CFS()->get('movie_btn_name'); ?></span><i class="pl-2 fa-regular fa-window-restore"></i>
					</p>
					</button>
				</div>
				<div class="modal_box--video">
					<div class="modal_bg"></div>
					<div class="modal_inner">
						<div class="modal_block">
							<div class="movie-item">
							<video muted controls playsinline poster="<?php echo CFS()->get('movie_th'); ?>" controlsList="nodownload" oncontextmenu="return false;" data-video-id="top_movie">
								<source data-src="<?php echo $login_top_movie; ?>#t=0.1" type="video/mp4">
							</video>
							<button class="link-btn modal_close">
								<p class="mb-0">閉じる<i class="pl-2 fa-solid fa-xmark"></i></p>
							</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="home pt-4">
		<?php if ($login): ?>
			<?php if ($member_type == 'p_member'): ?>
			<div class="home-link-div container business-content mb-5">
				<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
					<h2 class="d-flex align-items-center my-1 pt-1">
						<img class="tit-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/menu/menu_icon_business.png" >
						<span>ビジネス</span>
					</h2>
					<div class="list-link d-none d-sm-block">
						<a href="/business/" class="gtm-click-link" data-gtm-click="ビジネスページで全て見る（PC）">
							<span>ビジネスページで全て見る</span><i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<div class="container-fluid">
					<div class="home-link_list row">
						<?php
							$fields = $cfs->get('business_link_list');
							foreach ($fields as $field) :
						?>
						<div class="home-link_list__item col-lg-3 col-6">
							<a href="<?php echo $field['business_url']; ?>" class="gtm-click-link" data-gtm-click="<?php echo strip_tags($field['link_name']); ?>">
								<div class="home-link_list__item__content rounded text-center">
									<div class="shop-link-list__item__content__name">
										<span><?php echo $field['link_name']; ?></span>
									</div>
								</div>
							</a>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="list-link d-sm-none text-center mt-4">
					<a href="/business/" class="px-3 pb-1 border-bottom border-color-dark-<?php echo $member_type; ?> color-dark-<?php echo $member_type; ?> gtm-click-link" data-gtm-click="ビジネスページで全て見る（SP）">
						<span class="pr-2">ビジネスページで全て見る</span><i class="fas fa-arrow-right"></i>
					</a>
				</div>
			</div>
			<?php endif; ?>
			<div class="home-link-div container llservice-content mb-5">
				<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
					<h2 class="d-flex align-items-center my-1 pt-1">
						<img class="tit-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/menu/menu_icon_llservice.png" >
						<span>ライフサポートサービス</span>
					</h2>
					<div class="list-link d-none d-sm-block">
						<a href="/lifesupport/" class="gtm-click-link" data-gtm-click="ライフサポートサービス 全てのサービスを見る（PC）">
							<span>全てのサービスを見る</span><i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<?php
					$limit_class = '';
					$today = date_i18n('U');
					if ($today < strtotime($startdate)) {
						$limit_class = 'home_limit_startdate';
					}
				?>
				<div class="<?php echo $limit_class; ?>">
					<div class="container-fluid">
						<div class="home-link_list row">
							<?php
								$shop_link_list = $cfs->get('shop_link_list');
								foreach ($shop_link_list as $shop_link_item) :
									$link_name = $shop_link_item['link_name'];
									$link_icon = $shop_link_item['link_icon'];
									$shop_url = $shop_link_item['shop_url'];
									$shop_data_formid = $shop_link_item['shop_data_formid'];
									$shop_data_formabout = $shop_link_item['shop_data_formabout'];
									$shop_deficient_popup = $shop_link_item['shop_deficient_popup'];
							?>
								<?php
									// メンテナンス表示
									$maintenance = '';
									$disabled = '';
									$maintenance_text = '';
									$today_date = new DateTime('now');
									$maintenance_start = new DateTime('2023-10-17 08:00:00');
									$maintenance_end = new DateTime('2023-10-17 09:00:00');
									if ($shop_data_formabout == 'life_seminar') {
										if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) {
											$maintenance = 'now-maintenance bg-white text-body';
											$disabled = 'disabled style="pointer-events: none;""';
											$maintenance_text = '<p class="mb-0"><span class="business-maintenance">メンテナンス中</span></p>';
										}
									}
								?>
								<div class="home-link_list__item col-lg-3 col-6 <?php if($shop_data_formid && !$shop_data_formabout) { echo 'js_form_btn'; } ?>">
									<?php
										if ($shop_data_formabout && $shop_deficient_popup) {
											echo '<div class="cursor-pointer deficient_popup gtm-click-link '.$maintenance.'"';
										} elseif ($shop_data_formabout && $shop_deficient_popup) {
											echo '<div class="cursor-pointer seminar_form gtm-click-link '.$maintenance.'"';
										} elseif ($shop_deficient_popup) {
											echo '<a class="cursor-pointer deficient_popup gtm-click-link '.$maintenance.'"';
										} else {
											echo '<a class="cursor-pointer gtm-click-link '.$maintenance.'"';
										}
										if ($shop_link_item['shop_limit'] == 0 || $limit_class == '') {
											if ($shop_data_formid && $shop_data_formabout) {
												echo ' data-formid="'.$shop_data_formid.'" data-formabout="'.$shop_data_formabout.'"';
											} elseif ($shop_data_formid) {
												echo ' data-formid="'.$shop_data_formid.'"';
											} elseif ($shop_url) {
												echo ' href="'.$shop_url.'" target="_blank"';
											}
										}
										echo $disabled;
										echo ' data-gtm-click="'.$link_name.'（ショップサイトリンク）">';
									?>
										<div class="home-link_list__item__content rounded text-center">
											<div class="shop-link-list__item__content__name">
												<span><?php echo $link_name; ?></span>
											</div>
										</div>
										<?php echo $maintenance_text; ?>
						
									<?php
										if ($shop_data_formabout) {
											echo '</div>';
										} else {
											echo '</a>';
										}
									?>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php if ($limit_class) : ?>
						<div class="home-link_note position-absolute">
							<p class="mb-0">サービス利用開始日以降<br class="d-sm-none">ご利用いただけます</p>
						</div>
					<?php endif; ?>
				</div>
				<div class="list-link d-sm-none text-center mt-4">
					<a href="/lifesupport/" class="px-3 pb-1 border-bottom border-color-dark-<?php echo $member_type; ?> color-dark-<?php echo $member_type; ?> gtm-click-link" data-gtm-click="ライフサポートサービス 全てのサービスを見る（SP）">
						<span class="pr-2">全てのサービスを見る</span><i class="fas fa-arrow-right"></i>
					</a>
				</div>
			</div>
		<?php endif; ?>
		<?php if(!$login): ?>
		<?php if(CFS()->get('top_before-bnr') ): ?>
		<div class="home-page-top_before-bnr mx-auto">
			<a href="<?php echo CFS()->get('top_before-bnr_link'); ?>" target="_blank">
				<img class="mb-0" src="<?php echo CFS()->get('top_before-bnr'); ?>" alt="<?php echo CFS()->get('top_before-bnr_tit'); ?>">
			</a>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		<div class="home-info-div pb-0">
			<?php if($login): ?>
			<div class="info-bg">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home/about-bg.png" alt="背景">
			</div>
			<?php endif; ?>
			<?php if(!$login): ?>
			<a class="d-none" href="https://official-webdev.zenko-sai.or.jp/cms/wp-content/uploads/2026/03/保険カムバックLP作成.pdf" target="_blank">PDFの会員制御テスト</a>
			<div class="home-members bg-white pb-0 pt-3 py-md-3">
				<div class="container">
					<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
						<h2 class="d-flex align-items-center my-1 pt-1">
							<svg class="tit-icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
								<g transform="translate(5970 -2402)">
									<path d="M8.276,34.837c-.014-.028-19.194-14.222.889-32.121C9.1,2.79-.983,16.048,8.276,24.1c9.3,8.088,17.493-2.021,17.493-2.021s6.668,10.34-5.436,15.737a8.942,8.942,0,0,1-2.555.315A16.739,16.739,0,0,1,8.276,34.837Zm25.041-3.013c.221-4.02-1.613-6.953-9.235-14.549s2.76-15.669,2.791-15.658c19.222,7.645,8.1,30.629,6.6,30.626C33.36,32.243,33.3,32.109,33.317,31.824ZM9.064,13.992C9.039,14,5.734.53,20.708,0c-.121.051-12.692,7.586,2.881,20.084A14.6,14.6,0,0,1,18.374,21.1C15.064,21.1,11.044,19.756,9.064,13.992Zm.1-11.276h0Z" transform="translate(-5964.62 2408.159)"/>
									<rect width="50" height="50" transform="translate(-5970 2402)" fill="none"/>
								</g>
							</svg>
							<span class="color-dark-<?php echo $member_type; ?>">全厚済の会員募集について</span>
						</h2>
					</div>
					<div class="container-fluid">
						<div class="top-content row d-flex flex-row mt-3 my-md-3">
							<div class="caution-bg px-0 px-md-3 mb-3 mb-md-0">
								<div class="home-caution-div">
									<div class="tokutei-div bg-white rounded07 p-3 mb-3">
										<p class="tokutei-txt mb-0">
											<?php echo $cfs->get('special_commercial'); ?>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="home-link_list row">
						<div class="link-item">
							<a href="/non-member_faq/" class="gtm-click-link" data-gtm-click="会員募集についてよくある質問<?php if(wp_is_mobile()) : ?>（SP）<?php else: ?>（PC）<?php endif; ?>">
								<img src="<?php echo CFS()->get('faq_bnr'); ?>" alt="会員募集についてよくある質問">
							</a>
						</div>
						<div class="link-item">
							<a href="/questionnaire/" class="gtm-click-link" data-gtm-click="アンケートへ<?php if(wp_is_mobile()) : ?>（SP）<?php else: ?>（PC）<?php endif; ?>">
								<img src="<?php echo CFS()->get('questionnaire_bnr'); ?>" alt="勧誘時のアンケート">
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<div class="home-info-content container">
				<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
					<h2 class="d-flex align-items-center my-1 pt-1">
						<svg class="tit-icon fill-dark-<?php echo $member_type; ?>" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<g transform="translate(-220 -1109)">
								<rect width="50" height="50" transform="translate(220 1109)" fill="none"/>
								<g transform="translate(227.783 1113.005)">
								<path d="M204.4,454.108a4.667,4.667,0,0,0,4.577,4.573h.1a4.707,4.707,0,0,0,4.676-4.574l0-.132h-9.362Z" transform="translate(-191.3 -417.155)"/>
								<path d="M77.32,29.4c-.057-.711-.118-1.451-.182-2.089-.032-.319-.064-.612-.1-.909-.015-.117-.029-.227-.047-.331-.017-.12-.037-.231-.065-.366a2.966,2.966,0,0,0-.131-.425,3.678,3.678,0,0,0-.269-.543c-.085-.14-.167-.264-.255-.385-.159-.223-.33-.433-.511-.645-.289-.34-.62-.7-1.01-1.1-.525-.54-1.06-1.056-1.471-1.445l-.037-.035-.056-.547c-.147-1.439-.374-3.666-.53-5.137A11.272,11.272,0,0,0,71.3,11.1a10.974,10.974,0,0,0-1.977-2.573,11.85,11.85,0,0,0-4.014-2.537,12.364,12.364,0,0,0-1.22-.391,4.072,4.072,0,0,0,.279-1.469A4.111,4.111,0,0,0,62.555.706,4.126,4.126,0,0,0,56.391,5.6c-.24.064-.478.132-.712.211a12.284,12.284,0,0,0-2.855,1.387,11.131,11.131,0,0,0-4.991,8.248c-.147,1.412-.362,3.518-.509,4.958l-.074.727c-.24.226-.525.5-.831.8-.256.251-.524.519-.786.792-.2.206-.394.415-.584.623-.14.156-.276.311-.41.469a8.618,8.618,0,0,0-.554.736A4.507,4.507,0,0,0,43.82,25c-.043.087-.086.183-.132.3a2.863,2.863,0,0,0-.123.408c-.028.132-.047.244-.065.362-.035.219-.064.458-.094.729-.054.47-.106,1.03-.155,1.612-.148,1.726-.279,3.7-.279,3.708a2.3,2.3,0,0,0,2.293,2.451h29.96a2.3,2.3,0,0,0,2.293-2.443C77.519,32.108,77.431,30.8,77.32,29.4Zm-29.546.1c.054-.651.11-1.31.164-1.845.027-.265.054-.5.078-.678l0-.03c.055-.071.124-.158.207-.256.214-.252.5-.562.807-.874.459-.472.955-.951,1.333-1.307.188-.178.556-.519.628-.583a2.307,2.307,0,0,0,.744-1.475l.08-.8c.137-1.337.413-4.04.591-5.73a6.736,6.736,0,0,1,.8-2.593,6.442,6.442,0,0,1,1.152-1.5,7.255,7.255,0,0,1,2.466-1.55,8.684,8.684,0,0,1,3.081-.559c.091,0,.181,0,.271,0l.407,0a8.617,8.617,0,0,1,2.762.445,7.791,7.791,0,0,1,1.787.865,6.519,6.519,0,0,1,2.95,4.891c.122,1.157.291,2.791.428,4.134l.242,2.4a2.314,2.314,0,0,0,.753,1.479c.043.039.245.222.526.488.237.222.532.5.84.805.229.227.468.465.693.7.168.175.328.347.473.508.108.118.2.23.287.33.057.068.107.13.147.183.016.128.036.291.057.475.044.419.093.948.139,1.5.03.348.059.7.085,1.05H47.738ZM61.425,3.332a1.368,1.368,0,0,1-.218,1.817l-.143-.008c-.16-.009-.319-.019-.48-.019-.116,0-.23,0-.336.005s-.231-.005-.342-.005c-.185,0-.368.01-.551.02l-.087,0a1.318,1.318,0,0,1-.2-.227,1.392,1.392,0,0,1-.242-.793,1.409,1.409,0,0,1,.626-1.179A1.428,1.428,0,0,1,60.8,2.816,1.438,1.438,0,0,1,61.425,3.332Z" transform="translate(-42.967)"/>
								</g>
							</g>
						</svg>
						<span class="color-dark-<?php echo $member_type; ?>">インフォメーション</span>
					</h2>
					<div class="list-link d-none d-sm-block">
						<a class="color-dark-<?php echo $member_type; ?> gtm-click-link" href="/information/" data-gtm-click="インフォメーション一覧（PC）">
							<span>一覧へ</span><i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<div class="home-info-div__list">
					<?php
						$args = array(
							'posts_per_page' => 2,
							'post_type'      => array('information', 'social-contribution'),
                            'date_query' => array(
                                array(
                                    'after' => date("Y-m-d",strtotime("-1 month")),
                                    'inclusive' => true,
                                ),
                            ),
							'meta_query'=> array(
								array(
									'relation' => 'OR',
									array(
										'key'     =>'display_information',
										'compare' => 'NOT EXISTS',
									),
									array(
										'key'     =>'display_information',
										'value'   => '1', //true,falseの1
										'compare' => '=',
									),
								),
							),
						);
						$no_info_text = '<p class="mx-auto py-3">現在投稿記事はありません。</p>';
						if ($login) :
					?>
						<ul class="nav nav-tabs border-0" id="infoTab" role="tablist">
							<li class="info-button nav-item">
								<a class="font-smaller border-color-dark-<?php echo $member_type; ?> nav-link active py-1" id="home-info-tab" data-toggle="tab" href="#home-info" role="tab" aria-controls="home" aria-selected="true">お知らせ</a>
							</li>
							<li class="info-button nav-item">
								<a class="font-smaller border-color-dark-<?php echo $member_type; ?> nav-link py-1" id="home-service-tab" data-toggle="tab" href="#home-service" role="tab" aria-controls="service" aria-selected="false">サービス</a>
							</li>
							<li class="info-button nav-item">
								<a class="font-smaller border-color-dark-<?php echo $member_type; ?> nav-link py-1" id="home-csr-tab" data-toggle="tab" href="#home-csr" role="tab" aria-controls="csr" aria-selected="false">社会貢献活動・CSR活動</a>
							</li>
						</ul>
						<div class="tab-content" id="infoTabContent">
							<div class="tab-pane fade show active" id="home-info" role="tabpanel" aria-labelledby="home-info-tab">
								<?php
									$posts = get_posts($args);
									if ($posts) {
										foreach ($posts as $post) {
											setup_postdata($post);
											get_template_part('templates/information-loop');
										}
									} else {
										echo $no_info_text;
									}
									wp_reset_postdata();
								?>
							</div>
							<div class="tab-pane fade" id="home-service" role="tabpanel" aria-labelledby="home-service-tab">
								<?php
									$args_service = array(
										'posts_per_page' => 2,
										'post_type' => 'information',
                                        'date_query' => array(
                                            array(
                                                'after' => date("Y-m-d",strtotime("-1 month")),
                                                'inclusive' => true,
                                            ),
                                        ),
										'tax_query' => array(
											array(
												'taxonomy' => 'news',
												'field' => 'slug',
												'terms' => 'llservice',
											)
										),
									);
									$posts_service = new WP_Query($args_service);
									if ( $posts_service->have_posts() ) {
										while ( $posts_service->have_posts() ) : $posts_service->the_post();
											get_template_part('templates/information-loop');
										endwhile;
										wp_reset_postdata();
									} else {
										echo $no_info_text;
									}
								?>
							</div>
							<div class="tab-pane fade" id="home-csr" role="tabpanel" aria-labelledby="home-csr-tab">
								<?php
									$csr_id = get_term_by('slug','csr','news');
									$csr_cat_terms = get_terms('csr_cat');
									$csr_cat_term_ids = array_column( $csr_cat_terms, 'term_id' );
									$args_csr = array(
										'posts_per_page' => 2,
										'post_type' => array('information','social-contribution'),
                                        'date_query' => array(
                                            array(
                                                'after' => date("Y-m-d",strtotime("-1 month")),
                                                'inclusive' => true,
                                            ),
                                        ),
										'tax_query' => array(
											array(
												'relation' => 'OR',
												array(
													'taxonomy' => 'news',
													'field' => 'id',
													'terms' => $csr_id,
													'operator' => 'IN',
												),
												array(
													'taxonomy' => 'csr_cat',
													'field' => 'id',
													'terms' => $csr_cat_term_ids,
													'operator' => 'IN',
												),
											),
										),
										'meta_query' => array(
											array(
												'relation' => 'OR',
												array(
													'key'     =>'display_information',
													'compare' => 'NOT EXISTS',
												),
												array(
													'key'     =>'display_information',
													'value'   => '1', //true,falseの1
													'compare' => '=',
												),
											),
										),
									);
									$posts_csr = new WP_Query($args_csr);
									if ( $posts_csr->have_posts() ) {
										while ( $posts_csr->have_posts() ) : $posts_csr->the_post();
											get_template_part('templates/information-loop');
										endwhile;
										wp_reset_postdata();
									} else {
										echo $no_info_text;
									}
								?>
							</div>
						</div>
					<?php else : ?>
						<div>
							<?php
								// ログイン前は「送付物」、「ビジネス」、「キャンペーン」に関するお知らせを表示しない。
								$attatchment = get_term_by('slug','attatchment','news');
								$attatchment_id = $attatchment->term_id;
								$business = get_term_by('slug','business','news');
								$business_id = $business->term_id;
								$campaign = get_term_by('slug','campaign','news');
								$campaign_id = $campaign->term_id;
								$args_no_login = array(
									'posts_per_page' => 2,
									'post_type' => array('information','social-contribution'),
									'date_query' => array(
										array(
											'after' => date("Y-m-d",strtotime("-1 month")),
											'inclusive' => true,
										),
									),
									'tax_query' => array(
										array(
											'taxonomy' => 'news',
											'field' => 'id',
											'terms' => array($attatchment_id, $business_id, $campaign_id),
											'operator' => 'NOT IN',
										)
									),
									'meta_query' => array(
										array (
											'relation' => 'OR',
											array(
												'key'     =>'restriction_information',
												'compare' => 'NOT EXISTS',
											),
											array(
												'key'     =>'restriction_information',
												'value'   => '0', //true,falseの1
												'compare' => '=',
											),
										),
										array(
											'relation' => 'OR',
											array(
												'key'     =>'display_information',
												'compare' => 'NOT EXISTS',
											),
											array(
												'key'     =>'display_information',
												'value'   => '1', //true,falseの1
												'compare' => '=',
											),
										),
									),
								);
								$posts_no_login = new WP_Query($args_no_login);
								if ( $posts_no_login->have_posts() ) {
									$has_visible_post = false; // 表示対象の記事があるかフラグ
									while ( $posts_no_login->have_posts() ) : $posts_no_login->the_post();
										$csr_info_nologin = CFS()->get('csr_info_nologin', get_the_ID());
										if (!$csr_info_nologin) { // csr_info_nologin にチェックが入っていない記事だけ出す
											get_template_part('templates/information-loop');
											$has_visible_post = true;
										}
									endwhile;
									if (!$has_visible_post) {
										echo $no_info_text;
									}
									wp_reset_postdata();
								} else {
									echo $no_info_text;
								}
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="list-link d-sm-none text-center mt-4">
				<a href="/information/" class="px-3 pb-1 border-bottom border-color-dark-<?php echo $member_type; ?> color-dark-<?php echo $member_type; ?> gtm-click-link" data-gtm-click="インフォメーション一覧（SP）">
					<span class="pr-2">一覧へ</span><i class="fas fa-arrow-right"></i>
				</a>
			</div>
		</div>
		<?php if ($login): ?>
			<div id="aul" class="home-aul-div container my-5 text-center">
				<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
					<h2 class="d-flex align-items-center my-1 pt-1">
						<svg class="tit-iconn fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<g transform="translate(-1249 -141)">
								<rect transform="translate(1249 141)" fill="none"/>
								<g transform="translate(1253.969 88.273)">
								<path class="stroke-dark-<?php echo $member_type; ?>" d="M35.385,66V63.253a.662.662,0,0,0-.661-.66H29.28a5.821,5.821,0,0,0-1.023.108A13.8,13.8,0,0,0,26,63.339a16.782,16.782,0,0,0-3.758,1.939,10.726,10.726,0,0,0-1.629,1.393,7.873,7.873,0,0,0-.584.7,8.575,8.575,0,0,0-1.4-1.465,15.554,15.554,0,0,0-4.221-2.432,16,16,0,0,0-2.017-.648c-.308-.075-.6-.133-.867-.172a5.241,5.241,0,0,0-.747-.061H5.338a.662.662,0,0,0-.66.66V66H0V91.21l18.247,1.1v.55h3.57v-.55l18.246-1.1V66ZM17.193,90.051a28.569,28.569,0,0,0-3.1-.69c-1.036-.176-2.02-.293-2.811-.352-1.541-.11-3.963-.209-6.008-.28-1.272-.045-2.4-.078-3.064-.1V68.171H4.678V86.806a.662.662,0,0,0,.66.661h5.446a4.52,4.52,0,0,1,.786.086,12.88,12.88,0,0,1,2.033.578,15.558,15.558,0,0,1,3.455,1.78l.229.166C17.255,90.069,17.224,90.058,17.193,90.051Zm2.179.094c-.231-.238-.478-.468-.736-.686a15.519,15.519,0,0,0-4.221-2.431A15.6,15.6,0,0,0,12.4,86.38c-.308-.076-.6-.132-.867-.171a4.931,4.931,0,0,0-.747-.064H6V63.915h4.784A4.5,4.5,0,0,1,11.57,64a12.529,12.529,0,0,1,2.033.58,15.452,15.452,0,0,1,3.455,1.78,9.289,9.289,0,0,1,1.426,1.217,5.43,5.43,0,0,1,.888,1.226V90.145Zm1.32,0V68.806a6.33,6.33,0,0,1,1.587-1.89A14.272,14.272,0,0,1,26.133,64.7a14.6,14.6,0,0,1,1.844-.593c.274-.067.527-.116.748-.149a3.7,3.7,0,0,1,.555-.046h4.784V86.146H29.28a5.946,5.946,0,0,0-1.023.109A13.925,13.925,0,0,0,26,86.893a16.834,16.834,0,0,0-3.758,1.939A10.674,10.674,0,0,0,20.692,90.146Zm17.164-1.531H31.675c-.345,0-.762.024-1.239.07-.835.081-1.854.224-2.932.412a42.722,42.722,0,0,0-4.816,1.11l-.138.042a14.715,14.715,0,0,1,3.582-1.992,14.214,14.214,0,0,1,1.844-.593c.274-.067.527-.117.748-.149a3.891,3.891,0,0,1,.555-.048h5.444a.662.662,0,0,0,.661-.661V68.171h2.471Z" fill="none"/>
								</g>
							</g>
						</svg>
						<span class="color-dark-<?php echo $member_type; ?>">会報誌aul【あうる】専用ページ</span>
					</h2>
				</div>
				<div>
					<div class="home-aul-div__about mb-5 mb-sm-4 col-12 col-md-4 col-lg-3">
						<a href="<?php echo CFS()->get('aul_link'); ?>">
							<div class="home-aul-div__about__img">
								<img src="<?php echo CFS()->get('aul_bnr'); ?>">
							</div>
						</a>
						<div class="home-aul-div__about__txt text-left">
							<?php echo CFS()->get('aul_about'); ?>
						</div>
					</div>
				</div>
			</div>
			<div id="recommended-insurance" class="home-insurance-div container my-5 text-center">
				<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
					<h2 class="d-flex align-items-center my-1 pt-1">
						<svg class="tit-iconn fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<g transform="translate(6028 -2402)">
								<rect width="50" height="50" transform="translate(-6028 2402)" fill="none"/>
								<g transform="translate(-6054.89 2405.504)">
								<path d="M397.457,271.924l.007,0,.01-.007Z" transform="translate(-333.124 -247.993)" fill="#4b4b4b"/>
								<path class="stroke-dark-<?php echo $member_type; ?>" d="M70.43,261.116h0a3.773,3.773,0,0,0-1.33-.931,4.245,4.245,0,0,0-1.638-.319,5.152,5.152,0,0,0-1.633.277,5.506,5.506,0,0,0-1.489.775l-.038.028-.012.008-.043.037c-.049.042-.144.114-.267.2-.432.32-1.232.872-2.179,1.516-.622.421-1.31.883-2.006,1.347,0-.034,0-.068,0-.1a4.109,4.109,0,0,0-4.105-4.105H47a16.024,16.024,0,0,0-3.72.4,10.849,10.849,0,0,0-3.826,1.7,17.339,17.339,0,0,0-2.423,2.166c-.139.142-.275.283-.412.418l-3.4,2.973a2.964,2.964,0,0,0-1.012,2.229v10.02a2.275,2.275,0,0,0,1.33,2.069h0a2.27,2.27,0,0,0,2.428-.347l6.339-5.434,9.973,1.812a4.6,4.6,0,0,0,.833.076,4.65,4.65,0,0,0,2.692-.852l0,0c.682-.475,4.019-2.8,7.311-5.1,1.647-1.153,3.28-2.3,4.568-3.216.642-.458,1.2-.856,1.627-1.168.215-.155.4-.289.543-.4s.255-.194.332-.258h0l.026-.022.011-.009.034-.032a4.2,4.2,0,0,0,.972-1.319,3.852,3.852,0,0,0,.357-1.567v-.049A4.2,4.2,0,0,0,70.43,261.116Zm-1.489,4.34c-.979.815-14.247,10.041-14.247,10.041a2.749,2.749,0,0,1-2.074.461l-10.395-1.89a1.036,1.036,0,0,0-.853.229L34.7,280.016a.339.339,0,0,1-.366.052.343.343,0,0,1-.2-.311v-10.02a1.022,1.022,0,0,1,.353-.775l3.451-3.015c1.9-1.9,3.624-4.166,9.06-4.166h8.694a2.173,2.173,0,1,1,0,4.347H49.713l.026.014a.774.774,0,1,0-.051,1.547l.025-.012h8.115s6.677-4.388,7.654-5.2c1.068-.791,2.667-.989,3.525-.055A2.049,2.049,0,0,1,68.94,265.456Z" transform="translate(0 -236.992)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.25"/>
								<path class="stroke-dark-<?php echo $member_type; ?>" d="M143.023,17.973a23.906,23.906,0,0,0,4,2.1,1.66,1.66,0,0,0,1.264,0,23.967,23.967,0,0,0,4-2.1c2.7-1.839,7.073-5.45,7.073-10.537,0-5.163-2.92-7.5-6.132-7.435a5.86,5.86,0,0,0-4.868,2.919.785.785,0,0,1-1.412,0A5.862,5.862,0,0,0,142.081,0c-3.213-.067-6.133,2.272-6.133,7.435C135.948,12.524,140.325,16.135,143.023,17.973Z" transform="translate(-94.619 0)" fill="none" stroke-width="2.5"/>
							</g>
						</svg>
						<span class="color-dark-<?php echo $member_type; ?>">おすすめ保険</span>
					</h2>
				</div>
				<div>
					<div class="home-insurance-div__list mb-5 mb-sm-4">
						<h3 class="home-sub_tit border-color-dark-<?php echo $member_type; ?> text-left">新保険スタート！</h3>
						<div class="row mx-auto align-items-center mb-2 mb-md-4">
							<div class="comeback col-md-4 col-lg-3 px-0">
								<a href="/insurance/comeback/" class="d-block gtm-click-link" data-gtm-click="カムバック保険">
									<img src="<?php echo CFS()->get('comeback_banner'); ?>" title="カムバック保険"/>
								</a>
							</div>
						</div>
					</div>
					<?php
						$insurances = $cfs->get('insurances');
						if ($insurances) :
					?>
					<div class="home-insurance-div__list mb-5 mb-sm-4">
						<h3 class="home-sub_tit border-color-dark-<?php echo $member_type; ?> text-left">おすすめ団体保険（任意加入）</h3>
						<div class="insurance_bnr-list row">
							<?php
								foreach($insurances as $insurance) :
									$insurance_name = $insurance['insurance_name'];
									$insurance_banner = $insurance['insurance_banner'];
									$insurance_url = $insurance['insurance_url'];
									$insurance_new = $insurance['insurance_new'];
							?>
							<div class="insurance_bnr mb-2 mb-md-4 px-1">
								<?php if ($insurance_new) : ?>
									<div class="new_wrap position-absolute"><div class="new"><?php echo $insurance_new; ?></div></div>
								<?php endif; ?>
								<a href="<?php echo $insurance_url; ?>" class="gtm-click-link" data-gtm-click="<?php echo strip_tags($insurance_name); ?>">
									<img src="<?php echo $insurance_banner; ?>" title="<?php echo $insurance_name; ?>"/>
								</a>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
					<?php
						$insurances2 = $cfs->get('insurances2');
						if ($insurances2) :
					?>
					<div class="home-insurance-div__list">
						<h3 class="home-sub_tit border-color-dark-<?php echo $member_type; ?> text-left">おすすめ任意保険</h3>
						<div class="insurances_recomend_nini row">
							<?php
								foreach($insurances2 as $insurance2) :
									$insurance2_name = $insurance2['insurance2_name'];
									$insurance2_banner = $insurance2['insurance2_banner'];
									$insurance2_about = $insurance2['insurance2_about'];
									$insurance2_url = $insurance2['insurance2_url'];
									$insurance2_new = $insurance2['insurance2_new'];
							?>
							<div class="recomend_nini_bnr mb-3 mb-md-4 d-flex align-items-center px-1">
								<?php if ($insurance2_new) : ?>
									<div class="new_wrap position-absolute"><div class="new"><?php echo $insurance2_new; ?></div></div>
								<?php endif; ?>
								<a href="<?php echo $insurance2_url; ?>" target="_blank" class="gtm-click-nkyosai-link pr-3" data-gtm-click="<?php echo strip_tags($insurance2_name); ?>">
									<img class="w-100" src="<?php echo $insurance2_banner; ?>" title="<?php echo $insurance2_name; ?>">
								</a>
								<p class="mb-0 text-left"><?php echo $insurance2_about; ?></p>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
			<div class="home-about-div text-center position-relative">
				<div class="bg-top-wave">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home/about-bg.png" alt="背景">
				</div>
				<div class="about-content container py-5">
					<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
						<h2 class="d-flex align-items-center my-1 pt-1">
							<svg class="tit-icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
								<g transform="translate(5970 -2402)">
									<path d="M8.276,34.837c-.014-.028-19.194-14.222.889-32.121C9.1,2.79-.983,16.048,8.276,24.1c9.3,8.088,17.493-2.021,17.493-2.021s6.668,10.34-5.436,15.737a8.942,8.942,0,0,1-2.555.315A16.739,16.739,0,0,1,8.276,34.837Zm25.041-3.013c.221-4.02-1.613-6.953-9.235-14.549s2.76-15.669,2.791-15.658c19.222,7.645,8.1,30.629,6.6,30.626C33.36,32.243,33.3,32.109,33.317,31.824ZM9.064,13.992C9.039,14,5.734.53,20.708,0c-.121.051-12.692,7.586,2.881,20.084A14.6,14.6,0,0,1,18.374,21.1C15.064,21.1,11.044,19.756,9.064,13.992Zm.1-11.276h0Z" transform="translate(-5964.62 2408.159)"/>
									<rect width="50" height="50" transform="translate(-5970 2402)" fill="none"/>
								</g>
							</svg>
							<span class="color-dark-<?php echo $member_type; ?>">全厚済とは</span>
						</h2>
						<div class="list-link d-none d-sm-block">
							<a class="color-dark-<?php echo $member_type; ?> gtm-click-link" href="/about/" data-gtm-click="全厚済とは（PC）">
								<span>詳細へ</span><i class="fas fa-arrow-right"></i>
							</a>
						</div>
					</div>
					<img class="about-bg position-absolute" src="/cms/wp-content/themes/zenkosai/assets/images/icons/menu/menu_icon_about.png" title="全厚済とは背景"/>
					<div class="about-div mb-3 mt-4">
						<p class="mb-0 about-txt mb-3 p-4">一般財団法人全国福利厚生共済会は、相互扶助の理念のもと皆様の<strong>人生のトータルサポーター</strong>を目指しています。</p>
					</div>
					<div class="list-link d-sm-none text-center mt-4">
						<a href="/about/" class="px-3 pb-1 border-bottom border-color-dark-<?php echo $member_type; ?> color-dark-<?php echo $member_type; ?> gtm-click-link" data-gtm-click="全厚済とは（SP）">
							<span class="pr-2">詳細へ</span><i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</div>
				<div class="bg-bottom-wave">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home/about-bg.png" alt="背景">
				</div>
			</div>
		<?php if (!$login) : ?>
			<div class="home-csr-div container position-relative my-5">
				<div class="csr-div">
					<!-- <img class="csr-bg opacity05 position-absolute" src="<?php echo $member_type; ?>/assets/images/icons/home/csr_icon_magokoro.png" title="社会貢献活動背景"> -->
					<div class="home-main_tit border-color-dark-<?php echo $member_type; ?> d-flex align-items-center justify-content-between">
						<h2 class="d-flex align-items-center my-1 pt-1">
							<svg class="tit-icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
								<g transform="translate(5743 -2402)">
									<rect width="50" height="50" transform="translate(-5743 2402)" fill="none"/>
									<g transform="translate(-5739.123 2409.978)">
										<g transform="translate(0 0)" fill="none" stroke-linecap="round" stroke-linejoin="round">
											<path d="M4.882,20.508A11.215,11.215,0,1,1,21.123,6.068,11.2,11.2,0,1,1,40.293,17.573l.161.075-.988.992a11.284,11.284,0,0,1-1.024,1.028l-17.2,17.265Z" stroke="none"/>
											<path class="fill-dark-<?php echo $member_type; ?>" d="M 21.2439136505127 34.10013961791992 L 37.02433013916016 18.25774192810059 C 37.05464935302734 18.22729110717773 37.0859489440918 18.19783020019531 37.11817932128906 18.16940116882324 C 37.41560745239258 17.90700149536133 37.69913101196289 17.62237167358398 37.96084976196289 17.32343101501465 C 37.98912048339844 17.29114151000977 38.01841735839844 17.2597713470459 38.04869842529297 17.22936058044434 L 38.42911911010742 16.84746742248535 C 38.48378753662109 16.70707130432129 38.55464172363281 16.57205200195312 38.64118957519531 16.44532012939453 C 39.69144821166992 14.90741062164307 40.24657821655273 13.10414123535156 40.24657821655273 11.23047065734863 C 40.24657821655273 6.14077091217041 36.12556076049805 2.000000953674316 31.06014823913574 2.000000953674316 C 27.61540985107422 2.000000953674316 24.48875999450684 3.910320997238159 22.90035820007324 6.985461235046387 C 22.55703926086426 7.65014123916626 21.87147903442383 8.067630767822266 21.12336921691895 8.067621231079102 C 20.37526893615723 8.067610740661621 19.68971824645996 7.650081157684326 19.3464183807373 6.985391139984131 C 17.75819969177246 3.910290956497192 14.63145923614502 2.000000953674316 11.18638896942139 2.000000953674316 C 6.120999336242676 2.000000953674316 1.999999165534973 6.14077091217041 1.999999165534973 11.23047065734863 C 1.999999165534973 14.28295135498047 3.500239133834839 17.13486099243164 6.013149261474609 18.85933113098145 C 6.115408897399902 18.92950057983398 6.210908889770508 19.00903129577637 6.298439025878906 19.09690093994141 L 21.2439136505127 34.10013961791992 M 21.24395942687988 36.93408203125 L 4.881499290466309 20.50838088989258 C 1.93424916267395 18.4858512878418 -8.917236300476361e-07 15.08494091033936 -8.917236300476361e-07 11.23047065734863 C -8.917236300476361e-07 5.028191089630127 5.008499145507812 1.015625002764864e-06 11.18638896942139 1.015625002764864e-06 C 15.51107883453369 1.015625002764864e-06 19.26163864135742 2.462871074676514 21.12340927124023 6.067621231079102 C 22.98535919189453 2.462871074676514 26.73628997802734 1.015625002764864e-06 31.06014823913574 1.015625002764864e-06 C 37.23807907104492 1.015625002764864e-06 42.24657821655273 5.028191089630127 42.24657821655273 11.23047065734863 C 42.24657821655273 13.58396148681641 41.52532958984375 15.76841068267822 40.29280853271484 17.57322120666504 L 40.45412063598633 17.64854049682617 L 39.46564865112305 18.64084053039551 C 39.14667892456055 19.00518035888672 38.80426788330078 19.34897041320801 38.44131088256836 19.66918182373047 L 21.24395942687988 36.93408203125 Z" stroke="none"/>
										</g>
										<g class="stroke-dark-<?php echo $member_type; ?>" transform="translate(20.98 36.331) rotate(-135)" fill="none" stroke-width="2">
											<rect width="6.27" height="10.45" rx="3.135" stroke="none"/>
											<rect x="1" y="1" width="4.27" height="8.45" rx="2.135" fill="none"/>
										</g>
										<g class="stroke-dark-<?php echo $member_type; ?>" transform="translate(14.576 29.927) rotate(-135)" fill="none" stroke-width="2">
											<rect width="6.27" height="10.45" rx="3.135" stroke="none"/>
											<rect x="1" y="1" width="4.27" height="8.45" rx="2.135" fill="none"/>
										</g>
										<g class="stroke-dark-<?php echo $member_type; ?>" transform="translate(18.025 33.375) rotate(-135)" fill="none" stroke-width="2">
											<rect width="6.27" height="10.45" rx="3.135" stroke="none"/>
											<rect x="1" y="1" width="4.27" height="8.45" rx="2.135" fill="none"/>
										</g>
										<g class="stroke-dark-<?php echo $member_type; ?>" transform="translate(11.621 26.972) rotate(-135)" fill="none" stroke-width="2">
											<rect width="6.27" height="10.45" rx="3.135" stroke="none"/>
											<rect x="1" y="1" width="4.27" height="8.45" rx="2.135" fill="none"/>
										</g>
										<line class="stroke-dark-<?php echo $member_type; ?>" x2="7.663" y2="7.663" transform="translate(21.682 18.513)" fill="none" stroke-linecap="round" stroke-width="2"/>
										<line class="stroke-dark-<?php echo $member_type; ?>" x2="7.663" y2="7.663" transform="translate(25.165 15.726)" fill="none" stroke-linecap="round" stroke-width="2"/>
										<path class="stroke-dark-<?php echo $member_type; ?>" d="M1166.015,7230.072l-9.515-9.513s-2.235-2.323-4.28,0-3.625,3.945-3.625,3.945a3.178,3.178,0,0,1-4.9,0c-2.649-2.66,4.9-8.044,4.9-8.044" transform="translate(-1128.673 -7210.513)" fill="none" stroke-linecap="round" stroke-width="2"/>
									</g>
								</g>
							</svg>
							<span class="color-dark-<?php echo $member_type; ?>">社会貢献活動</span>
						</h2>
						<div class="list-link d-none d-sm-block">
							<a class="color-dark-<?php echo $member_type; ?> gtm-click-link" href="/social-contribution/" data-gtm-click="社会貢献活動（PC）">
								<span>全ての活動を見る</span><i class="fas fa-arrow-right"></i>
							</a>
						</div>
					</div>
					<p class="mb-0 pb-3 text-sm-center">一般財団法人全国福利厚生共済会の「<strong>社会貢献活動</strong>」の基盤は「<strong>まごころ募金</strong>」です。</p>
					<section class="position-relative">
						<div class="charity-title-wrap color-dark-<?php echo $member_type; ?> position-relative">
							<h3 class="charity-title text-center">まごころ募金</h3>
							<p class="mb-0 charity-amount-txt text-center">現在の募金総額</p>
						</div>
						<div class="charity-content-wrap text-center">
							<p class="mb-0 charity-amount-number color-dark-<?php echo $member_type; ?>"><span class="donation-amount font-weight-bold"><?php echo CFS()->get('home_magokoro_amount', $home_id); ?></span>円</p>
							<p class="mb-0 charity-update">（<?php echo date('Y年m月d日', strtotime(CFS()->get('home_magokoro_update',$home_id))); ?>現在）</p>
						</div>
					</section>
					<div class="list-link d-sm-none text-center mt-4">
						<a href="/social-contribution/" class="px-3 pb-1 border-bottom border-color-dark-<?php echo $member_type; ?> color-dark-<?php echo $member_type; ?> gtm-click-link" data-gtm-click="社会貢献活動（SP）">
							<span class="pr-2">全ての活動を見る</span><i class="fas fa-arrow-right"></i>
						</a>
					</div>
				</div>
			</div>
			<div class="home-service-div text-center position-relative">
				<div class="bg-top-wave">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home/about-bg.png" alt="背景">
				</div>
				<div class="home-service-div-content container pb-0 pb-sm-5">
					<div class="home-main_tit home-main_tit border-0">
						<h2 class="d-flex align-items-center my-1 pt-1">
							<svg class="tit-icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
								<g transform="translate(5801 -2402)">
									<rect width="50" height="50" transform="translate(-5801 2402)" fill="none"/>
									<path d="M18.467,34.378A5.275,5.275,0,1,1,9.515,28.8l-.326-.152,9.057-9.057L25.959,27.3a5.274,5.274,0,1,1-7.492,7.076ZM0,22.988a5.272,5.272,0,0,1,2.555-4.521A5.275,5.275,0,1,1,8.136,9.515l.152-.326,9.057,9.057L9.633,25.958A5.274,5.274,0,0,1,0,22.988Zm28.8,4.43-.152.327-9.057-9.057L27.3,10.976a5.274,5.274,0,1,1,7.076,7.49A5.275,5.275,0,1,1,28.8,27.418ZM10.976,9.633a5.274,5.274,0,1,1,7.49-7.076,5.275,5.275,0,1,1,8.951,5.579l.327.152-9.057,9.057Z" transform="translate(-5794.467 2408.533)"/>
								</g>
							</svg>
							<span class="color-dark-<?php echo $member_type; ?>">ライフサポートサービス</span>
						</h2>
						<div class="llservice-about text-left">
							<p class="mb-0"><?php echo CFS()->get('llservice_about'); ?></p>
						</div>
						<div class="all-service_link text-left mt-4">
							<a class="rounded-pill gtm-click-link" href="/lifesupport/" data-gtm-click="ライフサポートサービスを見る(ログイン前)">
								<span>ライフサポートサービスを見る</span><i class="fas fa-arrow-right pl-2"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="llservice-img position-absolute">
					<?php if(wp_is_mobile()) : ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/top/llservice-top_img_sp.png">
					<?php else: ?>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/top/llservice-top_img_pc.png">
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php if ($display_type == 'sp'): ?>
			<div class="contact-ryno-div container mb-5">
				<div class="home-main_tit border-color-dark-<?php echo $member_type; ?>">
					<h2 class="my-1 pt-1">
						<span class="color-dark-<?php echo $member_type; ?>">お問い合わせ窓口</span>
					</h2>
				</div>
				<div class="tel-mobile rounded05 py-2 px-3 mb-1 mx-3">
					<p class="mb-2">全厚済サポートデスク</p>
					<a href="tel:050-8881-8878">
						<div class="d-flex">
							<div class="tel-imgbox">
								<img class="p-1" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/icons/home/home_contact_tel_mobile.png">
							</div>
							<p class="bold mb-0 pl-3">050-8881-8878</p>
						</div>
					</a>
					<p class="font-smaller mt-2 mb-0">※ダイヤルをタップするとお電話がかかります<br>（受付：平日10時～17時）</p>
				</div>
				<div class="list-link text-center mt-4 pt-2">
					<a href="/contact/" class="list-link__url position-relative border-bottom border-color-dark-<?php echo $member_type; ?> color-dark-<?php echo $member_type; ?> gtm-click-link" data-gtm-click="お問合せ">
						<img class="list-link__img position-absolute" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/home/tel-raino.png" width="50px">
						<span class="pr-2">お問合せへ</span><i class="fas fa-arrow-right"></i>
					</a>
				</div>
			</div>
			<!-- </div> -->
		<?php endif; ?>
	</div>
	<?php
		$home_modal = $cfs->get('home_modal');
		$home_modal_style = $cfs->get('home_modal_style');
		$home_modal_color = $cfs->get('home_modal_color');
		if (is_user_loggedin() && $home_modal) :
	?>
	<div id="first-modal_information" class="js-modal_box_new modal_box_new <?php if ($home_modal_style) echo 'modal_box_new_side'; ?>">
		<div class="js-modal_bg_new modal_bg_new"></div>
		<div class="js-modal_inner_new modal_inner_new" style="border-color: <?php echo $home_modal_color; ?>;">
			<div class="modal_box_new_tit">
				<div class="d-flex justify-content-end">
					<button class="js-modal_close_new modal_close_new rounded-pill d-block ml-auto" style="border-color: <?php echo $home_modal_color; ?>; color: <?php echo $home_modal_color; ?>;">
						× 閉じる
					</button>
				</div>
			</div>
			<div class="modal_block_new">
				<?php echo $home_modal; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if(!is_user_loggedin() && wp_is_mobile()) : //ログインポップアップ ?>
	<div id="login_modal_sp" class="js-modal_box_new js-modal_box_new-active modal_box_new">
		<div class="js-modal_inner_new modal_inner_new">
			<div class="modal_box_new_tit mb-0">
				<div class="d-flex justify-content-end position-relative">
					<button class="js-modal_close_new modal_close_new d-block text-right px-0">
						閉じる<i class="fa-solid fa-xmark pl-2"></i>
					</button>
				</div>
			</div>
			<div class="modal_block_new text-right w-100 px-0">
				<a class="login-link px-4 py-2 rounded-pill text-white d-block text-center position-relative <?php echo $maintenance; ?>" href="/login/" style="font-size:1.4rem; background-color: #d5ab4c; width: 55vw;">
					ログインする
					<svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40">
						<g transform="translate(3639 -3536)">
							<g transform="translate(-3600.943 3573.448) rotate(180)">
								<path d="M26.8,28.9v-.015l-.4.4a5.056,5.056,0,0,1-2.632,1.4,4.872,4.872,0,0,1-.967.1,5.024,5.024,0,0,1-.617-.041l-.011,0h-.011v.07H4.64V4.64H22.155V7.583l0,.387h0v.011a5.048,5.048,0,0,1,4.237,1.445l.232.232.16.171V9.818l.011.011V0H0V35.437H0v.011H26.8V31.6l.008-2.709Z" fill="#fff"></path>
								<path d="M.854,7.208,7.2.859A2.926,2.926,0,0,1,9.281,0,2.563,2.563,0,0,1,9.92.075a2.865,2.865,0,0,1,1.439.784,2.739,2.739,0,0,1,.526.714,2.557,2.557,0,0,1,.215.532,2.924,2.924,0,0,1,.123.838,2.978,2.978,0,0,1-.123.838,2.858,2.858,0,0,1-.741,1.241l-.767.767-.528.538h8.647a2.943,2.943,0,0,1,0,5.886H13.637l-3.575.008,1.3,1.3a2.741,2.741,0,0,1,.526.714,2.56,2.56,0,0,1,.215.532,2.923,2.923,0,0,1,.123.838,2.98,2.98,0,0,1-.123.838,2.948,2.948,0,0,1-1.713,1.885,2.46,2.46,0,0,1-.467.145.405.405,0,0,1-.075.021,3.34,3.34,0,0,1-.564.054,3.22,3.22,0,0,1-.559-.054,2.9,2.9,0,0,1-1.52-.811L5.28,15.758.854,11.338a2.924,2.924,0,0,1,0-4.13Z" transform="translate(13.401 10.503)" fill="#fff"></path>
							</g>
							<rect transform="translate(-3639 3536)" fill="none"></rect>
						</g>
					</svg>
					<?php echo $maintenance_text; ?>
				</a>
			</div>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
<?php //do_action( 'lightning_additional_section' ); ?>

</div><!-- [ /.row ] -->
<?php //do_action( 'lightning_siteContent_container_apepend' ); ?>
</div><!-- [ /.container ] -->
<?php //do_action( 'lightning_siteContent_apepend' ); ?>
</div><!-- [ /.siteContent ] -->
<!-- <script>
jQuery(function($){
  $('.modal_trigger').on('click', function(e){
    e.preventDefault();

    // モーダル表示
    $('.modal_box').fadeIn();

    // 動画の再生を強制
    const video = $('.modal_box video').get(0);
    if (video) {
      video.currentTime = 0; // 毎回先頭から
      video.play();
    }
  });

  // 閉じるボタンでモーダルを閉じる
  $('.modal_close, .modal_bg').on('click', function(){
    $('.modal_box').fadeOut();

    // 動画停止（任意）
    const video = $('.modal_box video').get(0);
    if (video) {
      video.pause();
    }
  });
});
</script> -->
<script>
jQuery(function ($) {
  const OFFSET_SM = -230;

  // スマホだけ実行
  if (window.innerWidth <= 576) {
    const hash = window.location.hash;

    if (hash && $(hash).length) {
      setTimeout(function () {
        const pos = $(hash).offset().top + OFFSET_SM;
        $('html, body').scrollTop(pos);
      }, 200); // ← 必ず遅らせて再ジャンプ後に上書き
    }
  }
});

jQuery(function($){
  // モーダルを表示
  $(document).on('click', '.modal_trigger--video', function(){
    const $modal = $(this).next('.modal_box--video');
    const $video = $modal.find('video');
    const $source = $video.find('source');

    // srcが未設定なら data-src を反映
    if (!$source.attr('src')) {
      const videoSrc = $source.data('src');
      $source.attr('src', videoSrc);
      $video[0].load();
    }

    // 表示して再生
    $modal.fadeIn();
    $('body').addClass('overflow-hidden');
  });

  // モーダルを閉じる
  $(document).on('click', '.modal_box--video .modal_close, .modal_box--video .modal_bg, .modal_box--video .modal_block, .modal_box--video .movie-item', function(e){
    const $target = $(e.target);

    // ① modal_closeは必ず閉じる（videoの上でも）
    if ($target.hasClass('modal_close') || $target.closest('.modal_close').length) {
      $('.modal_box--video').fadeOut();
      $('body').removeClass('overflow-hidden');
      $('.modal_box--video video').each(function(){ this.pause(); });
      return;
    }

    // ② modal_inner以外、またはmodal_block / movie-item クリック時、ただしvideo除く
    if (
      !$target.closest('.modal_inner').length ||
      $target.hasClass('modal_block') ||
      $target.hasClass('movie-item')
    ) {
      if (!$target.is('video')) {
        $('.modal_box--video').fadeOut();
        $('body').removeClass('overflow-hidden');
        $('.modal_box--video video').each(function(){ this.pause(); });
      }
    }
  });
});
jQuery(function($){
	$(document).on('click', '.menu-hamburger a', function() {
        // 1. リンク先と現在地のドメイン・パスが同じか（＝同じページか）
        // 2. リンク先にハッシュ（#）があるか（＝ページ内リンクか）
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && 
            location.hostname == this.hostname && 
            this.hash.length > 0) {
            
            // 条件に一致したらクラスを削除して閉じる
            $('.menu-hamburger').removeClass('open');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
  const videos = document.querySelectorAll("video[data-video-id]");

  videos.forEach(video => {
    let hasTracked = false;  // 二重送信防止

    video.addEventListener("play", function () {
      if (!hasTracked) {
        const videoId = video.getAttribute("data-video-id");

        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
          event: 'video_played',
          video_id: videoId
        });

        hasTracked = true;  // 再生1回だけカウント
      }
    });
  });
});

</script>
