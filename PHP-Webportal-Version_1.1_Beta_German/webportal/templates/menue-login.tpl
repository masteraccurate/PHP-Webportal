<!--// Login Menue - BEGIN //-->

<style>
div.menu4 {
	border-radius: 10px;
	border: 1px solid black;
	border-collapse: seperate;
	box-shadow: 10px 10px 15px silver;
	font-size: 1em;
}
</style>
<script>
	$(document).ready(function () {
		$(".hilde4").hide();
		$(".menu4").click(function () {
			$(".hilde4").show(1000);
		});
		$(".menu4").dblclick(function () {
			$(".hilde4").hide(1000);
		});
	});
</script>

<table width="140">
 <tr>
  <td align="center">
<div class="menu4">
 <p>Login Men&uuml;</p>
 <div class="hilde4">
<FORM ACTION="index.php?id=login&amp;action=login" METHOD="POST"><br>

<LABEL FOR="user">Benutzer:</LABEL><br><INPUT ID="user" TYPE="TEXT" NAME="user" SIZE="10" MAXLENGTH="255"><BR>

<LABEL FOR="pass">Passwort:</LABEL><br><INPUT ID="pass" TYPE="PASSWORD" NAME="pass" SIZE="10" MAXLENGTH="255"><BR><br>

<INPUT TYPE="Submit" NAME="Submit" VALUE="Login">&nbsp;&nbsp;<INPUT TYPE="RESET" NAME="Reset" VALUE="Reset"><BR><br>
<A HREF="index.php?id=login&amp;action=register_form">Registrieren</a><br><A HREF="index.php?id=login&amp;action=react_form">Aktivieren</a><br><A HREF="index.php?id=login&amp;action=lostpass_form">Passwort vergessen</a><br><br></FORM>
 </div>
</div>
  </td>
 </tr>
</table>

<!--// Login Menue - END //-->