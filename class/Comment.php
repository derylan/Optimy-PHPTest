<?php

class Comment
{
	//Set properties to private visibility to prevent direct modification of the object's state
	private $id;
	private $body;
	private $createdAt;
	private $newsId;

	//Use construct to initialize the object's properties using the provided arguments or default values
	public function __construct($id = null, $body = '', $createdAt = null, $newsId = null)
	{ 
		$this->id = $id;
		$this->body = $body;
		$this->createdAt = $createdAt;
		$this->newsId = $newsId;
	}

	//Getters and setter for each property
	//Return statement in the setters aren't necessary as it only assign values to properties
	
	//ID property
	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	//Body property
	public function getBody()
	{
		return $this->body;
	}

	public function setBody($body)
	{
		$this->body = $body;
	}

	//Created property
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	//News ID property
	public function getNewsId()
	{
		return $this->newsId;
	}

	public function setNewsId($newsId)
	{
		$this->newsId = $newsId;
	}
}