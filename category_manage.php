<?php
include('./header.php');
?>

<body class="category_manage">
  <div class="wrapper">
    <h1 class="page-title">カテゴリー管理画面</h1>
    <div class="wrapper-inner">
      <div class="form-wrapper form-category">
        <div>
          <p>テストテストテストテストテストテストテスト</p>
        </div>
        <div>
          <form action="/form.php" method="post">
            <input type="submit" name="category-delete" value="削除">
            <input type="hidden" id="">
          </form>
        </div>
      </div><!-- /.form-wrapper -->
      <div class="form-wrapper form-category">
        <div>
          <p>テストテストテストテストテストテストテスト</p>
        </div>
        <div>
          <form action="/form.php" method="post" class="form-wrapper form-category">
            <input type="submit" name="category-delete" value="削除">
            <input type="hidden" id="">
          </form>
        </div>
      </div><!-- /.form-wrapper -->
      <div class="form-wrapper category-register">
        <form action="/form.php" method="post">
          <div>
            <input type="text" name="category-register">
            <input type="submit" value="登録">
          </div>
        </form>
      </div><!-- /.form-wrapper -->
      <div class="btn-group">
        <input type="button" onclick="location.href='./task_preview.php'" value="戻る" class="btn-common">
      </div>
      </form>
    </div><!-- /.wrapper-inner -->

  </div><!-- /.wrapper -->



</body>

</html>