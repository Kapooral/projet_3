<!DOCTYPE html>
<html>
	<head>
		<title>Commentaires signalés</title>
		<meta charset = "utf-8">
	</head>
	<body>
		<a href = "root.php?back=backofficeView">Retour</a>
<?php
foreach($comments as $comment)
{
?>
	<p>
		Auteur : <?= $comment->author(); ?> <br />
		Commentaire : <?= $comment->content(); ?> <br/>
		Publié le : <?= $comment->commentDate(); ?> <br/>
		Nombre de signalements : <?= $comment->reporting(); ?> <br/>
	</p>
<?php
}
?>
	</body>
</html>