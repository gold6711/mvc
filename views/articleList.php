<?php foreach ($articles as $article):?>
<div>
    <h2>
        <a href="/models/test/ttt/OOP/index.php/?c=Article&a=Display&id=<?=$article['id'] ?>">
            <?= $article['title'];?>
        </a>
    </h2 >
        <p><?=$article['content'];?></p >
    </div >
<?php endforeach?>
