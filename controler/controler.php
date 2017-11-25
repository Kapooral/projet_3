<?php

set_include_path('.;D:\Documents\Programmation\PHP-MySQL\wamp64\www\projet3');

function loadClass($class)
{
    require( 'model/' . $class . '.php');
}

spl_autoload_register('loadClass');

function connection()
{
    if(isset($_POST['login']) && isset($_POST['password']))
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
	    header('Location: connectionView.php');
	    exit();
	}
    else
    {
    	echo 'Aucune session n\'est en cours.';
    }
}

function listPosts()
{
	$postManager = new PostManager();
    $posts = $postManager->getPosts();
    require('listPostsView.php');
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
	} 
    catch(Exception $e)
    {
    	echo $e->getMessage();
    }

    header('Location: root.php?page=post&id=' . $postId);
}


function reportComment()
{

}

