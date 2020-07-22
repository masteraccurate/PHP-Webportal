<!--// Left Search Menue - BEGIN //-->

<style>
div.menu2 {
	border-radius: 10px;
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
}
</style>
<script>
	$(document).ready(function () {
		$(".hilde2").hide();
		$(".menu2").click(function () {
			$(".hilde2").show(1000);
			$(".hilde1").hide(1000);
		});
		$(".menu2").dblclick(function () {
			$(".hilde2").hide(1000);
		});
	});
</script>

<table width="140">
 <tr>
  <td align="center">
<div class="menu2">
 <p>Such Men&uuml;</p>
 <div class="hilde2">
<FORM ACTION="index.php?id=search" METHOD="GET"><br><INPUT TYPE="hidden" NAME="id" VALUE="search"><INPUT TYPE="TEXT" NAME="search" SIZE="10" MAXLENGTH="256" PLACEHOLDER="Suchen..."><br><br><INPUT TYPE="Submit" VALUE="Suchen"><br><br></FORM>
 </div>
</div>
  </td>
 </tr>
</table>

<!--// Left Search Menue - END //-->