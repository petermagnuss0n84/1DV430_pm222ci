<?php

require_once 'Model/PostsHandler.php';
require_once 'View/PostsView.php';
require_once 'Model/LoginHandler.php';

class PostsController{

	private $ret = "";
	private $message = "";

	public function DoControll(Database $db){

		$postsHandler = new PostsHandler($db);
		$postsView = new PostsView();
		$loginHandler = new LoginHandler($db);

		if($postsView->TriedToDeletePost()){
				if($postsHandler->DeletePost($postsView->DeletePostID())){
					$this->message .=$postsView->Message(PostsView::DELETED);					
				}
			}
		//Hämtar alla inlägg.	
		$blogposts = $postsHandler->GetPosts();
		
		//Undersöker vilken view som ska visas beroende på om man är inloggad som admin eller ej.
		if($loginHandler->LoggedInAsAdmin() === true){
				$this->ret = $postsView->ViewPostsAsAdmin($blogposts);
		}
		else
		{
			$this->ret = $postsView->ViewPosts($blogposts);
		}


		return $this->ret. $this->message;

	}
}