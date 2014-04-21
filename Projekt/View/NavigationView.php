<?php

class NavigationView{
	
	private static $RegisterView = "Register";
	private static $CreatePostView = "Admin";
		
		// Kollar om url:en säger ?Register
		public function navRegister(){
			if(isset($_GET[self::$RegisterView])){
				return true;
			}
			return false;
		}

		public function navCreatePost(){
			if(isset($_GET[self::$CreatePostView])){
				return true;
			}
			return false;
		}
		
}
