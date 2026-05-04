<?php
/*
 * Template Name: サービス利用体験　一覧
 */
session_start();
if(!$_SESSION['member_info']){
    wp_redirect(home_url('/'));
    exit;
}
get_header(); ?>

<?php
    session_start();
    $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
    $posts = search_experience($paged);
?>
<style>
html {
	scroll-behavior: smooth;
}
.service-experience .non-result {
	text-align:center;
}

</style>

<div id="page-experience" class="page-experience page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
                <img src="/cms/wp-content/uploads/2021/03/service-experience_top.jpg" class="pc-bnr">
                <img src="/cms/wp-content/uploads/2021/03/service-experience_sptop.jpg" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <h1 class="mb-0">利用体験談</h1>
            </div>
        </div>
    </div><!-- page-header -->
    <form id="reset" action="" method="post">
        <input type="hidden" name="reset" value="reset">
    </form>
    <div class="page-content-wrapper columns">
        <div class="page-content-innerwrap search"><!-- 検索 -->
            <form id="search" action="" method="post" name="search">
                <div class="page-content-div container d-block mb-4">
                    <div class="d-lg-none d-block my-1">
                        <p class="search-menu mb-0">体験談投稿</p>
                        <div class="post-link mb-4">
                            <a class="index-btn px-4 py-1 d-flex justify-content-between align-items-center d-flex justify-content-between align-items-center" href="/service-experience-list/form/">
                                <span>体験談の投稿はここから</span><i class="fa-solid fa-pen pl-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-1">
                        <p class="search-menu mb-0">体験談検索</p>
                        <div class="post-link d-lg-block d-none">
                            <a class="index-btn px-4 py-1 d-flex justify-content-between align-items-center d-flex justify-content-between align-items-center" href="/service-experience-list/form/">
                                <span>体験談の投稿はここから</span><i class="fa-solid fa-pen pl-2"></i>
                            </a>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div id="experience-search" class="row d-lg-flex d-md-block">
                            <div class="col-lg-4 col-md-12">
                                <div class="row h-100 mb-md-1">
                                    <div class="item-name col-4 col-md-4 py-2 d-flex align-items-center">
                                        <p class="mb-0">カテゴリー</p>
                                    </div>
                                    <div class="item-search col-8 col-md-8 py-2 item-search col-md-8 py-2 d-lg-flex d-md-flex d-sm-block">
                                        <select name="search_lifesupport_cat" class="form-control pl-1 mb-lg-0 mb-md-0 mb-sm-2 mr-lg-1 mr-md-1 mr-sm-0">
                                            <option value="">カテゴリーを選択</option>
                                                <?php
                                                $search_type = 'default';
                                                $return_type = 2;
                                                $check_doc = false;
                                                $result = get_lifesupportservice_data ($search_type, $return_type, $check_doc);
                                                $result = array_merge($result, get_socialcontribution_data($search_type, $return_type, $check_dock));
                                                $children = array();
                                                foreach ($result as $child) {
                                                    echo '<option value="' . $child['cat_slug'] .'">' . $child['cat_name'] . '</option>';
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="row h-100 mb-md-1">
                                    <div class="item-name col-4 col-md-4 py-2 d-flex align-items-center">
                                        <p class="mb-0">サービス</p>
                                    </div>
                                    <div class="item-search col-8 col-md-8 py-2 item-search col-md-8 py-2 d-lg-flex d-md-flex d-sm-block">
                                        <select name="search_lifesupport" class="form-control pl-1">
                                            <option value="">サービスを選択</option>
                                            <?php
                                                $check_doc = false;
                                                $result = get_lifesupportservice_data($search_type, $return_type, $check_doc);
                                                $result = array_merge($result, get_socialcontribution_data($search_type, $return_type, $check_doc));

                                                $search_no_cat = '';
                                                foreach ($result as $lifesupport_cat) {
                                                    // csr-topics カテゴリを除外
                                                    if (isset($lifesupport_cat['cat_slug']) && $lifesupport_cat['cat_slug'] === 'csr-topics') {
                                                        continue;
                                                    }

                                                    foreach ($lifesupport_cat['post_list'] as $lifesupport) {
                                                        $search_no_cat .= '<option value="' . $lifesupport['id'] .'">' . $lifesupport['name'] . '</option>';
                                                    }
                                                }
                                                echo $search_no_cat;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12 pb-1">
                                <div class="row"><!-- 会員特典の満足度 -->
                                    <div class="item-name col-4 col-md-4 py-2 d-flex align-items-center">
                                        <p class="mb-0">満足度</p>
                                    </div>
                                    <div class="item-search col-8 col-md-8  py-2">
                                        <select name="search_member_benefits" class="form-control pl-1">
                                            <option value="">満足度を選択</option>
                                            <?php
                                            // 表示用の星数（満足: ★★★★, やや満足: ★★★, やや不満: ★★, 不満: ★）
                                            $benefit_options = [
                                                '満足'     => '★★★★',
                                                'やや満足' => '★★★',
                                                'やや不満' => '★★',
                                                '不満'     => '★',
                                            ];

                                            // セッションから選択値を保持（戻ってきたときの再選択用）
                                            $selected_value = $_SESSION['experience']['search_member_benefits'] ?? '';

                                            foreach ($benefit_options as $label => $stars) {
                                                $selected_attr = ($selected_value === $label) ? ' selected' : '';
                                                echo '<option value="' . esc_attr($label) . '"' . $selected_attr . '>' . esc_html($stars) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div><!-- 会員特典の満足度ここまで -->
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="search-btn text-center col-6 col-lg-3 px-1">
                            <button class="index-btn w-100" type="submit" id="experience-search"><i class="fa-solid fa-magnifying-glass pr-2"></i>検索する</button>
                        </div>
                        <div class="reset-btn text-center col-6 col-lg-3 px-1">
                            <button class="index-btn w-100"><i class="fa-solid fa-xmark pr-2"></i>検索条件をクリア</button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- 検索ここまで -->
        <div class="page-content-innerwrap post-list"><!-- 投稿一覧 -->
            <div class="container d-block">
                <div class="page-content-div">
                    <?php if (!$posts->posts) { ?>
                        <div class="col-10 search_result mx-auto">
                            <p>該当の投稿がみつかりませんでした。</p>
                        </div>
                    <?php } ?>
                    <div class="service-report d-flex flex-row flex-wrap mt-3 mx-auto">
                        <?php foreach ($posts->posts as $post) { ?>
                            <?php get_template_part('templates/service-experience-report'); ?>
                        <?php } ?>
                    </div>
                </div>
                <!-- ページネーション -->
                <div class="pnavi mt-3 mx-auto">
                    <?php
                        $pnum = 2;
                        if($display_type == 'sp'){
                            $pnum = 1;
                        }
                        if ($posts->max_num_pages > 1) {
                            echo paginate_links(array(
                                'base'      => '%_%',
                                'format'    => '?page=%#%',
                                'current'   => max(1, $paged),
                                'mid_size'  => $pnum,
                                'total'     => $posts->max_num_pages,
                                'prev_text' => '<',
                                'next_text' => '>',
                                'type'      => 'list'
                            ));
                        }
                        wp_reset_postdata();
                    ?>
                </div><!-- ページネーションここまで -->
            </div>
        </div><!-- 投稿一覧ここまで -->
    </div>
</div>
<?php
    $for_prev = 0;
    if($_GET['page']){
        $for_prev = $_GET['page'];
    }
    console_log($_SESSION['experience']);
?>
<script>
	// 投稿一覧
	var posts = [];
	var list_html = "";
	// js ライフサポートサービスカテゴリ　& ライフサポートサービス の配列生成
	var life_support_list = [];
    <?php
    foreach ($result as $lifesupport_cat) {
        // ここで csr-topics を除外
        if (isset($lifesupport_cat['cat_slug']) && $lifesupport_cat['cat_slug'] === 'csr-topics') {
            continue;
        }

        foreach ($lifesupport_cat['post_list'] as $lifesupport) {
    ?>
        if (life_support_list['<?php echo $lifesupport_cat['cat_slug']; ?>'] == null) {
            life_support_list['<?php echo $lifesupport_cat['cat_slug']; ?>'] = [];
        }
        life_support_list['<?php echo $lifesupport_cat['cat_slug']; ?>']['<?php echo $lifesupport['id']; ?>'] =
            '<option value="<?php echo $lifesupport['id']; ?>"><?php echo $lifesupport['name']; ?></option>';
    <?php
        }
    }
    ?>

jQuery(function($){
    // ページネーション
    now_page = <?php echo $for_prev; ?>;
    if(now_page = 2){
        $('ul.page-numbers li>a.page-numbers.prev').attr('href','/service-experience/');
    }
    $('ul.page-numbers li>span.dots').parent('li').css({color:"red",border:"none",background:"transparent", opacity:"1"});
    $('ul.page-numbers li>a.page-numbers').each(function (){
        if( $(this).text() == '1'){
            $(this).attr('href','/service-experience/');
        }
    });

	$(document).ready( function(){
    // 検索条件 初期設定（検索状態保持）
        var search_conditions = <?php echo json_encode($_SESSION['experience'] ?? [], JSON_UNESCAPED_UNICODE); ?>;

        if (search_conditions) {
            $('[name="search_lifesupport_cat"]').val(search_conditions["search_lifesupport_cat"]);
            setLifesupportOption('[name="search_lifesupport"]', search_conditions["search_lifesupport_cat"]);
            $('[name="search_lifesupport"]').val(search_conditions["search_lifesupport"]);
            $('[name="search_member_benefits"]').val(search_conditions["search_member_benefits"]);
        }
    });

	//ライフサポートサービスカテゴリ変更時
	$('[name="search_lifesupport_cat"]').on('change', function () {
		setLifesupportOption('[name="search_lifesupport"]',$('[name="search_lifesupport_cat"] option:selected').val());
    });

	// ライフサポートサービス リスト入れ替え
    function setLifesupportOption(target_name, search_lifesupport_cat) {
        $(target_name + ' option').remove();
        $(target_name).append('<option value="">サービスを選択</option>');

        if (search_lifesupport_cat && life_support_list[search_lifesupport_cat]) {
            life_support_list[search_lifesupport_cat].forEach(function(value) {
                $(target_name).append(value);
            });
        } else {
            // カテゴリー未選択時は全てのサービス名称を出す
            var all_options = '<?php echo $search_no_cat; ?>';
            $(target_name).append(all_options);
        }
    }
    // リセットボタン押下時の処理
    $('.reset-btn').on('click', function (e) {
        e.preventDefault();
        $('#search select').val('');
        $('[name="search_photo"][value="photo_all"]').attr('checked','checked');
    });
	// 詳細ボタン押下時の処理
	$(document).on('click', '.post-list .post-data', function(e){
        if(!$(e.target).parents().hasClass('not-click')){
            if(!$(e.target).hasClass('not-click')){
                id = $(this).data('post_id');
                location.href = '/service-experience-list/detail/?post_id=' + id;
            }
        }
	});
});
</script>

<?php get_footer(); ?>