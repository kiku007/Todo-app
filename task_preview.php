<?php
include('./header.php');
include('./functions.php');
?>

<body class="task_preview">
  <div class="wrapper">
    <?php if (!empty($success_message)) : ?>
      <p class="success"><?php echo $success_message; ?></p>
    <?php endif; ?>

    <?php if (!empty($error_messages)) : ?>
      <ul class="error_message">
        <?php foreach ($error_messages as $error_message) : ?>
          <li><?php echo $error_message; ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <div class="page_header">
      <h1>タスク一覧</h1>
      <div>
        <input type="button" onclick="location.href='./task_preview.php'" value="タスク追加" class="btn-common">
        <input type="button" onclick="location.href='./task_preview.php'" value="カテゴリ" class="btn-common">
      </div>
    </div><!-- /.page_header -->
    <?php foreach ($lists_all as $list) : ?>
      <div class="category-group">
        <h2><?php echo $list->category; ?></h2>
        <div class="wrapper-inner">
          <div class="preview">
            <div class="preview__header">
              <span><?php echo $list->name; ?></span>
              <div class="preview__option">
                <span>状況：
                  <?php if ($list->state == 1) :?>
                    未着手
                  <?php elseif ($list->state == 2) : ?>
                    着手
                  <?php endif; ?>
                </span>
                <span>期日：<?php echo $list->due_date; ?></span>
              </div><!-- /.preview__option -->
            </div><!-- /.preview__header -->
            <div class="preview__content">
              <?php echo $list->description; ?>
            </div><!-- /.preview__content -->
          </div><!-- /.preview -->
        </div><!-- /.wrapper-inner -->
      </div><!-- /.category-group -->
    <?php endforeach; ?>
  </div><!-- /.wrapper -->
</body>

</html>