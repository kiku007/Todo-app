<?php

$success_message = null;
$error_messages = [];

define('DSN', 'mysql:host=localhost;dbname=taskdb;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'root');

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
    ]
   );
  return $pdo;
  } catch (PDOException $e) {
    echo $e->getMessage();
  exit;
  }
}

$pdo = getdbAccess();

function newData($pdo) {

  global $success_message;
  global $error_messages;

  if (!empty($_POST['btn_submit'])) {
    $name = trim(filter_input(INPUT_POST, 'task-name'));
    $description = trim(filter_input(INPUT_POST, 'task-content'));
    $state = 1;
    $category = trim(filter_input(INPUT_POST, 'task-category'));
    $due_date = trim(filter_input(INPUT_POST, 'task-date'));

    if (empty($_POST['task-name'])) {
      $error_messages[] = 'タスク名を入力してください。';
    }
    if (empty($_POST['task-content'])) {
      $error_messages[] = 'タスク内容を入力してください。';
    }
    if ($_POST['task-category'] == 'カテゴリーを選択してください') {
      $error_messages[] = 'カテゴリーを選択してください。';
    }
    if (empty($_POST['task-date'])) {
      $error_messages[] = '日付を選択してください。';
    }

    if (empty($error_messages)) {
      $stmt = $pdo->prepare("INSERT INTO tasks (name, description, state, category, due_date)
        VALUES (:name, :description, :state, :category, :due_date)");
      $stmt->bindValue('name', $name, \PDO::PARAM_STR);
      $stmt->bindValue('description', $description, \PDO::PARAM_STR);
      $stmt->bindValue('state', $state, \PDO::PARAM_INT);
      $stmt->bindValue('category', $category, \PDO::PARAM_INT);
      $stmt->bindValue('due_date', $due_date, \PDO::PARAM_STR);
      $res = $stmt->execute();
      if ($res) {
        $success_message = 'タスクを書き込みました。';
      }
      // $error_message[] = '';
      // header('Location: ./task_preview.php');
    // } else {
    //   $success_message = '';
    }
    return [$success_message, $error_messages];
  }

}

list($success_message, $error_messages) = newData($pdo);


function upDate($pdo) {
  $description = '更新版！';
  $id = 11;
  $stmt = $pdo->prepare("UPDATE tasks SET description = :description WHERE id = :id");
  $stmt->bindValue('description', $description, \PDO::PARAM_STR);
  $stmt->bindValue('id', $id, \PDO::PARAM_INT);
  $stmt->execute();
}

// upDate($pdo);

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
  $stmt = $pdo->query("SELECT tasks.name AS name, description, state, categories.name AS category, due_date FROM tasks JOIN categories ON tasks.category = categories.id");
  $lists_all = $stmt->fetchAll();
  return $lists_all;
}

$lists_all = getDataAll($pdo);