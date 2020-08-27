<!--// Left Menue 1 - BEGIN //-->

<script>
	$(document).ready(function () {
		$(".tr_hide1").hide();
		$(".tr_show1").css('cursor', 'pointer');
		$(".tr_show1").click(function () {
			$(".tr_hide1").show(500);
			$(".tr_hide2").hide(500);
			$(".tr_hide3").hide(500);
			$(".tr_hide4").hide(500);
		});
		$(".tr_show1").dblclick(function () {
			$(".tr_hide1").hide(500);
		});
	});
</script>

<div class="tr_show1">
 <p>Main Menu</p>
</div>
<div class="tr_hide1">
<br><A HREF="index.php?id=home">Home</A><BR><A HREF="index.php?id=gbook">Guestbook</A><BR><A HREF="index.php?id=blog">Blog</A><BR><A HREF="index.php?id=links">Links</A><BR><A HREF="index.php?id=files">Files</A><BR><A HREF="index.php?id=images">Images</A><BR><A HREF="index.php?id=media">Media</A><BR><A HREF="index.php?id=board">Board</A><BR><br>
</div>

<!--// Left Menue 1 - END //-->