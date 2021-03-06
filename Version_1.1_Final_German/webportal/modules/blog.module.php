<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     blog.module.php                #
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

class blog {
	function title() {
		return "Blog";
	}
	function main() {
		$main = new main();
		$id = $main->id();
		$sid = $main->sid();
		$content = "";
		$email = "";
		if(($sid ==  "post") && ($_POST['name'] != "") && ($_POST['comment'] != "") && isset($_SESSION['loggedin'])) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$email = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			if(isset($_POST['email']) && ($_POST['email'] != "")) {
				// Validate email
				$email = htmlspecialchars($_POST['email'], ENT_QUOTES);
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					return("$email is not a valid email address");
				}
			}
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$post_email = htmlspecialchars($email, ENT_QUOTES);
			$post_comment = htmlspecialchars($_POST['comment'], ENT_QUOTES);
			$statement = "INSERT INTO blog (id,name,email,comments,datetime) VALUES(NULL,'$post_name','$post_email','$post_comment','$datetime')";
			$result = $db->query($statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=blog\">Zum Blog</a><br>\n<br>\n";
				$render = "Kommentar ins Blog eingetragen! ".$link;
			} else {
				$render = "ERROR POSTING COMMENT!\n";
			}
			$db->close();
		} elseif($sid == "post" && ($_POST['name'] == "" || empty($_POST['comment'])) && ($_SESSION['loggedin'] == "1")) {
			$render = "Bitte Name und Kommentar eingeben! <a href=\"index.php?id=blog&amp;sid=form\">Ins Blog eintragen</a>";
		} elseif(($sid == "form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$render = $template->load("blog_form.tpl");
		} else {
			$dbpass = base64_decode($main->config('dbpass'));
			$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			if(empty($_GET['page'])) {
				$page = "1";
			} else {
				$page = htmlspecialchars($_GET['page'], ENT_QUOTES);
			}
			if($page == "1") {
				$limit = "0";
			} elseif($page >= "1") {
				$page = $page-1;
				$ppage = "5";
				$page = $page*$ppage;
				$limit = 0+$page;
			}
			$result = $db->query("SELECT * FROM blog ORDER by id DESC LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$content_var = "ID: ".$row['id']."<br>\nBenutzername: ".$row['name']."<br>\nE-Mail: ".$row['email']."<br>\nKommentar: ".$row['comments']."<br>\n Uhrzeit: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<br><hr>\n";
				$content .= $content_var;
			}
			$result->close();
			$result = $db->query("SELECT * FROM blog ORDER by ID");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			$row = $result->num_rows;  // So läuft es besser als mit fetch_array!
			$sum = $row-1;
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=blog&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=blog&amp;sid=form\">Ins Blog eintragen</a><br>\n<br><hr>\n";
			$smiley1 = "<img src=\"images/smileys/smiley1.png\">";
			$smiley2 = "<img src=\"images/smileys/smiley2.png\">";
			$smiley3 = "<img src=\"images/smileys/smiley3.png\">";
			$content = str_replace(":)",$smiley1,$content);
			$content = str_replace(":D",$smiley2,$content);
			$content = str_replace(";)",$smiley3,$content);
			$content = str_replace("{br}","<br>",$content);
			$render = str_replace("\n","",$content);
			$render = str_replace("\r","",$render);
			if(isset($_SESSION['loggedin'])) {
				$render = $link.$render;
			}
			$render = $render."Seite: ".$sites;
			$db->close();
		} 
		return $render;
	}
}
?>