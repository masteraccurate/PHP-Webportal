<!--// Right User Menue - BEGIN //-->

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
 <p>User Men&uuml;</p>
</div>
<div class="tr_hide2">
 <br>Benutzer:<br>>>USER<<<br><br><A HREF="index.php?id=login&amp;action=logout">Ausloggen</A><BR><BR><A HREF="index.php?id=profile">Profil</A><BR><A HREF="index.php?id=members">Benutzerliste</A><BR><A HREF="index.php?id=messenger">Messenger</A><BR><A HREF="index.php?id=chat">Chat</A><br><br>
</div>

<!--// Right User Menue - END //-->