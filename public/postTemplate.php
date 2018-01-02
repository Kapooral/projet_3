<!DOCTYPE HTML>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="public/css/bootstrap.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="single">

	<!-- Wrapper -->
		<div id="wrapper">

			<?php include('header.php'); ?>
			<?= $content; ?>
			<?php include('public/footer.php'); ?>

		</div>

	<!-- Scripts -->
		<script src="https://unpkg.com/sweetalert2@7.3.0/dist/sweetalert2.all.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
		<script src="assets/js/main.js"></script>
		<script src="assets/js/actions.js"></script>
	</body>
</html>