<?php

function loadClass($class)
{
    require( 'model/' . $class . '.php');
}

spl_autoload_register('loadClass');

function connection($login, $password)
{
    $administratorManager = new AdministratorManager();

    if(!$administratorManager->exists($login))
    {
    	throw new Exception('Identifiants incorrects.');
    }
    else
    {
    	$administrator = $administratorManager->get($login);
    	if(!password_verify($password, $administrator->password()))
    	{
    		throw new Exception('Identifiants incorrects.');
    	}
    	else
    	{
    		$_SESSION['administrator'] = $administrator;
    		header('Location: index?back=backOfficeView');
    	}
    }
}

function isConnect()
{
    return isset($_SESSION['administrator']);
}

function disconnect()
{
	if(!isset($_SESSION['administrator']))
	{
		throw new Exception('Aucune session n\'est en cours.');
	}
    else
    {
    	session_destroy();
	    header('Location: index.php');
	    exit();
    }
}

function addPost($title, $content)
{
	$postManager = new PostManager();
	$affectedLines = $postManager->addPost($title, $content);

	if($affectedLines === false)
	{
		throw new Exception('Impossible d\'ajouter cet article.');
	}
	else
	{
		header('Location: index.php?back=backOfficeView');
	}	
}

function editPost($id)
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

function updatePost($id, $title, $content)
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
			header('Location: index.php?back=listPosts');
		}
	}
}

function listPosts($currentPage)
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

function backgroundListPosts()
{
	$postManager = new PostManager();

	$posts = $postManager->getPosts();
	require('view\backend\backOfficeListPostsView.php');
}

function deletePost($postId)
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
			header('Location: index.php?back=listPosts');
		}
	}
}

function backOffice()
{
	$commentManager = new CommentManager();
	$postManager = new PostManager();

	require('view\backend\backOfficeView.php');
}

function post($id, $currentPage)
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
			$comments = $commentManager->getComments($id);
			require('view\frontend\postView.php');
		}
	}
}

function postComment($postId, $author, $comment, $page)
{
	$commentManager = new CommentManager();
	$postManager = new PostManager();

	if(!$postManager->exists($postId))
	{
		throw new Exception('Cet article n\'existe pas.');
	}
	else
	{
		$affectedLines = $commentManager->postComment($postId, $author, $comment);
		if($affectedLines === false)
		{
			throw new Exception('Ce commentaire n\'a pas pu être posté.');
		}
		else
		{
			header('Location: index.php?front=post&page='. $page . '&id=' . $postId);
		}
	}
}


function reportComment($id, $postId, $page)
{
	$commentManager = new CommentManager();
	$postManager = new PostManager();

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
			if(!$postManager->exists($postId))
			{
				throw new Exception('Cet article n\'existe pas.');
			}
			else
			{
				header('Location: index.php?front=post&page='. $page . '&id=' . $postId);
			}
		}
	}
}

function likes($postId, $page)
{
	$postManager = new PostManager();
	if(!$postManager->exists($postId))
	{
		throw new Exception('Cet article n\'existe pas.');
	}
	else
	{
		$affectedLines = $postManager->likes($postId);
		if($affectedLines === false)
		{
			throw new Exception('Cet article n\'a pas pu être liké.');
		}
		else
		{
			header('Location: index.php?front=post&page=' . $page . '&id=' . $postId);
		}
	}
}

function reported()
{
	$commentManager = new CommentManager();

	$comments = $commentManager->getReported();
	require('view\backend\commentsReportedView.php');
}

function authorize($id)
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
			header('Location: index.php?back=reported');
		}
	}
}

function deleteComment($id)
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
			header('Location: index.php?back=reported');
		}
	}
}

function uploadImage()
{
	if(isset($_FILES['image']))
	{
		if($_FILES['image']['error'] = 0)
		{
			if($_FILES['image']['size'] <= 2097152)
			{
				if(!empty($_FILES['image']['name']))
				{
					$image = $_FILES['image']['name'];
					$extensionAuthorized = ['jpg', 'jpeg', 'png'];
					$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
					if(in_array(strtolower($extension), $extensionAuthorized))
					{
						$infos = getimagesize($_FILES['image']['tmp_name']);
						if($infos[2] = 1)
						{
							$imageChoose = imagecreatefromjpeg($_FILES['image']['tmp_name']);
							$sizeImageChoose = getimagesize($_FILES['image']['tmp_name']);
							$newWidth = 350;
							$reduct = ($newWidth * 100)/$sizeImageChoose[0];
							$newHeight = ($sizeImageChoose[1] * $reduct) / 100;

							if($newImage = imagecreatetruecolor($newWidth, $newHeight))
							{
								if(imagecopyresampled($newImage, $imageChoose, 0, 0, 0, 0, $newWidth, $newHeight, $sizeImageChoose[0], $sizeImageChoose[1]))
								{
									if(imagedestroy($imageChoose))
									{
										if(imagejpeg($newImage, 'public/images/essai.' . $extension, 100))
										{
											return $nameForDb = 'public/images/essai.' . $extension;
										}
										else
										{
											throw new Exception('L\'image n\'a pas pu être enregistré.');
										}
									}
									else
									{
										throw new Exception('L\'ancienne image n\a pas pu être détruite.');
									}
								}
								else
								{
									throw new Exception('imagecopyresampled');
								}
							}
							else
							{
								throw new Exception('imagecreatetruecolor.');
							}
						}
						elseif($infos[2] = 3)
						{
							$imageChoose = imagecreatefrompng($_FILES['image']['tmp_name']);
							$sizeImageChoose = getimagesize($_FILES['image']['tmp_name']);
						}
						else
						{
							throw new Exception('Le type de l\'image est incorrect.');
						}
					}
					else
					{
						throw new Exception('Le format du fichier est incorrect.');
					}
				}
				else
				{
					throw new Exception('Le nom du fichier est vide.');
				}
			}
			else
			{
				throw new Exception('L\'image est trop lourde.');
			}
		}
		else
		{
			throw new Exception('Une erreur est survenue lors du téléchargement de l\'image');
		}
	}
}
