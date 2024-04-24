<?php

class DB
{
	private $pdo;

	private static $instance = null;
	
	//Constructor to initialize the database connection
	private function __construct($dsn, $user, $password)
	{
		//Initialize PDO with connection details and handle exceptions
		try {
			$this->pdo = new PDO($dsn, $user, $password);
			//Set PDO error mode to throw exceptions
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			echo "Connection successful!";
		} catch (PDOException $e) {
			//If connection failes, echo an error messages
			echo "Connection failed: " . $e->getMessage();
		}
	}

	//Method to get an instance of the DB class
	public static function getInstance($dsn, $user, $password)
	{
		//Check if an instance already exists, otherwise create a new one
		if (null === self::$instance) {
			self::$instance = new self($dsn, $user, $password);
		}
		return self::$instance;
	}

	//Method to execute a SELECT query with optinal parameters
	public function select($sql, $params = [])
	{
		//Prepare and execute query with parameters
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
		//Return the fetched rows as an associative array
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	//Method to execute a query (INSERT, UPDATE or Delete) with optinal parameters
	public function exec($sql, $params = [])
	{
		//Prepare and execute query with parameters
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
		//Return the number of rows affected by the query
		return $stmt->rowCount();
	}

	//Method to retrieve the ID of the last inserted row
	public function lastInsertId()
	{
		//Return the ID of the last inserted row
		return $this->pdo->lastInsertId();
	}
}