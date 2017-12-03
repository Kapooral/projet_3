<?php
include('header.php');
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
		<link href = "public/css/bootstrap.css" rel = "stylesheet">
	</head>
	<body>
		<div>
			<a href = "index.php?back=addPost">Ajouter un nouvel article</a>
		</div>
		<div>
			<a href = "index.php?back=listPosts">Liste des articles</a>
		</div>
		<div>
			<a href = "index.php?back=reported">Commentaires signalés</a>
		</div>
	</body>
</html>
<?php
}
?>



		