<?php

require_once 'Model/PostsHandler.php';

class EditPostView{

	private $title = "title";
	private $post = "post";
	private $author ="author";
	private $id ="id";
	private $categorypick ="categorypick";
	private $postbutton ="postbutton";

		const POST_UPDATED = 0;
		const TITLE_IS_EMPTY = 1;
		const POST_IS_EMPTY = 2;
		const AUTHOR_IS_EMPTY = 3;
		const NO_HACK = 4;

	public function EditPostForm($blogpost){
			$ret = '
				<div id="blogpostForm">
					<form method="POST">										
						<div class="">
							<p id="fieldtext">Titel:</p>
							<p><input type="text" id="blogposttitle" name="'.$this->title.'" value="'.$blogpost->getTitle().'" /></p>
						</div>					
						<div class="">
							<p id="fieldtext">Text:</p>
							<p><textarea type="text" id="blogposttext" name="'.$this->post.'"  rows="20" cols="80"/>'.$blogpost->getPost().'</textarea></p>
						</div>					
						<div class="">	
							<p id="fieldtext">Författare:</p>
							<p><input type="text" id="blogpostauthor" name="'.$this->author.'" value="'.$blogpost->getAuthor().'"" /></p>
						</div>									
						<div class="">	
							<p><button name="'.$this->postbutton.'" class="button" id="button"">Redigera inlägg</button></p>
						</div>				
					</form>						
				</div>';
				return $ret;
		}

	public function NotLoggedInAsAdmin(){
		$ret="<div>Du måste logga in som admin för att kunna redigera ett inlägg</div>";

		return $ret;
	}

		//Hämtar det som har skrivits i titelfältet.
	public function GetTitle(){
		if(isset ($_POST[$this->title])){
			return $_POST[$this->title];
		}
	}
	//Hämtar det som har skrivits i inläggfältet.	
	public function GetPost(){
		if(isset($_POST[$this->post])){
			return $_POST[$this->post];
		}
	}
	//Hämtar författaren.
	public function GetAuthor(){
		if(isset($_POST[$this->author])){
			return $_POST[$this->author];
		}
	}
	//Hämtar ID.
	public function GetId(){		
		if(isset ($_GET[$this->id])){
			return $_GET[$this->id];
		}
	}
	//Funktion till skapa inlägg knappen
	public function TriedToEditPost(){
		if(isset($_POST[$this->postbutton])){
			return TRUE;
		}
		return FALSE;
	}

		//Funktion med felmeddelanden som visas när man skapar en post.
		public static function Message($n){
				$message = null;
				
				switch($n){
					case self::POST_UPDATED:
						$message .= "<p id='fieldtext2'>Inlägget har redigerats</p>";
						break;
						
					case self::TITLE_IS_EMPTY:
						$message .= "<p id='fieldtext2'> En title saknas </p>";
						break;
						
					case self::POST_IS_EMPTY:
						$message .= "<p id='fieldtext2'>En text saknas</p>";
						break;
						
					case self::AUTHOR_IS_EMPTY:
						$message .= "<p id='fieldtext2'>Du måste ange en författare</p>";
						break;
					case self::NO_HACK:
						$message .= "<p id='fieldtext2'>Du får inte skicka med sånt</p>";
						break;
				}			
			
			return "<p class='message'> $message</p>";
			
		}	
}