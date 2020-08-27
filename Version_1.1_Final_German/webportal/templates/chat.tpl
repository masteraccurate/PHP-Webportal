<table border="0" bgcolor="#000000">
 <tr>
  <td bgcolor="#ffffff" align="center">
	<center>
        <div id="content">
            <textarea id="chatwindow" rows="19" cols="68" readonly></textarea><br>

            <input id="chatnick" type="text" size="9" maxlength="10" placeholder="username" value=">>USER<<">&nbsp;
            <input id="chatmsg" type="text" size="48" maxlength="56"  onkeyup="keyup(event.keyCode);" placeholder="Message hier eingeben...">
            <input type="button" value="senden" onclick="submit_msg();" style="cursor:pointer;border:1px solid gray;"><br><br>
        </div>
	</center>
  </td>
 </tr>
</table>
<script type="text/javascript" src="templates/chat.js"></script>