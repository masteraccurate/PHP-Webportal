<?php
class template {
	function load($template) {
		$main = new main();
		$line = "";
		$file = $main->config('tpl_dir')."/".$template;
		if(file_exists($file)) {
			$fp = fopen($file,"r");
			while(!feof($fp)) {
				$line .= fgets($fp,8192);
			}
			fclose($fp);
		} else {
			$line = $main->error("1",$file);
		}
		return($line);
	}
}
?>
