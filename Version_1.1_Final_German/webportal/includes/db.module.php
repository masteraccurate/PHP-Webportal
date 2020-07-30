<?php
class Database extends mysqli {
	public function __construct($host, $user, $pass, $db) {
		parent::__construct($host, $user, $pass, $db);
		if (mysqli_connect_error()) {
			$main = new main();
			return $main->error(3,mysqli_connect_errno()." - ".mysqli_connect_error());
		}
	}
}
?>