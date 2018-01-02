<?php

$title = 'Réinitialiser mot de passe';
ob_start();

?>
<div class = "container">
	<div class = "row">
		<form class = "col-lg-4 col-lg-offset-4 blogForm" action = "index.php" method = "post">
			<div class = "form-group">
				<label for = "login">Identifiant</label>
				<input class = "form-control" type = "text" name = "login" />
			</div>
			<div class = "form-group">
				<label for = "password">Email</label>
				<input class = "form-control" type = "email" name = "email" />
			</div>
			<input type = "submit" value = "Générer" name = "resetPassword" />
		</form>
	</div>
</div>
<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>