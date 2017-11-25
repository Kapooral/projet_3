<!DOCTYPE html>
<html>
	<head>
		<title>Page d'articles</title>
		<meta charset = "utf-8">
	</head>
	<body>
<?php
foreach($posts as $post)
{
?>
		<div>
			<h3>
            	<?= htmlspecialchars($post->title()) ?>
           		<em>le <?= $post->postDate() ?></em>
        	</h3>
        
        	<p>
	            <?= substr(htmlspecialchars($post->content()), 0, 100) . '...' ?>
	            <br />
            	<em><a href="root.php?page=post&amp;id=<?= $post->id() ?>">En savoir plus</a></em>
        	</p>
    </div>
<?php
}
?>
	</body>
</html>