<?php

require_once 'Model/PostsHandler.php';
require_once 'View/PostsView.php';
require_once 'Model/LoginHandler.php';

class PostsController{

	private $ret = "";

	public function DoControll(Database $db){

		$postsHandler = new PostsHandler($db);
		$postsView = new PostsView();

		$blogposts = $postsHandler->GetPosts();

		$this->ret = $postsView->ViewPosts($blogposts);

		return $this->ret;

	}
}