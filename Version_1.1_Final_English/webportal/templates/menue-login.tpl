<!--// Login Menue - BEGIN //-->

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