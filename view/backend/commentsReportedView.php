<?php
include('public\headerBack.php');
if(!isset($_SESSION['administrator']))
{
	header('Location: index.php');
}
else
{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Commentaires signalés</title>
		<meta charset = "utf-8">
	</head>
	<body>
		<a href = "index.php?back=backOfficeView">Retour</a>
<?php
foreach($comments as $comment)
{
?>
	<p>
		Auteur : <?= $comment->author(); ?> <br />
		Commentaire : <?= nl2br($comment->content()); ?> <br/>
		Publié le : <?= $comment->commentDate(); ?> <br/>
		Nombre de signalements : <?= $comment->reporting(); ?> <br/>
		<a href = "index.php?action=authorize&amp;id=<?=$comment->id()?>">Autoriser</a> | <a href = "index.php?action=deleteComment&amp;id=<?=$comment->id()?>">Supprimer</a>
	</p>
<?php
}
?>
	</body>
</html>
<?php
}
?>