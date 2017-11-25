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

	    if(!$req->execute())
	    {
	    	throw new Exception('Impossible de poster le commentaire.');
	    }
	}

	public function exists($info)
	{
		$req = $this->_db->prepare('SELECT COUNT(*) FROM comment WHERE id = :id');
		$req->execute([':id' => $info]);

		return (bool) $req->fetchColumn();
	}

	public function getComments($postId)
	{
		$comments = [];

	    $req = $this->_db->prepare('SELECT id, author, content, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS commentDate FROM comment WHERE postId = :postId ORDER BY comment_date DESC');
	    $req->execute([':postId' => $postId]);

	    while($data = $req->fetch(PDO::FETCH_ASSOC))
	    {
	    	$comments[] = new Comment($data);
	    }

	    return $comments;
	}

	public function get($info)
	{
		$req = $this->_db->prepare('SELECT id, author, content, reporting, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS commentDate FROM comment WHERE id = :id');
		$req->execute([':id' => $info]);

		return new Comment($req->fetch(PDO::FETCH_ASSOC));
	}

	public function report($info)
	{
		$req = $this->_db->prepare('UPDATE comment SET reporting = reporting+1 WHERE id = :id');
		if(!$req->execute([':id' => $info]))
		{
			throw new Exception('Le commentaire n\'a pu être signalé');
		}
	}

	public function delete(Comment $comment)
	{
		$req = $this->_db->exec('DELETE FROM comment WHERE id = ' . $comment->id());
	}
}