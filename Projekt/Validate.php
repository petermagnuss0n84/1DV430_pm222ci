<?php 

	class Validate{
		
		public function Email($email)
		{
			//regulärtutryck för om mailen skall stämma
			$regexp = "/^[^0-9][A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
			
			//matchar den med vår mail
			if (preg_match($regexp, $email)) {
				return true;
			}
			//om inte, stämmer den inte
			else {
				return false;
			}
		}
		
		//Sträng utan visning av html och javascript.
		public function Strings($strings)
		{
			$regex = "/^[a-zA-Z0-9_]{1,}$/";
			
			//regulärtutryck som inte kan ta in html och javascript.
			if (preg_match($regex, $strings)) {
				return true;
			}
			else {
				return false;
			}
		}
		
		//Tillåter viss html-kod, ej javascript.
		public function StringsHtml($html)
		{
			//Reguljärt uttryck som tar in html men inte javascritp.
			$regex = "/[<](.*?)[>]/";
			
			if (preg_match($regex, $html)) {
				return true;
			}
			else {
				return false;
			}
			
		}
		
		public function Password($password) 
		{
			//Kollar så att lösenordet är minst 6 tecken, och innehåller siffror samt stora och små bokstäver.
			$regex = "/^.*(?=.{6,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/";
			
			if (preg_match($regex, $password)) {
				return true;
			}
			else {
				return false;
			}
		}
		
	}
?>


