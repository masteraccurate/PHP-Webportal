<?php
class search {
	function title() {
		return "Search";
	}
	function main() {
		global $id,$sid,$config;
		$gbook = "";
		$blog = "";
		$links = "";
		$files = "";
		$images = "";
		$media = "";
		$board = "";
		$content = "";
		$dbpass = base64_decode($config['dbpass']);
		$con = mysqli_connect($config['dbhost'], $config['dbuser'], $dbpass, $config['dbname']);
		$name = "";
		if(isset($_GET['search'])) {
			$name = htmlspecialchars($_GET['search']);
		} else {
			$name = "";
		}
		//$query = "SELECT * FROM blog WHERE comments LIKE '%{$name}%' OR last_name LIKE '%{$name}%'";
		// Check connection
		if (mysqli_connect_errno()) {
			$content = "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con, "SELECT * FROM gbook WHERE comments LIKE '%{$name}%' OR name LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$gbook .= "<b>Gbook</b><br>Username: ".$row['name']."<br>Comment: ".$row['comments']."<br><br>\n\n";
		}
		$result = mysqli_query($con, "SELECT * FROM blog WHERE comments LIKE '%{$name}%' OR name LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$blog .= "<b>Blog</b><br>Username: ".$row['name']."<br>Comment: ".$row['comments']."<br><br>\n\n";
		}
		$result = mysqli_query($con, "SELECT * FROM links WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$links .= "<b>Links</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=links&cid=".$row['catid']."\">Title: ".$row['title']."<br></a>Description: ".$row['description']."<br><br>\n\n";
		}
		$result = mysqli_query($con, "SELECT * FROM files WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$files .= "<b>Files</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=files&cid=".$row['catid']."\">Title: ".$row['title']."<br></a>Description: ".$row['description']."<br><br>\n\n";
		}
		$result = mysqli_query($con, "SELECT * FROM images WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$images .= "<b>Images</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=images&cid=".$row['catid']."\">Title: ".$row['title']."</a><br>Description: ".$row['description']."<br><br>\n\n";
		}
		$result = mysqli_query($con, "SELECT * FROM media WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR description LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$media .= "<b>Media</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=media&cid=".$row['catid']."\">Title: ".$row['title']."</a><br>Description: ".$row['description']."<br><br>\n\n";
		}
		$result = mysqli_query($con, "SELECT * FROM board WHERE name LIKE '%{$name}%' OR title LIKE '%{$name}%' OR comment LIKE '%{$name}%'");
		while ($row = mysqli_fetch_array($result)) {
			$board .= "<b>Board</b><br>Username: ".$row['name']."<br><a href=\"index.php?id=board&cid=".$row['catid']."&scid=".$row['subcatid']."\">Title: ".$row['title']."</a><br>Comment: ".$row['comment']."<br><br>\n\n";
		}
		mysqli_close($con);
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