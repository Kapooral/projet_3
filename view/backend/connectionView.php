<?php

$title = 'Page de connexion';
ob_start();

?>
<div class = "container">
	<div class = "row">
		<form class = "col-lg-4 col-lg-offset-4" action = "index.php" method = "post">
			<div class = "form-group">
				<label for = "login">Identifiant</label>
				<input class = "form-control" type = "text" name = "login" required />
				<input type = "hidden" name = "token" value = "<?= $_SESSION['token']; ?>" />
			</div>
			<div class = "form-group">
				<label for = "password">Mot de passe</label>
				<input class = "form-control" type = "password" name = "password" required />
			</div>
			<input type = "submit" value = "Se connecter" name = "connect" /><br/>
			<a href = "index.php?back=resetPassword">Mot de passe oublié</a>
		</form>
	</div>
</div>
<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>