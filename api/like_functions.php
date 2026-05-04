<?php
session_start();
require_once('/var/www/html/cms/wp-load.php');

function get_member_id()
{
    return isset($_SESSION['member_info']['member_id']) ? intval($_SESSION['member_info']['member_id']) : null;
}

function like_page()
{
    global $wpdb;

    $member_id = get_member_id();

    if (!$member_id) {
        echo json_encode(['error' => 'ログインしてください']);
        return;
    }

    $raw_input = file_get_contents('php://input');
    $data = json_decode($raw_input, true);

    $member_id = get_member_id();
    $book_id = isset($data['book_id']) ? intval($data['book_id']) : null;
    $page_id = isset($data['page_id']) ? intval($data['page_id']) : null;

    if (!$page_id || !$book_id) {
        echo json_encode(['error' => '無効なリクエスト']);
        return;
    }

    $table_name = $wpdb->prefix . 'likes';

    $liked = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE member_id = %d AND page_id = %d AND book_id = %d", $member_id, $page_id, $book_id));
    if ($liked) {
        $wpdb->delete($table_name, ['member_id' => $member_id, 'page_id' => $page_id, 'book_id' => $book_id]);
        echo json_encode(['success' => true, 'liked' => false]);
    } else {
        $wpdb->insert($table_name, ['member_id' => $member_id, 'page_id' => $page_id, 'book_id' => $book_id]);
        echo json_encode(['success' => true, 'liked' => true]);
    }
    exit;
}

function get_liked_pages()
{
    global $wpdb;

    // JSON形式のリクエストボディを取得
    $raw_input = file_get_contents('php://input');
    $data = json_decode($raw_input, true);

    $member_id = get_member_id();
    $book_id = isset($data['book_id']) ? intval($data['book_id']) : null;

    if (!$member_id) {
        echo json_encode(['error' => 'ログインしてください']);
        return;
    }

    if (!$book_id) {
        echo json_encode(['error' => '無効なリクエスト']);
        return;
    }

    $table_name = $wpdb->prefix . 'likes';

    $likes = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE member_id = %d AND book_id = %d AND deleted_at IS NULL", $member_id, $book_id));

    echo json_encode(['success' => true, 'likes' => $likes]);
    exit;
}

// JSON形式のリクエストボディを取得
$raw_input = file_get_contents('php://input');
$data = json_decode($raw_input, true);

// 変数の取得
$action = isset($data['action']) ? $data['action'] : null;

if ($action === 'like_page') {
    like_page();
} elseif ($action === 'get_liked_pages') {
    get_liked_pages();
} else {
    echo json_encode(['success' => false, 'message' => '無効なアクション']);
    exit;
}
