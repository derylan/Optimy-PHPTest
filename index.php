<?php

//Define constant ROOT as the directory of the current file
define('ROOT', __DIR__);

//Require the NewsManager and CommentManager files
require_once(ROOT . '/utils/NewsManager.php');
require_once(ROOT . '/utils/CommentManager.php');

//Iterate over each news item retrieved from the NewsManager
foreach (NewsManager::getInstance()->listNews() as $news) {
	//Output the title of the news item
	echo("############ NEWS " . $news->getTitle() . " ############\n");
	//Output the body of the news item
	echo($news->getBody() . "\n");
	
	//Iterate over each comment item retrieved from the CommentManager
	foreach (CommentManager::getInstance()->listComments() as $comment) {
		//Check if the comment is related to the current news item
		if ($comment->getNewsId() == $news->getId()) {
			//Output the comment ID and body
			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}

//This part of the code seems redundant since comments have already been retrieved and displayed above
// $commentManager = CommentManager::getInstance();
// $c = $commentManager->listComments();