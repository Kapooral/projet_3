<?php

$title = 'Page d\'administration'; 
ob_start();

?>
<div class = "container">
	<legend>Tableau de bord</legend>
	<div class = "row">
		<div class = "col-lg-3">
			<a href = "index.php?back=addPost&amp;token=<?= $_SESSION['token']; ?>">
				<div class = "panel panel-primary">
					<div class = "panel-heading">
						<div class = "row">
							<div class = "col-lg-3">
								<i class = "fa fa-plus-circle fa-5x"></i>
							</div>
							<div class = "col-lg-9 text-right">
								Ajouter un article
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		
		<div class = "col-lg-3">
			<div class = "panel panel-default">
				<div class = "panel-heading">
					<div class = "row">
						<div class = "col-lg-3">
							<i class = "fa fa-th-list fa-5x"></i>
						</div>
						<div class = "col-lg-9 text-right">
							<h1><?= $postManager->count(); ?></h1>
							<div>Articles</div>
						</div>
					</div>
				</div>
				<a href = "index.php?back=listPosts&amp;token=<?= $_SESSION['token']; ?>">
					<div class = "panel-body">
						<span class = "pull-left">Voir détails</span>
						<span class = "pull-right">
							<i class = "fa fa-arrow-circle-right"></i>
						</span>
						<div class = "clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class = "col-lg-3">
			<div class = "panel panel-default">
				<div class = "panel-heading">
					<div class = "row">
						<div class = "col-lg-3">
							<i class = "fa fa-pencil-square-o fa-5x"></i>
						</div>
						<div class = "col-lg-9 text-right">
							<h1></h1>
							<div>Informations</div>
						</div>
					</div>
				</div>
				<a href = "#">
					<div class = "panel-body">
						<span class = "pull-left">Modifier</span>
						<span class = "pull-right">
							<i class = "fa fa-arrow-circle-right"></i>
						</span>
						<div class = "clearfix"></div>
					</div>
				</a>
			</div>
		</div>
		<div class = "col-lg-3">
			<div class = "panel panel-danger">
				<div class = "panel-heading">
					<div class = "row">
						<div class = "col-lg-3">
							<i class = "fa fa-flag fa-5x"></i>
						</div>
						<div class = "col-lg-9 text-right">
							<h1><?= $commentManager->countReported(); ?></h1>
							<div>Signalements</div>
						</div>
					</div>
				</div>
				<a href = "index.php?back=reported&amp;token=<?= $_SESSION['token']; ?>">
					<div class = "panel-body">
						<span class = "pull-left">Modérer</span>
						<span class = "pull-right">
							<i class = "fa fa-arrow-circle-right"></i>
						</span>
						<div class = "clearfix"></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class = "row">
		<div class = "col-lg-6 col-lg-offset-3">
			<hr/>
		</div>
	</div>
</div>

<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>



		