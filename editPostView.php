<?php
if(!isset($_SESSION['administrator']))
{
	header('Location: index.php');
}
else
{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Page d'articles</title>
		<meta charset = "utf-8">
		<script type = "text/javascript" src = "tinymce/tinymce.min.js"></script>
	    <script type = "text/javascript">
	        tinyMCE.init({
	        	selector: "textarea",
	        	plugins: "image, link, anchor, lists, table, textcolor colorpicker, charmap, contextmenu, help, hr, nonbreaking, preview, print, searchreplace, wordcount", 
	        	toolbar: "undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table anchor link image",
	        	contextmenu: "undo redo | bold italic underline | link image inserttable | cell row column deletetable",
	        	language: "fr_FR"});
	     </script>
	</head>
<?php
	if(isset($post))
	{
?>
		<p>
			<a href = "index.php?back=listPosts">Retour à la liste des articles</a>
		</p>

		<form action = "index.php" method = "post">
			<p>
				<input type = "hidden" name = "id" value = "<?= $post->id(); ?>" />
				<label for = "title">Titre</label><br />
				<input type = "text" name = "title" value = "<?= $post->title(); ?>"/>
			</p>
			<p>
				<label for = "content">Contenu</label><br />
				<textarea name = "content"><?= nl2br($post->content()); ?></textarea>
			</p>
			<input type = "submit" name = "update" value = "Mettre à jour" />
		</form>
<?php
	}
	else
	{
?>
		<p>
			<a href = "index.php?back=backofficeView">Retour</a>
		</p>

		<form action = "index.php" method = "post">
			<p>
				<label for = "title">Titre</label><br />
				<input type = "text" name = "title"/>
			</p>
			<p>
				<label for = "content">Contenu</label><br />
				<textarea name = "content"></textarea>
			</p>
			<input type = "submit" name = "publy" value = "Publier" />
		</form>
<?php
	}
?>
	</body>
</html>
<?php
}
?>
