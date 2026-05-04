<?php //do_action( 'lightning_footer_before' ); ?>
<?php
	require_once('/var/www/html/cms/wp-load.php');

	// 会員種別判定
	// n_member=ログイン前
	// p_member,k_member,ks_member,ps_member=各P会員、K会員、PS会員、KS会員
	$member_type = '';
	if(is_user_loggedin()) {
		$member_type = $_SESSION['member_info']['member_type'];
	} else {
		$member_type = 'n_member';
	}
	$login = '';
	if(is_user_loggedin()){
		$login = 'user_loggedin';
	}
	// モバイル＝SP　それ以外＝SP
	$display_type = 'pc';
	if (is_mobile()){
		$display_type = 'sp';
	}
	$r_deficient = false;
	if($_SESSION['member_info']['member_status'] == 1 && $_SESSION['member_info']['deficient_reason'] == 25 ){
		$r_deficient = true;
	}
?>
<?php if (!is_page('cancel-mail-magazine') && is_parent_slug() !== 'cancel-mail-magazine' && !is_page('login_service_provider')) : ?>
	<?php if(!$r_deficient && !is_page('server-monitoring')): ?>
	<footer class="siteFooter <?php echo $member_type.' '.$login; ?> pb-0">
		<?php if ($display_type == 'pc') : ?>
			<div class="footer col-12 col-md-11 col-lg-10 p-0 p-sm-2 p-md-3 p-lg-4 mx-auto mt-4">
				<div id="" class="menu-about pc-footer-column">
					<div class="footer-tit d-flex align-items-center w-100 pr-0">
						<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<g transform="translate(5970 -2402)">
								<path d="M8.276,34.837c-.014-.028-19.194-14.222.889-32.121C9.1,2.79-.983,16.048,8.276,24.1c9.3,8.088,17.493-2.021,17.493-2.021s6.668,10.34-5.436,15.737a8.942,8.942,0,0,1-2.555.315A16.739,16.739,0,0,1,8.276,34.837Zm25.041-3.013c.221-4.02-1.613-6.953-9.235-14.549s2.76-15.669,2.791-15.658c19.222,7.645,8.1,30.629,6.6,30.626C33.36,32.243,33.3,32.109,33.317,31.824ZM9.064,13.992C9.039,14,5.734.53,20.708,0c-.121.051-12.692,7.586,2.881,20.084A14.6,14.6,0,0,1,18.374,21.1C15.064,21.1,11.044,19.756,9.064,13.992Zm.1-11.276h0Z" transform="translate(-5964.62 2408.159)"/>
								<rect width="50" height="50" transform="translate(-5970 2402)" fill="none"/>
							</g>
						</svg>
						<p class="mb-0">全厚済とは</p>
					</div>
					<ul class="bg-transparent p-0 my-0">
						<li><a href="/about/company" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 全厚済とは"><i class="fas fa-chevron-right pr-2"></i>全厚済とは</a></li>
						<li><a href="/about/message" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 代表理事について"><i class="fas fa-chevron-right pr-2"></i>代表理事について</a></li>
						<?php if (!is_user_loggedin()) : ?>
						<li><a href="/about/history" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 全厚済の歩み"><i class="fas fa-chevron-right pr-2"></i>全厚済の歩み</a></li>
						<?php endif; ?>
						<?php if (is_user_loggedin()) : ?>
							<li><a href="/about/talk/" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター サブメニュー 代表理事・専務理事対談"><i class="fas fa-chevron-right pr-2"></i>代表理事・専務理事対談</a></li>
							<li><a href="/about/history" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 全厚済の歩み"><i class="fas fa-chevron-right pr-2"></i>全厚済の歩み</a></li>
							<li><a href="/about/service-use" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター サービス利用件数・決算報告"><i class="fas fa-chevron-right pr-2"></i>サービス利用件数・決算報告</a></li>
							<li><a href="/media/" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター メディアコンテンツ"><i class="fas fa-chevron-right pr-2"></i>メディアコンテンツ</a></li>
						<?php endif; ?>
					</ul>
				</div>
				<div id="" class="menu-service pc-footer-column">
					<div class="footer-tit d-flex align-items-center w-100 pr-0">
						<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<g transform="translate(5801 -2402)">
								<rect width="50" height="50" transform="translate(-5801 2402)" fill="none"/>
								<path d="M18.467,34.378A5.275,5.275,0,1,1,9.515,28.8l-.326-.152,9.057-9.057L25.959,27.3a5.274,5.274,0,1,1-7.492,7.076ZM0,22.988a5.272,5.272,0,0,1,2.555-4.521A5.275,5.275,0,1,1,8.136,9.515l.152-.326,9.057,9.057L9.633,25.958A5.274,5.274,0,0,1,0,22.988Zm28.8,4.43-.152.327-9.057-9.057L27.3,10.976a5.274,5.274,0,1,1,7.076,7.49A5.275,5.275,0,1,1,28.8,27.418ZM10.976,9.633a5.274,5.274,0,1,1,7.49-7.076,5.275,5.275,0,1,1,8.951,5.579l.327.152-9.057,9.057Z" transform="translate(-5794.467 2408.533)"/>
							</g>
						</svg>
						<p class="mb-0">ライフサポートサービス</p>
					</div>
					<ul class="bg-transparent p-0 my-0">
						<?php foreach (get_terms('lifesupport_cat', array('parent' => 0)) as $t):
								if (get_field('s_display', $t) && !$login) {
									continue;
								}
								if ($t->slug == 'other') { continue; }
								if (!$login) {
									echo '<li><a href="/lifesupport_cat/'.$t->slug.'/" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター ログイン前 '.strip_tags($t->name).'"><i class="fas fa-chevron-right pr-2"></i>'.strip_tags($t->name).'</a></li>';
									continue;
								}
						?>
							<li><a href="/lifesupport/#<?php echo $t->slug; ?>" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター ログイン後 <?php echo strip_tags($t->name); ?>"><i class="fas fa-chevron-right pr-2"></i><?php echo $t->name; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div id="" class="menu-csr pc-footer-column">
					<div class="footer-tit d-flex align-items-center w-100 pr-0">
						<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
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
						<p class="mb-0">社会貢献活動</p>
					</div>
					<ul class="bg-transparent p-0 my-0">
					<?php
						$excluded_slugs = ['csr-topics', 'volunteer2', 'clean', 'education', 'education_scholarship'];
						$parent_terms = get_terms('csr_cat', array('parent' => 0, 'hide_empty' => false));

						$ordered_terms = array_filter($parent_terms, function($t) use ($excluded_slugs) {
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

							echo '<li class="' . esc_attr($t->slug) . '"><a href="' . esc_url($url) . '" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター ' . esc_attr(strip_tags($t->name)) . '"><i class="fas fa-chevron-right pr-2"></i>' . esc_html($t->name) . '</a></li>';
						}
					?>
					</ul>
					<?php if (!is_user_loggedin()) : ?>
					<div class="footer-tit d-flex align-items-center w-100 pr-0 mt-3">
						<svg class="footer-tit__icon procedure-icon mr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
							<g transform="translate(5619 -2402)">
								<rect width="50" height="50" transform="translate(-5619 2402)" fill="none"/>
								<g transform="translate(-5634.879 2406.424)">
									<path d="M130.353,8.422h9.865a2.114,2.114,0,0,0,2.115-2.115V4.188a2.114,2.114,0,0,0-2.115-2.115h-2.673a2.268,2.268,0,0,0-4.52,0h-2.672a2.116,2.116,0,0,0-2.116,2.115V6.306A2.115,2.115,0,0,0,130.353,8.422Zm4.933-7.178a1.036,1.036,0,1,1-1.037,1.036A1.036,1.036,0,0,1,135.286,1.244Z" transform="translate(-95.128)" fill="#514c18"/>
									<path d="M480.09,161a.137.137,0,0,1,.015.018.151.151,0,0,1,.015.011Z" transform="translate(-420.075 -148.685)" fill="#514c18"/>
									<path d="M431.846,155.2a1.745,1.745,0,0,0-2.456.011l-1.555,1.555,2.441,2.441,1.555-1.555A1.746,1.746,0,0,0,431.846,155.2Z" transform="translate(-371.816 -142.871)" fill="#514c18"/>
									<path d="M239.794,299.775l5.3-5.3-3.164-3.164-5.3,5.3a.817.817,0,0,0,0,1.152l2.011,2.011A.815.815,0,0,0,239.794,299.775Z" transform="translate(-195.013 -269.036)" fill="#514c18"/>
									<path d="M209.263,379.781l-.734.735.423.423.735-.734,3.15-1.031-2.542-2.542Z" transform="translate(-169.28 -347.831)" fill="#514c18"/>
									<path d="M332.1,59.965V67.1l2.488-2.488v-4.5a3.526,3.526,0,0,0-3.526-3.526h-3.108v1.979a3.365,3.365,0,0,1-.073.7h3.514A.705.705,0,0,1,332.1,59.965Z" transform="translate(-279.503 -52.258)" fill="#514c18"/>
									<path d="M52.6,87.223a.705.705,0,0,1-.706.705H28.424a.705.705,0,0,1-.7-.705V59.965a.705.705,0,0,1,.7-.705h3.515a3.366,3.366,0,0,1-.074-.7V56.585H28.757a3.525,3.525,0,0,0-3.525,3.526V87.885a3.525,3.525,0,0,0,3.525,3.525h22.8a3.526,3.526,0,0,0,3.526-3.525V74.454L52.6,76.942V87.223Z" transform="translate(0 -52.258)" fill="#514c18"/>
									<path d="M316.172,190.707l3.164,3.164,7.719-7.72-3.163-3.163Zm8.473-5.31a.7.7,0,0,1,0,.989l-3.756,3.756a.7.7,0,0,1-.989-.989l3.757-3.756A.7.7,0,0,1,324.645,185.4Z" transform="translate(-268.692 -168.995)" fill="#514c18"/>
									<rect width="18" height="2" transform="translate(30.879 12.576)" fill="#514c18"/>
									<rect width="15" height="2" transform="translate(30.879 18.576)" fill="#514c18"/>
									<rect width="10" height="2" transform="translate(30.879 24.576)" fill="#514c18"/>
									<rect width="6" height="2" transform="translate(30.879 30.576)" fill="#514c18"/>
								</g>
							</g>
						</svg>
						<p class="mb-0">各種変更手続きについて</p>
					</div>
					<ul class="bg-transparent p-0 my-0">
						<li><a href="/procedure/membership/" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 会員種別変更のご案内"><i class="fas fa-chevron-right pr-2"></i>会員種別変更のご案内</a></li>
						<li><a href="/procedure/contract/" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 契約者変更・サービス受領者変更のご案内"><i class="fas fa-chevron-right pr-2"></i>契約者変更・サービス受領者変更のご案内</a></li>
						<li><a href="/procedure/cooling-off/" aria-current="page" class="gtm-click-link" data-gtm-click="PCフッター 契約者変更・サービス受領者変更のご案内"><i class="fas fa-chevron-right pr-2"></i>解約・クーリングオフのご案内</a></li>
					</ul>
					<?php endif; ?>
				</div>
				<?php if (is_user_loggedin()) : ?>
					<div class="pc-footer-column last">
						<div class="menu-plusa">
							<div class="footer-tit d-flex align-items-center w-100 pr-0">
								<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
									<g transform="translate(5915 -2402)">
										<g transform="translate(-5911.693 2396.928)">
										<path d="M187.246,33.853a10.066,10.066,0,0,1-1.4.382,3.9,3.9,0,0,1-.667.055l.022-.073c.145-.492.269-1.005.358-1.425s.146-.744.168-.861a4,4,0,0,1,.193-.764.559.559,0,0,1,.378-.334,3.246,3.246,0,0,0,1.931-1.42,4.5,4.5,0,0,0,.68-2.777c-.05-.662-.194-.95-.387-1.006s-.443.12-.751.369a9.836,9.836,0,0,1-1.1.828,3.68,3.68,0,0,1-.574.287c-.043-.456-.105-.916-.167-1.292-.065-.4-.126-.707-.146-.819-.116-.653-.164-.938.134-1.166a3.1,3.1,0,0,0,1.238-1.907,4.274,4.274,0,0,0-.32-2.686c-.263-.57-.486-.776-.676-.76s-.356.252-.548.574a9.48,9.48,0,0,1-.706,1.1,3.566,3.566,0,0,1-.415.445c-.167-.343-.341-.675-.495-.953-.186-.337-.34-.591-.392-.684-.312-.546-.445-.786-.25-1.084a2.961,2.961,0,0,0,.514-2.091,4.052,4.052,0,0,0-1.1-2.3c-.407-.428-.668-.544-.833-.474s-.245.334-.321.683a9.41,9.41,0,0,1-.3,1.2,3.4,3.4,0,0,1-.234.518c-.185-.186-.365-.361-.527-.513-.282-.264-.5-.459-.584-.531-.464-.424-.665-.611-.57-.955a2.957,2.957,0,0,0-.151-2.148,4.045,4.045,0,0,0-1.756-1.85c-.519-.283-.8-.315-.94-.2s-.13.393-.1.748a9.933,9.933,0,0,1,.082,1.177,3.164,3.164,0,0,0-1.092-.779,4.131,4.131,0,0,0-1.906-.338c-.652.047-1.188.291-1.313.742a1.5,1.5,0,0,0,.59,1.344,5.229,5.229,0,0,0,1.371.981,3.264,3.264,0,0,0,1.156.331l-.054.042c-.347.263-.7.483-.964.684s-.454.381-.484.553.1.334.452.53a3.434,3.434,0,0,0,1.833.4,4.1,4.1,0,0,0,1.9-.571c.3-.165.522-.021.947.372.072.067.267.26.508.521.138.149.289.321.444.5a5.2,5.2,0,0,1-.5.2c-.41.143-.811.245-1.127.354a1.12,1.12,0,0,0-.632.378c-.081.156-.011.349.269.644a3.432,3.432,0,0,0,1.621.948,4.09,4.09,0,0,0,1.987.039c.341-.064.5.139.787.644.049.086.175.33.324.651.123.266.26.588.388.915a5.191,5.191,0,0,1-.613.039c-.457.006-.889-.027-1.242-.024a1.188,1.188,0,0,0-.755.166c-.134.128-.13.341.046.724a3.585,3.585,0,0,0,1.279,1.474,4.384,4.384,0,0,0,1.956.722c.36.056.45.314.553.913.017.1.056.387.089.758.031.348.054.771.06,1.189a5.723,5.723,0,0,1-.6-.184c-.452-.163-.868-.353-1.217-.477a1.249,1.249,0,0,0-.806-.111c-.179.076-.254.285-.221.724a3.751,3.751,0,0,0,.715,1.914,4.651,4.651,0,0,0,1.655,1.435.488.488,0,0,1,.272.387,2.276,2.276,0,0,1-.072.715c-.021.107-.09.4-.2.776s-.258.831-.425,1.265l-.025.064a6.282,6.282,0,0,1-.513-.412c-.378-.336-.71-.683-1-.938a1.332,1.332,0,0,0-.745-.421c-.206,0-.359.177-.5.609a3.9,3.9,0,0,0-.054,2.118,4.975,4.975,0,0,0,1.032,2.056c.247.32.122.595-.255,1.149-.064.094-.252.35-.512.668s-.592.7-.933,1.046c-.055.057-.11.112-.164.167a6.759,6.759,0,0,1-.317-.607c-.222-.483-.4-.956-.57-1.326a1.41,1.41,0,0,0-.541-.72c-.2-.083-.418.016-.731.372a4.07,4.07,0,0,0-.941,2,5.328,5.328,0,0,0,.111,2.413c.1.413-.139.623-.741.989-.1.062-.393.225-.78.414s-.87.4-1.348.585-1.131.465-1.479.587c-4.527,1.591-9.976,2.278-13.35,4.758-.526.386.519,1.874.981,1.759a66.6,66.6,0,0,1,12.079-4.375c.348-.123,2.034-.672,2.549-.919s1.034-.526,1.445-.766.72-.44.834-.509a4.348,4.348,0,0,1,.771-.42.62.62,0,0,1,.558.054,3.321,3.321,0,0,0,1.217.483,3.88,3.88,0,0,0,1.41-.011,4.661,4.661,0,0,0,1.458-.547,5.314,5.314,0,0,0,1.322-1.082c.5-.562.614-.906.509-1.1s-.44-.256-.878-.3a10.4,10.4,0,0,1-1.514-.222,4.044,4.044,0,0,1-.659-.226c.056-.066.111-.133.167-.2.345-.417.679-.863.938-1.232s.448-.663.518-.767c.411-.612.59-.88,1.005-.835a3.4,3.4,0,0,0,2.456-.605,4.43,4.43,0,0,0,1.051-1.03,5.042,5.042,0,0,0,.73-1.437c.215-.674.186-1.016.019-1.145S187.645,33.728,187.246,33.853Z" transform="translate(-145.54 -0.004)"/>
										<path d="M16.671,46.592c1.044-.4,2.147-.746,3.264-1.065-1.2-.327-2.389-.668-3.52-1.065-.348-.122-1-.4-1.479-.587s-.962-.395-1.348-.585-.677-.352-.78-.414c-.6-.366-.84-.575-.741-.989a5.329,5.329,0,0,0,.111-2.413,4.07,4.07,0,0,0-.941-2c-.312-.356-.532-.455-.731-.372a1.409,1.409,0,0,0-.541.72c-.175.369-.349.842-.57,1.326a6.743,6.743,0,0,1-.317.607c-.055-.055-.11-.11-.164-.167-.341-.35-.675-.728-.933-1.046s-.448-.574-.512-.668c-.377-.554-.5-.829-.255-1.149a4.974,4.974,0,0,0,1.032-2.056,3.9,3.9,0,0,0-.054-2.117c-.138-.433-.291-.606-.5-.609a1.333,1.333,0,0,0-.745.421c-.292.256-.624.6-1,.938a6.264,6.264,0,0,1-.513.412l-.024-.064c-.168-.434-.317-.889-.426-1.265s-.179-.669-.2-.776a2.278,2.278,0,0,1-.072-.715.488.488,0,0,1,.272-.387A4.659,4.659,0,0,0,6.643,29.07a3.75,3.75,0,0,0,.714-1.914c.033-.439-.042-.648-.221-.724a1.248,1.248,0,0,0-.806.111c-.348.124-.764.314-1.216.477a5.818,5.818,0,0,1-.6.184c.007-.417.029-.841.06-1.189.033-.371.072-.656.089-.758.1-.6.193-.857.553-.913a4.384,4.384,0,0,0,1.956-.722A3.583,3.583,0,0,0,8.448,22.15c.177-.383.181-.6.046-.724a1.189,1.189,0,0,0-.755-.166c-.352,0-.785.029-1.242.024a5.212,5.212,0,0,1-.613-.039c.128-.327.265-.649.388-.915.149-.321.275-.565.324-.651.284-.5.446-.708.787-.644A4.09,4.09,0,0,0,9.37,19a3.432,3.432,0,0,0,1.621-.948c.28-.295.351-.487.269-.644a1.12,1.12,0,0,0-.632-.378c-.317-.109-.717-.211-1.127-.354a5.239,5.239,0,0,1-.5-.2c.155-.181.306-.353.444-.5.24-.261.435-.454.507-.521.426-.393.643-.537.947-.372a4.1,4.1,0,0,0,1.9.571,3.434,3.434,0,0,0,1.833-.4c.357-.2.483-.356.452-.53s-.217-.353-.484-.553-.618-.421-.964-.684l-.054-.042a3.264,3.264,0,0,0,1.156-.331,5.23,5.23,0,0,0,1.371-.981,1.5,1.5,0,0,0,.591-1.344c-.126-.451-.663-.695-1.314-.742a4.131,4.131,0,0,0-1.906.338,3.163,3.163,0,0,0-1.092.779,9.94,9.94,0,0,1,.082-1.177c.035-.355.042-.628-.1-.748s-.421-.088-.94.2a4.045,4.045,0,0,0-1.756,1.85,2.957,2.957,0,0,0-.151,2.148c.094.343-.107.531-.571.955-.079.072-.3.268-.583.531-.162.151-.343.327-.527.513a3.393,3.393,0,0,1-.233-.518,9.41,9.41,0,0,1-.3-1.2c-.076-.348-.153-.61-.321-.683s-.426.046-.833.474a4.052,4.052,0,0,0-1.1,2.3,2.961,2.961,0,0,0,.514,2.091c.2.3.062.538-.25,1.084-.052.094-.206.348-.392.684-.154.278-.328.61-.495.953a3.578,3.578,0,0,1-.415-.445,9.467,9.467,0,0,1-.706-1.1c-.192-.322-.356-.56-.548-.574s-.413.19-.675.76a4.268,4.268,0,0,0-.321,2.686,3.094,3.094,0,0,0,1.238,1.907c.3.228.25.513.134,1.166-.019.111-.08.417-.146.819-.061.376-.123.836-.166,1.292a3.711,3.711,0,0,1-.574-.287,9.914,9.914,0,0,1-1.1-.828C.848,25.745.6,25.57.4,25.625s-.337.343-.386,1.006A4.5,4.5,0,0,0,.7,29.408a3.246,3.246,0,0,0,1.931,1.42.56.56,0,0,1,.378.334,4,4,0,0,1,.193.764c.023.117.079.442.169.861s.213.933.358,1.425l.022.073a3.916,3.916,0,0,1-.667-.055,10.07,10.07,0,0,1-1.4-.382c-.4-.125-.711-.2-.88-.069s-.2.471.02,1.145a5.045,5.045,0,0,0,.73,1.437A4.429,4.429,0,0,0,2.6,37.392,3.4,3.4,0,0,0,5.057,38c.415-.045.594.223,1.005.835.071.1.259.4.518.767s.593.815.938,1.232c.055.068.111.134.167.2a4.033,4.033,0,0,1-.659.226,10.386,10.386,0,0,1-1.514.222c-.438.048-.771.107-.878.3s.012.539.509,1.1a5.316,5.316,0,0,0,1.322,1.082,4.663,4.663,0,0,0,1.458.547,3.882,3.882,0,0,0,1.41.011,3.321,3.321,0,0,0,1.217-.483.621.621,0,0,1,.558-.054,4.353,4.353,0,0,1,.771.42c.114.068.422.268.834.509s.929.52,1.445.766C14.656,45.923,16.259,46.448,16.671,46.592Z" transform="translate(0)"/>
										<path d="M276.511,462.456c-1.3.36-2.479.713-3.538,1.051,3.681,1.326,5.338,2.284,5.653,2.363.461.116,1.506-1.372.98-1.759A14.037,14.037,0,0,0,276.511,462.456Z" transform="translate(-249.842 -414.893)"/>
										<path d="M10.172,1.222a1,1,0,0,1,1.656,0l2.919,4.309a1,1,0,0,0,.581.408l5.12,1.3a1,1,0,0,1,.515,1.616l-3.3,3.881a1,1,0,0,0-.236.7l.283,5.034a1,1,0,0,1-1.344.994l-5.023-1.85a1,1,0,0,0-.691,0l-5.023,1.85a1,1,0,0,1-1.344-.994l.283-5.034a1,1,0,0,0-.236-.7L1.037,8.86a1,1,0,0,1,.515-1.616l5.12-1.3a1,1,0,0,0,.581-.408Z" transform="translate(10.693 17.072)"/>
										</g>
										<rect width="50" height="50" transform="translate(-5915 2402)" fill="none"/>
									</g>
								</svg>
								<p class="mb-0">期間限定 おすすめ情報</p>
							</div>
							<ul class="bg-transparent p-0 mt-0 mb-4">
								<li><a href="/plusa" class="gtm-click-link" data-gtm-click="PCフッター 期間限定 おすすめ情報"><i class="fas fa-chevron-right pr-2"></i>期間限定 おすすめ情報</a></li>
							</ul>
						</div>
						<div class="menu-aul w-100 pr-0">
							<div class="footer-tit d-flex align-items-center w-100 pr-0">
								<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
									<g transform="translate(-1249 -141)">
										<rect transform="translate(1249 141)" fill="none"/>
										<g transform="translate(1253.969 88.273)">
										<path class="stroke-dark-<?php echo $member_type; ?>" d="M35.385,66V63.253a.662.662,0,0,0-.661-.66H29.28a5.821,5.821,0,0,0-1.023.108A13.8,13.8,0,0,0,26,63.339a16.782,16.782,0,0,0-3.758,1.939,10.726,10.726,0,0,0-1.629,1.393,7.873,7.873,0,0,0-.584.7,8.575,8.575,0,0,0-1.4-1.465,15.554,15.554,0,0,0-4.221-2.432,16,16,0,0,0-2.017-.648c-.308-.075-.6-.133-.867-.172a5.241,5.241,0,0,0-.747-.061H5.338a.662.662,0,0,0-.66.66V66H0V91.21l18.247,1.1v.55h3.57v-.55l18.246-1.1V66ZM17.193,90.051a28.569,28.569,0,0,0-3.1-.69c-1.036-.176-2.02-.293-2.811-.352-1.541-.11-3.963-.209-6.008-.28-1.272-.045-2.4-.078-3.064-.1V68.171H4.678V86.806a.662.662,0,0,0,.66.661h5.446a4.52,4.52,0,0,1,.786.086,12.88,12.88,0,0,1,2.033.578,15.558,15.558,0,0,1,3.455,1.78l.229.166C17.255,90.069,17.224,90.058,17.193,90.051Zm2.179.094c-.231-.238-.478-.468-.736-.686a15.519,15.519,0,0,0-4.221-2.431A15.6,15.6,0,0,0,12.4,86.38c-.308-.076-.6-.132-.867-.171a4.931,4.931,0,0,0-.747-.064H6V63.915h4.784A4.5,4.5,0,0,1,11.57,64a12.529,12.529,0,0,1,2.033.58,15.452,15.452,0,0,1,3.455,1.78,9.289,9.289,0,0,1,1.426,1.217,5.43,5.43,0,0,1,.888,1.226V90.145Zm1.32,0V68.806a6.33,6.33,0,0,1,1.587-1.89A14.272,14.272,0,0,1,26.133,64.7a14.6,14.6,0,0,1,1.844-.593c.274-.067.527-.116.748-.149a3.7,3.7,0,0,1,.555-.046h4.784V86.146H29.28a5.946,5.946,0,0,0-1.023.109A13.925,13.925,0,0,0,26,86.893a16.834,16.834,0,0,0-3.758,1.939A10.674,10.674,0,0,0,20.692,90.146Zm17.164-1.531H31.675c-.345,0-.762.024-1.239.07-.835.081-1.854.224-2.932.412a42.722,42.722,0,0,0-4.816,1.11l-.138.042a14.715,14.715,0,0,1,3.582-1.992,14.214,14.214,0,0,1,1.844-.593c.274-.067.527-.117.748-.149a3.891,3.891,0,0,1,.555-.048h5.444a.662.662,0,0,0,.661-.661V68.171h2.471Z" fill="none"/>
										</g>
									</g>
								</svg>
								<p class="mb-0">会報誌aul【あうる】専用ページ</p>
							</div>
							<ul class="bg-transparent p-0 mt-0 mb-4">
								<li><a href="/aul/" class="gtm-click-link" data-gtm-click="PCフッター 会報誌aul【あうる】専用ページ"><i class="fas fa-chevron-right pr-2"></i>会報誌aul【あうる】専用ページ</a></li>
							</ul>
						</div>
						<div class="menu-insuranse">
							<div class="footer-tit d-flex align-items-center w-100 pr-0">
								<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
									<g transform="translate(6028 -2402)">
										<rect width="50" height="50" transform="translate(-6028 2402)" fill="none"/>
										<g transform="translate(-6054.89 2405.504)">
										<path d="M397.457,271.924l.007,0,.01-.007Z" transform="translate(-333.124 -247.993)" fill="#4b4b4b"/>
										<path class="stroke-dark-<?php echo $member_type; ?>" d="M70.43,261.116h0a3.773,3.773,0,0,0-1.33-.931,4.245,4.245,0,0,0-1.638-.319,5.152,5.152,0,0,0-1.633.277,5.506,5.506,0,0,0-1.489.775l-.038.028-.012.008-.043.037c-.049.042-.144.114-.267.2-.432.32-1.232.872-2.179,1.516-.622.421-1.31.883-2.006,1.347,0-.034,0-.068,0-.1a4.109,4.109,0,0,0-4.105-4.105H47a16.024,16.024,0,0,0-3.72.4,10.849,10.849,0,0,0-3.826,1.7,17.339,17.339,0,0,0-2.423,2.166c-.139.142-.275.283-.412.418l-3.4,2.973a2.964,2.964,0,0,0-1.012,2.229v10.02a2.275,2.275,0,0,0,1.33,2.069h0a2.27,2.27,0,0,0,2.428-.347l6.339-5.434,9.973,1.812a4.6,4.6,0,0,0,.833.076,4.65,4.65,0,0,0,2.692-.852l0,0c.682-.475,4.019-2.8,7.311-5.1,1.647-1.153,3.28-2.3,4.568-3.216.642-.458,1.2-.856,1.627-1.168.215-.155.4-.289.543-.4s.255-.194.332-.258h0l.026-.022.011-.009.034-.032a4.2,4.2,0,0,0,.972-1.319,3.852,3.852,0,0,0,.357-1.567v-.049A4.2,4.2,0,0,0,70.43,261.116Zm-1.489,4.34c-.979.815-14.247,10.041-14.247,10.041a2.749,2.749,0,0,1-2.074.461l-10.395-1.89a1.036,1.036,0,0,0-.853.229L34.7,280.016a.339.339,0,0,1-.366.052.343.343,0,0,1-.2-.311v-10.02a1.022,1.022,0,0,1,.353-.775l3.451-3.015c1.9-1.9,3.624-4.166,9.06-4.166h8.694a2.173,2.173,0,1,1,0,4.347H49.713l.026.014a.774.774,0,1,0-.051,1.547l.025-.012h8.115s6.677-4.388,7.654-5.2c1.068-.791,2.667-.989,3.525-.055A2.049,2.049,0,0,1,68.94,265.456Z" transform="translate(0 -236.992)" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.25"/>
										<path class="stroke-dark-<?php echo $member_type; ?>" d="M143.023,17.973a23.906,23.906,0,0,0,4,2.1,1.66,1.66,0,0,0,1.264,0,23.967,23.967,0,0,0,4-2.1c2.7-1.839,7.073-5.45,7.073-10.537,0-5.163-2.92-7.5-6.132-7.435a5.86,5.86,0,0,0-4.868,2.919.785.785,0,0,1-1.412,0A5.862,5.862,0,0,0,142.081,0c-3.213-.067-6.133,2.272-6.133,7.435C135.948,12.524,140.325,16.135,143.023,17.973Z" transform="translate(-94.619 0)" fill="none" stroke-width="2.5"/>
									</g>
								</svg>
								<p class="mb-0">おすすめ保険</p>
							</div>
							<ul class="bg-transparent p-0 mt-0 mb-4">
								<li><a href="/insurance/sonpo/" class="gtm-click-link" data-gtm-click="PCフッター 団体総合生活補償保険"><i class="fas fa-chevron-right pr-2"></i>団体総合生活補償保険</a></li>
								<li><a href="/insurance/care-plus/" class="gtm-click-link" data-gtm-click="PCフッター 全厚済ケアプラス保険"><i class="fas fa-chevron-right pr-2"></i>全厚済ケアプラス保険</a></li>
								<li><a href="/insurance/golfer-aid/" class="gtm-click-link" data-gtm-click="PCフッター 全厚済ゴルファーエイド保険"><i class="fas fa-chevron-right pr-2"></i>全厚済ゴルファーエイド保険</a></li>
								<li><a href="/insurance/cancer/" class="gtm-click-link" data-gtm-click="PCフッター 全厚済がんサポート保険"><i class="fas fa-chevron-right pr-2"></i>全厚済がんサポート保険</a></li>
								<li><a href="https://nihonkyosai.co.jp/insurance_list" target="_blank" class="gtm-click-link" data-gtm-click="PCフッター インターネット保険"><i class="fas fa-chevron-right pr-2"></i>インターネット保険</a></li>
								<li><a href="https://www.nihonpet.co.jp/landingpage/zenkosai/" target="_blank" class="gtm-click-link" data-gtm-click="PCフッター いぬとねこの保険"><i class="fas fa-chevron-right pr-2"></i>いぬとねこの保険</a></li>
							</ul>
						</div>
						<div class="menu-experience">
							<div class="footer-tit d-flex align-items-center w-100 pr-0">
								<svg class="footer-tit__icon fill-dark-<?php echo $member_type; ?> pr-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50">
									<g transform="translate(5681 -2402)">
										<rect width="50" height="50" transform="translate(-5681 2402)" fill="none"/>
										<g transform="translate(-5676.118 2374.597)">
										<path class="stroke-dark-<?php echo $member_type; ?>" d="M259.224,232.924a7.791,7.791,0,0,0,1.467-4.506,8,8,0,0,0-2.211-5.425,11.4,11.4,0,0,0-5.417-3.183l-.569,2.091a9.24,9.24,0,0,1,4.39,2.559,5.817,5.817,0,0,1,1.64,3.959,5.624,5.624,0,0,1-1.073,3.26,8.126,8.126,0,0,1-2.964,2.5l-.915.468,1.186,2.651a47.433,47.433,0,0,1-8.612-2.449l-.033-.013-.034-.011a8.385,8.385,0,0,1-4.922-3.749l-1.9,1.042a10.515,10.515,0,0,0,6.1,4.749h0a46.742,46.742,0,0,0,11.068,2.859l1.882.209-1.945-4.35A9.951,9.951,0,0,0,259.224,232.924Z" transform="translate(-220.454 -169.251)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
										<path class="stroke-dark-<?php echo $member_type; ?>" d="M28.217,55.822a10.893,10.893,0,0,0,2.821-7.2,10.462,10.462,0,0,0-1.263-4.956A13.619,13.619,0,0,0,24.1,38.2a18.247,18.247,0,0,0-8.582-2.078A17.575,17.575,0,0,0,4.64,39.7,12.789,12.789,0,0,0,1.262,43.67,10.463,10.463,0,0,0,0,48.627a10.653,10.653,0,0,0,2.009,6.162,13.877,13.877,0,0,0,4.282,3.889L3.685,64.506,5.567,64.3a66.332,66.332,0,0,0,15.675-4.049A15.47,15.47,0,0,0,28.217,55.822Zm-7.726,2.393-.033.013A67.051,67.051,0,0,1,7.231,61.885l1.863-4.166-.915-.468a12.055,12.055,0,0,1-4.4-3.709,8.479,8.479,0,0,1-1.615-4.915,8.289,8.289,0,0,1,1.007-3.935,11.464,11.464,0,0,1,4.785-4.579,16.077,16.077,0,0,1,7.561-1.823A15.426,15.426,0,0,1,25.055,41.4a10.636,10.636,0,0,1,2.81,3.291,8.3,8.3,0,0,1,1.006,3.935,8.72,8.72,0,0,1-2.285,5.77A13.345,13.345,0,0,1,20.525,58.2Z" transform="translate(0 0)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
										</g>
									</g>
								</svg>
								<p class="mb-0">利用体験談</p>
							</div>
							<ul class="bg-transparent p-0 my-0">
								<li><a href="/service-experience/" class="gtm-click-link" data-gtm-click="PCフッター 体験談一覧"><i class="fas fa-chevron-right pr-2"></i>体験談一覧</a></li>
								<li><a href="/service-experience-list/form" class="gtm-click-link" data-gtm-click="PCフッター 体験談投稿"><i class="fas fa-chevron-right pr-2"></i>体験談投稿</a></li>
							</ul>
						</div>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="footer-others w-100 m-0 pt-2">
			<div class="footer-others__container mx-auto">
				<ul class="row list-unstyled">
					<li class="col-12 col-md-3">
						<a href="/law" class="gtm-click-link" data-gtm-click="フッター 特定商取引法に基づく表記"><i class="fas fa-chevron-right pr-2"></i>特定商取引法に基づく表記</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/questionnaire" class="gtm-click-link" data-gtm-click="フッター アンケートのお願い"><i class="fas fa-chevron-right pr-2"></i>アンケートのお願い</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/constitution" class="gtm-click-link" data-gtm-click="フッター 一般財団法人全国福利厚生共済会会則"><i class="fas fa-chevron-right pr-2"></i>一般財団法人全国福利厚生共済会会則</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/rule" class="gtm-click-link" data-gtm-click="フッター プライム倶楽部会員規約"><i class="fas fa-chevron-right pr-2"></i>プライム倶楽部会員規約</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/compliance" class="gtm-click-link" data-gtm-click="フッター コンプライアンス基本方針"><i class="fas fa-chevron-right pr-2"></i>コンプライアンス基本方針</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/compliance-2/" class="gtm-click-link" data-gtm-click="フッター カスタマーハラスメントに対する基本方針"><i class="fas fa-chevron-right pr-2"></i>カスタマーハラスメントに対する基本方針</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="https://nihonkyosai.co.jp/" target="_blank" class="gtm-click-link" data-gtm-click="フッター 運営業務委託先：日本共済株式会社"><i class="fas fa-chevron-right pr-2"></i>運営業務委託先：日本共済株式会社<i class="fas fa-external-link pl-2"></i></a>
					</li>
					<li class="col-12 col-md-3">
						<?php if (is_user_loggedin()) : ?>
						<a href="/suggestion" class="gtm-click-link" data-gtm-click="フッター 代表理事目安箱"><i class="fas fa-chevron-right pr-2"></i>代表理事目安箱</a>	
						<?php else: ?>
						<a href="/non-member_faq/" class="gtm-click-link" data-gtm-click="フッター 会員募集についてよくある質問"><i class="fas fa-chevron-right pr-2"></i>会員募集についてよくある質問</a>	
						<?php endif; ?>
					</li>
					<li class="col-12 col-md-3">
						<a href="/contact" class="gtm-click-link" data-gtm-click="フッター お問合せ"><i class="fas fa-chevron-right pr-2"></i>お問合せ</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/terms" class="gtm-click-link" data-gtm-click="フッター ご利用規約"><i class="fas fa-chevron-right pr-2"></i>ご利用規約</a>
					</li>
					<li class="col-12 col-md-3">
						<a href="/privacy-policy" class="gtm-click-link" data-gtm-click="フッター プライバシーポリシー"><i class="fas fa-chevron-right pr-2"></i>プライバシーポリシー</a>
					</li>
					<li class="col-12 col-md-3">
						<?php if($_SESSION['member_info']['member_id'] === '000000000000') : ?>
						<a href="/acor-test"><i class="fas fa-chevron-right pr-2"></i>アコーディオン</a>
						<?php endif; ?>
					</li>
				</ul>
				<div class="copyright text-center font-smaller w-100">
					<p>Copyright © 2021 一般財団法人全国福利厚生共済会</p>
				</div>
			</div>
		</div>
	</footer>

		<?php if (is_user_loggedin()) : ?>
			<?php
				//利用開始日
				$startdate = $_SESSION['member_info']['startdate'];
				if (!$startdate && $_SESSION['member_info']['member_id'] == '000000000000') {
					$startdate = '2022/07/01';
				}
				$startdate_datetime = new DateTime($startdate);
				$startdate_popup = $startdate_datetime->format('Y年m月d日');

				$member_id = $_SESSION['member_info']['member_id'];
				global $wpdb;
				if ($member_id) {
				$member_data = $wpdb->get_results("SELECT member_id, area_name, gate_name, seat_name FROM ".$wpdb->prefix."ticket_members WHERE member_id = '".$member_id."'");
				}
			?>
			<!-- 会員カード -->
			<div id="js-member-card" class="card-modal">
				<div class="card-modal__content js-modal-card-bg"></div>
				<div class="mamber-card-detail modal__content">
					<div class="mamber-card-detail__content modal__content__detail">
						<div class="mamber-card-detail__content__detail">
							<div class="card-header">
								<img src="/cms/wp-content/uploads/2020/11/header-logo.png">
								<p class="mb-0">会員カード</p>
							</div>
							<div class="card-body">
								<div class="member-info d-flex align-items-center justify-content-between">
									<div class="member-block w-100">
										<p class="member-id mb-0">会員ID：<span id="js-member_id_qr"><?php echo sprintf('%08d', $_SESSION['member_info']['member_id']); ?></span></p>
										<!-- <p class="member-kana mb-0">ｹﾞｽﾄﾋﾟｰｶｲｲﾝ</p> -->
										<p class="member-name mb-0"><?php echo $_SESSION['member_info']['member_name']; ?></p>
										<div class="d-flex align-items-baseline justify-content-between">
											<p class="member-start mb-0 w-50">サービス利用開始日<br><span><?php echo $startdate_popup; ?></span></p>
											<p class="member-start mb-0 w-50">会員種別<br>
												<span>
													<?php
														$level_map = [
															'diamondclubmember' => 'ダイヤモンドクラブメンバー',
															'emeraldclubmember' => 'エメラルドクラブメンバー',
															'goldmember' => 'ゴールドメンバー',
															'member' => 'プライム倶楽部会員(P会員)',
															'p_member' => 'プライム倶楽部会員（P会員）',
															'ps_member' => 'プライム倶楽部会員（PS会員）',
															'k_member' => '共済会会員（K会員）',
															'ks_member' => '共済会会員（KS会員）',
															'plutinummember' => 'プラチナメンバー',
															'primediamondclubmember' => 'プライムダイヤモンドクラブメンバー',
														];

														$next_level = $_SESSION['member_info']['nextlv'] ?? '';
														echo isset($level_map[$next_level]) ? $level_map[$next_level] : $next_level;
													?>
												</span>
											</p>
										</div>
									</div>
									<?php //if ( !empty($member_data[0]) ) : ?>
									<!-- <div class="js-convention-member member-qr">
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/common/qr-sample.png">
										<div class="js-img-qr text-center"></div>
										<p class="mb-0">受付時に上のコードをご提示ください。</p>
									</div> -->
									<?php //endif; ?>
								</div>
							</div>
						</div>
						<?php //if ( !empty($member_data[0]) ) : ?>
						<!-- <div class="js-convention-member ticket">
							<div class="ticket__header">
								<span>2024 National Convention</span>
							</div>
							<div class="ticket__body">
								<table>
									<tr>
										<td>開催日</td>
										<td>2024年4月10日(水)</td>
									</tr>
									<tr>
										<td>会場</td>
										<td>ぴあアリーナMM</td>
									</tr>
									<tr>
										<td>開場(受付)</td>
										<td>12:00</td>
									</tr>
									<tr>
										<td>開演</td>
										<td>13:00</td>
									</tr>
									<tr>
										<td>エリア</td>
										<td><?php echo $member_data[0]->area_name; ?></td>
									</tr>
									<tr>
										<td>入口(扉)番号</td>
										<td><?php echo $member_data[0]->gate_name; ?></td>
									</tr>
									<tr>
										<td>列・席番号</td>
										<td><?php echo $member_data[0]->seat_name; ?></td>
									</tr>
								</table>
							</div>
						</div> -->
						<?php //endif; ?>
					</div>
				</div>
				<div class="js-modal-card-close modal-card-close">
					閉じる<span class="cloce-icon">×</span>
				</div>
			</div>
		</div>

			<?php
			//利用開始日
			$startdate = $_SESSION['member_info']['startdate'];
			if (!$startdate && $_SESSION['member_info']['member_id'] == '000000000000') {
				$startdate = '2022/07/01';
			}
			$startdate_datetime = new DateTime($startdate);
			$startdate_popup = $startdate_datetime->format('Y年m月d日');

			//利用開始月の9日
			$startdate_9 = substr_replace($startdate, '09', 8);
			$startdate_datetime_9 = new DateTime($startdate_9);
			$today_datetime = new DateTime('today');

			$start_message = false;
			if ($today_datetime < $startdate_datetime_9) {
				$start_message = true;
			}

			$mail_message = false;
			if (!$_SESSION['member_info']['mail']) {
				$mail_message = true;
			}

			if ($_SESSION['member_info']['member_type'] == 'k_member' || $_SESSION['member_info']['member_type'] == 'p_member') {
				if ($_SESSION['member_info']['mail_flg'] == 0) {
					$postal_message = true;
				}
			}

			if (!is_front_page()) {
				$start_message = false;
				$mail_message = false;
				$postal_message = false;
			}

			if ($start_message || $mail_message || $postal_message) :
		?>
		<div id="first-popup-wrap" class="modal_box">
			<div class="modal_bg"></div>
			<div class="modal_inner d-flex align-items-center">
				<div class="modal_close">
					<div class="close_btn rounded-pill">
						閉じる<span class="pl-3">×</span>
					</div>
				</div>
				<section class="modal_block first-popup w-100">
					<div class="first-popup__content">
						<?php if ($start_message) : ?>
						<div class=" mb-2 p-2 text-md-center">
							<p class="mb-0">サービス利用開始日は<span class="startdate_popup text-danger text-nowrap"><?php echo $startdate_popup; ?></span>です。</p>
							<p class="mb-0">一部のサービスは、サービス利用開始日から指定の日数経過後に利用可能となります。</p>
						</div>
						<?php endif; ?>
						<?php if ($mail_message || $postal_message) : ?>
						<div class="first-popup__content__attention mb-2 p-2 text-md-center">
							<p class="font-weight-bold mb-2"><span class="first-popup__content__attention__message">全厚済ホームページをご利用いただく前に、</span><span class="first-popup__content__attention__message">以下の設定をお願いいたします。</span></p>
							<?php if ($mail_message) echo '<p class="mb-0 mr-3">・メールアドレス</p>'; ?>
							<?php if ($postal_message) echo '<p class="mb-0 mr-3">・郵送物設定</p>'; ?>
							<?php if ($_SESSION['member_info']['member_type'] == 'k_member' || $_SESSION['member_info']['member_type'] == 'p_member') : ?>
								<button class="mypage_form emerald-link-btn btn rounded-pill my-2 mx-auto d-block" data-formid="submitMypage" data-formabout="contractor_info">
									設定する&nbsp;→
								</button>
							<?php else : ?>
								<button class="mypage_form emerald-link-btn btn rounded-pill my-2 mx-auto d-block" data-formid="submitMypage" data-formabout="registermember_info">
									設定する&nbsp;→
								</button>
							<?php endif; ?>
						</div>
						<?php endif; ?>
					</div>
				</section>
			</div>
		</div>
		<?php
			endif; // if ($start_message || $mail_message || $postal_message)
			endif; // if (is_user_loggedin())

			// if ($_SERVER['HTTP_X_FORWARDED_FOR'] !== '153.156.196.178') : //　日本共済様のIPアドレスをメンテナンス非表示にする場合 ここから
				// ログイン関連へのメンテナンス表示 ここから
				$today_date = new DateTime('now');
				$maintenance_start = new DateTime('2024-01-02 06:00:00'); // メンテナンス表示開始時間
				$maintenance_end = new DateTime('2024-09-21 9:00:00'); // メンテナンス表示終了時間
				if ( $maintenance_start <= $today_date && $today_date < $maintenance_end ) :
		?>
				<style>
					.b-tab.mypage_form {
						pointer-events: none !important;
						position: relative;
					}

					/* .header-login-button {
						position: relative;
					}

					.header-login-button .login {
						pointer-events: none ;
					} */

					.intromember, .hamburger-intromember, .hamburger-mypage {
						pointer-events: none;
					}

					header.siteHeader .inner-header .header-top .header-shortcut.pc ul li .login::before, header.siteHeader .inner-header .header-top .header-shortcut.pc ul li .intromember::before, .b-tab.mypage_form::before {
						content: "\30E1\30F3\30C6\30CA\30F3\30B9\4E2D";
						font-size: .8rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					header.siteHeader .inner-header .header-top .header-shortcut.pc ul li .login::after, header.siteHeader .inner-header .header-top .header-shortcut.pc ul li .intromember::after, .b-tab.mypage_form::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: .5rem;
					}

					/* .header-login-button .login::after {
						border-radius: .2rem;
					} */

					.display_pc header.n_member .login-forget-guide {
						display: none;
					}

					/* #login_modal_sp .login-link {
						position: relative;
						pointer-events: none;
					}

					#login_modal_sp .login-link::before {
						content: "\30E1\30F3\30C6\30CA\30F3\30B9\4E2D";
						text-align: center;
						font-size: 1rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					#login_modal_sp .login-link::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: 3rem;
					} */

					/* header.siteHeader .header-bottom.sp .b-tab.b-tab-login {
						pointer-events: none;
					}

					header.siteHeader .header-bottom.sp .b-tab.b-tab-login::before {
						content: "\30E1\30F3\30C6\A\30CA\30F3\30B9\4E2D";
						text-align: center;
						font-size: .8rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					header.siteHeader .header-bottom.sp .b-tab.b-tab-login::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: .5rem;
					} */

					header.siteHeader .inner-header .header-middle .header-shortcut.sp .intromember-sc {
						pointer-events: none;
						position: relative;
					}

					header.siteHeader .inner-header .header-middle .header-shortcut.sp .intromember-sc::before {
						content: "\30E1\30F3\30C6\A\30CA\30F3\30B9\4E2D";
						text-align: center;
						font-size: .8rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					header.siteHeader .inner-header .header-middle .header-shortcut.sp .intromember-sc::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: .5rem;
					}

					/* .menu-hamburger.open .menu-hamburger-inner .menu-hamburger-guide a {
						pointer-events: none;
					}

					.menu-hamburger.open .menu-hamburger-inner .menu-hamburger-guide .guide-btn {
						position: relative;
					}

					.menu-hamburger.open .menu-hamburger-inner .menu-hamburger-guide .guide-btn::before {
						content: "\30E1\30F3\30C6\30CA\30F3\30B9\4E2D";
						text-align: center;
						font-size: 1rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					.menu-hamburger.open .menu-hamburger-inner .menu-hamburger-guide .guide-btn::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: .5rem;
					} */

					.menu-hamburger.open .menu-hamburger-inner .menu-hamburger-guide .guide-forget {
						display: none;
					}

					.menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-intromember, .menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-mypage {
						position: relative;
					}

					.menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-intromember a, .menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-mypage a {
						pointer-events: none;
					}

					.menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-intromember::before, .menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-mypage::before {
						content: "\30E1\30F3\30C6\A\30CA\30F3\30B9\4E2D";
						text-align: center;
						font-size: 1rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					.menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-intromember::after, .menu-hamburger.open .menu-hamburger-inner .header-sp-menu .hamburger-mypage::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: .5rem;
					}

					#page-login form div .my_forgot_pass {
						display: none;
					}

					/* #page-login form div .my_submit_btn {
						pointer-events: none;
						position: relative;
					}

					#page-login form div .my_submit_btn::before {
						content: "\30E1\30F3\30C6\30CA\30F3\30B9\4E2D";
						text-align: center;
						font-size: 1rem;
						color: #fff;
						word-break: keep-all;
						position: absolute;
						z-index: 100;
						top: 50%;
						left: 50%;
						transform: translate(-50%, -50%);
					}

					#page-login form div .my_submit_btn::after {
						content: "";
						background-color: rgba(0, 0, 0, 0.5);
						width: 100%;
						height: 100%;
						position: absolute;
						top: 0;
						left: 0;
						border-radius: .5rem;
					} */
				</style>
				<script>
					// jQuery('button[name="my_signin"]').prop("disabled", true);
					// jQuery('.intromember').attr("tabindex", '-1');
					// jQuery('.hamburger-intromember a').attr("tabindex", '-1');
					// jQuery('.intromember-sc').attr("tabindex", '-1');
				</script>
				<?php endif; // ログイン関連へのメンテナンス表示 ここまで ?>
			<?php //endif; //日本共済様のIPアドレスをメンテナンス非表示にする場合 ここまで ?>
		
		<script>
		// jQuery(function($){
		// 	$('.footer-slide-div').slick({
		// 		lazyLoad: 'progressive',
		// 		slidesToShow: 6,
		// 		slidesToScroll: 1,
		// 		autoplay: true,
		// 		autoplaySpeed: 0,
		// 		speed: 5000,
		// 		centerMode: true,
		// 		pauseOnFocus: true,
		// 		pauseOnHover: true,
		// 		variableWidth: true,
		// 		adaptiveHeight:true,
		// 		arrows: false,
		// 		infinite: true,
		// 		cssEase: 'linear',
		// 		responsive: [{
		// 			breakpoint: 640,
		// 			settings: {
		// 				slidesToShow: 4,
		// 			}
		// 		}]
		// 	});
		// });
		</script>
	<?php endif;?>
<?php else : // if (!is_page('cancel-mail-magazine') && is_parent_slug() !== 'cancel-mail-magazine') ?>
	<footer class="siteFooter"></footer>
<?php endif; ?>
<?php //do_action( 'lightning_footer_after' ); ?>
<?php wp_footer(); ?>
</body>
</html>
