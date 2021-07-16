<?php
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8'); //サニタイズ
  }
?>
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
<!----------------------------------一覧画面-------------------------------->
<h2>index.php</h2>

<?php
  require('db_connect.php');

  if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
    $page = $_REQUEST['page'];
  }else{
    $page= 1;
  }
  $start = 5 * ($page - 1);

  $memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5');
  $memos->bindParam(1, $start, PDO::PARAM_INT);
  $memos->execute();
?>
<article>
  <?php while ($memo = $memos->fetch()): ?>
    <p><a href="memo.php?id=<?php h(print($memo['id'])); ?>"><?php h(print(mb_substr($memo['memo'], 0, 50))); ?></a></p>
    <time><?php h(print($memo['created_at'])); ?></time>
    <hr>
  <?php endwhile; ?>


  <!-- pageが2以上のときなので2のときは-1で１が表示される -->
  <?php if($page >= 2) : ?>
    <a href="index.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
  <?php endif ; ?>
  |
  <?php
    $counts = $db->query('SELECT COUNT(*) as cnt FROM memos');// as cnt は別名というやつで cntというキーで取得した件数を取り出すことができ量になる
    $count = $counts->fetch();
    $max_page = ceil($count['cnt'] / 5);//ceilは切り上げる
    if ($page < $max_page):
  ?>

  <a href="index.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
  <?php endif ; ?>
</article>



<!-- // テーブルの追加
//[']["]を分けて書く
// $count = $db->exec('INSERT INTO my_items SET maker_id=1, item_name="もも", price=210, keyword="缶詰,ピンク,甘い"');
// echo $count . '件のデータを挿入しました';

// $records = $db->query('SELECT * FROM my_items');
// while($record = $records->fetch()){
//   print($record['item_name']) . "\n";
// } -->

</main>
</body>
</html>