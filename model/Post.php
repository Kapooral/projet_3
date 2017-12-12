<?php

require('News.php');

class Post extends News
{
	private $_id;
	private $_title;
	private $_content;
	private $_likes;
	private $_image;
	private $_postDate;
	private $_lastEdit;

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

	public function setTitle($title)
	{
		$title = (string) $title;
		$this->_title = $title;
	}

	public function setContent($content)
	{
		$content = (string) htmlspecialchars_decode($content);
		$this->_content = $content;
	}

	public function setLikes($likes)
	{
		$like = (int) $likes;
		$this->_like = $likes;
	}

	public function setImage($image)
	{
		$image = (string) $image;
		$this->_image = $image;
	}

	public function setPostDate($date)
	{
		$date = (string) $date;
		$this->_postDate = $date;
	}

	public function setLastEdit($date)
	{
		$date = (string) $date;
		$this->_lastEdit = $date;
	}

	public function id()
	{
		return $this->_id;
	}

	public function title()
	{
		return $this->_title;
	}

	public function content()
	{
		return $this->_content;
	}

	public function likes()
	{
		return $this->_likes;
	}

	public function image()
	{
		return $this->_image;
	}

	public function postDate()
	{
		return $this->_postDate;
	}

	public function lastEdit()
	{
		return $this->_lastEdit;
	}
}