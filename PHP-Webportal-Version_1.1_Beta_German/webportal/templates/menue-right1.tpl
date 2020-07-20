<!--// Right Menue 1 - BEGIN //-->

<style>
div.menu3 {
	border-radius: 10px;
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
}
</style>
<script>
	$(document).ready(function () {
		$(".hilde3").hide();
		$(".menu3").click(function () {
			$(".hilde3").show(1000);
		});
		$(".menu3").dblclick(function () {
			$(".hilde3").hide(1000);
		});
	});
</script>

<table width="140">
 <tr>
  <td align="center">
<div class="menu3">
 <p>Tools Men&uuml;</p>
 <div class="hilde3">
<br><A HREF="index.php?id=namegenerator">Namegenerator</A><br><A HREF="index.php?id=passgen">Passwortgenerator</A><BR><A HREF="index.php?id=client">Client Info</A><br><br>Besucher:<br><img src="counter.php" alt="counter"><br><br>
 </div>
</div>
  </td>
 </tr>
</table>

<!--// Right Menue 1 - END //-->