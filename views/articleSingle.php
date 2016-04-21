<h1>
    <?=$article['title']?>
</h1>
<p>
    <?=$article['content']?>
</p>
<div class="comments">

    <div class="commentBlock">
        <div class="commentHeader">
            Автор: <?= $comment['author']?> дата: <?= $comment['date']?>
        </div>
        <div class="commentBody">
            <?=$comment['content']?>
        </div>
    </div>

</div>