<!DOCTYPE html>
<html>
	<head>
		<title><?= htmlspecialchars($post->title()) ?></title>
		<meta charset = "utf-8">
	</head>
	<body>
		<p><a href = "index.php?front=listPosts">Retour à la liste des billets</a></p>

		<div>
		    <h3>
		        <?= $post->title() ?>
		        <em>le <?= $post->postDate() ?></em>
		    </h3>
		    
		    <p>
		        <?= nl2br($post->content()) ?>
		    </p>
		</div>

		<h2>Commentaires</h2>

		<form action = "index.php?action=postComment&amp;id=<?= $post->id() ?>" method = "post">
		    <div>
		        <label for = "author">Auteur</label><br />
		        <input type = "text" name = "author" />
		    </div>

		    <div>
		        <label for = "comment">Commentaire</label><br />
		        <textarea name = "comment"></textarea>
		    </div>

		    <div>
		        <input type = "submit" />
		    </div>
		</form>
<?php

foreach($comments as $comment)
{
?>
    <p><strong><?= htmlspecialchars($comment->author()) ?></strong> le <?= $comment->commentDate() ?></p>
    <p><?= nl2br(htmlspecialchars($comment->content())) ?></p>
    <a href = "index.php?action=report&amp;idComment=<?=$comment->id()?>&amp;idPost=<?=$post->id()?>">Signaler</a>
<?php
}
?>
	</body>
</html>
