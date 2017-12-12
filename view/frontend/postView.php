<!DOCTYPE HTML>
<html>
	<head>
		<title><?= $post->title(); ?></title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" href = "assets/css/main.css" />
	</head>
	<body class = "single">
<?php
include('public/header.php');
?>
		<div id = "main">
			<article class = "post">
				<header>
					<div class = "title">
						<h2><?= $post->title(); ?></h2>
						<p>Chapitre</p>
					</div>
					<div class = "meta">
						<time class = "published" datetime = "2015-11-01"><?= $post->postDate() ?></time>
						<span class = "author name">Auteur</span>
					</div>
				</header>
				<span class = "image featured"><img src = "images/pic01.jpg" alt = "Image mise en avant" /></span>
				<p><?= nl2br($post->content()); ?></p>
				<footer>
					<ul class = "stats">
						<li>General</li>
						<li class = "icon fa-heart"><?= $post->likes(); ?></li>
						<li class = "icon fa-comment">28</li>
						<li><a href = "index.php?action=like&amp;page=<?= $currentPage; ?>&amp;postId=<?= $post->id(); ?>" class = "">Je like ! </a></li>
					</ul>
				</footer>
				<ul class="actions pagination">
					<li><a href = "index.php?front=listPosts&amp;page=<?= $currentPage ?>" class = "button big previous">Page précédente</a></li>
				</ul>
			</article>
		<div/>
				<legend>Ajouter un commentaire</legend>
				<form action = "index.php?action=postComment&amp;postId=<?= $post->id(); ?>&amp;page=<?= $currentPage; ?>" method = "post">
		        	<fieldset>
		        		<label for = "author">Auteur</label>
		        		<input type = "text" name = "author" />
		        	</fieldset>
		        	<fieldset>
		        		<label for = "comment">Commentaire</label>
		        	</fieldset>
		        	<textarea name = "comment"></textarea>
		    		<input class = "btn btn-default pull-right" type = "submit" value = "Poster un commentaire" />
				</form>
			</div>
		</div>
	</div>
<?php
foreach($comments as $comment)
{
?>			<div class>
            	<h4><?= $comment->author(); ?> <em> le <?= $comment->commentDate(); ?></em></h4>
            	<div>
	            	<?= nl2br(htmlspecialchars($comment->content())); ?>
	            </div>
				<a class = "btn btn-default" href = "index.php?action=report&amp;idComment=<?= $comment->id()?>&amp;idPost=<?=$post->id()?>&amp;page=<?= $currentPage; ?>">Signaler</a>
            </div>             		
<?php
}
?>

	</body>
</html>