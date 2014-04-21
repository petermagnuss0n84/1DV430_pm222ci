<?php

class CreatePostView{

	private $title = "";
	private $post = "";
	private $author ="";
	private $postbutton ="";

	public function CreatePostForm(){
			$ret = "<div id='createPostForm'>
					<form method='POST'>					
					<div class=''>
						<p id='fieldtext'>Titel:</p>
						<p><input type='text' id='posttitle' name='$this->title' /></p>
					</div>
					<div class=''>	
						<p id='fieldtext'>Text:</p>
						<p><textarea type='text' id='posttext' name='$this->post' rows='20' cols='90'/></textarea></p>
					</div>
					<div class=''>	
						<p id='fieldtext'>Författare:</p>
						<p><input type='text' id='postauthor' name='$this->author' /></p>
					</div>					
					<div class=''>	
						<p><button name='$this->postbutton' class='button' id='button'>Skapa inlägg</button></p>
					</div>
					</form>						
				</div>";
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
	//Funktion till skapa inlägg knappen
	public function TriedToPost(){
		if(isset($_POST[$this->postbutton])){
			return TRUE;
		}
		return FALSE;
	}
}
