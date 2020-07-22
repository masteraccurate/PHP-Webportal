<?php
$std_sid = "show";
if(isset($_GET['sid']) && $_GET['sid'] != "NULL" && $_GET['sid'] != "" && $_GET['sid'] != "0" && $_GET['sid'] != "false") {
	$sid = htmlspecialchars($_GET['sid'], ENT_QUOTES);
} else {
	$sid = $std_sid;
}
class profile {
	function title() {
		return "Profil";
	}
	function main() {
		global $id,$sid;
		$main = new main();
		$content = "";
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			if($sid == "post") {
				$dbpass = base64_decode($main->config('dbpass'));
				$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
				$crypt_pass = crypt(htmlspecialchars($_POST['pass'], ENT_QUOTES),$main->config('salt'));
				$statement = "UPDATE user SET pass='".$crypt_pass."', email='".htmlspecialchars($_POST['email'], ENT_QUOTES)."', homepage='".htmlspecialchars($_POST['homepage'], ENT_QUOTES)."' WHERE user='".$_SESSION['user']."'";
				$result = mysqli_query($connect,$statement);
				if(isset($result)) {
					$msg = "Benutzer-Profil von <b>".$_SESSION['user']."</b> ist konfiguriert!<br>\n<br>\n<a href=\"index.php?id=profile\">Zur&uuml;ck zum Profil</a>";
				} else {
					$msg = "UPDATEFEHLER";
				}
				$content = $msg;
				mysqli_close($connect);
			} elseif($sid == "form") {
				$dbpass = base64_decode($main->config('dbpass'));
				$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
				$result = mysqli_query($connect, "SELECT * FROM user WHERE user='".$_SESSION['user']."'");
				$row = mysqli_fetch_array($result, MYSQLI_BOTH);
				$email = $row['email'];
				$homepage = $row['homepage'];
				$template = new template();
				$content = $template->load("profile_form.tpl");
				$content = str_replace(">>USER<<",$_SESSION['user'],$content);
				$content = str_replace(">>EMAIL<<",$email,$content);
				$content = str_replace(">>HOMEPAGE<<",$homepage,$content);
				mysqli_close($connect);
			} else {
				$dbpass = base64_decode($main->config('dbpass'));
				$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
				$limit = "0";
				$page = "";
				$result = mysqli_query($connect, "SELECT * FROM user WHERE user='".$_SESSION['user']."'");
				if(!$result){
					$main = new main();
					$content = $main->error("3","ERROR CONNECTING");
				}
				$row = mysqli_fetch_array($result, MYSQLI_BOTH);
				$content_var = "ID: ".$row['id']."<br>\nBenutzername: ".$row['user']."<br>\nE-Mail: ".$row['email']."<br>\nHomepage: ".$row['homepage']."<br>\n";

				$link = "<br>\n<a href=\"index.php?id=profile&sid=form\">Profil &auml;ndern</a>";
				$content = $content_var.$link;
				mysqli_free_result($result);
				mysqli_close($connect);
			}
		} else {
			$content = "Dieser Bereich steht nur registrierten Benutzern zur Verfügung.";
		}
		return $content;
	}
}
?>