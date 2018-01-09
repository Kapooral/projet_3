<?php

$title = 'Liste des articles';
ob_start();

?>

<div class = "container">
  <p>
    <a href = "index.php?back=backOfficeView&amp;token=<?= $_SESSION['token']; ?>">Retour au tableau de bord</a>
  </p>
	<legend>Liste des articles</legend>
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
                <div class="panel-body">
                	<table class="table table-striped">
                  		<thead>
                    		<tr>
                        		<th>Titre</th>
                        		<th>Date de publication</th>
                        		<th></th>
                    		</tr> 
                  		</thead>
                  		<tbody>

<?php
if(count($posts) > 0)
{
	foreach($posts as $post)
	{
?>
							<tr id = "<?= $post->id(); ?>">
                            	<td><?= $post->title(); ?></td>
                            	<td><?= $post->postDate() ?></td>
                            	<td align="center">
                            		<a class="btn btn-default" href="index.php?front=post&amp;id=<?= $post->id() ?>&amp;token=<?= $_SESSION['token']; ?>"><i class="fa fa-eye"></i></a>
                              		<a class="btn btn-default" href = "index.php?back=editPost&amp;id=<?=$post->id(); ?>&amp;token=<?= $_SESSION['token']; ?>"><i class="fa fa-pencil"></i></a>
                              		<a class="btn btn-danger" onclick = "deletePost('<?= $post->id(); ?>', '<?= $_SESSION['token']; ?>')"><i class="fa fa-trash"></i></a>
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








