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
<!----------------------------------DB登録実行画面-------------------------------->
<h2>update_do.php</h2>
<pre>
  <?php
    require('db_connect.php');

    if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])){
      $id = $_REQUEST['id'];
      $statement = $db->prepare('DELETE FROM memos WHERE id=?');
      $statement->execute(array($id));
    }
    ?>
    <p>メモを削除しました</p>
  </pre>
  <p><a href="index.php">戻る</a></p>
</main>
</body>
</html>