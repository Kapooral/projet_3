<?php 

require_once('Manager.php');

class AdministratorManager extends Manager
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->dbConnect();
	}

	public function add($login, $password, $email)
	{
		$req = $this->_db->prepare('INSERT INTO administrator (login, password, email) VALUES (:login, :password), :email');
		$req->bindValue(':login', $login);
		$req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
		$req->bindValue(':email', $email);
		$req->execute();
	}

	public function exists($login)
	{
		if(is_int($login))
		{
			return (bool) $this->_db->query('SELECT COUNT(*) FROM administrator WHERE id = ' . $login)->fetchColumn();
		}
		else
		{
			$req = $this->_db->prepare('SELECT COUNT(*) FROM administrator WHERE login = :login');
			$req->execute([':login' => $login]);

			return (bool) $req->fetchColumn();
		}
	}

	public function emailExists($email)
	{
		$req = $this->_db->prepare('SELECT COUNT(*) FROM administrator WHERE email = :email');
		$req->execute([':email' => $email]);

		return (bool) $req->fetchColumn();
	}

	public function get($login)
	{
		$req = $this->_db->prepare('SELECT id, login, password, email FROM administrator WHERE login = :login');
		$req->execute([':login' => $login]);
		
		$data = $req->fetch(PDO::FETCH_ASSOC);

		return new Administrator($data);
	}

	public function updatePassword($login, $password)
	{
		$req = $this->_db->prepare('UPDATE administrator SET password = :password WHERE login = :login');
		$req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
		$req->bindValue(':login', $login);
		$affectedLines = $req->execute();

		return $affectedLines;
	}

	public function updateEmail($login, $email)
	{
		$req = $this->_db->prepare('UPDATE administrator SET email = :email WHERE login = :login');
		$req->bindValue(':email', $email);
		$req->bindValue(':login', $login);
		$affectedLines = $req->execute();

		return $affectedLines;
	}
}