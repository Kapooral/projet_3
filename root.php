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
		$_POST['title'] = htmlspecialchars($_POST['title']);
		$_POST['content'] = htmlspecialchars($_POST['content']);

		addPost($_POST['title'], $_POST['content']);
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

elseif(isset($_GET['page']))
{
	switch($_GET['page'])
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
	}
}

else
{
	require('connectionView.php');
}
