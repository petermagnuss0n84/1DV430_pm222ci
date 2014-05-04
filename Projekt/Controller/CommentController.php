<?php

require_once 'Model/CommentsHandler.php';
require_once 'View/CreateCommentView.php';
require_once 'Model/LoginHandler.php';

class CommentController{

	private $ret = "";
	private $message = "";
	private $error = FALSE;

	public function DoControll(Database $db){
		$createCommentView = new CreateCommentView();
		$commentsHandler = new CommentsHandler($db);
		$loginHandler = new LoginHandler($db);
		//$postid = $_GET['id'];
		//$id = $_GET['id'];

		//skapar kommentarfomuläret endast om man är inloggad.
		if($loginHandler->IsLoggedIn() === true){
			$this->ret .= $createCommentView->CreateComment();
		}
		else {
			$this->ret .= $createCommentView->NotLoggedIn();
		}

			//Meddelanden när man försöker kommentera.
		if($createCommentView->TriedToComment()){
			
			if($loginHandler->IsLoggedIn() === FALSE){
				$this->message .= $createCommentView->Message(CreateCommentView::NOT_LOGGED_IN);
				$this->error = TRUE;
			}
			
			if($commentsHandler->commentIsEmpty($createCommentView->GetComment())){
				$this->message .= $createCommentView->Message(CreateCommentView::COMMENT_IS_EMPTY);
				$this->error = TRUE;
			}
						
			if($commentsHandler->validateComment($createCommentView->GetComment()) === FALSE){
				$this->message .=$createCommentView->Message(CreateCommentView::NO_HACK);
				$this->error = TRUE;
			}
			
			if($this->error === FALSE){
				
				if($commentsHandler->CreateComment($createCommentView->GetComment(), $createCommentView->GetPostid())){
					$this->message .= $createCommentView->Message(CreateCommentView::COMMENT_CREATED);
		
				}
			}
						
		}
		return $this->ret .$this->message;
	}
}