<?php
/*
 * Template Name: 申し込み関係テンプレート
 */
global $post;
get_header();
?>
<?php
    $m_id   = $_SESSION['member_info']['member_id'];
    $m_name = $_SESSION['member_info']['member_name'];

    if ($m_id == null || empty($m_id)) {
		wp_redirect(home_url('/'));
		exit;
    }

?>
<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php if($_GET['cate'] == 'clean' || $_GET['cate'] == 'hisai'){ echo 'theme-csr';} ?> <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/">
                                    <span itemprop="name">
                                        <i class="fa fa-home"></i> HOME
                                    </span>
                                </a>
                            </li>
                            <li>
                                <span>
                                    <?php
                                    if($_GET['cate'] == 'lifesupport'){
                                        echo 'サービス利用申請書お取り寄せ';
                                    }elseif($_GET['cate'] == 'clean'){
                                        echo 'クリーンキャンペーン活動報告書お取り寄せ';
                                    }elseif($_GET['cate'] == 'hisai'){
                                        echo '被災報告書お取り寄せ';
                                    }elseif($_GET['cate'] == 'mobile'){
                                        echo 'モバイルレンタル利用申請書お取り寄せ';
                                    }elseif($_GET['cate'] == 'volunteer'){
                                        echo 'ボランティア活動報告書お取り寄せ';
                                    }elseif($_GET['cate'] == 'water'){
                                        echo '天然水の定期購入お申し込み';
                                    }
                                    ?>
                                </span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top pb-4">
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image'); ?>">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                <h1 class="mb-0 my-5">
                    <?php
                        if($_GET['cate'] == 'lifesupport'){
                            echo 'サービス利用申請書お取り寄せ';
                        }elseif($_GET['cate'] == 'clean'){
                            echo 'クリーンキャンペーン活動報告書お取り寄せ';
                        }elseif($_GET['cate'] == 'hisai'){
                            echo '被災報告書お取り寄せ';
                        }elseif($_GET['cate'] == 'mobile'){
                            echo 'モバイルレンタル利用申請書お取り寄せ';
                        }elseif($_GET['cate'] == 'volunteer'){
                            echo 'ボランティア活動報告書お取り寄せ';
                        }elseif($_GET['cate'] == 'water'){
                            echo '天然水の定期購入お申し込み';
                        }
                    ?>
                </h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <div class="container">
            <div class="page-content-innerwrap">
                <!-- ここから -->
                <div class="container web-form mt-5">
                    <div class="row">
                        <div class="col-lg">
                            <div class="service-experience-form web-form mt-5">
                                <?php // ここはqueryで判断 ?>
                                <div class="contact-flow">
                                    <img class="pc" src="/cms/wp-content/themes/zenkosai/assets/images/form/step1.png">
                                    <img class="sp" src="/cms/wp-content/themes/zenkosai/assets/images/form/step1_sp.png">
                                </div>
                                <?php
                                    $url = home_url();
                                    $back_title = 'ホームへ';
                                if($_GET['cate'] == 'lifesupport'){
                                    echo do_shortcode('[mwform_formkey key="1884"]');
                                    $url = '/lifesupport/'.$_GET['srv'];
                                    $p_info = get_page_by_path($_GET['srv'] , OBJECT , 'lifesupport');
                                    $postID = $p_info->ID;
                                    $back_title = get_the_title($postID).'へ戻る';
                                }elseif($_GET['cate'] == 'clean'){
                                    echo do_shortcode('[mwform_formkey key="2437"]');
                                    $url = '/social-contribution';
                                    $back_title = '社会貢献活動一覧へ';
                                }elseif($_GET['cate'] == 'hisai'){
                                    echo do_shortcode('[mwform_formkey key="2440"]');
                                    $url = '/social-contribution';
                                    $back_title = '社会貢献活動一覧へ';
                                }elseif($_GET['cate'] == 'mobile'){
                                    echo do_shortcode('[mwform_formkey key="2442"]');
                                    $url = '/business/mobile-rental';
                                    $back_title = 'モバイルレンタルへ';
                                }elseif($_GET['cate'] == 'volunteer'){
                                    echo do_shortcode('[mwform_formkey key="2929"]');
                                    $url = '/social-contribution';
                                    $back_title = '社会貢献活動一覧へ';
                                }elseif($_GET['cate'] == 'water'){
                                    echo do_shortcode('[mwform_formkey key="15995"]');
                                    $url = '/lifesupport/cosmo-water/';
                                    $back_title = '戻る';
                                }
                                ?>
                                <?php if ($post->post_name == 'form-complete') : ?>
                                    <div id="mail-contact" class="container web-form my-5">
                                        <div class="row">
                                            <div class="col-lg">
                                                 <div class="service-experience-form web-form">
                                                    <p class="mb-0">
                                                    <?php if($_GET['cate'] == 'water'){ ?>
                                                        お申込みありがとうございます。<br>
                                                        販売店の協栄プランニングよりお支払いに必要なクレジットカード支払申込書等の書類をお送りさせていただきます。<br>
                                                        書類が届き次第、必要事項に署名捺印いただき協栄プランニングへご返送いただきますようお願いいたします。<br>
                                                        なお、書類の返送がない場合は、商品はお届け出来ませんのでご注意ください。<br>
                                                    <?php }else{ ?>
                                                        書類のお取り寄せを受付いたしました。<br>
                                                        ３営業日以内にお送りいたします。<br />
                                                        平日夜間及び土日祝日などの休業日につきましてはお届けまでお時間をいただきますので予めご了承ください。<br>
                                                    <?php } ?>
                                                    </p>
                                                </div>
                                                <div class="mx-auto text-center">
                                                    <a href="<?php echo $url;?>">
                                                        <button class="index-btn bg_darkg submit btn btn-primary">
                                                            <?php echo $back_title; ?>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <!-- ここまで -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php get_footer(); ?>
<style>
.web-form .lasting-btn {
    font-size:0.8em;
}
.select-service i.service-hide {
    color: #35B574;
}
.confirm .service_qty_other.active::after {
    content: "本";
}
.confirm .hidden-confirm {
    display: none;
}

</style>
<script>
jQuery(function($){
    $(window).on('load', function() {
        // すでにサービスが選択されている場合は表示させる
        $('#service-select-index div.select-service.d-none').each(function(){
            if ($(this).children('.form_select_service').val() != null ) {
                $(this)
                    .removeClass('d-none')
                    .addClass('d-flex');
            }
        });
    });
    if($('select[name=sending_type]').val() == 'FAX'){
        $('#fax-box').removeClass('d-none');
    }
    if($('select[name=sending_type]').val() == 'メール'){
        $('#mail-box').removeClass('d-none');
    }
    // 選択済みにする
    var serviceData = <?php echo get_lifesupportservice_data('srv', 1); ?>;
    var selectedName = '';
    $.each(serviceData,function(index,val){
        $.each(val.post_list,function(innerIndex,innerVal){
            if (innerVal.slug == '<?php echo $_GET['srv'] ? $_GET['srv'] : 'null'; ?>') {
                selectedName = innerVal.name;
            }
        });
    });

    $('#select_service_01 option').each(function (){
        if ($.trim($(this).text()) == selectedName) {
            $(this).prop('selected', true);
        }
    });

    // 追加ボタンクリックイベント
    $('#add-select-service').click(function() {
        $('#service-select-index div.select-service.d-none:first')
                .removeClass('d-none')
                .addClass('d-flex')
                .children('.form_number_of_copy').val('1部')
                .children('.form_number_of_copy option:first').attr('disabled', 'disabled');
        if($('#service-select-index div.select-service.d-none').length == 0){
            $('#add-select-service').addClass('d-none');
        }
    });

    // 削除ボタンクリックイベント
    $('i.service-hide').click(function() {
        var targetDom;
        $(this).parent('.select-service')
            .removeClass('d-flex')
            .addClass('d-none');
        $(this).siblings('select').val(0);
        $('#add-select-service').removeClass('d-none');
    });

    // セレクトボックス監視
    $('#sending_type').change(function() {
        // 初期化
        $('#fax-box').addClass('d-none');
        $('#fax-box input#fax_num').val('');
        $('#mail-box').addClass('d-none');
        $('#mail-box input#email').val('');
        $('.form_number_of_copy').removeClass('d-none');
        $('input#fax_num,input#email').removeAttr('required');
        if ($('#sending_type').val() == 'FAX') {
            $('#fax-box').removeClass('d-none');
            $('.form_number_of_copy').addClass('d-none');
            $('input#fax_num').attr('required', 'required');
        }
        if ($('#sending_type').val() == 'メール') {
            $('#mail-box').removeClass('d-none');
            $('.form_number_of_copy').addClass('d-none');
            $('input#email').attr('required', 'required');
        }
    });


    // すでに入力済みなら表示する
    if ($('#fax-box input[name=fax_num]').val() != '') {
        $('#fax-box').removeClass('d-none');
    }

    $('.form_select_service-service').each(function(){
        if($(this).val() == 0){
            $(this).siblings('.form_number_of_copy').val(0);
        }
    });

    // 会員IDを入力する
    var m_id = <?php echo (int)$m_id; ?>;
    $('#member_id').val(m_id);

    // 会員氏名を入力する
    var m_name = <?php echo "'".$m_name."'"; ?>;
    $('#member_name').val(m_name);

<?php
    if($_GET['cate'] == 'water'){
        $member_info = member_search_action($_SESSION['member_info']['member_id']);
        $birthday_year = "";
        $birthday_month = "";
        $birthday_day = "";
        if (!empty($member_info['birthday']) && strlen($member_info['birthday']) >= 10) {
            $birthday_year = substr($member_info['birthday'],0,4);
            $birthday_month = substr($member_info['birthday'],5,2);
            $birthday_day = substr($member_info['birthday'],8,4);
        }
;
    ?>
    $('#member_name_kana').val("<?php echo $member_info['member_kana']; ?>");
    $('#member_birthday_year').val("<?php echo $birthday_year; ?>");
    $('#member_birthday_month').val("<?php echo intval($birthday_month); ?>");
    $('#member_birthday_day').val("<?php echo intval($birthday_day); ?>");
    $('#member_postalcode').val("<?php echo str_replace("-","",$member_info['zip_code']); ?>");
    $('#member_address_pref').val("<?php echo $member_info['pref_name']; ?>");
    $('#member_address_city').val("<?php echo $member_info['city_name']; ?>");
    $('#member_address_house_num').val("<?php echo $member_info['address_name']; ?>");
    $('#member_address_detail').val("<?php echo $member_info['build_name']; ?>");

    // 水の定期購入の入力画面初回起動時に自動セット（入力チェックエラー等のときは前の入力内容を保持）
    if ($('#member_mail').val() == "" && !($('#member_mail').parent().find('.error').length)) {
        $('#member_mail').val("<?php echo $member_info['email']; ?>");
    }

    $("#member_birthday_month option:not(:selected)").prop('disabled', true);
    $("#member_birthday_day option:not(:selected)").prop('disabled', true);
    $("#member_address_pref option:not(:selected)").prop('disabled', true);
    

<?php } ?>
    // 追加ボタンクリックイベント
    $('input:radio[name="user_same"]').change(function() {
        if ($('input:radio[name="user_same"]:checked').val() == '同じ') {
            $('#user_id').val("");
            $('#user_name').val("");
            $('#user_name_kana').val("");
            $('#user_birthday_year').val("");
            $('#user_birthday_month').val("");
            $('#user_birthday_day').val("");
            $('#user_age').val("");
            $('#user_tel1').val("");
            $('#user_tel2').val("");
            $('#user_postalcode').val("");
            $('#user_address_pref').val("");
            $('#user_address_city').val("");
            $('#user_address_house_num').val("");
            $('#user_address_detail').val("");
            $('#user_mail').val("");

            $('.user_area').hide('slow');
        } else {
            $('.user_area').show('slow');
        }
    });

    if ($('input:radio[name="user_same"]:checked').val() == '同じ' || $('input:hidden[name="user_same"]').val() == '同じ') {
        $('.user_area').hide();
    } else {
        $('.user_area').show();
    }
    // 会員IDと会員氏名欄を読み取り飲みに設定
    $('.readonly').attr('readonly',true);

});
</script>

<?php
// フォーム画面用
if ($post->post_name == 'form') :
?>
    <style>
    .form-d-none {
        display: none!important;
    }
    </style>
    <script>
    jQuery(function($){
        $('.contact-flow').children('img.pc').attr('src', '/cms/wp-content/themes/zenkosai/assets/images/form/step1.png');
        $('.contact-flow').children('img.sp').attr('src', '/cms/wp-content/themes/zenkosai/assets/images/form/step1_sp.png');
    // submit前validationチェック
        $('form').submit(function(){
            $('select.form_select_service').each(function(){
                // サービスの入力がなく、部数の選択のある場合→部数未選択へ
                if($(this).val() == null){
                    if($(this).siblings('.form_number_of_copy').val() != null){
                        $(this).siblings('.form_number_of_copy').val(0);
                    }
                }
            });
            return true;
        });


    });

/*
    // 生年月日変更
    jQuery('#member_birthday_year,#member_birthday_month,#member_birthday_day').change(function() {
		var year = jQuery('#member_birthday_year').val();
		var month = jQuery('#member_birthday_month').val();
		var day = jQuery('#member_birthday_day').val();

		if (year != "" && month != "" && day != "") {
			jQuery('#member_age').val(getAge(year,month,day));
		} else {
			jQuery('#member_age').val("");
		}
    });
*/

    jQuery('#user_birthday_year,#user_birthday_month,#user_birthday_day').change(function() {
		var year = jQuery('#user_birthday_year').val();
		var month = jQuery('#user_birthday_month').val();
		var day = jQuery('#user_birthday_day').val();

		if (year != "" && month != "" && day != "") {
			jQuery('#user_age').val(getAge(year,month,day));
		} else {
			jQuery('#user_age').val("");
		}
    });

    function getAge(y, m, d){
        var birthday  = new Date(y, m-1, d); 
        var today = new Date();
        var thisYearBirthday =
            new Date(today.getFullYear(), birthday.getMonth(), birthday.getDate());  
        var age = today.getFullYear() - birthday.getFullYear();
        //今年の誕生日を迎えていなければage-1を返す
        return (today < thisYearBirthday)?age-1:age;
    }

    jQuery( 'input[name="member_postalcode"]' ).keyup( function( e ) {
        AjaxZip3.zip2addr('member_postalcode','','member_address_pref','member_address_city');
    } )
    jQuery( 'input[name="user_postalcode"]' ).keyup( function( e ) {
        AjaxZip3.zip2addr('user_postalcode','','user_address_pref','user_address_city');
    } )
    // 数量変更
    jQuery('input[name="service_qty"]:radio').change(function() {
		if(jQuery(this).val() != 'その他') {
			jQuery('#service_qty_num').val('');
			jQuery('#service_qty_num').prop('readonly', true);
        } else {
			jQuery('#service_qty_num').prop('readonly', false);
		}
    });
    </script>
<?php
endif;
?>

<?php
// 確認画面用
if ($post->post_name == 'form-confirm') :
?>
    <style>
    .confirm-d-none {
        display: none!important;
    }
    </style>
    <script>
    jQuery(function($){
        $('.contact-flow').children('img.pc').attr('src', '/cms/wp-content/themes/zenkosai/assets/images/form/step2.png');
        $('.contact-flow').children('img.sp').attr('src', '/cms/wp-content/themes/zenkosai/assets/images/form/step2_sp.png');
        $('.select-service').each(function(){
            if ($.trim($(this).text()) != '選択してください') {
                $(this).removeClass('d-none');
            }
        });
        if ($('#fax-box input[name=fax_num]').val() != '') {
            $('#fax-box').removeClass('d-none');
        }
        if ($('#mail-box input[name=email]').val() != '') {
            $('#mail-box').removeClass('d-none');
        }

        if($('input[name="service_qty"]').val() == 'その他') {
            $('.service_qty_other').addClass('active');
        }

    });

    </script>
<?php
endif;
?>
<?php
// 投稿完了画面
if ($post->post_name == 'form-complete') :
?>
<script>
    jQuery(function($){
        $('.contact-flow').children('img.pc').attr('src', '/cms/wp-content/themes/zenkosai/assets/images/form/step3.png');
        $('.contact-flow').children('img.sp').attr('src', '/cms/wp-content/themes/zenkosai/assets/images/form/step3_sp.png');
    });
</script>
<?php endif; ?>