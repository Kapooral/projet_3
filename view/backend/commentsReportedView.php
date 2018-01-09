<?php

$title = 'Commentaires signalés';
ob_start();

?>
<div class="container">
	<p>
		<a href = "index.php?back=backOfficeView&amp;token=<?= $_SESSION['token']; ?>">Retour au tableau de bord</a>
	</p>
	<legend>Commentaires signalés</legend>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                	<table class="table table-striped">
                  		<thead>
                    		<tr>
                        		<th>Auteur</th>
                        		<th>Commentaire</th>
                        		<th>Signalement(s)</th>
                        		<th></th>
                    		</tr> 
                  		</thead>
                  		<tbody>

<?php
if(count($comments) > 0)
{
	foreach($comments as $comment)
	{
?>
									<tr id = "<?= $comment->id(); ?>">
		                            	<td><?= htmlspecialchars($comment->author()); ?></td>
		                            	<td><?= nl2br(htmlspecialchars($comment->content())); ?></td>
		                            	<td><?= $comment->reporting(); ?></td>
		                            	<td align="center">
		                              		<a class="btn btn-default" onclick = "authorizeComment('<?= $comment->id(); ?>', '<?= $_SESSION['token']; ?>')"><i class="fa fa-check"></i></a>
		                              		<a class="btn btn-danger" onclick = "deleteComment('<?= $comment->id(); ?>', '<?= $_SESSION['token']; ?>')"><i class="fa fa-trash"></i></a>
		                            	</td>
		                            </tr>
	
<?php
	}
}
?>
								</tbody>
		                    </table>
		                </div>
			        </div>
			    </div>
			</div>
		</div>
<?php

$content = ob_get_clean();
require('public/backTemplate.php');

?>

