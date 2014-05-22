<?php

class NavigationView{
	
	private static $RegisterView = "Register";
	private static $CreatePostView = "Admin";
	private static $CreateCommentView = "Comments";
	private static $EditPostView = "Edit";
		
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

		public function navComment(){
			if(isset($_GET[self::$CreateCommentView])){
				return TRUE;
			}
			return FALSE;
		}

		public function navEdit(){
			if(isset($_GET[self::$EditPostView])){
				return TRUE;
			}
			return FALSE;
		}
		
}
