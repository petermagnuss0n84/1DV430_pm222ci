<?php
session_start();

require_once 'Controller/LoginController.php';
require_once 'Model/LoginHandler.php';
require_once 'Model/PostsHandler.php';
require_once 'View/PageView.php';
require_once 'DBConfig.php';
require_once 'Database.php';
require_once 'View/RegisterView.php';
require_once 'Controller/RegisterController.php';
require_once 'View/NavigationView.php';
require_once 'Controller/CreatePostController.php';
require_once 'Controller/PostsController.php';

class MasterController{
	
	public static function DoControll(){

		$navigationView = new NavigationView();
		$pageView = new PageView();
		$pageView->StyleSheet('style.css');
		$db = new Database();
		
		$db->Connect(new DBConfig);

			//Detta visas på startsidan.
			$loginController = new LoginController();
			$postsController = new PostsController();
			$controller = $loginController->DoControll($db);
			$controller .= $postsController->DoControll($db);
				
		
		//Om admin trycker på skapa nytt inlägg.
		if($navigationView->navCreatePost()){
			$createpostController = new CreatePostController();
			$loginController = new LoginController();
			$controller = $loginController->DoControll($db);
			$controller .= $createpostController->DoControll($db);
		}
		
		//Om användaren trycker på "Registrera dig" länken visas detta.
		if($navigationView->navRegister()){
			$registerController = new RegisterController();
			$controller = $registerController->DoControll($db);			
		}
		
		
		
		return $body = $pageView->GetXHTML10StrictPage("IT News", $controller);
		
		$db->Close();

	}

}
echo MasterController::DoControll();


?>