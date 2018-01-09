<?php 

$title = 'Blog - Un billet pour l\'Alaska';
ob_start(); 

?>
						<div id = "main">
<?php

foreach($posts as $post)
{
?>
							<!-- Post -->
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="index.php?front=post&amp;id=<?= $post->id() ?>&amp;token=<?= $_SESSION['token']; ?>"><?= $post->title(); ?></a></h2>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01"><?= $post->postDate(); ?></time>
									</div>
								</header>
								<a href="#" class="image featured"><img src="images/pic01.jpg" alt="Image mise en garde" /></a>
								<p><?= substr($post->content(), 0, 300) . '...' ?></p>
								<footer>
									<ul class="actions">
										<li><a href="index.php?front=post&amp;page=<?= $currentPage ?>&amp;id=<?= $post->id() ?>&amp;token=<?= $_SESSION['token']; ?>" class="button big">Continuer de lire</a></li>
									</ul>
								</footer>
							</article>
<?php
}
?>

							<!-- Pagination -->
							<ul class="actions pagination">
								
<?php
if($currentPage == 1)
{
?>	
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage - 1 ?>&amp;token=<?= $_SESSION['token']; ?>" class="disabled button big previous">Page précédente</a></li>
<?php
}
else
{
?>
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage - 1 ?>&amp;token=<?= $_SESSION['token']; ?>" class="button big previous">Page précédente</a></li>
<?php
}
if($currentPage == $nbrPage)
{
?>
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage + 1 ?>&amp;token=<?= $_SESSION['token']; ?>" class="disabled button big next">Page Suivante</a></li>
<?php
}
else
{
?>
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage + 1 ?>&amp;token=<?= $_SESSION['token']; ?>" class="button big next">Page Suivante</a></li>
<?php
}
?>
							</ul>
						</div>

<?php 

$content = ob_get_clean(); 
require('public/mainTemplate.php');

?>