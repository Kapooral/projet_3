<?php

require_once('Manager.php');

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
		$req->bindValue(':title', $title);
		$req->bindValue(':content', $content);
		$affectedLines = $req->execute();

		return $affectedLines;
	}

	public function exists($info)
	{
		$req = $this->_db->prepare('SELECT COUNT(*) FROM news WHERE id = :id');
		$req->execute([':id' => $info]);

		return (bool) $req->fetchColumn();
	}

	public function getPosts()
	{
		$posts = [];

		$req = $this->_db->query('SELECT id, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS postDate, DATE_FORMAT(last_edit, \'%d/%m/%Y à %Hh/%imin/%ss\') AS lastEdit FROM news ORDER BY postDate DESC');

		while($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			$posts[] = new Post($data);
		}

		return $posts;
	}

	public function get($postId)
	{
	    $req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(post_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS postDate, DATE_FORMAT(last_edit, \'%d/%m/%Y à %Hh/%imin/%ss\') AS lastEdit FROM news WHERE id = :id');
	    $req->execute([':id' => $postId]);

	    return new Post($req->fetch(PDO::FETCH_ASSOC));
	}

	public function update(Post $post)
	{
		$req = $this->_db->prepare('UPDATE news SET title = :title, content = :content, last_edit = NOW()');
		$req->bindValue(':title', $post->title());
		$req->bindValue(':content', $post->content());

		$req->execute();
	}

	public function delete(Post $post)
	{
		$req = $this->_db->exec('DELETE FROM news WHERE id = ' . $post->id());
	}
}