<table border="0">
<tr><td colspan="2" align="center">

	<form action="index.php?id=login&action=activate" id="login" method="post">
	<label class="h2" form="comment"><u>Aktivierung</u></label>
</td></tr>
<tr><td>
	<label for="user">Benutzername</label>
</td><td>
	<input name="user" id="user" maxlength="255" pattern="[a-zA-Z0-9]+" required> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="pass">Passwort</label>
</td><td>
	<input type="password" minlength="8" maxlength="64" name="pass" id="pass" maxlength="255" pattern="(?=.{8,}$)(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).*" required  autocomplete="off"> [min 8 Char mit Symbol]

</td></tr>
<tr><td>
	<label for="active">Aktivierungsnummer</label>
</td><td>
	<input name="active" value=">>anr<<" id="active" maxlength="255" type="text" pattern="[0-9]{8}" required> [0-9 x8 Char]
</td></tr>
<tr><td>
	<button type="reset">Eingaben zur&uuml;cksetzen</button>
</td><td>
	<button type="submit">Eingaben absenden</button>
	</form>
</td></tr>
</table>