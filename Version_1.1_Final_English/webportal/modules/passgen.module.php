<?php
class passgen {
	function title() {
		return "Passwort Generator";
	}
	function main() {
		function createRandomPassword($length=8,$chars="") { 
			if($chars=="") {
				$chars = "abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789!#$%^&*()_-+=}]{[|?";
			}
			srand((double)microtime()*1000000); 
			$i = 0; 
			$pass = '' ; 
			while ($i < $length) { 
				$num = rand() % strlen($chars); 
				$tmp = substr($chars, $num, 1); 
				$pass = $pass . $tmp; 
				$i++; 
			} 
			return $pass; 
		}
		$content = createRandomPassword();
		return "Generated Password: ".$content."<br><br>\n<a href=\"index.php?id=passgen\">Generate new Password</a><br><br>Generate a new password as often as you want until you find a suitable one.";
	}
}
?>