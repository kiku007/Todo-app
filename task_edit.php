<?php
include('./header.php');
?>

<body class="task_edit">
  <div class="wrapper">
    <h1 class="page-title">タスク編集</h1>
    <div class="wrapper-inner">
      <div class="form-wrapper">
        <form action="/form.php" method="post">
          <div>
            <label for="name">タスク名称</label>
            <input type="text" id="name" name="task-name">
          </div>
          <div>
            <label for="content">内容</label>
            <textarea id="content" name="task-content"></textarea>
          </div>
          <div>
            <label>カテゴリー</label>
            <select name="task-category">
              <option>カテゴリーを選択してください</option>
              <option value="サンプル1">サンプル1</option>
              <option value="サンプル2">サンプル2</option>
              <option value="サンプル3">サンプル3</option>
            </select>
          </div>
          <div>
            <label for="date">期日</label>
            <input type="date" id="date" name="task-date">
          </div>
          <div>
            <label>状況</label>
            <select name="task-state">
              <option>カテゴリーを選択してください</option>
              <option value="未着手">未着手</option>
              <option value="着手">着手</option>
              <option value="完了">完了</option>
            </select>
          </div>
          <div class="btn-group">
            <input type="button" onclick="location.href='./task_preview.php'" value="戻る" class="btn-common">
            <input type="button" onclick="location.href='./task_preview.php'" value="登録" class="btn-common">
          </div>
        </form>
      </div><!-- /.form-wrapper -->
    </div><!-- /.wrapper-inner -->

  </div><!-- /.wrapper -->



</body>

</html>