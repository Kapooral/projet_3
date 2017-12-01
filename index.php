<?php

session_start();

require('controler/controler.php');

if(isset($_POST['connect']) && isset($_POST['login']) && isset($_POST['password']))
{
	$_POST['login'] = htmlspecialchars($_POST['login']);
	$_POST['password'] = htmlspecialchars($_POST['password']);

	connection();
}

elseif(isset($_POST['publy']))
{
	if(!empty($_POST['title']) && !empty($_POST['content']))
	{
		addPost($_POST['title'], $_POST['content']);
	}
	else
	{
		echo 'Tous les champs ne sont pas remplis.';
	}
}

elseif(isset($_POST['update']))
{
	if(!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['content']))
	{
		updatePost($_POST['id'], $_POST['title'], $_POST['content']);
	}
	else
	{
		echo 'Tous les champs ne sont pas remplis.';
	}
}

elseif(isset($_GET['disconnect']))
{
	disconnect();
}

elseif(isset($_GET['front']))
{
	switch($_GET['front'])
	{
		case 'listPosts':
			listPosts();
		break;

		case 'post':
			if(isset($_GET['id']) && $_GET['id'] > 0)
			{
				post();
			}
		break;

		default:
			echo 'La page est inconnue.';
		break;
	}
}

elseif(isset($_GET['back']))
{
	if(isConnect())
	{
		switch($_GET['back'])
		{
			case 'backofficeView':
				header('Location: backofficeView.php');
			break;

			case 'listPosts':
				backgroundListPosts();
			break;

			case 'addPost':
				echo 'Page d\'ajout de nouvel article.';
			break;

			case 'reported':
				reported();
			break;

			case 'editPost':
				if(isset($_GET['id']) && $_GET['id'] > 0)
				{
					editPost($_GET['id']);
				}
				else
				{
					echo 'Cet article n\'existe pas.';
				}
			break;

			default:
				echo 'La page est inconnue.';
			break;
		}
	}
	else
	{
		header('Location: connectionView.php');
	}
}

elseif(isset($_GET['action']))
{
	switch($_GET['action'])
	{
		case 'postComment':
			if(isset($_GET['id']) && $_GET['id'] > 0)
			{
				if(!empty($_POST['author']) && !empty($_POST['comment']))
				{
					$_POST['author'] = htmlspecialchars($_POST['author']);
					$_POST['comment'] = htmlspecialchars($_POST['comment']);
					postComment($_GET['id'], $_POST['author'], $_POST['comment']);
				}
				else
				{
					echo 'Tous les champs ne sont pas remplis.';
				}
			}
		break;

		case 'report':
			if(isset($_GET['idComment'], $_GET['idPost']) && $_GET['idComment'] > 0)
			{
				reportComment($_GET['idComment'], $_GET['idPost']);
			}
			else
			{
				echo 'Le commentaire n\'a pas été trouvé.';
			}
		break;

		default:
			echo 'L\'action spécifiée n\'existe pas.';
		break;
	}
}

else
{
	require('connectionView.php');
}
