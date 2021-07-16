<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>
</header>

<main>
<!----------------------------------詳細画面作成-------------------------------->
<h2>memo.php</h2>

<?php
  require('db_connect.php');

  $id = $_REQUEST['id'];
  if(!is_numeric($id) || $id <= 0){
    print('１以上の数字で指定してください');
    exit();
  }

  //$_REQUESTで URLパラメーターを渡す。GETでもいいけど念の為POSTを使うときのためにREQUESTをつかう
  //（れっすんで中内さんが言ってたやつだな）
  $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
  $memos->execute(array($id));
  $memo = $memos->fetch();

  ?>
  <article>
    <!-- 画面に表示 -->
    <pre><?php print($memo['memo']); ?></pre>
    <!-- printを使っているのはurlに文字として表示するため -->
    <a href="update.php?id=<?php print($memo ['id']); ?>">編集する</a>
    |
    <a href="delete.php?id=<?php print($memo ['id']); ?>">削除する</a>
    |
    <a href="index.php">戻る</a>
  </article>
</main>
</body>
</html>