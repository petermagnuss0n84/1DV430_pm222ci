<?php

require_once 'Validate.php';
require_once 'PostArray.php';

class PostsHandler{

	private $db;
	private $validate;
	
	public function __construct(Database $db){

		$this->db = $db;
		$this->validate = new Validate();
	}

	public function CreatePost(){

		$sqlQuery = "INSERT INTO posts(title, post, author) VALUES(?, ?, ?)";

		$stmt = $this->db->Prepare($sqlQuery);
		
		$stmt->bind_param('sss', $title, $post, $author);
		
		if($this->db->Execute($stmt) === TRUE){
			return TRUE;
		}
			return FALSE;
	}

	//Kollar så att det finns en titel.
	public function titleIsEmpty($title){
		if(empty($title)){
			return TRUE;
		}
		return FALSE;		
	}
	//Kollar så att det finns någon text till inlägget.
	public function postIsEmpty($post){
		if(empty($post)){
			return TRUE;
		}
		return FALSE;
	} 
	 //Kollar så att en författare har angets.
	public function authorIsEmpty($author){
		if(empty($author)){
			return TRUE;
		}
		return FALSE;
	} 
	
	//Validerar det som skickas in och kollar så att det inte är skadlig kod.
	public function validateTitle($title){
		if($this->validate->Strings($title)){
			return true;
		}
		return false;
	}
	
	public function validatePost($post){
		if($this->validate->Strings($post)){
			return true;
		}
		return false;
	}
	
	public function validateAuthor($author){
		if($this->validate->Strings($author)){
			return true;
		}
		return false;
	}
	

}