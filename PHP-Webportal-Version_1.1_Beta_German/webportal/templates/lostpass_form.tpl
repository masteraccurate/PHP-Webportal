<table border="0">
<tr><td colspan="2" align="center">

	<form action="index.php?id=login&amp;action=lostpass" id="login" method="post">
	<label class="h2" for="login"><u>Passwort vergessen</u></label><br><br>
	<font size="2" color="#FF0000"><b>Nach dem Absenden bekommst du eine E-Mail mit einem neuen Passwort.<br>Dieses Passwort solltest du nach dem ersten Einloggen ändern.</b></font>
</td></tr>
<tr><td>
	<label for="user">Benutzername</label>
</td><td>
	<input name="user" id="user" maxlength="255" pattern="[a-zA-Z0-9]+" required> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="email">E-Mail</label>
</td><td>
	<input name="email" id="email" maxlength="255" type="email" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" required> [name@domain.tld]
</td></tr>
<tr><td>
	<button type="reset">Eingaben zur&uuml;cksetzen</button>
</td><td>
	<button type="submit">Eingaben absenden</button>
	</form>
</td></tr>
</table>