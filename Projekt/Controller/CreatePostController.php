<?php

require_once 'View/CreatePostView.php';

class CreatePostController{

	private $ret = "";

	public function DoControll(){
		$createpostView = New CreatePostView();

		$this->ret .= $createpostView->CreatePostForm();

		return $this->ret;
	}
}