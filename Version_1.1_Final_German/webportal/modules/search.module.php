<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     search.module.php              #
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

class search {
	function title() {
		return "Suchen";
	}
	function main() {
		global $id,$sid;
		$main = new main();
		$gbook = "";
		$blog = "";
		$links = "";
		$files = "";
		$images = "";
		$media = "";
		$board = "";
		$content = "";
		$dbpass = base64_decode($main->config('dbpass'));
		$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
		$name = "";
		if(isset($_GET['search'])) {
			$name = htmlspecialchars($_GET['search'], ENT_QUOTES);
		} else {
			$name = "";
		}
		$result = $db->query("SELECT * FROM gbook WHERE comments LIKE '%{$name}%' OR name LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$gbook .= "<b>Gbook</b><br>Username: ".$row['name']."<br>Kommentar: ".$row['comments']."<br><br>\n\n";
		}
		$result = $db->query("SELECT * FROM blog WHERE comments LIKE '%{$name}%' OR name LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$blog .= "<b>Blog</b><br>Username: ".$row['name']."<br>Kommentar: ".$row['comments']."<br><br>\n\n";
		}
		$result = $db->query("SELECT * FROM links WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$links .= "<b>Links</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=links&cid=".$row['catid']."\">Title: ".$row['title']."<br></a>Beschreibung: ".$row['description']."<br><br>\n\n";
		}
		$result = $db->query("SELECT * FROM files WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$files .= "<b>Files</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=files&cid=".$row['catid']."\">Title: ".$row['title']."<br></a>Beschreibung: ".$row['description']."<br><br>\n\n";
		}
		$result = $db->query("SELECT * FROM images WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$images .= "<b>Images</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=images&cid=".$row['catid']."\">Title: ".$row['title']."</a><br>Beschreibung: ".$row['description']."<br><br>\n\n";
		}
		$result = $db->query("SELECT * FROM media WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$media .= "<b>Media</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=media&cid=".$row['catid']."\">Title: ".$row['title']."</a><br>Beschreibung: ".$row['description']."<br><br>\n\n";
		}
		$result = $db->query("SELECT * FROM board WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR comment LIKE '%{$name}%'");
		while ($row = $result->fetch_array(MYSQLI_BOTH)) {
			$board .= "<b>Board</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=board&cid=".$row['catid']."&scid=".$row['subcatid']."\">Title: ".$row['title']."</a><br>Kommentar: ".$row['comment']."<br><br>\n\n";
		}
		$db->close();
		if(isset($name) && ($name != "")) {
			$content = $gbook.$blog.$links.$files.$images.$media.$board;
			if(empty($content)) {
				$content = "Nothing found in Database";
			}
		} else {
			$content = "Nothing to search!";
		}
		$smiley1 = "<img src=\"images/smileys/smiley1.png\">";
		$smiley2 = "<img src=\"images/smileys/smiley2.png\">";
		$smiley3 = "<img src=\"images/smileys/smiley3.png\">";
		$content = str_replace(":)",$smiley1,$content);
		$content = str_replace(":D",$smiley2,$content);
		$content = str_replace(";)",$smiley3,$content);
		$content = str_replace("{br}","<br>",$content);
		$render = str_replace("\n","",$content);
		$render = str_replace("\r","",$render);
		return $render;
	}
}
?>