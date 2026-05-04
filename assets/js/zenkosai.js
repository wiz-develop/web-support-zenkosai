jQuery(function($){
    $(function () {
    });
    // GET/POST処理
    $(document).on('click', '.js_form_btn', function(e){
        e.preventDefault();
        var formname = $(this).children().data('formid');
        $('#'+formname).submit();
    });
    // GET/POST（マイページ・ビジネス）連携
    $(document).on('click', '.mypage_form, .seminar_form', function(e){
        e.preventDefault();
        var formname = $(this).data('formid');
        var dataabout = $(this).data('formabout');
        postMypageForm(formname, dataabout);
    });
    // ヘッダー用
    // ハンバーガーメニューの動作用
    $(document).on('click', '.menu-logo', function(){
        $('.menu-hamburger').toggleClass('open');
    });
    $(document).on('click', '.close.ham-sp-menu, .close-menu', function(){
        if($(this).not('.has-children')){
            $('.menu-hamburger').toggleClass('open');
        }
    });
    $(document).on('click','.acor-menu-ham',function(){
        $(this).toggleClass("opened");
        $(this).next('.acor-menu-child').toggleClass('opened');
    });
    // アコーディオンメニュー
    $(document).on('click','.acor-menu',function(){
        $(this).next().slideToggle();
        $(this).toggleClass("opened");
        $(this).next('.acor-menu-child').toggleClass('opened');

        if($(this).find('span.questioner-toggle-txt').text() == 'を見る'){
            $(this).find('.questioner-toggle-txt').text('を閉じる');
        }else{
            $(this).find('.questioner-toggle-txt').text('を見る');
        }
        // カレンダー用
        if($(this).find('calendar-acor-btn').text() == '詳細をみる'){
            $(this).find('.btn').text('詳細を閉じる');
        }else{
            $(this).find('.btn').text('詳細をみる');
        }
        // ボタンの文字を変更する
        if ($(this).hasClass('js-btn-text-change')) {
            if ($(this).text() == 'すべて表示') {
                $(this).text('閉じる');
            } else {
                $(this).text('すべて表示');
            }
        }
    });

    // ポップアップモーダル
    $(document).on('click','.pop-up',function(){
        $(this).toggleClass('opened');
        $(this).next().toggleClass('opened');
        if($(this).next().find('#movie-play').length) {
            document.getElementById("movie-play").play();
        }
    });
    $(document).on('click','.close-modal',function(){
        $(this).parents('.pop-up-child').toggleClass('opened');
        if($(this).parents('.pop-up-child').find('#movie-play').length) {
            document.getElementById("movie-play").pause();
        }
    });

    // ポップアップ
    $(document).on('click','.cancel-btn',function(){
        $(this).parents('.pop-up-child').toggleClass('opened');
    });

    // 新ポップアップモーダル
    $(document).on('click','.modal_trigger', function(){
      $(this).next('.modal_box').fadeIn(); // モーダルを表示する
      $('body').addClass('overflow-hidden');
    });

    $(document).on('click','.modal_close , .modal_bg', function(){
      $('.modal_box').fadeOut(); // モーダルを非表示にする
      $('body').removeClass('overflow-hidden');
    });

    // 2023.07.最新ポップアップモーダル
    $('.js-modal_trigger_new').on('click', function() {
        $('body').addClass('overflow-hidden');
        $(this).next('.js-modal_box_new').fadeIn();
        $('.js-modal_box_new').addClass('js-modal_box_new-active');
    });
    $('.js-modal_bg_new, .js-modal_close_new').on('click', function() {
        $('body').removeClass('overflow-hidden');
        $('.js-modal_box_new').fadeOut();
        $('.js-modal_box_new').removeClass('js-modal_box_new-active');
    });

    // 会員カードポップアップモーダル
    $('#js-header-member-card').on('click', function(){
        // $('.js-convention-member').hide();

        // コンベンション参加者データを表示
        // var convention_url = '/cms/wp-content/themes/zenkosai/api/convention-member-data.php';
        // $.ajax({
        //     type: 'POST',
        //     url: convention_url,
        //     dataType: 'json',
        // })
        // .done(function(data){
        //     if (data[0]) {
        //         $('.js-convention-member').show();
        //         var num = data[0].member_id;
        //         var member_id_ret = ( '00000000' + num ).slice( -8 );
        //         var utf8qrtext = unescape(encodeURIComponent(member_id_ret));
        //         $("#js-card-qr").html("");
        //         $("#js-card-qr").qrcode({text:utf8qrtext});

        //         $("#js-convention-area").text(data[0].area_name);
        //         $("#js-convention-gate").text(data[0].gate_name);
        //         $("#js-convention-seat").text(data[0].seat_name);
        //     }
        // })
        // .fail(function(){ // ajax通信成失敗の処理
        //     $('.js-convention-member').hide();
        // })

        $('#js-member-card').fadeIn(); // モーダルを表示する
        $('body').addClass('overflow-hidden');
    });

    $(document).on('click', '.js-modal-card-bg , .js-modal-card-close', function(){
      $('#js-member-card').fadeOut();
      $('body').removeClass('overflow-hidden');
    });

    // プラスα（スライドショー併用用）ポップアップモーダル
	$('.js-modal-open').on('click', function(){
		var target = $(this).data('target');
		var modal = document.getElementById(target);
		$(modal).fadeIn(); // モーダルを表示する
		return false;
	});

	$('.js-modal-close').on('click', function(){
		$('.js-modal').fadeOut(); // モーダルを非表示にする
		return false;
	});

    // クイックタグでタブを出力した場合に自動でnameを付与する
    if ($('.js-auto-nameadd').length) {
        $('.js-auto-nameadd').each(function(index, element) {
            var tab_name = 'tab-wrap' + index;
            var this_tab = $(this);
            var this_tab_children = this_tab.children('.js-auto-input-nameadd');
            this_tab_children.attr('name', tab_name);
            this_tab.children('p').remove();

            var tab_item_count = 0; 
            this_tab_children.each(function(index_input, element_input) {
                if (index_input == 0) {
                    $(element_input).prop('checked', true);
                }
                var tab_input_name = 'TAB-' + tab_name + '-' +  index_input;
                $(element_input).attr('id', tab_input_name);
                $(element_input).next('.tab-label').attr('for', tab_input_name);
                tab_item_count = index_input;
            })

            if (tab_item_count >= 3) {
                this_tab.addClass('tab-wrap-more');
            }
        })
    }

    // メール登録不備の会員用アクション
    $(document).on('click','.deficient_popup',function(){
        var dataname = $(this).data('name');
        var datatype = $(this).data('type');
        if (!datatype) {
            datatype = $(this).children().data('type');
        }
        var formname = $(this).data('formid');
        var dataabout = $(this).data('formabout');
        var thisbtn = $(this);
        url = '/cms/wp-content/themes/zenkosai/api/session_reset.php'
        result = '';
        $.ajax({
            url: url,
            type: 'get',
            async: false,
        })
        .done(function (data) {
            result = data;
            console.log(result); //resetted
            // console.log(dataname);
            console.log(datatype);
            // console.log(thisbtn);
            // console.log(formname); submitMypage
            // console.log(dataabout);
            if(result == 'resetted'){
                if(datatype == 'get-info') {
                    $(thisbtn[0]).removeClass('deficient_popup');
                    $(thisbtn[0]).addClass('get-info');
                    interactWithElearning(dataname);
                }
                if(formname == 'submitMypage') {
                    $(thisbtn[0]).removeClass('deficient_popup');
                    $(thisbtn[0]).addClass('mypage_form');
                    postMypageForm(formname, dataabout);
                }
                if(datatype == 'pop-up') {
                    $(thisbtn[0]).removeClass('deficient_popup');
                    $(thisbtn[0]).addClass('modal_trigger');
                    $(thisbtn[0]).next('.modal_box').fadeIn();
                    $('body').addClass('overflow-hidden');
                }
            }
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        });
        if (!result || result=='failed'){
            item = '<div class="modal_box" style="display: block;">';
            item += '<div class="modal_bg"></div>';
            item += '<div class="modal_inner"><div class="modal_block">';
            item += '<h5 class="mail-n-title mt-3 px-2 py-1 font-weight-bold">メールアドレス未登録</h5><p>メールアドレスが登録されていないため、<br class="d-sm-none">次に進めません。</p><p>マイページ内の<br class="d-sm-none">【会員情報】>【契約者情報】より<br class="d-sm-none">メールアドレスを登録してください。</p>';
            item += '</div><div class="modal_close"><div class="rounded-pill">閉じる<span class="pl-3">×</span></div></div>';
            item += '</div></div>';
            $(this).before(item);
        }
    });

    // 体験談ページ画像拡大アクション
    $(document).on('click','.glass_zoom',function(){
        photoclone = $(this).prev().clone();
    });

    // e-learning連携
    $(document).on('click', 'button.get-info, a.get-info',function(e){
        e.preventDefault();
        loadingicon = '<div class="loading loading-circle"></div>';
        if($(this).hasClass('loading-parent')){
            $(this).addClass('loading-style');
            // $(this).css({
            //     'background-color': '#cadae8',
            //     'opacity': '1',
            // });
            $(this).append(loadingicon);
        }
        var dataname = $(this).data('name');
        interactWithElearning(dataname);
        $(this).removeClass('loading-style');
    });

    // PCサブメニュー
    var element = $('.flame-side .page-content-innerwrap'),
        content = $('.flame-side .page-content-innerwrap').height(),
    // ヘッダーの高さ
        pcTopUp = $('.siteHeader').outerHeight();
    if ($('#page-lifesupport .page-header').outerHeight() != undefined) {
        pcTopUnder = $('.page-header').outerHeight() + 80;
    } else if($('.page-seminar-movie .page-header').outerHeight() != undefined) {
        pcTopUnder = $('.page-header').outerHeight() + $('.flame-body.first').outerHeight();
    } else {
        pcTopUnder = $('.page-header').outerHeight();
    }
    $('.header-announce').outerHeight() == undefined ? pcTopAnnounce = 0 : pcTopAnnounce = $('.header-announce').outerHeight();
    var pcTop = pcTopUp + pcTopUnder;
    var headerMiddleH = $('.header-middle').outerHeight() || 0;
    if ($(window).width() <= 768) {
        $('.page-wrapper').css('margin-top', pcTopUp + headerMiddleH);
    } else {
        $('.page-wrapper').css('margin-top', '');
    }


    // スクロール中のヘッダーの高さ
    var pcHeaderTop = $('.header-top').outerHeight();
    $('.header-bottom').outerHeight() == undefined ? pcHeaderBottom = 0 : pcHeaderBottom = $('.header-bottom').outerHeight();
    var pcTopScroll = pcHeaderTop + pcHeaderBottom + pcTopAnnounce;
    // フッターの位置
    $('.lifesupport-category').height() == undefined ? lifeSupportCat = 0 : lifeSupportCat = $('.lifesupport-category').outerHeight();
    if ($('.siteFooter').length || $('.footer_slide_wrapper').length) {
        $('.footer_slide_wrapper').offset() == undefined ? pcFooter = $('.siteFooter').offset().top : pcFooter = $('.footer_slide_wrapper').offset().top;
    } else {
        pcFooter = 0;
    }
    var scrollFooter = pcFooter - content - pcTopScroll - lifeSupportCat - 80,
    windowHeight = $(window).height(),
    // サイドメニューの幅
        flameSideWidth = $('.flame-side').outerWidth();
    if (window.matchMedia('(min-width:992px)').matches) {
        element.addClass('side-top');
        element.css('width', flameSideWidth);

        // FAQ
        var faq_sound_top = pcTopScroll - 50;
        var faq_sound_bottom = $('.siteFooter').offset().top - $('.search-faq').outerHeight() - faq_sound_top;
        var faq_sound = $('.faq-sound');

        $(window).scroll(function(){
            var scroll = $(window).scrollTop();
            if ( scroll < pcTop - pcTopScroll ) {
                // ヘッダー分だけスクロールした時
                element.addClass('side-top'),
                element.removeClass('side-fixed');
            } else if ( scroll > scrollFooter ) {
                // フッターまでスクロールした時
                element.addClass('side-bottom'),
                element.removeClass('side-top'),
                element.removeClass('side-fixed');
            } else {
                var scrollAmount = scroll - pcTop;
                element.addClass('side-fixed'),
                element.removeClass('side-top'),
                element.removeClass('side-bottom');
                $('.side-fixed').css('top', pcTopScroll);
            }

            // FAQ
            if ( scroll < faq_sound_top ) {
                faq_sound.removeClass('faq-sound__fixed');
                faq_sound.removeClass('faq-sound__bottom');
                faq_sound.css('transform', 'translateY(0px)');
            } else if ( scroll > faq_sound_bottom ) {
                faq_sound.removeClass('faq-sound__fixed');
                faq_sound.addClass('faq-sound__bottom');
            } else {
                faq_sound.removeClass('faq-sound__bottom');
                faq_sound.addClass('faq-sound__fixed');
                translate_faq = 'translateY('+(-faq_sound_top+pcTopAnnounce)+'px)';
                faq_sound.css('transform', translate_faq);
            }
        });
    } else {
        var forSpNav = $('.flame-side').clone();
        var forSpNav2 = forSpNav.removeClass('for-sp-nav').addClass('sp-page-top');
        $('.flame-side').after(forSpNav2);
    }
    // ページ内メニュー
    $(document).on('click','button.sp-nav-btn',function(){
        var	forSpNavHeight = windowHeight - pcTopUp;
        $('.flame-side.for-sp-nav').css('height', forSpNavHeight);
        $(this).parents('.for-sp-nav').addClass('opened');
    });
    $(document).on('click', '.sp-nav-close-btn', function(){
        $('.flame-side.for-sp-nav').css('height', 'auto');
        $(this).parent('.for-sp-nav').removeClass('opened');
    });
    if (window.matchMedia('(max-width:991px)').matches) {
        var spPageTopBtn = $('.sp-page-top .link-btn');
        // if (!spPageTopBtn.hasClass('pet-list')) {
            var classCount = spPageTopBtn.length;
            if (classCount < 5) {
                spPageTopBtn.attr('class', 'link-btn col-12');
            } else if (5 <= classCount && classCount < 9) {
                spPageTopBtn.attr('class', 'link-btn col-12 col-md-6');
            } else {
                spPageTopBtn.attr('class', 'link-btn col-6');
            }
        // }
    }
    // ページ内リンク
    // if (pcTopUp) {
    //     $('html').css('scroll-padding-top', pcTopUp);
    // }

    if (!$('a[href^="#"]').parent('li').hasClass('nav-item')) {
        $('a[href^="#"]').on('click', function() {
            if ($(this).parents('.for-sp-nav')) {
                $('.flame-side.for-sp-nav').css('height', 'auto');
                $('.for-sp-nav').removeClass('opened');
            }
            var speed = 150;
            var href = $(this).attr("href");
            var target = $(href == "#" || href == "" ? 'html' : href);
            var positionTarget = target.offset().top;
            var position = positionTarget - pcTopUp;

            // ビジネスページ アコーディオンを閉じた状態でページ内リンクをクリックした際に、アコーディオンを開く
            if ($('.page-template-page-business').length) {
                business_acor_menu = target.children('.acor-menu');
                business_acor_menu.next().slideDown();
                business_acor_menu.addClass("opened");
                business_acor_menu.next('.acor-menu-child').addClass('opened');
            }
            $('body,html').animate({scrollTop:position}, speed, 'swing');
            return false;
        });
    }                                                                             

    // FAQ
    $('.faq-sound__item').on('click', function(){
        if (!$(this).hasClass('off')) {
            var index = $(this).attr('id');
            $('.faq-sound__item').removeClass('active');
            $(this).addClass('active');
            if (index == 'index-all') {
                $('.index-parent').css('display','block');
            } else {
                $('.index-parent').css('display','none');
                if ($('.index-parent').hasClass(index)) {
                    $('.'+index).css('display','block');
                }
            }
        }
    });

    var rainoTop = pcTopAnnounce + pcTopUp;
    $('.device-pc .raino-faq__content').css('top', rainoTop + 20);
    $('.device-pc .raino-faq__search').css('top', rainoTop + 20);

    $('.device-mobile .raino-faq__content').css('top', rainoTop + 160);
    $('.device-mobile .raino-faq__search').css('top', rainoTop);

    var searchForm = $('.js-raino-faq__search');
    $('#js-raino-faq-open').on('click', function(){
        searchForm.addClass('active');
    });
    $('#js-raino-faq-close').on('click', function(){
        searchForm.removeClass('active');
    });

    var faq_breadcrumb_width = 0;
    $(".faq_breadcrumb_container .breadcrumb li").each(function(i, elem) {
        faq_breadcrumb_width = faq_breadcrumb_width + $(this).outerWidth() + 60;
    });
    $(".faq_breadcrumb_container .breadcrumb").width(faq_breadcrumb_width - 30);

    // 基幹システムとの連携
    function interactWithElearning(dataname){
        if(dataname == 'ws_file'){
            var url = '/cms/wp-content/themes/zenkosai/api/get_ws_file.php';
        }
        if(dataname == 'pb_exam'){
            var url = '/cms/wp-content/themes/zenkosai/api/get_pb_information.php';
        }
        if(dataname == 'seminar_search'){
            var url = '/cms/wp-content/themes/zenkosai/api/search_online_seminar.php';
        }
        if(dataname == 'seminar_apply'){
            var url = '/cms/wp-content/themes/zenkosai/api/apply_online_seminar.php';
        }
        $.ajax({
            url: url,
            type: 'get',
            async: false,
        })
        .done(function (data) {
            if(!data){
                return;
            }

            $('.loading-parent .loading-circle.loading').remove();
            const url = data;
            window.open(url, '_blank');

        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        });
    }

    // マイページ連携・フォーム情報を利用した連携
    function postMypageForm(formname, dataabout){
        var domain = 'https://test-mypage.zenko-sai.or.jp';
        // var domain = 'https://mypage.zenko-sai.or.jp';
        var seminar_domain = 'https://stg-seminar.zenko-sai.or.jp/auth/login_for_sso'; // テスト用
        // var seminar_domain = 'https://seminar.zenko-sai.or.jp/auth/login_for_sso'; // 本番用
        var life_seminar_domain = 'https://stg-life-seminar.zenko-sai.or.jp/life_auth/login_for_sso'; // テスト用
        // var life_seminar_domain = 'https://life-seminar.zenko-sai.or.jp/life_auth/login_for_sso'; // 本番用
        var suit_domain = 'https://stg.hosoisyoji-ordermade-suits.com/zenkosai_login_for_sso'; // テスト用
        // var suit_domain = 'https://hosoisyoji-ordermade-suits.com/zenkosai_login_for_sso'; // 本番用
        $('#'+formname).attr('target', '_self' );

        // PDFビューワーのポップアップブロック回避
        var path = location.pathname;

        // マイページ
        if(dataabout == 'mypage'){
            $.ajax({
                url: '/cms/wp-content/themes/zenkosai/api/reset_mypage_unreads.php',
                type: 'get',
                async: false
            })
            .done(function (data) {
                $('#'+formname).attr('action', domain);
            }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            });
        }
        // 組織図（前月）
        if(dataabout == 'membertreepre'){
            $('#'+formname).attr('action', domain+'/chart/');
            if (path.indexOf("redirect") <= 0) {
                $('#'+formname).attr('target', '_blank' );
            }
        }
        // 組織図（当月）
        if(dataabout == 'membertreecurrent'){
            $('#'+formname).attr('action', domain+'/chart/current-month/');
            if (path.indexOf("redirect") <= 0) {
                $('#'+formname).attr('target', '_blank' );
            }
        }
        // 新規会員紹介
        if(dataabout == 'intromember'){
            $('#'+formname).attr('action', domain+'/introduce/');
        }
        // 会員紹介管理
        if(dataabout == 'managemember'){
            $('#'+formname).attr('action', domain+'/management/');
        }
        // サービス受領者登録
        if(dataabout == 'registermember'){
            $('#'+formname).attr('action', domain+'/service/');
        }
        // コミッション明細
        if(dataabout == 'comission_meisai'){
            $('#'+formname).attr('action', domain+'/statement/');
        }
        // 支払調書
        if(dataabout == 'comission_tyousyo'){
            $('#'+formname).attr('action', domain+'/paymentrecord/' );
        }
        // 紹介者書類不備
        if(dataabout == 'fubi'){
            $('#'+formname).attr('action', domain+'/status-defect/' );
        }
        // 契約者情報
        if(dataabout == 'contractor_info'){
            $('#'+formname).attr('action', domain+'/contractor-info/' );
        }
        // サービス受領者情報
        if(dataabout == 'registermember_info'){
            $('#'+formname).attr('action', domain+'/service-info/');
        }
        // セミナー検索
        if(dataabout == 'seminer_search'){
            $('#'+formname).attr('action', domain+'/schedule_search/monthly/' );
        }
        // セミナー申請
        if(dataabout == 'seminer_apply'){
            $('#'+formname).attr('action', domain+'/schedule_request/' );
        }
        // セミナー申込状況
        if(dataabout == 'seminer_situation'){
            $('#'+formname).attr('action', domain+'/schedule_join/' );
        }
        // セミナー検索（新システム）
        if(dataabout == 'seminar'){
            remove_mypage_only();
            $('#'+formname+' input[name="redirect_to"]').attr('disabled', true);
            $('#'+formname).append('<input type="hidden" name="redirect_to" value="top"></input>');
            $('#'+formname).attr('action', seminar_domain );
            if (path.indexOf("redirect") <= 0) {
                $('#'+formname).attr('target', '_blank' );
            }
        }
        // セミナー申請（新システム）・セミナー申込状況（新システム）
        if(dataabout == 'seminar_edit' || dataabout == 'reservation' || dataabout == 'reserve_cnv' || dataabout == 'reserve_cnv_pv'){
            remove_mypage_only();
            
            var $form = $('#' + formname);
            $form.find('input[name="redirect_to"], input[name="redirect_from"]').remove();
            $form.attr('action', seminar_domain );

            if(dataabout == 'reservation'){
                $form.append('<input type="hidden" name="redirect_to" value="reservation">');
            } else {
                $form.append('<input type="hidden" name="redirect_from" value="'+dataabout+'">');
            }

            var isBlank = false;
            $('.target-blank-trigger').each(function() {
                var $el = $(this);
                if ($el.data('formabout') === dataabout) {
                    if ($el.hasClass('target-blank-trigger')) {
                        isBlank = true;
                    }
                }
            });

            if (isBlank) {
                $form.attr('target', '_blank');
            } else {
                $form.attr('target', '_self');
            }
        }
        // セミナー PBS講師紹介動画（新システム）
        if(dataabout == 'seminar_lecturer'){
            remove_mypage_only();
            $('#'+formname+' input[name="redirect_to"]').attr('disabled', true);
            $('#'+formname).append('<input type="hidden" name="redirect_to" value="business_lecturer"></input>');
            $('#'+formname).attr('action', seminar_domain );
            if (path.indexOf("redirect") <= 0) {
                $('#'+formname).attr('target', '_blank' );
            }
        }
        // コンプライアンス研修
        if(dataabout == 'complaiance_kensyu'){
            $('#'+formname).attr('action', domain+'/documents/download/file/compliance_training2019.pdf' );
        }
        // 会社関連サービス
        if(dataabout == 'company_service'){
            $('#'+formname).attr('action', domain+'/documents/download/file/compliance_caution2020.pdf' );
        }
        // ご利用手順（ウィナーズ）
        if(dataabout == 'winners_tejun'){
            $('#'+formname).attr('action', domain+'/documents/download/file/ws_manual.pdf' );
        }
        // ご利用手順（プライムビジネス）
        if(dataabout == 'business_tejun'){
            $('#'+formname).attr('action', domain+'/documents/download/file/pb_manual.pdf' );
        }
        // 試験問題集
        if(dataabout == 'business_exam'){
            $('#'+formname).attr('action', domain+'/documents/download/file/prime_question.pdf' );
        }
        // プライムビジネス参考資料
        if(dataabout == 'business_sankou'){
            $('#'+formname).attr('action', domain+'/documents/download/file/prime_document.pdf' );
        }
        // オンライン明細切替
        if(dataabout == 'online_kirikae'){
            $('#'+formname).attr('action', domain+'/changeover/' );
        }
        // 登録書類不備
        if(dataabout == 'mail_deficient'){
            $('#'+formname).attr('action', domain+'/identification/' );
        }
        // 全厚済コミュニティ ライフセミナー
        if(dataabout == 'life_seminar'){
            remove_mypage_only();
            $('#'+formname+' input[name="redirect_to"]').attr('disabled', true);
            $('#'+formname).append('<input type="hidden" name="redirect_to" value="seminar"></input>');
            $('#'+formname).attr('action', life_seminar_domain );
            if (path.indexOf("redirect") <= 0) {
                $('#'+formname).attr('target', '_blank' );
            }
        }
        // 会員種別変更申請書取寄せ
        if(dataabout == 'type_change_input'){
            $('#'+formname).attr('action', domain+'/type-change/input/' );
        }
        // オーダーメイドスーツ 予約フォーム
        if(dataabout == 'order_made_suit'){
            remove_mypage_only();
            $('#'+formname+' input[name="redirect_to"]').attr('disabled', true);
            const order_made_suit_submit = ['member_id', 'member_name', 'primary_name', 'member_type', 'member_status', 'tel', 'mail'];
            $('#'+formname+' input').each(function(i, elem) {
                if (order_made_suit_submit.includes($(elem).attr('name')) == false) {
                    elem.disabled = true;
                }
            });
            $('#'+formname).append('<input type="hidden" name="redirect_to" value="top"></input>');
            $('#'+formname).attr('action', suit_domain );
            if (path.indexOf("redirect") <= 0) {
                $('#'+formname).attr('target', '_blank' );
            }
        }
        $('#'+formname).submit();

        $('#'+formname+' input').each(function(i, elem) {
            $(elem).attr('disabled', false);
        });

        function remove_mypage_only() {
            var mypage_only_date = $('#mypage_only_date');
            if (mypage_only_date.length) {
                mypage_only_date.children('input').attr('disabled', true);
            }
        }
    }

    // PCで電話発信リンクを無効にする
    var ua = navigator.userAgent.toLowerCase();
    var isMobile = /iphone/.test(ua)||/android(.+)?mobile/.test(ua);

    if (!isMobile) {
        $('a[href^="tel:"]').on('click', function(e) {
            e.preventDefault();
        });
    }

    /*-------------------------------------------*/
    /*  カレンダー
    /*-------------------------------------------*/
    $(function () {
      if ( document.getElementById('page-new-business') ) {
        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth()+1;
        var day = today.getDate();
        fulltoday = year+'-'+month+'-'+day;
        eventdata = [];

        // 祝日取得
        calender_holidays = [];
        var url = '/cms/wp-content/themes/zenkosai/api/calender_holidays.php';
        $.ajaxSetup({async: false}); //同期通信(json取ってくるまで待つ)
        $.getJSON(url, function(data){
            calender_holidays = data;
        });
        $.ajaxSetup({async: true});

        showCalendar(year,month);
        atoday = pickADate(fulltoday);
        setEventDetail(atoday);
      }
    });

    // カレンダー
    const weeks = ['月', '火', '水', '木', '金', '土', '日'];
    const date = new Date();
    let year = date.getFullYear();
    let month = date.getMonth() + 1;
    const config = {
        show: 3,
    }

    // カレンダー設定
    function showCalendar(year, month) {
        const calendarHtml = createCalendar(year, month);
        const sec = document.createElement('section');
        sec.innerHTML = calendarHtml;
        document.querySelector('.calendar-show').appendChild(sec);
        get_calender_events(year,month);
    }

    // カレンダー作成
    function createCalendar(year, month) {
        const startDate = new Date(year, month - 1, 1) // 月の最初の日を取得
        const endDate = new Date(year, month,  0) // 月の最後の日を取得
        const endDayCount = endDate.getDate() // 月の末日
        const lastMonthEndDate = new Date(year, month - 1, 0) // 前月の最後の日の情報
        const lastMonthendDayCount = lastMonthEndDate.getDate() // 前月の末日
        let startDay = startDate.getDay()-1 // 月の最初の日の曜日を取得
        if(startDay == -1){
            startDay = 6; // 月の最初の日の曜日を取得
        }
        today = new Date();
        day = today.getDate(); //今日の曜日を取得
        let nowmonth = new Date(year, month-1, 1); //表示されている月
        thismonth = new Date(date.getFullYear(), date.getMonth(), 1);//今月判定
        thismonth_num = thismonth.getMonth() + 1;//今月の月の数字
        maxmonth = new Date(date.getFullYear(), date.getMonth()+2, 1);//3ヶ月後判定
        let dayCount = 1 // 日にちのカウント
        let c_prev = '<i id="c_prev" class="calendar-control fas fa-chevron-left cursor-pointer prev-mont d-flex align-items-center"></i>'; //前月へのボタン
        let c_year = '<p id="c_year" class="pl-5 pr-2 mb-0">'+year+'年</p><h5 id="c_month" class="bold my-1 pr-5">' + month + '月</h5>'; // 年月表示
        let c_next = '<i id="c_next" class="calendar-control fas fa-chevron-right cursor-pointer next-mont d-flex align-items-center"></i>'; //次月へのボタン

        let calendarHtml = '' // HTMLを組み立てる変数
        calendarHtml += '<div class="d-flex flex-row justify-content-center align-items-center">';
        if(nowmonth > thismonth) {
            calendarHtml += c_prev;
        }
        calendarHtml += c_year;
        if(nowmonth < maxmonth) {
            calendarHtml += c_next;
        }
        calendarHtml += '</div>';
        calendarHtml += '<table class="table-calendar text-center bg-white mx-auto mt-3 mb-0" data-year="'+year+'" data-month="'+month+'">';
        // 曜日の行を作成
        for (let i = 0; i < weeks.length; i++) {
            calendarHtml += '<td class="week'+i+'">' + weeks[i] + '</td>'
        }
        for (let w = 0; w < 6; w++) {
            calendarHtml += '<tr>'
            for (let d = 0; d < 7; d++) {
                if (w == 0 && d < startDay) {
                    // 1行目で1日の曜日の
                    let num = lastMonthendDayCount - startDay + d + 1
                    calendarHtml += '<td class="is-disabled">' + num + '</td>'
                } else if (dayCount > endDayCount) {
                    // 末尾の日数を超えた
                    let num = dayCount - endDayCount
                    calendarHtml += '<td class="is-disabled">' + num + '</td>'
                    dayCount++
                } else if (dayCount == day && thismonth_num == month) {
                    calendarHtml += '<td class="c-date-pick today" data-date="'+dayCount+'"><span>' + dayCount + '</span></td>'
                    dayCount++
                } else {
                    var dateInfo = checkDate(year, month, dayCount);
                    if(dateInfo) {
                        calendarHtml += '<td class="c-date-pick holiday" data-date="'+dayCount+'"><span>' + dayCount + '</span></td>'
                    } else {
                        calendarHtml += '<td class="c-date-pick" data-date="'+dayCount+'"><span>' + dayCount + '</span></td>'
                    }
                    dayCount++
                }
            }
            calendarHtml += '</tr>'
        }
        calendarHtml += '</table>'
        return calendarHtml
    }

    // 祝日かどうかをチェック
    function checkDate(year, month, day) {
        var month = ( '00' + month ).slice( -2 );
        var day = ( '00' + day ).slice( -2 );
        var checkDate = year + '-' + month + '-' + day;
        return calender_holidays[checkDate];
    }

    // イベント情報取得
    function get_calender_events(year,month){
        c_url = '/cms/wp-content/themes/zenkosai/api/get_calender.php';
        if(year.length !== 0){
            c_url = '/cms/wp-content/themes/zenkosai/api/get_calender.php/?anu='+year+'&mont='+month;
        }
        $.ajax({
            url: c_url,
            type: 'get',
            cache: false,
            dataType: 'json',
            data: null,
            async: false
        })
        .done(function (event) {
            setCalendarEvent(event);
            eventdata = event;
        }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(XMLHttpRequest);
            console.log(textStatus);
            console.log(errorThrown);
        });
    }

    // カレンダーにイベント付与
    function setCalendarEvent(data){
        $.each(data, function(index, value) {
            var eventdate =  value.post_date;
            eventdate = pickADate(eventdate);
            $('td.c-date-pick[data-date="'+eventdate+'"]').addClass('hasevent');
        });
    }

    // イベントの詳細を付与
    function setEventDetail(pickeddate){
        document.getElementById("detail-box").innerHTML = "";
        i = 0;
        p_year = $('#c_year').text();
        p_year = p_year.slice( 0, -1 );
        p_month = $('#c_month').text();
        p_month = p_month.slice( 0, -1 );
        p_fulldate = p_year+'-'+p_month+'-'+pickeddate;
        getday = new Date(p_fulldate);
        dayOfWeek = getday.getDay() ;
        dayOfWeekStr = [ "日", "月", "火", "水", "木", "金", "土" ][dayOfWeek];

        $.each(eventdata, function(index, value) {
          original_date = value.post_date;
          eventdate = pickADate(original_date);
          if(eventdate == pickeddate){

            // ターム一覧
            var terms = value.post_terms;
            if (terms) {
              terms_list = '';
              terms.forEach(function(term_date) {
                terms_list += '<div class="article-detail__category '+term_date.term.slug+' rounded-pill d-inline-block" style="background-color: '+term_date.bg_color+'"><span class="text-white font-smaller">'+term_date.term.name+'</span></div>';
              });
            }

            // スケジュール一覧
            item = '<article class="modal_trigger">';
            item += '<div class="article-content"><div class="article-detail"><div class="category-list mt-0">';
            if (terms) {
              item += terms_list;
            }
            item += '</div></div><div class="article-title border-bottom"><p class="mb-2">'+value.post_title+'</p></div></div>';

            item += '</article>';
            // スケジュール詳細（ポップアップ用）
            item += '<div class="modal_box">';

              item += '<div class="modal_bg"></div>';

              item += '<div class="modal_inner">';

                item += '<div class="modal_block">';

                  item += '<div class="event-content">';
                    item += '<div class="event-content__detail">';
                      item += '<div class="event-content__detail__header">';
                        item += '<div class="article-date font-weight-bold"><p class="mb-0">'+value.post_date+'</p></div>';
                        item += '<div class="article-title mt-3 px-2 py-1 font-weight-bold d-md-flex justify-content-md-between"><div class="category-list order-md-2 mb-2 mb-md-0">';
                        if (terms) {
                          item += terms_list;
                        }
                        item += '</div><p class="mb-0">'+value.post_title+'</p></div>';
                        item += '</div>';
                        item += '<div class="event-content__detail__body">'+value.post_content+'</div>';

                    item += '</div>'; // .event-content__detail
                  item += '</div>'; // .event-content


                item += '</div>'; // .modal_block

                item += '<div class="modal_close"><div class="rounded-pill">閉じる<span class="pl-3">×</span></div>';

              item += '</div>'; // .modal_inner

            item += '</div>'; // .modal_box

            $("#detail-box").append(item);
            i++;
          }
        });
        if(i == 0){
            item =
            "<div class=\"detail-box mt-2\">\n<div class=\"title-box d-flex flex-column mx-3 p-2\">\n<p class=\"\">\u4E88\u5B9A\u306F\u3042\u308A\u307E\u305B\u3093\u3002</p>\n</div>\n</div>";
            // `<div class="detail-box mt-2">
            //     <div class="title-box d-flex flex-column mx-3 p-2">
            //         <p class="">予定はありません。</p>
            //     </div>
            // </div>`;
            document.getElementById("detail-box").innerHTML = item;
        }
    }

    // 0を除いた日付を取得
    function pickADate(date){
        adate = date.slice(-2);
        var firstletter = adate.slice(0,1) ;
        if(firstletter == 0){
            var adate = adate.slice(-1);
        }
        return adate;
    }

    // イベント表示
    $(document).on('click','td.c-date-pick.hasevent,td.c-date-pick.today',function(){
        pickedyear = $('.table-calendar').data('year');
        pickedmonth = $('.table-calendar').data('month');
        pickeddate = $(this).data('date');
        var Weeks = [ "日", "月", "火", "水", "木", "金", "土" ];
        var dObj = new Date( pickedyear+'/'+pickedmonth+'/'+pickeddate );
        var wDay = dObj.getDay();

        setEventDetail(pickeddate);
        var setDay = pickedmonth+'<span>月</span>'+pickeddate+'<span>日</span><span>（'+Weeks[wDay]+'）</span>';
        var articleDate = document.getElementById('calender-date');
        articleDate.innerHTML = setDay;
    });

    // 月送り
    $(document).on('click','.prev-mont,.next-mont',function(){
        p_year = $('#c_year').text();
        p_year = p_year.slice( 0, -1 );
        p_month = $('#c_month').text();
        p_month = p_month.slice( 0, -1 );
        controll = $(this).attr("id");
        if (controll === 'c_prev') {
            p_month--
            if (p_month < 1) {
                p_year--
                p_month = 12
            }
        }
        if (controll === 'c_next') {
            p_month++
            if (p_month > 12) {
                p_year++
                p_month = 1
            }
        }
        $('.calendar-show').empty();
        showCalendar(p_year,p_month);
    });

    /*-------------------------------------------*/
    /*   ビジネスページ　スケジュール もっと見るボタン
    /*-------------------------------------------*/
      // 現在表示されている数
      var event_now_post = 3;

      // 一度に取得する数
      var get_post_num = 5;

      // 閉じるボタン
      $(document).on('click','.none_disp',function(){
        var noArticleBtn = $('.no-article');
        noArticleBtn.addClass('d-none');
        $('.add_event').remove();
        $('.more_disp').removeClass('d-none');
        $('.most_old_post').removeClass('most_old_post');
        event_now_post = 5;

        hashposi = $('#business-schedule').offset().top;
        hashposi = hashposi - 200;
        $('body,html').animate({scrollTop:hashposi}, 400, 'swing');
      });

      // もっと見るボタン 
      $('.more_disp').on('click', function() {
        var button = $(this);
        var data_postnum = $(this).children('button').data('postnum');
        button.css('pointer-events','none');

        button.prepend('<p id="loading-schedule" class="loading-parent" style="height: 1rem;"><span class="loading loading-circle"></span></p>');

        var now_post_num = 0;
        var ajax_url = '/cms/wp-content/themes/zenkosai/api/event-readmore.php';
        now_post_num = event_now_post;

        $.ajax({
          type: 'POST',
          url: ajax_url,
          data: {
              'now_post_num': now_post_num,
              'get_post_num': get_post_num,
          },
          dataType: 'html',
        })
        .done(function(data){
            now_post_num = now_post_num + get_post_num;

            event_now_post = now_post_num;
            $('#loading-schedule').remove();
            button.before(data);
            button.css('pointer-events','auto');

            if (data_postnum <= now_post_num) {
                button.addClass('d-none');
            }

            var noArticleBtn = $('.no-article');
            if(noArticleBtn.hasClass('d-none')) {
                noArticleBtn.removeClass('d-none');
            }

            if ($('.most_old_post').length) {
                $('.more_disp').addClass('d-none');
            }
        })
        .fail(function(){ // ajax通信成失敗の処理
          console.log('エラーが発生しました');
        })
        return false;
      });

    /*-------------------------------------------*/
    /*   ポップアップ
    /*-------------------------------------------*/
    // 利用開始日前にログインした場合、ポップアップを表示する
    const keyName_popup = "checked_popup";
    const keyValue_popup = true;
    
    if (document.getElementById('first-popup-wrap')) {
        const keyName_show_popup = 'show_popup';
        const keyValue_show_popup = true;
        // ログインした時
        if (!sessionStorage.getItem(keyName_show_popup)) {
            sessionStorage.setItem(keyName_show_popup, keyValue_show_popup);
            $('#first-popup-wrap').fadeIn();
        }
    }

    /*-------------------------------------------*/
    /*   ホーム お知らせ ポップアップ
    /*-------------------------------------------*/
    if (document.getElementById('first-modal_information')) {
        const keyName_show_popup = 'show_info_popup';
        const keyValue_show_popup = true;
        var home_info = $('#first-modal_information');
        // ログインした時
        if (!sessionStorage.getItem(keyName_show_popup)) {
            sessionStorage.setItem(keyName_show_popup, keyValue_show_popup);
            home_info.addClass('js-modal_box_new-active');
        } else {
            home_info.removeClass('js-modal_box_new-active');
        }
    }

    /*-------------------------------------------*/
    /*   ビジネス お知らせ ポップアップ
    /*-------------------------------------------*/
    if (document.getElementById('first-modal_business')) {
        const keyName_show_popup = 'show_businsess_info_popup';
        const keyValue_show_popup = true;
        var business_info = $('#first-modal_business');
        // ビジネスページを表示した時
        if (!sessionStorage.getItem(keyName_show_popup)) {
            sessionStorage.setItem(keyName_show_popup, keyValue_show_popup);
            business_info.addClass('js-modal_box_new-active');
        } else {
            business_info.removeClass('js-modal_box_new-active');
        }
    }

    /*-------------------------------------------*/
    /*   プラスα ボタン
    /*-------------------------------------------*/
    var status = '';

    $('.plusa-status').on('click', function() {
        var btn = $(this);
        btn.css('pointer-events','none');
        $('.plusa-status').removeClass('plusa-active');
        btn.addClass('plusa-active');
        var plusaList = document.getElementById('plusa-list');
        plusaList.innerHTML = '<p class="text-center">検索しています…</p>';

        status = btn.data('status');

        var plusa_url = '/cms/wp-content/themes/zenkosai/api/get_plusa.php';

        $.ajax({
            type: 'POST',
            url: plusa_url,
            data: {
                'status': status,
            },
            dataType: 'html',
        })
        .done(function(data){
            if (data) {
                plusaList.innerHTML = data;
            }
            btn.css('pointer-events','auto');
        })
        .fail(function(){ // ajax通信成失敗の処理
            plusaList.innerHTML = '<p class="text-center">通信に失敗しました。再度ページの読み込みを行ってください。</p>';
        })
        return false;
    });

    /*-------------------------------------------*/
    /*   全厚済とはページトップナビ
    /*-------------------------------------------*/
    $(function(){
        $('.about-pagetop-nav div ul li a').each(function(){
            var $href = $(this).attr('href');
            if(location.href.match($href)) {
            $(this).addClass('active');
            } else {
            $(this).removeClass('inactive');
            }
        });
    });

    /*-------------------------------------------*/
    /*  トップページ スライドショー
    /*-------------------------------------------*/
    // ページトップ スライドショー
    $(function () {
        $('.top-slide-div').slick({
            // lazyLoad: 'progressive',
            lazyLoad: 'ondemand',
            slidesToShow: 3,
            slidesToScroll: 1,
            centerMode: false,
            centerPadding: '0px',
            infinite: true,
            autoplay: true,
            autoplaySpeed: 3000,
            arrows: false,
            dots: true,
            dotsClass: 'top-slide-dots d-flex px-0',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        centerMode: true,
                        centerPadding: '60px',
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        centerMode: true,
                        slidesToShow: 1,
                        centerPadding: '30px',
                    }
                }
            ],
        });
        setTimeout(function(){
            var slide_main = $(".slide").slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                asNavFor: ".slide-navigation",
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 400,
            });
            var slide_sub = $(".slide-navigation").slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                arrows: false,
                autoplay: true,
                autoplaySpeed: 4000,
                speed: 400,
                asNavFor: ".slide",
                focusOnSelect: true,
                vertical: true,
                verticalSwiping: true,
            });
        },100);
    });


    /*-------------------------------------------*/
    /*  ペット保険 プレゼントお申し込みフォーム
    /*-------------------------------------------*/
    if ($('#page-form_pet').length) {

        // 選択プランによって商品の候補を変える
        var contract_plan_first = $('#contract_plan').val();
        var desired_product_first = $('#desired_product').val();
        if (contract_plan_first == 'perl') {
            $('.plus_a').removeClass('d-block');
            $('.plus_a').addClass('d-none');
        } else if (contract_plan_first == 'gold' || contract_plan_first == 'platina') {
            $('.plus_a').removeClass('d-none');
            $('.plus_a').addClass('d-block');
            contractPlan(contract_plan_first, desired_product_first);
        }

        $('#contract_plan').change(function() {
            var contract_plan = $(this).val();
            var value = '';
            
            if (contract_plan == 'perl') {
                $('.plus_a').removeClass('d-block');
                $('.plus_a').addClass('d-none');
                $('#desired_product').val('');
            } else {
                $('.plus_a').removeClass('d-none');
                $('.plus_a').addClass('d-block');
                contractPlan(contract_plan, value);
            }
        });

        if (('.mw_wp_form_confirm').length) {
            var desired_product = $('input[name="desired_product"]').val();
            if (desired_product) {
                $('.plus_a').removeClass('d-none');
                $('.plus_a').addClass('d-block');
            }
        }

        function contractPlan(contract_plan, value) {
            $('#desired_product').children('option').each(function(index, element) {
                var elementValue = $(element).attr('value');
                if (!elementValue) {
                    $(this).prop('selected', true);
                    $(element).attr('disabled', true);
                } else if (elementValue.indexOf(contract_plan) >= 0) {
                    $(this).prop('selected', false);
                    $(element).addClass('d-block');
                    $(element).removeClass('d-none');
                    $(element).attr('disabled', false);
                } else {
                    $(this).prop('selected', false);
                    $(element).addClass('d-none');
                    $(element).removeClass('d-block');
                    $(element).attr('disabled', true);
                }
            });
            if (contract_plan != 'perl' && value) {
                $('#desired_product').val(value);
            }
        }

        // 電話番号を半角数字かつハイフンなしにする
        var telInput = document.getElementById('contact_address');
        if(telInput) {
            telInput.addEventListener('blur', () => {
                var telInputValue = telInput.value;
                telInputValue = hankaku2Zenkaku(telInputValue);
                telInputValue = telInputValue.replace(/[-－﹣−‐⁃‑‒–—﹘―⎯⏤ーｰ─━]/g, ''); //ハイフンを削除
                telInput.value = telInputValue;
            }, false);
        }

        // 証券番号を半角にする
        var policyNumber = document.getElementById('policy_number');
        if(policyNumber) {
            policyNumber.addEventListener('blur', () => {
                var policyNumberValue = policyNumber.value;
                policyNumberValue = hankaku2Zenkaku(policyNumberValue);
                policyNumber.value = policyNumberValue;
            }, false);
        }

        // 全角数字を半角数字に変換
        function hankaku2Zenkaku(str) {
            return str.replace(/[０-９]/g, function(s) {
                return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
            });
        }
    }

    /*-------------------------------------------*/
    /*  サービス利用申請フォーム
    /*-------------------------------------------*/
    if ($('.page-form_service').length) {
        // 読み取りのみに設定
        $('.readonly').attr('readonly',true);

        // 申請日を入力する
        var now = new Date();
        var y = now.getFullYear();
        var m = now.getMonth() + 1;
        var d = now.getDate();
        var w = now.getDay();
        var now_date = y + '年' + m + '月' + d + '日';
        $('.js-application_date').val(now_date);

        // 誕生日から年齢を計算
        var childBirth = $('.js-child_birth');
        childBirth.on('input change blur', () => {
            var birthyear = $('#child_birth_year').val();
            var birthmonth = $('#child_birth_month').val();
            var birthdate = $('#child_birth_date').val();
            if (birthyear && birthmonth && birthdate) {
                var age = getAge(birthyear, birthmonth, birthdate);
                $('.js-child_age').val(age);
            }
        });

        function getAge(year, month, day) {
            const today = new Date(); // 今日の日付データを取得
            const birthdate = new Date(year, month - 1, day); // 生年月日の日付データを取得
            const currentYearBirthday = new Date(today.getFullYear(), birthdate.getMonth(), birthdate.getDate()); // 今年の誕生日の日付データを取得
            let age = today.getFullYear() - birthdate.getFullYear(); // 生まれた年と今年の差を計算
            if (today < currentYearBirthday) { // 今日の日付と今年の誕生日を比較
                age--; // 今年誕生日を迎えていない場合、1を引く
            }
            return age;
        }

        // childBirth.on('click', function() {
        //     $('.js-child_birth option:first-child').attr('disabled', true);  
        // });


        // $('.js-child_birth option:first-child').attr('hidden', true);
    }

    /*-------------------------------------------*/
    /*  あうるアンケート
    /*-------------------------------------------*/
    const yesContent = $('.yes-content');
    const textarea = $('textarea[name="book_viewing_use"]');
    const textareaContainer = $('.textarea-others');

    function toggleYesContent() {
        const bookViewingValue = $('input[name="book_viewing"]:checked').val();
        const participateValues = $('input[type="checkbox"][name="participate[data][]"]:checked')
        .map(function () { return $(this).val(); })
        .get();

        if (bookViewingValue === 'はい') {
        yesContent.slideDown();

        if (participateValues.includes('その他')) {
            textareaContainer.slideDown();
            textarea.prop('required', true);
        } else {
            textareaContainer.slideUp();
            textarea.prop('required', false);
        }
        } else {
        yesContent.slideUp();
        textareaContainer.slideUp();
        textarea.prop('required', false);
        }
    }

    // 入力画面用
    if ($('input[name="book_viewing"]').length) {
        toggleYesContent();
        $(document).on('change', 'input[name="book_viewing"], input[name="participate[data][]"]', toggleYesContent);
    }

    // 確認画面用（text() が空にならないように wrapper を拾う）
    function toggleConfirmView() {
        const bookViewing = $('input[name="book_viewing"]').val();
        const participateText = $('.participate-text').text().trim();

        if (bookViewing === 'はい') {
        $('.yes-content').show();

        if (participateText.includes('その他')) {
            $('.textarea-others').show();
        }
        }
    }

    // 実行タイミング調整（確認画面用）
    if ($('.mwform-confirm-field').length || $('.book-viewing-val').length) {
        setTimeout(toggleConfirmView, 100);
    }

    /*-------------------------------------------*/
    /*  各種変更手続き
    /*-------------------------------------------*/
    $('.js-document_popup_btn').on('click', function() {
        $('body').addClass('overflow-hidden');
        $('.js-doc_modal').addClass('d-none').removeClass('d-block');
        type = '#' + $(this).children('button').data('type');
        $(type).addClass('d-block').removeClass('d-none');
        $('.js-procedure_popup').addClass('js-procedure_popup-active');
        if (window.matchMedia('(min-width:768px)').matches) {
            $('.js-procedure_popup').fadeIn();
        }
    });
    $('.js-procedure_popup__bg, .js-procedure_popup__close').on('click', function() {
        $('body').removeClass('overflow-hidden');
        $('.js-procedure_popup').removeClass('js-procedure_popup-active');
        if (window.matchMedia('(min-width:768px)').matches) {
            $('.js-procedure_popup').fadeOut();
        }
    });

    /*-------------------------------------------*/
    /*  サービス利用申請注意書き
    /*-------------------------------------------*/
    $(document).ready(function() {
        const link = $('a.service-form-link');
        if (link.length === 0) return;
    
        // li をクリックしたときの処理
        $('li.attention-check').on('click', function(event) {
            // input または label がクリックされた場合は li の処理をスキップ
            if ($(event.target).is('input[type="checkbox"], label')) {
                return;
            }
    
            // li のクリックでチェックをトグルする
            const checkbox = $(this).find('input[type="checkbox"]');
            checkbox.prop('checked', !checkbox.prop('checked')).trigger('change');
        });
    
        // label のクリック時に li のクリックイベントを発火させない
        $('label.s_check-label').on('click', function(event) {
            event.stopPropagation();
        });
    
        // チェックボックスの状態に応じてボタンのスタイルを更新
        function validateCheckboxes() {
            const checkboxes = $('input.service-check-ok');
            return checkboxes.length > 0 && checkboxes.toArray().every(checkbox => checkbox.checked);
        }
    
        function updateLinkStyle() {
            if (validateCheckboxes()) {
                link.css({
                    'background-color': '#285024',
                    'pointer-events': 'auto',
                    'cursor': 'pointer'
                });
                removeErrorMessage();
            } else {
                link.css({
                    'background-color': 'rgb(171 171 171)',
                    'pointer-events': 'auto',
                    'cursor': 'default'
                });
                displayErrorMessage();
            }
        }
    
        function displayErrorMessage() {
            const ul = $('ul.s_check-list');
            if ($('.s_form_error').length === 0 && ul.length > 0) {
                const errorMessage = $('<p>', {
                    class: 's_form_error',
                    text: '以下の全てのチェックボックスにチェックを入れてください。',
                    css: { color: 'red', 'font-weight': 'bold' }
                });
                ul.before(errorMessage);
            }
        }
    
        function removeErrorMessage() {
            $('.s_form_error').remove();
        }
    
        // チェックボックスをクリックしたときの処理（手動変更も考慮）
        $('input.service-check-ok').on('change', function() {
            updateLinkStyle();
        });
    
        // 送信時に未チェックならエラーを表示
        link.on('click', function(event) {
            if (!validateCheckboxes()) {
                event.preventDefault();
            }
        });
    
        updateLinkStyle();
    });  

    $(document).off('click', '.js-document_popup_btn').on('click', '.js-document_popup_btn', function(e) {
        e.preventDefault();
        
        var targetId = $(this).find('button').data('type');
        var $targetModal = $('#' + targetId);
        
        // 同じIDが複数あった場合の対策：最初に見つかった1つだけを操作
        if ($targetModal.length > 1) {
            $targetModal = $targetModal.first();
        }

        var $parentWrapper = $targetModal.closest('.js-procedure_popup');

        // 他のポップアップをすべて即座にリセット（真っ暗防止）
        $('.js-procedure_popup').stop(true, true).hide().removeClass('js-procedure_popup-active');
        $('.js-doc_modal').addClass('d-none').removeClass('d-block');
        
        // 表示
        $('body').addClass('overflow-hidden');
        $targetModal.addClass('d-block').removeClass('d-none');
        $parentWrapper.addClass('js-procedure_popup-active').stop(true, true).fadeIn(300);

        // 同意チェックが必要な場合、そのポップアップ内のボタンだけをロック
        if ($targetModal.hasClass('has-consent-check')) {
            var $link = $targetModal.find('.gtm-click-link');
            $link.css({
                'pointer-events': 'none',
                'opacity': '0.3',
                'cursor': 'not-allowed'
            });
            // チェックボックスを初期化（未チェック）
            $targetModal.find('.js-popup-agree-check').prop('checked', false);
        }
    });

    // --- 2. ポップアップを閉じる ---
    $(document).off('click', '.js-procedure_popup__bg, .js-procedure_popup__close').on('click', '.js-procedure_popup__bg, .js-procedure_popup__close', function() {
        var $parentWrapper = $(this).closest('.js-procedure_popup');
        $('body').removeClass('overflow-hidden');
        $parentWrapper.stop(true, true).fadeOut(300, function() {
            $(this).removeClass('js-procedure_popup-active');
        });
    });

    // --- 3. チェックボックス連動 ---
    $(document).on('change', '.js-popup-agree-check', function() {
        // 「今チェックされたボックス」が属する特定のモーダルを特定
        var $currentModal = $(this).closest('.js-doc_modal');
        var isChecked = $(this).is(':checked');
        var $link = $currentModal.find('.gtm-click-link');

        if (isChecked) {
            $link.css({ 'pointer-events': 'auto', 'opacity': '1', 'cursor': 'pointer' });
        } else {
            $link.css({ 'pointer-events': 'none', 'opacity': '0.3', 'cursor': 'not-allowed' });
        }
    });
});
