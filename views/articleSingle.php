<h1>
    <?=$article['title']?>
</h1>
<p>
    <?=$article['content']?>
</p>
<div class="comments">
    <?php foreach($comments as $comment):?>
    <div class="commentBlock">
        <div class="commentHeader">
            �����: <?= $comment['author']?> ����: <?= $comment['author']?>
        </div>
        <div class="commentBody">
            <?=$comment['content']?>
        </div>
    </div>
    <?php endforeach ?>
</div>