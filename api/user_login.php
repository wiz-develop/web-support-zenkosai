<?php
    function my_user_login() {
        if ( ! defined('ABSPATH') ) {
            require_once('/var/www/html/cms/wp-load.php');
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['logout_info'])) {
            unset($_SESSION['logout_info']);
        }

        global $wpdb;
        global $mypage_directori;

        $raw_user_name = isset($_POST['user_name']) ? trim($_POST['user_name']) : null;
        $raw_user_pass = isset($_POST['user_pass']) ? trim($_POST['user_pass']) : null;
        $referer = isset($_POST['referer']) ? trim($_POST['referer']) : ($_SERVER['HTTP_REFERER'] ?? '');

        $user_name = $raw_user_name;
        if ($user_name !== null && $user_name !== '') {
            if (ctype_digit($user_name)) {
                $user_name = sprintf('%012d', $user_name);
            } else {
                $user_name = $raw_user_name;
            }
        } else {
            $user_name = null;
        }

        $user_pass = $raw_user_pass !== '' ? $raw_user_pass : null;

        $infoshown = [
            'user_name' => $raw_user_name,
            'user_pass' => $raw_user_pass,
            'message'   => null,
            'flag'      => null,
        ];

        if ($user_name === null || $user_pass === null) {
            $infoshown['message'] = '情報が不足しています。';
            $flag = [];
            if ($user_name === null) {
                $flag[] = 1;
            }
            if ($user_pass === null) {
                $flag[] = 2;
            }
            $infoshown['flag'] = $flag;
            return $infoshown;
        }

        $password = 'ZenkosaiOpenSSLEncrypt';
        $en_user_name = _encrypt($user_name, $password);
        $en_user_pass = _encrypt($user_pass, $password);

        $if_success = login_action($en_user_name, $en_user_pass);

        if ($if_success === 'success') {
            $user_data = $_SESSION['member_info'] ?? [];

            $infoshown['login_success'] = true;
            $infoshown['user_data'] = $user_data;

            $redirect_to = null;
            if (!empty($_SESSION['redirect_after_login'])) {
                $redirect_to = wp_validate_redirect($_SESSION['redirect_after_login'], home_url('/'));
                unset($_SESSION['redirect_after_login']);
            }

            if ($redirect_to === null && function_exists('CFS')) {
                $restrict_value = CFS()->get('restrict_page');
                if (!empty($restrict_value) && !empty($referer)) {
                    if (is_numeric($restrict_value)) {
                        $restrict_url = get_permalink(intval($restrict_value));
                    } else {
                        if (strpos($restrict_value, 'http://') === 0 || strpos($restrict_value, 'https://') === 0) {
                            $restrict_url = $restrict_value;
                        } else {
                            $restrict_url = home_url('/' . ltrim($restrict_value, '/'));
                        }
                    }
                    if (!empty($restrict_url) && strpos($referer, $restrict_url) !== false) {
                        $redirect_to = wp_validate_redirect($restrict_url, home_url('/'));
                    }
                }
            }

            if ($redirect_to === null) {
                $member_status = $user_data['member_status'] ?? null;
                $deficient_reason = $user_data['deficient_reason'] ?? null;

                if ($member_status == 1 && $deficient_reason == 25) {
                    $redirect_to = home_url('/deficient');
                } elseif ($referer !== '' && strpos($referer, 'regist') !== false) {
                    $redirect_to = home_url('/introduce');
                } elseif ($referer !== '' && strpos($referer, 'server-monitoring') !== false) {
                    $redirect_to = null;
                } elseif ($referer !== '' && strpos($referer, 'lifesupport_cat') !== false) {
                    $path = parse_url($referer, PHP_URL_PATH) ?: '';
                    $uri = basename(rtrim($path, '/'));
                    $uri = rawurlencode($uri);
                    $redirect_to = home_url('/lifesupport/#' . $uri);
                } elseif ($referer !== '' && strpos($referer, 'zenko-sai') !== false) {
                    $redirect_to = wp_validate_redirect($referer, home_url('/'));
                } else {
                    $redirect_to = home_url('/');
                }
            }

            $infoshown['redirect_to'] = $redirect_to;
            return $infoshown;
        } else {
            // 失敗時
            $infoshown['message'] = (string)$if_success;
            $flag = [];
            $flag[] = 1;
            $flag[] = 2;
            $infoshown['flag'] = $flag;
            return $infoshown;
        }
    }
?>