<!DOCTYPE HTML>
<html>
	<head>
		<title><?= $title; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link href = "public/css/bootstrap.css" rel = "stylesheet">
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
		<script type = "text/javascript" src = "tinymce/tinymce.min.js"></script>
		<script type = "text/javascript">
		    tinyMCE.init({
		    	selector: "textarea",
		    	plugins: "image, link, anchor, lists, table, textcolor colorpicker, charmap, contextmenu, help, hr, nonbreaking, preview, print, searchreplace, wordcount, visualblocks", 
		    	toolbar: "undo redo | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table anchor link image",
		    	contextmenu: "undo redo | bold italic underline | link image inserttable | cell row column deletetable",
		    	language: "fr_FR",
		    	height: "300",
		    	forced_root_block: false,
		    	force_br_newlines: true,
		    	force_p_newlines: false});
		 </script>
	</body>
</html>