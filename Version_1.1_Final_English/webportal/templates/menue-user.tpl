<!--// Right User Menue - BEGIN //-->

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
			$(".hilde3").hide(1000);
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
 <p>User Menu</p>
 <div class="hilde4">
<br>User:<br>>>USER<<<BR><br><A HREF="index.php?id=login&amp;action=logout">Logout</A><BR><BR><A HREF="index.php?id=profile">Profile</A><BR><A HREF="index.php?id=members">Userlist</A><BR><A HREF="index.php?id=messenger">Messenger</A><BR><A HREF="index.php?id=chat">Chat</A><br><BR>
 </div>
</div>
  </td>
 </tr>
</table>

<!--// Right User Menue - END //-->