<?php
/**
 * 管理画面内
 * FAQ感想データダウンロードページ（検索結果一覧用）
 */

// クエリなしアクセスを拒否
// if (!$_GET['access_from_admin'] && !$_GET['wp_content_url']) {
//     die;
// }
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>


<!-- ローダー -->
<div id="loader" class="position-fixed w-100 h-100 d-none" style="z-index: 999;">
  <div class="d-flex justify-content-center align-items-center h-100">
    <div class="p-4 rounded bg-info text-center">
      <div class="mt-2 spinner-border text-light" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <p class="mt-3 text-light text-small mb-0">処理中...</p>
    </div>
  </div>
</div>

<div class="admin-data-inquiry p-3">
  <div class="wrap">
    <h1>FAQ検索結果フィードバック</h1>
  </div>

  <div id="search-box">
    <div class="card p-0" style="max-width: 100%;">
      <div class="card-header">
        データダウンロード
      </div>
      <div class="card-body">
        <div id="validate-error" class="alert alert-danger d-none" role="alert"></div>
        <form action="" method="post">
            <div class="row mb-3">
                <div class="col-md-5">
                    <label for="start_date" class="form-label">開始日:</label>
                    <input type="date" id="start_date" class="form-control">
                </div>
                <div class="col-md-5">
                    <label for="end_date" class="form-label">終了日:</label>
                    <input type="date" id="end_date" class="form-control">
                </div>
            </div>
            <div class="me-2 float-end">
                <button id="download" type="button" class="btn btn-primary">
                    <i class="fas fa-download me-1"></i>CSV出力
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
    document.getElementById("download").addEventListener("click", function () {
        let startDate = document.getElementById("start_date").value;
        let endDate = document.getElementById("end_date").value;

        const link = document.createElement("a");
        link.href = `<?php echo site_url(); ?>/wp-admin/api/download_faq_all_resolve_data.php?start_date=${startDate}&end_date=${endDate}`;
        link.download = "faq_all_resolve_summary.csv";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });


</script>