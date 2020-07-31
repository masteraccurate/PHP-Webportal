<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     profile.module.php             #
# Date:         2020-05-18                     #
################################################
#                  Copyright                   #
# Copyright refers to the exclusive right to   #
# a piece of work such as literature, music,   #
# artwork and computer software including the  #
# underlying algorithms, source code and the   #
# program's appearance. Rights covered include #
# copying, distributing and creating           #
# derivative works. Most software is           #
# distributed with a license or copyright      #
# notice that explains how it can be used.     #
################################################
$std_sid = "show";
if(isset($_GET['sid']) && $_GET['sid'] != "NULL" && $_GET['sid'] != "" && $_GET['sid'] != "0" && $_GET['sid'] != "false") {
	$sid = htmlspecialchars($_GET['sid'], ENT_QUOTES);
} else {
	$sid = $std_sid;
}
class profile {
	function title() {
		return "Profile";
	}
	function main() {
		global $id,$sid;
		$main = new main();
		$content = "";
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			if($sid == "post") {
				$dbpass = base64_decode($main->config('dbpass'));
				$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
				$crypt_pass = crypt(htmlspecialchars($_POST['pass'], ENT_QUOTES),$main->config('salt'));
				$statement = "UPDATE user SET pass='".$crypt_pass."', email='".htmlspecialchars($_POST['email'], ENT_QUOTES)."', homepage='".htmlspecialchars($_POST['homepage'], ENT_QUOTES)."' WHERE user='".$_SESSION['user']."'";
				$result = $db->query($statement);
				if(isset($result)) {
					$msg = "User-Profile of <b>".$_SESSION['user']."</b> is configured!<br>\n<br>\n<a href=\"index.php?id=profile\">Back to Profile</a>";
				} else {
					$msg = "UPDATE ERROR";
				}
				$content = $msg;
				$db->close();
			} elseif($sid == "form") {
				$dbpass = base64_decode($main->config('dbpass'));
				$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
				$result = $db->query("SELECT * FROM user WHERE user='".$_SESSION['user']."'");
				$row = $result->fetch_array(MYSQLI_BOTH);
				$email = $row['email'];
				$homepage = $row['homepage'];
				$template = new template();
				$content = $template->load("profile_form.tpl");
				$content = str_replace(">>USER<<",$_SESSION['user'],$content);
				$content = str_replace(">>EMAIL<<",$email,$content);
				$content = str_replace(">>HOMEPAGE<<",$homepage,$content);
				$db->close();
			} else {
				$dbpass = base64_decode($main->config('dbpass'));
				$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
				$limit = "0";
				$page = "";
				$result = $db->query("SELECT * FROM user WHERE user='".$_SESSION['user']."'");
				if(!$result){
					$content = $main->error("3","ERROR CONNECTING");
				}
				$row = $result->fetch_array(MYSQLI_BOTH);
				$content_var = "ID: ".$row['id']."<br>\nUsername: ".$row['user']."<br>\nE-Mail: ".$row['email']."<br>\nHomepage: ".$row['homepage']."<br>\n";
				$link = "<br>\n<a href=\"index.php?id=profile&sid=form\">Change Profile</a>";
				$content = $content_var.$link;
				$db->close();
			}
		} else {
			$content = "This area is only available to registered users.";
		}
		return $content;
	}
}
?>