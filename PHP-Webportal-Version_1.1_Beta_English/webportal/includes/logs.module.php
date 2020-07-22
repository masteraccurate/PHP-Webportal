<?php
class logs {
	function create() {
		$main = new main();
		if(getenv('HTTP_X_FORWARDED_FOR')) {
			$ip = getenv('HTTP_X_FORWARDED_FOR');
		}
		elseif(getenv('HTTP_CLIENT_IP')) {
			$ip = getenv('HTTP_CLIENT_IP');
		}
		elseif(getenv('REMOTE_ADDR')) {
			$ip = getenv('REMOTE_ADDR');
		}
		$cid = getenv('HTTP_USER_AGENT')."|||".$ip."|||".date("U")."|||".getenv('REQUEST_URI');
		$file = $main->config('log_dir')."/logfile_".date("Y-m-d").".txt";
		$f = @fopen($file,"a");
		if($f) {
			fputs($f,$cid."\n");
			fclose($f);
		}
	}
}
?>