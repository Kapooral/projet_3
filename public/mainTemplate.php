<!DOCTYPE html>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link href="assets/css/main.css" rel="stylesheet" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
		<div id="wrapper">

			<?php include('public/header.php'); ?>

			<?= $content; ?>

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

				<?php include('public/footer.php'); ?>

			</section>
		</div>

		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>
	</body>
</html>