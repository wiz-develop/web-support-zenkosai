<?php
/*
 * Template Name: コンベンション QRコードページ
 */
get_header(); ?>

<div id="archive-info-convention" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
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
    <div class="page-content-wrapper mt-4">
        <div class="container">
            <div class="page-content-innerwrap">
            <?php
                $member_id = $_SESSION['member_info']['member_id'];
                $member_name = $_SESSION['member_info']['member_name'];

                global $wpdb;
                $member_data = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."ticket_members WHERE member_id = '".$member_id."'");

                if (!empty($member_data[0])) :
                    $seat_number = $member_data[0]->seat_number;
                    $venue = $member_data[0]->venue;

                    if ($seat_number) {
                        $seat_data = parseSeatData($seat_number, $venue);
                        $reception = $seat_data['reception'];
                        $area_name = $seat_data['area_name'];
                        $gate_name = $seat_data['gate_name'];
                        $seat_name = $seat_data['seat_name'];
                    } else {
                        $reception = $member_data[0]->reception;
                        $area_name = $member_data[0]->area_name;
                        $gate_name = $member_data[0]->gate_name;
                        $seat_name = $member_data[0]->seat_name;
                    }

                    $reception_class = '';
                    $rec_lower = mb_strtolower($reception);
                    
                    // 受付場所の色分け判定（部分一致で確実に拾う）
                    if (strpos($reception, '車いす') !== false) {
                        // 【追加】車いす対応受付：白背景に赤字
                        $reception_class = 'bg-white text-red border-transparent fw-bold';
                    } elseif (strpos($rec_lower, 'アリーナ受付') !== false || strpos($rec_lower, 'infosys') !== false) {
                        $reception_class = 'border bg-red text-white';
                    } elseif (strpos($rec_lower, '北受付') !== false || strpos($rec_lower, 'micware') !== false) {
                        $reception_class = 'border bg-white text-dark';
                    } elseif (strpos($rec_lower, '南受付') !== false || strpos($rec_lower, 'tottei') !== false) {
                        $reception_class = 'bg-dark text-white';
                    }

                    $area_class = '';
                    $area_style = '';
                    switch ($area_name) {
                        case 'A': $area_class = 'area-a text-white fw-bold'; $area_style = 'background-color:rgb(7,209,74);'; break;
                        case 'B': $area_class = 'area-b text-white fw-bold'; $area_style = 'background-color:rgb(255,26,244);'; break;
                        case 'C': $area_class = 'area-c text-white fw-bold'; $area_style = 'background-color:rgb(8,145,249);'; break;
                        case 'D': $area_class = 'area-d text-white fw-bold'; $area_style = 'background-color:rgb(255,140,26);'; break;
                        case 'E': $area_class = 'area-e text-white fw-bold'; $area_style = 'background-color:rgb(139,29,255);'; break;
                        case 'アリーナ': $area_class = 'area-arena text-white fw-bold'; $area_style = 'background-color:rgb(0,68,113);'; break;
                        case '1番扉': $area_class = 'text-black fw-bold'; $area_style = 'background-color:#FFE699;'; break;
                        case '2番扉': $area_class = 'text-black fw-bold'; $area_style = 'background-color:#BDD7EE;'; break;
                        case '3番扉': $area_class = 'text-black fw-bold'; $area_style = 'background-color:#F5D9FB;'; break;
                        case '4番扉': $area_class = 'text-black fw-bold'; $area_style = 'background-color:#C5E0B4;'; break;
                        case '5番扉': $area_class = 'text-white fw-bold'; $area_style = 'background-color:#66158F;'; break;
                }
            ?>
                    <div class="qr-wrap">
                        <?php
                            if (!empty($post->post_content)) {
                                echo '<div class="my-3">'.the_content().'</div>';
                            }
                        ?>
                        <div class="js-img-qr text-center js-img-qr text-center px-3 py-3"></div>
                        <div class="js-error-qr text-center"></div>
                        <div id="js-member_id_qr" class="d-none"><?php echo substr($member_id, -8, 8); ?></div>
                        <p class="text-center mb-0">更新まで あと<span id="js-qr-counter"></span></p>
                        <button id="js-qr-update" class="qr-update-btn d-block text-white mx-auto rounded-pill"><i class="fas fa-redo-alt"></i> コード更新</button>
                        <p class="mt-3 mb-0 text-center">
                            <span class="text-danger">※スクリーンショットではご入場いただけません※​</span>
                            <br>受付時に上のコードをご提示ください。​
                            <br>安全確保と不正入場防止のため、コードは定期的に更新されます。
                        </p>
                    </div>
                    <div class="ticket mt-2">
                        <!-- <div class="ticket__header">
                            <span>2025 National Convention</span>
                        </div> -->
                        <div class="ticket__body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>開催日</td>
                                        <td>2026年4月15日(水)</td>
                                    </tr>
                                    <tr>
                                        <td>会場</td>
                                        <td><font color="red"><b><?php echo nl2br(esc_html($venue)); ?></b></font></td>
                                    </tr>
                                    <tr>
                                        <td>開場(受付)</td>
                                        <?php if($is_arena = (preg_match('/(GLION|アリーナ)/u', $venue))): ?>
                                        <td>11:30</td>
                                        <?php else: ?>
                                        <td>12:00</td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>開演</td>
                                        <td>13:00</td>
                                    </tr>
                                    <tr>
                                        <td>受付場所</td>
                                        <td class="<?php echo $reception_class; ?>">
                                            <?php echo $reception; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php if($is_arena = (preg_match('/(GLION|アリーナ)/u', $venue))): ?>
                                        <td>扉番号</td>
                                        <?php else: ?>
                                        <td>階</td>
                                        <?php endif; ?>
                                        <td><?php echo $gate_name; ?></td>
                                    </tr>
                                    <tr>
                                        <?php if($is_arena = (preg_match('/(GLION|アリーナ)/u', $venue))): ?>
                                        <td>エリア</td>
                                        <?php else: ?>
                                        <td>扉番号</td>
                                        <?php endif; ?>
                                        <td class="<?php echo $area_class; ?>" style="<?php echo $area_style; ?>">
                                            <?php echo $area_name; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>列・席番号</td>
                                        <td><?php echo $seat_name; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php if ($cfs->get('pdf_note')) : ?>
                        <div class="ticket ticket-note mb-5 px-4 py-3 text-center">
                            <h3 class="text-center mb-2">必ずご確認ください。​</h3>
                            <div class="ticket-note__content text-left"><?php echo $cfs->get('pdf_note'); ?></div>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <p class="text-center"><?php echo $cfs->get('non_purchasers_comment'); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
function parseSeatData($seat_code, $venue) {
    $res = [
        'reception' => '',
        'gate_name' => '',
        'area_name' => '',
        'seat_name' => ''
    ];

    if (empty($seat_code)) return $res;
    $seat_code = trim($seat_code);

    $is_arena = (preg_match('/(GLION|アリーナ)/u', $venue));
    $is_kokusai = (preg_match('/(国際会館|こくさい)/u', $venue));

    // --- 【1】ジーライオンアリーナ神戸 ---
    if ($is_arena) {
        $rec_key = mb_substr($seat_code, 0, 1);
        $rec_map = [
            'R' => 'アリーナ受付<br>(infosys GATE)',
            'N' => '北受付<br>(micware GATE)',
            'S' => '南受付<br>(TOTTEI PARK GATE)',
            '経' => '経営戦略会議メンバー受付',
            'ダ' => 'ダイヤモンドクラブメンバー受付'
        ];
        $res['reception'] = $rec_map[$rec_key] ?? '';

        if (strpos($seat_code, 'WC') !== false) {
            $res['reception'] = '車いす対応席受付';
            $res['seat_name'] = '車いす対応席';
        } else {
            if ($rec_key !== '経' && $rec_key !== 'ダ') {
                $res['gate_name'] = mb_substr($seat_code, 1, 3); 
                $area_val = mb_substr($seat_code, 4, 1);         
                $res['area_name'] = ($area_val === 'R') ? 'アリーナ' : $area_val;
            
            }

            $row_p = mb_substr($seat_code, 5, 1);
            $row_prefix_map = ['N' => '北', 'W' => '西', 'S' => '南', 'R' => ''];
            $row_label = $row_prefix_map[$row_p] ?? '';

            $row_n = mb_substr($seat_code, 6, 2);    

            if (preg_match('/[^0-9]/', $row_n)) {
                $row_num_display = mb_substr($row_n, 0, 1);
            } else {
                $row_num_display = $row_n;
            }

            $seat_n = mb_substr($seat_code, 8);              

            $res['seat_name'] = $row_label . $row_num_display . "列 " . $seat_n . "番";
        }
    }
    // --- 【2】神戸国際会館 こくさいホール ---
    elseif ($is_kokusai) {
        $res['reception'] = '2Fエントランス';
        if (strpos($seat_code, 'W') !== false) {
            $res['seat_name'] = '車いす対応席';
        } else {
            $floor_key = mb_substr($seat_code, 0, 2);
            $floor_map = ['01' => '1階席', '22' => '中2階席', '02' => '2階席', '03' => '3階席'];
            $res['gate_name'] = $floor_map[$floor_key] ?? (int)$floor_key . '階席';
            $res['area_name'] = mb_substr($seat_code, 2, 1) . '番扉';
            
            $row_raw = mb_substr($seat_code, 3, 2);
            $row_val = (ctype_digit($row_raw)) ? (int)$row_raw : mb_substr($row_raw, 0, 1);
            $num_val = (int)mb_substr($seat_code, 5, 2);
            $res['seat_name'] = $row_val . "列 " . $num_val . "番";
        }
    }

    return $res;
}

get_footer(); ?>
<style>
    body {
        touch-action: pan-x pan-y;
    }
    @page { size: A4 }
    @media print {
        header, .page-header, .siteFooter, #ticket-print-btn, .raino-faq, #wpfront-scroll-top-container {
            display: none !important;
        }
        #img-qr {
            max-width: 3cm;
            max-height: 3cm;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 2rem;
        }
    }
    .border-red {
        border: 2px solid red !important;
    }
    .text-red {
        color: red !important;
    }
    .bg-red {
        background-color: red !important;
    }
    .border-transparent {
        border: 2px solid transparent !important;
    }
</style>
<script type="text/JavaScript"> 
    jQuery(function($){ 
        // var qrElement = $('#member_id_qr');
        // var qrtext = qrElement.text();
        // var utf8qrtext = unescape(encodeURIComponent(qrtext));
        // $("#img-qr").html("");
        // $("#img-qr").qrcode({text:utf8qrtext});

        $('#ticket-print-btn').on('click', function() {
            $(this).css('pointer-events', 'none');
            window.print();
            $(this).css('pointer-events', 'auto');
        });

        document.addEventListener("touchmove", (e) => {
        if (e.touches.length > 1) {
            e.preventDefault();
        }
        }, { passive: false });

        document.addEventListener("gesturestart", (e) => {
        e.preventDefault();
        });
    });
</script>