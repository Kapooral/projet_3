<?php

$title = 'Modifier informations';
ob_start();

?>
<div class = "container">
	<legend>Modification des informations</legend>
	<div class = "row">
		<form class = "col-lg-4 col-lg-offset-4 blogForm" action = "index.php" method = "post">
			<div class = "form-group">
				<label for = "password">Mot de passe</label>
				<input class = "form-control" type = "password" name = "password" required/>
			</div>
			<input type = "submit" value = "Enregistrer" name = "editInfos" /><br/>
		</form>
	</div>
</div>
<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>