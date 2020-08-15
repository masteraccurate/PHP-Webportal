<?php
################################################
# Author:       MasterAccurate                 #
# E-Mail:       masteraccurate@yahoo.com       #
# Website:      http://webportal.de.cool       #
################################################
# Project-Name: PHP-Webportal                  #
# Filename:     home.module.php                #
# Date:         2020-05-18                     #
################################################
#                  Copyright                   #
# Copyright refers to the exclusive right to   #
# a piece of work such as literature, music,   #
# artwork and computer software including the  #
# underlying algorithms, source code and the   #
# program's appearance. Rights covered include #
# copying, distributing and creating           #
# derivative works. Most software is           #
# distributed with a license or copyright      #
# notice that explains how it can be used.     #
################################################

class home {
	function title() {
		return "Heim";
	}
	function main() {
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "1") {
			$content = "Willkommen im Benutzerbereich!<BR>Hier kannst du im Blog posten, die Mitgliederliste durchsuchen oder den Messenger nutzen. So jetzt l&auml;uft der Messenger soweit erstmal Fehlerfrei! Wenn noch Bugs auftauchen, werde ich wieder weiter programmieren m&uuml;ssen.<br><br>Jetzt gibt es hier Smileys!<br>Ich habe 3 Smileys im G&auml;stebuch, im Blog, Board und im Messenger hinzugef&uuml;gt.<br>Mit den Zeichen &#058;&#041; gibt es den <img src=\"images/smileys/smiley1.png\"> Smiley.<br>Mit den Zeichen &#058;D gibt es den <img src=\"images/smileys/smiley2.png\"> Smiley<br>und mit den Zeichen &#059;&#041; gibt es den <img src=\"images/smileys/smiley3.png\"> Smiley.<br>Die Zeichenfolge &#123;br&#125; ergibt einen Zeilenumbruch beim Text.";
		} else {
			$content = "<b>Willkommen auf meiner Seite die sich derzeit im Bau befindet.</b><br>".
				"Das G&auml;stebuch, das Blog und das Board funktionieren schon.<br>Im G&auml;stebuch kannst du mir liebe Gr&uuml;&szlig;e zukommen lassen.<br>".
				"Im Blog kannst du lesen was ich die vergangenen Tage so gemacht habe.<br>Du kannst dich jetzt in meinem Portal registrieren<br>".
				"und falls dir kein Benutzername einf&auml;llt,<br>kannst du den Namegenerator dazu nutzen dir ein passenden Benutzernamen<br>auszudenken, ".
				"mit dem du dich hier dann registrieren kannst.<br>Der Messenger ist auch soweit erstmal fertig und funktioniert.<br><br>Jetzt gibt es hier Smileys!<br>Ich habe 3 Smileys im G&auml;stebuch, im Blog, Board und ".
				"im Messenger hinzugef&uuml;gt.<br>Mit den Zeichen &#058;&#041; gibt es den <img src=\"images/smileys/smiley1.png\" alt=\"Smiley1\"> Smiley.<br>Mit den ".
				"Zeichen &#058;D gibt es den <img src=\"images/smileys/smiley2.png\" alt=\"Smiley2\"> Smiley<br>und mit den Zeichen &#059;&#041; gibt es den ".
				"<img src=\"images/smileys/smiley3.png\" alt=\"Smiley3\"> Smiley.<br><br>Die Zeichenfolge &#123;br&#125; ergibt einen Zeilenumbruch beim Text.<br><br>".
				"<marquee><b>Neues Menü das per Click ausfährt und per Doppelklick wieder einfährt.</b></marquee><br><b>Einfach mal ausprobieren!</b> Doppelklick funktioniert bei Handy leider nicht.\n";
		}
		return $content;
	}
}
?>