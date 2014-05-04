<?php

require_once 'Validate.php';
require_once 'CommentArray.php';

class CommentsHandler{

	private $db;
	private $validate;

	public function __construct(Database $db){
		$this->db = $db;
		$this->validate = new Validate();
	}

	//Funktion för att skapa en kommentar till databasen.
	public function CreateComment($comment, $postid){
		$sqlQuery = "INSERT INTO comments(comment, postid) VALUES(?, ?)";
		
		$stmt = $this->db->Prepare($sqlQuery);
		
		$stmt->bind_param('si', $comment, $postid);
		
		if($this->db->Execute($stmt) === TRUE){
			return TRUE;
		}
			return FALSE;
	}

		//Kollar så att användaren har skrivit en kommentar
	public function commentIsEmpty($comment){
		if(empty($comment)){
			return TRUE;
		}
		return FALSE;
	} 
	
	public function validateComment($comment){
		if($this->validate->Strings($comment)){
			return true;
		}
		return false;
	}
}