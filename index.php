<?php

session_start();

require('controller/PostController.php');
require('controller/CommentController.php');
require('controller/AdministratorController.php');
//require('controler/controler.php');

if(!isset($_SESSION['token']))
{
	$token = bin2hex(openssl_random_pseudo_bytes(7));
	$_SESSION['token'] = $token;
}

try
{
	if(isset($_POST['connect']))
	{
		if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['login']) && !empty($_POST['password']))
		{
			$login = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);

			$administratorController = new AdministratorController();
			$administratorController->connection($login, $password);
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_POST['resetPassword']))
	{
		if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['login']) && !empty($_POST['email']))
		{
			$login = htmlspecialchars($_POST['login']);
			$email = htmlspecialchars($_POST['email']);

			$administratorController = new AdministratorController;
			$administratorController->resetPassword($login, $email);
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_POST['editInfos']))
	{
		if(!empty($_POST['password']))
		{
			$password = htmlspecialchars($_POST['password']);

			$administratorController = new AdministratorController();
			$administratorController->updatePassword();	
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_POST['publy']))
	{
		if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['title']) && !empty($_POST['content']))
		{
			$title = htmlspecialchars($_POST['title']);
			$content = htmlspecialchars($_POST['content']);

			$postController = new PostController();
			$postController->addPost($title, $content);
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_POST['update']))
	{
		if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['title']) && !empty($_POST['content']))
		{
			if(isset($_POST['id']))
			{
				$postId = (int) $_POST['id'];

				$title = htmlspecialchars($_POST['title']);
				$content = htmlspecialchars($_POST['content']);

				$postController = new PostController();

				if($postController->exists($postId))
				{
					$postController->updatePost($postId, $title, $content);
				}
				else
				{
					throw new Exception('Cet article n\'existe pas.');
				}
			}
			else
			{
				throw new Exception('Tous les champs ne sont pas remplis.');
			}
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_POST['postComment']))
	{
		if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['author']) && !empty($_POST['comment']))
		{
			if(isset($_POST['id']))
			{
				$postId = (int) $_POST['id'];

				$author = htmlspecialchars($_POST['author']);
				$comment = htmlspecialchars($_POST['comment']);

				$postController = new PostController();

				if($postController->exists($postId))
				{
					$commentController = new CommentController();
					$commentController->postComment($postId, $author, $comment);
				}
				else
				{
					throw new Exception('Cet article n\'existe pas.');
				}
			}	
			else
			{
				throw new Exception('Aucun article n\'a été sélectionné.');
			}
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_POST['search']))
	{
		if(isset($_POST['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['postSearch']))
		{
			$postSearch = htmlspecialchars($_POST['postSearch']);

			$postController = new PostController();
			$postController->post($postSearch);
		}
		else
		{
			throw new Exception('Tous les champs ne sont pas remplis.');
		}
	}

	elseif(isset($_GET['disconnect']))
	{
		$administratorController = new AdministratorController();
		$administratorController->disconnect();
	}

	elseif(isset($_GET['front']))
	{
		switch($_GET['front'])
		{
			case 'listPosts':

				if(isset($_GET['page']))
				{
					$page = (int) $_GET['page'];

					if($page > 0)
					{
						$currentPage = $page;
					}
					else
					{
						$currentPage = 1;
					}

					$postController = new PostController();
					$postController->listPosts($currentPage);
				}
				else
				{
					throw new Exception ('Aucune page n\'a été sélectionné.');
				}

			break;

			case 'post':

				if(isset($_GET['id']))
				{
					$postId = (int) $_GET['id'];

					if($postId > 0)
					{
						$postController = new PostController();
						$postController->post($postId);
					}
					else
					{
						throw new Exception('Cet article n\'existe pas.');
					}
				}
				else
				{
					throw new Exception('Aucun article n\'a été sélectionné.');
				}

			break;

			default:
				throw new Exception('La Page est inconnue');
			break;
		}
	}

	elseif(isset($_GET['back']))
	{
		$administratorController = new AdministratorController();

		if($administratorController->isConnect())
		{
			switch($_GET['back'])
			{
				case 'backOfficeView':

					if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
					{
						$administratorController->backOffice();
					}
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
					}

				break;

				case 'listPosts':

					if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
					{
						$postController = new PostController();
						$postController->backgroundListPosts();
					}
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
					}

				break;

				case 'addPost':

					if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
					{
						require('view\backend\editPostView.php');
					}
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
					}

				break;

				case 'reported':

					if(isset($_GET['token']) && $_GET['token'] == $_SESSION['token'])
					{
						$commentController = new CommentController();
						$commentController->reported();
					}
					else
					{
						throw new Exception('Vous n\'êtes pas autorisé à accéder à cette page.');
					}

				break;

				case 'editPost':

					if(isset($_GET['id'], $_GET['token']) && $_GET['token'] == $_SESSION['token'])
					{
						$postId = (int) $_GET['id'];
						if($postId > 0)
						{
							$postController = new PostController();
							$postController->editPost($postId);
						}
						else
						{
							throw new Exception('Cet article n\'existe pas.');
						}
					}
					else
					{
						throw new Exception('Aucun article n\'a été sélectionné.');
					}

				break;

				default:
					throw new Exception('La page est inconnue.');
				break;
			}
		}
		elseif($_GET['back'] == 'resetPassword')
		{

			$administratorController->resetPasswordView();
		}
		else
		{
			require('view\backend\connectionView.php');
		}
	}

	elseif(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'report':

				if(isset($_GET['id'], $_GET['token']) && $_GET['token'] == $_SESSION['token'])
				{
					$idComment = (int) $_GET['id'];

					if($idComment > 0)
					{
						$commentController = new CommentController();
						$commentController->reportComment($idComment);
					}
					else
					{
						throw new Exception('Ce commentaire ou cet article n\'existe pas.');
					}
				}
				else
				{
					throw new Exception('Aucun commentaire n\'a été sélectionné.');
				}

			break;

			case 'authorize':

				if(isset($_GET['id'], $_GET['token']) && $_GET['token'] == $_SESSION['token'])
				{
					$commentId = (int) $_GET['id'];
					if($commentId > 0)
					{
						$commentController = new CommentController();
						$commentController->authorize($commentId);
					}
					else
					{
						throw new Exception('Ce commentaire n\'existe pas.');
					}
				}
				else
				{
					throw new Exception('Aucun commentaire n\'a été sélectionné');
				}

			break;

			case 'deleteComment':

				if(isset($_GET['id'], $_GET['token']) && $_GET['token'] == $_SESSION['token'])
				{
					$commentId = (int) $_GET['id'];
					if($commentId > 0)
					{
						$commentController = new CommentController();
						$commentController->deleteComment($commentId);
					}
					else
					{
						throw new Exception('Ce commentaire n\'existe pas.');
					}
				}
				else
				{
					throw new Exception('Aucun commentaire n\'a été sélectionné.');
				}

			break;

			case 'deletePost':

				if(isset($_GET['id'], $_GET['token']) && $_GET['token'] == $_SESSION['token'])
				{
					$postId = (int) $_GET['id'];
					if($postId > 0)
					{
						$postController = new PostController();
						$postController->deletePost($postId);
					}
					else
					{
						throw new Exception('Cet article n\'existe pas.');
					}
				}
				else
				{
					throw new Exception('Aucun article n\'a été sélectionné.');
				}

			break;

			default:
				throw new Exception('L\'action spécifiée n\'existe pas.');
			break;
		}
	}

	else
	{
		$postController = new PostController();
		$page = 1;
		$postController->listPosts($page);
	}
}
catch(Exception $e)
{
	$errorMessage = $e->getMessage();
	require('view/errorView.php');
}
