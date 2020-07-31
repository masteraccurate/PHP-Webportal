<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     links.module.php               #
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
class links {
	function title() {
		return "Links";
	}
	function main() {
		global $id,$cid;
		$main = new main();
		$content = "";
		if(isset($_GET['cid']) && ($_GET['cid'] != "") && empty($_GET['sid'])) {
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
			$result = $db->query("SELECT * FROM links WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' ORDER by id LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$content_var = "Link-ID: ".$row['id']."<br>\nURL: <a href=\"".$row['url']."\" target=\"_BLANK\">".$row['title']."</a><br>\nDescription: ".$row['description']."<br>\nUsername: ".$row['name']."<br>\n Datetime: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<br><hr>\n";
				$content .= $content_var;
			}
			$result->close();
			$result = $db->query("SELECT id FROM links WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' ORDER by id");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			$row = $result->num_rows;
			$sum = $row-1;
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=links&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=links&amp;sid=links_form&cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Post Link</a><br>\n<br><hr>\n";
			$render = str_replace("\n","",$content);
			$render = str_replace("\r","",$render);
			if(isset($_SESSION['loggedin'])) {
				$render = $link.$render;
			}
			$content = $render."Seite: ".$sites."<br><br><a href=\"index.php?id=links\">Back to Kategories</a>";
			$db->close();
		} elseif(isset($_GET['sid']) && isset($_GET['cid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "links_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("links_form.tpl");
			$content = str_replace(">>CID<<",htmlspecialchars($_GET['cid'], ENT_QUOTES),$content);
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "links_cat_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("links_cat_form.tpl");
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "post") && ($_SESSION['loggedin'] == "1")) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			$post_title = htmlspecialchars($_POST['title'], ENT_QUOTES);
			$post_url = htmlspecialchars($_POST['url'], ENT_QUOTES);
			$post_description = htmlspecialchars($_POST['description'], ENT_QUOTES);
			$post_catid = htmlspecialchars($_POST['catid'], ENT_QUOTES);
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$statement = "INSERT INTO links (id,title,url,description,catid,name,datetime) VALUES(NULL,'$post_title','$post_url','$post_description','$post_catid','$post_name','$datetime')";
			$result = $db->query($statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=links&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Go to Link-Category</a><br>\n<br>\n";
				$content = "Link posted in Database! ".$link;
			} else {
				$content = "ERROR POSTING LINK!\n";
			}
			$db->close();
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "postcat") && ($_SESSION['loggedin'] == "1")) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$db = new Database($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			$post_category = htmlspecialchars($_POST['category'], ENT_QUOTES);
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$statement = "INSERT INTO links_cat (catid,category,name,datetime) VALUES(NULL,'$post_category','$post_name','$datetime')";
			$result = $db->query($statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=links\">Go to Link-Categories</a><br>\n<br>\n";
				$content = "Link-Category posted in Database! ".$link;
			} else {
				$content = "ERROR POSTING LINK CATEGORY!\n";
			}
			$db->close();
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
			$result = $db->query("SELECT * FROM links_cat ORDER by catid LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$content_var = "CatID: ".$row['catid']."<br>\nCategory: ".$row['category']."<br>\nUsername: ".$row['name']."<br>\n Datetime: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<a href=\"index.php?id=links&cid=".$row['catid']."\">Open Category</a><br><hr>\n";
				$content .= $content_var;
			}
			$result->close();
			$result = $db->query("SELECT * FROM links_cat ORDER by catid");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			$row = $result->num_rows;
			$sum = $row-1;
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=links&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=links&amp;sid=links_cat_form\">Post Category</a><br>\n<br><hr>\n";
			$render = str_replace("\n","",$content);
			$render = str_replace("\r","",$render);
			if(isset($_SESSION['loggedin'])) {
				$render = $link.$render;
			}
			$content = $render."Seite: ".$sites;
			$db->close();
		} 
		return $content;
	}
}
?>