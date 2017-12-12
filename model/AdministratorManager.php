<?php 

require_once('Manager.php');

class AdministratorManager extends Manager
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->dbConnect();
	}

	public function add($login, $password)
	{
		$req = $this->_db->prepare('INSERT INTO administrator (login, password) VALUES (:login, :password)');
		$req->bindValue(':login', $login);
		$req->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
		$req->execute();
	}

	public function exists($info)
	{
		if(is_int($info))
		{
			return (bool) $this->_db->query('SELECT COUNT(*) FROM administrator WHERE id = ' . $info)->fetchColumn();
		}
		else
		{
			$req = $this->_db->prepare('SELECT COUNT(*) FROM administrator WHERE login = :login');
			$req->execute([':login' => $info]);

			return (bool) $req->fetchColumn();
		}
	}

	public function get($login)
	{
		$req = $this->_db->prepare('SELECT id, login, password FROM administrator WHERE login = :login');
		$req->execute([':login' => $login]);
		
		$data = $req->fetch(PDO::FETCH_ASSOC);

		return new Administrator($data);
	}

	public function update(Administrator $admin)
	{
		$req = $this->_db->prepare('UPDATE administrator SET login = :login, password = :password WHERE id = :id');
		$req->bindValue(':login', $admin->login());
		$req->bindValue(':password', password_hash($admin->password(), PASSWORD_DEFAULT));
		$req->bindValue(':id', $admin->id());
		$req->execute();
	}
}