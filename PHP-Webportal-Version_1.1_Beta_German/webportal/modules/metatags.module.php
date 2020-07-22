<?php
class metatags {
	function title() {
		return "Meta-Tags";
	}
	function main() {
		if(!isset($_GET['url'])) {
			$template = new template();
			$content = $template->load("metatags.tpl");
#			header("location: index.php?id=metatags");
		} else {
			$url = urldecode($_GET['url']);
			@$metatags = get_meta_tags("http://$url");
			if(is_array($metatags)) {
				$var_line = "<br>The following Metatags was found on <a href=\"http://$url\">$url</a>:<br>";
				foreach($metatags as $key=>$val) {
					$line .= "<p>$key:<br>$val</p>\n"; 
				}
				$content = $line_var.$line;
			} else {
				$content = "No Metatags for <a href\"http://$url\">$url</a> found.<br>"; 
			}
		}
		return $content;
	}
}
?>