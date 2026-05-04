<?php
/*
 * Template Name: サービス利用体験　投稿
 */
get_header(); ?>

<!-- <style>
.page-experience-form .icon_image {
	border-bottom:0px !important;
}
select.triangle-back{
    background-image: none;
}
.page-experience-form .icon_image .wpuf-fields{
	/* visibility: hidden; */
	height:0px;
}
.page-experience-form .wpuf-label .required{
	visibility: hidden;
}
.page-experience-form .step2{
	display:none;
}
.page-experience-form .back {
	color:#000000;
	border:1px solid #000000;
	margin-right:30px;
    background-color: white;
}
</style> -->


<?php
    $m_id   = $_SESSION['member_info']['member_id'];
    $m_name = $_SESSION['member_info']['member_name'];
?>
<div id="page-experience-form" class="page-experience-form page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo home_url();?>">
                                    <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/service-experience/">
                                    <span itemprop="name">利用体験談</span>
                                </a>
                            </li>
                            <li>
                                <span><?php the_title(); ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-top">
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image'); ?>">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                        <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper service-experience">
        <div class="container">
            <div class="page-content-innerwrap">
                <div class="service-experience-form mt-5">
                    <div class="col-lg">
                        <!-- <div class="step1 stephead">
                            <img class="step1 pc" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/experience-form-step1.png">
                            <img class="step1 sp" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/experience-form-step1_sp.png">
                        </div>
                        <div class="step1 txtbox mt-4 mb-4">
                            <p class="w-keepall">
                                いただきました体験談は個人情報や誤字などに配慮して公開させていただきますが、<br>
                                入力時にも個人が特定できるような内容が含まれませんようご注意ください。<br>
                                なお、投稿内容につきましては、サービス向上のためサービス提供会社への共有や、<br>
                                日本共済株式会社より詳細をお伺いする場合がございます。
                            </p>
                        </div>
                        <div class="step2 stephead">
                            <img class="step2 pc" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step2.png">
                            <img class="step2 sp" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step2_sp.png">
                        </div>
                        <div class="step2 txtbox mt-4 mb-4">
							<p>ご入力いただいた内容をご確認ください</p>
						</div> -->
                        <div class="step1 stephead">
                            <img class="step1 pc d-none d-md-block" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step1.png">
                            <img class="step1 sp d-block d-md-none" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step1_sp.png">
                        </div>
                        <div class="step1 txtbox mt-4 mb-4">
                            <p class="w-keepall">
                                いただきました体験談は個人情報や誤字などに配慮して公開させていただきますが、<br>
                                入力時にも個人が特定できるような内容が含まれませんようご注意ください。<br>
                                なお、投稿内容につきましては、サービス向上のためサービス提供会社への共有や、<br>
                                全厚済サポートデスクより詳細をお伺いする場合がございます。
                            </p>
                        </div>
                        <div class="step2 stephead">
                            <img class="step2 pc d-none d-md-block" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step2.png">
                            <img class="step2 sp d-block d-md-none" src="/cms/wp-content/themes/zenkosai/assets/images/serviceexperience/step2_sp.png">
                        </div>
                        <div class="step2 txtbox mt-4 mb-4">
							<p>ご入力いただいた内容をご確認ください</p>
						</div>
                    </div>
                    <div id="service-experience-form-top"></div>
                    <?php the_content(); ?>
                    <!-- <form> -->
                        <div class="inputbox mb-4 icon_image_view">
                            <div class="container border-bottom">
                                <div class="row">
                                    <div class="col-9 col-md-3 titlearea"> </div>
                                    <div class="col-3 col-md-2 mt-1 text-center-right">
                                    </div>
                                    <div class="col-12 col-md-7 inputarea pt-2 mb-0 mb-sm-3">
                                        <p class="wpuf-help mt-1">お好みのアイコンを選択してください。</p>
                                        <div class="radio_area mt-4">
                                            <div class="radio_wrap">
                                                <input id="radio1" class="radiobutton" name="input_icon_image" type="radio"
                                                    value="男性" />
                                                <label for="radio1" class="man">　　</label>
                                                <p class="select_radio text-center">選択中</p>
                                            </div>
                                            <div class="radio_wrap">
                                                <input id="radio2" class="radiobutton" name="input_icon_image" type="radio"
                                                    value="女性" />
                                                <label for="radio2" class="lady">　　</label>
                                                <p class="select_radio text-center">選択中</p>
                                            </div>
                                            <div class="radio_wrap">
                                                <input id="radio3" class="radiobutton" name="input_icon_image" type="radio"
                                                    value="ライノくん" />
                                                <label for="radio3" class="animal">　　</label>
                                                <p class="select_radio text-center">選択中</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inputbox form-check text-center privacy my-4">
                        <a href="/privacy-policy" target="_blank" rel="noopener noreferrer">プライバシーポリシー</a>をご確認の上、<br>「同意する」にチェックをしてください。<br>
                            <div class="form-check form-check-inline mt-3">
                                <input class="form-check-input mr-3" type="checkbox" id="check1a"><br>
                                <label class="form-check-label text-center" for="check1a">同意する</label>
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<style>
    .readonly {
        background-color: #e9ecef;
        opacity: 1;
        pointer-events: none;
    }
    .readonly:hover {
        cursor: none;
    }
    .readonly:hover caption {
        display: none;
    }
    .page-experience-form .service-experience-form .wpuf-el label.error {
        color: red !important;
        background-color: #ffe4e4;
        padding: 5px;
        margin-bottom: 0.5rem;
        display: block;
    }
</style> -->
<?php get_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
jQuery(function($){
    // $('.inputbox.privacy-confirmation').css('display','none');
	$(document).ready( function(){
        $('.icon_image_view').insertAfter('.icon_image');
        $('.privacy').insertAfter('.member_benefits');
        $('input[type=file]').attr('accept', 'image/jpeg,.jpg,.jpeg,image/png,.png');
        var m_id = <?php echo (int)$m_id; ?>;
        $('input[id^="member_id"]').attr('value', m_id);
        var m_name = '<?php echo $m_name; ?>';
        $('input[id^="editer_name"]').attr('value', m_name);
		setLifesupportOption();
        if ($('[name="input_icon_image"]:checked').length || $('[name="icon_image"]').val() != '-1') {
            setIconImage();
        }
		setUseDate();
		checkSubmitButton();
	});
    // ページ表示時
	// アイコン変更時
    $('[name="input_icon_image"]').on('change', function () {
		setIconImage();
    });
	// 規約同意チェック変更時
    $('.form-check-input').on('change', function () {
		checkSubmitButton();
    });
	// アイコン選択値 連動
    function setIconImage() {
        $('[name="icon_image"]').val($('[name="input_icon_image"]:checked').val());
	}
	// 利用日セット
    function setUseDate() {
		strHTML = '<option value="-1">お選びください</option>';
		strHTML = strHTML + '<?php get_use_date(); ?>';
		$('[name="use_date"]').html(strHTML);
	}
	// 送信ボタン活性非活性切り替え
    function checkSubmitButton() {
		if($('.form-check-input').prop("checked")) {
			$('.form-confirm-button').prop('disabled', false);
		} else {
			$('.form-confirm-button').prop('disabled', true);
		}
	}
	// ライフサポートサービス リストオプション追加
    function setLifesupportOption() {
        var service_select = '';
        if(location.search){
            service_select = getParam('service');
        }

		strHTML = "";
		strHTML = '<option value="-1">お選びください</option>';
		<?php
		$search_type = 'default';
		$return_type = 2;
        $check_dock = false;
		$result = get_lifesupportservice_data ($search_type, $return_type, $check_dock);
        $result = array_merge($result, get_socialcontribution_data($search_type, $return_type, $check_dock));
		foreach ($result as $child) {
		?>
			strHTML = strHTML + '<optgroup label="<?php echo $child['cat_name']; ?>">';
		<?php
			foreach ($child['post_list'] as $value) {
		?>
                var selected = '';
                if (service_select && service_select == <?php echo $value['id']; ?>) {
                    selected = 'selected';
                }
				strHTML = strHTML + '<option value="<?php echo $value['id']; ?>"'  + selected + '><?php echo $value['name']; ?></option>';
		<?php
			}
		?>
			strHTML = strHTML + '</optgroup>';
		<?php
		}
		?>
		$('[name="service"]').html(strHTML);
	}

    function getParam(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    
	//確認画面処理
    var confirm_status = 0;

    var confirm_btn = '<input type="button" class="form-confirm-button btn" name="confirm_experience_form" value="確認する" disabled>';
    var back_btn = '<input type="button" class="form-back-button btn d-none" name="back_experience_form" value="戻る">';
    $('.wpuf-submit').prepend(confirm_btn);
    $('.wpuf-submit').prepend(back_btn);
    $('.wpuf-submit-button').addClass('d-none');

    var serviceExperienceForm = $('form.wpuf-form-add');
    var topmargin = 200;
    var hashposi = $('#service-experience-form-top').offset().top;
    hashposi = hashposi - topmargin;

    // 入力画面→確認画面
    $(document).on('click', '.form-confirm-button', function () {
        if (!serviceExperienceForm.valid()) {
            $('body,html').animate({scrollTop:hashposi}, 200, 'swing');
            return;
        }

        // ボタンの表示・非表示
        $('.form-confirm-button').addClass('d-none');
        $('.wpuf-submit-button').removeClass('d-none');
        $('.wpuf-submit-button').prop('disabled', false);
        $('.form-back-button').removeClass('d-none');

        // 入力項目のreadonly設定
        $('.wpuf-form input,.wpuf-form textarea').not('[name="submit"],[name="hidden"]').prop('readonly', true);
        $('.wpuf-form select').addClass('readonly');
        $('.wpuf-form .wpuf-radio-inline').css('pointer-events', 'none');
        $('.wpuf-form .wpuf-radio-inline').css('color', 'gray');
        $('.file-selector,.wpuf-help').hide();
        $('.inputbox.form-check').addClass('d-none');
        $('.man,.lady,.animal,.wpuf-image-wrap').addClass('readonly');
        $('.step1').css('display','none');
        $('.step2').css('display','block');

        $('body,html').animate({scrollTop:0}, 200, 'swing');

    });

    // 確認画面→入力画面
    $(document).on('click', '.form-back-button', function () {
        // ボタンの表示・非表示
        $('.form-confirm-button').removeClass('d-none');
        $('.wpuf-submit-button').addClass('d-none');
        $('.wpuf-submit-button').prop('disabled', true);
        $('.form-back-button').addClass('d-none');

        // 入力項目のreadonly設定
        $('.wpuf-form input,.wpuf-form textarea').not('[name="submit"]').prop('readonly', false);
        $('.wpuf-form select').removeClass('readonly');
        $('.wpuf-form .wpuf-radio-inline').css('pointer-events', 'auto');
        $('.wpuf-form .wpuf-radio-inline').css('color', '#000');
        $('.file-selector,.wpuf-help').show();
        $('.inputbox.form-check').removeClass('d-none');
        $('.man,.lady,.animal,.wpuf-image-wrap').removeClass('readonly');
        $('.step1').css('display','block');
        $('.step2').css('display','none');
        $('.caption.d-none').removeClass('d-none');

        $('body,html').animate({scrollTop:hashpsi}, 200, 'swing');
    });

    // バリデーション設定（jquery.validate.js）
    // セレクトボックスのバリデーション
    $.validator.addMethod('selectRequired', function(value, element) {
        if (value == '-1' || !value) {
            return false;
        }
        return true; 
    });

    // 個々の項目にバリデーションルールを設定
    serviceExperienceForm.validate({
        // ルールの設定
        rules: {
            icon_image: {
                required: true,
                selectRequired: true,
            },
            prefecture: {
                required: true,
                selectRequired: true,
            },
            age: {
                required: true,
                selectRequired: true,
            },
            service: {
                required: true,
                selectRequired: true,
            },
            use_date: {
                required: true,
                selectRequired: true,
            },
            user: {
                required: true,
                selectRequired: true,
            },
            experience: {
                required: true,
            },
            service_info: {
                required: true,
                selectRequired: true,
            },
            member_benefits: {
                required: true,
                selectRequired: true,
            },
            member_id: {
                required: true,
                selectRequired: true,
            },
            editer_name: {
                required: true,
                selectRequired: true,
            },
        },
        // エラー時のメッセージ
        messages: {
            icon_image: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            prefecture: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            age: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            service: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            use_date: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            user: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            experience: {
                required: '入力してください',
            },
            service_info: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            member_benefits: {
                required: '選択してください',
                selectRequired: '選択してください',
            },
            member_id: {
                required: '8桁の会員IDをご入力ください',
                selectRequired: true,
            },
            editer_name: {
                required: 'お名前をご入力ください',
                selectRequired: true,
            },
        },
        // エラーメッセージを表示する位置
        errorPlacement: function (error, element) {
            error.insertBefore(element)
        },
        onsubmit: false, // 送信ボタン押下時にバリデーションを行わない
        focusInvalid: false, //エラー時にフォーカスしない
    });
    
	//確認画面→入力画面 TODO:プラグインバージョンアップにより確認画面がないため、改めて対応
    // $(document).on('click', 'input[name=back_to_input]', function () {
    //     confirm_status = 0;
    //     $('.wpuf-form select,.wpuf-form input,.wpuf-form textarea').not('[name="submit"]').prop('disabled', false);
    //     $('.file-selector,.wpuf-help').show();
    //     $('input[name=back_to_input]').remove();
    //     $('.inputbox.form-check').removeClass('d-none');
    //     $('[name="submit"]').removeClass('confirm');
    //     $('[name="submit"]').val('投稿する');
    //     $('select.triangle-back').removeClass('triangle-back');
    //     $('.step1').css('display','block');
    //     $('.step2').css('display','none');
    //     $('.caption.d-none').removeClass('d-none');
    //     $(window).scrollTop(0);
	// });
});



</script>