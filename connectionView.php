<!DOCTYPE html>
<html>
	<head>
		<title>Page de Connexion</title>
		<meta charset = "utf-8" />
	</head>
	<body>
		<form action = "root.php" method = "post">
			<label for = "login">Identifiant</label><br />
			<input type = "text" name = "login" /><br />
			<label for = "password">Mot de passe</label><br />
			<input type = "password" name = "password" /><br/>
			<input type = "submit" value = "Se connecter" name = "connect" />
			<input type = "submit" value = "Créer un compte" name = "create" />
		</form>

		<p><a href = "root.php?page=listPosts">Page articles</a></p>
	</body>
</html>