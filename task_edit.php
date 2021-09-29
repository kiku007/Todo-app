<?php
include('./header.php');
include('./functions.php');

$update_data = upDate_Preview($pdo);
var_dump($update_data);
?>

<body class="task_edit">
  <div class="wrapper">
    <h1 class="page-title">タスク編集</h1>
    <div class="wrapper-inner">
      <div class="form-wrapper">
        <form action="./task_preview.php" method="post">
          <div>
            <label for="name">タスク名称</label>
            <input type="text" id="name" name="task-name" value="<?php if (!empty($update_data->name)) {echo $update_data->name;} ?>">
          </div>
          <div>
            <label for="content">内容</label>
            <textarea id="content" name="task-content"><?php if (!empty($update_data->description)) {echo $update_data->description;} ?></textarea>
          </div>
          <div>
            <label>カテゴリー</label>
            <select name="task-category">
              <option>カテゴリーを選択してください</option>
              <?php foreach ($lists_cat as $list_cat) : ?>
                <option value="<?php echo $list_cat->id; ?>" <?php if ($update_data->category == $list_cat->id) {echo 'selected';} ?>>
                <?php echo $list_cat->name; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label for="date">期日</label>
            <input type="date" id="date" name="task-date" value="<?php if (!empty($update_data->due_date)) {echo $update_data->due_date;} ?>">
          </div>
          <div>
            <label>状況</label>
            <select name="task-state">
              <option>カテゴリーを選択してください</option>
              <option value="1" <?php if ($update_data->state == 1) {echo 'selected';} ?>>未着手</option>
              <option value="2" <?php if ($update_data->state == 2) {echo 'selected';} ?>>着手</option>
              <option value="9" <?php if ($update_data->state == 9) {echo 'selected';} ?>>完了</option>
            </select>
          </div>
          <div class="btn-group">
            <input type="submit" value="戻る" class="btn-common">
            <input type="submit" value="保存" class="btn-common" name="btn_update">
            <input type="hidden" name="update_id" value="<?php if (!empty($update_data->id)) {echo $update_data->id;} ?>">
          </div>
        </form>
      </div><!-- /.form-wrapper -->
    </div><!-- /.wrapper-inner -->

  </div><!-- /.wrapper -->



</body>

</html>