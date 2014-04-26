<?php

class CategoryArray{
	
	private $category = array();
	
	public function __construct(){
		
	}
	//Lägger till ett inlägg i arrayen
	public function add(Category $category){
		$this->categorys[] = $category;
	}
	//Hämtar kategorier ifrån arrayen.
	public function getCategorys(){
		return $this->categorys;
	}
	
}

class Category{
	
	private $id;
	private $category;
	
	public function __construct($id, $category){
		$this->id = $id;
		$this->category = $category;
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getCategory(){
		return $this->category;
	}
	
	
	
}