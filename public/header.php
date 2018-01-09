<!-- Header -->
			<header id="header">
				<h1><a href="index.php">Billet simple pour l'Alaska</a></h1>

				<nav class="links">
					<ul>
						<li><a href="index.php?back=backOfficeView&amp;token=<?= $_SESSION['token']; ?>">Administration</a></li>
						<li><a href="index.php">Articles</a></li>
					</ul>
				</nav>

				<nav class="main">
					<ul>
						<li class="menu">
							<a class="fa-bars" href="#menu">Menu</a>
						</li>
					</ul>
				</nav>
			</header>

		<!-- Menu -->
			<section id="menu">

			<!-- Search -->
				<section>
					<form class="search" method="post" action="index.php">
						<input type="text" name="postSearch" placeholder="Rechercher un article" required />
						<input type = "hidden" name = "token" value = "<?= $_SESSION['token']; ?>" />
						<br/>
						<input type = "submit" name = "search" class="button big fit">
					</form>

				</section>

			<!-- Actions -->
				<section>
					<nav class="links">
						<ul>
							<li><a href="index.php?back=backOfficeView&amp;token=<?= $_SESSION['token']; ?>">Administration</a></li>
							<li><a href="index.php">Articles</a></li>
						</ul>
					</nav>

					<ul class="actions vertical">
<?php
if(isset($_SESSION['administrator']))
{
?>									
						<li><a href="?disconnect=1" class="button big fit">Se déconnecter</a></li>
<?php
}
else
{
?>
						<li><a href="index.php?back=backOfficeView" class="button big fit">Se connecter</a></li>
<?php
}
?>
					</ul>
				</section>

			</section>