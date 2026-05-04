<?php
    require_once('/var/www/html/cms/wp-load.php');
    header('Content-Type: application/json; charset=UTF-8');

    // 取得したAPIキー
    $api_key = 'AIzaSyAG1YvS_3yHgoSNF5RBJVyKPdFQg6hfWpo';
    // カレンダーID
    $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');  // Googleの提供する日本の祝日カレンダー
    // 取得する期間
    $start = date("Y-m-1\T00:00:00\Z");
    $end = date('Y-m-t\T23:59:59\Z', strtotime('+2 month')); // 3ヶ月後の末日
    // $end = date('Y-m-1\T00:00:00\Z', strtotime('+1 year -1 day')); // 1年後の末日（動作確認用）

    $url = "https://www.googleapis.com/calendar/v3/calendars/" . $calendar_id . "/events?";
    $query = [
        'key' => $api_key,
        'timeMin' => $start,
        'timeMax' => $end,
        'maxResults' => 50,
        'orderBy' => 'startTime',
        'singleEvents' => 'true'
    ];

    $results = [];
    $json = @file_get_contents($url . http_build_query($query));
    if ($json !== false) {
    $data = json_decode($json);
    if (isset($data->items) && is_array($data->items)) {

        // 除外リスト（任意）
        $exclude_days        = ["七五三", "クリスマス", "節分", "雛祭り", "母の日", "七夕"];
        $exclude_by_monthday = ['12-31', '01-03']; // 例：月日で除外したい場合

        foreach ($data->items as $item) {
        // 終日予定は start->date に YYYY-MM-DD で入る
        $date = $item->start->date ?? null;
        if (!$date) continue;

        // 任意の除外
        $summary = $item->summary ?? '';
        if (in_array($summary, $exclude_days, true)) continue;

        $md = substr($date, 5, 5); // 'MM-DD'
        if (in_array($md, $exclude_by_monthday, true)) continue;

        $results[$date] = $summary;
        }
    }
    }
    echo json_encode($results, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
?>