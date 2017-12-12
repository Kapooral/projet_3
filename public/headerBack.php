<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8" />
		<link href="public/css/bootstrap.css" rel="stylesheet">
		<link href="public/css/header.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Raleway" rel="stylesheet">
	</head>
	<body>
		<div class = "container-fluid">
			<header class = "row">
				<div class = "col-lg-3"><span id = "title">Billet simple pour l'Alaska</span></div>
<?php
if(isset($_SESSION['administrator']))
{
?>
				<div class = "col-lg-1 col-lg-offset-2">
					<a href = "index.php?back=backOfficeView">Administration</a>
				</div>
				<div class = "col-lg-1">Accueil</div>
				<div class = "col-lg-1"><a href = "index.php?front=listPosts&amp;page=1">Articles</a></div>
				<div class = "col-lg-1 col-lg-offset-2">
					<a class = "btn btn-default" href = "index.php?disconnect=1">Déconnexion</a>
				</div>
<?php
}
else
{
?>
				<div class = "col-lg-1 col-lg-offset-2">Accueil</div>
				<div class = "col-lg-1"><a href = "index.php?front=listPosts&amp;page=1">Articles</a></div>
				<div class = "col-lg-1 col-lg-offset-3">
					<a class = "btn btn-default" href = "index.php?back=connectionView">Connexion</a>
				</div>
<?php
}
?>			
			</header>
		</div>
	</body>
</html>