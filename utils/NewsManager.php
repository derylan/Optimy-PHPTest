<?php

require_once(ROOT . '/includes/db.inc.php');
require_once(ROOT . '/utils/DB.php');

class NewsManager
{
	private $db;
	private static $instance = null;

	private function __construct()
	{
		//Allow access of the variables defined outside the class or function
		global $dsn, $user, $password;
		//Use the 'DB::getIntance' method which returns a single point of access of the database connection
		$this->db = DB::getInstance($dsn, $user, $password);
	}

	public static function getInstance()
	{
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	* list all news
	*/
	public function listNews()
	{
		$rows = $this->db->select('SELECT * FROM `news`'); //Retrieve news from the database using $db object
		$news = [];
		foreach($rows as $row) {
			$news[] = new News( //Create a new object from each row retrieve from the database
				$row['id'],
				$row['title'],
				$row['body'],
				$row['created_at']
			);
		}

		return $news; //Return an array containing these objects
	}

	/**
	* add a record in news table
	*/
	public function addNews($title, $body)
	{
		$sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES(:title, :body, :created_at)";
		$params = [
			':title' => $title,
			':body' => $body,
			':created_at' => $date('Y-m-d')
		];
		$this->db->exec($sql, $param); //Substitute the parameter values from the $params array into the query preventing risk of SQL injection
		return $this->db->lastInsertId();
	}

	/**
	* deletes a news, and also linked comments
	*/
	public function deleteNews($id)
	{
		//Delete associated comments
		$comments = CommentManager::getInstance()->listComments(); //Iterate over the list of comments to find those associated with the news article by $id
		foreach ($comments as $comment) {
			if ($comment->getNewsId() == $id) {
				CommentManager::getInstance()->deleteComment($comment->getId()); //Delete function from the CommentManager
			}
		}

		//Delete the news article
		$sql = "DELETE FROM `news` WHERE `id`=" . $id;
		$params = [':id' => $id];
		return $this->db->exec($sql, $params);
	}
}