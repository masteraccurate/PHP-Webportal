<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=links&amp;sid=post&amp;cid=>>CID<<" method="post">
	<label class="h2"><u>Linkeintragung</u></label>
</td></tr>
<tr><td>
	<label for="title">Titel</label>
</td><td>
	<input name="title" id="title" type="text" maxlength="255" required pattern="[a-zA-Z0-9-#+| ]+"> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="url">URL</label>
</td><td>
	<input name="url" id="url" type="text" maxlength="255" required pattern="https?://.+"> [http:// oder https://]
</td></tr>
<tr><td>
	<label for="description">Beschreibung</label>
</td><td>
	<textarea rows="5" cols="30" name="description" id="description" required></textarea>
<!--	<div class="dropdown">
		<span><img src="images/smileys/smiley1.png"></span>
		<div class="dropdown-content">
			<a href="javascript:smiley(1)"><img src="images/smileys/smiley1.png" border="0" alt=":)"></a>
			<a href="javascript:smiley(3)"><img src="images/smileys/smiley2.png" border="0" alt=":D"></a>
			<a href="javascript:smiley(2)"><img src="images/smileys/smiley3.png" border="0" alt=";)"></a>
			<a href="javascript:symbol(1)">{br}</a>
		</div>
	</div> -->
</td></tr>
<tr><td>
	<label for="catid">Kategorie-ID</label>
</td><td>
	<input name="catid" id="name" type="text" maxlength="255" value=">>CID<<" readonly required> [readonly]
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
<a href="index.php?id=links&cid=>>CID<<">Zur&uuml;ck zu den Links</a>