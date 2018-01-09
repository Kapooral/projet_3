<?php

$title = 'Modifier informations';
ob_start();

?>
<div class = "container">
	<p>
		<a href = "index.php?back=backOfficeView&amp;token=<?= $_SESSION['token']; ?>">Retour au tableau de bord</a>
	</p>
	<legend>Modification vos informations</legend>
	<div class = "row">
		<form class = "col-lg-4 col-lg-offset-4" action = "index.php" method = "post">
			<div class = "form-group">
				<label for = "password">Adresse e-mail</label>
				<input class = "form-control" type = "email" name = "email" />
			</div>
			<div class = "form-group">
				<label for = "password">Mot de passe actuel</label>
				<input class = "form-control" type = "password" name = "currentPassword" required />
			</div>
			<div class = "form-group">
				<label for = "password">Nouveau mot de passe</label>
				<input class = "form-control" type = "password" name = "newPassword" />
			</div>
			<div class = "form-group">
				<label for = "password">Confirmez nouveau mot de passe</label>
				<input class = "form-control" type = "password" name = "confirmNewPassword" />
				<input type = "hidden" name = "token" value = "<?= $_SESSION['token']; ?>" />
			</div>
			<input type = "submit" value = "Enregistrer" name = "editInfos" /><br/>
		</form>
	</div>
</div>
<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>