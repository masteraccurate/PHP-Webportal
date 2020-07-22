<?php
class client {
	function title() {
		return "Client Information";
	}
	function main() {
		if(getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif(getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif(getenv('REMOTE_ADDR')) {
			$ip = getenv('REMOTE_ADDR');
		}
		$content = "Deine IP-Adresse:<br>\n".$ip."<br><br>\nDein Hostname:<br>\n".gethostbyaddr($ip)."<br><br>\nDein Browser und Betriebsystem:<br>\n".getenv("HTTP_USER_AGENT")."<br>\n";
		return $content;
	}
}
?>