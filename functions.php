<?php

$success_message = null;
$error_messages = [];

include('./config.php');

function getdbAccess() {
  try {
    $pdo = new PDO(
    DSN,
    DB_USER,
    DB_PASS,
    [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
    ]
   );
  return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
  exit;
  }
}

$pdo = getdbAccess();

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function newData($pdo) {

  global $success_message;
  global $error_messages;

  if (!empty($_POST['btn_submit'])) {
    $name = trim(filter_input(INPUT_POST, 'task-name'));
    $description = trim(filter_input(INPUT_POST, 'task-content'));
    $state = 1;
    $category = trim(filter_input(INPUT_POST, 'task-category'));
    $due_date = $_POST['task-date'] ? trim(filter_input(INPUT_POST, 'task-date')) : null;

    if (empty($name)) {
      $error_messages[] = 'タスク名を入力してください。';
    }
    if ($category == 'カテゴリーを選択してください') {
      $error_messages[] = 'カテゴリーを選択してください。';
    }

    if (empty($error_messages)) {
      $pdo->beginTransaction();
      try {
        $stmt = $pdo->prepare("INSERT INTO tasks (name, description, state, category, due_date)
          VALUES (:name, :description, :state, :category, :due_date)");
        $stmt->bindValue('name', $name, \PDO::PARAM_STR);
        $stmt->bindValue('description', $description, \PDO::PARAM_STR);
        $stmt->bindValue('state', $state, \PDO::PARAM_INT);
        $stmt->bindValue('category', $category, \PDO::PARAM_INT);
        $stmt->bindValue('due_date', $due_date, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $pdo->commit();
        if ($res) {
          $success_message = 'タスクを書き込みました。';
        }
      } catch (PDOException $e) {
        $error_messages[] = $e->getMessage();
        $pdo->rollBack();
        exit;
      }
      $stmt = null;
    }
    return [$success_message, $error_messages];
  }
  $pdo = null;
  // header('Location: ./task_preview.php');
  // exit;
}

list($success_message, $error_messages) = newData($pdo);

function upDate_Preview($pdo) {
  if (!empty($_GET['task_id']) && empty($_POST['btn_update'])) {
    try {
      $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
      $stmt->bindValue('id', $_GET['task_id'], \PDO::PARAM_INT);
      $stmt->execute();
      $update_data = $stmt->fetch();
    } catch (PDOException $e) {
      $e->getMessage();
      exit;
    }
    $stmt = null;
    return $update_data;
    $pdo = null;
  }
}

function upDate($pdo) {
  global $success_message;
  global $error_messages;

  if (!empty($_POST['btn_update'])) {
    $name = trim(filter_input(INPUT_POST, 'task-name'));
    $description = trim(filter_input(INPUT_POST, 'task-content'));
    $state = trim(filter_input(INPUT_POST, 'task-state'));
    $category = trim(filter_input(INPUT_POST, 'task-category'));
    $due_date = $_POST['task-date'] ? trim(filter_input(INPUT_POST, 'task-date')) : null;

    if (empty($name)) {
      $error_messages[] = 'タスク名を入力してください。';
    }
    if ($category == 'カテゴリーを選択してください') {
      $error_messages[] = 'カテゴリーを選択してください。';
    }
  
    $pdo->beginTransaction();
  
    try {
      $stmt = $pdo->prepare("UPDATE tasks SET name = :name, description = :description, state = :state, category = :category, due_date = :due_date WHERE id = :id");
      $stmt->bindValue('name', $name, \PDO::PARAM_STR);
      $stmt->bindValue('description', $description, \PDO::PARAM_STR);
      $stmt->bindValue('state', $state, \PDO::PARAM_INT);
      $stmt->bindValue('category', $category, \PDO::PARAM_INT);
      $stmt->bindValue('due_date', $due_date, \PDO::PARAM_STR);
      $stmt->bindValue('id', $_POST['update_id'], \PDO::PARAM_INT);
      $stmt->execute();
      $res = $pdo->commit();
      if ($res) {
        $success_message = 'タスクを編集しました。';
      }
    } catch (PDOException $e) {
      $error_messages[] = $e->getMessage();
      $pdo->rollBack();
      exit;
    }
    $stmt = null;
  }

  return [$success_message, $error_messages];
  
  $pdo = null;
}

list($success_message, $error_messages) = upDate($pdo);

function catRegister($pdo) {

  if (!empty($_POST['btn_cat_submit'])) {
    $cat_name = trim(filter_input(INPUT_POST, 'category-register'));

    if (empty($cat_name)) {
      $error_alert = 'カテゴリー名を入力してください。';
    }

    if (empty($error_alert)) {
      $pdo->beginTransaction();
      try {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (:name)");
        $stmt->bindValue('name', $cat_name, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $pdo->commit();
        if ($res) {
          $success_alert = 'カテゴリーを書き込みました。';
          return $success_alert;
        }
      } catch (PDOException $e) {
        $error_alert = $e->getMessage();
        $pdo->rollBack();
        exit;
      }
      $stmt = null;
    }
    return $error_alert;
  }
  $pdo = null;
}

$cat_message = catRegister($pdo);

function getData($pdo) {
  $stmt = $pdo->query("SELECT * FROM tasks");
  $lists = $stmt->fetchAll();
  return $lists;
}

$lists = getData($pdo);

function getCategory($pdo) {
  $stmt = $pdo->query("SELECT * FROM categories");
  $lists_cat = $stmt->fetchAll();
  return $lists_cat;
}

$lists_cat = getCategory($pdo);

function getDataAll($pdo) {
  $stmt = $pdo->query("SELECT tasks.id AS id, tasks.name AS name, description, state, categories.name AS category, due_date, categories.id AS category_id FROM tasks JOIN categories ON tasks.category = categories.id ORDER BY category DESC");
  $lists_all = $stmt->fetchAll();
  return $lists_all;
}

$lists_all = getDataAll($pdo);