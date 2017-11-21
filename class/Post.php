<?php

require('News.php');

class Post extends News
{
	private $_id;
	private $_title;
	private $_content;
	private $_postDate;

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
		$content = (string) $content;
		$this->_content = $content;
	}

	public function setPostDate($date)
	{
		$date = (string) $date;
		$this->_postDate = $date;
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

	public function postDate()
	{
		return $this->_postDate;
	}
}