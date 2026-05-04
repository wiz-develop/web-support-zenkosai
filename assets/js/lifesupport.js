jQuery(function ($) {
    if (window.location.pathname === "/lifesupport/") {
      // アンカーがある場合 → アコーディオンを先に開く
      const hash = window.location.hash;
      if (hash) {
        const target = $(hash); // 例：#service-a
        if (target.length && $('#archive-lifesupport.sp').length) {
          const lifesupport_acor_menu = target.parent('.acor-menu');
          lifesupport_acor_menu.addClass("opened");
          lifesupport_acor_menu.next('.acor-menu-child').addClass('opened').css('display', 'block');
          // scrollIntoViewは不要。ブラウザがアンカーでスクロール済み
        }
      }
  
      // 詳細ページ遷移前にクリック時のアンカーを保存（戻る時用）
      $('a[href^="/lifesupport/#"]').on('click', function () {
        const href = $(this).attr('href');
        const hash = href.split('#')[1];
        if (hash) {
          localStorage.setItem('lifesupport_anchor', hash);
        }
      });
    }
  });  