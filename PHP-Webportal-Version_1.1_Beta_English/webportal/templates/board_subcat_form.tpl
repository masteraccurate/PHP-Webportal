<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=board&amp;sid=postsubcat&amp;cid=>>CID<<" method="post">
	<label class="h2"><u>Post Forumcategory</u></label>
</td></tr>
<tr><td>
	<label for="title">Title</label>
</td><td>
	<input name="title" id="title" type="text" maxlength="255" required pattern="[a-zA-Z0-9-#+*| ]+"> [a-z,A-Z,0-9]
</td></tr>
<tr><td>
	<label for="description">Description</label>
</td><td>
	<textarea rows="5" cols="30" name="description" id="description" required></textarea>
</td></tr>
<tr><td>
	<label for="catid">Category-ID</label>
</td><td>
	<input name="catid" id="name" type="text" maxlength="255" value=">>CID<<" readonly required> [readonly]
</td></tr>
<tr><td>
	<label for="name">Name</label>
</td><td>
	<input name="name" id="name" type="text" maxlength="255" value=">>NAME<<" readonly required> [readonly]
</td></tr>
<tr><td>
	<button type="reset">Reset</button>
</td><td>
	<button type="submit">Submit</button>
	</form>
</td></tr>
</table>
<br>
<a href="index.php?id=board&cid=>>CID<<">Back to Forum</a>