<?php
/*
 * Template Name:各種変更手続き
 */

get_header(); ?>
<style>
    html, body { scroll-behavior: auto !important; }
</style>
<div id="page-procedure" class="page-wrapper procedure-<?php echo CFS() -> get('procedure_class'); ?> <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <h1 class="mb-0"><?php the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    
    <div class="page-content-wrapper columns">
        <div class="container">
            <div class="page-content-innerwrap w-100">
                <?php if(is_page('procedure')) : ?>
                <div class="page-content-div">
                    <div class="page-procedure_header">
                        <h2><span class="procedure_title_layout"><?php echo CFS() -> get('top_content_tit'); ?></span></h2>
                        <div class="procedure_note">
                            <?php echo CFS() -> get('top_content_about'); ?>
                        </div>
                        <?php get_template_part('templates/procedure-nav'); ?>
                    </div>   
                </div>
                <?php endif; ?>
                <?php if(!is_page('procedure')) : ?>
                <div class="page-content-div">
                    <div class="page-procedure_header">
                        <h2><span class="procedure_title_layout"><?php echo CFS() -> get('other_content_page_tit'); ?></span></h2>
                        <div class="procedure_note">
                            <?php echo CFS() -> get('change_about'); ?>
                        </div>
                        <div class="procedure_step_list">
                            <?php
                                $fields = CFS() -> get('procedure_step_list');
                                foreach ($fields as $field) :
                            ?>
                            <div class="step_content">
                                <h3>
                                    <span class="d-block">STEP<?php echo $field['step_number']; ?></span>
                                    <?php echo $field['step_tit']; ?>
                                </h3>
                                <div class="step_content__about">
                                    <?php echo $field['step_about']; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if(is_page('membership')) : ?>
                            <!-- <div class="form-link <?php echo $login; ?>">
                                <a href="/" target="_blank" class="mypage_form" data-formid="submitMypage" data-formabout="type_change_input">
                                    <button>
                                        <p class="mb-0">会員種別変更申請書の<br> お取り寄せはこちらから</p>
                                    </button>
                                </a>
                            </div> -->
                            <?php
                                $before_login_comment = CFS() -> get('before_login_comment');
                                if ($before_login_comment) :
                            ?>
                            <div class="before_login_comment <?php echo $login; ?>">
                                <p class="mb-0"><?php echo CFS() -> get('before_login_comment'); ?></p>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php 
                            $change_note = CFS()->get('change_note');
                            if($change_note):
                        ?>
                        <div class="procedure_note form-note px-4 py-2 <?php echo $login; ?>">
                            <?php echo $change_note; ?>
                        </div>
                        <?php endif; ?>
                        <div class="deadline">
                            <?php
                                if (CFS() -> get('deadline_title')) {
                                    echo '<h3>'.CFS() -> get('deadline_title').'</h3>';
                                }
                            ?>
                            <div class="deadline_about">
                                <?php echo CFS() -> get('deadline'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="page-procedure_body">
                        <div class="page-procedure_body__link-content">
                            <h3><span class="procedure_title_layout">変更手続きの詳細</span></h3>
                            <div class="link-list">
                                <?php
                                    $fields = CFS() -> get('attention_list');
                                    foreach ($fields as $field) :
                                ?>
                                <?php if($field['attention_name']):?>
                                <div class="link-item">
                                    <a href="#<?php echo $field['attention_link']; ?>">
                                        <button><?php echo $field['attention_name']; ?></button>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="page-procedure_body__attention">
                            <?php
                                $fields = CFS() -> get('attention_list');
                                foreach ($fields as $field) :
                            ?>
                                <div id="<?php echo $field['attention_link']; ?>" class="attention_content">
                                    <?php if($field['attention_name']):?>
                                    <h4><?php echo $field['attention_name']; ?></h4>
                                    <?php endif; ?>
                                    <div class="attention_content__about">
                                        <?php
                                            $subfields = $field['item_list'];
                                            foreach ($subfields as $subfield):
                                        ?>
                                        <div class="attention_content__about__item">
                                            <?php if(is_page('contract')) : ?>
                                                <?php if($subfield['service_about']):?>
                                                    <div class="attention_content__about__item_txt"><?php echo $subfield['service_about']; ?></div>
                                                <?php endif; ?>
                                                <?php if($subfield['target_about']):?>
                                                    <h5><?php echo $subfield['target_about']; ?></h5>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <p class="item-tit mb-0"><?php echo $subfield['item_tit']; ?></p>
                                            <div class="attention_content__about__item__detail">
                                                <?php echo $subfield['item_detail']; ?>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="attention_content_note">
                                        <?php echo $field['item_note']; ?>
                                    </div>
                                    <?php if($field['attention_tit']):?>
                                    <div class="attention_content__about caution">
                                        <div class="attention_content__about__item">
                                            <p class="item-tit mb-0"><?php echo $field['attention_tit']; ?></p>
                                            <div class="attention_content__about__item__detail">
                                                <?php echo $field['attention_about']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="document_content mt-3">
                                        
                                        <div class="document_list">
                                            <?php
                                                $document_tit = $field['document_tit'];
                                                if ($document_tit) :
                                            ?>
                                                <p class="item-tit mb-0"><?php echo $document_tit; ?></p>
                                            <?php endif; ?>
                                            <?php
                                                $grandchild_fields = $field['document_list'];
                                                if ($grandchild_fields) :
                                            ?>
                                                <ul class="pl-0" style="list-style: none">
                                                <?php
                                                    foreach ($grandchild_fields as $grandchild_field):
                                                        $document_popup = array_keys($grandchild_field['document_popup']);
                                                ?>
                                                    <li>
                                                        <div class="js-document_popup_btn document_popup_btn">
                                                            <button class="d-flex align-items-center justify-content-between" data-type="doc-<?php echo $document_popup[0]; ?>">
                                                                <span class="d-block"><?php echo $grandchild_field['document_popup_tit']; ?></span>
                                                                <i class="fa-solid fa-arrow-right"></i>
                                                            </button>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if(!is_page('procedure')) : ?>
            <?php get_template_part('templates/procedure-nav'); ?>
        <?php endif; ?>
        <!-- ここからポップアップの内容 start -->
        <?php
            $close_btn = '
                <div class="js-procedure_popup__close procedure_popup__close">
                    <div class="rounded-pill">
                        <span class="pr-3">×</span>閉じる
                    </div>
                </div>';
        ?>
            <!-- 会員変更手続き -->
            <?php if(is_page('membership')) : ?>
            <div class="js-procedure_popup procedure_popup">
                <div class="js-procedure_popup__bg procedure_popup__bg"></div>
                <!-- <div class="d-none d-md-block"><?php echo $close_btn; ?></div> -->
                <!-- 本人保管用契約書面 -->
                <div id="doc-keiyaku" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('contract_document_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('contract_document_txt'); ?>
                        </div>
                    </div>
                </div>
                    <!-- 本人確認書類 -->
                <div id="doc-kakunin" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('identity_verification_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('identity_verification_txt'); ?>
                        </div>
                        <?php if($field['attention_name']):?>
                        <div class="document_detail__note">
                            <?php
                                $fields = CFS() -> get('identity_verification_ex_list');
                                foreach ($fields as $field) :
                            ?>
                            <div class="document_detail__note__content">
                                <div class="content_tit">
                                    <p class="mb-0"><?php echo $field['identity_verification_ex_tit']; ?></p>
                                </div>
                                <div class="content_about"><?php echo $field['identity_verification_ex']; ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- スターターキット -->
                <div id="doc-starter" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('starter_kit_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('starter_kit_txt'); ?>
                        </div>
                        <div class="starter_content">
                            <div class="row">
                                <?php
                                    $fields = CFS() -> get('membership_type_list');
                                    foreach ($fields as $field) :
                                ?>
                                <div class="starter_item col-12 col-md-6">
                                    <div class="starter_item__tit">
                                        <p class="mb-0"><?php echo $field['membership_type']; ?></p>
                                    </div>
                                    <div class="starter_item__about">
                                    <?php
                                        $subfields = $field['document_list'];
                                        foreach ($subfields as $subfield):
                                    ?>
                                        <div class="starter_item__about__content row align-items-center justify-content-between">
                                            <div class="item_tit col-9">
                                                <p class="mb-0"><?php echo $subfield['document_name']; ?></p>
                                            </div>
                                            <div class="item_txt col-3">
                                                <p class="mb-0"><?php echo $subfield['document_copies']; ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- 契約者変更 -->
            <?php if(is_page('contract')) : ?>
            <div class="js-procedure_popup procedure_popup">
                <div class="js-procedure_popup__bg procedure_popup__bg"></div>
                <div class="d-none d-md-block"><?php echo $close_btn; ?></div>
                <!-- 本人保管用契約書面 -->
                <div id="doc-keiyaku" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('contract_contract_document_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('contract_contract_document_txt'); ?>
                        </div>
                    </div>
                </div>
                    <!-- 本人確認書類 -->
                <div id="doc-kakunin" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('contract_identity_verification_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('contract_identity_verification_txt'); ?>
                        </div>
                        <?php
                            $ex_lists = CFS() -> get('contract_identity_verification_ex_list');
                            if($ex_lists):
                        ?>
                        <div class="document_detail__note">
                            <?php
                                foreach ($ex_lists as $ex_list) :
                            ?>
                            <div class="document_detail__note__content">
                                <div class="content_tit">
                                    <p class="mb-0"><?php echo $ex_list['contract_identity_verification_ex_tit']; ?></p>
                                </div>
                                <div class="content_about"><?php echo $ex_list['contract_identity_verification_ex']; ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- 変更料 -->
                <div id="doc-henkou" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('change_fee_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('change_fee_txt'); ?>
                        </div>
                    </div>
                </div>
                <!-- 続柄の証明書類 -->
                <div id="doc-zokugara" class="js-doc_modal document d-none">
                    <div class="document_popup_tit">
                        <div class="d-flex justify-content-between">
                            <p class="mb-0"><?php echo CFS() -> get('relationship_tit'); ?></p>
                            <div><?php echo $close_btn; ?></div>
                        </div>
                    </div>
                    <div class="document_detail">
                        <div class="document_detail__txt">
                            <?php echo CFS() -> get('relationship_txt'); ?>
                        </div>
                        <div class="document_detail__note">
                            <?php
                                $fields = CFS() -> get('relationship_dc_list');
                                foreach ($fields as $field) :
                            ?>
                            <div class="document_detail__note__content">
                                <div class="content_tit">
                                    <p class="mb-0"><?php echo $field['relationship_dc_tit']; ?></p>
                                </div>
                                <div class="content_about"><?php echo $field['relationship_dc_txt']; ?></div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <!-- ここまでポップアップの内容 end -->
    </div>
</div>
<link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

<?php get_footer(); ?>
<script>
(function() {
  // ===== 設定（余白）：数字が大きいほど“手前で止まる”、小さく/マイナスで“下へ” =====
  const EXTRA_GAP = { pc: 30, ipad: 120, sp: 70 }; // まずはここから微調整
  const PROC_PREFIX = "/procedure"; // /procedure/配下なら全部対象

  // iPad判定
  function isIpadUA() {
    const ua = navigator.userAgent;
    return /iPad/.test(ua) || (ua.includes("Macintosh") && "ontouchend" in document);
  }
  function gapByDevice() {
    if (window.innerWidth > 999) return EXTRA_GAP.pc;
    if (isIpadUA())              return EXTRA_GAP.ipad;
    return EXTRA_GAP.sp;
  }
  function inProcedureSection(pathname) {
    return pathname.replace(/\/+$/, "").startsWith(PROC_PREFIX);
  }

  // 実際にスクロールしている要素を検出（html/body 以外でも対応）
  function getScrollContainer() {
    const cands = [
      document.querySelector('.l-main'),
      document.querySelector('.content'),
      document.querySelector('.page-wrapper'),
      document.scrollingElement || document.documentElement
    ];
    for (const el of cands) {
      if (!el) continue;
      const before = el.scrollTop;
      el.scrollTop = before + 1;
      if (el.scrollTop !== before) { el.scrollTop = before; return el; }
    }
    return document.scrollingElement || document.documentElement;
  }

  // 固定ヘッダー高さ（.siteHeader が前提：sticky/fixedどちらでもOK）
  function getHeaderHeight() {
    const el = document.querySelector('.siteHeader');
    return el ? el.getBoundingClientRect().height : 0;
  }

  // 目的位置を算出（スクロール要素基準）
  function calcScrollTop(targetEl, scroller) {
    const header = getHeaderHeight();
    const gap = gapByDevice();
    const scTopRect = (scroller === document.scrollingElement || scroller === document.documentElement || scroller === document.body)
      ? 0
      : scroller.getBoundingClientRect().top;

    const y = (targetEl.getBoundingClientRect().top - scTopRect) + scroller.scrollTop - (header + gap);
    return Math.max(0, Math.floor(y));
  }

  // 強制スクロール（他の上書きに勝つために複数回実行）
  function forceScrollTo(scroller, y) {
    const run = () => {
      // jQuery が無くても動くよう保険
      if (window.jQuery) {
        window.jQuery(scroller).stop(true, false).animate({ scrollTop: y }, 200, 'swing');
      } else {
        scroller.scrollTo({ top: y, behavior: 'auto' });
      }
    };
    // 3回に分けて実行（レイアウト確定や他JSの上書きを踏み越える）
    requestAnimationFrame(run);
    setTimeout(run, 120);
    setTimeout(run, 300);
  }

  function scrollToHash(hash) {
    if (!hash) return;
    const targetEl = document.querySelector(hash);
    if (!targetEl) return;
    const scroller = getScrollContainer();
    const y = calcScrollTop(targetEl, scroller);
    forceScrollTo(scroller, y);
  }

  // --- ① クリックをキャプチャ段階でフック：最優先で介入 ---
  document.addEventListener('click', function(e) {
    const a = e.target.closest('a[href*="#"]');
    if (!a) return;

    const currentPath = location.pathname;
    if (!inProcedureSection(currentPath)) return; // /procedure配下じゃなければ無視

    const url = new URL(a.getAttribute('href'), location.href);
    if (!url.hash) return;

    const samePage = url.pathname.replace(/\/+$/, "") === currentPath.replace(/\/+$/, "");
    const hasTarget = !!document.querySelector(url.hash);

    if (!samePage || !hasTarget) return;

    // ここで止める（他のスクリプトより先に！）
    e.preventDefault();
    e.stopImmediatePropagation();

    history.replaceState(null, '', url.hash);
    // レイアウト確定を待ちつつ強制補正
    requestAnimationFrame(() => scrollToHash(url.hash));
    setTimeout(() => scrollToHash(url.hash), 200);
  }, { capture: true });

  // --- ② 初期表示（直URLで #hash） ---
  function correctOnLoad() {
    if (!inProcedureSection(location.pathname)) return;
    if (!location.hash) return;
    scrollToHash(location.hash);
  }
  requestAnimationFrame(correctOnLoad);
  setTimeout(correctOnLoad, 200);

  // --- ③ hashchange（他JSがハッシュだけ変えた場合も捕捉） ---
  window.addEventListener('hashchange', function() {
    if (!inProcedureSection(location.pathname)) return;
    scrollToHash(location.hash);
  });

})();
</script>
