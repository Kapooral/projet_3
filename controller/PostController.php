<?php

require_once('model/PostManager.php');
require_once('model/CommentManager.php');

class PostController
{
	public function listPosts($currentPage)
	{
		$postManager = new PostManager();

		$totalPost = $postManager->count();
		$postPerPage = 2;
		$nbrPage = ceil($totalPost/$postPerPage);

		if($currentPage > $nbrPage)
		{
			throw new Exception('La page demandé n\'existe pas.');
		}
		else
		{
			$start = ($currentPage-1)*$postPerPage;
	    	$posts = $postManager->pagination($start, $postPerPage);
	    	require('view\frontend\home.php');
		}
	}

	public function backgroundListPosts()
	{
		$postManager = new PostManager();

		$posts = $postManager->getPosts();
		require('view\backend\backOfficeListPostsView.php');
	}

	public function exists($postId)
	{
		$postManager = new PostManager();
		return $postManager->exists($postId);
	}

	public function addPost($title, $content)
	{
		$postManager = new PostManager();
		$affectedLines = $postManager->addPost($title, $content);

		if($affectedLines === false)
		{
			throw new Exception('Impossible d\'ajouter cet article.');
		}
		else
		{
			header('Location: index.php?back=listPosts&token=' . $_SESSION['token']);
		}	
	}

	public function editPost($id)
	{
		$postManager = new PostManager();

		if(!$postManager->exists($id))
		{
			throw new Exception('Cet article n\'existe pas.');
		}
		else
		{
			$post = $postManager->get($id);
			require('view\backend\editPostView.php');
		}
	}

	public function updatePost($id, $title, $content)
	{
		$postManager = new PostManager();

		if(!$postManager->exists($id))
		{
			throw new Exception('Cet article n\'existe pas.');
		}
		else
		{
			$affectedLines = $postManager->update($id, $title, $content);
			if($affectedLines === false)
			{
				throw new Exception('Impossible de mettre à jour cet article.');
			}
			else
			{
				header('Location: index.php?back=listPosts&token=' . $_SESSION['token']);
			}
		}
	}

	public function deletePost($postId)
	{
		$postManager = new PostManager();

		if(!$postManager->exists($postId))
		{
			throw new Exception('Cet article n\'existe pas.');
		}
		else
		{
			$commentManager = new CommentManager();
			$commentManager->deletePostComments($postId);
			$affectedLines = $postManager->delete($postId);
			if($affectedLines == 0)
			{
				throw new Exception('Impossible de supprimer cet article.');
			}
			else
			{
				header('Content-type: text/javascript');
				$json = array('success' => 1, 'text' => 'Article supprimé.');

				echo json_encode($json);
			}
		}
	}

	public function post($id)
	{
		$postManager = new PostManager();
		$commentManager = new CommentManager();

		if(!$postManager->exists($id))
		{
			throw new Exception('Cet article n\'existe pas.');
		}
		else
		{
			$post = $postManager->get($id);
			if(!isset($post))
			{
				throw new Exception('Impossible de récupérer cet article.');
			}
			else
			{
				$comments = $commentManager->getComments($post->id());
				require('view\frontend\postView.php');
			}
		}
	}
}