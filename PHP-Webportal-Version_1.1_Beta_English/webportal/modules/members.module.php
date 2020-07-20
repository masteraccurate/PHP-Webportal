<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     members.module.php             #
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
class members {
	function title() {
		return "Userlist";
	}
	function main() {
		global $config;
		$content = "";
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
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
			$result = mysqli_query($connect, "SELECT * FROM user ORDER by id LIMIT ".$limit.",5");
			if(!$result){
				$main = new main();
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "ID: ".$row['id']."<br>\nUsername: ".$row['user']."<br>\nHomepage: <a href=\"".$row['homepage']."\" target=\"_BLANK\">".$row['homepage']."</a><br>\n<br><hr>\n";
				$content .= $content_var;
			}

			$result = mysqli_query($connect, "SELECT * FROM user ORDER by ID");
			if(!$result){
				$main = new main();
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$id_var = $row['id'];
				$sum = $id_var-1;
			}
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=members&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$content = str_replace("\n","",$content);
			$content = str_replace("\r","",$content);
			$content = $content."Seite: ".$sites;
			mysqli_free_result($result);
			mysqli_close($connect);
		} else {
			$content = "This area is only available to registered users.";
		}
		return $content;
	}
}
?>