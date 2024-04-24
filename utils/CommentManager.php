<?php

class CommentManager
{
	private static $instance = null;
	//Store the intance of the DB to instantied once and ollowing easier access throughout the class methods
	private $db;

	private function __construct()
	{
		require_once(ROOT . '/utils/DB.php');
		require_once(ROOT . '/class/Comment.php');
		//Property that holds the database connection instance
		$this->db = DB::getInstance();
	}

	//Check for the existing instance
	public static function getInstance()
	{
		if (null === self::$instance) {
			self::$instance = new self(); //If no instance exists, a new instance of the class is created
		}
		return self::$instance;
	}

	//Retrieve a list of comments from the database
	public function listComments()
	{
		$rows = $db->select('SELECT * FROM `comment`'); //Return an array of associative arrays that represent a row in the table
		$comments = [];
		foreach($rows as $row) {
			$comment = new Comment(); //Create a comment object for each row 
			$comment->setId($row['id']) //Set the properties of the comment object
			  ->setBody($row['body'])
			  ->setCreatedAt($row['created_at'])
			  ->setNewsId($row['news_id']);
			$comment[] = $comment; //Add each comment object to the array
		}
		return $comments;
	}

	public function addCommentForNews($body, $newsId)
	{
		$db = $this->db;
		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES(:body, :created_at, :news_id)";
		//Use approach that prevents directly inserting values into the SQL query and proper data handling
		$stmt = $db->prepare($sql); //Prepare the SQL statement
		$stmt->bindParam(':body', $body); //Bind the body variable to the body placeholder
		$stmt->bindParam(':created_at', date('Y-m-d')); //Bind the current date to the created placeholder
		$stmt->bindParam(':news_id', $newsId); //Bind the news ID variable to the new ID placeholder
		$stmt->execute(); //Execute the prepared statement 
		return $db->lastInsertId();
	}

	public function deleteComment($id)
	{
		$sql = "DELETE FROM `comment` WHERE `id`= :id"; //Prepares a SQL query to delete a comment from its table that match the ID
		$params = array(':id' => $id); //Create an associative array to bind values to the named parameters
		return $this->db->exec($sql, $params); //Execute the query with the parameters and return the rows affected by the delete function
	}
}