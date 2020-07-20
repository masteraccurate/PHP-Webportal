<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=board&amp;sid=postsubcat&amp;cid=>>CID<<" method="post">
	<label class="h2"><u>Forumkategorieeintragung</u></label>
</td></tr>
<tr><td>
	<label for="title">Titel</label>
</td><td>
	<input name="title" id="title" type="text" maxlength="255" required pattern="[a-zA-Z0-9-#+*| ]+"> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="description">Beschreibung</label>
</td><td>
	<textarea rows="5" cols="30" name="description" id="description" required></textarea>
</td></tr>
<tr><td>
	<label for="catid">Kategorie-ID</label>
</td><td>
	<input name="catid" id="name" type="text" maxlength="255" value=">>CID<<" readonly required> [readonly]
</td></tr>
<tr><td>
	<label for="name">Name</label>
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
<a href="index.php?id=board&cid=>>CID<<">Zur&uuml;ck zum Forum</a>