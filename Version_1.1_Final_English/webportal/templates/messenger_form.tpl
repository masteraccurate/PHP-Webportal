<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=messenger&amp;sid=post" method="post">
	<label class="h2"><u>Send Message</u></label>
</td></tr>
<tr><td>
	<label for="name">Username (Receiver)</label>
</td><td>
	<input name="name" id="name" type="text" maxlength="255" required pattern="[a-zA-Z0-9]+"> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="sender">Username (Sender)</label>
</td><td>
	<input name="sender" id="sender" type="text" value=">>SENDER<<" maxlength="255" pattern="[a-zA-Z0-9]+" required readonly> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="message">Message</label>
</td><td>
	<textarea rows="5" cols="30" name="message" id="message" required></textarea>
	<div class="dropdown">
		<span><img src="images/smileys/smiley1.png"></span>
		<div class="dropdown-content">
			<a href="javascript:smileys(1)"><img src="images/smileys/smiley1.png" border="0" alt=":)"></a>
			<a href="javascript:smileys(3)"><img src="images/smileys/smiley2.png" border="0" alt=":D"></a>
			<a href="javascript:smileys(2)"><img src="images/smileys/smiley3.png" border="0" alt=";)"></a>
			<a href="javascript:symbols(1)">{br}</a>
		</div>
	</div>
</td></tr>
<tr><td>
	<button type="reset">Reset</button>
</td><td>
	<button type="submit">Send</button>
	</form>
</td></tr>
</table>
<br>
<a href="index.php?id=messenger">Back to Messenger</a>