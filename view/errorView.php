<?php

$title = 'Page d\'erreur';
ob_start();

?>

	<div class = "container">
<?php 		
if(isset($errorMessage))
{
?>
		<div class="alert col-lg-4 col-lg-offset-4 alert-danger text-center">
    		<?= $errorMessage; ?>
		</div>
<?php
}
else
{
?>
		<div class="alert col-lg-4 col-lg-offset-4 alert-info text-center">
    		Aucune erreur à afficher.
		</div>
<?php
}
?>
	</div>

<?php 

$content = ob_get_clean();
require('public/backTemplate.php');

?>

