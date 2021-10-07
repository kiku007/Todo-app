<?php
include('./header.php');
include('./functions.php');
?>

<body class="task_register">
  <div class="wrapper">
    <h1 class="page-title">タスク登録</h1>
    <div class="wrapper-inner">
      <div class="form-wrapper">
        <form action="./task_preview.php" method="post">
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
              <?php foreach ($lists_cat as $list_cat) : ?>
                <option value="<?php echo $list_cat->id; ?>"><?php echo $list_cat->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label for="date">期日</label>
            <input type="date" id="date" name="task-date">
          </div>
          <div class="btn-group">
            <input type="submit" value="戻る" class="btn-common">
            <input type="submit" value="登録" class="btn-common" name="btn_submit">
          </div>
        </form>
      </div><!-- /.form-wrapper -->
    </div><!-- /.wrapper-inner -->
  </div><!-- /.wrapper -->

</body>

</html>