<?php require('dbconnect.php');?>
<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>メモ帳</title>
</head>
<body>
<header>
    <h1 class="font-weight-normal">メモ一覧</h1><hr>
    <?php
    if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])) {
        $page = $_REQUEST['page'];
    } else {
        $page = 1;
    }
    $start = 5 * ($page - 1);
    $memos = $db->prepare('SELECT * FROM memos ORDER BY id LIMIT ?,10');
    $memos->bindParam(1, $start, PDO::PARAM_INT);
    $ret = $memos->execute();
    ?>
    <article>
    <?php while($memo = $memos->fetch()): ?>
    <span><a href="memo.php?id=<?php print($memo['id']); ?>"><?php print(mb_substr($memo['memo'], 0, 20)); ?><?php print((mb_strlen($memo['memo'])) > 50 ? '...' : ''); ?></a></span>
    <hr>
    <?php endwhile; ?>

    <?php if ($page >= 2): ?>
      <a href="index.php?page=<?php print($page-1); ?>"><?php print($page-1); ?>ページ目へ</a>
    <?php endif; ?>
     |
    <?php
    $counts = $db->query('SELECT COUNT(*) as cnt FROM memos');
    $count = $counts->fetch();
    $max_page = floor($count['cnt'] / 5) + 1;
    if ($page < $max_page and $page != $max_page - 1):
    ?>
      <a href="index.php?page=<?php print($page+1); ?>"><?php print($page+1); ?>ページ目へ</a>
    <?php endif; ?>
    </article>
</header>

<main>
    <h2>削除</h2>
    <?php
        if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])){
            $id = $_REQUEST['id']; 
            $statement = $db->prepare('delete from memos where id=?');
            $statement->execute(array($id));
        }
    ?>
    <pre>
    <p>メモを削除しました</p>
    </pre>
    <p><a href="index.php">戻る</a></p>
</main>
</body>
</html>
