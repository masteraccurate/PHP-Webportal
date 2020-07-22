<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     board.module.php               #
# Date:         2020-06-23                     #
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

class board {
	function title() {
		return "Board";
	}
	function main() {
		global $id,$cid;
		$main = new main();
		$content = "";
		if(isset($_GET['cid']) && ($_GET['cid'] != "") && empty($_GET['sid']) && empty($_GET['scid'])) {
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
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
			$result = mysqli_query($connect, "SELECT * FROM board_subcat WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' ORDER by subcatid LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "Subcat-ID: ".$row['subcatid']."<br>\nForum: <a href=\"index.php?id=board&cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."&scid=".$row['subcatid']."\">".$row['title']."</a><br>\nDescription: ".$row['description']."<br>\nUsername: ".$row['name']."<br>\n Datetime: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<br><hr>\n";
				$content .= $content_var;
			}
			$result = mysqli_query($connect, "SELECT subcatid FROM board_subcat WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' ORDER by subcatid");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			$row = mysqli_num_rows($result);
			$sum = $row-1;
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=board&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=board&amp;sid=board_subcat_form&cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Post Forum</a><br>\n<br><hr>\n";
			$render = str_replace("\n","",$content);
			$render = str_replace("\r","",$render);
			if(isset($_SESSION['loggedin'])) {
				$render = $link.$render;
			}
			$content = $render."Seite: ".$sites."<br><br><a href=\"index.php?id=board\">Back to Categories</a>";
			mysqli_free_result($result);
			mysqli_close($connect);
		} elseif(isset($_GET['cid']) && ($_GET['cid'] != "") && empty($_GET['sid']) && isset($_GET['scid'])) {
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
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
			$result = mysqli_query($connect, "SELECT * FROM board WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' AND subcatid='".htmlspecialchars($_GET['scid'], ENT_QUOTES)."' ORDER by subcatid LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "ID: ".$row['id']."<br>\nTitle: ".$row['title']."<br>\nComment: ".$row['comment']."<br>\nUsername: ".$row['name']."<br>\n Datetime: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<br><hr>\n";
				$content .= $content_var;
			}
			$result = mysqli_query($connect, "SELECT subcatid FROM board_subcat WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' ORDER by subcatid");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			$row = mysqli_num_rows($result);
			$sum = $row-1;
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=board&amp;scid=".htmlspecialchars($_GET['scid'], ENT_QUOTES)."&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=board&amp;sid=board_form&cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."&scid=".htmlspecialchars($_GET['scid'], ENT_QUOTES)."\">Post Comment</a><br>\n<br><hr>\n";
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
			$content = $render."Seite: ".$sites."<br><br><a href=\"index.php?id=board&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Back to Forums</a>";
			mysqli_free_result($result);
			mysqli_close($connect);
		} elseif(isset($_GET['sid']) && isset($_GET['cid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "board_subcat_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("board_subcat_form.tpl");
			$content = str_replace(">>CID<<",htmlspecialchars($_GET['cid'], ENT_QUOTES),$content);
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "board_cat_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("board_cat_form.tpl");
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "board_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("board_form.tpl");
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
			$content = str_replace(">>CID<<",htmlspecialchars($_GET['cid'], ENT_QUOTES),$content);
			$content = str_replace(">>SCID<<",htmlspecialchars($_GET['scid'], ENT_QUOTES),$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "postsubcat") && ($_SESSION['loggedin'] == "1")) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			$post_title = htmlspecialchars($_POST['title'], ENT_QUOTES);
			$post_description = htmlspecialchars($_POST['description'], ENT_QUOTES);
			$post_catid = htmlspecialchars($_POST['catid'], ENT_QUOTES);
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$statement = "INSERT INTO board_subcat (subcatid,title,description,catid,name,datetime) VALUES(NULL,'".$post_title."','".$post_description."','".$post_catid."','".$post_name."','".$datetime."')";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=board&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Go to Board-Category</a><br>\n<br>\n";
				$content = "Forum posted in Database! ".$link;
			} else {
				$content = "ERROR POSTING FORUM!\n";
			}
			mysqli_close($connect);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "post") && ($_SESSION['loggedin'] == "1")) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			$post_title = htmlspecialchars($_POST['title'], ENT_QUOTES);
			$post_comment = htmlspecialchars($_POST['comment'], ENT_QUOTES);
			$post_catid = htmlspecialchars($_POST['catid'], ENT_QUOTES);
			$post_subcatid = htmlspecialchars($_POST['subcatid'], ENT_QUOTES);
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$statement = "INSERT INTO board (id,title,comment,catid,subcatid,name,datetime) VALUES(NULL,'".$post_title."','".$post_comment."','".$post_catid."','".$post_subcatid."','".$post_name."','".$datetime."')";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=board&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."&amp;scid=".htmlspecialchars($_GET['scid'], ENT_QUOTES)."\">Back to Forum</a><br>\n<br>\n";
				$content = "Forum-Comment posted in Database! ".$link;
			} else {
				$content = "ERROR FORUM POST!\n";
			}
			mysqli_close($connect);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "postcat") && ($_SESSION['loggedin'] == "1")) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			$post_category = htmlspecialchars($_POST['category'], ENT_QUOTES);
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$statement = "INSERT INTO board_cat (catid,category,name,datetime) VALUES(NULL,'".$post_category."','".$post_name."','".$datetime."')";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=board\">Back to Board-Categories</a><br>\n<br>\n";
				$content = "Board-Category posted in Database! ".$link;
			} else {
				$content = "ERROR POSTING BOARD CATEGORY!\n";
			}
			mysqli_close($connect);
		} else {
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
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
			$result = mysqli_query($connect, "SELECT * FROM board_cat ORDER by catid LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "CatID: ".$row['catid']."<br>\nCategory: ".$row['category']."<br>\nUsername: ".$row['name']."<br>\n Datetime: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<a href=\"index.php?id=board&cid=".$row['catid']."\">Open Category</a><br><hr>\n";
				$content .= $content_var;
			}
			$result = mysqli_query($connect, "SELECT * FROM board_cat ORDER by catid");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			$sites = "";
			$site_sum = "";
			$sum = "";
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$id_var = $row['catid'];
				$sum = $id_var-1;
			}
			$site_sum = $sum/5;
			$site_sum = floor($site_sum);
			$site_sum = $site_sum+1;
			$i = "";
			for($i=1;$i<=$site_sum; ++$i) {
				$sites .= "<a href=\"index.php?id=board&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=board&amp;sid=board_cat_form\">Post Category</a><br>\n<br><hr>\n";
			$render = str_replace("\n","",$content);
			$render = str_replace("\r","",$render);
			if(isset($_SESSION['loggedin'])) {
				$render = $link.$render;
			}
			$content = $render."Seite: ".$sites;
			mysqli_free_result($result);
			mysqli_close($connect);
		} 
		return $content;
	}
}
?>