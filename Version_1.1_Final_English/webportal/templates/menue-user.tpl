<!--// Right User Menue - BEGIN //-->

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
 <p>User Menu</p>
</div>
<div class="tr_hide2">
<br>User:<br>>>USER<<<BR><br><A HREF="index.php?id=login&amp;action=logout">Logout</A><BR><BR><A HREF="index.php?id=profile">Profile</A><BR><A HREF="index.php?id=members">Userlist</A><BR><A HREF="index.php?id=messenger">Messenger</A><BR><A HREF="index.php?id=chat">Chat</A><br><BR>
</div>

<!--// Right User Menue - END //-->