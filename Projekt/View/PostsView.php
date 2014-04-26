<?php

require_once 'Model/PostsHandler.php';


class PostsView{

	private $nav ="?Comments";
	private $id ="&id=";
	private $title = "title";

	public function ViewPosts($blogposts){
		$ret = "";
		foreach ($blogposts as $key => $value) {
			
			$ret .= '<div id="postsview">
				<div></br></br></br>
				<h2 id="titleview">'.nl2br($value->getTitle()).'</h2></br>
				<p id="postview">'.nl2br($value->getPost()).'</p></br>
				<p id="authorview">Skapad av:  '.$value->getAuthor().'</p>	
				</div>
						
				<a id="commentLink" href="' . $this->nav . $this->id . $value->getId() .'">Kommentera</a>
				
			</div>' ;		
			}
			return $ret;
		}

}