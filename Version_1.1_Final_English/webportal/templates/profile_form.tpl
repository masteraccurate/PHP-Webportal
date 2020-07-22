<table border="0">
<tr><td colspan="2" align="center">
	<form action="index.php?id=profile&amp;sid=post" id="login" method="post">
	<label class="h2" for="login"><u>Change Profile</u></label><br>
</td></tr>
<tr><td>
	<label for="user">Username</label>
</td><td>
	<input name="user" id="user" maxlength="255" value=">>USER<<" pattern="[a-zA-Z0-9]+" required readonly> readonly!
</td></tr>
<tr><td>
	<label for="email">E-Mail</label>
</td><td>
	<input name="email" id="email" maxlength="255" type="email" value=">>EMAIL<<" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" required> [name@domain.tld]
</td></tr>
<tr><td>
	<label for="pass">Password</label>
</td><td>
	<input type="password" name="pass" id="pass" maxlength="255" pattern="(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).*" required> [min 8 Char with Symbol]

</td></tr>
<tr><td>
	<label for="homepage">Homepage (optional)</label>
</td><td>
	<input name="homepage" id="homepage" maxlength="255" type="text" value=">>HOMEPAGE<<" pattern="[a-zA-Z0-9./:-]+" value="http://"> [http://domain.tld]
</td></tr>
<tr><td>
	<button type="reset">Reset</button>
</td><td>
	<button type="submit">Submit</button>
	</form>
</td></tr>
</table>