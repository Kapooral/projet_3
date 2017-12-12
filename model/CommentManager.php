<?php

require_once('Manager.php');

class CommentManager extends Manager
{
	private $_db;

	public function __construct()
	{
		$this->_db = $this->dbConnect();
	}

	public function postComment($postId, $author, $content)
	{
	    $req = $this->_db->prepare('INSERT INTO comment(postId, author, content, reporting, comment_date) VALUES(:postId, :author, :content, 0, NOW())');
	    $req->bindValue(':postId', $postId);
	    $req->bindValue('author', $author);
	    $req->bindValue('content', $content);
	    $affectedLines = $req->execute();

	    return $affectedLines;
	}

	public function exists($id)
	{
		$req = $this->_db->prepare('SELECT COUNT(*) FROM comment WHERE id = :id');
		$req->execute([':id' => $id]);

		return (bool) $req->fetchColumn();
	}

	public function getComments($postId)
	{
		$comments = [];

	    $req = $this->_db->prepare('SELECT id, author, content, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS commentDate FROM comment WHERE postId = :postId ORDER BY comment_date DESC');
	    $req->execute([':postId' => $postId]);

	    while($data = $req->fetch(PDO::FETCH_ASSOC))
	    {
	    	$comments[] = new Comment($data);
	    }

	    return $comments;
	}

	public function lastComments($postId)
	{
		$comments = [];

		$req = $this->_db->prepare('SELECT id, author, content, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS commentDate FROM comment WHERE postId = :postId ORDER BY comment_date DESC LIMIT 0, 10');
		$req->execute(['postId' => $postId]);
		while($data = $req->fetch(PDO::FETCH_ASSOC))
		{
			$comments [] = new Comment($data);
		}

		return $comments;
	}

	public function get($id)
	{
		$req = $this->_db->prepare('SELECT id, author, content, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS commentDate FROM comment WHERE id = :id');
		$req->execute([':id' => $id]);

		return new Comment($req->fetch(PDO::FETCH_ASSOC));
	}

	public function report($id)
	{
		$req = $this->_db->prepare('UPDATE comment SET reporting = reporting+1 WHERE id = :id');
		$affectedLines = $req->execute([':id' => $id]);

		return $affectedLines;
	}

	public function getReported()
	{
		$comments = [];
		$req = $this->_db->query('SELECT id, author, content, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS commentDate FROM comment WHERE reporting > 0 ORDER BY reporting DESC');

		while($data = $req->fetch(PDO::FETCH_ASSOC))
			{
				$comments [] = new Comment($data);
			}

		return $comments;
	}

	public function authorize($id)
	{
		$req = $this->_db->prepare('UPDATE comment SET reporting = 0 WHERE id = :id');
		$affectedLines = $req->execute([':id' => $id]);

		return $affectedLines;
	}

	public function delete($id)
	{
		$req = $this->_db->exec('DELETE FROM comment WHERE id = ' . $id);

		return $req;
	}

	public function deletePostComments($postId)
	{
		$req = $this->_db->exec('DELETE FROM comment WHERE postId = ' . $postId);
	}

	public function count()
	{
		return $this->_db->query('SELECT COUNT(*) FROM comment')->fetchColumn();
	}

	public function countReported()
	{
		return $this->_db->query('SELECT COUNT(*) FROM comment WHERE reporting > 0')->fetchColumn();
	}
}