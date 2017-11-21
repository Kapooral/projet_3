<?php

require('News.php');

class Comment extends News
{
	private $_id;
	private $_postId;
	private $_author;
	private $_content;
	private $_commentDate;

	public function __construct(array $data)
	{
		parent::__construct($data);
	}

	public function setId($id)
	{
		$id = (int) $id;

		if($id > 0)
		{
			$this->_id = $id;
		}
	}

	public function setPostId($postId)
	{
		$postId = (int) $postId;

		if($postId > 0)
		{
			$this->_postId = $postId;
		}
	}

	public function setAuthor($author)
	{
		$author = (string) $author;
		$this->_author = $author;
	}

	public function setContent($content)
	{
		$content = (string) $content;
		$this->_content = $content;
	}

	public function setCommentDate($commentDate)
	{
		$this->_commentDate = $commentDate;
	}

	public function id()
	{
		return $this->_id;
	}

	public function postId()
	{
		return $this->_postId;
	}

	public function author()
	{
		return $this->_author;
	}

	public function content()
	{
		return $this->_content;
	}

	public function commentDate()
	{
		return $this->_commentDate;
	}
}