<?php

require_once 'Model/LoginHandler.php';
require_once 'View/LoginView.php';

class LoginController {

	public function DoControll(Database $db) {
		$html = "";
		$message = "";
		$loginView = new LoginView();
		$loginHandler = new LoginHandler($db);
		//$registerView = new RegisterView();
			

		//kollar ifall användaren är inloggad och sedan om användaren har gjort ett försök att logga ut.
		if ($loginHandler -> IsLoggedIn()) {
			//kollar ifall användaren har försökt logga ut.
			if ($loginView -> TriedToLogOut()) { 
				$loginHandler -> DoLogout();
				$loginView->unsetCookie();				
				$message .= $loginView->Message(LoginView::USER_LOGGED_OUT);
			}
		}
		//Kolla om användaren försöker logga in
		else if ($loginView->TriedToLogIn() || $loginView->readCookie() ) {
			if ($loginHandler->DoLogin($loginView->getUserName(), $loginView->getPassword())) {
				//Kollar om användaren vill bli ihågkommen
				if ($loginView->rememberCookie()) {
					$loginView->setCookie();					
				}
			//Går det inte att logga in meddelar vi det 
			} else {
				 $message .= $loginView->Message(LoginView::USER_LOGGED_ERROR);
			}
		}
			//Om man loggar in som admin.
		 if ($loginHandler -> LoggedInAsAdmin()) {
			$html = $loginView -> DoLogoutBoxAdmin();
			$message .= $loginView->Message(LoginView::ADMIN_LOGGED_IN);		
		}

		//Annar om användaren inte är admin.
		else if ($loginHandler -> IsLoggedIn()) {
			$html = $loginView -> DoLogoutBox();
			$message .= $loginView->Message(LoginView::USER_LOGGED_IN);
		//om användaren är utloggad visa inloggningsrutan
		} else {
			$html = $loginView -> DoLoginBox();		
			//$html .= $registerView->RegisterButton();
		}
		//retunera formuläret.
		return $html . $message;
	}
}
?>