<?php

require_once 'Model/CommentsHandler.php';
require_once 'Model/PostsHandler.php';

class CreateCommentView{

	private $id = "id";
	private $comment ="comment";
	private $createcommentbutton ="createcommentbutton";
	private $title ="title";
	private $deleteCommentID ="deleteCommentID";
	private $deleteComment ="deleteComment";

		const COMMENT_CREATED = 0;
		const COMMENT_IS_EMPTY = 1;
		const NOT_LOGGED_IN = 2;
		const NO_HACK = 3;
		const DELETED = 4;

	public function CreateComment(){
				$ret = "
				<div id=commentForm'>
					<form method='POST'>
						
						<div class=''>	
							<p id='fieldtext'>Skriv en kommentar:</p>
							<p><textarea type='text' name='$this->comment' rows='10' cols='70' id='commenttext' /></textarea></p>
						</div>
																								
						<div class=''>	
							<p><button name='$this->createcommentbutton' class='button' id='button'>Kommentera</button></p>
						</div>
					</form>
				</div>";
				return $ret;
	}

	public function ShowSpecificComments($comment, $deletebutton){
		$ret = "";
		
		$ret .= "<div id='readcomments'>
			<div></br>
			<p id='commentfield'>".nl2br($comment->getComment())."</p></br>		
			</div>
			</div>
			</div>
			<div id='deleteComment'>			
			$deletebutton
			</div>
		</div>";

	
	return $ret;		
	}

	//Visar det inlägg som tilllhör det som ska kommenteras.
	public function CommentPost($blogposts){
		$ret = "";
		
		$ret .= "<div id='readcomments'>
			<div></br>
			<p id='commentfield'>".nl2br($blogposts->getTitle())."</p></br>
			<p id='commentfield'>".nl2br($blogposts->getPost())."</p></br>		
			<p id='commentfield'>".nl2br($blogposts->getAuthor())."</p></br>				
			</div>
			</div>
			</div>
		</div>";

	
	return $ret;		
	}

	public function NotLoggedIn() {		
			$ret = "
				<div id='loggInToComment'>
					<p>Du måste logga in för att kommentera</p>
				</div>";
			return $ret;
	}

	//Funktion för att ta bort en kommentar.
	 public function DeleteComment($deleteID)
	 {
			 return "<form action='' method='post'>
			 <input name='$this->deleteCommentID' type='hidden' value='".$deleteID."' />
			 <input name='$this->deleteComment' type='submit' id='commentDeletebutton' value='X' />
			 </form>"; 		
	 }

	//Funktion till skapa inlägg knappen anropar createcommentbutton knappen.
	public function TriedToComment(){
		if(isset($_POST[$this->createcommentbutton])){
			return TRUE;
		}
		return FALSE;
	}

		//Hämtar det som har skrivits i kommentarfältet.	
	public function GetComment(){
		if(isset($_POST[$this->comment])){
			return $_POST[$this->comment];
		}
	}

	//Hämtar ett specifikt inlägg som kopplas till kommentaren.
	public function GetPostid(){		
		if(isset ($_GET[$this->id])){
			return $_GET[$this->id];
		}
	}
	//Tar bort en specifik kommentar.
	public function DeleteCommentID(){
		 if(isset ($_POST[$this->deleteCommentID])){
			 return $_POST[$this->deleteCommentID];
		 }
	 }
	//Kollar om det går att ta bort en kommentar.
	 public function TriedToDeleteComment(){
		 if(isset($_POST[$this->deleteCommentID])){
			 return TRUE;
		}
		 return FALSE;
	 }
		//Funktion med felmeddelanden när validering sker när man skapar en kommentar.
		public static function Message($n){
				$message = null;
				
				switch($n){
					case self::COMMENT_CREATED:
						$message .= "<p id='fieldtext2'>Inlägget är kommenterat</p>";
						break;
					case self::COMMENT_IS_EMPTY:
						$message .= "<p id='fieldtext2'>Du måste skriva något i kommentarfältet</p>";
						break;
					case self::NOT_LOGGED_IN:
						$message .= "<p id='fieldtext2'>Du måste vara inloggad för att skriva en kommentar.</p>";
						break;
					case self::NO_HACK:
						$message .= "<p id='fieldtext2'></p>";
						break;
					 case self::DELETED:
						 $message .= "<p id='fieldtext2'>Kommentar raderad</p>";
						 break;
				}						
			return "<p class='message'> $message</p>";
			
		}	
}