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
		<title>Page d'administration</title>
		<meta charset = "utf-8" />
	</head>
	<body>
		<p>
			<a href = "index.php?disconnect=1">Déconnexion</a>
		</p>
		<p>
			<a href = "index.php?back=addPost">Ajouter un nouvel article</a>
		</p>
		<p>
			<a href = "index.php?back=listPosts">Liste des articles</a>
		</p>
		<p>
			<a href = "index.php?back=reported">Commentaires signalés</a>
		</p>
		<p>
			<a href = "index.php?front=listPosts">Page articles</a>
		</p>
	</body>
</html>
<?php
}
?>



		