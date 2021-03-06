<?php
include('./header.php');
include('./functions.php');
if (count($lists_all) == 0) : ?>

  <body class="task_preview">
    <div class="wrapper">
      <div class="page_header">
        <h1>タスクが登録されてません。</h1>
        <div>
          <input type="button" onclick="location.href='./task_register.php'" value="タスク追加" class="btn-common">
          <input type="button" onclick="location.href='./category_manage.php'" value="カテゴリ" class="btn-common">
        </div>
      </div><!-- /.page_header -->
    <?php else : ?>

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

          <?php if (!empty($cat_message)) : ?>
            <p class="success"><?php echo $cat_message; ?></p>
          <?php endif; ?>

          <div class="page_header">
            <h1>タスク一覧</h1>
            <div>
              <input type="button" onclick="location.href='./top.php'" value="TOPへ" class="btn-common">
              <input type="button" onclick="location.href='./task_register.php'" value="タスク追加" class="btn-common">
              <input type="button" onclick="location.href='./category_manage.php'" value="カテゴリ" class="btn-common">
            </div>
          </div><!-- /.page_header -->
          <?php foreach ($lists_all as $list) : ?>
            <div class="category-group <?php echo 'category' . h($list->category_id); ?>">
              <h2><?php echo h($list->category); ?></h2>
              <div class="wrapper-inner">
                <div class="preview">
                  <a href="./task_edit.php?task_id=<?php echo $list->id; ?>">
                    <div class="preview__header">
                      <span><?php echo h($list->name); ?></span>
                      <div class="preview__option">
                        <span>状況：
                          <?php if ($list->state == 1) : ?>
                            未着手
                          <?php elseif ($list->state == 2) : ?>
                            着手
                          <?php elseif ($list->state == 9) : ?>
                            完了
                          <?php endif; ?>
                        </span>
                        <span>期日：<?php echo h($list->due_date); ?></span>
                      </div><!-- /.preview__option -->
                    </div><!-- /.preview__header -->
                    <div class="preview__content">
                      <?php echo nl2br($list->description); ?>
                    </div><!-- /.preview__content -->
                  </a>
                </div><!-- /.preview -->
              </div><!-- /.wrapper-inner -->
            </div><!-- /.category-group -->
          <?php endforeach; ?>
        </div><!-- /.wrapper -->
        <script src="./main.js"></script>
      </body>
    <?php endif; ?>

    </html>