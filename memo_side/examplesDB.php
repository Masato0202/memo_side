<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>よくわかるPHPの教科書</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">よくわかるPHPの教科書</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
<?php
/* ここにからPHPプログラム*/
    try{
        $db = new PDO("mysql:dbname=mydb;host=127.0.0.1;charset=utf8","root","");
    }catch(PDOException $e){
        echo "DB接続エラー:".$e->getMessage();
    }
    /*DB挿入
    $count = $db->exec('INSERT INTO my_items SET maker_id=1,item_name="もも",price="210",keyword="缶詰,ピンク,甘い",sales=0,
    created="2019-05-25",modified="2019-05-25"');
    echo $count.'件のデータを挿入しました';
    */
    
    /*DB更新
    $count = $db ->exec('UPDATE my_items SET item_name="白桃" WHERE id=6');
    echo $count.'件変更しました';
    */

    /*DB削除
    $count = $db->exec('DELETE FROM my_items WHERE id=6');
    echo $count.'件削除しました';
    */

    /*SELECT文*/
    $records = $db->query('select * from my_items');
    while($record = $records->fetch()){
        print($record['item_name']."\n");
    }


?>
</pre>
</main>
</body>    
</html>