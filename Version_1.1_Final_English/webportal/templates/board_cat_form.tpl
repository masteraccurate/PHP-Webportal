<table border="0">
<tr><td colspan="2" align="center">
	<form name="ADD" action="index.php?id=board&amp;sid=postcat" method="post">
	<label class="h2"><u>Post Board-Category</u></label>
</td></tr>
<tr><td>
	<label for="category">Category</label>
</td><td>
	<input name="category" id="category" type="text" maxlength="255" required pattern="[a-zA-Z0-9-#+*| ]+"> [a-z,A-Z,0-9]
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
<a href="index.php?id=board">Back to Board-Categories</a>