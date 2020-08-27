<!--// Right Menue 1 - BEGIN //-->

<style>
.tr_show4 {
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
	background-color: black;
	color: white;
	width: 160px;
}
.tr_hide4 {
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
	border: 1px solid black;
	background-color: white;
	width: 160px;
	color: black;
}
#td_pad4 {
	padding:10px;
}
</style>
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