<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset = "utf-8" />
		<link href="public/css/bootstrap.css" rel="stylesheet">
		<link href="public/css/header.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Raleway" rel="stylesheet">
	</head>
	<body>
		<div class = "container-fluid">
			<header class = "row">
				<div class = "col-lg-3"><span id = "title">Billet simple pour l'Alaska</span></div>
				<div class = "col-lg-1 col-lg-offset-2">Accueil</div>
				<div class = "col-lg-1"><a href = "index.php?front=listPosts">Articles</a></div>
				<div class = "col-lg-1 col-lg-offset-3">
<?php 
if(isset($_SESSION['administrator']))
{
?>
<a class = "btn btn-default" href = "index.php?disconnect=1">Déconnexion</a>
<?php
}
else
{
?><a class = "btn btn-default" href = "index.php?back=connectionView">Connexion</a>
<?php
}
?>				</div>

			</header>
		</div>
	</body>
</html>