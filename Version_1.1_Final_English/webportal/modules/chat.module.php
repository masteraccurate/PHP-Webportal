<?php
class chat {
	function title() {
		return "Chat";
	}
	function main() {
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			$tpl = new template();
			$content = $tpl->load("chat.tpl");
			$content = str_replace(">>USER<<",$_SESSION['user'],$content);
		} else {
			$content = "This Area is only for registred Users";
		}
		return $content;
	}
}
?>