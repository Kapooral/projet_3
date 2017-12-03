<!DOCTYPE html>
<html>
	<head>
		<title>Page de Connexion</title>
		<meta charset = "utf-8" />
		<link href = "public/css/bootstrap.css" rel = "stylesheet">
		<link href = "public/css/connectionView.css" rel = "stylesheet">
	</head>
	<body>
<?php
include('header.php');
?>
		<form class = "col-lg-4 col-lg-offset-4" action = "index.php" method = "post">
			<div class = "form-group">
				<label for = "login">Identifiant</label>
				<input class = "form-control" type = "text" name = "login" />
			</div>
			<div class = "form-group">
				<label for = "password">Mot de passe</label>
				<input class = "form-control" type = "password" name = "password" />
			</div>
			<input type = "submit" value = "Se connecter" name = "connect" />
		</form>
	</body>
</html>