<?php

require_once 'Validate.php';
require_once 'PostArray.php';
require_once 'CategoryArray.php';

class PostsHandler{

	private $db;
	private $validate;
	
	public function __construct(Database $db){

		$this->db = $db;
		$this->validate = new Validate();
	}

	public function CreatePost($title, $post, $author){

		$sqlQuery = "INSERT INTO posts(title, post, author) VALUES(?, ?, ?)";

		$stmt = $this->db->Prepare($sqlQuery);
		
		$stmt->bind_param('sss', $title, $post, $author);
		
		if($this->db->Execute($stmt) === TRUE){
			return TRUE;
		}
			return FALSE;
	}
	//Funktion för att hämnta alla kategorier för att fylla dropdownlistan när ett inlägg ska skapas.
	public function GetCategory(){
		$sqlQuery = "SELECT id, category FROM category ORDER BY id DESC";
		
		$stmt = $this->db->Prepare($sqlQuery);
			
		$this->db->Execute($stmt);
		
		$stmt->bind_result($id, $category);

		while ($stmt->fetch()) {
			//Hämntar ifrån CategoryArray.php.
			$category = new CategoryArray($id, $category);
			
			$categorys[] = $category;
		}
		$stmt->close();
		return $categorys;
	}
	//Funktion för att hämta alla inlägg.
	public function GetPosts(){
		$sqlQuery = "SELECT id, title, post, author From posts ORDER BY id DESC";

		$stmt = $this->db->Prepare($sqlQuery);

		$this->db->Execute($stmt);

		$stmt->bind_result($id, $title, $post, $author);

		while ($stmt->fetch()) {
			//Hämntar ifrån PostArray.php.
			$blogpost = new PostArray($id, $title, $post, $author);
			
			$blogposts[] = $blogpost;
		}
		$stmt->close();
		return $blogposts;
	}

	//Funktion för att ta bort ett specifikt inlägg.
	public function DeletePost($deletePostID){
	
		$sqlQuery = "DELETE FROM posts WHERE id = ?";
		
		$stmt = $this->db->Prepare($sqlQuery);
		
		$stmt->bind_param('i', $deletePostID);
		
		$this->db->execute($stmt);
		
		$stmt->close();
		
		return FALSE;
	}

	//Updaterar en post.
	public function UpdatePost($title, $post, $author, $id){
		
		$sqlQuery = "UPDATE posts SET title = ?, post = ?, author = ? WHERE id = ?";
		
		$stmt = $this->db->Prepare($sqlQuery);
		$stmt->bind_param('sssi', $title, $post, $author, $id);
		
		if($this->db->Execute($stmt) === TRUE){
			return TRUE;
		}
			return FALSE;
	}

	public function GetSpecificPost($id){
		
		$sqlQuery = "SELECT id, title, post, author FROM posts WHERE id = ? ORDER BY Id Desc";
		
		$stmt = $this->db->Prepare($sqlQuery);
		
		$stmt->bind_param('i', $id);
		
		$this->db->Execute($stmt);
		
		if ($stmt->bind_result($id, $title, $post, $author) == FALSE) {
        		throw new \Exception($this->mysqli->error);
        }
		if ($stmt->fetch()) {
           	$ret = new PostArray($id, $title, $post, $author);
                        
        } else {
        	throw new \Exception("Could not find post $id");
        }
                
        $stmt->close();
                       
        return $ret;
		
		
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