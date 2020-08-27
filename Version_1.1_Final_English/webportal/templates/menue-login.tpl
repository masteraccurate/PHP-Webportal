<!--// Login Menue - BEGIN //-->

<style>
.tr_show2 {
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
	background-color: black;
	color: white;
	width: 160px;
}
.tr_hide2 {
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
	border: 1px solid black;
	background-color: white;
	width: 160px;
	color: black;
}
#td_pad2 {
	padding:10px;
}
</style>
<script>
	$(document).ready(function () {
		$(".tr_hide2").hide();
		$(".tr_show2").css('cursor', 'pointer');
		$(".tr_show2").click(function () {
			$(".tr_hide2").show(500);
			$(".tr_hide1").hide(500);
			$(".tr_hide3").hide(500);
			$(".tr_hide4").hide(500);
		});
		$(".tr_show2").dblclick(function () {
			$(".tr_hide2").hide(500);
		});
	});
</script>

<div class="tr_show2">
 <p>Login Menu</p>
</div>
<div class="tr_hide2">
 <FORM ACTION="index.php?id=login&amp;action=login" METHOD="POST"><br>
 <LABEL FOR="user">Username:</LABEL><br><INPUT ID="user" TYPE="TEXT" NAME="user" SIZE="10" MAXLENGTH="255"><BR>
 <LABEL FOR="pass">Password:</LABEL><br><INPUT ID="pass" TYPE="PASSWORD" NAME="pass" SIZE="10" MAXLENGTH="255"><BR><br>
 <INPUT TYPE="Submit" NAME="Submit" VALUE="Login">&nbsp;&nbsp;<INPUT TYPE="RESET" NAME="Reset" VALUE="Reset"><BR><br>
 <A HREF="index.php?id=login&amp;action=register_form">Registration</a><br><A HREF="index.php?id=login&amp;action=react_form">Activation</a><br><A HREF="index.php?id=login&amp;action=lostpass_form">Lost Password</a><br><br></FORM>
</div>

<!--// Login Menue - END //-->