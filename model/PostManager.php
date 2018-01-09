<?php

require_once('model/Manager.php');
require_once('model/Post.php');

class PostManager extends Manager
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->dbConnect();
	}

	public function addPost($title, $content)
	{
		$req = $this->_db->prepare('INSERT INTO news (title, content, post_date, last_edit) VALUES (:title, :content, NOW(), NOW())');
		$req->bindValue(':title', $title, PDO::PARAM_STR);
		$req->bindValue(':content', $content, PDO::PARAM_STR);
		$affectedLines = $req->execute();

		return $affectedLines;
	}

	public function exists($id)
	{
		if(is_int($id))
		{
			return (bool) $this->_db->query('SELECT COUNT(*) FROM news WHERE id = '. $id)->fetchColumn();
		}
		else
		{
			$req = $this->_db->prepare('SELECT COUNT(*) FROM news WHERE title = :title');
			$req->execute([':title' => $id]);

			return (bool) $req->fetchColumn();
		}
	}

	public function getPosts()
	{
		$posts = [];

		$req = $this->_db->query('SELECT id, title, content, DATE_FORMAT(post_date, \'%d.%m.%Y\') AS postDate, DATE_FORMAT(last_edit, \'%d/%m/%Y à %Hh/%imin/%ss\') AS lastEdit FROM news ORDER BY postDate DESC');
		while($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			$posts[] = new Post($data);
		}

		return $posts;
	}

	public function get($id)
	{
		if(is_int($id))
		{
			$req = $this->_db->query('SELECT id, title, content, DATE_FORMAT(post_date, \'%d.%m.%Y\') AS postDate, DATE_FORMAT(last_edit, \'%d/%m/%Y à %Hh/%imin/%ss\') AS lastEdit FROM news WHERE id = ' . $id);

			$data = $req->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			$req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(post_date, \'%d.%m.%Y\') AS postDate, DATE_FORMAT(last_edit, \'%d/%m/%Y à %Hh/%imin/%ss\') AS lastEdit FROM news WHERE title = :title');
    		$req->execute([':title' => $id]);

    		$data = $req->fetch(PDO::FETCH_ASSOC);
		}

		return new Post($data);
	}

	public function update($id, $title, $content)
	{
		$req = $this->_db->prepare('UPDATE news SET title = :title, content = :content, last_edit = NOW() WHERE id = :id');
		$req->bindValue(':title', $title, PDO::PARAM_STR);
		$req->bindValue(':content', $content, PDO::PARAM_STR);
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$affectedLines = $req->execute();

		return $affectedLines;
	}


	public function count()
	{
		return $this->_db->query('SELECT COUNT(*) FROM news')->fetchColumn();
	}

	public function pagination($start, $nbr)
	{
		$posts = [];

		$req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(post_date, \'%d.%m.%Y\') AS postDate, DATE_FORMAT(last_edit, \'%d/%m/%Y à %Hh/%imin/%ss\') AS lastEdit FROM news LIMIT :start, :nbr');
		$req->bindValue(':start', $start, PDO::PARAM_INT);
		$req->bindValue(':nbr', $nbr, PDO::PARAM_INT);
		if(!$req->execute())
		{
			throw new Exception('Impossible de sélectionner les articles pour la pagination.');
		}
		else
		{
			while($data = $req->fetch(PDO::FETCH_ASSOC))
			{
				$posts [] = new Post($data);
			}

			return $posts;
		}
	}

	public function delete($id)
	{
		$req = $this->_db->exec('DELETE FROM news WHERE id = ' . $id);

		return $req;
	}
}