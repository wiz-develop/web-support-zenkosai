<?php
function is_already_read($post_id) {
    // WordPress を読み込むパスは環境によって変わるので注意
    require_once('/var/www/html/cms/wp-load.php');
    global $wpdb;

    // セッション開始（未開始なら開始）
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 型安全にキャスト
    $post_id = intval($post_id);

    // ログイン必須チェック
    if (!isset($_SESSION['member_info']) || empty($_SESSION['member_info']['member_id'])) {
        // ログイン前は表示制御のためのチェックのみ行って早期終了（元コードの挙動を維持）
        $terms = get_the_terms($post_id, 'news');
        if ($terms && !is_wp_error($terms)) {
            $term_id = intval($terms[0]->term_id);
            $attatchment = get_term_by('slug','attatchment','news');
            $business    = get_term_by('slug','business','news');
            $campaign    = get_term_by('slug','campaign','news');
            $attatchment_id = $attatchment ? intval($attatchment->term_id) : 0;
            $business_id    = $business ? intval($business->term_id) : 0;
            $campaign_id    = $campaign ? intval($campaign->term_id) : 0;

            $restriction_information = CFS()->get('restriction_information');

            if ($term_id === $attatchment_id || $term_id === $business_id || $term_id === $campaign_id || $restriction_information === 1) {
                wp_redirect(home_url('/'));
                exit;
            }
        }
        return;
    }

    $member_id = intval($_SESSION['member_info']['member_id']);

    // 既読判定（prepare を使う）
    $row = $wpdb->get_var( $wpdb->prepare(
        "SELECT post_id FROM {$wpdb->prefix}read WHERE is_read = 1 AND member_id = %d AND post_id = %d",
        $member_id,
        $post_id
    ) );

    // 既読なら何もしない
    if (!empty($row)) {
        return;
    }

    // wp_insert 用に安全に挿入
    $insert_data = [
        'member_id' => $member_id,
        'post_id'   => $post_id,
        'read_date' => current_time('mysql'),
        'is_read'   => 1,
    ];
    $insert_format = ['%d','%d','%s','%d'];
    $table_name = $wpdb->prefix . 'read';
    $wpdb->insert($table_name, $insert_data, $insert_format);
    delete_transient('unread_array_' . $member_id);
    delete_transient('unread_counts_all_' . $member_id);
    delete_transient('unread_important_counts_' . $member_id);

    // --------------------------------------------------------------------
    // セッション側の未読リストを更新（ここで使用するキー名をプロジェクト標準に合わせる）
    // --------------------------------------------------------------------
    // 多くのテンプレ側コードが $_SESSION['is_unread'] を参照しているため、
    // ここでも is_unread を更新するように統一します。
    if (!isset($_SESSION['is_unread']) || !is_array($_SESSION['is_unread'])) {
        $_SESSION['is_unread'] = [];
    }

    // 未読リストから現在の post_id を除外する（存在すれば）
    $_SESSION['is_unread'] = array_values(array_diff($_SESSION['is_unread'], [$post_id]));

    // 互換のため、もし他のコードが is_read を参照しているならそちらも更新しておく（安全対策）
    // 既存コードでは is_read に未読リストが入っていたような扱いが見られたため、合わせて反映
    $_SESSION['is_read'] = $_SESSION['is_unread'];

    // 明示的なセッション書き込みと終了
    session_write_close();
    return;
}
?>
