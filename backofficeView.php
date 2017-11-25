<?php

echo 'Connexion réussie.';

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Page d'administration</title>
		<meta charset = "utf-8" />
	</head>
	<body>
		<p>
			<a href = "?disconnect=1">Déconnexion</a>
		</p>
		<form action = "root.php" method = "post">
			<p>
				<label for = "title">Titre</label><br />
				<input type = "text" name = "title" />
			</p>
			<p>
				<label for = "content">Contenu</label><br />
				<textarea name = "content"></textarea>
			</p>
			<input type = "submit" name = "publy" value = "Publier" />
		</form>
	</body>
</html>