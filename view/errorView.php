<?php
include('public\header.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Page d'erreur</title>
		<link href = "public/css/bootstrap.css" rel = "stylesheet" />
	</head>
	<body>
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
	</body>
