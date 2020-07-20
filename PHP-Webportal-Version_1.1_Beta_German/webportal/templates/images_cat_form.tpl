<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=images&amp;sid=postcat" method="post">
	<label class="h2"><u>Bilder-Kategorie eintragen</u></label>
</td></tr>
<tr><td>
	<label for="category">Kategorie</label>
</td><td>
	<input name="category" id="category" type="text" maxlength="255" required pattern="[a-zA-Z0-9-#+| ]+"> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="name">Benutzername</label>
</td><td>
	<input name="name" id="name" type="text" maxlength="255" value=">>NAME<<" readonly required> [readonly]
</td></tr>
<tr><td>
	<button type="reset">Eingaben zur&uuml;cksetzen</button>
</td><td>
	<button type="submit">Eingaben absenden</button>
	</form>
</td></tr>
</table>
<br>
<a href="index.php?id=images">Zur&uuml;ck zu den Bilder-Kategorien</a>