<form action="base64.php" method="post">
<input type="text" name="pass">
<input type="submit" value="submit">
</form>
<?php
if(isset($_POST['pass'])) {
	$pass = $_POST['pass'];
	echo "Password: ".$pass."<br>\n";
	$pass = base64_encode($pass);
	echo "Encoded Password: ".$pass."<br>\n";
}
?>