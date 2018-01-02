<?php

class Administrator
{
	private $_id;
	private $_login;
	private $_password;
	private $_email;

	public function __construct(array $data)
	{
		$this->hydrate($data);
	}

	public function hydrate(array $data)
	{
		foreach($data as $key => $value)
		{
			$method = 'set' . ucfirst($key);

			if(method_exists($this, $method))
			{
				$this->$method($value);
			}
		}
	}

	public function setId($id)
	{
		$id = (int)$id;

		if($id > 0)
		{
			$this->_id = $id;
		}
	}

	public function setLogin($login)
	{
		$login = (string)$login;

		$this->_login = $login;
	}

	public function setPassword($password)
	{
		$this->_password = $password;
	}

	public function setEmail($email)
	{
		$this->_email = $email;
	}

	public function id()
	{
		return $this->_id;
	}

	public function login()
	{
		return $this->_login;
	}

	public function password()
	{
		return $this->_password;
	}
}