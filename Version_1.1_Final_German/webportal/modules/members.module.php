<?php
class members {
	function title() {
		return "Benutzerliste";
	}
	function main() {
		$main = new main();
		$content = "";
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			$dbpass = base64_decode($main->config('dbpass'));
			$connect = mysqli_connect($main->config('dbhost'), $main->config('dbuser'), $dbpass, $main->config('dbname'));
			$limit = "0";
			$page = "";
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
			$result = mysqli_query($connect, "SELECT * FROM user ORDER by id LIMIT ".$limit.",5");
			if(!$result){
				$content = $main->error("3","ERROR CONNECTING");
			}
			while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
				$content_var = "ID: ".$row['id']."<br>\nBenutzername: ".$row['user']."<br>\nHomepage: <a href=\"".$row['homepage']."\" target=\"_BLANK\">".$row['homepage']."</a><br>\n<br><hr>\n";
				$content .= $content_var;
			}
			$result = mysqli_query($connect, "SELECT * FROM user ORDER by ID");
			if(!$result){
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
			$content = "Dieser Bereich steht nur registrierten Benutzern zur Verfügung.";
		}
		return $content;
	}
}
?>