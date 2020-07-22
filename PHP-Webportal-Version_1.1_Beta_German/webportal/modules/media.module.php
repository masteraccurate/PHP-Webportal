<?php
class media {
	function title() {
		return "Medien";
	}
	function main() {
		global $id,$cid;
		$main = new main();
		$content = "";
		if(isset($_GET['cid']) && ($_GET['cid'] != "") && empty($_GET['sid'])) {
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
			$result = mysqli_query($connect, "SELECT * FROM media WHERE catid='".htmlspecialchars($_GET['cid'])."' ORDER by id LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "Medien-ID: ".$row['id']."<br>\nURL: <a href=\"".$row['url']."\" target=\"_BLANK\">".$row['title']."</a><br>\nBeschreibung: ".$row['description']."<br>\nBenutzername: ".$row['name']."<br>\n Uhrzeit: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<br><hr>\n";
				$content .= $content_var;
			}
			$result = mysqli_query($connect, "SELECT id FROM media WHERE catid='".htmlspecialchars($_GET['cid'], ENT_QUOTES)."' ORDER by id");
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
				$sites .= "<a href=\"index.php?id=media&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=media&amp;sid=media_form&cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Medien eintragen</a><br>\n<br><hr>\n";
			$render = str_replace("\n","",$content);
			$render = str_replace("\r","",$render);
			if(isset($_SESSION['loggedin'])) {
				$render = $link.$render;
			}
			$content = $render."Seite: ".$sites."<br><br><a href=\"index.php?id=media\">Zur&uuml;ck zu den Kategorien</a>";
			mysqli_free_result($result);
			mysqli_close($connect);
		} elseif(isset($_GET['sid']) && isset($_GET['cid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "media_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("media_form.tpl");
			$content = str_replace(">>CID<<",htmlspecialchars($_GET['cid'], ENT_QUOTES),$content);
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "media_cat_form") && ($_SESSION['loggedin'] == "1")) {
			$template = new template();
			$content = $template->load("media_cat_form.tpl");
			$content = str_replace(">>NAME<<",$_SESSION['user'],$content);
		} elseif(isset($_GET['sid']) && ($_GET['sid'] != "") && ($_GET['sid'] == "post") && ($_SESSION['loggedin'] == "1")) {
			sleep(1);  // 1 second pause for spam-protection
			$content = "";
			$render = "";
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$datetime = date("U");
			$post_title = htmlspecialchars($_POST['title'], ENT_QUOTES);
			$post_url = htmlspecialchars($_POST['url'], ENT_QUOTES);
			$post_description = htmlspecialchars($_POST['description'], ENT_QUOTES);
			$post_catid = htmlspecialchars($_POST['catid'], ENT_QUOTES);
			$post_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
			$statement = "INSERT INTO media (id,title,url,description,catid,name,datetime) VALUES(NULL,'".$post_title."','".$post_url."','".$post_description."','".$post_catid."','".$post_name."','".$datetime."')";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=media&amp;cid=".htmlspecialchars($_GET['cid'], ENT_QUOTES)."\">Zur Medien-Kategorie</a><br>\n<br>\n";
				$content = "Medien in Datenbank eingetragen! ".$link;
			} else {
				$content = "ERROR POSTING MEDIA!\n";
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
			$statement = "INSERT INTO media_cat (catid,category,name,datetime) VALUES(NULL,'".$post_category."','".$post_name."','".$datetime."')";
			$result = mysqli_query($connect,$statement);
			if(isset($result)) {
				$link = "<a href=\"index.php?id=media\">Zu den Medien-Kategorien</a><br>\n<br>\n";
				$content = "Medien-Kategorie in Datenbank eingetragen! ".$link;
			} else {
				$content = "ERROR POSTING MEDIA KATEGORY!\n";
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
			$result = mysqli_query($connect, "SELECT * FROM media_cat ORDER by catid LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "CatID: ".$row['catid']."<br>\nKategorie: ".$row['category']."<br>\nBenutzername: ".$row['name']."<br>\n Uhrzeit: ".date('Y-m-d H:i:s', $row['datetime'])."<br>\n<a href=\"index.php?id=media&cid=".$row['catid']."\">&Ouml;ffne Kategorie</a><br><hr>\n";
				$content .= $content_var;
			}
			$result = mysqli_query($connect, "SELECT * FROM media_cat ORDER by catid");
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
				$sites .= "<a href=\"index.php?id=media&amp;page=".$i."\">".$i."</a>&nbsp;";
			}
			$link = "<a href=\"index.php?id=media&amp;sid=media_cat_form\">Kategorie eintragen</a><br>\n<br><hr>\n";
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