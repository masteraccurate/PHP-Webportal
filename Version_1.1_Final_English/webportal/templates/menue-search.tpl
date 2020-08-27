<!--// Left Search Menue - BEGIN //-->

<style>
.tr_show3 {
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
	background-color: black;
	color: white;
	width: 160px;
}
.tr_hide3 {
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
	border: 1px solid black;
	background-color: white;
	width: 160px;
	color: black;
}
#td_pad3 {
	padding:10px;
}
</style>
<script>
	$(document).ready(function () {
		$(".tr_hide3").hide();
		$(".tr_show3").css('cursor', 'pointer');
		$(".tr_show3").click(function () {
			$(".tr_hide3").show(500);
			$(".tr_hide1").hide(500);
			$(".tr_hide2").hide(500);
			$(".tr_hide4").hide(500);
		});
		$(".tr_show3").dblclick(function () {
			$(".tr_hide3").hide(500);
		});
	});
</script>

<div class="tr_show3">
 <p>Search Menu</p>
</div>
<div class="tr_hide3">
<FORM ACTION="index.php" METHOD="GET"><br><INPUT TYPE="HIDDEN" NAME="id" VALUE="search"><INPUT TYPE="TEXT" NAME="search" SIZE="10" MAXLENGTH="256" PLACEHOLDER="Search..."><br><br><INPUT TYPE="Submit" VALUE="Search"><br><br></FORM>
</div>

<!--// Left Search Menue - END //-->