<div class="business-nav row">
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#member-info">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>会員情報</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#business-schedule">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>スケジュール</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#member">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>現在の会員口数</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php if (!$_SESSION['member_info']['pb_flag']) : // PB試験を受験していない方のみ表示 ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#pb-exam-take">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>PB試験関連</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php endif; ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#original-chart">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>組織図</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#commission">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>コミッション関連</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php
        if ( CFS()->get('business_campain_loop_new')) :
            $tab_info_title = CFS()->get('tab_info_title');
            $tab_info_acor = CFS()->get('tab_info_acor');
    ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#business-movie">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>
                        <?php
                            if ($tab_info_title) {
                                echo $tab_info_title;
                            } else {
                                echo 'お知らせ';
                            }
                        ?>
                    </span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php endif; ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#seminar">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>セミナー関連</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#introduce">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>新規会員紹介</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#support">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>ビジネスサポート<br>(販促品・名刺等)</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#compliance">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center text-left">
                    <span>コンプライアンス<br>関連資料</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#new-explanation">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>新規説明資料関連</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php if($_SESSION['member_info']['nextlv_num'] >= 2 || $_SESSION['member_info']['sub_title'] >= 2 || $_SESSION['member_info']['member_id'] == '000000000000'): ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#ws">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>WS関連資料</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php endif; ?>
    <?php if ($_SESSION['member_info']['pb_flag']) :  // PB試験受験済みの方のみ表示 ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#pb-exam">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center">
                    <span>PB試験関連</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php endif; ?>
    <?php
        $business_free_loop_new = CFS()->get('business_free_loop_new');
        if($business_free_loop_new) :
            foreach ( $business_free_loop_new as $b ) :
                $free_acor = $b['free_acor'];
                $business_free_title_new = $b['business_free_title_new'];
    ?>
    <div class="business-nav__item m-1 p-1 d-flex justify-content-between align-items-center">
        <a class="w-100" href="#<?php echo $b['business_free_link_new'];?>">
            <button class="w-100">
                <p class="mb-0 d-flex justify-content-between align-items-center d-flex justify-content-between align-items-center">
                    <span><?php echo $business_free_title_new;?></span>
                    <i class="fa-solid fa-chevron-down"></i>
                </p>
            </button>
        </a>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>