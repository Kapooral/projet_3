<?php

$title = 'Editer un article';
ob_start();

if(isset($post))
{
?>
	<p>
		<a href = "index.php?back=listPosts">Retour à la liste des articles</a>
	</p>

<div class = "container">
	<div class = "row">
		<form class = "col-lg-10 col-lg-offset-1" action = "index.php" method = "post">
			<legend>Modifier un article</legend>
			<div class = "text-right"><em>Dernière modification le <?= $post->lastEdit(); ?></em></div>
			<div class = "form-group">
				<input type = "hidden" name = "id" value = "<?= $post->id(); ?>" />
				<label for = "title">Titre</label>
				<input class = "form-control" type = "text" name = "title" value = "<?= $post->title(); ?>" required/>
			</div>
			<div class = "form-group">
				<label for = "content">Contenu</label>
				<textarea class = "form-control" name = "content"><?= $post->content() ?></textarea>
			</div>
			<input class = "pull-right" type = "submit" name = "update" value = "Mettre à jour" />
		</form>
	</div>
</div>
<?php
}
else
{
?>
<div class ="container">
	<div class = "row">
		<form class = "col-lg-10 col-lg-offset-1" action = "index.php" method = "post">
			<legend>Ajout d'un nouvel article</legend>
			<div class = "form-group">
				<label for = "title">Titre</label>
				<input class = "form-control" type = "text" name = "title" required/>
			</div>
			<div class = "form-group">
				<label for = "content">Contenu</label>
				<textarea class = "form-control" name = "content"></textarea>
			</div>
			<input class = "pull-right" type = "submit" name = "publy" value = "Publier" />
		</form>
	</div>
</div>
<?php
}
?>	



<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>
