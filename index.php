<?php

session_start();

// CSRF対策
// 1. index.phpが表示されるタイミングで、番号生成
// 2. 生成した番号を画面に埋め込む
// 3. 番号をセッションに保存
// 4. コマンド実行するタイミングで、
// 5. javascriptからphpへmodeと一緒に番号も渡す
// 6. phpは渡された番号とセッショに保存している番号
// 7. 同じであればmodeにしたがって実行します

// echo __DIR__;
// exit;


// echo bin2hex(openssl_random_pseudo_bytes(16));
// exit;

require_once(__DIR__ . '/config.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/Todo.php');
require_once(__DIR__ . '/Token.php');

$todoApp = new \MyAPP\Todo();
$todos = $todoApp->getAll();

// var_dump($todos);
// exit;

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>My Todos</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div id="container">
    <h1>Todos</h1>
    <form action="" id="new_todo_form">
      <input type="text" id="new_todo" placehholder="What needs to be done?">
    </form>
    <ul id="todos">
      <?php foreach( $todos as $todo) : ?>
      <li id="todo_<?php echo h($todo->id); ?>" data-id="<?php echo h($todo->id); ?>">
        <input type="checkbox" class="update_todo" <?php if($todo->state === '1') { echo 'checked'; } ?>>
        <span class="todo_title <?php if($todo->state === '1') { echo 'done'; } ?>"><?php echo h($todo->title); ?></span>
        <div class="delete_todo">x</div>
      </li>
      <?php endforeach; ?>

      <li id="todo_template" date-id="">
        <input type="checkbox" class="update_todo">
        <span class="todo_title"></span>
        <div class="delete_todo">x</div>
      </li>
      
    </ul>
    <input type="hidden" id="token" value="<?php echo h($_SESSION['token']); ?>">
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="todo.js"></script>
</body>
</html>