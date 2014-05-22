<?php

require_once 'View/CreateCommentView.php';
require_once 'Model/CommentsHandler.php';
require_once 'Model/LoginHandler.php';
require_once 'Model/PostsHandler.php';


class CommentController{

	private $ret = "";
	private $message = "";
	private $error = FALSE;

	public function DoControll(Database $db){
		$createCommentView = new CreateCommentView();
		$commentsHandler = new CommentsHandler($db);
		$loginHandler = new LoginHandler($db);
		$postsHandler = new PostsHandler($db);
		$postid = $_GET['id'];
		$id = $_GET['id'];

		//Visar det inlägg som är kopplat till kommentarerna.
		$blogposts = $postsHandler->GetSpecificPost($id);
		$this->ret = $createCommentView->CommentPost($blogposts);

		//Skapar kommentarfomuläret endast om man är inloggad.
		if($loginHandler->IsLoggedIn() === true){
			$this->ret .= $createCommentView->CreateComment();
		}
		else {
			$this->ret .= $createCommentView->NotLoggedIn();
		}

		//Gör ett försök att raderar kommentaren.
		if($createCommentView->TriedToDeleteComment()){
				if($commentsHandler->DeleteComment($createCommentView->DeleteCommentID())){
					$this->message .=$createCommentView->Message(CreateCommentView::DELETED);
				}
			}

		$comments = $commentsHandler->GetSpecificComments($postid);
		foreach($comments->getBlogcomments() as $comment){

			$deletebutton = "";
			if($loginHandler->LoggedInAsAdmin() === true){
				$deletebutton = $createCommentView->DeleteComment($comment->getId());
			}
			$this->ret .= $createCommentView->ShowSpecificComments($comment, $deletebutton);

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