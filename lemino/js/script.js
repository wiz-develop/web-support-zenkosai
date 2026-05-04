jQuery(function($){
  // 入会ボタンエリアの日付表示
  function commonFooterInsertDate() {/* 今日から30日後を取得 */let lastDay = new Date(); lastDay.setDate(lastDay.getDate() + 30);/* 30日後の月と日を取得 */let month = 1 + lastDay.getMonth(); let day = lastDay.getDate();/* 日付を表示させる要素を取得してテキストを入れる */let targets = document.querySelectorAll('.js-common-footer-date'); for (let i = 0; i < targets.length; i++) { targets[i].innerHTML = month + "月" + day + "日"; } } commonFooterInsertDate();

  function lpFvInsertDate() {/* 今日から30日後を取得 */let lastDay = new Date(); lastDay.setDate(lastDay.getDate() + 30);/* 30日後の月と日を取得 */let month = 1 + lastDay.getMonth(); let day = lastDay.getDate();/* 日付を表示させる要素を取得してテキストを入れる */let targets = document.querySelectorAll('.js-lp-date'); for (let i = 0; i < targets.length; i++) { targets[i].innerHTML = month + "月" + day + "日"; } } lpFvInsertDate();

  // よくある質問アコーディオン
  $('.common_footer_wrapper .faq_answer').hide(); $('.common_footer_wrapper .faq_question').click(function () { $(this).toggleClass('is-active'); $(this).next().slideToggle(); });

  // 入会ボタンの追従
  function lpFixCta() { const fixArea = $('#js-lp-cta-fixed'); if ($(window).scrollTop() > 200) { fixArea.addClass('is-fixed'); $('#js-footer-area').css('padding-bottom', fixArea.height() + 10); } else { fixArea.removeClass('is-fixed'); $('#js-footer-area').css('padding-bottom', '0'); } } $(window).scroll(function () { lpFixCta(); }); $(function () { $('a[href^="#"]').click(function () { let headerHight = $('#header').height(); let speed = 500; let href = $(this).attr("href"); let target = $(href == "#" || href == "" ? 'html' : href); let position = target.offset().top - headerHight; $("html, body").animate({ scrollTop: position }, speed, "swing"); return false; }); });

  // スムーススクロール
  $(document).ready(function () {
    $('a[href^="#"]').on('click', function (e) {
      // href="#" みたいな「トップ」だけのリンクは除外したい場合はここで弾けます
      if (this.getAttribute('href') === '#') return;

      const target = this.hash;
      if (!target) return;

      const $target = $(target);
      if ($target.length === 0) return; // 対象が無いなら既存挙動を壊さない

      e.preventDefault();

      const headerOffset = $('header').outerHeight() || 0;
      const top = $target.offset().top - headerOffset;

      $('html, body').stop(true).animate(
        { scrollTop: top },
        500,
        'swing',
        function () {
          // hashジャンプを起こさずURLだけ更新
          if (history && history.replaceState) {
            history.replaceState(null, '', target);
          } else {
            // 古いブラウザ用フォールバック（ジャンプが起きる可能性は残る）
            window.location.hash = target;
          }
        }
      );
    });
  });

 

  // タイトルをクリックすると
  $(".js-accordion-title").on("click", function () {
    // クリックした次の要素(コンテンツ)を開閉
    $(this).next().slideToggle(300);
    // タイトルにopenクラスを付け外しして矢印の向きを変更
    $(this).toggleClass("open", 300);
  });

 
 
});