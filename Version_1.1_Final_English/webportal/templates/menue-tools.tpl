<!--// Right Menue 1 - BEGIN //-->

<script>
	$(document).ready(function () {
		$(".tr_hide4").hide();
		$(".tr_show4").css('cursor', 'pointer');
		$(".tr_show4").click(function () {
			$(".tr_hide4").show(500);
			$(".tr_hide1").hide(500);
			$(".tr_hide2").hide(500);
			$(".tr_hide3").hide(500);
		});
		$(".tr_show4").dblclick(function () {
			$(".tr_hide4").hide(500);
		});
	});
</script>

<div class="tr_show4">
 <p>Tools Menu</p>
</div>
<div class="tr_hide4">
<br><A HREF="index.php?id=namegenerator">Namegenerator</A><br><A HREF="index.php?id=passgen">Passwordgenerator</A><BR><A HREF="index.php?id=client">Client Info</A><br><br>Visitors:<br><img src="counter.php" alt="counter"><br><br>
</div>

<!--// Right Menue 1 - END //-->