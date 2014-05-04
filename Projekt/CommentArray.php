<?php

class BlogCommentArray{
	
	private $blogcomments = array();
	
	public function __construct(){
		
	}
	//Lägger till en kommentar i arrayen.
	public function add(Blogcomment $blogcomment){
		$this->blogcomments[] = $blogcomment;
	}
	//Hämtar arrayen.
	public function getBlogcomments(){
		return $this->blogcomments;
	}
	
}

class CommentArray{
	
	private $id;
	private $comment;
	
	//En konstruktor.
	public function __construct($id, $comment){
		$this->id = $id;
		$this->comment = $comment;
		
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getComment(){
		return $this->comment;
	}
	
	
	
}