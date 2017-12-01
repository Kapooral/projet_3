<?php
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
		<title>Page d'articles</title>
		<meta charset = "utf-8">
	</head>
	<body>
		<p>
			<a href = "index.php?back=listPosts">Retour à la liste des articles</a>
		</p>
		
		<form action = "index.php" method = "post">
			<p>
				<input type = "hidden" name = "id" value = "<?= $post->id(); ?>" />
				<label for = "title">Titre</label><br />
				<input type = "text" name = "title" value = "<?= $post->title(); ?>"/>
			</p>
			<p>
				<label for = "content">Contenu</label><br />
				<textarea name = "content"><?= nl2br($post->content()); ?></textarea>
			</p>
			<input type = "submit" name = "update" value = "Mettre à jour" />
		</form>
	</body>
</html>
<?php
}
?>
