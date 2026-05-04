<?php
/*
 * Template Name: lemino
 */
get_header();

?>
<link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/css/reset.css">
<link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/css/bundle.css">
<link rel="stylesheet" media="all" href="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/css/style.css?20260106">

<div id="page-lemino" class="page-wrapper pt-5 <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
	<div class="wrapper">
		
	<!--/共通エリア-->
		<h1 class="pb-3"><img class="pc_on" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/title_pc.png" alt="Lemino（レミノ）／ドコモの新しい映像サービス -"><img class="spOnly" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/title_pc.png" alt="Lemino（レミノ）／ドコモの新しい映像サービス -"></h1>
		
		<?php if($member_type == 'p_member' || $member_type == 'k_member'): ?>
		<h2 class="h2_img"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/lemino_s.png"></h2>
		<p>Leminoでしか見られないオリジナルドラマやバラエティ、<br class="pc-br">独占配信の人気韓国ドラマなどが見放題<br>
			<span class="fs-s">※アニメや映画など一部のコンテンツは対象外です。</span></p>
		
		<!--fix-->
		
		<section>
			<div class="text-center text-white mx1000 box_inner">
				<ul class="cont">
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_01.webp"><p>Lemino BOXING</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_02.webp"><p>ミッドナイト屋台２<br class="sc-br">～ル・モンドゥ～</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_03.webp"><p>結婚はしていませんがバツイチです</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_04.webp"><p>浜ちゃんの休日<br class="sc-br">～フィリピン・セブ島の旅～</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_05.webp"><p>情事と事情</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_06.webp"><p>Good Day</p></li>
				</ul>
				<div class="copyright">
					<p>&copy;Lemino / SECOND CAREER &copy; NTT DOCOMO， INC./東海テレビ &copy;WHYNOT MEDIA Co.， Ltd. All rights reserved. &copy;FANY Studio &copy;NTT DOCOMO，INC. &copy;TEO corp.</p>
				</div>
			</div>
		</section>
		<?php endif;?>
		<!--共通エリア/-->
		
		<!--契約者のみエリア-->
		<?php if($member_type == 'p_member' || $member_type == 'k_member'): ?>
		<div class="pop_ic">
			<a href="#pre01">
				<img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/pop.webp">
			</a>
		</div>
		<?php endif;?>
		<!--契約者のみエリア-->
		<!--サービス受領者-->
		<?php if($member_type == 'ps_member' || $member_type == 'ks_member'): ?>
		<div class="pop_ic">
			<a href="#pre02">
				<img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/pop.webp">
			</a>
		</div>
		<?php endif;?>
		<!--サービス受領者-->
		
		
		<!--/Leminoセレクション契約者のみエリア-->
		<?php if(is_user_loggedin()) :?>
			<?php if($member_type == 'p_member' || $member_type == 'k_member'): ?>
			<section>
				<h2 class="h2_title">契約者(P会員・K会員)への<br class="sc-br">特別なご案内</h2>
				<p>Leminoセレクションが<br class="sc-br">お楽しみいただけます<br>
				<span class="fs-ss">※dアカウントの登録・Leminoセレクションのお申込みにお客様負担の費用はございません</span></p>
				<div class="cp_ext">
					<img class="pc" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cp_ext_pc.png">
					<img class="sp" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cp_ext_sp.png">
				</div>
				<div class="relative text-white top_about box_inner">
					<a id="submit_lemino_selection_btn" class="btn_ent sct gtm-click-link" data-gtm-click="Leminoセレクション" target="_blank">Leminoセレクション<br>お申込みはこちら
						<span class="arrow"></span></a>
					<p>※全厚済を退会された場合、退会月の月末23時59分をもってLeminoセレクションの視聴権が終了し、以降は視聴ができなくなります。<br>
						※dアカウントをお持ちでない方は<a href="https://id.smt.docomo.ne.jp/src/appli/create_account_new.html" class="text_a" target="_blank">新規作成</a>が必要です<br>
						※dアカウントの登録にお客様負担の費用はございません</p>
				</div>
			</section>
			<!--Leminoセレクション契約者のみエリア/-->
			
			<!--/Leminoプレミアム契約者のみエリア-->
			<section id="pre01">
				<h2 class="h2_img"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/lemino_p.png"></h2>
				<p>人気アニメやドラマ、映画など<br class="pc-br">Leminoを思い切り楽しむアップグレードプランです。</p>
			
				<ul class="cont">
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_08.webp"><p>Dating Game～口説いてもいいですか、ボス!?～</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_09.webp"><p>JO1のSURVIVAL DICE</p></li>
				</ul>
				<ul class="cont">
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_11.webp"><p>乃木坂、逃避行。SEASON3</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_12.webp"><p>乗り換え恋愛<br class="sc-br">～新たな出会いの始まり～</p></li>
				</ul>
				<div class="copyright copy-center">
					<p>&copy;datinggame2025 &copy;FANY studio &copy; NTT DOCOMO， INC. ©TVING Co.， Ltd， All Rights Reserved.</p>
				</div>
				<h2 class="h2_title">全会員様へ特別なご案内</h2>
				<p>特別価格でLeminoプレミアムが<br class="sc-br">お楽しみいただけます。<br>
				<div class="cp_ext">
					<img class="pc" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cp_ext_pc.png">
					<img class="sp" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cp_ext_sp.png">
				</div>
				<p class="fc_pink mb-0">初回初月無料</p>
				<p class="price"><span class="slash">月額1,540円(税込)</span>　→ 月額<span class="fs-l">1,210</span>円(税込)</p>
				<div class="relative text-white top_about box_inner mt-4 pb-4">
					<p>※2月1日以降の決済から新料金での適用となります。</p>
				</div>
				<!--fix-->
				<div id="settlement_page-link" class="relative text-white top_about box_inner mt-4 pb-4">
					<a id="submit_lemino_premium_btn" class="btn_ent prm gtm-click-link" data-gtm-click="Leminoプレミアム（P会員・K会員）初回申し込み" target="_blank">Leminoプレミアム<br>お申込みはこちら<br><span class="arrow"></span></a>
					<?php if (in_array((int)$_SESSION['member_info']['member_id'], [0, 80, 81, 83, 87, 89], true)) : ?>
					<a id="submit_lemino_premium_second_btn" class="btn_ent prm gtm-click-link" data-gtm-click="Leminoプレミアム（P会員・K会員）初回申し込み" target="_blank">Leminoプレミアム<br>お申込みはこちら<br><small>(0会員表示用)</small><span class="arrow"></span></a>
					<?php endif?>
					<p>※初回の方に限り初月無料となります。<br>
						※本キャンペーンへのお申込みが2回目以降の方は初月無料適用外となり、ご契約開始日から特別価格での月額料金をお支払いいただきます。<br>
						※ご自身の契約内容を確認される場合は、<a id="submit_lemino_settlement" data-gtm-click="Leminoプレミアム 決済マイページ" class="text_a"><font color="red"><u>決済マイページ</u></font></a>からご確認ください。<br>
						※dアカウントをお持ちでない方は<a href="https://id.smt.docomo.ne.jp/src/appli/create_account_new.html" class="text_a" target="_blank">新規作成</a>が必要です<br>
						※dアカウントの登録にお客様負担の費用はございません</p>
				</div>
			</section>
			<!--Leminoプレミアム契約者のみエリア/-->
			<?php endif; ?>
		
			<?php if($member_type == 'ps_member' || $member_type == 'ks_member'): ?>
			<!--/サービス受領者(KS会員・PS会員)のみエリア-->
			<!-- <section class="ks-ps_plan">
				<h2 class="h2_title">サービス受領者(KS会員・PS会員)への特別なご案内</h2>
					<p>Leminoセレクションを特別価格で<br class="sc-br">お楽しみいただけます！</p>
				
				<p class="top_lead"><span>お申込み期間：<br class="sc-br">2025年11月5日(水)～3月31日(火)</span></p>
				<p class="price">月額<span class="fs-l">●●</span>円(税込)</p>
				<div class="relative text-white top_about box_inner">
						<a href="" class="btn_ent sct">Leminoセレクション<br>お申込みはこちら
							<span class="arrow"></span></a>
						<p>※dアカウントをお持ちでない方は<a href="https://id.smt.docomo.ne.jp/src/appli/create_account_new.html" class="text_a">新規作成</a>が必要です<br>
							※dアカウントの登録・Leminoセレクションのお申込みにお客様負担の費用はございません</p>

				</div>
			</section> -->
			<!--サービス受領者(KS会員・PS会員)のみエリア/-->
			
			<!--/サービス受領者(KS会員・PS会員)のみエリア-->
			<section id="pre02" class="mt-5">
				<h2 class="h2_img"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/lemino_p.png"></h2>
				<p>人気アニメやドラマ、映画など<br class="pc-br">Leminoを思い切り楽しむアップグレードプランです。</p>
				
				<ul class="cont">
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_08.webp"><p>Dating Game～口説いてもいいですか、ボス!?～</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_09.webp"><p>JO1のSURVIVAL DICE</p></li>
				</ul>
				<ul class="cont">
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_11.webp"><p>乃木坂、逃避行。SEASON3</p></li>
					<li><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cont/con_12.webp"><p>乗り換え恋愛<br class="sc-br">～新たな出会いの始まり～</p></li>
				</ul>
				<div class="copyright copy-center">
					<p>&copy;datinggame2025 &copy;FANY studio &copy; NTT DOCOMO， INC. ©TVING Co.， Ltd， All Rights Reserved.</p>
				</div>
				<h2 class="h2_title">全会員様へ特別なご案内</h2>
				<p>特別価格でLeminoプレミアムが<br class="sc-br">お楽しみいただけます。<br>
				<div class="cp_ext">
					<img class="pc" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cp_ext_pc.png">
					<img class="sp" src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/cp_ext_sp.png">
				</div>
				<p class="fc_pink mb-0">初回初月無料</p>
				<p class="price"><span class="slash">月額1,540円(税込)</span>　→ 月額<span class="fs-l">1,210</span>円(税込)</p>
				<div class="relative text-white top_about box_inner mt-4 pb-4">
					<p>※2月1日以降の決済から新料金での適用となります。</p>
				</div>
			<!--fix-->
				<div id="settlement_page-link" class="relative text-white top_about box_inner mt-4 pb-4">
					<a id="submit_lemino_premium_btn" class="btn_ent prm gtm-click-link" data-gtm-click="Leminoプレミアム（PS会員・KS会員）初回申し込み" target="_blank">Leminoプレミアム<br>お申込みはこちら<br><span class="arrow"></span></a>
					<?php if (in_array((int)$_SESSION['member_info']['member_id'], [0, 80, 81, 83, 87, 89], true)) : ?>
					<a id="submit_lemino_premium_second_btn" class="btn_ent prm gtm-click-link" data-gtm-click="Leminoプレミアム（P会員・K会員）初回申し込み" target="_blank">Leminoプレミアム<br>お申込みはこちら<br><small>(0会員表示用)</small><span class="arrow"></span></a>
					<?php endif?>
					<p>※初回の方に限り初月無料となります。<br>
						※本キャンペーンへのお申込みが2回目以降の方は初月無料適用外となり、ご契約開始日から特別価格での月額料金をお支払いいただきます。<br>
						※ご自身の契約内容を確認される場合は、<a id="submit_lemino_settlement" data-gtm-click="Leminoプレミアム 決済マイページ" class="text_a"><font color="red"><u>決済マイページ</u></font></a>からご確認ください。<br>
						※dアカウントをお持ちでない方は<a href="https://id.smt.docomo.ne.jp/src/appli/create_account_new.html" class="text_a" target="_blank">新規作成</a>が必要です<br>
						※dアカウントの登録にお客様負担の費用はございません</p>
				</div>
			</section>
			<!--サービス受領者(KS会員・PS会員)のみエリア/-->
			<?php endif; ?>
		<?php endif; ?>
		<!--/共通エリア-->
		<section>
			<div class="text-center text-white mx1000">
			<h2 class="h2_title">Leminoご利用手順</h2>
		<div class="flow_design06">
		<ul class="flow06">
		<li>
			<dl>
			<dt><span class="icon06">STEP&nbsp;1</span></dt>
				<dd class="flex_box">
					<div class="flex_right w-100">
						<p class="pl-0">dアカウントをご用意のうえお申込みください。<br>
							dアカウントをお持ちでない方は<a href="https://id.smt.docomo.ne.jp/src/appli/create_account_new.html" class="text_a" target="_blank">新規作成</a>をしてください。<br>
							※アカウント作成に費用負担はございません。
						</p>
						<p class="pl-0" style="margin: 1rem 0;">［Leminoセレクションお申込み］<br>お申込みボタンをクリックし、STEP2へお進みください。</p>
						<p class="pl-0">［Leminoプレミアムお申込み］<br>お申込みボタンをクリックし、決済ページへ。<br>
						<a href="https://lemino.docomo.ne.jp/cp/0000150/" class="text_a">▶決済手順の詳細はこちら</a>
						</p>
						<p class="t-indent pl-3" style="margin-top: 1rem;">・過去にstripe(決済サイト)アカウントを作成されたことがある方はログイン</p>
						<p class="t-indent pl-3">・はじめての方は［新規会員の登録］より会員登録のうえ決済をおこなってください。</p>
					</div>
				</dd>
			</dl>
		</li>

			<li>
			<dl>
			<dt><span class="icon06">STEP&nbsp;2</span></dt>
				<dd class="flex_box">
					<div class="flex_left"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/step2.webp"></div>
					<div class="flex_right"><p>dアカウントでログインしてください<br>
	※dアカウントをお持ちでない方は<br class="pc-br">こちらから<a href="https://id.smt.docomo.ne.jp/src/appli/create_account_new.html" target="_blank" class="text_a">新規作成</a>をお願いします
	</p></div>
				</dd>
			</dl>
		</li>
			
		<li>
			<dl>
			<dt><span class="icon06">STEP&nbsp;3</span></dt>
				<dd class="flex_box">
					<div class="flex_left"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/step3.jpg"></div>
					<div class="flex_right"><p>会員IDを確認し「シリアルコードを発行する」<br class="pc-br">ボタンを押下</p></div>
				</dd>
			</dl>
		</li>

		<li>
			<dl>
			<dt><span class="icon06">STEP&nbsp;4</span></dt>
			<dd class="flex_box">
					<div class="flex_left"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/step4.webp"></div>
					<div class="flex_right"><p>「コピー」ボタンを押下してから<br class="pc-br">「コード入力ページへ」ボタンを押下</p></div>
				</dd>
			</dl>
		</li>
			<li>
			<dl>
			<dt><span class="icon06">STEP&nbsp;5</span></dt>
			<dd class="flex_box">
					<div class="flex_left"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/step5.webp"></div>
				<div class="flex_right"><p class="t-indent">・シリアルコード入力欄に前のページでコピーしたコードを貼り付け</p>
					<p class="t-indent">・同意項目にチェックを入れて「Leminoを利用する」ボタンを押下</p>
					<p class="t-indent"><span class="fs-s">※スマートフォンの場合、入力欄を長押しで貼り付けを選択することで貼り付け可能です</span></p>
					<p class="t-indent"><span class="fs-s">※シリアルコードの登録は2026年5月31日までに実行をお願いいたします。</span></p></div>
				</dd>
			</dl>
		</li>
		</ul>
	</div>
				
			<h3 class="app">アプリをダウンロードして<br class="sc-br">Leminoで<br>話題の作品をお楽しみください！<br><small style="font-weight: 300;font-size: 60%">※PCブラウザはアプリなしでお楽しみいただけます</small></h3>
			<ul class="app">
					<li class="sp_and"><a href="https://play.google.com/store/apps/details?id=jp.ne.docomo.lemino.android"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/icon_google.webp"></a></li>
				<li class="sp_iphone"><a href="https://apps.apple.com/jp/app/lemino/id1641218070"><img src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/images/icon_apple.webp"></a></li>
					</ul>
		
			</div>
		</section>
		
		<div class="common_footer_wrapper" id="common_footer_wrapper"> 
			<section class="common_footer_section_faq faq_section">
				<h2>よくある質問</h2>
				<ul class="faq_common_footer_section_list pb8">
					<?php if($member_type == 'p_member' || $member_type == 'k_member'): ?>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoセレクションとはなんですか？</p>
						<p class="faq_answer" style="display: none;">動画・映像配信サービスLeminoでしか見られないオリジナルコンテンツ、韓流、スポーツなどを厳選してパッケージ化したプランです。<br>アニメや映画など一部のコンテンツは対象外です。</p>
					</li>
					<?php endif;?>
					<li class="faq_item mb-0">
						<p class="faq_question">dアカウントの新規作成方法を教えてください。</p>
						<p class="faq_answer" style="display: none;">以下のURLからご作成お願いいたします。<br><a href="https://id.smt.docomo.ne.jp/cgi8/id/register" target="_blank">https://id.smt.docomo.ne.jp/cgi8/id/register<i class="fa-solid fa-up-right-from-square pl-2"></i></a><br><br>すでにdアカウントがあるかを確認したい場合は、<br>以下のURLからご確認お願いいたします。<br>・IDの確認は、<br><a href="https://id.smt.docomo.ne.jp/src/utility/id_forget.html" target="_blank">https://id.smt.docomo.ne.jp/src/utility/id_forget.html<i class="fa-solid fa-up-right-from-square pl-2"></i></a><br><br>・パスワードの確認は、<br><a href="https://id.smt.docomo.ne.jp/src/utility/pw_forget.html" target="_blank">https://id.smt.docomo.ne.jp/src/utility/pw_forget.html<i class="fa-solid fa-up-right-from-square pl-2"></i></a></p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">どのようなデバイスで視聴することができますか？</p>
						<p class="faq_answer pc_on" style="display: none;">Leminoはマルチデバイスに対応！スマートフォン、テレビ、パソコン、タブレットなどで同時に4台までご視聴いただけます。なお、4台のデバイスでそれぞれ別の作品を視聴することは可能ですが、同じ作品を複数のデバイスで同時に再生することはできません。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">ドコモの回線以外でもLeminoを利用できますか？</p>
						<p class="faq_answer pc_on" style="display: none;">ドコモの回線契約をお持ちでない方でも、dアカウントがあればLeminoをご利用いただけます。<br>dアカウントは以下URLより新規発行いただけます。<br><a href="https://id.smt.docomo.ne.jp/cgi8/id/register" target="_blank">https://id.smt.docomo.ne.jp/cgi8/id/register<i class="fa-solid fa-up-right-from-square pl-2"></i></a></p>
					</li>
					<?php if($member_type == 'p_member' || $member_type == 'k_member'): ?>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoセレクションの解約方法を教えてください。</p>
						<p class="faq_answer" style="display: none;">Leminoセレクションにお申込みできる契約者(P会員・K会員)は解約の必要はございません。キャンペーン期間の間はお支払いが発生せず、それ以降もお支払いはございません。<br>ただし全厚済の会員を退会した場合は、退会月の月末23時59分をもってLeminoセレクションの視聴権が終了し、以降は視聴できなくなります。<br><br>例）10月20日締めで全厚済を解約した場合は、10月31日の23時59分でLeminoセレクションが解約となり、視聴できなくなります。</p>
					</li>
					<?php endif;?>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoプレミアムとはなんですか？</p>
						<p class="faq_answer" style="display: none;">動画・映像配信サービスLeminoの映画・ドラマ・アニメ・韓流・音楽などさまざまなジャンルをご覧いただけるプランです。</p>
					</li>
					<?php if($member_type == 'ps_member' || $member_type == 'ks_member'): ?>
					<li class="faq_item mb-0">
						<p class="faq_question">サービス受領者（KS会員、PS会員）は、「Leminoセレクション」を視聴できますか？</p>
						<p class="faq_answer" style="display: none;">Leminoセレクションは、契約者(P会員・K会員)様が対象のサービスのため、サービス受領者様にはご案内がございません。本ページでご案内しているLeminoプレミアムは、Leminoセレクションより種類が多く、人気アニメや映画もご視聴いただけるプランです。</p>
					</li>
					<?php endif;?>
					<li class="faq_item mb-0">
						<p class="faq_question">どのような支払い方法がありますか？</p>
						<p class="faq_answer" style="display: none;">クレジットカード払いのみのお支払いとなります。利用可能カードは「JCB」「VISA」「MasterCard」「AMERICAN EXPRESS」「Diners Club」「Discover」となります。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">登録しているクレジットカードの情報は、どのように変更すればよいですか？</p>
						<p class="faq_answer" style="display: none;">以下の決済マイページにログインのうえ、ページ下部にある「カード情報変更」ボタンをクリックしてください。<br>その後、カード情報欄の横にある鉛筆マークをクリックし、画面の案内に沿って新しいカード情報を登録・変更できます。<br><br><a href="#settlement_page-link" class="gtm-click-link" data-gtm-click="faq 決済マイページのページ内リンク（登録しているクレジット）"><font color="red"><u>▶決済マイページはこちらから</u></font></a></p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoプレミアムの決済日はいつになりますか？</p>
						<p class="faq_answer" style="display: none;">無料期間がある場合は、無料期間が終了した次の日に決済となります。無料期間がない場合は、ご登録いただいた日が決済日となります。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoプレミアムの解約方法を教えてください。</p>
						<p class="faq_answer" style="display: none;">以下の決済マイページにログインのうえ、ページ下部にある「解約手続きに進む」よりお手続きください。なお、会員様ご自身で解約手続きを行わない限り、決済日に自動的に継続課金されますのでご注意ください。<br><br><a href="#settlement_page-link" class="gtm-click-link" data-gtm-click="faq 決済マイページのページ内リンク（解約方法）"><font color="red"><u>▶決済マイページはこちらから</u></font></a></p>
					</li>

					<li class="faq_item mb-0">
						<p class="faq_question">すでに一般申込みでLeminoプレミアム（月額1,540円）を利用していますが、全厚済のキャンペーン価格のLeminoプレミアム（月額1,210円）を利用できますか？</p>
						<p class="faq_answer" style="display: none;">キャンペーンのご利用は可能です。<br>全厚済のキャンペーン価格のLeminoプレミアムをご利用される際は、現在ご登録いただいているLeminoプレミアムをご解約の上、改めて本キャンペーンページからお申込みください。本順序での解約をされない場合、二重での課金が発生する可能性がございますので、手順をご確認の上、ご解約お願いいたします。</p>
					</li>
					<?php if($member_type == 'p_member' || $member_type == 'k_member'): ?>
					<li class="faq_item mb-0">
						<p class="faq_question">LeminoセレクションからLeminoプレミアムへ移行したい場合はどうしたらいいですか？</p>
						<p class="faq_answer" style="display: none;">本ページ記載のLeminoプレミアム申込ページのボタンをクリックいただき、決済いただければ利用が可能です。<br>LeminoプレミアムはLeminoセレクションの内容を網羅しているため、Leminoセレクションはアップグレードの確認ができ次第、解約とさせていただきます。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoプレミアムからセレクションへ移行したい場合はどうしたらいいですか？</p>
						<p class="faq_answer" style="display: none;">ご契約中のLeminoプレミアムを、以下の決済マイページにログインのうえ、ページ下部にある「解約手続きに進む」からご解約ください。<br>解約後、再度「Leminoセレクション」のお申込みボタンをクリックし、シリアルコードを取得していただくとご利用が可能になります。<br><br>なお、Leminoプレミアムは次回決済日の前日までご利用いただけます。<br>ご自身で解約手続きを行わない場合、決済日に自動的に継続課金されますので、必ずLeminoプレミアムを解約のうえ、Leminoセレクションをご利用ください。<br><br><a href="#settlement_page-link" class="gtm-click-link" data-gtm-click="faq 決済マイページのページ内リンク（プラン移行）"><font color="red"><u>▶決済マイページはこちらから</u></font></a></p>
					</li>
					<?php endif;?>
					<li class="faq_item mb-0">
						<p class="faq_question">全厚済の会員を退会した場合、どうなりますか？</p>
						<p class="faq_answer" style="display: none;">・Leminoセレクションをご利用のP会員・K会員の方へ<br>退会月の月末23時59分をもって、Leminoセレクションの視聴権が終了し、以降はご視聴いただけなくなります。<br><br>・Leminoプレミアムをご利用の会員の方へ<br>退会月以降、Leminoプレミアムの自動更新は停止され、視聴権も終了いたします。<br>ただし、自動更新の停止処理が間に合わない場合がございます。確実に次回の決済を停止するため、全厚済会員の退会時には、Leminoプレミアムの契約を必ずご自身で解約いただきますようお願いいたします。<br><br>〈例〉<br>・Leminoセレクションの場合<br>10月20日締めで全厚済を退会された場合、10月31日23時59分をもってLeminoセレクションが解約となり、以降は視聴できません。<br><br>・Leminoプレミアムの場合（10月10日にLeminoプレミアムを契約の場合）<br>10月20日締めで全厚済を退会された場合、次回決済日（11月10日）までに決済停止となり、11月9日23時59分をもって視聴ができなくなります。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">すでにLemino（全厚済経由）を利用しており、全厚済の契約者変更またはサービス受領者変更を行った場合、どうなりますか？</p>
						<p class="faq_answer" style="display: none;">・Leminoセレクションをご利用のP会員・K会員の方へ<br>契約者変更月の月末23時59分をもって、Leminoセレクションの視聴権が終了し、以降はご視聴いただけなくなります。<br>引き続きご利用を希望される場合は、新しい契約者様が翌月1日以降に、改めてLeminoセレクションをお申込みください。<br><br>・Leminoプレミアムをご利用の会員の方へ<br>契約者・サービス受領者変更月以降、Leminoプレミアムの自動更新は停止され、視聴権も終了いたします。<br>ただし、自動更新の停止処理が間に合わない場合がございます。確実に次回の決済を停止するため、全厚済会員の契約者・サービス受領者変更時には、Leminoプレミアムの契約を必ずご自身で解約いただきますようお願いいたします。<br>新しい契約者・サービス受領者様は翌月1日以降にLeminoプレミアムを改めてお申込みいただくことで、再度ご利用いただけます。<br><br>※全厚済の契約者変更は、毎月20日締め、翌月1日付で新契約者に変更されます。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">全厚済の会員種別をサービス受領者（KS会員またはPS会員）から契約者（P会員またはK会員）へ変更した場合、どうなりますか？</p>
						<p class="faq_answer" style="display: none;">契約者（P会員またはK会員）へ変更された時点で、Leminoセレクションにお申込みいただくことが可能です。<br>なお、すでにLeminoプレミアムをご利用中の場合、Leminoプレミアムを解約されない限り、引き続きご利用いただけます。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">すでに一般申込みでLeminoプレミアム（月額1,540円）を利用し、無料期間の特典を受けたことがあります。全厚済経由で再度Leminoプレミアム（月額1,210円）に申し込む場合、無料期間は適用されますか？</p>
						<p class="faq_answer" style="display: none;">これまでにLeminoプレミアム（月額1,540円）の無料期間特典を受けた方でも、全厚済を通じて新たにLeminoプレミアム（月額1,210円）へお申し込みいただく場合は、無料期間の特典が再度適用されます。<br>ただし、全厚済経由のLeminoプレミアム（月額1,210円）をご利用後にご自身でLeminoを解約し、再度同じプランをお申し込みいただいた場合は、無料期間は再適用されませんのでご注意ください。</p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoプレミアムは無料期間経過後に自動的に解約されますか？</p>
						<p class="faq_answer" style="display: none;">全厚済を退会される際を除き、無料期間経過に関わらずご自身でご解約いただく必要がございます。<br>ご解約の際は、決済マイページからご解約いただくようお願いいたします。<br><br><a href="#settlement_page-link" class="gtm-click-link" data-gtm-click="faq 決済マイページのページ内リンク（無料期間経過後）"><font color="red"><u>▶決済マイページはこちらから</u></font></a></p>
					</li>
					<li class="faq_item mb-0">
						<p class="faq_question">Leminoプレミアムの料金変更はいつから適用されますか？</p>
						<p class="faq_answer" style="display: none;">2026年2月1日（日）より料金変更となりますが、2月1日以降の決済分より新料金が適用されます。ご契約者様により決済日が異なるため、決済マイページからご自身の決済日と料金についてはご確認ください。<br>また2026年2月1日以降にご契約される場合は、月額1,210円の新料金となります。<br><br><a href="#settlement_page-link" class="gtm-click-link" data-gtm-click="faq 決済マイページのページ内リンク（変更料金適応）"><font color="red"><u>▶決済マイページはこちらから</u></font></a></p>
					</li>
				</ul>
				<ul class="bottom_link">
					<li>■Leminoのよくある質問はこちら <br class="only_SP"><a href="https://faq.lemino.docomo.ne.jp/index.html" target="_blank">https://faq.lemino.docomo.ne.jp/index.html</a></li>
					<li>■Leminoのお問い合わせはこちら <br class="only_SP"><a href="https://lemino.docomo.ne.jp/contact" target="_blank">https://lemino.docomo.ne.jp/contact</a></li>
					<li>■全厚済会員様だけの特別なご案内に関するお問い合わせは全厚済サポートデスクへお問合せください。</li>
				</ul>
			</section>
			

		</div>
		<!-- /.common_footer_wrapper --> 
		<!--共通エリア/-->
	</div>
</div>
<?php get_footer(); ?>
<script type="text/javascript" src="https://try.abtasty.com/5d4c4fb0a08561ffba02da8c0da26ff9.js"></script>
<script src="<?php echo get_stylesheet_directory_uri() ; ?>/lemino/js/script.js"></script>
<script src="js/jquery-3.6.4.min.js"></script> 
<script src="js/script.js"></script> 

<!-- User Insight PCDF Code Start :  --> 
<script type="text/javascript">
var currentDomain = location.origin;
if (currentDomain === 'https://lemino.docomo.ne.jp') {
    var _uic = _uic || {};
    var _uih = _uih || {};
    _uih['id'] = 55607;
    _uih['lg_id'] = '';
    _uih['fb_id'] = '';
    _uih['tw_id'] = '';
    _uih['uigr_1'] = '';
    _uih['uigr_2'] = '';
    _uih['uigr_3'] = '';
    _uih['uigr_4'] = '';
    _uih['uigr_5'] = '';
    _uih['uigr_6'] = '';
    _uih['uigr_7'] = '';
    _uih['uigr_8'] = '';
    _uih['uigr_9'] = '';
    _uih['uigr_10'] = '';
    _uic['uls'] = 1;
    _uic['security_type'] = -1;
    
    /* DO NOT ALTER BELOW THIS LINE */
    /* WITH FIRST PARTY COOKIE */
    (function() {
        var bi = document.createElement('script');
        bi.type = 'text/javascript';
        bi.async = true;
        bi.src = '//cs.nakanohito.jp/b3/bi.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(bi, s);
    })();
}
</script> 
<script>
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('submit_lemino_selection_btn');
  var form = document.getElementById('submit_lemino_selection');
  if (btn && form) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      form.submit();
    });
  }
});
// テスト
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('submit_lemino_premium_btn');
  var form = document.getElementById('submit_lemino_premium');
  if (btn && form) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      form.submit();
    });
  }
});
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('submit_lemino_settlement');
  var form = document.getElementById('submit_lemino_premium');
  if (btn && form) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      form.submit();
    });
  }
});
// 本番
document.addEventListener('DOMContentLoaded', function () {
  var btn = document.getElementById('submit_lemino_premium_second_btn');
  var form = document.getElementById('submit_lemino_premium_second');
  if (btn && form) {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      form.submit();
    });
  }
});
</script>
