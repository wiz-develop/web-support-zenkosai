jQuery(function($){
    // コンベンションチケット QRコード表示
    var tm = 1000 * 60 * 5; // 5分（ミリ秒）
    var interval; // setInterval用の変数（QRコード更新）
    var countdownInterval; // setInterval用の変数（カウントダウン）
    var remainingTime = tm / 1000; // 初期値（秒単位）

    let clockValue = {
        status: 'pending',
        offset: 0,
        LOCAL: new Date(),
        LOCAL_STR: '',
        JST: new Date(),
        JST_STR: '',
        UTC: new Date(),
        UTC_STR: '',
        LOC: new Date(),
        LOC_STR: '',
      };

    const serverClock = new WizDevelopServerClock.ServerClock({
      serverUrls: ['https://stg-entrant-seminar.zenko-sai.or.jp/server_time'], // （テスト環境用）時刻配信サーバーのURLリスト
    //   serverUrls: ['https://entrant-seminar.zenko-sai.or.jp/server_time'], // （本番環境用）時刻配信サーバーのURLリスト
      fetchInterval: 300000, // サーバー時間取得間隔(5分)
    });

    serverClock.onTick((data) => {
        clockValue = data;
      });

    // サーバーから取得した日時を元に、時計を開始する
    serverClock.start();

    if ($(".js-img-qr").length) {
        var qrElement = $('#js-member_id_qr');
        var qrId = qrElement.text();
        qrDisplay(qrId);

        // 初回のタイマーセット
        resetTimer();
    }

    // ボタンクリック時にQRコードを更新し、カウントをリセット
    $("#js-qr-update").on("click", function() {
        updateQr();
    });

    // QRコードを表示し、タイマーをリセットする関数
    function updateQr() {
        qrDisplay(qrId);
        resetTimer();
    }

    // タイマーをリセットする関数
    function resetTimer() {
        clearInterval(interval); // 現在のQRコード更新タイマーをクリア
        interval = setInterval(updateQr, tm); // 新しいQRコード更新タイマーをセット
        startCountdown(); // カウントダウンもリセット
    }

    // カウントダウンを開始・リセットする関数
    function startCountdown() {
        clearInterval(countdownInterval); // 既存のカウントダウンをクリア
        remainingTime = tm / 1000; // 5分をセット

        countdownInterval = setInterval(function() {
            remainingTime--;
            var minutes = Math.floor(remainingTime / 60);
            var seconds = remainingTime % 60;
            $("#js-qr-counter").text(minutes + "分" + seconds + "秒");

            if (remainingTime <= 0) {
                clearInterval(countdownInterval); // カウントダウン停止
            }
        }, 1000);
    }

    // QRコードを表示
    function qrDisplay(qrId) {
        qrTime = formatDate(clockValue.UTC);
        var qrData = {"type": "from_hp", "memberId": qrId, "issuedAt": qrTime};
        var qrtext = JSON.stringify(qrData);
        var utf8qrtext = unescape(encodeURIComponent(qrtext));
        $(".js-img-qr").html("");
        $(".js-error-qr").html("");
        $(".js-img-qr").qrcode({text:utf8qrtext});
    }

    function formatDate(timestamp) {
        const date = new Date(timestamp); // タイムスタンプをDateオブジェクトに変換

        const y = date.getFullYear();
        const m = (date.getMonth() + 1).toString().padStart(2, '0');
        const d = date.getDate().toString().padStart(2, '0');
        const h = date.getHours().toString().padStart(2, '0');
        const min = date.getMinutes().toString().padStart(2, '0');
        const s = date.getSeconds().toString().padStart(2, '0');

        return `${y}-${m}-${d} ${h}:${min}:${s}`;
    }
});