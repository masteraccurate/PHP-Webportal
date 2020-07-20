<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     messenger.module.php           #
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
	$sid = htmlspecialchars($_GET['sid']);
} else {
	$sid = $std_sid;
}
class messenger {
	function title() {
		return "Messenger";
	}
	function main() {
		global $id,$sid,$config;
		$content = "";
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			if(($sid ==  "post") && ($_POST['name'] != "") && ($_POST['sender'] != "") && ($_POST['message'] != "")) {
				$dbpass = base64_decode($config['dbpass']);
				$connect = mysqli_connect($config['dbhost'], $config['dbuser'], $dbpass, $config['dbname']);
				$result = mysqli_query($connect,"SELECT user FROM user WHERE user='".htmlspecialchars($_POST['name'])."'");
				if(mysqli_num_rows($result) > 0) {
					sleep(1);  // 1 second pause for spam-protection
					$content = "";
					$render = "";
					$dbpass = base64_decode($config['dbpass']);
					$connect = mysqli_connect($config['dbhost'], $config['dbuser'], $dbpass, $config['dbname']);
					$datetime = date("U");
					$send_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
					$send_sender = htmlspecialchars($_POST['sender'], ENT_QUOTES);
					$send_message = htmlspecialchars($_POST['message'], ENT_QUOTES);
					$statement = "INSERT INTO messenger (id,name,sender,message,datetime) VALUES(NULL,'".$send_name."','".$send_sender."','".$send_message."','".$datetime."')";
					$result = mysqli_query($connect,$statement);
					if(isset($result)) {
						$link = "<a href=\"index.php?id=messenger\">Back to Messenger</a><br>\n<br>\n";
						$content = "<br>\nMessage send! ".$link;
					} else {
						$content = "ERROR SENDING MESSAGE!\n";
					}
					mysqli_close($connect);
				} else {
					$content = "Name is not in the Database!\n<br>\n<br>\n<a href=\"index.php?id=messenger&sid=form\">Compose Message</a><br>\n";

				}
			} elseif($sid == "post" && ($_POST['name'] == "" || empty($_POST['message']))) {
				$content = "Input Name (Receiver) and Message! <a href=\"index.php?id=messenger&amp;sid=form\">Send Message</a>";
			} elseif($sid == "form") {
				$template = new template();
				$content = $template->load("messenger_form.tpl");
				$content = str_replace(">>SENDER<<",$_SESSION['user'],$content);
			} else {
				$dbpass = base64_decode($config['dbpass']);
				$connect = mysqli_connect($config['dbhost'], $config['dbuser'], $dbpass, $config['dbname']);
				$limit = "0";
				$page = "";
				if(empty($_GET['page'])) {
					$page = "1";
				} else {
					$page = htmlspecialchars($_GET['page']);
				}
				if($page == "1") {
					$limit = "0";
				} elseif($page >= "1") {
					$page = $page-1;
					$ppage = "5";
					$page = $page*$ppage;
					$limit = 0+$page;
				}
				$result = mysqli_query($connect, "SELECT * FROM messenger WHERE name='".$_SESSION['user']."' ORDER by datetime DESC LIMIT ".$limit.",5");
				if(!$result){
					$main = new main();
					$content = $main->error("3","ERROR CONNECTING");
				}
				while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
					$content_var = "Message-ID: ".$row['id']."<br>\nUsername: ".$row['name']."<br>\nSender: ".$row['sender']."<br>\nMessage: ".$row['message']."<br>\n Datetime: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<br><hr>\n";
					$content .= $content_var;
				}
				$result = mysqli_query($connect, "SELECT * FROM messenger WHERE name='".$_SESSION['user']."' ORDER by ID");
				if(!$result){
					$main = new main();
					$content = $main->error("3","ERROR CONNECTING");
				}
				$sites = "";
				$site_sum = "";
				$sum = "";
				$row_cnt = mysqli_num_rows($result);
				$sum = $row_cnt-1;
				$site_sum = $sum/5;
				$site_sum = floor($site_sum);
				$site_sum = $site_sum+1;
				$i = "";
				for($i=1;$i<=$site_sum; ++$i) {
					$sites .= "<a href=\"index.php?id=messenger&amp;page=".$i."\">".$i."</a>&nbsp;";
				}
				$link = "<a href=\"index.php?id=messenger&amp;sid=form\">Send Message</a><br>\n<br><hr>\n";
				$smiley1 = "<img src=\"images/smileys/smiley1.png\">";
				$smiley2 = "<img src=\"images/smileys/smiley2.png\">";
				$smiley3 = "<img src=\"images/smileys/smiley3.png\">";
				$content = str_replace(":)",$smiley1,$content);
				$content = str_replace(":D",$smiley2,$content);
				$content = str_replace(";)",$smiley3,$content);
				$content = str_replace("{br}","<br>",$content);
				$render = str_replace("\n","",$content);
				$render = str_replace("\r","",$render);
				$content = $link.$render."Seite: ".$sites;
				mysqli_free_result($result);
				mysqli_close($connect);
			}
		} else {
			$content = "This area is only available to registered users.";
		}
		return $content;
	}
}
?>