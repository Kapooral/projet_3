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
		<title>Liste d'articles</title>
		<meta charset = "utf-8">
	</head>
	<body>
		<a href = "index.php?back=backofficeView">Retour</a>
<?php
foreach($posts as $post)
{
?>
<p>
	<a href = "index.php?back=editPost&amp;id=<?= $post->id(); ?>"><?= $post->title(); ?></a>
</p>
<?php
}
?>
	</body>
</html>
<?php
}
?>