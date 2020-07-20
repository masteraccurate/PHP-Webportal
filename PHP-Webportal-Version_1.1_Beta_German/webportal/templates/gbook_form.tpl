<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=gbook&amp;sid=post" method="post">
	<label class="h2"><u>G&auml;stebucheintragung</u></label>
</td></tr>
<tr><td>
	<label for="name">Name</label>
</td><td>
	<input name="name" id="name" type="text" maxlength="255" required pattern="[a-zA-Z0-9]+"> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="email">E-Mail (optional)</label>
</td><td>
	<input name="email" id="email" type="email" maxlength="255" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}"> [name@domain.tdl]
</td></tr>
<tr><td>
	<label for="comment">Kommentar</label>
</td><td>
	<textarea rows="5" cols="30" name="comment" id="comment" required></textarea>
	<div class="dropdown">
		<span><img src="images/smileys/smiley1.png"></span>
		<div class="dropdown-content">
			<a href="javascript:smiley(1)"><img src="images/smileys/smiley1.png" border="0" alt=":)"></a>
			<a href="javascript:smiley(3)"><img src="images/smileys/smiley2.png" border="0" alt=":D"></a>
			<a href="javascript:smiley(2)"><img src="images/smileys/smiley3.png" border="0" alt=";)"></a>
			<a href="javascript:symbol(1)">{br}</a>
		</div>
	</div>
</td></tr>
<tr><td>
	<button type="reset">Eingaben zur&uuml;cksetzen</button>
</td><td>
	<button type="submit">Eingaben absenden</button>
	</form>
</td></tr>
</table>
<br>
<a href="index.php?id=gbook">Zur&uuml;ck zum G&auml;stebuch</a>