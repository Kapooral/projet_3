<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Articles</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
<?php
include('public/header.php');
?>


				<!-- Main -->
					<div id="main">
<?php
foreach($posts as $post)
{
?>
						<!-- Post -->
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="index.php?page=<?= $currentPage ?>&amp;front=post&amp;id=<?= $post->id() ?>"><?= $post->title(); ?></a></h2>
										<p>Chapitre</p>
									</div>
									<div class="meta">
										<time class="published" datetime="2015-11-01"><?= $post->postDate(); ?></time>
										<span class="author name">Auteur</span>
									</div>
								</header>
								<a href="#" class="image featured"><img src="<?= $post->image(); ?>" alt="Image mise en garde" /></a>
								<p><?= substr($post->content(), 0, 300) . '...' ?></p>
								<footer>
									<ul class="actions">
										<li><a href="index.php?front=post&amp;page=<?= $currentPage ?>&amp;id=<?= $post->id() ?>" class="button big">Continuer de lire</a></li>
									</ul>
									<ul class="stats">
										<li>General</li>
										<li class="icon fa-heart"><?= $post->likes(); ?></li>
										<li class="icon fa-comment">128</li>
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
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage - 1 ?>" class="disabled button big previous">Page précédente</a></li>
<?php
}
else
{
?>
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage - 1 ?>" class="button big previous">Page précédente</a></li>
<?php
}
?>
<?php
if($currentPage == $nbrPage)
{
?>
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage + 1 ?>" class="disabled button big next">Page Suivante</a></li>
<?php
}
else
{
?>
								<li><a href="index.php?front=listPosts&amp;page=<?= $currentPage + 1 ?>" class="button big next">Page Suivante</a></li>
<?php
}
?>
							</ul>

					</div>

				<!-- Sidebar -->
					<section id="sidebar">

						<!-- Intro -->
							<section id="intro">
								<a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
								<header>
									<h2>Billet simple pour l'Alaska</h2>
									<p>Jean Forteroche</p>
								</header>
							</section>

						<!-- About -->
							<section class="blurb">
								<h2>About</h2>
								<p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed ultricies.</p>
								<ul class="actions">
									<li><a href="#" class="button">Learn More</a></li>
								</ul>
							</section>

						<!-- Footer -->
							<section id="footer">
								<ul class="icons">
									<li><a href="#" class="fa-twitter"><span class="label">Twitter</span></a></li>
									<li><a href="#" class="fa-facebook"><span class="label">Facebook</span></a></li>
									<li><a href="#" class="fa-instagram"><span class="label">Instagram</span></a></li>
									<li><a href="#" class="fa-rss"><span class="label">RSS</span></a></li>
									<li><a href="#" class="fa-envelope"><span class="label">Email</span></a></li>
								</ul>
								<p class="copyright">&copy; Untitled. Design: <a href="http://html5up.net">HTML5 UP</a>. Images: <a href="http://unsplash.com">Unsplash</a>.</p>
							</section>

					</section>

			</div>

	</body>
</html>