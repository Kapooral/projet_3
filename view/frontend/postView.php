<?php 

$title = $post->title();
ob_start();

include('public/header.php');
?>
<div id = "main">
	<article class = "post">
		<header>
			<div class = "title">
				<h2><?= $post->title(); ?></h2>
			</div>
			<div class = "meta">
				<time class = "published" datetime = "2015-11-01"><?= $post->postDate() ?></time>
			</div>
		</header>
		<span class = "image featured"><img src = "images/pic01.jpg" alt = "Image mise en avant" /></span>
		<p><?= nl2br($post->content()); ?></p>
	</article>

	<legend>Ajouter un commentaire</legend>
	<form action = "index.php" method = "post" class = "blogForm">
		<input type = "hidden" name = "id" value = "<?= $post->id(); ?>" />
		<div class = "form-group">
			<label for = "author">Auteur</label>
			<input type = "text" name = "author" required/>
		</div>
    	
    	<div class = "form-group">
    		<label for = "comment">Commentaire</label>
    		<textarea name = "comment" required></textarea>
    	</div>
		<input class = "btn btn-default pull-right" type = "submit" name = "postComment" value = "Poster un commentaire" />
	</form>
	<br/>


	<legend>Commentaires</legend>
	<div class="container content">
    

<?php
if(count($comments) > 0)
{
	foreach($comments as $comment)
	{
?>	
		<div class="row">
	        <div class="col-md-6">
	            <div class="testimonials">
	            	<div class="active item">
	            		<div class="carousel-info">
	                    	<img alt="anonyme-avatar" src="public/img/avatar" class="pull-left" />
	                    	<div class="pull-left">
	                      		<span class="testimonials-name"><?= $comment->author(); ?></span>
	                      		<span class="testimonials-post"><?= $comment->commentDate(); ?> | <a onclick="reportComment(<?php echo $comment->id(); ?>)">Signaler</a></span>
	                    	</div>
	                  	</div>
	                  	<blockquote>
	                  		<p>
	                  			<?= nl2br(htmlspecialchars($comment->content())); ?>
	                  		</p>
	                  	</blockquote>
	                </div>
	            </div>
	        </div>
	    </div>        		
<?php
	}
}
else
{
?>
		<blockquote>
			<p>
				Aucun commentaire.
			</p>
		</blockquote>
<?php
}
?>
	</div>
</div>
<br/>

<?php

$content = ob_get_clean();
require('public/postTemplate.php');

?>