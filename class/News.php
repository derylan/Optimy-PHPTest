<?php

class News
{
	//Set properties to private visibility to prevent direct modification of the object's state
	private $id;
	private $title;
	private $body;
	private $createdAt;

	//Use construct to initialize the object's properties using the provided arguments or default values
	public function __construct($id = null, $title = '', $body = '', $createdAt = null)
	{ 
		$this->id = $id;
		$this->title = $title;
		$this->body = $body;
		$this->createdAt = $createdAt;

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

	//Title property
	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;
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
}