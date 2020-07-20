<?php
class template {
	function load($template) {
		global $config;
		$line = "";
		$file = $config['tpl_dir']."/".$template;
		if(file_exists($file)) {
			$fp = fopen($file,"r");
			while(!feof($fp)) {
				$line .= fgets($fp,8192);
			}
			fclose($fp);
		} else {
			$main = new main();
			$line = $main->error("1",$file);
		}
		return($line);
	}
}
?>
