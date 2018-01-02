<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class CommentController
{
	public function postComment($postId, $author, $comment)
	{
		$commentManager = new CommentManager();

		$affectedLines = $commentManager->postComment($postId, $author, $comment);
		if($affectedLines === false)
		{
			throw new Exception('Ce commentaire n\'a pas pu être posté.');
		}
		else
		{
			header('Content-type: text/javascript');
			$json = array('success' => 1, 'text' => 'Commentaire ajouté !');

			echo json_encode($json);
		}
	}

	public function reportComment($id)
	{
		$commentManager = new CommentManager();

		if(!$commentManager->exists($id))
		{
			throw new Exception('Ce commentaire n\'existe pas.');
		}
		else
		{
			$affectedLines = $commentManager->report($id);
			if($affectedLines === false)
			{
				throw new Exception('Ce commentaire n\'a pas pu être signalé.');
			}
			else
			{
				header('Content-type: text/javascript');
				$json = array('success' => 1, 'text' => 'Commentaire signalé.');

				echo json_encode($json);
			}
		}
	}

	public function reported()
	{
		$commentManager = new CommentManager();

		$comments = $commentManager->getReported();
		require('view\backend\commentsReportedView.php');
	}

	public function authorize($id)
	{
		$commentManager = new CommentManager();

		if(!$commentManager->exists($id))
		{
			throw new Exception('Ce commentaire n\'existe pas.');
		}
		else
		{
			$affectedLines = $commentManager->authorize($id);
			if($affectedLines === false)
			{
				throw new Exception('Ce commentaire n\'a pas pu être autorisé.');
			}
			else
			{
				header('Content-type: text/javascript');
				$json = array('success' => 1, 'text' => 'Commentaire autorisé.');

				echo json_encode($json);
			}
		}
	}

	public function deleteComment($id)
	{
		$commentManager = new CommentManager();

		if(!$commentManager->exists($id))
		{
			throw new Exception('Ce commentaire n\'existe pas.');
		}
		else
		{
			$affectedLines = $commentManager->delete($id);
			if($affectedLines == 0)
			{
				throw new Exception('Impossible de supprimer ce commentaire.');
			}
			else
			{
				header('Content-type: text/javascript');
				$json = array('success' => 1, 'text' => 'Commentaire supprimé.');

				echo json_encode($json);
			}
		}
	}
}