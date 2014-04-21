<?php
	
	require_once 'Model/RegisterHandler.php';
	
	class RegisterView {
		
		private $username = 'username';
		private $password = 'password';
		private $password2 = 'password2';
		private $register = 'register';
		private $nav = 'index.php';

		const USER_REGISTER = 0;
		const NAME_DOES_EXIST = 1;
		const NAME_IS_EMPTY = 2;
		const PASS_IS_EMPTY = 3;
		const PASS_NOT_EQUAL = 4;
		const PASS_NOT_GOOD = 5;
		
		public function UserInfo() {		
			$ret = "
				<div id='registerForm'>
					<form method='POST'>
					
						
						<div class=''>
							<p>Användarnamn:</p>
							<p><input type='text' name='$this->username' /></p>
						</div>
						
						<div class=''>	
							<p>Lösenord:</p>
							<p><input type='password' name='$this->password' /></p>
						</div>
						
						<div class=''>	
							<p>Repetera Lösenord:</p>
							<p><input type='password' name='$this->password2' /></p>
						</div>
						
						<div class=''>	
							<p><button name='$this->register' class='button' id='register'>Skapa användare</button></p>
						</div>
					</form>	
					<a href ='$this->nav'>Logga in</a>
				</div>";
				return $ret;
		}
		
		//Hämtar användarnamnet som har skrivits in av användaren.
		public function GetUsername(){
			if(isset($_POST[$this->username])){
				return $_POST[$this->username];
			}
		}
		//Hämtar lösenordet som har skrivits in av användaren.
		public function GetPassword(){
			if(isset($_POST[$this->password])){
				return $_POST[$this->password];
			}
		}
		//Hämtar det andra lösenordet.
		public function GetPassword2(){
			if(isset($_POST[$this->password2])){
				return $_POST[$this->password2];
			}
		}
		//Kollar så att det är samma lösenord som har skrivit in av användaren.
		public function checkPasswords($password, $password2){
			if($password !== $password2){
				return TRUE;
			}
			return FALSE;
		}
		//Kollar ifall användaren har tryckt på registerar knappen.
		public function TriedToRegister(){
			if(isset($_POST[$this->register])){
				return TRUE;
			}
			return FALSE;
		}
		
		//Funktion med felmeddelanden när man registerar sig.
		public static function Message($n){
				$message = null;
				
				switch($n){
					case self::USER_REGISTER:
						$message .= "Du är nu registrerad";
						break;
						
					case self::NAME_DOES_EXIST:
						$message .= "Detta användarnamn är redan upptaget";
						break;
						
					case self::NAME_IS_EMPTY:
						$message .= "Du måste skriva ett användarnamn";
						break;
						
					case self::PASS_IS_EMPTY:
						$message .= "Du måste skriva ett lösenord";
						break;
						
					case self::PASS_NOT_EQUAL:
						$message .= "Lösenorden stämmer inte överens";
						break;
					case self::PASS_NOT_GOOD:
						$message .= "Lösenordet måste ha 6 tecken eller mer, och innehålla stora och små bokstäver samt minst en siffra";
						break;
				}			
			


			return "<p class='message'> $message</p>";
			
		}
	}