<?php

//set_include_path('.;D:\Documents\Programmation\PHP-MySQL\wamp64\www\projet3');

function loadClass($class)
{
    require( 'model/' . $class . '.php');
}

spl_autoload_register('loadClass');

function connection()
{
    $administratorManager = new AdministratorManager();

    if($administratorManager->exists($_POST['login']))
    {
    	try
    	{
    		$administrator = $administratorManager->get($_POST['login'], $_POST['password']);

    		$_SESSION['administrator'] = $administrator;
    		require('backofficeView.php');
    	}
        catch(Exception $e)
        {
        	echo $e->getMessage();
        }
    }
    else
    {
    	echo 'Identifiants incorrects.';
    }
}

function isConnect()
{
    return isset($_SESSION['administrator']);
}

function disconnect()
{
	if(isset($_SESSION['administrator']))
	{
		session_destroy();
	    header('Location: index.php');
	    exit();
	}
    else
    {
    	echo 'Aucune session n\'est en cours.';
    }
}

function addPost($title, $content)
{
	$postManager = new PostManager();
	try
	{
		$postManager->addPost($title, $content);
		header('Location: index.php?back=backofficeView');
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
}

function editPost($id)
{
	$postManager = new PostManager();
	if($postManager->exists($id))
	{
		$post = $postManager->get($id);
		require('editPostView.php');
	}
	else
	{
		echo 'Cet article n\'existe pas.';
	}
}

function updatePost($id, $title, $content)
{
	$postManager = new PostManager();
	$postManager->update($id, $title, $content);
	header('Location: index.php?back=listPosts');
}

function listPosts()
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('listPostsView.php');
}

function backgroundListPosts()
{
	$postManager = new PostManager();
	$posts = $postManager->getPosts();
	require('backgroundListPostsView.php');
}

function commentsReported()
{
	$commentManager = new CommentManager();
	
}

function post()
{
	$postManager = new PostManager();
	$commentManager = new CommentManager();

    $post = $postManager->get($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('postView.php');
}

function postComment($postId, $author, $comment)
{
	$commentManager = new CommentManager();

	try
	{
		$commentManager->postComment($postId, $author, $comment);
		header('Location: index.php?front=post&id=' . $postId);
	} 
    catch(Exception $e)
    {
    	echo $e->getMessage();
    }
}


function reportComment($id, $postId)
{
	$commentManager = new CommentManager();
	if($commentManager->exists($id))
	{
		try
		{
			$commentManager->report($id);
			header('Location: index.php?front=post&id=' . $postId);
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	else
	{
		echo 'Ce commentaire n\'existe pas.';
	}
}

function reported()
{
	$commentManager = new CommentManager();
	$comments = $commentManager->getReported();
	require('commentsReportedView.php');
}

function authorize($info)
{
	$commentManager = new CommentManager();
	$commentManager->authorize($info);

	header('Location: index.php?back=reported');	
}

function deleteComment($info)
{
	$commentManager = new CommentManager();
	$commentManager->delete($info);

	header('Location: index.php?back=reported');
}
