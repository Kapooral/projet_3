<?php 

include_once('model/AdministratorManager.php');
include_once('model/Administrator.php');

class AdministratorController
{
	public function connection($login, $password)
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
	    		$_SESSION['administrator'] = serialize($administrator);
	    		header('Location: index?back=backOfficeView&token=' . $_SESSION['token']);
	    	}
	    }
	}

	public function resetPasswordView()
	{
		require('view/backend/resetPasswordView.php');
	}

	public function resetPassword($login, $email)
	{
		$newPass = uniqid();
		$administratorManager = new AdministratorManager();

		if($administratorManager->exists($login) && $administratorManager->emailExists($email))
		{
			$affectedLines = $administratorManager->updatePassword($login, $newPass);

			if($affectedLines === false)
			{
				throw new Exception('Le mot de passe n\'a pas pu être réinitialisé.');
			}

			else
			{
				$message = 'Votre nouveau mot de passe est : ' . $newPass;

				if(mail($email, 'Réinitialisation de mot de passe', $message))
				{
					header('Content-type: text/javascript');
					$json = array('success' => 1, 'text' => 'Mot de passe réinitialisé !');

					echo json_encode($json);
				}
				else
				{
					throw new Exception('Le mot de passe n\'a pas pu être réinitialisé.');
				}
			}
		}
	}

	public function updatePassword($login, $password)
	{
		$administratorManager = new AdministratorManager();
		$affectedLines = $administratorManager->updatePassword($login, $password);

		if($affectedLines === false)
		{
			throw new Exception('Impossible de mettre à jour le mot de passe.');
		}
		else
		{
			unset($_SESSION['administrator']);

			$administrator = $administratorManager->get($login);
			$_SESSION['administrator'] = serialize($administrator);
	    	header('Location: index?back=backOfficeView&token=' . $_SESSION['token']);
		}
	}

	public function updateEmail($login, $email)
	{
		$administratorManager = new AdministratorManager();
		$affectedLines = $administratorManager->updateEmail($login, $email);

		if($affectedLines === false)
		{
			throw new Exception('Impossible de mettre à jour l\'adresse e-mail.');
		}
		else
		{
			unset($_SESSION['administrator']);

			$administrator = $administratorManager->get($login);
			$_SESSION['administrator'] = serialize($administrator);
	    	header('Location: index?back=backOfficeView&token=' . $_SESSION['token']);
		}
	}
		
	public function isConnect()
	{
		return isset($_SESSION['administrator']);
	}

	public function disconnect()
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

	public function backOffice()
	{
		$commentManager = new CommentManager();
		$postManager = new PostManager();

		require('view\backend\backOfficeView.php');
	}

	public function editInfos()
	{
		require('view\backend\editInfos.php');
	}
}