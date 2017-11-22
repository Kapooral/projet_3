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
	    $req = $db->prepare('INSERT INTO comment(postId, author, content, comment_date) VALUES(:postId, :author, :content, NOW())');
	    $req->bindValue(':postId', $postId);
	    $req->bindValue('author', $author);
	    $req->bindValue('content', $content);

	    $affectedLines = $req->execute();

	    return $affectedLines;
	}

	public function exists($info)
	{
		$req = $this->_db->prepare('SELECT COUNT(*) FROM comment WHERE id = ?');
		$req->execute(array($info));

		return (bool) $req->fetchColumn();
	}

	public function getComments($postId)
	{
		$comments = [];

	    $req = $this->_db->prepare('SELECT id, author, content, DATE_FORMAT(comment_date, \'%d/%m/%Y\') AS commentDate FROM comment WHERE postId = ? ORDER BY comment_date DESC');
	    $req->execute(array($postId));

	    while($data = $req->fetch(PDO::FETCH_ASSOC))
	    {
	    	$comments[] = new Comment($data);
	    }

	    return $comments;
	}

	public function get($info)
	{
		$req = $this->_db->prepare('SELECT id, author, content, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh/%imin/%ss\') AS commentDate FROM comment WHERE id = ?');
		$req->execute(array($info));

		return new Comment($req->fetch(PDO::FETCH_ASSOC));
	}

	public function delete(Comment $comment)
	{
		$req = $this->_db->exec('DELETE FROM comment WHERE id = ' . $comment->id());
	}
}