<!--// Left Menue 1 - BEGIN //-->

<style>
div.menu1 {
	border-radius: 10px;
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
}
</style>
<script>
	$(document).ready(function () {
		$(".hilde1").hide();
		$(".menu1").click(function () {
			$(".hilde1").show(1000);
			$(".hilde2").hide(1000);
		});
		$(".menu1").dblclick(function () {
			$(".hilde1").hide(1000);
		});
	});
</script>

<table width="140">
 <tr>
  <td align="center">
<div class="menu1">
 <p>Main Menu</p>
 <div class="hilde1">
<br><A HREF="index.php?id=home">Home</A><BR><A HREF="index.php?id=gbook">Guestbook</A><BR><A HREF="index.php?id=blog">Blog</A><BR><A HREF="index.php?id=links">Links</A><BR><A HREF="index.php?id=files">Files</A><BR><A HREF="index.php?id=images">Images</A><BR><A HREF="index.php?id=media">Media</A><BR><A HREF="index.php?id=board">Board</A><BR><br>
 </div>
</div>
  </td>
 </tr>
</table>

<!--// Left Menue 1 - END //-->